<?php

use yii\helpers\Html;
use yii\helpers\Url;
//use yii\grid\GridView;
use yii\widgets\Pjax;

use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use frontend\models\Rooms;

use kartik\sidenav\SideNav;
/* @var $this yii\web\View */
/* @var $searchModel app\models\RoomsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = "Лента";

$this->params['breadcrumbs'][] = $this->title;


//\Yii::trace(["own: ", $max_date,'compare'=>$resdt ] );

?>












<div class="rooms-index">


<!-- Columns are always 50% wide, on mobile and desktop -->
<div class="row">
  <div class="col-xs-2">
           
         <?php
//echo SideNav::widget([
//    'type' => SideNav::TYPE_DEFAULT,
//    'heading' => 'Меню',
//    'items' => [
//        [
//            'label' => 'К меню',
//            'icon' => 'question-sign',
//            'items' => [
//                ['label' => 'Новые за сегодня', 'icon'=>'info-sign', 'url'=>Url::toRoute('roomstoday/index')],
//                   ['label' => 'Мои сохраненные', 'icon'=>'info-sign', 'url'=>Url::toRoute('ownsave/index')],
//                      ['label' => 'Наши сохраненные', 'icon'=>'info-sign', 'url'=>Url::toRoute('ownsave/oursave')],
//                         ['label' => 'Мои добавленные', 'icon'=>'info-sign', 'url'=>Url::toRoute('ownsave/ownadd')],
//                         ['label' => 'Наши добавленные', 'icon'=>'info-sign', 'url'=>Url::toRoute('ownsave/ouradd')],
//                            ['label' => 'Первоисточник', 'icon'=>'info-sign', 'url'=>'#'],
//
//            ],
//        ],
//    ],
//]);
?>

     </div>
       <div class="col-xs-2">
           <div>
<!--       <form class="form-horizontal">-->
<!---->
<!--  <div class="form-group">-->
<!--   -->
<!--    <div class="col-sm-10 pull-right"> -->
<!--      <input type="text" class="form-control " id="searchfiled" placeholder="Поиск...">-->
<!--    </div>-->
<!--  </div>-->
<!---->
<!--  <div class="form-group"> -->
<!--    <div class="col-sm-offset-2 col-sm-10">-->
<!--      <button type="submit" class="btn btn-default pull-right">Найти</button>-->
<!--    </div>-->
<!--  </div>-->
<!--</form>-->

     </div>

  </div>


         <div class="col-xs-8">


  </div>



<!--   <div class="col-xs-4 text-center" >
         <h1><?= Html::encode($this->title) ?></h1>

  </div> -->



</div>







 
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
     <?php // Html::a('Сбросить кеш', ['flush'], ['class' => 'btn btn-success ']) ?>
        <?= Html::a('Create Rooms', ['roomstoday/create'], ['class' => 'btn btn-success  pull-left']) ?>
    
    
    
    </p>
<div class="clearfix"></div>

    <section>
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Hover Data Table</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">




                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'responsive'=>true,
                        'resizableColumns'=>true,
                        'hover'=>true,
                        'pjax'=>false,
                        'pjaxSettings'=>[
                            'neverTimeout'=>true,
                            'beforeGrid'=>'My fancy content before.',
                            'afterGrid'=>'My fancy content after.',

                            ],


                        //'hover'=>true,
                        'exportConfig'=>[
                            GridView::CSV => [
                                'label' => "Save as CSV",
                                'icon' => true? 'file-code-o' : 'floppy-open',
                                'iconOptions' => ['class' => 'text-primary'],
                                'showHeader' => true,
                                'showPageSummary' => true,
                                'showFooter' => true,
                                'showCaption' => true,
                                'filename' => "export",
                                'alertMsg' => "error",
                                'options' => ['title' =>"export file",
                                    'mime' => 'application/csv',
                                    'config' => [
                                        'colDelimiter' => ",",
                                        'rowDelimiter' => "\r\n",
                                    ]
                                ],],],

                        'toolbar'=>[
                            '{export}',
                            '{toggleData}'
                        ],

                        'panel' => [
                            'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-home"></i> Квартиры</h3>',
                            'type'=>'success',
                            'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
                            'footer'=>true,
                        ],
                        'columns' => [

                            ['class' => 'yii\grid\ActionColumn' ,'template' => '{view} {update}']
                            ,




                            [
                                'attribute'=>'manager',
                                'width'=>'250px',
                                'value'=>function ($model, $key, $index, $widget) {
                                    return $model->manager;
                                },
                                'filterType'=>GridView::FILTER_SELECT2,
                                // 'filter'=>ArrayHelper::map(Rooms::find()->select('own_or_business')->orderBy('own_or_business')->asArray()->all(), 'own_or_business', 'own_or_business'),
                                'filter'=>$manager,
                                'filterWidgetOptions'=>[
                                    'pluginOptions'=>['allowClear'=>true],
                                ],
                                'filterInputOptions'=>['placeholder'=>'Менеджер']
                            ],

//                            [
//                                'attribute'=>'manager',
//                                'width'=>'250px',
//                                'value'=>function ($model, $key, $index, $widget) {
//                                    return $model->manager;
//                                },
//                                'filterType'=>GridView::FILTER_SELECT2,
//                                // 'filter'=>ArrayHelper::map(Rooms::find()->select('own_or_business')->orderBy('own_or_business')->asArray()->all(), 'own_or_business', 'own_or_business'),
//                                'filter'=>$manager,
//                                'filterWidgetOptions'=>[
//                                    'pluginOptions'=>['allowClear'=>true],
//                                ],
//                                'filterInputOptions'=>['placeholder'=>'Менеджер']
//                            ],


















                            [
                                'attribute'=>'site',
                                'format' => 'raw',
                                'width'=>'250px',
                                'value'=>function ($model, $key, $index, $widget) {
                                    //return $model->site;
                                    return Html::a($model->site,$model->url);
                                },
                                'filterType'=>GridView::FILTER_SELECT2,

                                'filter'=>  $site,
                                'filterWidgetOptions'=>[
                                    'pluginOptions'=>['allowClear'=>true],
                                ],
                                'filterInputOptions'=>['placeholder'=>'Сайт']
                            ],

                            [
                                'attribute'=>'own_or_business',
                                'width'=>'250px',
                                'value'=>function ($model, $key, $index, $widget) {
                                    return $model->own_or_business;
                                },
                                'filterType'=>GridView::FILTER_SELECT2,
                                // 'filter'=>ArrayHelper::map(Rooms::find()->select('own_or_business')->orderBy('own_or_business')->asArray()->all(), 'own_or_business', 'own_or_business'),
                                'filter'=>$own_or_business,
                                'filterWidgetOptions'=>[
                                    'pluginOptions'=>['allowClear'=>true],
                                ],
                                'filterInputOptions'=>['placeholder'=>'Any category']
                            ],





                            //        [
                            //        'label'=>'Ссылка',
                            //        'format' => 'raw',
                            //    'value'=>function ($data) {
                            //          return Html::a($data->site,$data->url);
                            //     },
                            // ],

                            [
                                'attribute'=>'shortdistrict',
                                'class' => 'kartik\grid\DataColumn',
                                'noWrap' => false,

                                'contentOptions' =>
                                    ['style'=>'max-width: 350px;     max-height: 120px; overflow: auto; white-space: pre-wrap; /* css-3 */
 white-space: -moz-pre-wrap; 
 white-space: -pre-wrap; 
 white-space: -o-pre-wrap; 
 word-wrap: break-word; ']
                                ,


                            ],



