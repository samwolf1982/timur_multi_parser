<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "rooms_to_coordinates".
 *
 * @property integer $id
 * @property integer $id_rooms
 * @property integer $id_coordinates
 * @property Rooms $idRooms
 * @property Coordinates $idCoordinates
 */
class RoomsToCoordinates extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rooms_to_coordinates';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_rooms', 'id_coordinates'], 'integer'],
            [['id_rooms'], 'exist', 'skipOnError' => true, 'targetClass' => Rooms::className(), 'targetAttribute' => ['id_rooms' => 'id']],
            [['id_coordinates'], 'exist', 'skipOnError' => true, 'targetClass' => Coordinates::className(), 'targetAttribute' => ['id_coordinates' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_rooms' => 'Id Rooms',
            'id_coordinates' => 'Id Coordinates',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdRooms()
    {
        return $this->hasOne(Rooms::className(), ['id' => 'id_rooms']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCoordinates()
    {
        return $this->hasOne(Coordinates::className(), ['id' => 'id_coordinates']);
    }
}
