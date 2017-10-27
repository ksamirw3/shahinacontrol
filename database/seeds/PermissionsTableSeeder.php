<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PermissionsTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $now = Carbon::now()->format('Y-m-d H:i:s');
        $data = [['action' => "create", 'model' => "admins", 'label' => "add admin", 'created_at' => $now, 'updated_at' => $now]
            , ['action' => "view", 'model' => "admins", 'label' => "view admins", 'created_at' => $now, 'updated_at' => $now]
            , ['action' => "edit", 'model' => "admins", 'label' => "edit admins", 'created_at' => $now, 'updated_at' => $now]
            , ['action' => "group-schedule", 'model' => "schedules", 'label' => "edit schedule", 'created_at' => $now, 'updated_at' => $now]
            , ['action' => "create", 'model' => "sessions", 'label' => "add sessions", 'created_at' => $now, 'updated_at' => $now]
            , ['action' => "create", 'model' => "rules", 'label' => "add rules", 'created_at' => $now, 'updated_at' => $now]
            , ['action' => "edit", 'model' => "rules", 'label' => "edit rules", 'created_at' => $now, 'updated_at' => $now]
            , ['action' => "view", 'model' => "rules", 'label' => "view rules", 'created_at' => $now, 'updated_at' => $now]
            , ['action' => "delete", 'model' => "rules", 'label' => "delete rules", 'created_at' => $now, 'updated_at' => $now]
            , ['action' => "create", 'model' => "groups", 'label' => "add groups", 'created_at' => $now, 'updated_at' => $now]
            , ['action' => "edit", 'model' => "groups", 'label' => "edit groups", 'created_at' => $now, 'updated_at' => $now]
            , ['action' => "view", 'model' => "groups", 'label' => "view groups", 'created_at' => $now, 'updated_at' => $now]
            , ['action' => "delete", 'model' => "groups", 'label' => "delete groups", 'created_at' => $now, 'updated_at' => $now]
            , ['action' => "create", 'model' => "branches", 'label' => "add branches", 'created_at' => $now, 'updated_at' => $now]
            , ['action' => "edit", 'model' => "branches", 'label' => "edit branches", 'created_at' => $now, 'updated_at' => $now]
            , ['action' => "view", 'model' => "branches", 'label' => "view branches", 'created_at' => $now, 'updated_at' => $now]
            , ['action' => "delete", 'model' => "branches", 'label' => "delete branches", 'created_at' => $now, 'updated_at' => $now]
            , ['action' => "create", 'model' => "labs", 'label' => "add labs", 'created_at' => $now, 'updated_at' => $now]
            , ['action' => "edit", 'model' => "labs", 'label' => "edit labs", 'created_at' => $now, 'updated_at' => $now]
            , ['action' => "view", 'model' => "labs", 'label' => "view labs", 'created_at' => $now, 'updated_at' => $now]
            , ['action' => "delete", 'model' => "labs", 'label' => "delete labs", 'created_at' => $now, 'updated_at' => $now]
            , ['action' => "create", 'model' => "diplomas", 'label' => "add diplomas", 'created_at' => $now, 'updated_at' => $now]
            , ['action' => "edit", 'model' => "diplomas", 'label' => "edit diplomas", 'created_at' => $now, 'updated_at' => $now]
            , ['action' => "view", 'model' => "diplomas", 'label' => "view diplomas", 'created_at' => $now, 'updated_at' => $now]
            , ['action' => "delete", 'model' => "diplomas", 'label' => "delete diplomas", 'created_at' => $now, 'updated_at' => $now]
            , ['action' => "create", 'model' => "students", 'label' => "add students", 'created_at' => $now, 'updated_at' => $now]
            , ['action' => "edit", 'model' => "students", 'label' => "edit students", 'created_at' => $now, 'updated_at' => $now]
            , ['action' => "view", 'model' => "students", 'label' => "view students", 'created_at' => $now, 'updated_at' => $now]
            , ['action' => "delete", 'model' => "students", 'label' => "delete students", 'created_at' => $now, 'updated_at' => $now]
            , ['action' => "create", 'model' => "studentsgroups", 'label' => "add studentsgroups", 'created_at' => $now, 'updated_at' => $now]
            , ['action' => "edit", 'model' => "studentsgroups", 'label' => "edit studentsgroups", 'created_at' => $now, 'updated_at' => $now]
            , ['action' => "view", 'model' => "studentsgroups", 'label' => "view studentsgroups", 'created_at' => $now, 'updated_at' => $now]
            , ['action' => "delete", 'model' => "studentsgroups", 'label' => "delete studentsgroups", 'created_at' => $now, 'updated_at' => $now]
            , ['action' => "create", 'model' => "instructors", 'label' => "add instructors", 'created_at' => $now, 'updated_at' => $now]
            , ['action' => "edit", 'model' => "instructors", 'label' => "edit instructors", 'created_at' => $now, 'updated_at' => $now]
            , ['action' => "view", 'model' => "instructors", 'label' => "view instructors", 'created_at' => $now, 'updated_at' => $now]
            , ['action' => "delete", 'model' => "instructors", 'label' => "delete instructors", 'created_at' => $now, 'updated_at' => $now]
            , ['action' => "create", 'model' => "courses", 'label' => "add courses", 'created_at' => $now, 'updated_at' => $now]
            , ['action' => "edit", 'model' => "courses", 'label' => "edit courses", 'created_at' => $now, 'updated_at' => $now]
            , ['action' => "view", 'model' => "courses", 'label' => "view courses", 'created_at' => $now, 'updated_at' => $now]
            , ['action' => "delete", 'model' => "courses", 'label' => "delete courses", 'created_at' => $now, 'updated_at' => $now]
            , ['action' => "create", 'model' => "attendees", 'label' => "add attendees", 'created_at' => $now, 'updated_at' => $now]
            , ['action' => "edit", 'model' => "attendees", 'label' => "edit attendees", 'created_at' => $now, 'updated_at' => $now]
            , ['action' => "session", 'model' => "attendees", 'label' => "edit attendees", 'created_at' => $now, 'updated_at' => $now]
            , ['action' => "view", 'model' => "attendees", 'label' => "view attendees", 'created_at' => $now, 'updated_at' => $now]
            , ['action' => "delete", 'model' => "attendees", 'label' => "delete attendees", 'created_at' => $now, 'updated_at' => $now]
            , ['action' => "create", 'model' => "coursesinstructors", 'label' => "add coursesinstructors", 'created_at' => $now, 'updated_at' => $now]
            , ['action' => "edit", 'model' => "coursesinstructors", 'label' => "edit coursesinstructors", 'created_at' => $now, 'updated_at' => $now]
            , ['action' => "view", 'model' => "coursesinstructors", 'label' => "view coursesinstructors", 'created_at' => $now, 'updated_at' => $now]
            , ['action' => "delete", 'model' => "coursesinstructors", 'label' => "delete coursesinstructors", 'created_at' => $now, 'updated_at' => $now]]
        ;
        App\Models\Permission::insert($data);
    }

}
