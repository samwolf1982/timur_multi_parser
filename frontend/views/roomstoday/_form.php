<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

//use kartik\widgets\FileInput;

// or 'use kartikile\FileInput' if you have only installed yii2-widget-fileinput in isolation
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Roomstoday */
/* @var $form yii\widgets\ActiveForm */

use common\models\Roomstoday;
use yii\helpers\ArrayHelper;

use yii\web\JqueryAsset;


?>

<div class="roomstoday-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php //$form->field($model, 'site_id')->textInput() ?>


    
       <?php
           if (empty($model->site_id) ) {
               echo $form->field($model, 'site_id')->textInput(['readonly' => true, 'value' => 999]); 
           }else{
             echo  $form->field($model, 'site_id')->textInput();
           }

       ?>
   


    <?= $form->field($model, 'shortdistrict')->textInput(['maxlength' => true]) ?>


     <?php 
           if (empty($model->phone) ) {
               echo $form->field($model, 'phone')->textInput(['maxlength' => true,'title' => 'Номера телефонов разделять "|"   на пример: 38999999999|3809999999','placeholder'=>'38999999999|3809999999']);
           }else{
             echo  $form->field($model, 'phone')->textInput();
           }
     ?>
   

    <?= $form->field($model, 'price')->textInput() ?>



    
<?php
     if (empty($model->currency) ) {
               echo $form->field($model, 'currency')->dropDownList([
    'грн' => 'грн',
    '$' => '$']);
           }else{
             echo  $form->field($model, 'currency')->textInput();
           }

?>


    <?= $form->field($model, 'price_m')->textInput() ?>

    <?= $form->field($model, 'count_rooms')->textInput() ?>

    <?= $form->field($model, 'square')->textInput() ?>

    <?= $form->field($model, 'floor')->textInput() ?>

    <?= $form->field($model, 'floors')->textInput() ?>

      <?= $form->field($model, 'sqare_total')->textInput() ?>
      <?= $form->field($model, 'sqare_live')->textInput() ?>
      <?= $form->field($model, 'sqare_kitchen')->textInput() ?>

        


<?php
     if (empty($model->type) ) {
               echo $form->field($model, 'type')->dropDownList([
    'Вторичный рынок ' => 'Вторичный рынок ',
    'Новостройки' => 'Новостройки',
    'Не определено' => 'Не определено',]);
           }else{
             echo  $form->field($model, 'type')->textInput();
           }

?>

      


    <?= $form->field($model, 'district')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'street')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'street2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>



<?php
     if (empty($model->state) ) {
               echo $form->field($model, 'state')->textInput(['readonly' => true, 'value' => 'Создан']);
           }else{
             echo  $form->field($model, 'state')->textInput();
           }

?>



<?php

           if (empty($model->material) ) {
              $db=Roomstoday::getDb();


   $material = $db->cache(function ($db) {
    return ArrayHelper::map( Roomstoday::find()->select('material')->orderBy('material')->asArray()->all(), 'material', 'material');  
});


   echo $form->field($model, 'material')->dropDownList($material);



           }else{
             echo  $form->field($model, 'material')->textInput();
           }
     




?>
    <?php //$form->field($model, 'material')->textInput(['maxlength' => true]) ?>



<?php
     if (empty($model->own_or_business) ) {
               echo $form->field($model, 'own_or_business')->dropDownList([
    'Частного лица' => 'Частного лица',
    'Бизнес' => 'Бизнес',
    'Не определено' => 'Не определено',]);
           }else{
             echo  $form->field($model, 'own_or_business')->textInput();
           }

?>



    <?php //$form->field($model, 'own_or_business')->textInput(['maxlength' => true]) ?>

       

       <?php
           if ($model->manager=='********' || empty($model->manager) ) {
               echo $form->field($model, 'manager')->textInput(['readonly' => true, 'value' => Yii::$app->user->identity->username]); 
           }else{
             echo  $form->field($model, 'manager')->textInput(['readonly' => true, 'value' => $model->manager]); 
           }

       ?>
   

 

    <?= $form->field($model, 'coment')->textInput(['maxlength' => true]) ?>



 
    <?= $form->field($model, 'url')->textarea(['readonly' => true,'rows' => 6]) ?>

    <?= $form->field($model, 'site')->textInput(['readonly' => true,'maxlength' => true]) ?>






