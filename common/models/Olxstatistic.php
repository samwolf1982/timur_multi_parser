<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "olxstatistic".
 *
 * @property integer $id
 * @property string $shorturl
 * @property string $fullurl
 * @property integer $someelse
 * @property string $someelse2
 */
class Olxstatistic extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'olxstatistic';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['someelse'], 'integer'],
            [['shorturl', 'fullurl', 'someelse2'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'shorturl' => 'Shorturl',
            'fullurl' => 'Fullurl',
            'someelse' => 'Someelse',
            'someelse2' => 'Someelse2',
        ];
    }
}
