<?php

namespace modules\frontend\controllers;

use craft\elements\Entry;
use craft\elements\GlobalSet;

class SiteController extends BaseController
{
    public function actionIndex(): array|string
    {
        if ($this->checkOnly('randomPosts')) {
            return $this->render('Site/Index', [
                'randomPosts' => $this->_getRandomPosts()
            ]);
        }

        $siteInfo = GlobalSet::find()->handle('siteInfo')->one();

        return $this->render('Site/Index', [
            'title' => $siteInfo->siteIntoTitle,
            'dashboardData' => [
                'text' => $siteInfo->siteIntroText,
                // 'buttons' => $siteInfo->siteIntroButtons
            ]
        ]);
    }

    protected function _getRandomPosts(): array
    {
        $entries = Entry::find()->section('post')->limit(8)->orderBy('rand()')->all();

        return array_map(static fn($entry) => [
            'id' => $entry->id,
            'title' => $entry->title,
            'url' => $entry->siteUrl,
        ], $entries);
    }
}
