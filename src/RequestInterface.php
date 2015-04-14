<?php

namespace Spliced\SurveyMonkey;

use Spliced\SurveyMonkey\Client;
use Guzzle\Http\Message\RequestInterface as HttpRequest;

interface RequestInterface
{
    public function getEndpointUri();

    public function getRequestParameters();

    public function send();

    public function getClient();

    public function setClient(Client $client);
} 