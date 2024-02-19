<?php

namespace app\controllers;

use app\models\TaskModel;
use app\models\User;
use app\models\WorkerModel;
use Yii;
use yii\web\Request;

class TaskController extends \yii\web\Controller
{
    public $tasks;
    public $organizations;

    public function actionIndex()
    {
        $tasks = TaskModel::find()->orderBy('date_end')->all();
        $workers = User::find()->orderBy('rate')->all();

        return $this->render('index', [
            'tasks' => $tasks,
            'workers' => $workers,
        ]);
    }

    public function actionView($id) {

        return $this->render('view', [
            'task' => TaskModel::findOne($id),
        ]);
    }

    public function actionCreate()
    {
        $task = new TaskModel();
        $task->user_id = Yii::$app->user->id;
        if ($task->load(Yii::$app->request->post()) && $task->save()) {
            // Обработка успешного сохранения модели
            return $this->redirect(['view', 'id' => $task->id]);
        }

        return $this->render('create', [
            'task' => $task,
//            'worker' => $worker,
        ]);
    }

    public function actionUpdate($id)
    {
        $task = TaskModel::findOne($id);

        if ($task->load(Yii::$app->request->post()) && $task->save()) {

            return $this->redirect(['view', 'id' => $task->id]);
        }

        return $this->render('update', [
            'task' => $task,
        ]);
    }

    public function actionSort() {
        $tasks = TaskModel::find()->orderBy('story_point')->all();

        return $this->render('index', [
            'tasks' => $tasks,
        ]);
    }


    public function actionDelete($id) {

    }

}
