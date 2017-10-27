<?php

namespace Amit\CouchBase;

class BaseModel {

    public $data = [];
    protected $viewDocName;
    protected $docType;
    protected $prefix;
    private $searchableView;
    private $searchableArgs = ['stale' => 'false'];
    private $reader;
    private $writer;
    public $attrs = [];
    private $relatedDoc = [];

    public function __construct() {
        $this->viewDocName = (is_null($this->viewDocName)) ? $this->docType : $this->viewDocName;
        $this->prefix = $this->docType . '::';
        $this->reader = new Read();
        $this->writer = new Write();
//        dd($this->prefix);
    }

    public function getDocType() {
        return $this->docType;
    }

    public function __call($viewName, $arguments) {
        if (substr($viewName, 0, 2) == 'in') {
            $this->makeArgs($arguments);
            $this->searchableView = strtolower(substr($viewName, 2));
//            dd($this->searchableView, $this->searchableArgs);
            return $this;
        } else if (substr($viewName, 0, 5) == 'where') {
            $this->searchableArgs[strtolower(substr($viewName, 5))] = @$arguments[0];
            return $this;
        }
//        elseif (substr($viewName, 0, 5) == 'count') {
//            $this->viewDocName = "document";
//            return $this;
//        }
        dd('method not found');
    }

    private function makeArgs($arg) {

        if (!@$arguments[0]) return false;
        foreach (@$arguments[0]as $k => $arg) {
            $this->searchableArgs[$k] = $arg;
        }
    }

    public function find($IDs) {
        $this->data = $this->reader->get($IDs);
        if (!empty($this->relatedDoc) && !is_array($IDs)) {
            $this->data->related = RelationModel::makeRelation($this->data, $this->relatedDoc);
        }
//        dd($this->data);
        return $this->data;
    }

    public function findAll() {
        return $this->get();
    }

    public function first() {
        $res = (array) $this->get()->rows;

        if (@$res[0]) {
            $row = $res[0];
        } else {
            $row = ['id' => null, 'key' => null, 'value' => null,];
        }
        return new \RowToDocument((object) $row);
    }

    private function spilitData($type) {
        $res = $this->get();
        $rt = [];
        foreach ($res->rows as $id) {
            $rt[] = $id[$type];
        }
        return $rt;
    }

    public function get() {
        $this->retrive();
        return $this->data;
    }

    public function toArray() {
        $this->retrive();
        return json_decode(json_encode($this->data->rows), true);
    }

    public function toJson() {
        $this->retrive();
        return json_encode($this->data->rows);
    }

    private function retrive() {
//        dd($this->searchableArgs);
        $this->data = $this->reader->CB_query($this->viewDocName, $this->searchableView, $this->searchableArgs);
        return $this->data;
    }

    public function getIds() {
        return $this->data = $this->spilitData('id');
    }

    public function getLastData() {
        return $this->data;
    }

    public function getValues() {
        return $this->data = $this->spilitData('value');
    }

    public function getKeys() {
        return $this->data = $this->spilitData('key');
    }

    public function getDocs() {
        return $this->data = $this->reader->get($this->getIds());
    }

    public function create($data = [], $id = null) {
        $this->writer->docType = $this->docType;
        $this->writer->prefix = $this->prefix;

        $fullData = array_merge($this->attrs, $data);
        return $this->writer->create($fullData, $id);
    }

    public function update($id, $data = []) {
        return $this->writer->update($id, (array) $data);
    }

    public function delete($id) {
        $data["deleted_at"] = time();
        return $this->writer->update($id, $data);
    }

    public function remove($id) {
        return $this->writer->remove($id);
    }

    public function skip($skip = 10, $limit = 10) {
        $this->searchableArgs['limit'] = $limit;
        $this->searchableArgs['skip'] = $skip;
        return $this;
    }

    public function findOrFail($ids) {
        $res = $this->find($ids);
        if (empty((array) $res)) abort(404, 'DOCUMENT NOT FOUND');
        return $res;
    }

    public function getList($filed = 'name', $id = null, $singleArray = FALSE) {
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

    public function lists($filed = 'name', $id = null) {
        return $this->getList($filed, $id);
    }

    public function getAttrs() {
        $rt = (object) $this->attrs;
        $rt->toArray = $this->attrs;
        return $rt;
    }

    public function with($attr) {
        $this->relatedDoc[] = $attr;
        return $this;
    }

    public function counter($counterName, $value, $start_value = 1) {
        return $this->writer->counter($counterName, $value, $start_value);
    }

    private function countRetrieve() {
        $this->searchableArgs["reduce"] = "true";
        $this->data = $this->reader->CB_query("document", $this->searchableView, $this->searchableArgs);
        unset($this->searchableArgs);
        return $this->data;
    }

    public function getCount() {
        $this->countRetrieve();
        $arr = (array) $this->data->rows;
//        dd($arr);
        if (empty($arr)) {
            return 0;
        }
        if ((count($arr) > 1)) {
            $value = array_sum(array_column($arr, "value"));
        } else {
            $value = (!empty($arr[0]['value'])) ? $arr[0]['value'] : 0;
        }
        return $value;
    }

}
