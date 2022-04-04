<?php

namespace app\services;
use app\models\User;
use Yii;




class UserRegistrationNotificationService
{
    public function send(User $user) : void
    {
        Yii::$app->mailer->compose('registrationLink', ['user' => $user])
            ->setFrom('proshinvanivanoff@yandex.ru')
            ->setTo($user->email)
            ->setSubject('Подтверждение регистрации')
            ->send();
    }
}