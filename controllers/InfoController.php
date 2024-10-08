<?php

namespace app\controllers;

use app\repositories\TaskRepository;
use app\repositories\UserRepository;
use app\services\InfoService;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class InfoController extends Controller
{
    private TaskRepository $tasks;
    private UserRepository $users;
    private InfoService $infoService;

    public function __construct(
        $id,
        $module,
        TaskRepository $tasks,
        UserRepository $users,
        InfoService $infoService,
        $config = []
    ) {
        $this->tasks = $tasks;
        $this->users = $users;
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
        $data = $this->infoService->getInfo();

        return $this->render('index', [
            'tasks' => $data['tasks'],
            'workers' => $data['workers']
        ]);
    }
}