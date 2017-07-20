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

class ApiController extends \yii\web\Controller
{
	public $enableCsrfValidation = false;
    public function actionIndex()
    {
        return $this->render('index');
    }

     public function actionPut($key=0)
        {

        if (!Yii::$app->request->isPut && !Yii::$app->request->isGet ) {
               die("not put n not post");
        }
                              

// return data  for get 
        //   select roomw where some=0
if (Yii::$app->request->isGet) {
	          header('Access-Control-Allow-Origin: *');
         header('Content-Type: application/json');

  
if ($key==\Yii::$app->params['upload_pass']) {
  
$customers = Rooms::find()
    ->where(['commercial' => 0])
    ->asArray()->all();
     
}else{
   
   $customers=['errors'=>['wrong key add param key']];
}

   return json_encode( $customers, JSON_UNESCAPED_UNICODE); die();
}

if (Yii::$app->request->isPut) {
     // post      
if (Yii::$app->request->post() !== null) {
          
        
        $r= Yii::$app->request->post() ;                                  
        $r= json_decode(file_get_contents("php://input"));
        
         if (isset($r->key)&$r->key==\Yii::$app->params['upload_pass']) {
                         
                         foreach ($r->id as $key => $value) {
                         	//$customer = new Customer();
      // $room = new Rooms();
       // $total = Rooms::find()->count();

        $room = Rooms::find()->where(['id' => $value])->one();
        $room->commercial=1;
        $room->save();

        // $domria_total = Rooms::find()->where(['site' => 'DR'])->count();
        // $new_urls = 0;

 // $customer = Room::find()
 //    ->where(['id' => $value])
 //    ->one();


// $customer->some = 1;

// $customer->update();

    
                         }


                     return json_encode( ['result'=>'PUTT)--O','postval'=>$r->id[0]], JSON_UNESCAPED_UNICODE);
           }  else{
           	return json_encode( ['result'=>'bad key'], JSON_UNESCAPED_UNICODE);
           	die('bad key');
           }
 }

  die('some error: '.__FILE__." "._LINE__);
 //                    return json_encode( ['result'=>'PUTT)--O','postval'=>$r->id[0]], JSON_UNESCAPED_UNICODE);;
                     
                     
 //                   if (isset($r->id_list)) {
 //                       return json_encode( ['result'=>'PUTT))OO','postval'=>Yii::$app->request->post()], JSON_UNESCAPED_UNICODE);;            
 //                   }

 //         return json_encode( ['result'=>'PUTT22','postval'=>Yii::$app->request->post()], JSON_UNESCAPED_UNICODE);;      	
 //           // $user->setPassword(Yii::$app->request->post('password'));
 //        }else{
 //        	 return json_encode( ['result'=>'Not put','postval'=>Yii::$app->request->post()], JSON_UNESCAPED_UNICODE);; 
 //        }

    
 //    die();
 //        // return $user->save();



 //              $request = Yii::$app->request;
 //      if ($request->isPut) {
 //             return json_encode( ['result'=>'PUTT22'], JSON_UNESCAPED_UNICODE);;
 //      }else {
 //         return json_encode( ['result'=>'Not put'], JSON_UNESCAPED_UNICODE);;    
       }
        }


        /**
     * Upload selected rooms
     *
     * @return mixed
     */
    public function actionUploading($key=0)
    {



 
       $request = Yii::$app->request;
      if ($request->isPut) {
             return json_encode( ['result'=>'PUTT'], JSON_UNESCAPED_UNICODE);;
      }

    if (Yii::$app->request->isPost) {
    
       
    }



         header('Access-Control-Allow-Origin: *');
         header('Content-Type: application/json');

  
if ($key==\Yii::$app->params['upload_pass']) {
  
$customers = Rooms::find()
    ->where(['commercial' => 0])
    ->asArray()->all();
     
}else{
   
   $customers=['errors'=>['wrong key add param key']];
}

   return json_encode( $customers, JSON_UNESCAPED_UNICODE);
}
  


}
