<?php

namespace app\controllers\api;

use app\services\WorkerService;
use yii\filters\AccessControl;
use yii\rest\Controller;

class WorkersRatingController extends Controller
{
    private WorkerService $workerService;

    public function __construct(
        $id,
        $module,
        WorkerService $workerService,
        $config = []
    ) {
        $this->workerService = $workerService;
        parent::__construct($id, $module, $config);
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->workerService->getWorkersRating();
    }
}