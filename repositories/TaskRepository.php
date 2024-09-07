<?php

namespace app\repositories;

use app\models\TaskModel;
use yii\db\ActiveQuery;

class TaskRepository implements TaskRepositoryInterface
{
    private ActiveQuery $query;

    public function __construct()
    {
        $this->query = TaskModel::find()->with(['user']);
    }

    public function getUnresolvedTasksBySort(): array
    {
        return TaskModel::find()->where(['not', ['status' => TaskModel::IS_READY]])->orderBy(['updated_at' => SORT_DESC])->all();
    }

    public function getTaskById(string $id): object
    {
        return TaskModel::findOne($id);
    }

    public function getAllTasks(): array
    {
        return $this->query->orderBy(['updated_at' => SORT_DESC])->asArray()->all();
    }

    public function getTaskAndUserData(): array
    {
        return TaskModel::find()
            ->select(['user.username', 'tasks.name', 'tasks.description', 'tasks.date_end', 'tasks.status', 'tasks.story_point'])
            ->leftJoin('user', 'tasks.user_id = user.id')
            ->orderBy([])
            ->asArray()
            ->all();
    }

    public function getAllTasksById(): array
    {
        return TaskModel::find()
            ->select(['name', 'status', 'date_end', 'story_point'])
            ->orderBy('id')->all();
    }

    public function filterByStatus($status): ActiveQuery
    {
        return $this->query->where(['status' => $status]);
    }
}