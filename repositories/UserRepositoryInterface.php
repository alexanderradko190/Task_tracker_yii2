<?php

namespace app\repositories;

interface UserRepositoryInterface
{
    public function getWorkersByRating();
    public function getAllUsers();
    public function getAllWorkersById();
    public function getUsersAndTasksByUserId();
}