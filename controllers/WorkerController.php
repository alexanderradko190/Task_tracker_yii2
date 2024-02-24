<?php

namespace app\controllers;

use app\models\User;
use app\traits\CheckAuthUsersTrait;
use yii\db\Query;

class WorkerController extends \yii\web\Controller
{
    use CheckAuthUsersTrait;
    public function actionIndex()
    {
//        Проверка на ошибку доступа к странице
        $this->checkAuthorization();

        $workers = User::find()->all();

        return $this->render('index', [
            'workers' => $workers,
        ]);
    }

    public function actionRating()
    {
        //        Проверка на ошибку доступа к странице
        $this->checkAuthorization();

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
