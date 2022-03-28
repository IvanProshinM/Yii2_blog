<?php

namespace app\models;

use yii\base\Model;

class Authorization extends Model
{
    public $username;
    public $userSurname;
    public $email;
    public $password;


    public function rules() {
        return [
            [['username', 'userSurname', 'email', 'password', 'confirmPassword', 'gender'], 'required' ],
            ['email', 'email'],
            [['password'], 'string','min' =>6 , 'max'=> 15],
            [['confirmPassword'], 'confirmPassword' ],
            [['username', 'userSurname'],'string', 'min' => 5, 'max' => 15 ],
            [['username', 'userSurname'], 'match', 'pattern' => '/^[А-яА-Я0-9_ ]/'],
            ['gender', 'in', 'range' =>[0,1]]
        ];
    }
    public function confirmPassword($attribute) {
        if (($this->password !== $this->$attribute)) {
            $this->addError($attribute, 'Введенные пароли не совпадают');
        }
    }



}