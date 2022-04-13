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

$this->registerCssFile("@web/css/staffProfile.css");
$this->title = 'Search results';
?>
<h1><?= Html::encode($this->title) ?></h1>
<?php foreach ($staffList as $key => $value): ?>
    <div class="staff-item">
        <div class="staff-item_image">
            <img class="profile-photo" src="/files/<?= $value->imageFile ?>" alt="">
        </div>
        <div class="search-list_text">
        <p><?= $value->staffName; ?></p>
        <p><?= $value->staffPosition; ?></p>
        <p><?= $value->staffSpecialization; ?></p>
        <p><?= $value->age; ?></p>
        </div>

    </div>
<?php endforeach; ?>






