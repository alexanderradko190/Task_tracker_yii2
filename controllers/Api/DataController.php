<?php

namespace app\controllers\api;

use app\services\TaskService;
use yii\rest\Controller;

class DataController extends Controller
{
    private $taskService;

    public function __construct($id, $module, TaskService $taskService, $config = [])
    {
        $this->taskService = $taskService;
        parent::__construct($id, $module, $config);
    }

    public function actionIndex() {
        $data = $this->taskService->getTaskAndUserData();

        $resultData = [];
        foreach ($data as $item) {
            $username = $item['username'];
            unset($item['username']);
            $resultData[$username][] = $item;
        }

        return $resultData;
    }
}