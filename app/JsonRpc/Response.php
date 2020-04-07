<?php

namespace App\JsonRpc;

class Response
{
    protected $response;

    protected $success;

    public function __construct($response)
    {
        $this->response = json_decode($response, false, 512);
        $this->success = !isset($this->response->error);
    }

    /**
     * @return bool
     */
    public function isSuccess()
    {
        return $this->success;
    }

    /**
     * @return mixed
     */
    public function getResult()
    {
        return $this->response->result;
    }

    /**
     * @return integer
     */
    public function getErrorCode()
    {
        return $this->response->error->code;
    }

    /**
     * @return string
     */
    public function getErrorMessage()
    {
        return $this->response->error->message;
    }
}
