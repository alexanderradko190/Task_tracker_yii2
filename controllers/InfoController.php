<?php

namespace app\controllers;

use app\models\TaskModel;
use app\traits\CheckAuthUsersTrait;
use yii\db\Query;

class InfoController extends \yii\web\Controller
{
    use CheckAuthUsersTrait;
    public function actionIndex()
    {
        //        Проверка на ошибку доступа к странице
        $this->checkAuthorization();

        $tasks = TaskModel::find()->where(['not', ['status' => 'Решена']])->orderBy(['updated_at' => SORT_DESC])->all();

        $query = new Query();
        $query->select('u.username')
            ->from('user as u')
            ->leftJoin('workers_rating as w', 'w.worker_id = u.id')
            ->orderBy(['w.rating' => SORT_DESC]);

        $command = $query->createCommand();
        $workers = $command->queryAll();

        return $this->render('index', [
            'tasks' => $tasks,
            'workers' => $workers
        ]);

    }
}