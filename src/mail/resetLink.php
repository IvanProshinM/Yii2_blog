
<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var $user */

$verifyLink = Yii::$app->urlManager->createAbsoluteUrl(['auth/change-password', 'ResetHash' => $user->ResetHash]);
?>
<div class="verify-email">
    <p>Hello <?= Html::encode($user->username) ?>,</p>

    <p>Follow the link below to reset your password:</p>

    <p><?= Html::a(Html::encode($verifyLink), $verifyLink) ?></p>
</div>








<?php
