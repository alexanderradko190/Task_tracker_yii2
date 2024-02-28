<?php

namespace app\repositories;

use app\models\User;
use yii\db\Query;

class UserRepository implements UserRepositoryInterface
{
    public function getWorkersByRating(): array
    {
        $query = new Query();
        $query->select('u.username, w.rating')
            ->from('user as u')
            ->leftJoin('workers_rating as w', 'w.worker_id = u.id')
            ->orderBy(['w.rating' => SORT_DESC]);

        $command = $query->createCommand();

        return $command->queryAll();
    }

    public function getAllUsers(): array
    {
        return User::find()->orderBy('id')->all();
    }

    public function getAllWorkersById(): array
    {
        return User::find()
            ->select(['id', 'username', 'email'])
            ->orderBy('id')->all();
    }

    public function getUsersAndTasksByUserId(): array
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