<?php


namespace app\controllers;

use app\models\StaffSearchForm;
use app\services\StaffChangeService;
use yii\web\UploadedFile;
use app\models\AddStaff;
use app\search\StaffSearch;
use yii\web\NotFoundHttpException;
use app\models\Staff;
use app\services\StaffAddService;
use yii\web\Controller;
use Yii;


class StaffController extends Controller
{

    /**
     * @var StaffAddService
     */
    private $staffAddService;

    /**
     * @var StaffChangeService
     */
    private $staffChangeService;


    public function __construct(
        $id,
        $module,
        StaffAddService $staffAddService,
        StaffChangeService $staffChangeService,
        $config = []
    )
    {
        parent::__construct($id, $module, $config);
        $this->staffAddService = $staffAddService;
        $this->staffChangeService = $staffChangeService;
    }


    public function actionAddStaff()
    {
        $model = new AddStaff();
        $model->scenario = AddStaff::SCENARIO_ADD;
        $session = Yii::$app->session;
        $admin = !Yii::$app->user->isGuest && Yii::$app->user->identity->isAdmin();
        if (!$admin) {
            return $this->redirect('view-staff');
        } else {
            if ($model->load(Yii::$app->request->post())) {
                $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
                $fileName = $model->upload();
                if ($fileName !== null) {
                    $staff = $this->staffAddService->addStaff($model, $fileName);
                    $staff->save();
                    $session->setFlash('success', 'Сотрудник успешно добавлен в базу.');

                } else {
                    $session->setFlash('error', 'Сотрудник успешно не добавлен в базу.');

                }
            }
        }

        return $this->render('staffAddField', ['model' => $model]);

    }

    public function actionViewStaff()
    {

        $searchModel = new StaffSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        return ($this->render('staffList', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]));

    }


    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    protected function findModel($id)
    {
        if (($model = Staff::findOne(['id' => $id])) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionChangeStaff($id)
    {
        $session = Yii::$app->session;
        $staff = Staff::find()
            ->where(['id' => $id])
            ->one();
        $model = new AddStaff();
        $model->scenario = AddStaff::SCENARIO_CHANGE;
        $model->load($staff->attributes, '');
        Yii::warning($staff->attributes);
        Yii::warning($staff->attributes);
        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post())) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');

            if ($model->validate()) {
                $fileName = $model->upload();
                $staff = $this->staffChangeService->ChangeStaff($model, $fileName, $staff);
                $staff->save();
                $session->setFlash('success', 'Данные сотрудика успешно изменены.');

            }


        }


        return $this->render('staffChange', ['model' => $model]);
    }

    public function actionSearch($query)
    {
        $staffList = Staff::find()
            ->orWhere(['like', 'staffName', $query])
            ->orWhere(['like', 'staffPosition', $query])
            ->orWhere(['like', 'staffSpecialization', $query])
            ->orWhere(['like', 'Age', $query])
            ->all();
        return $this->render('staffSearchList', ['staffList' => $staffList]);
    }


}