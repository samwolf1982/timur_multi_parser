<?php
/**
 * Created by PhpStorm.
 * User: sam
 * Date: 7/20/17
 * Time: 5:15 AM
 */

namespace console\controllers;

use Yii;
use yii\helpers\Html;
use yii\helpers\VarDumper;
use common\models\Rooms;
use common\models\RoomsToCoordinates;
use common\models\Coordinates;
use common\models\Olxstatistic;
use yii\db\Migration;
use yii\web\Response;


Yii::$classMap['phpQuery'] = Yii::getAlias('@backend') .
    '/vendors/phpQuery/phpQuery/phpQuery.php';


class ParserdomriaController extends \yii\console\Controller
{

    //domria_page     1  - 10 количество сраниц для парса

    public function actionFill()
    {
        // Хранить данные в кэше не более 30 мин
        $cache = \Yii::$app->cache;
        $domria_page = $cache->get('domria_page');
        if ($domria_page === false) {
            // срок действия истек или ключ не найден в кэше
           // $cache->delete('datapage');
            $cache->set('domria_page', 3, 60 * 30);
            $domria_page = $cache->get('domria_page');
        }
        if (--$domria_page <= 0) {
            $cache->delete('domria_page');
            die('end colect from 10 url');
        }
        $cache->set('domria_page', $domria_page, 60*20);
        echo  var_dump($domria_page );

    }


