<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "rooms".
 *
 * @property integer $id
 * @property integer $site_id
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
 * @property string $material
 * @property string $own_or_business
 * @property string $manager
 * @property string $coment
 * @property string $url
 * @property string $site
 * @property string $img
 * @property string $date
 *
 * @property RoomsToCoordinates[] $roomsToCoordinates
 * @property UserSave[] $userSaves
 */
class Ownsave extends \yii\db\ActiveRecord
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
            [['site_id', 'price', 'price_m', 'count_rooms', 'square', 'floor', 'floors'], 'integer'],
            [['description', 'url', 'img'], 'string'],
            [['material'], 'required'],
            [['date'], 'safe'],
            [['shortdistrict', 'phone', 'currency', 'type', 'district', 'street', 'street2', 'state', 'material', 'own_or_business', 'manager', 'coment', 'site'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'site_id' => 'Site ID',
            'shortdistrict' => 'Shortdistrict',
            'phone' => 'Phone',
            'price' => 'Price',
            'currency' => 'Currency',
            'price_m' => 'Price M',
            'count_rooms' => 'Count Rooms',
            'square' => 'Square',
            'floor' => 'Floor',
            'floors' => 'Floors',
            'type' => 'Type',
            'district' => 'District',
            'street' => 'Street',
            'street2' => 'Street2',
            'description' => 'Description',
            'state' => 'State',
            'material' => 'Material',
            'own_or_business' => 'Own Or Business',
            'manager' => 'Manager',
            'coment' => 'Coment',
            'url' => 'Url',
            'site' => 'Site',
            'img' => 'Img',
            'date' => 'Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoomsToCoordinates()
    {
        return $this->hasMany(RoomsToCoordinates::className(), ['id_rooms' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserSaves()
    {
        return $this->hasMany(UserSave::className(), ['o_id' => 'id']);
    }
}
