<?php

namespace app\services;

interface TaskServiceInterface
{
    public function getTaskAndUserData();
    public function getAllTasksById();
}