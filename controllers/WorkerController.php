<?php

namespace app\controllers;

use app\models\TaskModel;
use app\models\User;
use app\models\WorkerModel;

class WorkerController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $workers = User::find()->all();

        return $this->render('index', [
            'workers' => $workers,
        ]);
    }

}
