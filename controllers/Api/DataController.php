<?php

namespace app\controllers\api;

use app\repositories\TaskRepository;
use yii\rest\Controller;

class DataController extends Controller
{
    private $taskRepository;

    public function __construct($id, $module, TaskRepository $taskRepository, $config = [])
    {
        $this->taskRepository = $taskRepository;
        parent::__construct($id, $module, $config);
    }

    public function actionIndex() {
        $data = $this->taskRepository->getTaskAndUserData();

        $resultData = [];
        foreach ($data as $item) {
            $username = $item['username'];
            unset($item['username']);
            $resultData[$username][] = $item;
        }

        return $resultData;
    }
}