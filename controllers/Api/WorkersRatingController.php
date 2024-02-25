<?php

namespace app\controllers\api;

use app\services\UserService;
use yii\rest\Controller;

class WorkersRatingController extends Controller
{
    private $userService;

    public function __construct($id, $module, UserService $userService, $config = [])
    {
        $this->userService = $userService;
        parent::__construct($id, $module, $config);
    }

    public function actionIndex()
    {
        $users = $this->userService->getUsersAndTasksByUserId();

        $userData = [];

//        Через eager loading в yii2 получаем данные по таскам текущего исполнителя и присваиваем
//        в массив $userData: id, name, status, story_point и дату закрытия задачи
        foreach ($users as $user) {
            $tasks = [];
            foreach ($user['tasks'] as $task) {
                $tasks = [
                    'id' => $task['id'],
                    'name' => $task['name'],
                    'status' => $task['status'],
                    'story_point' => $task['story_point'] ?? '',
                    'closed' => $task['updated_at']
                ];
            }

            $userData[] = [
                'id' => $user['id'],
                'user_name' => $user['username'],
                'rating' => $user['rating'] ?? 0,
                'tasks' => $tasks
            ];
        }

        return $userData;
    }
}