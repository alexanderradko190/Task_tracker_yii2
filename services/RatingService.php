<?php

namespace app\services;

use app\models\TaskModel;
use DateTime;

class RatingService implements RatingServiceInterface
{
    public function ratingCalculation($task): string
    {
        $now = new DateTime();
        $deadline = new DateTime($task->date_end);
            $ratio_sp = $deadline->diff($now);

        if ($ratio_sp->d >= 1 && $deadline < $now) {
            $task->story_point = max(0, $task->story_point - $ratio_sp->d);
            $task->story_point = (string)$task->story_point;
        }

        return $task->story_point;
    }
}