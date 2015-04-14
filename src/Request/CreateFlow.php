<?php

namespace Spliced\SurveyMonkey\Request;

use Guzzle\Http\Message\RequestInterface as HttpRequest;
use Spliced\SurveyMonkey\Client;
use Spliced\SurveyMonkey\RequestInterface;


class CreateFlow  extends AbstractRequest implements RequestInterface
{

    const ENDPOINT_URI = 'batch/create_flow';

    protected $requestData = array();


    public function __construct()
    {
        throw new \Exception('CreateFlow Not Yet Implemented');
    }

    /**
     * @return string{@inheritDoc}
     */
    public function getEndpointUri()
    {
        return static::ENDPOINT_URI;
    }

    /**
     * @return array
     */
    public function getRequestParameters()
    {
        $requestData = $this->requestData;


        return $requestData;
    }


}