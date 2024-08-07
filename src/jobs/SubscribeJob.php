<?php declare(strict_types=1);

namespace datastone\mailchimpSync\jobs;

use Craft;
use craft\queue\BaseJob;
use datastone\mailchimpSync\Plugin;

class SubscribeJob extends BaseJob
{
    public string $email;

    public function execute($queue): void
    {
        Plugin::getInstance()->mailchimp->registerMember($this->email);
    }

    protected function defaultDescription(): string
    {
        return Craft::t('app', 'Subsribe email to Mailchimp');
    }
}