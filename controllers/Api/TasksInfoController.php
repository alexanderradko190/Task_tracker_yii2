<?php

namespace app\controllers\api;

use app\services\InfoService;
use yii\filters\AccessControl;
use yii\rest\Controller;

class TasksInfoController extends Controller
{
    private InfoService $infoService;

    public function __construct(
        $id,
        $module,
        InfoService $infoService,
        $config = []
    ) {
        $this->infoService = $infoService;
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
        return $this->infoService->getTaskAndUserInfo();
    }
}