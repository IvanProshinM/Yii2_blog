<?php

namespace app\controllers;


use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use app\models\Registration;
use app\models\Users;

class AuthController extends Controller
{

    public function actionRegistration()
    {
        $model = new Registration();
        $session = Yii::$app->session;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            Yii::$app->mailer->compose()
                ->setFrom('proshinvanivanoff@yandex.ru')
                ->setTo($model->email)
                ->setSubject('Подтверждение регистрации')
                ->setTextBody('Привет')
                /*  ->setHtmlBody('<b>текст сообщения в формате HTML</b>')*/
                ->send();
            $session->setFlash('success', 'Регистрация пройдена. Проверьте почту для активации аккаунта');
            $Users = new Users();
            $Users->username = $model->username;
            $Users->userSurname =$model->userSurname;
            $Users->email = $model->email;
            $Users->password =$model->password;
            $Users->gender =$model->gender;
            $Users->save();

            return $this->render('registration', ['model' => $model]);
        }
        return $this->render('registration', ['model' => $model]);
    }

    public function actionAuthorization() {
        $model = new Registration();

        return $this->render('authorization',['model'=> $model]);
    }
}

