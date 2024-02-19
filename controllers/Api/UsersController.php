<?php

namespace app\controllers\api;

use yii\rest\Controller;
use app\models\User;

class UsersController extends Controller
{
    public function actionIndex()
    {
        return User::find()
            ->select(['id', 'username', 'email'])
            ->orderBy('id')->all();
    }
}