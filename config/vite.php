<?php

use craft\helpers\App;

$isDevEnv = App::env('ENVIRONMENT') === 'dev' || App::env('CRAFT_ENVIRONMENT') === 'dev';

return [
  'useDevServer' => $isDevEnv,
  'manifestPath' => '@webroot/dist/.vite/manifest.json',
  'devServerPublic' => 'http://localhost:5173/',
  'serverPublic' => App::env('PRIMARY_SITE_URL') . '/dist/',
  'errorEntry' => '',
  'cacheKeySuffix' => '',
  'devServerInternal' => 'http://localhost:5173/',
  'checkDevServer' => $isDevEnv,
  'includeReactRefreshShim' => false,
  'includeModulePreloadShim' => true,
  'criticalPath' => '@webroot/dist/criticalcss',
  'criticalSuffix' => '_critical.min.css',
];