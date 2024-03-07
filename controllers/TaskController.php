<?php

namespace app\controllers;

use app\models\TaskModel;
use app\repositories\TaskRepository;
use app\repositories\UserRepository;
use app\traits\CreateValidationTrait;
use DateTime;
use Yii;

class TaskController extends \yii\web\Controller
{
    use CreateValidationTrait;

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
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['/site/login']);
        }

        $tasks = $this->taskRepository->getAllTasks();
        $workers = $this->userRepository->getAllUsers();

        return $this->render('index', [
            'tasks' => $tasks,
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

        if ($task->load(Yii::$app->request->post())) {

            $now = new DateTime();
            $deadline = new DateTime($task->date_end);
            $ratio_sp = $deadline->diff($now);

            if ($ratio_sp->d >= 1) {
                $task->story_point = max(0, $task->story_point - $ratio_sp->d);
                $task->story_point = (string)$task->story_point;
            }

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
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['/site/login']);
        }

        $tasks = $this->taskRepository->getTasksByStoryPoint();

        return $this->render('sort_sp', [
            'tasks' => $tasks,
        ]);
    }

    public function actionSortPriority()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['/site/login']);
        }

        $tasks = $this->taskRepository->getTasksByPriority();

        return $this->render('sort_priority', [
            'tasks' => $tasks,
        ]);
    }

    public function actionSortDate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['/site/login']);
        }

        $tasks = $this->taskRepository->getTasksByDate();

        return $this->render('sort_priority', [
            'tasks' => $tasks,
        ]);
    }

}
