<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=185.69.154.178;dbname=localhost18',
            'username' => 'timurbd',
            'password' => 'timurbd',
            'charset' => 'utf8',
        ],


//        'db' => [
//            'class' => 'yii\db\Connection',
//            'dsn' => 'mysql:host=127.0.0.1;dbname=localhost18',
//            'username' => 'root',
//            'password' => '',
//            'charset' => 'utf8',
//        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
        ],
    ],
];