    public function actionRunparam($domria_page)
    {
        $dont_know='Не определено';
//        $arr_info['idlist']=[];


//        limit	'20'
//page	'5'
//npage	'0'
//        limit	'20'
//page	'1'
//npage	'0'

//        limit	'20'
//page	'0'
//npage	'0'
        // Хранить данные в кэше не более 30 мин
//        $cache = \Yii::$app->cache;
//        $domria_page = $cache->get('domria_page');
//        if ($domria_page === false) {
//            // срок действия истек или ключ не найден в кэше
//            // $cache->delete('datapage');
//            $cache->set('domria_page', 4, 60 * 30);
//            $domria_page = $cache->get('domria_page');
//        }
//        if (--$domria_page <= 0) {
//            $cache->delete('domria_page');
//            die('end colect from 10 url');
//        }
//        $cache->set('domria_page', $domria_page, 60*20);





        $limit=10;// квартир
        $page=$domria_page; // cтраница от 10 - 1
        $path="https://dom.ria.com/searchEngine/?page={$page}&new_search=1&limit={$limit}&from_realty_id=&to_realty_id=&sort=0&category=1&realty_type=0&operation_type=1&state_id=12&city_id%5B20%5D=12&characteristic%5B209%5D%5Bfrom%5D=&characteristic%5B209%5D%5Bto%5D=&characteristic%5B214%5D%5Bfrom%5D=&characteristic%5B214%5D%5Bto%5D=&characteristic%5B216%5D%5Bfrom%5D=&characteristic%5B216%5D%5Bto%5D=&characteristic%5B218%5D%5Bfrom%5D=&characteristic%5B218%5D%5Bto%5D=&characteristic%5B227%5D%5Bfrom%5D=&characteristic%5B227%5D%5Bto%5D=&characteristic%5B228%5D%5Bfrom%5D=&characteristic%5B228%5D%5Bto%5D=&characteristic%5B234%5D%5Bfrom%5D=&characteristic%5B234%5D%5Bto%5D=&characteristic%5B242%5D=239&characteristic%5B265%5D=0&realty_id_only=&date_from=&date_to=&with_phone=&exclude_my=&new_housing_only=&banks_only=&email=&period=0";
        $responce_domria = @file_get_contents($path,true);
        $root_site='https://dom.ria.com/ru/';

        if( !$responce_domria   ){$responce_domria='empty responce BAD !!';}
        else{


            $obj=json_decode($responce_domria);
            $arr_info=array();

            foreach ($obj->items as $key => $value) {
                //$arr_info['catch']=array();

                $url=$value->beautiful_url;
                $url_full=$root_site.$value->beautiful_url;

                if(!empty($url_full)){
                    $arr_info[]= $url_full ;
                }
                // 1436 собственикб   1435 представитель хозяина 1434 посредник 1473 предс застройщика
                $ob_arr=[0=>$dont_know,1436=>'Частного лица', 1435=>'Частного лица' ,1434 =>'Бизнес', 1473 =>'Бизнес',] ;

                $own_biss=isset( $value->characteristics_values->{1437})?$value->characteristics_values->{1437} : 0;
                $own_biss=isset( $ob_arr[$own_biss])?$ob_arr[$own_biss]:'Не определено';

                //$tmp_price=  $value->priceArr->{3};
                if(isset($value->priceArr->{3})){
                    $tmp_price=$value->priceArr->{3}; $currency= 'грн';

                }elseif(isset($value->priceArr->{2})) {

                    $tmp_price=$value->priceArr->{2}; $currency= '€';

                }elseif(isset($value->priceArr->{1})){ $tmp_price=$value->priceArr->{2}; $currency= '$'; }
                else{ $tmp_price='0'; $currency= 'грн';}


                //$currency= 'грн';

                $tmp_price = trim($tmp_price);
                $price = preg_replace('/[^0-9]+/','', $tmp_price);

                $square=  isset( $value->total_square_meters) ?  $value->total_square_meters: 0 ;

                $square =intval($square) ;
                $district=$value->city_name;



                $street=isset( $value->district_name) ?$value->district_name:'Не определена' ;
                //  $street=isset( $value->street_name) ?$value->street_name:'Улица не определена' ;

                $street2   =isset( $value->street_name) ?$value->street_name:'Улица не определена' ;

                // $arr['created_at']; date("Y-m-d H:i:s");
                $created_at=isset( $value->created_at)?$value->created_at:  date("Y-m-d H:i:s");

                $description= isset( $value->description)?$value->description:$dont_know;

                // title
                $array_des=explode(" ",$description);
                $shortdistrict='';
                $ii=0;
                foreach ($array_des as $v) {
                    if($ii++ >5)break;

                    $shortdistrict.=' '.$v;
                }


                $img=array();

                if(isset($value->photos)){
                    $img= $this->generate_img_url($value->photos,$url)  ;  }

                $img =
                    json_encode($img, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP |JSON_UNESCAPED_UNICODE);




                // проверка на урл
                // перенос проверки на присутсвие сюда, на страничку нету смысла идти
                $count = Rooms::find()->select(['id'])->where(['url' => $url_full])->limit(1)->count();
                echo  var_dump([$count,  $url_full] );
                // $count=0;
                if ($count > 0)    {

                    // echo 'present';
                    $arr_info['present'][]=$url_full;
                    continue;
//                    echo json_encode(['stop_timer' => false, 'info'=>'is present', 'present_url'=>$url_full, 'colected' => count(Yii::$app->session->
//                get('welldone', 0))], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT |
//                JSON_HEX_AMP | JSON_UNESCAPED_UNICODE); die();
                }

                // data in db

                $floor=   isset( $value->floor) ? $value->floor: $dont_know ;
                $floors=isset( $value->floors_count) ?$value->floors_count:$dont_know;
                // если застройщик тогда Новостройки иначе  Вторичный рынок

                //1473

                if( isset($value->characteristics_values->{1437})){
                    if($value->characteristics_values->{1437}==1473){
                        $type='Новостройки';
                    } else{
                        $type='Вторичный рынок';
                    }


                }  else{
                    $type=$dont_know;
                }






                $phone=array();

                // get tel
                // url https://dom.ria.com/node/api/getOwnerAndAgencyDataByIds?userId=5390464
                //https://dom.ria.com/node/api/getOwnerAndAgencyDataByIds?userId=5390464&agencyId=0&langId=2&_csrf=t1chwaXH-3PiLKvfGBEjVdSE8LFGHob-bIwk

                $ptel=     'https://dom.ria.com/node/api/getOwnerAndAgencyDataByIds?userId='.$value->user_id;
                $responce_tel = @file_get_contents($ptel,true);



                if( !$responce_tel   ){$phone=['empty_'];}
                else{
                    $telresp=json_decode($responce_tel);


                    foreach ($telresp->owner->owner_phones as $k => $pho) {

                        $phone[]= isset($pho->phone)?$pho->phone:$dont_know;
                    }

                }

                $phone=implode("|", $phone);



                if($square==0 || empty($square)||empty($price)){$price_m=0;}
                else{
                    //$price_m=  $contact->price/$contact->square;
                    $price_m= intval($price)/intval($square);
                }

                $count_rooms = isset( $value->rooms_count) ?$value->rooms_count: 0;

                $latitude=    isset( $value->latitude) ?$value->latitude: 0;
                $longitude=     isset( $value->longitude) ?$value->longitude: 0;

                $realty_id= isset($value->realty_id)?$value->realty_id: null;
                // порода дерева
                $material=isset($value-> wall_type) ? $value->wall_type :'Не определено';
                // $state=>


                $arr=   ['price'=>$price,
                    'own_biss'=>$own_biss,
                    'square'=>$square,
                    'district'=>$district,
                    'street'=>$street,
                    'description'=>$description,
                    'shortdistrict'=>$shortdistrict,
                    'manager'=>"********",
                    'coment'=>'********',
                    'url'=>$url_full,
                    'site'=>'DomRia'
                    ,'img'=>$img,
                    'currency'=> $currency,
                    'floor'=>$floor,
                    'floors'=>$floors,
                    'type'=>$type,
                    'phone'=>$phone,
                    'price_m'=>$price_m,
                    'count_rooms'=>$count_rooms,
                    'latitude'=>$latitude,
                    'longitude'=>$longitude,
                    'material'=>$material,
                    'realty_id'=>$realty_id,
                    'street2'=>$street2 ,
                    'created_at'=>$created_at  ,
                ];

                $retid=  $this->  write_to_db($arr) ;
                $arr_info['catch'][]=$url_full;
                $arr_info['idlist'][]= $retid;
                //   echo json_encode(['stop_timer' => false, 'info'=> $arr, 'present_url'=>$url_full, 'colected' => count(Yii::$app->session-> get('welldone', 0))], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);





                //die();







                // break;
            }



            // $wd=   Yii::$app->session->get('welldone_domria', 0);


            $total_in_page=  isset( $arr_info['catch'] ) ? count($arr_info['catch']): 0;
            $catch=  isset( $arr_info['catch'] ) ? $arr_info['catch'] :'nothing';
            $present=isset ($arr_info['present'])? $arr_info['present']:'nothuinbg' ;
            //$wd=$wd+$total_in_page;
            //Yii::$app->session->set('welldone_domria', $wd);


            // \Yii::info("own: ", $arr_info);
            //yii::error(var_dump(['dfdsafdsa']));

            if (!isset( $arr_info['idlist'])){
                $arr_info['idlist']=[];
            }

            echo json_encode([ 'colected2' => $total_in_page,'stop_timer' => false,'idlist'=> $arr_info['idlist'],
                //'catch'=> $catch, 'present'=>$present,
            ], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
            die();




        }



        echo json_encode(['stop_timer' => false, 'info'=> ['empty responce'],  'some' => 0 ] , JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
        die();

        // return $this->renderAjax('index', [ 'debug'=> $responce_domria,  'total' => $total=-9, 'olx_total' => $olx_total=-9, 'domria_total' => $domria_total=-9,  'count_page' => $count_page=-9, ]);

//\phpQuery::ajaxAllowHost('www.olx.ua');
//$path_site = 'https://www.olx.ua/nedvizhimost/prodazha-kvartir/od/';
//\phpQuery::get($path_site, function ($do)use ($path_site)
//{
//
//    $document = \phpQuery::newDocument($do); $bread1 = '.item.fleft'; $bread1a = $document->
//        find($bread1); foreach ($bread1a as $key => $value) {
//
//        /*   $b1[]=trim(pq($value)->find('a')->attr('href'));*/
//        $temp = pq($value)->text() . PHP_EOL; $temp = preg_replace('/[^0-9]+/', '', $temp);
//            $all_num[] = intval($temp); // echo pq($value)->attr('href').PHP_EOL;
//        }
//    $count_page = max($all_num); Yii::$app->session->set('count_page', $count_page);
//        Yii::$app->session->set('votes', $count_page);
//
//         //die();
//    }
//);

//        Yii::error(var_dump($responce_domria));

        echo  var_dump($responce_domria );


        echo 'run'.PHP_EOL;
    }


    public function actionRun()
    {
        $dont_know='Не определено';
//        $arr_info['idlist']=[];


//        limit	'20'
//page	'5'
//npage	'0'
//        limit	'20'
//page	'1'
//npage	'0'

//        limit	'20'
//page	'0'
//npage	'0'
        // Хранить данные в кэше не более 30 мин
        $cache = \Yii::$app->cache;
        $domria_page = $cache->get('domria_page');
        if ($domria_page === false) {
            // срок действия истек или ключ не найден в кэше
            // $cache->delete('datapage');
            $cache->set('domria_page', 4, 60 * 30);
            $domria_page = $cache->get('domria_page');
        }
        if (--$domria_page <= 0) {
            $cache->delete('domria_page');
            die('end colect from 10 url');
        }
        $cache->set('domria_page', $domria_page, 60*20);





        $limit=20;// квартир
        $page=$domria_page; // cтраница от 10 - 1
        $path="https://dom.ria.com/searchEngine/?page={$page}&new_search=1&limit={$limit}&from_realty_id=&to_realty_id=&sort=0&category=1&realty_type=0&operation_type=1&state_id=12&city_id%5B20%5D=12&characteristic%5B209%5D%5Bfrom%5D=&characteristic%5B209%5D%5Bto%5D=&characteristic%5B214%5D%5Bfrom%5D=&characteristic%5B214%5D%5Bto%5D=&characteristic%5B216%5D%5Bfrom%5D=&characteristic%5B216%5D%5Bto%5D=&characteristic%5B218%5D%5Bfrom%5D=&characteristic%5B218%5D%5Bto%5D=&characteristic%5B227%5D%5Bfrom%5D=&characteristic%5B227%5D%5Bto%5D=&characteristic%5B228%5D%5Bfrom%5D=&characteristic%5B228%5D%5Bto%5D=&characteristic%5B234%5D%5Bfrom%5D=&characteristic%5B234%5D%5Bto%5D=&characteristic%5B242%5D=239&characteristic%5B265%5D=0&realty_id_only=&date_from=&date_to=&with_phone=&exclude_my=&new_housing_only=&banks_only=&email=&period=0";
        $responce_domria = @file_get_contents($path,true);
        $root_site='https://dom.ria.com/ru/';

        if( !$responce_domria   ){$responce_domria='empty responce BAD !!';}
        else{


            $obj=json_decode($responce_domria);
            $arr_info=array();

            foreach ($obj->items as $key => $value) {
                //$arr_info['catch']=array();

                $url=$value->beautiful_url;
                $url_full=$root_site.$value->beautiful_url;

                if(!empty($url_full)){
                    $arr_info[]= $url_full ;
                }
                // 1436 собственикб   1435 представитель хозяина 1434 посредник 1473 предс застройщика
                $ob_arr=[0=>$dont_know,1436=>'Частного лица', 1435=>'Частного лица' ,1434 =>'Бизнес', 1473 =>'Бизнес',] ;

                $own_biss=isset( $value->characteristics_values->{1437})?$value->characteristics_values->{1437} : 0;
                $own_biss=isset( $ob_arr[$own_biss])?$ob_arr[$own_biss]:'Не определено';

                //$tmp_price=  $value->priceArr->{3};
                if(isset($value->priceArr->{3})){
                    $tmp_price=$value->priceArr->{3}; $currency= 'грн';

                }elseif(isset($value->priceArr->{2})) {

                    $tmp_price=$value->priceArr->{2}; $currency= '€';

                }elseif(isset($value->priceArr->{1})){ $tmp_price=$value->priceArr->{2}; $currency= '$'; }
                else{ $tmp_price='0'; $currency= 'грн';}


                //$currency= 'грн';

                $tmp_price = trim($tmp_price);
                $price = preg_replace('/[^0-9]+/','', $tmp_price);

                $square=  isset( $value->total_square_meters) ?  $value->total_square_meters: 0 ;

                $square =intval($square) ;
                $district=$value->city_name;



                $street=isset( $value->district_name) ?$value->district_name:'Не определена' ;
                //  $street=isset( $value->street_name) ?$value->street_name:'Улица не определена' ;

                $street2   =isset( $value->street_name) ?$value->street_name:'Улица не определена' ;

                // $arr['created_at']; date("Y-m-d H:i:s");
                $created_at=isset( $value->created_at)?$value->created_at:  date("Y-m-d H:i:s");

                $description= isset( $value->description)?$value->description:$dont_know;

                // title
                $array_des=explode(" ",$description);
                $shortdistrict='';
                $ii=0;
                foreach ($array_des as $v) {
                    if($ii++ >5)break;

                    $shortdistrict.=' '.$v;
                }


                $img=array();

                if(isset($value->photos)){
                    $img= $this->generate_img_url($value->photos,$url)  ;  }

                $img =
                    json_encode($img, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP |JSON_UNESCAPED_UNICODE);




                // проверка на урл
                // перенос проверки на присутсвие сюда, на страничку нету смысла идти
                $count = Rooms::find()->select(['id'])->where(['url' => $url_full])->limit(1)->count();
                echo  var_dump([$count,  $url_full] );
                // $count=0;
                if ($count > 0)    {

                    // echo 'present';
                    $arr_info['present'][]=$url_full;
                    continue;
//                    echo json_encode(['stop_timer' => false, 'info'=>'is present', 'present_url'=>$url_full, 'colected' => count(Yii::$app->session->
//                get('welldone', 0))], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT |
//                JSON_HEX_AMP | JSON_UNESCAPED_UNICODE); die();
                }

                // data in db

                $floor=   isset( $value->floor) ? $value->floor: $dont_know ;
                $floors=isset( $value->floors_count) ?$value->floors_count:$dont_know;
                // если застройщик тогда Новостройки иначе  Вторичный рынок

                //1473

                if( isset($value->characteristics_values->{1437})){
                    if($value->characteristics_values->{1437}==1473){
                        $type='Новостройки';
                    } else{
                        $type='Вторичный рынок';
                    }


                }  else{
                    $type=$dont_know;
                }






                $phone=array();

                // get tel
                // url https://dom.ria.com/node/api/getOwnerAndAgencyDataByIds?userId=5390464
                //https://dom.ria.com/node/api/getOwnerAndAgencyDataByIds?userId=5390464&agencyId=0&langId=2&_csrf=t1chwaXH-3PiLKvfGBEjVdSE8LFGHob-bIwk

                $ptel=     'https://dom.ria.com/node/api/getOwnerAndAgencyDataByIds?userId='.$value->user_id;
                $responce_tel = @file_get_contents($ptel,true);



                if( !$responce_tel   ){$phone=['empty_'];}
                else{
                    $telresp=json_decode($responce_tel);


                    foreach ($telresp->owner->owner_phones as $k => $pho) {

                        $phone[]= isset($pho->phone)?$pho->phone:$dont_know;
                    }

                }

                $phone=implode("|", $phone);



                if($square==0 || empty($square)||empty($price)){$price_m=0;}
                else{
                    //$price_m=  $contact->price/$contact->square;
                    $price_m= intval($price)/intval($square);
                }

                $count_rooms = isset( $value->rooms_count) ?$value->rooms_count: 0;

                $latitude=    isset( $value->latitude) ?$value->latitude: 0;
                $longitude=     isset( $value->longitude) ?$value->longitude: 0;

                $realty_id= isset($value->realty_id)?$value->realty_id: null;
                // порода дерева
                $material=isset($value-> wall_type) ? $value->wall_type :'Не определено';
                // $state=>


                $arr=   ['price'=>$price,
                    'own_biss'=>$own_biss,
                    'square'=>$square,
                    'district'=>$district,
                    'street'=>$street,
                    'description'=>$description,
                    'shortdistrict'=>$shortdistrict,
                    'manager'=>"********",
                    'coment'=>'********',
                    'url'=>$url_full,
                    'site'=>'DomRia'
                    ,'img'=>$img,
                    'currency'=> $currency,
                    'floor'=>$floor,
                    'floors'=>$floors,
                    'type'=>$type,
                    'phone'=>$phone,
                    'price_m'=>$price_m,
                    'count_rooms'=>$count_rooms,
                    'latitude'=>$latitude,
                    'longitude'=>$longitude,
                    'material'=>$material,
                    'realty_id'=>$realty_id,
                    'street2'=>$street2 ,
                    'created_at'=>$created_at  ,
                ];

               $retid=  $this->  write_to_db($arr) ;
                $arr_info['catch'][]=$url_full;
                $arr_info['idlist'][]= $retid;
                //   echo json_encode(['stop_timer' => false, 'info'=> $arr, 'present_url'=>$url_full, 'colected' => count(Yii::$app->session-> get('welldone', 0))], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);





                //die();







                // break;
            }



            // $wd=   Yii::$app->session->get('welldone_domria', 0);


            $total_in_page=  isset( $arr_info['catch'] ) ? count($arr_info['catch']): 0;
            $catch=  isset( $arr_info['catch'] ) ? $arr_info['catch'] :'nothing';
            $present=isset ($arr_info['present'])? $arr_info['present']:'nothuinbg' ;
            //$wd=$wd+$total_in_page;
            //Yii::$app->session->set('welldone_domria', $wd);


           // \Yii::info("own: ", $arr_info);
            //yii::error(var_dump(['dfdsafdsa']));

            if (!isset( $arr_info['idlist'])){
                $arr_info['idlist']=[];
            }

            echo json_encode([ 'colected2' => $total_in_page,'stop_timer' => false,'idlist'=> $arr_info['idlist'],
                //'catch'=> $catch, 'present'=>$present,
            ], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
            die();




        }



        echo json_encode(['stop_timer' => false, 'info'=> ['empty responce'],  'some' => 0 ] , JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
        die();

        // return $this->renderAjax('index', [ 'debug'=> $responce_domria,  'total' => $total=-9, 'olx_total' => $olx_total=-9, 'domria_total' => $domria_total=-9,  'count_page' => $count_page=-9, ]);

//\phpQuery::ajaxAllowHost('www.olx.ua');
//$path_site = 'https://www.olx.ua/nedvizhimost/prodazha-kvartir/od/';
//\phpQuery::get($path_site, function ($do)use ($path_site)
//{
//
//    $document = \phpQuery::newDocument($do); $bread1 = '.item.fleft'; $bread1a = $document->
//        find($bread1); foreach ($bread1a as $key => $value) {
//
//        /*   $b1[]=trim(pq($value)->find('a')->attr('href'));*/
//        $temp = pq($value)->text() . PHP_EOL; $temp = preg_replace('/[^0-9]+/', '', $temp);
//            $all_num[] = intval($temp); // echo pq($value)->attr('href').PHP_EOL;
//        }
//    $count_page = max($all_num); Yii::$app->session->set('count_page', $count_page);
//        Yii::$app->session->set('votes', $count_page);
//
//         //die();
//    }
//);

//        Yii::error(var_dump($responce_domria));

        echo  var_dump($responce_domria );


        echo 'run'.PHP_EOL;
    }

    public function generate_img_url($photos,$url_pretty,$url_to_img='https://cdn.riastatic.com/photosnew/dom/photo/'){

        //examlpe path to img    url+  id + fl.jpg   !!!!!!!!
        //https://cdn.riastatic.com/photosnew/dom/photo/realty-perevireno-prodaja-kvartira-odessa-malinovskiy-parkovaya__48523787fl.jpg

        $res=array();

        $pos      = strripos($url_pretty ,'-' );


        if ($pos === false) {
            return $res;
        } else {


            $rest = substr($url_pretty,0, $pos);


            $rest.='__';



        }
        foreach ($photos as $key1 => $value) {

            //$exten=  pathinfo($value->file);
            // $ext = explode(".",$value->file );
            $fileName_arr = explode(".",$value->file);

            $arrLength = count($fileName_arr);


            // \Yii::info("own1: ", $fileName_arr[$arrLength - 1]);
            $res[]=   $url_to_img. $rest.$value->id."fl.".$fileName_arr[$arrLength - 1];


        }

        return $res;

        //       "photos":{
//            "59761497":{
//               "id":59761497,
//               "file":"dom/photo/5976/597614/59761497/59761497.jpg"
//            },
//            "59761501":{
//               "id":59761501,
//               "file":"dom/photo/5976/597615/59761501/59761501.jpg"
//            },
//
//         },



    }

    public function write_to_db($arr){
        $returnid=-1;
        $contact = new Rooms();
        $contact->price = $arr['price'];
        $contact-> own_or_business =$arr['own_biss'];
        $contact->square = $arr['square'];
        $contact->district = $arr['district'];
        $contact->street = $arr['street'];
        $contact->street2 = $arr['street2'];
        $contact->description = $arr['description'];
        $contact->shortdistrict = $arr['shortdistrict'];
        $contact->manager = $arr['manager'];
        $contact->coment = $arr['coment'];
        $contact->url = $arr['url'];
        $contact->site = $arr['site'];
        $contact->img = $arr['img'];

        $contact->currency=$arr['currency'];
//
        $contact->date= $arr['created_at']; date("Y-m-d H:i:s");
//
        $contact->floor=$arr['floor'];
        $contact->floors=$arr['floors'];
        $contact->type=$arr['type'];

//
        $contact->phone=$arr['phone'];
//
//

        $contact->price_m= (int) ($arr['price_m']);
//
        $contact->state='Состояние';
//
        $contact->count_rooms=$arr['count_rooms'];

        $contact->material=$arr['material'];

        $contact->site_id =$arr['realty_id'];


        if ($contact->validate()) {

            $contact->save();
$returnid=$contact->id;
            //$contact->id;

            $latitude  =$arr['latitude'];
            $longitude =$arr['longitude'];



            // write coordinate
            if( !($latitude ==0 || $longitude== 0)){

                $coo=new Coordinates();
                $coo->latitude=$latitude;
                $coo->longitude=$longitude;
                if($coo->validate()){  $coo->save();}else{
                    //print_r($coo->errors);
                }

                $r_t_c_fk=new RoomsToCoordinates();
                $r_t_c_fk-> id_coordinates=$coo->id;
                $r_t_c_fk->id_rooms=$contact->id;
                if($r_t_c_fk->validate()){$r_t_c_fk->save();}else{
                    // print_r($r_t_c_fk->errors);
                }


            }






        }
        else {

        }

        // print_r($contact->errors);
    return $returnid;
    }

}