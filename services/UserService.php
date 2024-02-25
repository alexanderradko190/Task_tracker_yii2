<?php

namespace app\services;

use app\models\User;

class UserService implements UserServiceInterface
{
    public function getAllWorkersById()
    {
        return User::find()
            ->select(['id', 'username', 'email'])
            ->orderBy('id')->all();
    }

    public function getUsersAndTasksByUserId()
    {
        return User::find()
            ->select(['user.id', 'user.username', 'workers_rating.rating'])
            ->leftJoin('workers_rating', 'user.id = workers_rating.worker_id')
            ->orderBy(['user.id' => SORT_ASC])
            ->with('tasks')
            ->asArray()
            ->all();
    }
}