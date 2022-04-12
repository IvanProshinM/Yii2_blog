<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\widgets\ListView;


/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model app\models\AddStaff */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = 'Staff List';
?>


<label for="site-search">Search the site:</label>
<form method="get" action="search">
    <input type="text" name="query" >
    <input type="submit" value="Search">
</form>


<h1><?= Html::encode($this->title) ?></h1>
<div class="staff-index">
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => function ($model) {
            return $this->render('staffItem', ['model' => $model]);
        },
    ]) ?>
</div>

<div class="form-group">
    <br>

    <?php
    $admin = !Yii::$app->user->isGuest && Yii::$app->user->identity->isAdmin();
    if ($admin) {
        echo Html::a('Add staff', ['staff/add-staff'], ['target' => '_blank']);
    }
    ?>

</div>









