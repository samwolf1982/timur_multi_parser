<?php

namespace frontend\controllers;

use Yii;
use common\models\Roomstoday;
use common\models\Rooms;
use common\models\UserSave;
use common\models\UploadForm;
use frontend\models\RoomstodaySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\helpers\ArrayHelper;

use yii\web\UploadedFile;
use yii\web\Response;

use console\controllers\ParserController;
/**
 * RoomstodayController implements the CRUD actions for Roomstoday model.
 */
class ParseolxController extends Controller
{
    
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
  

                'actions' => [
                    'delete' => ['POST'],
                    'uploading' => ['GET', 'POST', 'PUT'],
                    //'*' => ['GET', 'POST', 'PUT'],
                ],
            ],
        ];


    //       return [
    //     'verbs' => [
    //         'class' => VerbFilter::className(),
    //         'actions' => [
    //             'index'  => ['get', 'put', 'post'],
    //             'view'   => ['get', 'put', 'post'],
    //             'create' => ['get', 'put', 'post'],
    //             'update' => ['get', 'put', 'post'],
    //             'uploading' => ['get', 'put', 'post'],
    //             'delete' => ['get', 'put', 'post'],
    //               '*' => ['get', 'put', 'post'],
    //         ]

      //  ,
    //     ],
    // ];
   // }


//     protected function verbs()
// {
//       return [
//             'verbs' => [
//                 'class' => VerbFilter::className(),
//                 'actions' => [
//                     'delete' => ['POST'],
//                     'uploading' => ['GET', 'POST', 'PUT'],
//                     '*' => ['GET', 'POST', 'PUT'],
//                 ],
//             ],
//         ];
}

    public function actionIndex()
    {
        $pc=new ParserController(5,5);
        //$pc->actionColecturlsolxparam(500,1);
        $pc->actionPars();

        echo 'xxxx';

    }



}
