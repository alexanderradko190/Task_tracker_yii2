<?php

use app\models\TaskModel;
use yii\helpers\Html;

$this->title = $task->name;
$this->params['breadcrumbs'][] = $task->name;
?>

<div class="task-info-page w-50">
    <table class="w-100">
        <tbody>
        <tr>
            <td class="m-4 p-4">
                <div>Описание задачи</div>
            </td>
            <td class="m-4 p-4">
                <div><?= $task->description; ?></div>
            </td>
        </tr>
        <tr>
            <td class="m-4 p-4">
                <div>Статус</div>
            </td>
            <td class="m-4 p-4">
                <div><?= $task->status; ?></div>
            </td>
        </tr>
        <tr>
            <td class="m-4 p-4">
                <div>Приоритет</div>
            </td>
            <td class="m-4 p-4">
                <div class= <?php
                if ($task->status === TaskModel::IS_READY) {
                    echo 'text-black';
                } else {
                    if (($task->story_point >= 1 && $task->story_point <= 3) && TaskModel::IS_READY) {
                        echo 'text-success';
                    } else if ($task->story_point >= 4 && $task->story_point <= 7) {
                        echo 'text-primary';
                    } else if (($task->story_point >= 7)) {
                        echo 'text-danger';
                    } else if (($task->story_point == 0)) {
                        echo 'text-secondary';
                    }
                } ?>
                     ">
                <?php
                     if ($task->status === TaskModel::IS_READY) {
                         echo 'задача закрыта';
                     } else {
                         if ($task->story_point >= 1 && $task->story_point <= 3) {
                             echo 'success';
                         } else if ($task->story_point >= 4 && $task->story_point <= 7) {
                             echo 'primary';
                         } else if (($task->story_point >= 7)) {
                             echo 'danger';
                         } else if (($task->story_point == 0)) {
                             echo 'укажите story_point';
                         }
                     } ?>
            </div></td>
    </tr>
    <tr>
        <td class=" m-4 p-4
                ">
                <div>Ответственный</div>
            </td>
            <td class="m-4 p-4">
                <div><?= $task->user->fio ?? $task->user->username; ?></div>
            </td>
        </tr>
        <tr>
            <td class="m-4 p-4">
                <div>Дедлайн</div>
            </td>
            <td class="m-4 p-4">
                <div><?= date('d-m-Y', strtotime($task->date_end)); ?></div>
            </td>
        </tr>
        <tr>
            <td class="m-4 p-4">
                <div>Дата создания</div>
            </td>
            <td class="m-4 p-4">
                <div><?= date('d-m-Y', strtotime($task->created_at)) ?> </div>
            </td>
        </tr>
        </tbody>
    </table>

    <div>
        <?php
        echo Html::a('Обновить задачу', ['task/update/' . $task->id], ['class' => 'btn btn-primary m-4', 'target' => '_blank']);
        ?>
    </div>
</div>

