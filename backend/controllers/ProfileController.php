<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace backend\controllers;

use backend\components\Controller;
use backend\models\PasswordChangeForm;

class ProfileController extends Controller
{
    public function actionChangePassword()
    {
        $model = new PasswordChangeForm();

        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            $model->process();
            \Yii::$app->session->setFlash('success', 'Password was changed');
            return $this->redirect(['/']);
        }

        return $this->render('change-password', [
            'model' => $model,
        ]);
    }
}