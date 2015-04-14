<?php

namespace Spliced\SurveyMonkey;

use Guzzle\Http\Client as HttpClient;


class Client
{

    const BASE_ENDPOINT = 'https://api.surveymonkey.net/v2/';

    protected $httpClient;

    protected $apiKey;

    protected $accessToken;


    public function __construct($apiKey, $accessToken)
    {
        $this->apiKey = $apiKey;
        $this->accessToken = $accessToken;
        $this->httpClient = new HttpClient(static::BASE_ENDPOINT);
    }

    /**
     * @param mixed $accessToken
     */
    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * @param mixed $apiKey
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }


    /**
     * @return \Guzzle\Http\Client
     */
    public function getHttpClient()
    {
        return $this->httpClient;
    }

    /**
     * @param RequestInterface $request
     *
     * @return Response
     */
    public function send(RequestInterface $request)
    {
        $httpRequest = $this->httpClient->post($request->getEndpointUri());

        $httpRequest->setBody(json_encode($request->getRequestParameters()));

        $httpRequest->setHeader('Content-Type', 'application/json')
            ->setHeader('Authorization', 'Bearer ' . $this->getAccessToken());

        $httpRequest->getQuery()->set('api_key', $this->getApiKey());

        try {
            $response = $httpRequest->send();
        } catch(\Exception $e) {
            die($e->getMessage());
        }

        return new Response(json_decode($response->getBody(true), true));
    }

    /**
     * @param       $name
     * @param array $arguments
     */
    public function createRequest($name, array $arguments = array())
    {
        $className = 'Spliced\\SurveyMonkey\\Request\\'.$name;

        if (!class_exists($className)) {
            if (! class_exists($name)) {
                throw new \InvalidArgumentException(sprintf('Could Not Find Request %s', $className));
            } else {
                $className = $name;
            }
        }

        $reflector = new \ReflectionClass($className);

        if (!$reflector->implementsInterface('Spliced\\SurveyMonkey\\RequestInterface')) {
            throw new \InvalidArgumentException(sprintf('%s Should implement RequestInterface', $className));
        }

        $request = $reflector->newInstanceArgs($arguments);

        $request->setClient($this);

        return $request;
    }
}