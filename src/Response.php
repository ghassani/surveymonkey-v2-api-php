<?php

namespace Spliced\SurveyMonkey;

class Response
{

    public function __construct(array $response)
    {
        $this->response = $response;
    }

    public function isSuccess()
    {
        return $this->response['status'] == 0;
    }

    public function getMessage()
    {
        return !$this->isSuccess() ? $this->response['errmsg'] : null;
    }

    public function getData()
    {
        return $this->isSuccess() ? $this->response['data'] : false;
    }

}