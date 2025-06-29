<?php

namespace App\Services\Notifications;

use Twilio\Rest\Client;

class WhatsappService
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * @var string
     */
    protected $from;

    /**
     * WhatsappService constructor.
     * Initializes the Twilio client with credentials from the environment.
     */
    public function __construct()
    {
        $sid    = env('TWILIO_SID');
        $token  = env('TWILIO_AUTH_TOKEN');
        $this->from = env('TWILIO_WHATSAPP_FROM');

        $this->client = new Client($sid, $token);
    }

    /**
     * Send a WhatsApp message to a given phone number.
     *
     * @param string $to      Recipient phone in international format, e.g. +51912345678
     * @param string $message The message body to send
     * @return \Twilio\Rest\Api\V2010\Account\MessageInstance
     */
    public function sendMessage(string $to, string $message)
    {
        return $this->client->messages->create(
            "whatsapp:{$to}", [
                'from' => $this->from,
                'body' => $message,
            ]
        );
    }
}
