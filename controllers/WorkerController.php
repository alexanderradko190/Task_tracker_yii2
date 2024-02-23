<?php

namespace app\controllers;

use app\models\TaskModel;
use app\models\User;
use app\models\WorkerModel;
use app\models\WorkersRatingModel;
use yii\db\Query;

class WorkerController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $workers = User::find()->all();

        return $this->render('index', [
            'workers' => $workers,
        ]);
    }

    public function actionRating()
    {
        $query = new Query();
        $query->select('u.username, w.rating')
            ->from('user u')
            ->leftJoin('workers_rating  w', 'w.worker_id = u.id')
        ->orderBy(['w.rating' => SORT_DESC]);

        $command = $query->createCommand();
        $ratingData = $command->queryAll();

        return $this->render('rating', [
            'ratingData' => $ratingData,
        ]);
    }

}
