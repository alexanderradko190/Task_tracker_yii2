<?php

namespace app\controllers\api;

use app\services\TaskService;
use yii\rest\Controller;

class TasksController extends Controller
{
    private $taskService;

    public function __construct($id, $module, TaskService $taskService, $config = [])
    {
        $this->taskService = $taskService;
        parent::__construct($id, $module, $config);
    }

    public function actionIndex()
    {
        $tasks = $this->taskService->getAllTasksById();

        return $tasks;
    }
}