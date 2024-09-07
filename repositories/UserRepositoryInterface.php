<?php

namespace app\repositories;

interface UserRepositoryInterface
{
    public function getAllWorkersByRating(): array;
    public function getAllUsers(): array;
    public function getAllWorkersById(): array;
    public function getUsersAndTasksByUserId(): array;
}