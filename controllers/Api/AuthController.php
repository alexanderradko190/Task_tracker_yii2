<?php

namespace app\controllers\api;

use app\models\LoginForm;
use app\models\RegisterForm;
use Yii;
use yii\rest\Controller;

class AuthController extends Controller
{
    public function actionRegister()
    {
        $model = new RegisterForm();

        $data = json_decode(Yii::$app->request->getBody(), true);

        if ($data && $model->load($data)) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return ['status' => 'success', 'message' => 'Вы зарегистрировались в системе'];
                }
            }
        }

        return ['status' => 'error', 'message' => 'Не удалось зарегистрироваться в системе', 'errors' => $model->getErrors()];
    }

    public function actionLogin()
    {
        $model = new LoginForm();

        $data = json_decode(Yii::$app->request->getBody(), true);

        if ($data && $model->load(Yii::$app->request->post()) && $model->login()) {
            return ['status' => 'success', 'message' => 'Вы вошли в систему'];
        }

        return ['status' => 'error', 'message' => 'Не удалось войти в систему', 'errors' => $model->getErrors()];
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return ['status' => 'success', 'message' => 'Вы вышли из системы'];
    }
}