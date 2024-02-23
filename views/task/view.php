<?php
use yii\helpers\Html;

$this->title = $task->name;
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="task-info-page w-80">
<table class="w-100">
    <thead>
    <tr>
        <th class="text-center m-4 p-4 border border-black">Описание задачи</th>
        <th class="text-center m-4 p-4 border border-black">Статус</th>
        <th class="text-center m-4 p-4 border border-black">Приоритет</th>
        <th class="text-center m-4 p-4 border border-black">Ответственные</th>
        <th class="text-center m-4 p-4 border border-black">Дедлайн</th>
        <th class="text-center m-4 p-4 border border-black">Дата создания</th>
    </tr>
    </thead>
    <tbody>
    <tr>
    <tr>
        <td class="m-4 p-4 border border-black">
            <div><?= $task->description; ?></div>
            </td>
        <td class="m-4 p-4 border border-black">
            <div><?= $task->status; ?></div>
            </td>
        <td class="m-4 p-4 border border-black">
            <div class="text-center <?php
            if ($task->story_point >= 1 && $task->story_point <= 3) { echo 'text-success'; }
            else if ($task->story_point >= 4 && $task->story_point <= 7) { echo 'text-primary';}
            else if (($task->story_point >= 7)) { echo 'text-danger';}
            else if (($task->story_point == 0)) { echo 'text-secondary';} ?>
        ">
                <?php if ($task->story_point >= 1 && $task->story_point <= 3) { echo 'success'; }
                else if ($task->story_point >= 4 && $task->story_point <= 7) { echo 'primary';}
                else if (($task->story_point >= 7)) { echo 'danger';}
                else if (($task->story_point == 0)) { echo 'укажите story_point';} ?>
            </div></td>
        <td class="m-4 p-4 border border-black">
                    <div><?= $task->user->fio ?? $task->user->username; ?></div>
    </td>
        <td class="m-4 p-4 border border-black">
            <div><?= $task->date_end; ?></div>
            </td>
        <td class="m-4 p-4 border border-black">
            <div><?= $task->created_at; ?></div>
            </td>
    </tr>
    </tbody>
</table>

<div>
    <?php
    echo Html::a('Обновить задачу', ['task/update/'.$task->id], ['class' => 'btn btn-primary mt-4', 'target' => '_blank']);
    ?>
</div>
</div>

