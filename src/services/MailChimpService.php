<?php declare(strict_types=1);

namespace datastone\mailchimpSync\services;

use datastone\mailchimpSync\Plugin;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use yii\base\Component;

class MailChimpService extends Component
{
     public function registerMember(string $email, ?string $firstName = null, ?string $lastName = null): Response
     {
        $settings = Plugin::getInstance()->getSettings();

        if (!$settings->apiKey || !$settings->listId || !strpos($settings->apiKey, "-")) {
            throw new \Exception("Please fill in your mailchimp credentials at the plugin settings, and make sure the apikey ends with the mailchimp server");
        }

        $payload = [
            "email_address" => "{$email}",
            "status" => "subscribed",
            "merge_fields" => [
                "FNAME" => "{$firstName}",
                "LNAME" => "{$lastName}",
            ]
        ];
 
        $server = substr($settings->apiKey, strpos($settings->apiKey, "-") + 1);

        return (new Client())->post(
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