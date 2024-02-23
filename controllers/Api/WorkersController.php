<?php

namespace app\controllers\api;

use app\models\TaskModel;
use app\models\User;
use yii\rest\Controller;

class WorkersController extends Controller
{
    public function actionIndex()
    {
//        Получаем массив исполнителей
        $users = User::find()
            ->select(['user.id', 'user.username', 'workers_rating.rating'])
            ->leftJoin('workers_rating', 'user.id = workers_rating.worker_id')
            ->asArray()
            ->all();

        $month = date('m');
        $year = date('Y');

        $userData = [];

//        Перебираем исполнителей и присваиваем в массив каждого исполнителя
//        id, name, status, story_point  дату закрытия задачи
        foreach ($users as $user) {
            $tasks = TaskModel::find()
                ->select(['tasks.id as task_id', 'tasks.name', 'tasks.status', 'tasks.story_point', 'tasks.updated_at as closed'])
                ->where(['user_id' => $user['id'], 'status' => 'Решена'])
                ->andWhere(['MONTH(created_at)' => $month, 'YEAR(created_at)' => $year])
                ->asArray()
                ->all();

            $userData[] = [
                'id' => $user['id'],
                'user_name' => $user['username'],
                'rating' => $user['rating'],
                'tasks' => $tasks
            ];
        }

        return $userData;
    }
}