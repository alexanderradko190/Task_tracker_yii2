<?php

namespace app\controllers\api;

use app\models\TaskModel;
use yii\rest\Controller;
use app\models\User;

class DataController extends Controller
{
    public function actionIndex() {
        $data = TaskModel::find()
            ->select(['user.username', 'tasks.name', 'tasks.description', 'tasks.date_end', 'tasks.status', 'tasks.story_point'])
            ->leftJoin('user', 'tasks.user_id = user.id')
            ->orderBy([])
            ->asArray()
            ->all();

        $resultData = [];
        foreach ($data as $item) {
            $username = $item['username'];
            unset($item['username']);
            $resultData[$username][] = $item;
        }

        return $resultData;
    }
}