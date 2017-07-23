<?php
/**
 * Created by PhpStorm.
 * User: sam
 * Date: 7/23/17
 * Time: 2:08 AM
 */


$file = '/home/sam/sites/l18yii/bd/colecturl.txt';




$i=10;$res_string='';
foreach (range(500,400) as $item) {
    $i+=5;
  $res_string.= "10 3 * * * sleep {$i};    /usr/bin/php /var/www/timur/data/www/timurparser.com/yii parser/colecturlsolxparam {$item}".PHP_EOL;

}
file_put_contents($file, $res_string,  LOCK_EX);

echo "ok".PHP_EOL;