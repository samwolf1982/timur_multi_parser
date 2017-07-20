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
/**
 * RoomstodayController implements the CRUD actions for Roomstoday model.
 */
class RoomstodayController extends Controller
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


 public function actionPut()
        {
              $request = Yii::$app->request;
      if ($request->isPut) {
             return json_encode( ['result'=>'PUTT22'], JSON_UNESCAPED_UNICODE);;
      }else {
         return json_encode( ['result'=>'Not put'], JSON_UNESCAPED_UNICODE);;    
      }
        }



    /**
     * Lists all Roomstoday models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RoomstodaySearch();
      
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
          //\Yii::info("own: ", var_dump($dataProvider,true));
        
    
        $db=Roomstoday::getDb();
$count_room = $db->cache(function ($db) {

    // Результат SQL запроса будет возвращен из кэша если
    // кэширование запросов включено и результат запроса присутствует в кэше
    return ArrayHelper::map( Roomstoday::find()->select('count_rooms')->orderBy('count_rooms')->asArray()->all(), 'count_rooms', 'count_rooms');  

});

$floor = $db->cache(function ($db) {

    // Результат SQL запроса будет возвращен из кэша если
    // кэширование запросов включено и результат запроса присутствует в кэше
    return ArrayHelper::map( Roomstoday::find()->select('floor')->orderBy('floor')->asArray()->all(), 'floor', 'floor');  

});

$floors = $db->cache(function ($db) {

    // Результат SQL запроса будет возвращен из кэша если
    // кэширование запросов включено и результат запроса присутствует в кэше
    return ArrayHelper::map( Roomstoday::find()->select('floors')->orderBy('floors')->asArray()->all(), 'floors', 'floors');  

});
   
   $own_or_business = $db->cache(function ($db) {

    // Результат SQL запроса будет возвращен из кэша если
    // кэширование запросов включено и результат запроса присутствует в кэше
    return ArrayHelper::map( Roomstoday::find()->select('own_or_business')->orderBy('own_or_business')->asArray()->all(), 'own_or_business', 'own_or_business');  

});



   $district = $db->cache(function ($db) {

    // Результат SQL запроса будет возвращен из кэша если
    // кэширование запросов включено и результат запроса присутствует в кэше
    return ArrayHelper::map( Roomstoday::find()->select('district')->orderBy('district')->asArray()->all(), 'district', 'district');  

});


   $currency = $db->cache(function ($db) {
    return ArrayHelper::map( Roomstoday::find()->select('currency')->orderBy('currency')->asArray()->all(), 'currency', 'currency');  
});
   //$currency = ArrayHelper::map( Roomstoday::find()->select('currency')->orderBy('currency')->asArray()->all(), 'currency', 'currency');  
   $type = $db->cache(function ($db) {
    return ArrayHelper::map( Roomstoday::find()->select('type')->orderBy('type')->asArray()->all(), 'type', 'type');  
});

   $manager = $db->cache(function ($db) {
    return ArrayHelper::map( Roomstoday::find()->select('manager')->orderBy('manager')->asArray()->all(), 'manager', 'manager');  
});


   $material = $db->cache(function ($db) {
    return ArrayHelper::map( Roomstoday::find()->select('material')->orderBy('material')->asArray()->all(), 'material', 'material');  
});
    
       $site = $db->cache(function ($db) {
    return ArrayHelper::map( Roomstoday::find()->select('site')->orderBy('site')->asArray()->all(), 'site', 'site');  
});


       $state = $db->cache(function ($db) {
    return ArrayHelper::map( Roomstoday::find()->select( 'state')->orderBy('state')->asArray()->all(), 'state', 'state');  
});
    
                 




        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'count_room'=>$count_room,
            'floor'=>$floor,
             'floors'=>$floors,
             'own_or_business'=>$own_or_business,
             'district'=>$district,
             'currency'=>$currency,
             'type'=>$type,
             'manager'=>$manager,
             'material'=>$material,
             'site'=>$site,
             'state'=>$state,
             // 'sqare_total'=>$sqare_total,
             // 'sqare_live'=>$sqare_live,
             // 'sqare_kitchen'=>$sqare_kitchen,
            // 'site_id'=>$site_id
     
            
        ]);



    }


   




            public function actionFlush()
    {
       // $this->findModel($id)->delete();
       Yii::$app->cache->flush();

        return $this->redirect(['index']);
    }


    /**
     * Displays a single Roomstoday model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }


    /**
     * Creates a new Roomstoday model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Roomstoday();
//1 проверка или уже сохранен   юзер - квартира
        //2 если нет то тогда сохранить



        if ($model->load(Yii::$app->request->post()) && $model->save()) {
             $model_user_save = new UserSave();
             $model_user_save->u_id=Yii::$app->user->identity->id; 
          $model_user_save->o_id=$model->id;
          $model_user_save->some=1; // для пометки что сообственное
           $model_user_save->validate();

          if ($model_user_save->save()) {
                 \Yii::trace('save ok');  
            }  
            else{
                  \Yii::trace($model_user_save->errors); 
            }

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Roomstoday model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model_user_save = new UserSave();

        $is_pres=UserSave::findOne(['o_id'=>$model->id,'u_id'=>Yii::$app->user->identity->id]);

        //\Yii::trace();
        // wruite to db
        if (is_null($is_pres)) {
          $model_user_save->u_id=Yii::$app->user->identity->id; 
          $model_user_save->o_id=$id;
           
           $model_user_save->validate();

          if ($model_user_save->save()) {
                 \Yii::trace('save ok');  
            }  
            else{
                  \Yii::trace($model_user_save->errors); 
            }
                          
        }

        
        //      Yii::trace($model->attributes() ); 
        // $atr= $model->getAttribute('phone');  
        //      Yii::trace($model->getAttribute('phone') );
        //      $model->setAttribute('phone',123);
        //      $model->phone="987";
          
        //       $model->validate();

        //      Yii::trace($model->getAttribute('phone') );

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
             //delete
             //return $this->render('update', ['model' => $model,]);
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Roomstoday model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

      public function actionDelfileinput($id)
    {
          $output=$_POST;
          $model= $this->findModel($id);
           
          $js= json_decode($model->img,true);
              
//          $model->img;

        echo json_encode(['post'=>$output,'index'=>0,'img'=>$js[$_POST['key']]]);
      
    }
         public function actionUpload($id)
    {
          $output=$_POST;

       if (Yii::$app->request->isPost) {
                  
              $model = new UploadForm();

        if (Yii::$app->request->isPost) {

                   //  $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
        $u_id=Yii::$app->user->identity->id; 
        //  files   
              $today=date("F-j-Y");  
              if($id>=0){
                 $structure = "uploads/{$today}/{$u_id}/{$id}/";
             } else{
                     $dirname = uniqid();
                 $structure = "uploads/{$today}/{$u_id}/create/{$dirname}/";
             }                                                 
             

// To create the nested structure, the $recursive parameter 
// to mkdir() must be specified.

     if (!file_exists($structure)) {
  if (!mkdir($structure, 0777, true)) {
     Yii::trace('Failed to create folders... line: '.__LINE__);
    
}
}         

$pull_paths=[];
for ($i=0; $i <count($_FILES['img2']['tmp_name']) ; $i++) { 
           $tmp=$_FILES['img2']['tmp_name'][$i];
           $nam=$_FILES['img2']['name'][$i];
           move_uploaded_file($tmp, $structure.$nam);   
         $f_path="http://{$_SERVER['HTTP_HOST']}/".Yii::getAlias('@frontend_web');
         $pull_paths[]= $f_path.'/'.$structure.$nam;
                     
}


           // $f_path="http://{$_SERVER['HTTP_HOST']}/".Yii::getAlias('@frontend_web');
           //          echo json_encode(['post'=>$tmp,'index'=>0,'res'=>'like ok','files'=>$_FILES,'full_paths'=>$pull_paths]);
 $f_path="http://{$_SERVER['HTTP_HOST']}/".Yii::getAlias('@frontend_web');
                    echo json_encode(['res'=>'like ok','full_paths'=>$pull_paths]);
die();
            // }
              echo json_encode(['post'=>$output,'index'=>0,'res'=>'like bad','files'=>$_FILES]); die();
        }

       // return $this->render('upload', ['model' => $model]);
        }


          

        echo json_encode(['post'=>$output,'index'=>0,'res'=>'like bad end','files'=>$_FILES]); die();
      
    }
    

    /**
     * Finds the Roomstoday model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Roomstoday the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Roomstoday::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
