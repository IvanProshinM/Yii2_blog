<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\widgets\ListView;


/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model app\models\AddStaff */
/* @var $staffList \app\controllers\StaffController */
?>


<? /* foreach ($staffList as $key => $value) {
    echo $value->staffName;
    echo $value->staffPosition;
    echo $value->staffSpecialization;
    echo $value->age;
}
*/ ?>

<?php foreach ($staffList as $key => $value): ?>
    <tr>
        <p><?= $value->staffName; ?></p>
        <p><?= $value->staffPosition; ?></p>
        <p><?= $value->staffSpecialization; ?></p>
        <p><?= $value->age; ?></p>
        <div class="staff-item_image">
            <img class="profile-photo" src="/files/<?= $value->imageFile ?>" alt="">
        </div>
    </tr>
<?php endforeach; ?>






