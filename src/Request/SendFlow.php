<?php

namespace Spliced\SurveyMonkey\Request;

use Guzzle\Http\Message\RequestInterface as HttpRequest;
use Spliced\SurveyMonkey\Client;
use Spliced\SurveyMonkey\RequestInterface;


class SendFlow  extends AbstractRequest implements RequestInterface
{

    const ENDPOINT_URI = 'batch/send_flow';

    protected $requestData = array(
        'survey_id' => null,
        'collector' => array(
            'send' => false,
            'type' => 'email',
            'name' => 'New Email Invitation',
            'recipients' => array(

            )
        ),
        'email_message' => array(
            'reply_email' => null,
            'subject' => null,
            'body_text' => null
        )
    );

    public function __construct($surveyId, array $recipients = array())
    {
        $this->requestData['survey_id'] = $surveyId;
        $this->requestData['collector']['recipients'] = $recipients;
    }

    public function setSend( $send)
    {
        $this->requestData['collector']['send'] = $send ? true : false;
        return $this;
    }

    public function getSend()
    {
        return $this->requestData['collector']['send'];
    }

    public function addRecipient($email, $firstName = null, $lastName = null, $customId = null)
    {
        $recipient = array('email' => $email);

        if ($firstName) {
            $recipient['first_name'] = $firstName;
        }

        if ($lastName) {
            $recipient['last_name'] = $lastName;
        }

        if ($customId) {
            $recipient['custom_id'] = $customId;
        }

        $this->requestData['collector']['recipients'][] = $recipient;
    }

    public function setRecipients(array $recipients = array())
    {
        $this->requestData['collector']['recipients'] = $recipients;
        return $this;
    }

    public function getRecipients()
    {
        return $this->requestData['collector']['recipients'];
    }

    public function setEmailMessage($replyEmail = null, $subject = null, $bodyText = null)
    {
        return $this->set('email_message', array(
            'reply_email' => $replyEmail,
            'subject' => $subject,
            'body_text' => $bodyText
        ));
    }

    public function getEmailMessage()
    {
        return $this->get('email_message');
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
        $requestData = $this->requestData;

        if (!$requestData['email_message']['reply_email']) {
            unset($requestData['email_message']['reply_email']);
        }

        if (!$requestData['email_message']['subject']) {
            unset($requestData['email_message']['subject']);
        }

        if (!$requestData['email_message']['body_text']) {
            unset($requestData['email_message']['body_text']);
        }

        if (!$requestData['email_message']) {
            unset($requestData['email_message']);
        }

        return $requestData;
    }


}