<?php

namespace app\services;

use app\repositories\UserRepository;

class WorkerService
{
    public UserRepository $users;

    public function __construct(
        UserRepository $users
    ) {
        $this->users = $users;
    }

    public function getWorkers(): array
    {
        return $this->users->getAllUsers();
    }

    public function getWorkersByRating(): array
    {
        return $this->users->getAllWorkersByRating();
    }

    public function getWorkersRating(): array
    {
        $workers = $this->users->getUsersAndTasksByUserId();

        $workerInfo = [];

        foreach ($workers as $worker) {
            $tasks = [];
            foreach ($worker['tasks'] as $task) {
                $tasks = [
                    'id' => $task['id'],
                    'name' => $task['name'],
                    'status' => $task['status'],
                    'story_point' => $task['story_point'] ?? '',
                    'closed' => $task['updated_at']
                ];
            }

            $workerInfo[] = [
                'id' => $worker['id'],
                'user_name' => $worker['username'],
                'rating' => $worker['rating'] ?? 0,
                'tasks' => $tasks
            ];
        }

        return $workerInfo;
    }

    public function getWorkersById(): array
    {
        return $this->users->getAllWorkersById();
    }
}