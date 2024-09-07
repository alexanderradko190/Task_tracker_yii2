<?php

namespace app\controllers;

use app\models\TaskModel;
use app\repositories\TaskRepository;
use app\repositories\UserRepository;
use app\services\TaskService;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class TaskController extends Controller
{
    private TaskRepository $tasks;
    private UserRepository $users;
    private TaskService $taskService;

    public function __construct(
        $id,
        $module,
        TaskRepository $tasks,
        UserRepository $users,
        TaskService $taskService,
        $config = []
    ) {
        $this->tasks = $tasks;
        $this->users = $users;
        $this->taskService = $taskService;
        parent::__construct($id, $module, $config);
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
                'denyCallback' => function ($rule, $action) {
                    return Yii::$app->response->redirect(['/site/login']);
                },
            ],
        ];
    }

    public function actionIndex()
    {
        $status = Yii::$app->request->get('status');
        $tasksData = $this->taskService->getTasksByStatus($status);

        if (Yii::$app->request->isAjax) {
            return $this->asJson($tasksData['tasks']);
        }

        return $this->render('index', [
            'tasksByStatus' => $tasksData['tasks'],
            'workers' => $tasksData['workers']
        ]);
    }

    public function actionView($id)
    {
        $task = $this->taskService->getTask($id);

        return $this->render('view', [
            'task' => $task,
        ]);
    }

    public function actionCreate()
    {
        $task = new TaskModel();
        $task->user_id = Yii::$app->user->id;

        if ($task->load(Yii::$app->request->post()) && $task->validate()) {
            $this->taskService->createTask($task);
            return $this->redirect(['view', 'id' => $task->id]);
        }

        return $this->render('create', [
            'task' => $task,
        ]);
    }

    public function actionUpdate($id)
    {
        $task = $this->tasks->getTaskById($id);
        $workers = $this->users->getAllWorkers();
        $currentWorker = $this->users->findWorkersByUserId($task->user_id);

        if ($task->load(Yii::$app->request->post()) && $task->validate()) {
            $this->taskService->updateTask($task);

            return $this->redirect(['view', 'id' => $task->id]);
        }

        return $this->render('update', [
            'task' => $task,
            'workers' => $workers,
            'currentWorker' => $currentWorker,
        ]);
    }
}
