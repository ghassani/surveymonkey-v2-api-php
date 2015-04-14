<?php

namespace Spliced\SurveyMonkey\Request;

use Guzzle\Http\Message\RequestInterface as HttpRequest;
use Spliced\SurveyMonkey\Client;
use Spliced\SurveyMonkey\RequestInterface;


class CreateCollector  extends AbstractRequest implements RequestInterface
{

    const ENDPOINT_URI = 'collectors/create_collector';

    protected $requestData = array(
        'survey_id' => null,
        'collector' => array(
            'type' => 'weblink',
            'name' => 'New Link'
        )
    );

    public function __construct(array $data = array())
    {
        $this->requestData = array_merge($this->requestData, $data);

    }
    /**
     * @return mixed
     */
    public function getSurveyId()
    {
        return $this->requestData['survey_id'];
    }

    /**
     * @param mixed $surveyId
     */
    public function setSurveyId($surveyId)
    {
        $this->requestData['survey_id'] = $surveyId;
    }

    /**
     * @return mixed
     */
    public function getCollector()
    {
        return $this->requestData['collector'];
    }

    /**
     * @param mixed $collector
     */
    public function setCollector($name)
    {
        $this->requestData['collector']['name'] = $name;
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