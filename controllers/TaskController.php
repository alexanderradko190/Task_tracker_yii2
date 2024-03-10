<?php

namespace app\controllers;

use app\controllers\api\TasksController;
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
        ]);
    }

//    public function actionNew()
//    {
//        if (Yii::$app->user->isGuest) {
//            return $this->redirect(['/site/login']);
//        }
//
//        $tasks = $this->taskRepository->getTasksNew();
//
//        return $this->render('new', [
//            'tasks' => $tasks,
//        ]);
//    }

//    public function actionAtwork()
//    {
//        if (Yii::$app->user->isGuest) {
//            return $this->redirect(['/site/login']);
//        }
//
//        $tasks = $this->taskRepository->getTasksAtWork();
//
//        return $this->render('atwork', [
//            'tasks' => $tasks,
//        ]);
//    }
//
//    public function actionReview()
//    {
//        if (Yii::$app->user->isGuest) {
//            return $this->redirect(['/site/login']);
//        }
//
//        $tasks = $this->taskRepository->getTasksReview();
//
//        return $this->render('review', [
//            'tasks' => $tasks,
//        ]);
//    }
//
//    public function actionIntest()
//    {
//        if (Yii::$app->user->isGuest) {
//            return $this->redirect(['/site/login']);
//        }
//
//        $tasks = $this->taskRepository->getTasksInTest();
//
//        return $this->render('intest', [
//            'tasks' => $tasks,
//        ]);
//    }
//
//    public function actionReadytorelease()
//    {
//        if (Yii::$app->user->isGuest) {
//            return $this->redirect(['/site/login']);
//        }
//
//        $tasks = $this->taskRepository->getTasksReadyToRelease();
//
//        return $this->render('readytorelease', [
//            'tasks' => $tasks,
//        ]);
//    }
//
//    public function actionNeedinfo()
//    {
//        if (Yii::$app->user->isGuest) {
//            return $this->redirect(['/site/login']);
//        }
//
//        $tasks = $this->taskRepository->getTasksNeedInfo();
//
//        return $this->render('needinfo', [
//            'tasks' => $tasks,
//        ]);
//    }
//
//    public function actionIsReady()
//    {
//        if (Yii::$app->user->isGuest) {
//            return $this->redirect(['/site/login']);
//        }
//
//        $tasks = $this->taskRepository->getTasksByDate();
//
//        return $this->render('is_ready', [
//            'tasks' => $tasks,
//        ]);
//    }

}
