<?php

namespace app\models;

use yii\base\Model;

class Authorization extends Model
{

    public $email;
    public $password;




    public function rules() {
        return [
            [['email', 'password'], 'required' ],
            ['email', 'email'],
            [['password'], 'string','min' =>6 , 'max'=> 15],
            ['password', 'validatePassword']

        ];
    }

    public function validatePassword ($attribute)
    {
        if (!$this->hasErrors()) {
           $user = $this->getUser();
        }
        if (!$user || !$user->validatePassword($this->password)) {
            $this->addError($attribute, 'Incorrect username or password.');
        }
    }

    public function getUser() {
        return  User::find()
            ->where(['email'=>$this->email])
            ->one();
    }
}
