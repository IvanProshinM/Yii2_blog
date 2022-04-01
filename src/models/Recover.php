<?php


namespace app\models;

use yii\base\Model;

class Recover extends Model
{
    public $email;

    public function rules()
    {
        return [
            [['email'], 'required'],
            ['email', 'email'],
        ];
    }

    public function confirmPassword($attribute)
    {
        if (($this->password !== $this->$attribute)) {
            $this->addError($attribute, 'Введенные пароли не совпадают');
        }
    }


}
