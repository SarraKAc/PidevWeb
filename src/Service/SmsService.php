<?php
// src/Service/SmsService.php
namespace App\Service;

use Twilio\Rest\Client;

class SmsService
{
    private $client;
    private $from;

    public function __construct(string $sid, string $token, string $from)
    {
        $this->client = new Client($sid, $token);
        $this->from = $from;
    }

    public function sendSms($to, $message): \Twilio\Rest\Api\V2010\Account\MessageInstance
    {
        return $this->client->messages->create(
            $to,
            [
                'from' => $this->from,
                'body' => $message
            ]
        );
    }
}

