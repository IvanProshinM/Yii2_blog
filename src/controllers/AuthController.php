<?php

namespace app\controllers;


use app\models\Authorization;
use app\models\User;
use app\services\UserAuthorizationService;
use app\services\UserCreateService;
use app\services\UserRegistrationNotificationService;
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

    public function __construct(
        $id,
        $module,
        UserCreateService $userCreateService,
        UserRegistrationNotificationService $userRegistrationNotification,
        UserAuthorizationService $userAuthorizationService,
        $config = []
    )
    {
        parent::__construct($id, $module, $config);
        $this->userCreateService = $userCreateService;
        $this->userRegistrationNotification = $userRegistrationNotification;
        $this->userAuthorizationService = $userAuthorizationService;

    }

    public function actionRegistration()
    {
        $model = new Registration();
        $session = Yii::$app->session;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $user = $this->userCreateService->create($model);
            $user->save();
            $this->userRegistrationNotification->send($user);
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
                Yii::$app->user->login($currentUser);
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
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $currentUser = User::find()
                ->where(['email' => $model->email])
                ->one();
//
        }
        return $this->render('recover', ['model' => $model]);
    }

    public function actionConfirm()
    {

    }
}
