<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model app\models\AddStaff */


$this->title = 'Staff Change';
?>
    <h1><?= Html::encode($this->title) ?></h1>


<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
<?= $form->field($model, 'staffName'    ) ?>
<?= $form->field($model, 'staffPosition') ?>
<?= $form->field($model, 'staffSpecialization') ?>
<?= $form->field($model, 'age') ?>
    <br>
<?= $form->field($model, 'imageFile')->fileInput() ?>


    <div class="form-group">
        <br>
        <?= Html::submitButton('Change', ['class' => 'btn btn-primary']) ?>
    </div>

<?php echo Yii::$app->session->getFlash('alert'); ?>


<?php ActiveForm::end(); ?>