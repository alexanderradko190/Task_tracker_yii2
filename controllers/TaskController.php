<?php

namespace app\controllers;

use app\models\TaskModel;
use app\models\User;
use app\models\WorkerModel;
use app\traits\CreateValidationTrait;
use Yii;
use yii\web\Request;

class TaskController extends \yii\web\Controller
{
    use CreateValidationTrait;

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
        if ($task->load(Yii::$app->request->post())) {
            $nameError = $this->validateText($task->name);
            $descriptionError = $this->validateText($task->description);
            if ($nameError === false) {
                $task->addError('name', 'Название задачи может содержать только буквы или цифры');
            } else if ($descriptionError === false) {
                $task->addError('description', 'Описание задачи может содержать только буквы или цифры');
            } else {
                if ($task->save()) {
                    return $this->redirect(['view', 'id' => $task->id]);
                }

            }
        }

        return $this->render('create', [
            'task' => $task,
//            'worker' => $worker,
        ]);
    }

    public function actionUpdate($id)
    {
        $task = TaskModel::findOne($id);

        if ($task->load(Yii::$app->request->post())) {

            $nameError = $this->validateText($task->name);
            $descriptionError = $this->validateText($task->description);
            if ($nameError === false) {
                $task->addError('name', 'Название задачи может содержать только буквы или цифры');
            } else if ($descriptionError === false) {
                $task->addError('description', 'Описание задачи может содержать только буквы или цифры');
            } else {
                if ($task->save()) {
                    return $this->redirect(['view', 'id' => $task->id]);
                }
            }
        }

        return $this->render('update', [
            'task' => $task,
        ]);
    }

    public function actionSortSp() {
        $tasks = TaskModel::find()->orderBy(['story_point' => SORT_ASC])->all();

        return $this->render('sort_sp', [
            'tasks' => $tasks,
        ]);
    }

    public function actionSortPriority() {
        $tasks = TaskModel::find()->orderBy(['date_end' => SORT_ASC])->all();

        return $this->render('sort_priority', [
            'tasks' => $tasks,
        ]);
    }

    public function actionSortDate() {
        $tasks = TaskModel::find()->orderBy(['id' => SORT_DESC])->all();

        return $this->render('sort_priority', [
            'tasks' => $tasks,
        ]);
    }


    public function actionDelete($id) {

    }

}
