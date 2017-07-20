<?php

namespace frontend\controllers;

use Yii;
use common\models\Ownsave;
use frontend\models\OwnsaveSearch;
use common\models\UserSave;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\helpers\ArrayHelper;

/**
 * OwnsaveController implements the CRUD actions for Ownsave model.
 */
class OwnsaveController extends Controller
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

    /**
     * Lists all Ownsave models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OwnsaveSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,-1);

           $db=Ownsave::getDb();
$count_room = $db->cache(function ($db) {

    // Результат SQL запроса будет возвращен из кэша если
    // кэширование запросов включено и результат запроса присутствует в кэше
    return ArrayHelper::map( Ownsave::find()->select('count_rooms')->orderBy('count_rooms')->asArray()->all(), 'count_rooms', 'count_rooms');  

});

$floor = $db->cache(function ($db) {

    // Результат SQL запроса будет возвращен из кэша если
    // кэширование запросов включено и результат запроса присутствует в кэше
    return ArrayHelper::map( Ownsave::find()->select('floor')->orderBy('floor')->asArray()->all(), 'floor', 'floor');  

});

$floors = $db->cache(function ($db) {

    // Результат SQL запроса будет возвращен из кэша если
    // кэширование запросов включено и результат запроса присутствует в кэше
    return ArrayHelper::map( Ownsave::find()->select('floors')->orderBy('floors')->asArray()->all(), 'floors', 'floors');  

});
   
   $own_or_business = $db->cache(function ($db) {

    // Результат SQL запроса будет возвращен из кэша если
    // кэширование запросов включено и результат запроса присутствует в кэше
    return ArrayHelper::map( Ownsave::find()->select('own_or_business')->orderBy('own_or_business')->asArray()->all(), 'own_or_business', 'own_or_business');  

});



   $district = $db->cache(function ($db) {

    // Результат SQL запроса будет возвращен из кэша если
    // кэширование запросов включено и результат запроса присутствует в кэше
    return ArrayHelper::map( Ownsave::find()->select('district')->orderBy('district')->asArray()->all(), 'district', 'district');  

});


   $currency = $db->cache(function ($db) {
    return ArrayHelper::map( Ownsave::find()->select('currency')->orderBy('currency')->asArray()->all(), 'currency', 'currency');  
});
   //$currency = ArrayHelper::map( Ownsave::find()->select('currency')->orderBy('currency')->asArray()->all(), 'currency', 'currency');  
   $type = $db->cache(function ($db) {
    return ArrayHelper::map( Ownsave::find()->select('type')->orderBy('type')->asArray()->all(), 'type', 'type');  
});

   $manager = $db->cache(function ($db) {
    return ArrayHelper::map( Ownsave::find()->select('manager')->orderBy('manager')->asArray()->all(), 'manager', 'manager');  
});


   $material = $db->cache(function ($db) {
    return ArrayHelper::map( Ownsave::find()->select('material')->orderBy('material')->asArray()->all(), 'material', 'material');  
});
    
       $site = $db->cache(function ($db) {
    return ArrayHelper::map( Ownsave::find()->select('site')->orderBy('site')->asArray()->all(), 'site', 'site');  
});


       $state = $db->cache(function ($db) {
    return ArrayHelper::map( Ownsave::find()->select( 'state')->orderBy('state')->asArray()->all(), 'state', 'state');  
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
             'title'=>'Мои сохраненные',
            // 'site_id'=>$site_id
             
            
        ]);



    }


//        for OUR SAVE  -1
       public function actionOursave()
    {
        $searchModel = new OwnsaveSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,0);

           $db=Ownsave::getDb();
$count_room = $db->cache(function ($db) {

    // Результат SQL запроса будет возвращен из кэша если
    // кэширование запросов включено и результат запроса присутствует в кэше
    return ArrayHelper::map( Ownsave::find()->select('count_rooms')->orderBy('count_rooms')->asArray()->all(), 'count_rooms', 'count_rooms');  

});

$floor = $db->cache(function ($db) {

    // Результат SQL запроса будет возвращен из кэша если
    // кэширование запросов включено и результат запроса присутствует в кэше
    return ArrayHelper::map( Ownsave::find()->select('floor')->orderBy('floor')->asArray()->all(), 'floor', 'floor');  

});

$floors = $db->cache(function ($db) {

    // Результат SQL запроса будет возвращен из кэша если
    // кэширование запросов включено и результат запроса присутствует в кэше
    return ArrayHelper::map( Ownsave::find()->select('floors')->orderBy('floors')->asArray()->all(), 'floors', 'floors');  

});
   
   $own_or_business = $db->cache(function ($db) {

    // Результат SQL запроса будет возвращен из кэша если
    // кэширование запросов включено и результат запроса присутствует в кэше
    return ArrayHelper::map( Ownsave::find()->select('own_or_business')->orderBy('own_or_business')->asArray()->all(), 'own_or_business', 'own_or_business');  

});



   $district = $db->cache(function ($db) {

    // Результат SQL запроса будет возвращен из кэша если
    // кэширование запросов включено и результат запроса присутствует в кэше
    return ArrayHelper::map( Ownsave::find()->select('district')->orderBy('district')->asArray()->all(), 'district', 'district');  

});


   $currency = $db->cache(function ($db) {
    return ArrayHelper::map( Ownsave::find()->select('currency')->orderBy('currency')->asArray()->all(), 'currency', 'currency');  
});
   //$currency = ArrayHelper::map( Ownsave::find()->select('currency')->orderBy('currency')->asArray()->all(), 'currency', 'currency');  
   $type = $db->cache(function ($db) {
    return ArrayHelper::map( Ownsave::find()->select('type')->orderBy('type')->asArray()->all(), 'type', 'type');  
});

   $manager = $db->cache(function ($db) {
    return ArrayHelper::map( Ownsave::find()->select('manager')->orderBy('manager')->asArray()->all(), 'manager', 'manager');  
});


   $material = $db->cache(function ($db) {
    return ArrayHelper::map( Ownsave::find()->select('material')->orderBy('material')->asArray()->all(), 'material', 'material');  
});
    
       $site = $db->cache(function ($db) {
    return ArrayHelper::map( Ownsave::find()->select('site')->orderBy('site')->asArray()->all(), 'site', 'site');  
});


       $state = $db->cache(function ($db) {
    return ArrayHelper::map( Ownsave::find()->select( 'state')->orderBy('state')->asArray()->all(), 'state', 'state');  
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
             'title'=>'Наши сохраненные',
            // 'site_id'=>$site_id
             
            
        ]);



    }

    //        for OUR SAVE  -1
       public function actionOwnadd()
    {
        $searchModel = new OwnsaveSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,1);

           $db=Ownsave::getDb();
$count_room = $db->cache(function ($db) {

    // Результат SQL запроса будет возвращен из кэша если
    // кэширование запросов включено и результат запроса присутствует в кэше
    return ArrayHelper::map( Ownsave::find()->select('count_rooms')->orderBy('count_rooms')->asArray()->all(), 'count_rooms', 'count_rooms');  

});

$floor = $db->cache(function ($db) {

    // Результат SQL запроса будет возвращен из кэша если
    // кэширование запросов включено и результат запроса присутствует в кэше
    return ArrayHelper::map( Ownsave::find()->select('floor')->orderBy('floor')->asArray()->all(), 'floor', 'floor');  

});

$floors = $db->cache(function ($db) {

    // Результат SQL запроса будет возвращен из кэша если
    // кэширование запросов включено и результат запроса присутствует в кэше
    return ArrayHelper::map( Ownsave::find()->select('floors')->orderBy('floors')->asArray()->all(), 'floors', 'floors');  

});
   
   $own_or_business = $db->cache(function ($db) {

    // Результат SQL запроса будет возвращен из кэша если
    // кэширование запросов включено и результат запроса присутствует в кэше
    return ArrayHelper::map( Ownsave::find()->select('own_or_business')->orderBy('own_or_business')->asArray()->all(), 'own_or_business', 'own_or_business');  

});



   $district = $db->cache(function ($db) {

    // Результат SQL запроса будет возвращен из кэша если
    // кэширование запросов включено и результат запроса присутствует в кэше
    return ArrayHelper::map( Ownsave::find()->select('district')->orderBy('district')->asArray()->all(), 'district', 'district');  

});


   $currency = $db->cache(function ($db) {
    return ArrayHelper::map( Ownsave::find()->select('currency')->orderBy('currency')->asArray()->all(), 'currency', 'currency');  
});
   //$currency = ArrayHelper::map( Ownsave::find()->select('currency')->orderBy('currency')->asArray()->all(), 'currency', 'currency');  
   $type = $db->cache(function ($db) {
    return ArrayHelper::map( Ownsave::find()->select('type')->orderBy('type')->asArray()->all(), 'type', 'type');  
});

   $manager = $db->cache(function ($db) {
    return ArrayHelper::map( Ownsave::find()->select('manager')->orderBy('manager')->asArray()->all(), 'manager', 'manager');  
});


   $material = $db->cache(function ($db) {
    return ArrayHelper::map( Ownsave::find()->select('material')->orderBy('material')->asArray()->all(), 'material', 'material');  
});
    
       $site = $db->cache(function ($db) {
    return ArrayHelper::map( Ownsave::find()->select('site')->orderBy('site')->asArray()->all(), 'site', 'site');  
});


       $state = $db->cache(function ($db) {
    return ArrayHelper::map( Ownsave::find()->select( 'state')->orderBy('state')->asArray()->all(), 'state', 'state');  
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
             'title'=>'Мои созданые',
            // 'site_id'=>$site_id
             
            
        ]);



    }


  //        for OUR SAVE  -1
       public function actionOuradd()
    {
        $searchModel = new OwnsaveSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,2);

           $db=Ownsave::getDb();
$count_room = $db->cache(function ($db) {

    // Результат SQL запроса будет возвращен из кэша если
    // кэширование запросов включено и результат запроса присутствует в кэше
    return ArrayHelper::map( Ownsave::find()->select('count_rooms')->orderBy('count_rooms')->asArray()->all(), 'count_rooms', 'count_rooms');  

});

$floor = $db->cache(function ($db) {

    // Результат SQL запроса будет возвращен из кэша если
    // кэширование запросов включено и результат запроса присутствует в кэше
    return ArrayHelper::map( Ownsave::find()->select('floor')->orderBy('floor')->asArray()->all(), 'floor', 'floor');  

});

$floors = $db->cache(function ($db) {

    // Результат SQL запроса будет возвращен из кэша если
    // кэширование запросов включено и результат запроса присутствует в кэше
    return ArrayHelper::map( Ownsave::find()->select('floors')->orderBy('floors')->asArray()->all(), 'floors', 'floors');  

});
   
   $own_or_business = $db->cache(function ($db) {

    // Результат SQL запроса будет возвращен из кэша если
    // кэширование запросов включено и результат запроса присутствует в кэше
    return ArrayHelper::map( Ownsave::find()->select('own_or_business')->orderBy('own_or_business')->asArray()->all(), 'own_or_business', 'own_or_business');  

});



   $district = $db->cache(function ($db) {

    // Результат SQL запроса будет возвращен из кэша если
    // кэширование запросов включено и результат запроса присутствует в кэше
    return ArrayHelper::map( Ownsave::find()->select('district')->orderBy('district')->asArray()->all(), 'district', 'district');  

});


   $currency = $db->cache(function ($db) {
    return ArrayHelper::map( Ownsave::find()->select('currency')->orderBy('currency')->asArray()->all(), 'currency', 'currency');  
});
   //$currency = ArrayHelper::map( Ownsave::find()->select('currency')->orderBy('currency')->asArray()->all(), 'currency', 'currency');  
   $type = $db->cache(function ($db) {
    return ArrayHelper::map( Ownsave::find()->select('type')->orderBy('type')->asArray()->all(), 'type', 'type');  
});

   $manager = $db->cache(function ($db) {
    return ArrayHelper::map( Ownsave::find()->select('manager')->orderBy('manager')->asArray()->all(), 'manager', 'manager');  
});


   $material = $db->cache(function ($db) {
    return ArrayHelper::map( Ownsave::find()->select('material')->orderBy('material')->asArray()->all(), 'material', 'material');  
});
    
       $site = $db->cache(function ($db) {
    return ArrayHelper::map( Ownsave::find()->select('site')->orderBy('site')->asArray()->all(), 'site', 'site');  
});


       $state = $db->cache(function ($db) {
    return ArrayHelper::map( Ownsave::find()->select( 'state')->orderBy('state')->asArray()->all(), 'state', 'state');  
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
             'title'=>'Наши добавлненные',
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
     * Displays a single Ownsave model.
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
     * Creates a new Ownsave model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Ownsave();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
              $model_user_save = new UserSave();
             $model_user_save->u_id=Yii::$app->user->identity->id; 
          $model_user_save->o_id=$model->id;
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
     * Updates an existing Ownsave model.
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
        // $model = $this->findModel($id);

        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
        //     return $this->redirect(['view', 'id' => $model->id]);
        // } else {
        //     return $this->render('update', [
        //         'model' => $model,
        //     ]);
        // }
    }

    /**
     * Deletes an existing Ownsave model.
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
     * Finds the Ownsave model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Ownsave the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Ownsave::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
