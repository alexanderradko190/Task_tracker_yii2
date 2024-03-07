<?php

namespace app\repositories;

use app\models\TaskModel;
use DateTime;

class TaskRepository implements TaskRepositoryInterface
{
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
        return TaskModel::find()->orderBy(['updated_at' => SORT_DESC])->all();
    }

    public function getTasksByStoryPoint(): array
    {
        return TaskModel::find()->orderBy(['story_point' => SORT_ASC])->all();
    }

    public function getTasksByPriority(): array
    {
        return TaskModel::find()->orderBy(['date_end' => SORT_ASC])->all();
    }

    public function getTasksByDate(): array
    {
        return TaskModel::find()->orderBy(['id' => SORT_DESC])->all();
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

    public function ratingСalculation($task): string
    {
            $now = new DateTime();
            $deadline = new DateTime($task->date_end);
            $ratio_sp = $deadline->diff($now);

            if ($ratio_sp->d >= 1) {
                $task->story_point = max(0, $task->story_point - $ratio_sp->d);
                $task->story_point = (string)$task->story_point;
            }

            return $task->story_point;
    }
}