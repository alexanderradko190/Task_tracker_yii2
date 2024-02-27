<?php

namespace app\repositories;

use app\models\TaskModel;

class TaskRepository implements TaskRepositoryInterface
{
    public function getUnresolvedTasks()
    {
        return TaskModel::find()->where(['not', ['status' => 'Решена']])->orderBy(['updated_at' => SORT_DESC])->all();
    }

    public function getTaskById($id)
    {
        return TaskModel::findOne($id);
    }

    public function getAllTasks()
    {
        return TaskModel::find()->orderBy(['updated_at' => SORT_DESC])->all();
    }

    public function getTasksByStoryPoint() {
        return TaskModel::find()->orderBy(['story_point' => SORT_ASC])->all();
    }

    public function getTasksByPriority() {
        return TaskModel::find()->orderBy(['date_end' => SORT_ASC])->all();
    }

    public function getTasksByDate() {
        return TaskModel::find()->orderBy(['id' => SORT_DESC])->all();
    }
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