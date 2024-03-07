<?php

namespace app\controllers;

use app\repositories\TaskRepository;
use app\repositories\UserRepository;
use Yii;

class InfoController extends \yii\web\Controller
{
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

        $tasks = $this->taskRepository->getUnresolvedTasksBySort();
        $workers = $this->userRepository->getWorkersByRating();

        return $this->render('index', [
            'tasks' => $tasks,
            'workers' => $workers
        ]);

    }
}