<?php

namespace app\repositories;

interface TaskRepositoryInterface
{
    public function getUnresolvedTasks();
    public function getTaskById($id);
    public function getAllTasks();
    public function getTasksByStoryPoint();
    public function getTasksByPriority();
    public function getTasksByDate();
}