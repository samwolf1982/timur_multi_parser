<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Rooms;
use frontend\models\RoomsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\helpers\ArrayHelper;

/**
 * RoomsController implements the CRUD actions for Rooms model.
 */
class RoomsController extends Controller
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
                ],
            ],
        ];
    }




    //         /**
    //  * Displays a single Rooms model.
    //  * @param integer $id
    //  * @return mixed
    //  */
    // public function actionUpload($id)
    // {
    //   header('Access-Control-Allow-Origin: *');
    //     header('Content-Type: application/json');
    //     $item = array('id' => '98765');

         
    //     return json_encode($item, JSON_UNESCAPED_UNICODE);
       
    // }

  /**
     * Lists all Rooms models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RoomsSearch();
        
      
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
          //\Yii::info("own: ", var_dump($dataProvider,true));
        
    
        $db=Rooms::getDb();
$count_room = $db->cache(function ($db) {

    // Результат SQL запроса будет возвращен из кэша если
    // кэширование запросов включено и результат запроса присутствует в кэше
    return ArrayHelper::map( Rooms::find()->select('count_rooms')->orderBy('count_rooms')->asArray()->all(), 'count_rooms', 'count_rooms');  

});

$floor = $db->cache(function ($db) {

    // Результат SQL запроса будет возвращен из кэша если
    // кэширование запросов включено и результат запроса присутствует в кэше
    return ArrayHelper::map( Rooms::find()->select('floor')->orderBy('floor')->asArray()->all(), 'floor', 'floor');  

});

$floors = $db->cache(function ($db) {

    // Результат SQL запроса будет возвращен из кэша если
    // кэширование запросов включено и результат запроса присутствует в кэше
    return ArrayHelper::map( Rooms::find()->select('floors')->orderBy('floors')->asArray()->all(), 'floors', 'floors');  

});
   
   $own_or_business = $db->cache(function ($db) {

    // Результат SQL запроса будет возвращен из кэша если
    // кэширование запросов включено и результат запроса присутствует в кэше
    return ArrayHelper::map( Rooms::find()->select('own_or_business')->orderBy('own_or_business')->asArray()->all(), 'own_or_business', 'own_or_business');  

});



   $district = $db->cache(function ($db) {

    // Результат SQL запроса будет возвращен из кэша если
    // кэширование запросов включено и результат запроса присутствует в кэше
    return ArrayHelper::map( Rooms::find()->select('district')->orderBy('district')->asArray()->all(), 'district', 'district');  

});


   $currency = $db->cache(function ($db) {
    return ArrayHelper::map( Rooms::find()->select('currency')->orderBy('currency')->asArray()->all(), 'currency', 'currency');  
});
   //$currency = ArrayHelper::map( Rooms::find()->select('currency')->orderBy('currency')->asArray()->all(), 'currency', 'currency');  
   $type = $db->cache(function ($db) {
    return ArrayHelper::map( Rooms::find()->select('type')->orderBy('type')->asArray()->all(), 'type', 'type');  
});

   $manager = $db->cache(function ($db) {
    return ArrayHelper::map( Rooms::find()->select('manager')->orderBy('manager')->asArray()->all(), 'manager', 'manager');  
});


   $material = $db->cache(function ($db) {
    return ArrayHelper::map( Rooms::find()->select('material')->orderBy('material')->asArray()->all(), 'material', 'material');  
});
    
       $site = $db->cache(function ($db) {
    return ArrayHelper::map( Rooms::find()->select('site')->orderBy('site')->asArray()->all(), 'site', 'site');  
});


       $state = $db->cache(function ($db) {
    return ArrayHelper::map( Rooms::find()->select( 'state')->orderBy('state')->asArray()->all(), 'state', 'state');  
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
            // 'site_id'=>$site_id
             
            
        ]);
       
    }


    /**
     * Displays a single Rooms model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    
    //       public function actionFlush()
    // {
    //    // $this->findModel($id)->delete();
    //    Yii::$app->cache->flush();

    //     return $this->redirect(['index']);
    // }



    
          public function actionFlush()
    {
       // $this->findModel($id)->delete();
       Yii::$app->cache->flush();

        return $this->redirect(['index']);
    }





    /**
     * Creates a new Rooms model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Rooms();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Rooms model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Rooms model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Rooms model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Rooms the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Rooms::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
