<?php
/**
 * @var $this yii\web\View
 * @var $form yii\bootstrap\ActiveForm
 * @var $model \backend\models\PasswordChangeForm
 */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Password Change';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="password-change">

    <p>Please fill out the following fields to change password:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin([
                'id' => 'password-change-form',
                'enableClientValidation' => false,
            ]); ?>
            <?= $form->field($model, 'password')->passwordInput() ?>
            <?= $form->field($model, 'passwordRepeat')->passwordInput() ?>
            <div class="form-group">
                <?= Html::submitButton('Change', ['class' => 'btn btn-primary', 'name' => 'change-password-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>