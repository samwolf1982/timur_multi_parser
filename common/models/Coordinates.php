<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "coordinates".
 *
 * @property integer $id
 * @property double $longitude
 * @property double $latitude
 *
 * @property RoomsToCoordinates[] $roomsToCoordinates
 */
class Coordinates extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'coordinates';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['longitude', 'latitude'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'longitude' => 'Longitude',
            'latitude' => 'Latitude',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoomsToCoordinates()
    {
        return $this->hasMany(RoomsToCoordinates::className(), ['id_coordinates' => 'id']);
    }
}
