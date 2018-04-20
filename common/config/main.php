<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'aliases'    => [
        '@bower'      => '@vendor/bower-asset',
        '@npm'        => '@vendor/npm-asset',
        '@uploadPath' => '@frontend/web/uploads',
        '@bannerPath' => '@frontend/web/style/img',
    ],
    'components' => [
        'language'       => 'ru-RU', //
        'cache'          => [
            'class' => 'yii\caching\FileCache',
        ],
        'handbook'       => [
            'class' => 'common\components\handbook\Main',
        ],

        'config'         => [
            'class' => 'common\components\settings\Configs',
        ],
        'authManager'    => [
            'class' => 'yii\rbac\DbManager',
        ],

        'accessControll' => [
            'class'   => 'common\components\rbac\Main',
            'branchs' => [
                ['b', '@backend/controllers', 'Админ панель', '\backend\controllers'],
                ['f', '@frontend/controllers', 'Публичная часть', '\frontend\controllers'],
            ],
        ],

    ],
];
