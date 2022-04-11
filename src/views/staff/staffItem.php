<?php

use yii\helpers\Html;
use app\models\Staff;

/** @var Staff $model */
/** @var app\controllers\StaffController $admin */



$this->registerCssFile("@web/css/staffProfile.css")

?>


<br>
<div class="staff-item">
    <div class="staff-item_image">
        <img class="profile-photo" src="/files/<?= $model->imageFile ?>" alt="">
    </div>
    <div class="staff-item_text">
        <span>Name:  </span><?= $model->staffName ?><br>
        <span>Position:  </span><?= $model->staffPosition ?> <br>
        <span>Specialization:  </span><?= $model->staffSpecialization ?> <br>
        <span>Age:  </span><?= $model->age ?> <br>
        <br>
        <br>
        <div>
        <?php
        $admin = !Yii::$app->user->isGuest && Yii::$app->user->identity->isAdmin();
        $id = $model->id;
        if ($admin) {
            echo Html::a('Change staff', ['staff/change-staff', 'id'=>$id], ['target'=>'_blank']);
        }
        ?>
    </div>



</div>


