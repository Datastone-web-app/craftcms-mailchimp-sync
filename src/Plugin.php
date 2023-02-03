<?php declare(strict_types=1);

namespace datastone\mailchimpSync;

use yii\base\Event;
use craft\base\Model;
use craft\elements\User;
use craft\events\ModelEvent;

class Plugin extends \craft\base\Plugin
{
    public bool $hasCpSettings = true;

    public function init()
    {
        parent::init();

        $this->setComponents([
            'mailchimp' => \datastone\mailchimpSync\services\MailChimpService::class
        ]);

        Event::on(
            User::class,
            User::EVENT_AFTER_SAVE,
            function (ModelEvent $event) {
                if ($event->sender->firstSave) {
                    if(\Craft::$app->getRequest()->getParam('register-newsletter') === 'checked') {
                        $response = self::getInstance()->mailchimp->registerMember($event->sender->email);
                    }                     
                }
            }
        );
    }

    protected function createSettingsModel(): ?Model
    {
        return new \datastone\mailchimpSync\models\Settings();
    }

    protected function settingsHtml(): ?string
    {
        return \Craft::$app->getView()->renderTemplate(
            'datastone-mailchimp-sync/settings',
            [ 'settings' => $this->getSettings() ]
        );
    }
}