<?php

namespace app\repositories;

use yii\db\ActiveQuery;

interface TaskRepositoryInterface
{
    public function getUnresolvedTasksBySort(): array;
    public function getTaskById(string $id): object;
    public function getAllTasks(): array;
    public function getTaskAndUserData(): array;
    public function getAllTasksById(): array;
    public function filterByStatus($status): ActiveQuery;
}