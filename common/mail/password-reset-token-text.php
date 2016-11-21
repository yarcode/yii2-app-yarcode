<?php

/* @var $this yii\web\View */
/* @var $user common\models\UserAccount */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);
?>
Hello <?= $user->name ?>,

Follow the link below to reset your password:

<?= $resetLink ?>
