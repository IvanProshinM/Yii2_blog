<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;



/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model app\models\Registration */



$this->title = 'Регистрация';
?>
    <h1><?= Html::encode($this->title) ?></h1>


<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'username') ?>
<?= $form->field($model, 'userSurname') ?>
<?= $form->field($model, 'email') ?>
<?= $form->field($model, 'password') ?>
<?= $form->field($model, 'confirmPassword')->passwordInput() ?>

<!--    <select class="form-control" name="country">
        <option disabled>Выберите пол.</option>
        <option value="Мужской">Муж.</option>
        <option value="Женский">Жен.</option>
    </select>-->


<?php echo $form->field($model, 'gender')->dropDownList([
    '0' => 'Мужской',
    '1' => 'Женский',

    ]);
?>

    <div class="form-group">
        <br>
        <?= Html::submitButton('Зарегистрироваться', ['class' => 'btn btn-primary']) ?>
    </div>

<?php echo Yii::$app->session->getFlash('alert'); ?>

<?php ActiveForm::end(); ?>