<?php

namespace app\controllers;

use app\repositories\UserRepository;
use Yii;

class WorkerController extends \yii\web\Controller
{
    private $userRepository;

    public function __construct($id, $module, UserRepository $userRepository, $config = [])
    {
        $this->userRepository = $userRepository;
        parent::__construct($id, $module, $config);
    }

    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['/site/login']);
        }

        $workers = $this->userRepository->getAllUsers();

        return $this->render('index', [
            'workers' => $workers,
        ]);
    }

    public function actionRating()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['/site/login']);
        }

        $ratingData = $this->userRepository->getWorkersByRating();

        return $this->render('rating', [
            'ratingData' => $ratingData,
        ]);
    }

}
