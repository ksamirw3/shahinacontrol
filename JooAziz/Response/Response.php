<?php

namespace JooAziz\Response;

class Response {

    private $result = false;
    private $message = '';
    private $data = null;
    private $error = '';
    private $code = 200;

    public static function make() {
        return new static;
    }

    public function setResult($result) {
        $this->result = $result;
        return $this;
    }

    public function setMessage($message) {
        $this->message = $message;
        return $this;
    }

    public function setData($data) {
        $this->data = $data;
        return $this;
    }

    public function setError($error) {
        $this->error = $error;
        return $this;
    }

    public function setCode($code) {
        $this->code = $code;
        return $this;
    }

    public function getResult() {
        return $this->result;
    }

    public function getMessage() {
        return $this->message;
    }

    public function getData() {
        return $this->data;
    }

    public function getError() {
        return $this->error;
    }

    public function getCode() {
        return $this->code;
    }

    public function send() {
        $rs = [
            'result' => $this->getResult(),
            'message' => $this->getMessage(),
            'data' => $this->getData(),
            'error' => $this->getError()];
        header('Content-type: application/json');
        http_response_code($this->getCode());
        echo json_encode($rs);
        die;
    }

}
