<?php

namespace Spliced\SurveyMonkey\Request;

use Guzzle\Http\Message\RequestInterface as HttpRequest;
use Spliced\SurveyMonkey\Client;
use Spliced\SurveyMonkey\RequestInterface;


class GetRespondentList  extends AbstractRequest implements RequestInterface
{

    const ENDPOINT_URI = 'surveys/get_respondent_list';

    protected $requestData = array(
        'survey_id' => null,
        'collector_id' => null,
        'page' => 1,
        'page_size' => 1000,
        'start_date' => null,
        'end_date' => null,
        'start_modified_date' => null,
        'end_modified_date' => null,
        'order_by' => null,
        'order_asc' => null,
        'fields' => array()
    );

    /**
     * @var array - The fields which can be included in the fields parameter
     */
    protected $allowedFields = array(
        'date_start',
        'date_modified',
        'collector_id',
        'collection_mode',
        'custom_id',
        'email',
        'first_name',
        'last_name',
        'ip_address',
        'status',
        'analysis_url',
        'recipient_id'
    );

    public function __construct($surveyId = null, array $data = array())
    {
        $this->requestData = array_merge($this->requestData, $data);

        $this->setSurveyId($surveyId);
    }


    public function getRequestParameters()
    {

        $requestData = array(
            'survey_id' => $this->getSurveyId(),
            'page' => $this->getPage() ? $this->getPage() : 1,
            'page_size' => $this->getPageSize() ? $this->getPageSize() : 1000,
            'order_asc' => $this->getOrderAsc() ? $this->getOrderAsc() : false
        );

        if(count($this->getFields())) {
            $requestData['fields'] = $this->getFields();
        }

        if ($this->getStartDate()) {
            $requestData['start_date'] = $this->getStartDate();
        }

        if ($this->getEndDate()) {
            $requestData['end_date'] = $this->getEndDate();
        }

        if ($this->getStartModifiedDate()) {
            $requestData['start_modified_date'] = $this->getStartDate();
        }

        if ($this->getEndModifiedDate()) {
            $requestData['end_modified_date'] = $this->getEndModifiedDate();
        }

        if ($this->getCollectorId()) {
            $requestData['collector_id'] = $this->getCollectorId();
        }

        if ($this->getOrderBy()) {
            $requestData['order_by'] = $this->getOrderBy();
        }

        return $requestData;
    }

    /**
     * @param mixed $collectorId
     */
    public function setCollectorId($collectorId)
    {
        return $this->set('collector_id', $collectorId);
    }

    /**
     * @return mixed
     */
    public function getCollectorId()
    {
        return $this->get('collector_id');
    }

    /**
     * @param mixed $endModifiedDate
     */
    public function setEndModifiedDate(\DateTime $endModifiedDate = null)
    {
        return $this->set('end_modified_date', $endModifiedDate ? $endModifiedDate->format('c') : null);
    }

    /**
     * @return mixed
     */
    public function getEndModifiedDate()
    {
        return $this->get('end_modified_date');
    }

    /**
     * @param mixed $orderBy
     */
    public function setOrderBy($orderBy)
    {
        return $this->set('order_by', $orderBy);
    }

    /**
     * @return mixed
     */
    public function getOrderBy()
    {
        return $this->get('order_by');
    }


    /**
     * @param mixed $startModifiedDate
     */
    public function setStartModifiedDate($startModifiedDate)
    {
        return $this->set('start_modified_date', $startModifiedDate ? $startModifiedDate->format('c') : null);
    }

    /**
     * @return mixed
     */
    public function getStartModifiedDate()
    {
        return $this->get('start_modified_date');
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
     * @param mixed $endDate
     */
    public function setEndDate(\DateTime $endDate = null)
    {
        return $this->set('end_date', $endDate ? $endDate->format('u') : null);
    }

    /**
     * @return mixed
     */
    public function getEndDate()
    {
        return $this->get('end_date');
    }

    /**
     * @param array $fields
     */
    public function setFields(array $fields = array())
    {
        foreach ($fields as $field) {
            if (!in_array($field, $this->allowedFields)) {
                throw new \InvalidArgumentException(sprintf('Field: %s Invalid. Allowable Fields: %s',
                    $field,
                    implode(',', $this->allowedFields)
                ));
            }
        }
        return $this->set('fields', $fields);
    }

    /**
     * @return array
     */
    public function getFields()
    {
        return $this->get('fields');
    }

    /**
     * @param $field
     *
     * @return $this
     * @throws \InvalidArgumentException
     */
    public function addField($field)
    {
        if (!in_array($field, $this->allowedFields)) {
            throw new \InvalidArgumentException(sprintf('Field: %s Invalid. Allowable Fields: %s',
                $field,
                implode(',', $this->allowedFields)
            ));
        }

        $fields = $this->get('fields');

        $fields[] = $field;

        return $this->setFields(array_unique($fields));
    }

    /**
     * @param boolean $orderAsc
     */
    public function setOrderAsc($orderAsc)
    {
        return $this->set('order_asc', $orderAsc ? true : false);

    }

    /**
     * @return boolean
     */
    public function getOrderAsc()
    {
        return $this->get('order_asc');
    }

    /**
     * @param int $page
     */
    public function setPage($page)
    {
        return $this->set('page', $page);
    }

    /**
     * @return int
     */
    public function getPage()
    {
        return $this->get('page');
    }

    /**
     * @param int $pageSize
     */
    public function setPageSize($pageSize)
    {
        return $this->set('page_size', $pageSize);
    }

    /**
     * @return int
     */
    public function getPageSize()
    {
        return $this->get('page_size');
    }

    /**
     * @param mixed $startDate
     */
    public function setStartDate(\DateTime $startDate = null)
    {
        return $this->set('start_date', $startDate ? $startDate->format('u') : null);
    }

    /**
     * @return mixed
     */
    public function getStartDate()
    {
        return $this->get('start_date');
    }

}