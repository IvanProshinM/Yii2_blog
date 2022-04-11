<?php

namespace app\controllers;


use app\models\Authorization;
use app\models\ChangePassword;
use app\models\User;
use app\services\UserAuthorizationService;
use app\services\UserCreateService;
use app\services\UserRecoverPasswordService;
use app\services\UserRegistrationNotificationService;
use app\services\UserFindEmailService;
use Yii;
use yii\base\Model;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use app\models\Registration;
use app\models\Recover;
use app\models\Test;

class AuthController extends Controller
{

    /**
     * @var UserCreateService
     */
    private $userCreateService;
    /**
     * @var UserRegistrationNotificationService
     */
    private $userRegistrationNotification;
    /**
     * @var UserAuthorizationService
     */
    private $userAuthorizationService;
    /**
     * @var UserRecoverPasswordService
     */
    private $userRecoverPasswordService;

    /**
     * @var UserFindEmailService
     */
    private $userFindEmailService;


    public function __construct(
        $id,
        $module,
        UserCreateService $userCreateService,
        UserRegistrationNotificationService $userRegistrationNotification,
        UserAuthorizationService $userAuthorizationService,
        UserRecoverPasswordService $userRecoverPasswordService,
        UserFindEmailService $userFindEmailService,
        $config = []
    )
    {
        parent::__construct($id, $module, $config);
        $this->userCreateService = $userCreateService;
        $this->userRegistrationNotification = $userRegistrationNotification;
        $this->userAuthorizationService = $userAuthorizationService;
        $this->userRecoverPasswordService = $userRecoverPasswordService;
        $this->userFindEmailService = $userFindEmailService;

    }

    public function actionRegistration()
    {
        $model = new Registration();
        $session = Yii::$app->session;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $uniqueMail = $this->userFindEmailService->findMail($model);
            /*var_dump($uniqueMail);*/
            if ($uniqueMail) {

                $session->setFlash('error', 'Пользователь с данной почтой существует');
                return $this->render('registration', ['model' => $model]);
            }
            $user = $this->userCreateService->create($model);
            $user->save();
            $this->userRegistrationNotification->send($user);

            $model = new Registration();
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
            $currentUser = $this->userAuthorizationService->authorizate($model);
            if ($currentUser != null) {
                Yii::$app->user->login($currentUser, 3600);
                $session->setFlash('success', 'Вы успешно авторизовались');
                return $this->redirect(['site/index']);
            }
            $session->setFlash('error', 'Такого пользователя нет в БД или введен неверный пароль');
        }
        return $this->render('authorization', ['model' => $model]);
    }


    public function actionRecover()
    {
        $model = new Recover();
        $session = Yii::$app->session;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $recover = $this->userRecoverPasswordService->reset($model);
            if ($recover) {
                $session->setFlash('success', 'Ссылка для сброса пароля отправлена на Вашу почту');
                return $this->redirect(['auth/authorization']);
            } else {
                $session->setFlash('error', 'Такого пользователя нет в БД');
                return $this->redirect(['auth/recover']);
            }
        }
        return $this->render('recover', ['model' => $model]);
    }

    public function actionChangePassword($ResetHash)
    {
        $model = new ChangePassword();
        $session = Yii::$app->session;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $user = $this->userRecoverPasswordService->changePassword($model, $ResetHash);
            $user->save();
            $session->setFlash('success', 'Пароль успешно изменён.');
            return $this->redirect(['auth/authorization']);

        } else {
            return $this->render('changePassword', ['model' => $model]);
        }

    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        $session = Yii::$app->session;
        $session->setFlash('success', 'Вы успешно разлогинились.');
        return $this->redirect(['auth/authorization']);
    }

}
