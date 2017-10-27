<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Amit\CB;

/**
 * Description of Pagination
 *
 * @author jooaziz
 */
class Pagination implements Interfaces\IViewResultModifire {

    protected $data;
    protected $total_rows;
    protected $per_page;
    protected $pages;

    public function __construct($data, $paginat) {
        $this->per_page = $paginat;
        $this->total_rows = $data->total_rows;
        $this->pages = (int) ceil($this->total_rows / $this->per_page);
        $this->fillData(Helper::rowAsModel($data->rows));
    }

    public function __toString() {
        return json_encode($this);
    }

    private function fillData($data) {
        foreach ($data as $k => $attr) {
            $this->{$k} = $attr;
        }
        $this->data = $data;
    }

    public function links() {
        return LinksMaker::get($this->total_rows, $this->per_page);
    }

    public function getIds() {
        return \Amit\Support\Arr::getByKey($this->data, 'id');
    }

    public function getKeys() {
        return \Amit\Support\Arr::getByKey($this->data, 'key');
    }

    public function getValues() {
        return \Amit\Support\Arr::getByKey($this->data, 'value');
    }

    public function getDocs() {
        return DocumentReader::get($this->getIds());
    }

    public function first() {
        return @$this->get()[0]->getDoc();
    }

    public function get() {
        return $this->data;
    }

    public function lists($filed = 'name', $id = null, $singleArray = FALSE) {
        $rt = [];
        $res = $this->getDocs();
        if (empty($res)) return $res;
        foreach ($res as $row) {
            if (isset($row->$filed)) {
                if (is_null($id)) {

                    if ($singleArray) {
                        $rt = array_merge($rt, $row->$filed);
                    } else {
                        $rt[] = $row->$filed;
                    }
                } else {
                    if (isset($row->$id)) {
                        $rt[$row->$id] = $row->$filed;
                    } else {
                        abort(404, 'filed [' . $id . '] not existe');
                    }
                }
            } else {
                continue;
//                abort(404, 'filed [' . $filed . '] not existe');
            }
        }
        return $rt;
    }

    public function getTotalPages() {
        return $this->pages;
    }

    public function getNoPerPage() {
        return $this->per_page;
    }

    public function getTotalRows() {
        return $this->total_rows;
    }

    public function orderBy($order = 'created_at') {

        abort(404, 'not implemented yet');
        //  dd(\Amit\Support\Arr::SortArraySecandLevel($this->getDocs(), $order));
    }

}
