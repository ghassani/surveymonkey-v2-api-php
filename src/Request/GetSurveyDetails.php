<?php

namespace Spliced\SurveyMonkey\Request;

use Guzzle\Http\Message\RequestInterface as HttpRequest;
use Spliced\SurveyMonkey\Client;
use Spliced\SurveyMonkey\RequestInterface;


class GetSurveyDetails  extends AbstractRequest implements RequestInterface
{

    const ENDPOINT_URI = 'surveys/get_survey_details';

    protected $requestData = array(
        'survey_id' => null
    );

    public function __construct($surveyId)
    {
        $this->requestData['survey_id'] = $surveyId;
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