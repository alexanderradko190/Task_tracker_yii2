<?php

namespace app\services;

use app\repositories\TaskRepository;
use app\repositories\UserRepository;

class InfoService
{
    public TaskRepository $tasks;
    public UserRepository $users;

    public function __construct(
        TaskRepository $tasks,
        UserRepository $users
    ) {
        $this->tasks = $tasks;
        $this->users = $users;
    }

    public function getInfo(): array
    {
        $tasks = $this->tasks->getUnresolvedTasksBySort();
        $workers = $this->users->getAllWorkersByRating();

        return [
            'tasks' => $tasks,
            'workers' => $workers
        ];
    }

    public function getTaskAndUserInfo(): array
    {
        $tasks = $this->tasks->getTasksInfoByUser();

        $taskData = [];

        foreach ($tasks as $task) {
            $username = $task['username'];
            unset($task['username']);
            $taskData[$username][] = $task;
        }

        return $taskData;
    }
}