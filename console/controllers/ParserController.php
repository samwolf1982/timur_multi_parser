<?php
namespace console\controllers;
/**
 * Created by PhpStorm.
 * User: sam
 * Date: 7/19/17
 * Time: 12:59 AM
 */

use Yii;
use yii\helpers\Html;
use yii\helpers\VarDumper;
use common\models\Rooms;
use common\models\Coordinates;
use common\models\Olxstatistic;
use common\models\Maxdate;
use yii\db\Migration;
use yii\web\Response;

Yii::$classMap['phpQuery'] = Yii::getAlias('@backend') .
    '/vendors/phpQuery/phpQuery/phpQuery.php';

class ParserController extends \yii\console\Controller
{

    // cписок кешей 'olx_count', -- количество доступных страниц в олх
    //olx_count_page      -- количество начальных страниц для парсинга по умолчанию 10  время жизни 30мин  поставить 10 сейчас 3





// сбор урлов олх по 37 штук   запускать сейчас 2 раза потом по 9 с интервалом время жизни 30мин
    public function actionColecturlsolx(){
        // Хранить данные в кэше не более 30 мин
        $cache=   \Yii::$app->cache;
        $olx_count_page = $cache->get('olx_count_page');
        if ($olx_count_page === false) {
            // срок действия истек или ключ не найден в кэше
            $cache->delete('datapage');
            $cache->set('olx_count_page', 3, 60*30);
            $olx_count_page = $cache->get('olx_count_page');
        }
        if (--$olx_count_page<=0) {
            $cache->delete('olx_count_page'); die('end colect from 10 url' );
        }
        $cache->set('olx_count_page', $olx_count_page, 60*20);
        $url= "https://www.olx.ua/nedvizhimost/prodazha-kvartir/od/?page={$olx_count_page}";


        \phpQuery::ajaxAllowHost('www.olx.ua');
        $path_site = $url;
        \phpQuery::get($path_site, function ($do)use ($path_site)
        {

            $gate = false; // если true значить есть в базе n timer true
            $document = \phpQuery::newDocument($do);
            // table main  сбор урлов и запись в сесию
            $bread1 = '#offers_table tr td[valign^="top"] h3 a[href^=https://www.olx.ua/obyavlenie]';
            $bread1a = $document->find($bread1);
            $tmp_urls = [];
            $all_tmp_urls = [];
            // все 30 урлов для сверки по индексу с ценой
            foreach ($bread1a as $key => $value) {


                $t = pq($value)->attr('href');
                $t_full=$t;
                $uap=parse_url($t);
                $t=$uap['scheme'].'://'.$uap['host'].$uap['path'];
                $all_tmp_urls[] = $t;
                // запись в бд для статистики

                $count = Olxstatistic::find()->select(['id'])->where(['fullurl' => $t_full])->limit(1)->count();

                if ($count == 0) {
                    $contact = new Olxstatistic();

                    $contact->fullurl = $t_full;
                    $contact-> shorturl = $t;
                    $contact->save();

                }
                // конец запись в бд для статистики



            }


            $urls_page = $tmp_urls; ///////////////////    price
            $bread1 = '#offers_table .price';
            $bread1a = $document->find($bread1);

            $all_price=array();

            foreach ($bread1a as $key => $value) {
                $temp = pq($value)->text();
                $temp = trim($temp);
                $temp = preg_replace('/[^0-9]+/','', $temp);

                $all_price[]=$temp;
                // $price_page[] = $temp;

            }
            $datapg=array();
            for ($j = 0; $j < count($all_tmp_urls); $j++) {
                $u = $all_tmp_urls[$j];
                //$count = Rooms::find()->where(['url' => $u])->count();
                $count =  Rooms::find()->select(['id'])->where(['url' => $u])->limit(1)->count();

                if ($count > 0)continue;

                $tmp = ['price' => $all_price[$j], 'url' => $all_tmp_urls[$j], ];
                $datapg[] = $tmp; }

            ///////////////////////////////////////////


            // дозапись в сесию( пока что такой вариант)
//            $all_urls = Yii::$app->session->get('all_urls', 0);
//            $datapage = Yii::$app->session->get('datapage', 0);

           // $cache->set('olx_count_page', $olx_count_page, 60*20);
            $cache=   \Yii::$app->cache;
            $datapage = $cache->get('datapage');
            if ($datapage === false) {
                // срок действия истек или ключ не найден в кэше
                $cache->set('datapage', 0, 60*30);
                $datapage = $cache->get('datapage');
            }



            if (is_array($datapage)) {
                // $all_urls = array_merge($all_urls, $urls_page);
                $datapage = array_merge($datapage,
                    $datapg); }
            else {
                $datapage = $datapg; }


//       Yii::$app->session->set('datapage', $datapage);
            $cache->set('datapage', $datapage, 60*30);

//            $all_urls = Yii::$app->session->get('datapage');
                  $all_urls =  $datapage;
//            $npage = Yii::$app->session->get('count_url_page_index');
            $npage = 0;

            $res = array(


                'success' => true,
                'debug' => ['url'=>$path_site,'find_urls'=>$all_tmp_urls,'catch_url'=>$all_urls],
                'npage' => $npage,
                'stop_timer' => $gate,
                'colected' => count($all_urls),
                'countobj' => count($all_urls),
            );

            $datapage = $cache->get('datapage');
      var_dump($datapage);
//            echo json_encode($res, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT |
//                JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
            //die();
        }
        );


        echo $url.PHP_EOL;
     echo PHP_EOL;
    }

    
    // может не нужно  нужно нужно федя
    //     code parse colected urls
    public function actionPars()
    {

        // если буду проблемы с цикличностю тогда смотреть в
        // найти и разкоментрировать ст298    //$welldone = Yii::$app->session->get('welldone', 0); ++$welldone;

        $_POST['only_new']=true; // для только новых


        $cache=   \Yii::$app->cache;
        $datapage = $cache->get('datapage');
        if ($datapage === false) {
            // срок действия истек или ключ не найден в кэше
            $cache->set('datapage', [], 20*30);
            $datapage = $cache->get('datapage');
        }

            $path_site = array_pop($datapage);

//            Yii::$app->session->set('datapage', $datapage);
        $cache->set('datapage', $datapage, 20*30);

            // возможно удалить или
            if(is_null($path_site)){
//                echo json_encode(['stop_timer' => true,'debug'=>'else','info'=>'datapage null or empty', 'colected' => count(Yii::$app->session->
//                get('welldone', 0))], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT |
//                    JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
                die('кеш пустой'.PHP_EOL);
            }




            // перенос проверки на присутсвие сюда, на страничку нету смысла идти
            $count = Rooms::find()->select(['id'])->where(['url' => $path_site['url']])->limit(1)->count();

            if ($count > 0)    {
                echo json_encode(['stop_timer' => false, 'info'=>'is present', 'present_url'=>$path_site['url'], 'colected' => count(Yii::$app->session->
                get('welldone', 0))], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT |
                    JSON_HEX_AMP | JSON_UNESCAPED_UNICODE); die();
            }






            // if (is_array($datapage) && (count($datapage) > 0)) {

            \phpQuery::ajaxAllowHost('www.olx.ua');
            //$path_site = array_pop($all_urls);

            //Yii::$app->session->set('all_urls', $all_urls);


            //debig
            //   {echo json_encode(['stop_timer' => false, 'info'=>$path_site, 'colected' => count(Yii::$app->session->
//                get('all_urls', 0))], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT |
//                JSON_HEX_AMP | JSON_UNESCAPED_UNICODE); die(); }

            // проверка на пустоту
            if(empty($path_site['url']) || $path_site['url']=='' || is_null($path_site['url'])  )

            {
//                echo json_encode(['stop_timer' => true, 'info'=>'empty urls', 'colected' => count(Yii::$app->session->
//            get('welldone', 0))], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT |
//                JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
                die();
            }
            \phpQuery::get($path_site['url'], function ($do)use ($path_site)
            {

                $document = \phpQuery::newDocument($do);
                // table main  сбор урлов и запись в сесию
                $title = ''; $bread1 = '.offer-titlebox h1'; $bread1a = $document->find($bread1);
                foreach ($bread1a as $key => $value) {

                    /*   $b1[]=trim(pq($value)->find('a')->attr('href'));*/
                    $temp = pq($value)->text(); $title = trim($temp); break;
                    // echo pq($value)->attr('href').PHP_EOL;
                }

                // adress district ..

                $address = array(); $bread1 = '.show-map-link'; $bread1a = $document->find($bread1);
                foreach ($bread1a as $key => $value) {

                    /*   $b1[]=trim(pq($value)->find('a')->attr('href'));*/
                    $temp = pq($value)->text(); $address = explode(',', $temp); break;
                    // echo pq($value)->attr('href').PHP_EOL;
                }
                //---------------------

                // count rooms .details
                $bread1 = '.details .item'; $bread1a = $document->find($bread1); foreach ($bread1a as
                                                                                          $key => $value) {

                /*   $b1[]=trim(pq($value)->find('a')->attr('href'));*/
                $heder_name = pq($value)->find('tr th')->text(); $value_name = pq($value)->find
                ('.value')->text(); //echo $heder_name."  ". $value_name;
                $details[] = [trim($heder_name), trim($value_name)]; $details2[trim($heder_name)] =
                    trim($value_name); }

                //---------
                // descript
                $bread1 = '#textContent'; $bread1a = $document->find($bread1); $desc =
                'empty descr'; foreach ($bread1a as $key => $value) {

                /*   $b1[]=trim(pq($value)->find('a')->attr('href'));*/
                $temp = pq($value)->text(); $desc = trim($temp); break;
                // echo pq($value)->attr('href').PHP_EOL;
            }


                //-----------

                //      photo-glow
                //       картинки
                $bread1 = '.photo-glow img'; $bread1a = $document->find($bread1); $imgarr =
                array(); foreach ($bread1a as $key => $value) {

                /*   $b1[]=trim(pq($value)->find('a')->attr('href'));*/
                $img = pq($value)->attr('src'); $imgarr[] = $img; //  echo $img.PHP_EOL;
            }

                // prepare to db
                $ownbis = isset($details2['Объявление от']) ? $details2['Объявление от'] :
                    'Не определено';

                if (isset($details2['Общая площадь'])) {

                    $details2['Общая площадь'] = str_replace('м2', '', $details2['Общая площадь']);
                    $square = preg_replace('/[^0-9]+/', '', $details2['Общая площадь']);
                    $square =intval($square);
                }
                else {
                    $square = 0; }


                if (isset($details2['Количество комнат'])) {
                    $coun_rooms=preg_replace('/[^0-9]+/', '', $details2['Количество комнат']);

                    $coun_rooms =intval($coun_rooms);
                }
                else {
                    $coun_rooms = 0; }


                if (isset($details2['Этаж'])) {
                    $floor=preg_replace('/[^0-9]+/', '', $details2['Этаж']);
                    $floor =intval($floor);
                }
                else {
                    $floor = 0; }


                if (isset($details2['Этажность дома'])) {
                    $floors=preg_replace('/[^0-9]+/', '', $details2['Этажность дома']);
                    $floors =intval($floors);
                }
                else {
                    $floors = $floor; }



                $type_room = isset($details2['Тип квартиры']) ? $details2['Тип квартиры'] :
                    'Не определено';





                $manager = '********'; $coment = '********'; $site = 'OLX'; if (!isset($address[0]))
                $address[0] = 'Не определен';
                if (!isset($address[1]))$address[1] =
                    'Не определен'; if (!isset($address[2]))$address[2] = 'Не определен'; $imgarr =
                json_encode($imgarr, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP |
                    JSON_UNESCAPED_UNICODE); //     fill to db


                // find id
                //offer-titlebox__details
                $bread1 = '.offer-titlebox__details em small';
                $bread1a = $document->find($bread1);

                $site_id =0;
                foreach ($bread1a as $key => $value) {

                    /*   $b1[]=trim(pq($value)->find('a')->attr('href'));*/
                    $site_id = pq($value)->text();
                    $site_id=preg_replace('/[^0-9]+/', '', $site_id);
                    $site_id=intval($site_id, 10) ;
                    break;
                    // echo pq($value)->attr('href').PHP_EOL;
                }

                //\Yii::info("own id: ", $site_id);


                // phone

                $bread1 = '.contact-button.link-phone';
                $bread1a = $document->find($bread1);

                $phone ='-----';
                foreach ($bread1a as $key => $value) {

                    /*   $b1[]=trim(pq($value)->find('a')->attr('href'));*/
                    $phone = pq($value)->attr('class');;
                    //  $site_id=preg_replace('/[^0-9]+/', '', $site_id);
//                        $site_id=intval($site_id, 10) ;
                    $phone= $this->search_phone_id($phone);


                    // \Yii::info("own: ",$p);

                    //  die();
                    if(!is_null($phone)){
                        // go to post
                        //
                        $tel_url="https://www.olx.ua/ajax/misc/contact/phone/{$phone}/";
                        $responce_olx = @file_get_contents($tel_url,true);
                        if( !$responce_olx   ){$responce_olx='empty responce BAD !!';
                            $phone='-----';   }
                        else{
                            $obj=json_decode($responce_olx);
                            //    $phone=$obj->value;

                            //  <span class="block">048 771 9632</span> <span class="block">098 767 8897</span> <span class="block">093 505 8933</span>
                            $phone=$this-> parse_responce_phone($obj->value);
                        }



                    }  else{
                        $phone='-----';
                    }




                    break;
                    // echo pq($value)->attr('href').PHP_EOL;
                }


                // еще одна проверка в бд на max url

                $max_date  = Maxdate::find()->andWhere(['site'=>'OLX'])->max('dt');

                $max_id  = Maxdate::find()->select('max_id')->where(['dt'=>$max_date])->one();


// если ид в бд есть больше тогда пропуск
                if($max_id->max_id>$site_id && $_POST['only_new']==true ) {

//                    $welldone = Yii::$app->session->get('welldone', 0); $res = array(
//
//                        'debugval' => print_r($address, true),
//                        'success' => true,
//                        'stop_timer' => false,
//                        'url' => $path_site['url'],
//                        'welldone' => $welldone,
//                    );
//                    echo json_encode($res, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT |
//                        JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);

                    die('уже есть в бд большей ид' .$max_id->max_id.'  '.$site_id  );

                }

                //  $count = Rooms::find()->where(['url' => $path_site['url']])->count();

                //  if ($count == 0) {
                $contact = new Rooms();
                $contact->price = $path_site['price'];
                $contact-> own_or_business = $ownbis;
                $contact->square = $square;
                $contact->district = $address[0];
                $contact->street = $address[2];
                $contact->description = $desc;
                $contact->shortdistrict = $title;
                $contact->manager = $manager;
                $contact->coment = $coment;
                $contact->url = $path_site['url'];
                $contact->site = $site;
                $contact->img = $imgarr;
                $contact->currency='грн';

                $contact->date=date("Y-m-d H:i:s");

                $contact->floor=$floor;
                $contact->floors=$floors;
                $contact->type=$type_room;


                $contact->site_id=$site_id;

                $contact->phone=$phone;

                if($square==0 || empty($square)||empty($path_site['price'])){$price_m=0;}
                else{
                    //$price_m=  $contact->price/$contact->square;
                    $price_m= intval($path_site['price'])/intval($square);



                    //$price_m=  999;
                }


                $contact->price_m=(int) $price_m;
                $contact->state='Состояние';



                $contact->count_rooms=$coun_rooms;
                $contact->save();


//   дозапись  в таблицу с временем к ид
                $d_now= strtotime( date("Y-m-d"));


                if ($_POST['only_new']==true) {

                    if($d_now> strtotime( $max_date)){
                        $md = new Maxdate();
                        $md->dt= date("Y-m-d");
                        $md->max_id= $site_id;
                        $md->site= 'OLX';
                        $md->save();



                    }

                }



//                $welldone = Yii::$app->session->get('welldone', 0); ++$welldone;
//                Yii::$app->session->set('welldone', $welldone);
//
//                $welldone = Yii::$app->session->get('welldone', 0); $res = array(
//
//                'debugval' => print_r($address, true),
//                'success' => true,
//                'stop_timer' => false,
//                'url' => $path_site['url'],
//                'welldone' => $welldone,
//            );
//                echo json_encode($res, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT |
//                    JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);

                die(' ok room add');

            }
            ); // end pars inner


    } // конец парсинга





    // рабочие функции
    public function search_phone_id($str) {

        preg_match("~'id':'(.*)',~",$str,$out);


        return isset($out[1])? $out[1]: null;


    }
    function parse_responce_phone($str) {

        //  <span class="block">048 771 9632</span> <span class="block">098 767 8897</span> <span class="block">093 505 8933</span>

        if(strlen($str)>15) {
//      preg_match("~'id':'(.*)',~",$str,$out);
            preg_match_all('~<span class="block">(\d\d\d \d\d\d \d\d\d\d)</span>~',$str,$out);

//            var_dump($out);
            $tel='';
            if(count($out)>1)
                foreach ($out[1] as $k => $v) {
                    // if($k!=0)
                    $tel.= preg_replace('/[^0-9]+/','', $v).'|';
                }
            return $tel;

        }
        return  preg_replace('/[^0-9]+/','', $str);

    }



}

