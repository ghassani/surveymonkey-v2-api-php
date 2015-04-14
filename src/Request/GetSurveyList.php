<?php

namespace Spliced\SurveyMonkey\Request;

use Guzzle\Http\Message\RequestInterface as HttpRequest;
use Spliced\SurveyMonkey\Client;
use Spliced\SurveyMonkey\RequestInterface;


class GetSurveyList  extends AbstractRequest implements RequestInterface
{

    const ENDPOINT_URI = 'surveys/get_survey_list';

    protected $requestData = array(
        'page' => 1,
        'page_size' => 1000,
        'start_date' => null,
        'end_date' => null,
        'title' => null,
        'recipient_email' => null,
        'order_asc' => null,
        'fields' => array()
    );

    /**
     * @var array - The fields which can be included in the fields parameter
     */
    protected $allowedFields = array(
        'title',
        'analysis_url',
        'preview_url',
        'date_created',
        'date_modified',
        'language_id',
        'question_count',
        'num_responses'
    );


    public function __construct(array $data = array())
    {
        $this->requestData = array_merge($this->requestData, $data);
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
     * @param mixed $recipientEmail
     */
    public function setRecipientEmail($recipientEmail)
    {
       return $this->set('recipient_email', $recipientEmail);
    }

    /**
     * @return mixed
     */
    public function getRecipientEmail()
    {
        return $this->get('recipient_email');
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

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        return $this->set('title', $title);
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->get('title');
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
        $requestData = array(
            'page' => $this->getPage() ? $this->getPage() : 1,
            'page_size' => $this->getPageSize() ? $this->getPageSize() : 1000,
            'order_asc' => $this->getOrderAsc() ? $this->getOrderAsc() : false
        );

        if ($this->getStartDate()) {
            $requestData['start_date'] = $this->getStartDate();
        }

        if ($this->getEndDate()) {
            $requestData['end_date'] = $this->getEndDate();
        }

        if ($this->getTitle()) {
            $requestData['title'] = $this->getTitle();
        }

        if ($this->getRecipientEmail()) {
            $requestData['recipient_email'] = $this->getRecipientEmail();
        }

        if ($this->getFields()) {
            $requestData['fields'] = $this->getFields();
        }

        return $requestData;
    }

}