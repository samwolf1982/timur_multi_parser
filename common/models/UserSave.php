<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_save".
 *
 * @property integer $id
 * @property integer $u_id
 * @property integer $o_id
 * @property integer $some
 *
 * @property User $u
 * @property Rooms $o
 */
class UserSave extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_save';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['u_id', 'o_id',], 'required'],
            [['u_id', 'o_id', ], 'integer'],
            [['u_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['u_id' => 'id']],
            [['o_id'], 'exist', 'skipOnError' => true, 'targetClass' => Rooms::className(), 'targetAttribute' => ['o_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'u_id' => 'U ID',
            'o_id' => 'O ID',
            'some' => 'Some',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getU()
    {
        return $this->hasOne(User::className(), ['id' => 'u_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getO()
    {
        return $this->hasOne(Rooms::className(), ['id' => 'o_id']);
    }
}
