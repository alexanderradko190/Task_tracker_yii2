<?php

namespace app\controllers\api;

use app\services\UserService;
use yii\rest\Controller;

class UsersController extends Controller
{
    private $userService;

    public function __construct($id, $module, UserService $userService, $config = [])
    {
        $this->userService = $userService;
        parent::__construct($id, $module, $config);
    }

    public function actionIndex()
    {
        $workers = $this->userService->getAllWorkersById();

        return $workers;
    }
}