//                            [
//                                'attribute'=> 'phone',
//                                'class' => 'kartik\grid\DataColumn',
//                                'noWrap' => false,
//
//                                'value'=>function ($model, $key, $index, $widget) {
//                                    return  str_replace('|', PHP_EOL, $model->phone);
//
//                                },
//
//                                'contentOptions' =>
//                                    ['style'=>'max-width: 350px;     max-height: 120px; overflow: auto; white-space: pre-wrap; /* css-3 */
// white-space: -moz-pre-wrap;
// white-space: -pre-wrap;
// white-space: -o-pre-wrap;
// word-wrap: break-word; ']
//                                ,
//
//
//                            ],











                            [
                                'attribute'=>'street',
                                'class' => 'kartik\grid\DataColumn',
                                'noWrap' => false,

                                'contentOptions' =>
                                    ['style'=>'min-width: 120px;     max-height: 120px; overflow: auto; white-space: pre-wrap; /* css-3 */
 white-space: -moz-pre-wrap; 
 white-space: -pre-wrap; 
 white-space: -o-pre-wrap; 
 word-wrap: break-word; ']
                                ,


                            ],




//                            [
//                                'attribute'=>'price',
//                                'class' => 'kartik\grid\DataColumn',
//                                'noWrap' => false,
//
//                                'value'=>function ($model, $key, $index, $widget) {
////                                    return $model->count_rooms;
//                                    return $model->price .' /  '.$model->price_m;
//                                },
//
//                                'contentOptions' =>
//                                    ['style'=>'min-width: 140px;     max-height: 120px;  overflow: auto; white-space: pre-wrap; /* css-3 */
// white-space: -moz-pre-wrap;
// white-space: -pre-wrap;
// white-space: -o-pre-wrap;
// word-wrap: break-word; ']
//                                ,
//
//
//                            ],




                            [
                                'attribute'=>'price',
                                'class' => 'kartik\grid\DataColumn',
                                'noWrap' => false,

                                'contentOptions' =>
                                    ['style'=>'min-width: 140px;     max-height: 120px;  overflow: auto; white-space: pre-wrap; /* css-3 */
 white-space: -moz-pre-wrap; 
 white-space: -pre-wrap; 
 white-space: -o-pre-wrap; 
 word-wrap: break-word; ']
                                ,


                            ],
                            [
                                'attribute'=>'price_m',
                                'class' => 'kartik\grid\DataColumn',
                                'noWrap' => false,

                                'contentOptions' =>
                                    ['style'=>'min-width: 90px;     max-height: 120px;  overflow: auto; white-space: pre-wrap; /* css-3 */
 white-space: -moz-pre-wrap; 
 white-space: -pre-wrap; 
 white-space: -o-pre-wrap; 
 word-wrap: break-word; ']
                                ,


                            ],





                            [
                                'attribute'=>'currency',
                                'width'=>'250px',
                                'value'=>function ($model, $key, $index, $widget) {
                                    return $model->currency;
                                },
                                'filterType'=>GridView::FILTER_SELECT2,

                                'filter'=>  $currency,
                                'filterWidgetOptions'=>[
                                    'pluginOptions'=>['allowClear'=>true],
                                ],
                                'filterInputOptions'=>['placeholder'=>'Валюта']
                            ],











                            'square',

                            [
                                'attribute'=>'floor',
                                'width'=>'250px',
                                'value'=>function ($model, $key, $index, $widget) {
                                    return $model->floor;
                                },
                                'filterType'=>GridView::FILTER_SELECT2,
                                // 'filter'=>ArrayHelper::map(Rooms::find()->select('floor')->orderBy('floor')->asArray()->all(), 'floor', 'floor'),
                                'filter'=>$floor,
                                'filterWidgetOptions'=>[
                                    'pluginOptions'=>['allowClear'=>true],
                                ],
                                'filterInputOptions'=>['placeholder'=>'Этаж']
                            ],


                            [
                                'attribute'=>'floors',
                                'width'=>'250px',
                                'value'=>function ($model, $key, $index, $widget) {
                                    return $model->floors;
                                },
                                'filterType'=>GridView::FILTER_SELECT2,
                                // 'filter'=>ArrayHelper::map(Rooms::find()->select('floors')->orderBy('floors')->asArray()->all(), 'floors', 'floors'),
                                'filter'=>$floors,
                                'filterWidgetOptions'=>[
                                    'pluginOptions'=>['allowClear'=>true],
                                ],
                                'filterInputOptions'=>['placeholder'=>'Этажность']
                            ],


                            [
                                'attribute'=>'type',
                                'width'=>'250px',
                                'value'=>function ($model, $key, $index, $widget) {
                                    return $model->type;
                                },
                                'filterType'=>GridView::FILTER_SELECT2,
                                // 'filter'=>ArrayHelper::map(Rooms::find()->select('floors')->orderBy('floors')->asArray()->all(), 'floors', 'floors'),
                                'filter'=>$type,
                                'filterWidgetOptions'=>[
                                    'pluginOptions'=>['allowClear'=>true],
                                ],
                                'filterInputOptions'=>['placeholder'=>'Тип']
                            ],





                            [
                                'attribute'=>'description',
                                'class' => 'kartik\grid\DataColumn',
                                'noWrap' => true,

                                'contentOptions' =>
                                    ['style'=>'max-width: 300px;     max-height: 120px;  width: 200px;
    height: 100px;
    
      overflow: -moz-hidden-unscrollable;
     overflow: scroll;
 white-space: -moz-pre-wrap; 
 white-space: -pre-wrap; 
 white-space: -o-pre-wrap; 
 word-wrap: break-word;
 
     text-overflow: inherit;
 
 white-space: pre;
 overflow: -moz-hidden-unscrollable;
  '
                                    ]
                                ,


                            ],




                            [
                                'attribute'=> 'state',
                                'width'=>'250px',
                                'value'=>function ($model, $key, $index, $widget) {
                                    return $model->state;
                                },
                                'filterType'=>GridView::FILTER_SELECT2,
                                // 'filter'=>ArrayHelper::map(Rooms::find()->select('own_or_business')->orderBy('own_or_business')->asArray()->all(), 'own_or_business', 'own_or_business'),
                                'filter'=>$state,
                                'filterWidgetOptions'=>[
                                    'pluginOptions'=>['allowClear'=>true],
                                ],
                                'filterInputOptions'=>['placeholder'=>'Any category']
                            ],











                            [
                                'attribute'=>'coment',
                                'class' => 'kartik\grid\DataColumn',
                                'noWrap' => false,

                                'contentOptions' =>
                                    ['style'=>'max-width: 50px;     max-height: 120px; width:50px; overflow: auto; white-space: pre-wrap; /* css-3 */
 white-space: -moz-pre-wrap; 
 white-space: -pre-wrap; 
 white-space: -o-pre-wrap; 
 word-wrap: break-word; ']
                                ,
                            ],




                            [
                                'attribute'=>'count_rooms',
                                'width'=>'250px',
                                'value'=>function ($model, $key, $index, $widget) {
                                    return $model->count_rooms;
                                },
                                'filterType'=>GridView::FILTER_SELECT2,

                                'filter'=>  $count_room,
                                'filterWidgetOptions'=>[
                                    'pluginOptions'=>['allowClear'=>true],
                                ],
                                'filterInputOptions'=>['placeholder'=>'Комнаты'],
                                'contentOptions' =>
                                    ['style'=>'max-width: 150px;     max-height: 120px; overflow: auto; white-space: pre-wrap; /* css-3 */
 white-space: -moz-pre-wrap; 
 white-space: -pre-wrap; 
 white-space: -o-pre-wrap; 
 word-wrap: break-word; ']
                                ,
                            ],






                            [
                                'attribute'=>'street2',
                                'class' => 'kartik\grid\DataColumn',
                                'noWrap' => false,

                                'contentOptions' =>
                                    ['style'=>'min-width: 120px;     max-height: 120px; overflow: auto; white-space: pre-wrap; /* css-3 */
 white-space: -moz-pre-wrap; 
 white-space: -pre-wrap; 
 white-space: -o-pre-wrap; 
 word-wrap: break-word; ']
                                ,


                            ],








                            [
                                'attribute'=>'district',
                                'width'=>'250px',
                                'value'=>function ($model, $key, $index, $widget) {
                                    return $model->district;
                                },
                                'filterType'=>GridView::FILTER_SELECT2,

                                'filter'=>  $district,
                                'filterWidgetOptions'=>[
                                    'pluginOptions'=>['allowClear'=>true],
                                ],
                                'filterInputOptions'=>['placeholder'=>'Город']
                            ],


                            [
                                'attribute'=>'material',
                                'width'=>'250px',
                                'value'=>function ($model, $key, $index, $widget) {
                                    return $model->material;
                                },
                                'filterType'=>GridView::FILTER_SELECT2,

                                'filter'=>  $material,
                                'filterWidgetOptions'=>[
                                    'pluginOptions'=>['allowClear'=>true],
                                ],
                                'filterInputOptions'=>['placeholder'=>'Материал'],
                                'contentOptions' =>
                                    ['style'=>'max-width: 250px;     max-height: 120px; overflow: auto; white-space: pre-wrap; /* css-3 */
 white-space: -moz-pre-wrap; 
 white-space: -pre-wrap; 
 white-space: -o-pre-wrap; 
 word-wrap: break-word; ']
                                ,

                            ],







                            [
                                'attribute'=>'site_id',
                                'class' => 'kartik\grid\DataColumn',
                                'noWrap' => false,
                                'contentOptions' =>
                                    ['style'=>'max-width: 50px;     max-height: 120px; width:50px; overflow: auto; white-space: pre-wrap; /* css-3 */
 white-space: -moz-pre-wrap;
 white-space: -pre-wrap; 
 white-space: -o-pre-wrap; 
 word-wrap: break-word; ']
                                ,
                            ],


                            [
                                'attribute'=> 'date',
                                'class' => 'kartik\grid\DataColumn',
                                'noWrap' => false,

                                'value'=>function ($model, $key, $index, $widget) {
                                    //return  str_replace(' ', PHP_EOL, $model->date);
                                    return $model->date;
                                },

                                'contentOptions' =>
                                    ['style'=>'max-width: 350px;     max-height: 120px; overflow: auto; white-space: pre-wrap; /* css-3 */
 white-space: -moz-pre-wrap; 
 white-space: -pre-wrap; 
 white-space: -o-pre-wrap; 
 word-wrap: break-word; ']
                                ,


                            ],


                            //             [
                            //            'attribute'=>'img',
                            //            'class' => 'kartik\grid\DataColumn',
                            //            'noWrap' => false,

                            //            'contentOptions' =>
                            //            ['style'=>'max-width: 50px;     max-height: 120px; width:50px; overflow: hidden; /* css-3 */
                            // white-space: -moz-pre-wrap;
                            // white-space: -pre-wrap;
                            // white-space: -o-pre-wrap;
                            // word-wrap: break-word; ']
                            //            ,
                            //            ],

                            //            [
                            //            'attribute'=>'url',
                            //            'class' => 'kartik\grid\DataColumn',
                            //            'noWrap' => false,

                            //            'contentOptions' =>
                            //            ['style'=>'max-width: 50px;     max-height: 120px; width:50px; overflow: hidden; /* css-3 */
                            // white-space: -moz-pre-wrap;
                            // white-space: -pre-wrap;
                            // white-space: -o-pre-wrap;
                            // word-wrap: break-word; ']
                            //            ,
                            //            ],





                        ],
                    ]); ?>




        </div>


    </section>










</div>
<style>
.container, .grid-view.hide-resize{
    width: 180%
}

</style>