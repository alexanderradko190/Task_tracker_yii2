<?php

namespace app\controllers\api;

use app\services\TaskService;
use yii\filters\AccessControl;
use yii\rest\Controller;

class TasksController extends Controller
{
    private TaskService $taskService;

    public function __construct(
        $id,
        $module,
        TaskService $taskService,
        $config = []
    ) {
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
                        'actions' => ['index', 'task-status'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->taskService->getTasksById();
    }

    public function actionTaskStatus()
    {
        return $this->taskService->getTasks();

    }
}