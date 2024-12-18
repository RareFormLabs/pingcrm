<?php

namespace modules\frontend\controllers;

use Craft;
use craft\helpers\UrlHelper;
use yii\base\DynamicModel;

class ContactController extends BaseController
{

    public function actionForm()
    {

        $user = Craft::$app->user->identity;

        return $this->render('Contact/Form', [
            'title' => 'Contact',
            'message' => [
                'name' => $user->name ?? '',
                'email' => $user->email ?? '',
                'text' => ''
            ]
        ]);
    }

    public function actionSend()
    {

        $model = DynamicModel::validateData(Craft::$app->request->getRequiredBodyParam('message'), [
            [['name', 'email', 'text'], 'required'],
            ['name', 'string', 'max' => 30],
            ['email', 'email'],
            ['text', 'string', 'min' => 30],
        ]);

        if ($model->hasErrors()) {
            return $this->render('Contact/Form', [
                'error' => "Could not send message",
                'errors' => $model->errors
            ]);
        }

        // Do something

        Craft::$app->session->setNotice("Message has been sent");
        return Craft::$app->response->redirect(UrlHelper::siteUrl('/contact/confirm'));
    }

    public function actionConfirm()
    {

        $config = Craft::$app->config->custom;

        return $this->render('Contact/Confirm', [
            'title' => 'Confirmation',
            'text' => $config->contactConfirmationMessage,
            'siteInfo' => $this->getSiteInfo(),
            'continueButtons' => $config->contactConfirmationContinueButtons
        ]);
    }
}
