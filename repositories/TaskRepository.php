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
}