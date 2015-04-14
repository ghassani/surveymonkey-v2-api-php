<?php

namespace Spliced\SurveyMonkey\Request;

use Guzzle\Http\Message\RequestInterface as HttpRequest;
use Spliced\SurveyMonkey\Client;
use Spliced\SurveyMonkey\RequestInterface;


class GetTemplateList  extends AbstractRequest implements RequestInterface
{

    const ENDPOINT_URI = 'templates/get_template_list';

    protected $requestData = array(
        'page' => 1,
        'page_size' => 1000,
        'language_id' => null,
        'category_id' => null,
        'show_only_available_to_current_user' => false,
        'fields' => array()
    );


    /**
     * @var array - The fields which can be included in the fields parameter
     */
    protected $allowedFields = array(
        'language_id',
        'title',
        'short_description',
        'long_description',
        'is_available_to_current_user',
        'is_featured',
        'is_certified',
        'page_count',
        'question_count',
        'preview_url',
        'category_id',
        'category_name',
        'category_description',
        'date_modified',
        'date_create'
    );


    public function __construct(array $data = array())
    {
        $this->requestData = array_merge($this->requestData, $data);
    }

    /**
     * @return array
     */
    public function getRequestData()
    {
        return $this->requestData;
    }

    /**
     * @param array $requestData
     */
    public function setRequestData($requestData)
    {
        $this->requestData = $requestData;
    }

    /**
     * @return mixed
     */
    public function getLanguageId()
    {
        return $this->get('language_id');
    }

    /**
     * @param mixed $languageId
     */
    public function setLanguageId($languageId)
    {
        $this->set('language_id', $languageId);
    }

    /**
     * @return mixed
     */
    public function getCategoryId()
    {
        return $this->get('category_id');
    }

    /**
     * @param mixed $categoryId
     */
    public function setCategoryId($categoryId)
    {
        $this->set('category_id', $categoryId);
    }

    /**
     * @return mixed
     */
    public function getShowOnlyAvailableToCurrentUser()
    {
        return $this->get('is_available_to_current_user');
    }

    /**
     * @param mixed $showOnlyAvailableToCurrentUser
     */
    public function setShowOnlyAvailableToCurrentUser($showOnlyAvailableToCurrentUser)
    {
        $this->set('is_available_to_current_user', $showOnlyAvailableToCurrentUser);
    }

    /**
     * @return array
     */
    public function getAllowedFields()
    {
        return $this->allowedFields;
    }

    /**
     * @param array $allowedFields
     */
    public function setAllowedFields($allowedFields)
    {
        $this->allowedFields = $allowedFields;
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
        );

        if ($this->getLanguageId()) {
            $requestData['language_id'] = $this->getLanguageId();
        }

        if ($this->getCategoryId()) {
            $requestData['category_id'] = $this->getCategoryId();
        }

        $requestData['show_only_available_to_current_user'] = $this->getShowOnlyAvailableToCurrentUser();


        if ($this->getFields()) {
            $requestData['fields'] = $this->getFields();
        }

        return $requestData;
    }

}