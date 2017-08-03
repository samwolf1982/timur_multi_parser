<?php

namespace frontend\controllers;

use Yii;

class DemoController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {

            Yii::$app->view->theme = new \yii\base\Theme([
//                'pathMap' => ['@app/views' => '@vendor/dmstr/yii2-adminlte-asset/example-views/yiisoft/yii2-app'],
                'pathMap' => ['@app/views' => ''],
                'baseUrl' => '@web',

            ]);
            return true;  // or false if needed
        } else {
            return false;
        }

    }


}
