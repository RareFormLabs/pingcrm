<?php

use craft\helpers\App;

return [
  'useDevServer' => App::env('ENVIRONMENT') === 'dev' || App::env('CRAFT_ENVIRONMENT') === 'dev',
  'manifestPath' => '@webroot/dist/.vite/manifest.json',
  'devServerPublic' => 'http://localhost:5173/',
  'serverPublic' => App::env('PRIMARY_SITE_URL') . '/dist/',
  'errorEntry' => '',
  'cacheKeySuffix' => '',
  'devServerInternal' => '',
  'checkDevServer' => false,
  'includeReactRefreshShim' => false,
  'includeModulePreloadShim' => true,
  'criticalPath' => '@webroot/dist/criticalcss',
  'criticalSuffix' => '_critical.min.css',
];