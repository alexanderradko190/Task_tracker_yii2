<?php

namespace app\controllers\api;

use app\repositories\UserRepository;
use yii\rest\Controller;

class UsersController extends Controller
{
    private $userRepository;

    public function __construct($id, $module, UserRepository $userRepository, $config = [])
    {
        $this->userRepository = $userRepository;
        parent::__construct($id, $module, $config);
    }

    public function actionIndex()
    {
        $workers = $this->userRepository->getAllWorkersById();

        return $workers;
    }
}