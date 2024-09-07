<?php

namespace app\services;

use app\models\TaskModel;
use app\repositories\TaskRepository;
use app\repositories\UserRepository;
use app\traits\CreateValidationTrait;
use app\traits\RatingCountTrait;
use DomainException;

class TaskService
{
    use CreateValidationTrait;
    use RatingCountTrait;

    public TaskRepository $tasks;
    public UserRepository $users;

    public function __construct(
        TaskRepository $tasks,
        UserRepository $users
    ) {
        $this->tasks = $tasks;
        $this->users = $users;
    }

    public function getTasksByStatus(?string $status): array
    {
        $tasks = $this->tasks;
        $workers = $this->users->getAllUsers();

        if ($status === '*') {
            $taskList = $tasks->getAllTasks();
        } elseif ($status) {
            $taskList = $tasks->filterByStatus($status)->asArray()->all();
        } else {
            $taskList = $tasks->getAllTasks();
        }

       return [
           'tasks' => $taskList,
           'workers' => $workers
       ];
    }

    public function getTask(int $id): object
    {
        return $this->tasks->getTaskById($id);
    }

    public function createTask(TaskModel $task)
    {
        $nameError = $this->validateText($task->getName());
        $descriptionError = $this->validateText($task->getDescription());

        if ($nameError === false) {
            throw new DomainException(
                'Название задачи может содержать только буквы или цифры',
                'name'
            );
        }

        if ($descriptionError === false) {
            throw new DomainException(
                'Описание задачи может содержать только буквы или цифры',
                'description'
            );
        }

        if ($task->hasErrors()) {
            return false;
        }

        return $task->save();
    }

    public function updateTask($task): void
    {
        $this->ratingCalculation($task);
        $nameError = $this->validateText($task->name);
        $descriptionError = $this->validateText($task->description);

        if ($nameError === false) {
            throw new DomainException(
                'Название задачи может содержать только буквы или цифры',
                'name'
            );
        } else if ($descriptionError === false) {
            throw new DomainException(
                'Описание задачи может содержать только буквы или цифры',
                'description'
            );
        } else {
            $task->save();
        }
    }
}