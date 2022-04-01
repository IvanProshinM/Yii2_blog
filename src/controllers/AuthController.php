<?php

namespace app\controllers;


use app\models\Authorization;
use app\models\User;
use Yii;
use yii\base\Model;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use app\models\Registration;
use app\models\Recover;


class AuthController extends Controller
{

    public function actionRegistration()
    {
        $model = new Registration();
        $session = Yii::$app->session;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $User = new User();
            $User->username = $model->username;
            $User->userSurname = $model->userSurname;
            $User->email = $model->email;
            $User->setPassword($model->password);
            $User->gender = $model->gender;
            $User->activateHash = Yii::$app->security->generatePasswordHash($model->email);
            $User->activatedAt = null;
            $User->save();
            $currentUser = User::find()
                ->where(['activateHash' => $User->activateHash])
                ->one();

            Yii::$app->mailer->compose('registrationLink', ['user'=>$currentUser])
                ->setFrom('proshinvanivanoff@yandex.ru')
                ->setTo($model->email)
                ->setSubject('Подтверждение регистрации')
                /* ->setTextBody('Привет')*/
                /*  ->setHtmlBody('<b>текст сообщения в формате HTML</b>')*/
                ->send();
            $session->setFlash('success', 'Регистрация пройдена. Проверьте почту для активации аккаунта');

            return $this->render('registration', ['model' => $model]);
        }
        return $this->render('registration', ['model' => $model]);
    }

    public function actionAuthorization()
    {
        $model = new Authorization();
        $session = Yii::$app->session;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            /** @var User|null $currentUser */
            $currentUser = User::find()
                ->where(['email' => $model->email])
                ->one();
            if ($currentUser && ($currentUser->validatePassword($model->password))) {
                $session->setFlash('success', 'Вы авторизовались');
                Yii::$app->user->login($currentUser);
                return $this->redirect(['site/index']);

            } else {

                $session->setFlash('error', 'Такого пользователя нет в БД');

                return $this->render('authorization', ['model' => $model]);
            }

        }

        return $this->render('authorization', ['model' => $model]);
    }


    public function actionRecover()
    {
        $model = new Recover();
        return $this->render('recover', ['model' => $model]);
    }

    public function actionConfirm() {

    }
}
