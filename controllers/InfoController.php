<?php

namespace app\controllers;

use app\repositories\TaskRepository;
use app\repositories\UserRepository;
use app\traits\CheckAuthUsersTrait;

class InfoController extends \yii\web\Controller
{
    use CheckAuthUsersTrait;

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

        $tasks = $this->taskRepository->getUnresolvedTasks();
        $workers = $this->userRepository->getWorkersByRating();

        return $this->render('index', [
            'tasks' => $tasks,
            'workers' => $workers
        ]);

    }
}