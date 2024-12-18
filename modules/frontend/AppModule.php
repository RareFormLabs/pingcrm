<?php

namespace modules\frontend;

use Craft;
use craft\elements\Entry;
use craft\events\DefineBehaviorsEvent;
use craft\events\RegisterTemplateRootsEvent;
use craft\events\RegisterUrlRulesEvent;
use craft\web\UrlManager;
use craft\web\View;
use yii\base\Event;
use yii\base\Module;

class AppModule extends Module
{
    public function init()
    {

        // Craft::setAlias('@modules/frontend', $this->getBasePath());

        // Event::on(
        //     UrlManager::class,
        //     UrlManager::EVENT_REGISTER_SITE_URL_RULES,
        //     function (RegisterUrlRulesEvent $event) {
        //         $event->rules = array_merge($event->rules, [
        //             '' => 'frontend/site/index',
        //             'posts' => 'frontend/post/index',
        //             'posts/<slug:[^\/]+>' => 'frontend/post/post',
        //             'topics' => 'frontend/topic/index',
        //             'topics/<slug:[^\/]+>' => 'frontend/topic/topic',
        //             'POST contact' => 'frontend/contact/send',
        //             'contact' => 'frontend/contact/form',
        //             'contact/confirm' => 'frontend/contact/confirm',
        //             'empty' => 'frontend/site/empty'
        //         ]);
        //     }
        // );


        // Event::on(
        //     View::class,
        //     View::EVENT_REGISTER_SITE_TEMPLATE_ROOTS,
        //     function (RegisterTemplateRootsEvent $event) {
        //         $event->roots['frontend'] = __DIR__ . '/templates';
        //     }
        // );

        // Event::on(
        //     Entry::class,
        //     Entry::EVENT_DEFINE_BEHAVIORS,
        //     function (DefineBehaviorsEvent $event) {
        //         $event->behaviors[] = EntryBehavior::class;
        //     }
        // );

        parent::init();
    }
}
