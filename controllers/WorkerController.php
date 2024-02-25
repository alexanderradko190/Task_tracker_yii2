<?php

namespace app\controllers;

use app\repositories\UserRepository;
use app\traits\CheckAuthUsersTrait;

class WorkerController extends \yii\web\Controller
{
    use CheckAuthUsersTrait;

    private $userRepository;

    public function __construct($id, $module, UserRepository $userRepository, $config = [])
    {
        $this->userRepository = $userRepository;
        parent::__construct($id, $module, $config);
    }

    public function actionIndex()
    {
        $this->checkAuthorization();

        $workers = $this->userRepository->getAllUsers();

        return $this->render('index', [
            'workers' => $workers,
        ]);
    }

    public function actionRating()
    {
        $this->checkAuthorization();

        $ratingData = $this->userRepository->getWorkersByRating();

        return $this->render('rating', [
            'ratingData' => $ratingData,
        ]);
    }

}
