<?php

namespace Amit\CB;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CBM
 *
 * @author jooaziz
 */
class CBM implements Interfaces\IDocument, Interfaces\IView {

    /**
     * init val of deleted at
     * it will overwriten if it dfound in doc
     * @var type
     */
    public $deleted_at = null;
    public $id = null;
    protected $viewArgs = ['view' => null, 'queryArgs' => ['stale' => 'false']];

    /**
     * it equales to
     *      type atter in document
     *      class name
     *      view pattern name
     *
     * @var type
     */
    protected $documentType;

    /**
     * constructor acceped tow args
     *      - [attrs] and it`s array of keys and values for assigne it
     *      to this model and prepair  it for saving  - default [];
     *
     *      - [$retaltedId] it refaer to id from anther document that
     *          this document dependcy of it default null
     *      ex: (userProfile::user::sdf3dsf1sd2f3sdf)
     * @param array $attrs
     * @param type $retaltedId
     */
    public function __construct(array $attrs = [], $retaltedId = null) {
        $this->viewArgs['queryArgs']['limit'] = \Amit\Settings\Genral::perPage();
        $this->setDocumentType();
        $this->fillAble($attrs);
        if (!is_null($retaltedId)) $this->id = $this->documentType . '::' . $retaltedId;
    }

    public function __toString() {
        return json_encode($this);
    }

    public function toArray($expet = []) {
        $data = $this->getData();
        foreach ($expet as $k) unset($data[$k]);
        return $data;
    }

    /**
     *
     *  create
     *
     *
     * @param array $attrs
     * @return \Amit\CB\CBM
     */
    public function create(array $attrs) {
        $this->fillAble($attrs);
        return $this;
    }

    public function delete() {
        $this->deleted_at = date('Y-m-d H:i:s', time());
        return $this->update();
    }

    public function save() {
        return $this->insert(array_merge($this->getData(), Helper::addDates()));
    }

    public function update() {
        return $this->insert(array_merge($this->getData(), ['updated_at' => date('Y-m-d H:i:s', time())]));
    }

    private function insert($data) {

        $this->fillAble($data);
        $this->id = DocumentWriter::write($data, $this->id);
        return $this;
    }

    public function destroy() {
        return DocumentWriter::remove($this->id);
    }

    public function find($id) {
        return \Amit\CB\DocumentReader::get($id);
    }

    public function findOrFail($id) {
        $res = $this->find($id);
        if (is_null($res) && \Amit\Settings\Genral::devMode()) abort(404, "AMIT : Document Not Found for id : " . $id);
        elseif (is_null($res)) abort(404, "AMIT : There is some thing wrong");


        return $res;
    }

    private function fillAble($attrs) {
        foreach ($attrs as $k => $attr) {
            $this->{$k} = $attr;
        }
    }

    private function getData() {
        $accessAttrs = \Amit\Support\Cls::getPUBLICAttrs($this);
        $data = [];
        foreach ($this as $k => $v) if (in_array($k, $accessAttrs)) $data[$k] = $v;

        $data['type'] = $this->documentType;
        return $data;
    }

    /**
     * set DocumentType to class name
     */
    private function setDocumentType() {
        $this->documentType = \Amit\Support\Cls::className($this);
    }

    public function in($view) {
        $this->viewArgs['view'] = $view;
        return $this;
    }

    public function where($key, $value) {
        $this->viewArgs['queryArgs'][$key] = $value;
        return $this;
    }

    private function retriveRows() {
        return ViewReader::get($this->documentType, $this->viewArgs['view'], $this->viewArgs['queryArgs']);
    }

    public function get($strict = false) {
        $result = $this->retriveRows();
        if ($strict) if (@$result->withError == true) abort(401, 'AMIT : error in retrive data from view');
        return Helper::rowAsModel($result->rows);
    }

    public function getIds() {
        return \Amit\Support\Arr::getByKey($this->retriveRows()->rows, 'id');
    }

    public function getKeys() {
        return \Amit\Support\Arr::getByKey($this->retriveRows()->rows, 'key');
    }

    public function getValues() {
        return \Amit\Support\Arr::getByKey($this->retriveRows()->rows, 'value');
    }

    public function getDocs() {
        return DocumentReader::get($this->getIds());
    }

    public function first() {
        $res = @$this->get(true)[0];
        if (is_null($res)) return null;
        return $res->getDoc();
    }

    public function pagination($rows = null) {
        $limit = ($rows)? : \Amit\Settings\Genral::perPage();
        return new Pagination(
                $this->where('skip', abs(((int) (\Request::get('page'))? : 1) - 1) * $limit)->
                        where('limit', $limit)->retriveRows(), $limit
        );
    }

    public function orderBy($order = 'created_at') {
        abort(404, 'AMIT : not implemented yet');
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

    public static function inView($view) {
        return (new static)->in($view);
    }

    public static function all($rows = null) {
        return (new static)->in('all')->pagination($rows);
    }

    public static function quickFindOrFail($id) {
        return (new static)->findOrFail($id);
    }

    public static function quickDelete($id) {
        return (new static)->findOrFail($id)->delete();
    }

    public static function quickDestroy($id) {
        return (new static)->findOrFail($id)->destroy();
    }

    public static function quickSave(array $attrs) {
        return (new static($attrs))->save();
    }

    /**
     * use this static method for easy and fast
     * update just pass data you want to update as array
     * and it will update
     *
     * make sure it will fail if array that you pass not containt on id
     *
     * feel free to add what you want of data it will add if it new
     * or update if it already exasit
     *
     * @param array $attrs
     * @return CMB
     */
    public static function quickUpdate(array $attrs = array()) {
        /*
         * chech if id index is existe or it will abort
         */
        if (!isset($attrs['id'])) return abort(404, 'AMIT : Missing Id For Update Method');

        $instance = self::quickFindOrFail($attrs['id']);

        foreach ($attrs as $k => $attr) $instance->{$k} = $attr;

        return $instance->update();
    }

    public static function bulkDestroy($ids) {
        return DocumentWriter::remove($ids);
    }

}
