<?php

namespace app\controllers;

use app\models\TaskModel;
use app\models\WorkerModel;
use Yii;
use yii\web\Request;

class ApiController extends \yii\web\Controller {
    public function actionGetWorkers()
    {
        $workersArray = WorkerModel::find()->all();
        $workers = json_encode($workersArray);

        return $workers;
    }

    public function actionGetTasks()
    {
        $tasksArray = TaskModel::find()->all();

        $tasks = json_encode($tasksArray);

        return $tasks;
    }

}