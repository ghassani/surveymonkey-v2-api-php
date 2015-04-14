<?php

namespace Spliced\SurveyMonkey\Request;

use Guzzle\Http\Message\RequestInterface as HttpRequest;
use Spliced\SurveyMonkey\Client;
use Spliced\SurveyMonkey\RequestInterface;


class GetUserDetail  extends AbstractRequest implements RequestInterface
{

    const ENDPOINT_URI = 'surveys/get_user_details';

    protected $requestData = array();

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
        return $this->requestData;
    }


}