<?php

namespace modules\frontend\controllers;

use Craft;
use craft\elements\GlobalSet;
use craft\helpers\UrlHelper;

use chasegiunta\inertia\Plugin as Inertia;
use chasegiunta\inertia\web\Controller;
use yii\base\InvalidConfigException;

class BaseController extends Controller
{
    public array|int|bool $allowAnonymous = true;

    public function beforeAction($action): bool
    {

        // $this->requireAdmin();

        parent::beforeAction($action);

        $inertia = Inertia::getInstance();
        if (!$inertia) {
            throw new InvalidConfigException();
        }

        $inertia->share([
            'notice' => Craft::$app->session->getNotice(),
            'error' => Craft::$app->session->getError(),
        ]);

        if (!$this->getOnly()) {
            $inertia->share([
                'siteInfo' => $this->getSiteInfo()
            ]);
        }

        return true;
    }

    public function getSiteInfo()
    {
        $siteInfo = GlobalSet::find()->handle('siteInfo')->one();
        return [
            'siteName' => $siteInfo->siteName ?? 'Inertia',
            'siteUrl' => UrlHelper::siteUrl('/'),
            'mainNav' => Craft::$app->config->custom->siteNav,
            'copyright' => $siteInfo->copyright,
        ];
    }

}
