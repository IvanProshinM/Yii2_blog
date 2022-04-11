<?php

namespace app\services;

use app\models\User;
use Yii;
use yii\base\Component;

class UserCreateService
{
    public function __construct()
    {
    }


    public function create(\app\models\Registration $model) : User
    {

            $User = new User();
            $User->username = $model->username;
            $User->userSurname = $model->userSurname;
            $User->email = $model->email;
            $User->setPassword($model->password);
            $User->gender = $model->gender;
            $User->activateHash = Yii::$app->security->generatePasswordHash($model->email);
            $User->activatedAt = date("F j, Y, g:i a");

            return $User;
    }

}