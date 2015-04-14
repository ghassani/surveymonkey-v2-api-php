<?php

namespace Spliced\SurveyMonkey\Request;

use Guzzle\Http\Message\RequestInterface as HttpRequest;
use Spliced\SurveyMonkey\Client;
use Spliced\SurveyMonkey\RequestInterface;


class GetResponses  extends AbstractRequest implements RequestInterface
{

    const ENDPOINT_URI = 'surveys/get_responses';

    protected $requestData = array(
        'respondent_ids' => array(),
        'survey_id' => null
    );

    public function __construct($surveyId, array $respondentIds = array())
    {
        $this->requestData['survey_id'] = $surveyId;
        $this->requestData['respondent_ids'] = $respondentIds;
    }

    /**
     * @param mixed $respondentIds
     */
    public function setRespondentIds(array $respondentIds)
    {
        $this->set('respondent_ids', $respondentIds);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRespondentIds()
    {
        return $this->get('respondent_ids');
    }

    /**
     * @param mixed $surveyId
     */
    public function setSurveyId($surveyId)
    {
        return $this->set('survey_id', $surveyId);
    }

    /**
     * @return mixed
     */
    public function getSurveyId()
    {
        return $this->get('survey_id');
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
        return $this->requestData;
    }


}