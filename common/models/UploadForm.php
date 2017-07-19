<?php
namespace common\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    public function rules()
    {
        // return [
        //     [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        // ];
        return [];
    }
    
    public function upload()
    {
        //if ($this->validate()) {
            $this->imageFile->saveAs2('uploads/dodo.jpg');
            return true;
        // } else {
        //     return false;
        // }
    }
}