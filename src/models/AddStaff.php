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


    const SCENARIO_ADD = 'staffAdd';
    const SCENARIO_CHANGE = 'staffChange';

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_ADD] = ['staffName', 'staffPosition', 'staffSpecialization', 'age', 'imageFile'];
        $scenarios[self::SCENARIO_CHANGE] = ['staffName', 'staffPosition', 'staffSpecialization', 'age', 'imageFile'];
        return $scenarios;
    }

    public function rules()
    {
        return [
            [['staffName', 'staffPosition', 'staffSpecialization'], 'match', 'pattern' => '/^[А-яА-Я_ ]/'],
            ['imageFile', 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'checkExtensionByMimeType' => false],
            [['staffName', 'staffPosition', 'staffSpecialization', 'age', 'imageFile'], 'required', 'on' => self::SCENARIO_ADD],
            [['staffName', 'staffPosition', 'staffSpecialization', 'age'], 'required', 'on' => self::SCENARIO_CHANGE]

        ];
    }


    public function upload(): ?string
    {
        \Yii::warning($this->validate());
        \Yii::warning($this->errors);
        if ($this->validate() && $this->imageFile !== null) {
            $fileName = md5($this->staffName . time()) . '.' . $this->imageFile->extension;
            $filePath = Yii::getAlias('@webroot/files/' . $fileName);
            $this->imageFile->saveAs($filePath);
        }
        return $fileName;
    }

}
