<?php


namespace app\services;

use app\models\AddStaff;
use app\models\Staff;
use Yii;
use yii\web\UploadedFile;


class StaffAddService
{
    public function addStaff(AddStaff $model, string $fileName): ?Staff
    {
        $staff = new Staff();
        $staff->staffName = $model->staffName;
        $staff->staffPosition = $model->staffPosition;
        $staff->staffSpecialization = $model->staffSpecialization;
        $staff->age = $model->age;
        $staff->imageFile = $fileName;
        return $staff;
    }
}