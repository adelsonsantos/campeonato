<?php

use yii\base\Module;

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'language' => 'pt_BR',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
	
	
		 'assetManager' => [
				'bundles' => [
					'kossmoss\GoogleMaps\GoogleMapsAsset' => [
						'apiKey' => 'AIzaSyDqCuDfulV5kUEzDGXydeHHTIW59P2vRYc',   // get at https://developers.google.com/maps/documentation/javascript/get-api-key
						'language' => 'pt_br', // use language code supported by Google Maps API  (default: en)
					],
					'dosamigos\google\maps\MapAsset' => [
						'options' => [
							'key' => 'AIzaSyDqCuDfulV5kUEzDGXydeHHTIW59P2vRYc',
							'libraries' => 'places',
							'v' => '3.exp',
							'sensor'=> 'true'
						]
					]
				]
			],

        'session' => [
            'timeout' => 10000000000,
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'juBoWkRDf63UTEmvl9MGEP-wFbVzKpMo',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => false,
            'authTimeout' => 10000000000,
            'loginUrl' => 'admin/default/login' // set your login path here
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => true,
            'rules' => [
            ],
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    /*$config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];*/

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
