<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\Admin\Users;

/**
 * Description of initData
 *
 * @author jooaziz
 */
use Carbon\Carbon;
use App\Models\Group;
use App\Models\Session;
use App\Models\Diploma;

class initData {

    public static function create(\Illuminate\Http\Request $request) {
        $data = $request->except('_token','password');
        $data['password'] = \Hash::make($request->password);
        if ($request->finger_print)
            $data['finger_print'] = uploadImages($request->finger_print)[0];
        if ($request->presonal_image)
            $data['presonal_image'] = uploadImages($request->presonal_image)[0];
        return $data;
    }

    public static function validateLabsAndInstructors(\Illuminate\Http\Request $request) {
        /*
         * already sessions
         */
        $newSessions = (self::createSessionArray(
                        new Group($request->all())
                        , Diploma::findOrFail($request->get('diploma_id'))
                        , $request->get('days_of_sessions')
                        , $request->get('start_date')
        ));
        /*
         * old sessions
         */
        $oldSessions = \App\Models\Session::whereLabId($request->get('lab_id'))
                ->whereDate('date', '>=', $request->get('start_date'))
                ->select(['date', 'start_time', 'end_time'])
                ->get()
                ->toArray();
        /*
         * get diff as ture or false
         */
        return self::diffTowSessions($oldSessions, $newSessions);
    }

    public static function diffTowSessions($oldSessions, $newSessions, $checkId = false) {
        foreach ($newSessions as $newSes) {
            foreach ($oldSessions as $oldSes) {
                if ($checkId)
                    if (@$newSes['id'] == @$oldSes['id'])
                        continue;

                $oldStart = strtotime($oldSes['date'] . ' ' . $oldSes['start_time'] . ':00');
                $oldEnd = strtotime($oldSes['date'] . ' ' . $oldSes['end_time'] . ':00');
                $newStart = strtotime($newSes['date'] . ' ' . $newSes['start_time'] . ':00');
                $newEnd = strtotime($newSes['date'] . ' ' . $newSes['end_time'] . ':00');
                /*
                 * check avaliblet
                 */
                if (!self::checkAvaliblety($oldStart, $oldEnd, $newStart, $newEnd))
                    return false;
            }
        }
        return TRUE;
    }

    /**
     * not realy use in production it just for debug

     * @param type $oldStart
     * @param type $oldEnd
     * @param type $newStart
     * @param type $newEnd
     * @return type
     */
    private static function debug($oldStart, $oldEnd, $newStart, $newEnd) {
        return ['old' => [ 'start' => [ 't' => $oldStart, 'd' => date('Y-m-d H:i:s', $oldStart)], 'end' => ['t' => $oldEnd, 'd' => date('Y-m-d H:i:s', $oldEnd)]], 'new' => [ 'start' => [ 't' => $newStart, 'd' => date('Y-m-d H:i:s', $newStart)], 'end' => [ 't' => $newEnd, 'd' => date('Y-m-d H:i:s', $newEnd)]]];
    }

    private static function checkAvaliblety($oldStart, $oldEnd, $newStart, $newEnd) {
//       dd(( self::debug($oldStart, $oldEnd, $newStart, $newEnd)));

        /*
         * this draw is sessions
         * 
         * draw key 
         */

        /*
         *          old     new
         * ...............................
         *                   -
         *  start            
         *           -
         * ................................
         *                   -    
         *  end  
         *          -
         * ................................
         */
        if ($oldStart >= $newStart && $oldStart <= $newEnd && $newEnd <= $oldEnd)
            return FALSE;
        /*
         *          old     new
         * ...............................
         *           -
         *  start            
         *                   -
         * ................................
         *          -
         *  end  
         *                   -    
         * ................................
         */
        if ($oldStart <= $newStart && $newStart <= $oldEnd && $oldEnd <= $newEnd)
            return FALSE;
        /*
         *          old     new
         * ...............................
         *           -
         *  start            
         *                   -
         * ................................
         *                   -    
         *  end  
         *          -
         * ................................
         */
        if ($oldStart <= $newStart && $oldStart <= $newEnd && $oldStart >= $newStart && $oldStart >= $newEnd)
            return FALSE;
        /*
         *          old     new
         * ...............................
         *                   -
         *  start            
         *           -
         * ................................
         *           -
         *  end  
         *                   -    
         * ................................
         */
        if ($newStart <= $oldStart && $newStart <= $oldEnd && $newEnd >= $oldStart && $newEnd >= $oldEnd)
            return FALSE;
        /*
         *          old     new
         * ...............................
         *                   
         *  start    -       -        
         *           
         * ................................
         *           
         *  end      -       -  
         *                      
         * ................................
         */
        if ($oldStart == $newStart && $oldEnd == $newEnd)
            return FALSE;
        return TRUE;
    }

    public static function createSessions($group) {

        /*
         * convert days of session from json string to array
         */
        $days = json_decode($group->days_of_sessions);
        /*
         * set start date
         */
        $start_date = $group->start_date;
        /*
         * for loop
         */

        return self::createSessionArray($group, $group->diploma, $days, $start_date);
    }

    private static function createSessionArray($group, $diploma, $days, $start_date) {
        $data = [];
        foreach ($diploma->courses as $course) {
            /*
             * get count of sessions per course
             */
            $sessionsNo = (int) ceil($course->total_hours / $group->session_duration);
            /*
             * get list of array of dates for this course
             */
            $dates = self::getSissonsDates($sessionsNo, $days, $start_date);

            /*
             * re assaien start date to use it for begining of next course
             */
            $start_date = end($dates);
            /*
             * assaien data
             */
            for ($i = 0; $i < $sessionsNo; $i++) {
                $data[] = [
                    'no' => ($i + 1),
                    'date' => $dates[$i],
                    'start_time' => $group->start_time,
                    'end_time' => (Carbon::createFromFormat('H:i', $group->start_time)->addMinutes($group->session_duration * 60)->format('H:i')),
                    'is_payabel' => 1,
                    'bill' => ($i == ($sessionsNo - 1)) ? 1 : 0,
                    'instructor_id' => null,
                    'lab_id' => $group->lab_id,
                    'group_id' => $group->id,
                    'course_id' => $course->id,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
            }
        }
        return $data;
    }

    public static function getSissonsDates($total, $days, $start) {
        $i = 0;
        $dats = [$start];
        $firstDay = $start;
        while ($i < $total) {

            $data = Carbon::createFromFormat('Y-m-d', $firstDay)->addDay();
            $firstDay = $data->toDateString();
            $day = $data->dayOfWeek;
            if (in_array($day, $days)) {
                $dats[] = $firstDay;
                $i++;
            }
        }
        return $dats;
    }

}
