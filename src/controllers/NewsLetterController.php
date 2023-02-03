<?php declare(strict_types=1);

namespace datastone\mailchimpSync\controllers;

use craft\web\Controller;
use datastone\mailchimpSync\Plugin;
use yii\web\Response;

class NewsLetterController extends Controller
{
    protected array|bool|int $allowAnonymous = true;

    // {{ actionInput('datastone-mailchimp-sync/news-letter/subscribe') }} or {{site_url}}/actions/datastone-mailchimp-sync/news-letter/subscribe
    public function actionSubscribe(): Response
    {
        $this->requirePostRequest();
        $this->requireSiteRequest();
        
        $email = $this->request->getRequiredParam('email');
        $firstName = $this->request->getParam('firstName') ?? '';
        $lastName = $this->request->getParam('lastName') ?? '';

        $response = Plugin::getInstance()->mailchimp->registerMember($email);

        if ($response->getStatusCode() !== 200) {
            $this->setSuccessFlash('Aanmelden op de nieuwsbrief is niet gelukt of je bent al geregistreerd.');
            return $this->redirect(\Craft::$app->getRequest()->referrer);
        }

        $this->setSuccessFlash('Succesvol aangemeld op de nieuwsbrief!');
        return $this->redirect(\Craft::$app->getRequest()->referrer);
    }
}