<?php

namespace app\controllers;

use app\controllers\api\TasksController;
use app\models\TaskModel;
use app\models\User;
use app\repositories\TaskRepository;
use app\repositories\UserRepository;
use app\traits\CreateValidationTrait;
use Yii;

class TaskController extends \yii\web\Controller
{
    use CreateValidationTrait;

    public $tasks;
    private $taskRepository;
    private $userRepository;

    public function __construct($id, $module, TaskRepository $taskRepository, UserRepository $userRepository, TasksController $tasks, $config = [])
    {
        $this->taskRepository = $taskRepository;
        $this->userRepository = $userRepository;
        parent::__construct($id, $module, $config);
    }

    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['/site/login']);
        }

        $status = Yii::$app->request->get('status');

        $tasks = $this->taskRepository;
        $workers = $this->userRepository->getAllUsers();

        if ($status) {
            if ($status === '*') {
                return $this->asJson($tasks->getAllTasks());
            }
            return $this->asJson($tasks->filterByStatus($status)->asArray()->all());
        }
        return $this->render('index', [
            'tasksByStatus' => $tasks->getAllTasks(),
            'workers' => $workers,
        ]);
    }

    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['/site/login']);
        }

        return $this->render('view', [
            'task' => TaskModel::findOne($id),
        ]);
    }

    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['/site/login']);
        }

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
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['/site/login']);
        }

        $task = $this->taskRepository->getTaskById($id);
        $workers = User::find()->all();
        $currentWorker = User::findOne($task->user_id);

        if ($task->load(Yii::$app->request->post())) {

            $this->taskRepository->ratingСalculation($task);

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
            'workers' => $workers,
            'currentWorker' => $currentWorker,
        ]);
    }

}
