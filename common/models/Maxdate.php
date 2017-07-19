<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "maxdate".
 *
 * @property integer $id
 * @property string $dt
 * @property integer $max_id
 * @property string $site
 */
class Maxdate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'maxdate';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dt'], 'safe'],
            [['max_id'], 'integer'],
            [['site'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'dt' => 'Dt',
            'max_id' => 'Max ID',
            'site' => 'Site',
        ];
    }
}
