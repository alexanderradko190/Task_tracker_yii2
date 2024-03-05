<?php

namespace app\repositories;

interface TaskRepositoryInterface
{
    public function getUnresolvedTasks(): array;
    public function getTaskById(string $id): object;
    public function getAllTasks(): array;
    public function getTasksByStoryPoint(): array;
    public function getTasksByPriority(): array;
    public function getTasksByDate(): array;
    public function getTaskAndUserData(): array;
    public function getAllTasksById(): array;
}