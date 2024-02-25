<?php

namespace app\repositories;

interface UserRepositoryInterface
{
    public function getWorkersByRating();
    public function getAllUsers();
}