<?php

namespace app\controllers\api;

use yii\rest\Controller;
use app\models\TaskModel;

class TasksController extends Controller
{
    public function actionIndex()
    {
        return TaskModel::find()
            ->select(['name', 'status', 'date_end', 'story_point'])
            ->orderBy('id')->all();
    }
}