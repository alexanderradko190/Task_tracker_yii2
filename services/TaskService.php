<?php

namespace app\services;

use app\models\TaskModel;

class TaskService implements TaskServiceInterface
{
    public function getTaskAndUserData()
    {
        return TaskModel::find()
            ->select(['user.username', 'tasks.name', 'tasks.description', 'tasks.date_end', 'tasks.status', 'tasks.story_point'])
            ->leftJoin('user', 'tasks.user_id = user.id')
            ->orderBy([])
            ->asArray()
            ->all();
    }

    public function getAllTasksById()
    {
        return TaskModel::find()
            ->select(['name', 'status', 'date_end', 'story_point'])
            ->orderBy('id')->all();
    }
}