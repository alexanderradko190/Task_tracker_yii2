<?php

namespace app\repositories;

interface UserRepositoryInterface
{
    public function getWorkersByRating(): array;
    public function getAllUsers(): array;
    public function getAllWorkersById(): array;
    public function getUsersAndTasksByUserId(): array;
}