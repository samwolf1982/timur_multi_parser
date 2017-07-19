<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "rooms".
 *
 * @property integer $id
 * @property string $shortdistrict
 * @property string $phone
 * @property integer $price
 * @property string $currency
 * @property integer $price_m
 * @property integer $count_rooms
 * @property integer $square
 * @property integer $floor
 * @property integer $floors
 * @property string $type
 * @property string $district
 * @property string $street
 * @property string $street2
 * @property string $description
 * @property string $state
 * @property string $own_or_business
 * @property string $manager
 * @property string $coment
 * @property string $url
 * @property string $site
 * @property string $img
 * @property string $date
 * @property string $material
 * @property int $site_id
 */
class Rooms extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rooms';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['price', 'price_m', 'count_rooms', 'square', 'floor', 'floors','site_id'], 'integer'],
            [['description', 'url', 'img','date'], 'string'],
            [['shortdistrict', 'phone', 'currency', 'type', 'district', 'street', 'street2', 'state', 'own_or_business', 'manager', 'coment', 'site', 'material'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'shortdistrict' => 'Краткое опис.',
            'phone' => 'Телефон',
            'price' => 'Цена',
            'currency' => 'Валюта',
            'price_m' => 'Цена м2',
            'count_rooms' => 'Кол. комнат',
            'square' => 'Площадь',
            'floor' => 'Этаж',
            'floors' => 'Этажность',
            'type' => 'Тип',
            'district' => 'Город',
            'street' => 'Район',
            'description' => 'Описание',
            'state' => 'Состояние',
            'own_or_business' => 'Форма',
            'manager' => 'Менеджер',
            'coment' => 'Коментарий',
            'url' => 'Урл',
            'site' => 'Сайт',
            'img' => 'КартинкиJSON',
            'date' => 'Дата',
            'material'=>'Материал',
            'site_id'=>'><Ид сайта',
            'street2'=>'Улица',
        ];
    }
}
