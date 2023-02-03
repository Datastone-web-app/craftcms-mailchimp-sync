<?php declare(strict_types=1);

namespace datastone\mailchimpSync\services;

use datastone\mailchimpSync\Plugin;
use GuzzleHttp\Client;
use yii\base\Component;

class MailChimpService extends Component
{
     public function registerMember(string $email, ?string $firstName = null, ?string $lastName = null) {
        $settings = Plugin::getInstance()->getSettings();

        $client = new Client();
        
        $payload = [
            "email_address" => "{$email}",
            "status" => "subscribed",
            "merge_fields" => [
                "FNAME" => "{$firstName}",
                "LNAME" => "{$lastName}",
            ]
        ];
        
        $server = substr($settings->apiKey, strpos($settings->apiKey, "-") + 1);

        return $client->post(
            sprintf('https://%s.api.mailchimp.com/3.0/lists/%s/members', $server, $settings->listId),
            [
                'http_errors' => false,
                'json' => $payload,
                'auth' => [
                    'apikey',
                    $settings->apiKey,
                ]
            ]
        );
    }
}