<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
//        'user' => [
//            'identityClass' => 'common\models\User',
//            'enableAutoLogin' => true,
//            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
//        ],
        'user' => [
            'identityClass' => 'budyaga\users\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => ['/login'],
        ],


        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => [
                'vkontakte' => [
                    'class' => 'budyaga\users\components\oauth\VKontakte',
                    'clientId' => 'XXX',
                    'clientSecret' => 'XXX',
                    'scope' => 'email'
                ],
                'google' => [
                    'class' => 'budyaga\users\components\oauth\Google',
                    'clientId' => 'XXX',
                    'clientSecret' => 'XXX',
                ],
                'facebook' => [
                    'class' => 'budyaga\users\components\oauth\Facebook',
                    'clientId' => 'XXX',
                    'clientSecret' => 'XXX',
                ],
                'github' => [
                    'class' => 'budyaga\users\components\oauth\GitHub',
                    'clientId' => 'XXX',
                    'clientSecret' => 'XXX',
                    'scope' => 'user:email, user'
                ],
                'linkedin' => [
                    'class' => 'budyaga\users\components\oauth\LinkedIn',
                    'clientId' => 'XXX',
                    'clientSecret' => 'XXX',
                ],
                'live' => [
                    'class' => 'budyaga\users\components\oauth\Live',
                    'clientId' => 'XXX',
                    'clientSecret' => 'XXX',
                ],
                'yandex' => [
                    'class' => 'budyaga\users\components\oauth\Yandex',
                    'clientId' => 'XXX',
                    'clientSecret' => 'XXX',
                ],
                'twitter' => [
                    'class' => 'budyaga\users\components\oauth\Twitter',
                    'consumerKey' => 'XXX',
                    'consumerSecret' => 'XXX',
                ],
            ],
        ],










        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],


        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '/signup' => '/user/user/signup',
                '/login' => '/user/user/login',
                '/logout' => '/user/user/logout',
                '/requestPasswordReset' => '/user/user/request-password-reset',
                '/resetPassword' => '/user/user/reset-password',
                '/profile' => '/user/user/profile',
                '/retryConfirmEmail' => '/user/user/retry-confirm-email',
                '/confirmEmail' => '/user/user/confirm-email',
                '/unbind/<id:[\w\-]+>' => '/user/auth/unbind',
                '/oauth/<authclient:[\w\-]+>' => '/user/auth/index'
            ],
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],

        'view' => [
            'theme' => [
                'pathMap' => [
                 //   '@app/views' => '@vendor/dmstr/yii2-adminlte-asset/example-views/yiisoft/yii2-app'
                      '@app/views' => '@app/views/customizeadminlte/yii2-adminlte-asset/example-views/yiisoft/yii2-app'
// /home/sam/sites/l18yii/frontend/views/customizeadminlte
                ],
            ],
        ]



    ],


    'modules' => [
        'user' => [
            'class' => 'budyaga\users\Module',
            'userPhotoUrl' => 'http://185.69.154.178/uploads/user/photo',
          //  'userPhotoUrl' => 'http://localhost18/uploads/user/photo',
            'userPhotoPath' => '@frontend/web/uploads/user/photo'
        ],
        'gridview' => ['class' => 'kartik\grid\Module']
    ],




    'params' => $params,
];
