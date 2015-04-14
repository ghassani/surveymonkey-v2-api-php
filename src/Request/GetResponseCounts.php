<?php

namespace Spliced\SurveyMonkey\Request;

use Guzzle\Http\Message\RequestInterface as HttpRequest;
use Spliced\SurveyMonkey\Client;
use Spliced\SurveyMonkey\RequestInterface;


class GetResponseCounts  extends AbstractRequest implements RequestInterface
{

    const ENDPOINT_URI = 'surveys/get_response_counts';

    protected $requestData = array(
        'collector_id' => null
    );

    public function __construct($collectorId)
    {
        $this->requestData['collector_id'] = $collectorId;
    }

    /**
     * @return string{@inheritDoc}
     */
    public function getEndpointUri()
    {
        return static::ENDPOINT_URI;
    }

    public function getRequestParameters()
    {
        return $this->requestData;
    }


}