<?php declare(strict_types=1);

namespace datastone\mailchimpSync;

use yii\base\Event;
use craft\base\Model;
use craft\elements\User;
use craft\events\ModelEvent;
use craft\helpers\Queue;
use datastone\mailchimpSync\jobs\SubscribeJob;
use datastone\mailchimpSync\models\Settings;
use datastone\mailchimpSync\services\MailChimpService;

class Plugin extends \craft\base\Plugin
{
    public bool $hasCpSettings = true;

    public function init(): void
    {
        parent::init();

        $this->setComponents([
            'mailchimp' => MailChimpService::class,
        ]);

        Event::on(
            User::class,
            User::EVENT_AFTER_SAVE,
            function (ModelEvent $event) {
                if ($event->sender->firstSave &&
                    \Craft::$app->getRequest()->getParam('register-newsletter') === 'checked'
                ) {
                    Queue::push(new SubscribeJob([
                        'email' => $event->sender->email
                    ]));
                }
            }
        );
    }

    protected function createSettingsModel(): ?Model
    {
        return new Settings();
    }

    protected function settingsHtml(): ?string
    {
        return \Craft::$app->getView()->renderTemplate(
            'datastone-mailchimp-sync/settings',
            [ 'settings' => $this->getSettings() ]
        );
    }
}