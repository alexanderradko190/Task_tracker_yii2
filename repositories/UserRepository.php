<?php

namespace app\repositories;

use app\models\User;
use yii\db\Query;

class UserRepository implements UserRepositoryInterface
{
    public function getWorkersByRating()
    {
        $query = new Query();
        $query->select('u.username, w.rating')
            ->from('user as u')
            ->leftJoin('workers_rating as w', 'w.worker_id = u.id')
            ->orderBy(['w.rating' => SORT_DESC]);

        $command = $query->createCommand();
        return $command->queryAll();
    }

    public function getAllUsers()
    {
        return User::find()->orderBy('id')->all();
    }
}