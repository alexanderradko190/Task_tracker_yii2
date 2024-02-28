<?php

namespace app\controllers;

use app\models\TaskModel;
use app\repositories\TaskRepository;
use app\repositories\UserRepository;
use app\traits\CheckAuthUsersTrait;
use app\traits\CreateValidationTrait;
use Yii;

class TaskController extends \yii\web\Controller
{
    use CreateValidationTrait, CheckAuthUsersTrait;

    public $tasks;
    private $taskRepository;
    private $userRepository;

    public function __construct($id, $module, TaskRepository $taskRepository, UserRepository $userRepository, $config = [])
    {
        $this->taskRepository = $taskRepository;
        $this->userRepository = $userRepository;
        parent::__construct($id, $module, $config);
    }

    public function actionIndex()
    {
        $this->checkAuthorization();

        $tasks = $this->taskRepository->getAllTasks();
        $workers = $this->userRepository->getAllUsers();

        return $this->render('index', [
            'tasks' => $tasks,
            'workers' => $workers,
        ]);
    }

    public function actionView($id)
    {
        $this->checkAuthorization();

        return $this->render('view', [
            'task' => TaskModel::findOne($id),
        ]);
    }

    public function actionCreate()
    {
        $this->checkAuthorization();

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
        $this->checkAuthorization();

        $task = $this->taskRepository->getTaskById($id);

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

    public function actionSortSp()
    {
        $this->checkAuthorization();

        $tasks = $this->taskRepository->getTasksByStoryPoint();

        return $this->render('sort_sp', [
            'tasks' => $tasks,
        ]);
    }

    public function actionSortPriority()
    {
        $this->checkAuthorization();

        $tasks = $this->taskRepository->getTasksByPriority();

        return $this->render('sort_priority', [
            'tasks' => $tasks,
        ]);
    }

    public function actionSortDate()
    {
        $this->checkAuthorization();

        $tasks = $this->taskRepository->getTasksByDate();

        return $this->render('sort_priority', [
            'tasks' => $tasks,
        ]);
    }

}
