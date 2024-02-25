<?php

namespace app\services;

interface UserServiceInterface
{
    public function getAllWorkersById();
    public function getUsersAndTasksByUserId();
}