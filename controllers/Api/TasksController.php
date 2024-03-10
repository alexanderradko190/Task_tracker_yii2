<?php

namespace app\controllers\api;

use app\repositories\TaskRepository;
use yii\rest\Controller;

class TasksController extends Controller
{
    private $taskRepository;

    public function __construct($id, $module, TaskRepository $taskRepository, $config = [])
    {
        $this->taskRepository = $taskRepository;
        parent::__construct($id, $module, $config);
    }

    public function actionIndex()
    {
        $tasks = $this->taskRepository->getAllTasksById();

        return $tasks;
    }

    public function actionTaskStatus()
    {
        $tasks = $this->taskRepository->getAllTasks();

        return $tasks;
    }
}