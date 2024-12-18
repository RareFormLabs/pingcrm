<?php

namespace modules\frontend\controllers;

use Craft;
use craft\db\Paginator;
use craft\elements\Entry;
use craft\helpers\UrlHelper;
use yii\web\NotFoundHttpException;
use function array_map;

class TopicController extends BaseController
{
    public function actionIndex()
    {

        $entries = Entry::find()
            ->section('topic')
            ->orderBy('title')
            ->all();


        return $this->render('Posts/Index', [
            'title' => 'Topics',
            'entries' => array_map(fn($entry) => [
                'id' => $entry->id,
                'title' => $entry->title,
                'url' => $entry->siteUrl
            ], $entries),
            'showSearch' => false
        ]);
    }

    public function actionTopic($slug)
    {

        $entry = Entry::find()->slug($slug)->one();

        if (!$entry) {
            throw new NotFoundHttpException();
        }

        $entries = Entry::find()
            ->section('post')
            ->topics($entry)
            ->all();

        return $this->render('Posts/Index', [
            'title' => "Topic {$entry->title}",
            'entries' => array_map(fn($entry) => [
                'id' => $entry->id,
                'title' => $entry->title,
                'url' => $entry->siteUrl
            ], $entries),
            'showSearch' => false
        ]);
    }
}
