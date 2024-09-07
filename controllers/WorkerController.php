<?php

namespace app\controllers;

use app\services\WorkerService;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class WorkerController extends Controller
{
    private WorkerService $workerService;

    public function __construct($id, $module, WorkerService $workerService, $config = [])
    {
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
        $workers = $this->workerService->getWorkers();

        return $this->render('index', [
            'workers' => $workers,
        ]);
    }

    public function actionRating()
    {
        $workersByRating = $this->workerService->getWorkersByRating();

        return $this->render('rating', [
            'workersByRating' => $workersByRating
        ]);
    }

}