<label class="control-label">Planets and Satellites</label>
<input id="input-24" name="img2[]" type="file" multiple class="file-loading">
   <?php
   // Usage with ActiveForm and model
   
 if ( !empty($model->img) ) {

                $img_arr=json_decode($model->img,true);
               $keys=array_keys($img_arr);



               // foreach ($keys as $k => $v) {
               //  $arr_captions[]=['caption'=>$k.'.jpg','size'=>500];
$img_arr_str="'";
$img_arr_str.=implode($img_arr,"','");
 $img_arr_str.="'";
 $img_arr_keys_str_n=range(0, count($img_arr)-1);

  
  $img_arr_keys_str=implode($img_arr_keys_str_n,"},{ key:");
  $img_arr_keys_str_r="{ key:".$img_arr_keys_str."}";



$del_url=Url::toRoute(['roomstoday/delfileinput','id'=>$model->id]);
$upload_url=Url::toRoute(["roomstoday/upload",'id'=>$model->id]);
//Yii::trace($del_url);
$jsss=<<<EOT

    $("#input-24").fileinput({
        initialPreview: [
            $img_arr_str
        ],
        initialPreviewAsData: true,
        initialPreviewConfig: [
             $img_arr_keys_str_r
        ],
        deleteUrl: "$del_url",
        overwriteInitial: false,
        maxFileSize: 1000,
        initialCaption: "Список фото",
        allowedFileTypes: ["image", "video"],
        maxFilePreviewSize: 50240,
         uploadUrl: "$upload_url", // server upload action
    uploadAsync: true,

    });


$('#input-24').on('filepredelete', function(event, key,data) {
    console.log('Key = ' + key);
     var arr=  jQuery.parseJSON( $('#roomstoday-img').text());
      // var dt= jQuery.parseJSON( data.responseText);
       console.log(data);
});




    $('#input-24').on('filedeleted', function(event, key,data) {
      //$('#roomstoday-img').text();

     var arr=  jQuery.parseJSON( $('#roomstoday-img').text());
     var dt= jQuery.parseJSON( data.responseText); 

var search_index=0;
     $.each(arr,function( index, el ) {
          if(el==dt.img){
            console.log('find!!');
            search_index=index;
            return;
          }
  });

    


       
      //  delete arr[key];
arr.splice(search_index, 1);

console.log('len = ' + arr.length);
            if(arr.length==0){
              $('#roomstoday-img').text('');
            }else{
                $('#roomstoday-img').text(  JSON.stringify(arr));
                  }
    console.log('zzKey = ' + key);
});

// upload
$('#input-24').on('fileuploaded', function(event, data, previewId, index) {
    var form = data.form, files = data.files, extra = data.extra,
        response = data.response, reader = data.reader;
 var arr=  jQuery.parseJSON( $('#roomstoday-img').text());
 // console.log(data.response.full_path);
 //var dt= jQuery.parseJSON(data); 


 //arr.push(dt.full_path);

console.log(data);
 $.each(data.response.full_paths,function( index, element ) {
   arr.push(element);
  });



 $('#roomstoday-img').text( JSON.stringify(arr));

    console.log('File uploaded triggered');
});

EOT;
   $this->registerJs($jsss
  ,$this::POS_READY
);














//}
 // else for if empty img  
     }else{
     
               // $img_arr=json_decode($model->img,true);
               // $keys=array_keys($img_arr);



               // foreach ($keys as $k => $v) {
               //  $arr_captions[]=['caption'=>$k.'.jpg','size'=>500];
// $img_arr_str="'";
// $img_arr_str.=implode($img_arr,"','");
//  $img_arr_str.="'";
//  $img_arr_keys_str_n=range(0, count($img_arr)-1);

  
//   $img_arr_keys_str=implode($img_arr_keys_str_n,"},{ key:");
//   $img_arr_keys_str_r="{ key:".$img_arr_keys_str."}";



$del_url=Url::toRoute(['roomstoday/delfileinput','id'=>$model->id]);
$upload_url=Url::toRoute(["roomstoday/upload",'id'=>"-1"]);
//Yii::trace($del_url);
$jsss=<<<EOT

    $("#input-24").fileinput({
    
        initialPreviewAsData: true,
     
        deleteUrl: "$del_url",
        overwriteInitial: false,
        maxFileSize: 1000,
        initialCaption: "Список фото",
        allowedFileTypes: ["image", "video"],
        maxFilePreviewSize: 50240,
         uploadUrl: "$upload_url", // server upload action
    uploadAsync: true,

    });


$('#input-24').on('filepredelete', function(event, key,data) {
    console.log('Key = ' + key);
     var arr=  jQuery.parseJSON( $('#roomstoday-img').text());
      // var dt= jQuery.parseJSON( data.responseText);
       console.log(data);
});




    $('#input-24').on('filedeleted', function(event, key,data) {
      //$('#roomstoday-img').text();

     var arr=  jQuery.parseJSON( $('#roomstoday-img').text());
     var dt= jQuery.parseJSON( data.responseText); 

var search_index=0;
     $.each(arr,function( index, el ) {
          if(el==dt.img){
            console.log('find!!');
            search_index=index;
            return;
          }
  });

    


       
      //  delete arr[key];
arr.splice(search_index, 1);

console.log('len = ' + arr.length);
            if(arr.length==0){
              $('#roomstoday-img').text('');
            }else{
                $('#roomstoday-img').text(  JSON.stringify(arr));
                  }
    console.log('zzKey = ' + key);
});

// upload
$('#input-24').on('fileuploaded', function(event, data, previewId, index) {
    var form = data.form, files = data.files, extra = data.extra,
        response = data.response, reader = data.reader;
        if($('#roomstoday-img').text()==''){
          var arr =new Array();
        }else{
          var arr=  jQuery.parseJSON( $('#roomstoday-img').text()); 
        }

 // console.log(data.response.full_path);
 //var dt= jQuery.parseJSON(data); 


 //arr.push(dt.full_path);

console.log(data);
 $.each(data.response.full_paths,function( index, element ) {
   arr.push(element);
  });



 $('#roomstoday-img').text( JSON.stringify(arr));

    console.log('File uploaded triggered');
});

EOT;
   $this->registerJs($jsss
  ,$this::POS_READY
);





           }


    






//Yii->trace

//$this->registerJsFile('@app/assets/js/upload.js');

?>

<?php






?>

    <?=  $form->field($model, 'img')->textarea(['rows' => 6]) ?>

      <?php
           if ( empty($model->date) ) {
               echo $form->field($model, 'date')->textInput(['readonly' => true, 'value' => date("Y-m-d H:i:s")]); 
           }else{
             echo  $form->field($model, 'date')->textInput(['readonly' => true, 'value' => $model->date]); 
           }

       ?>


    <?// $form->field($model, 'date')->widget(\yii\jui\DatePicker::classname(), [
    //'language' => 'ru',
   // 'dateFormat' => 'yyyy-MM-dd',
//])
 ?>




    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
