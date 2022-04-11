<?php


namespace app\models;
use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class AddStaff extends Model
{
    public $staffName;
    public $staffPosition;
    public $staffSpecialization;
    public $age;

    /**
     * @var UploadedFile
     */
    public $imageFile;


    public function rules()
    {
        return [
            [['staffName', 'staffPosition', 'staffSpecialization', 'age'], 'required'],
            [['staffName', 'staffPosition', 'staffSpecialization'], 'match', 'pattern' => '/^[А-яА-Я_ ]/'],
            ['imageFile', 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'checkExtensionByMimeType' => false]
        ];
    }

    public function upload(): ?string
    {
        \Yii::warning($this->validate());
        \Yii::warning($this->errors);
        if ($this->validate()) {
            $fileName = md5($this->staffName . time()).'.'.$this->imageFile->extension;
            $filePath = Yii::getAlias('@webroot/files/' . $fileName);
            $this->imageFile->saveAs($filePath);
            return $fileName;
        } else {
            return null;
        }
    }

}
