<?php
/**
 * Created by PhpStorm.
 * User: Gassan
 * Date: 1/24/15
 * Time: 3:39 PM
 */

namespace Spliced\SurveyMonkey\Request;


use Spliced\SurveyMonkey\Client;

abstract class AbstractRequest
{
    protected $requestData = array();

    /**
     * @param $param
     * @param $value
     */
    public function set($param, $value)
    {
        $this->requestData[$param] = $value;
        return $this;
    }

    /**
     * @param $param
     *
     * @return bool
     */
    public function has($param)
    {
        return isset($this->requestData[$param]);
    }

    /**
     * @param $param
     *
     * @return bool
     */
    public function get($param)
    {
        return $this->has($param) ? $this->requestData[$param] : false;
    }


    public function getRequestParameters()
    {
        return $this->requestData;
    }

    public function getClient()
    {
        return $this->client;
    }

    public function setClient(Client $client)
    {
        $this->client = $client;
        return $this;
    }

    public function send()
    {
        if ($this->getClient()) {
            return $this->client->send($this);
        }

        return false;
    }
}
