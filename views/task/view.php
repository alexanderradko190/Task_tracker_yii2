<?php
use yii\helpers\Html;

$this->title = $task->name;
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="task-info-page w-80">
<table class="w-100">
    <thead>
    <tr>
        <th class="text-center" style="margin: 20px; padding: 20px; border: 1px solid black;">Описание задачи</th>
        <th class="text-center" style="margin: 20px; padding: 20px; border: 1px solid black;">Статус</th>
        <th class="text-center" style="margin: 20px; padding: 20px; border: 1px solid black;">Приоритет</th>
        <th class="text-center" style="margin: 20px; padding: 20px; border: 1px solid black;">Ответственные</th>
        <th class="text-center" style="margin: 20px; padding: 20px; border: 1px solid black;">Дедлайн</th>
        <th class="text-center" style="margin: 20px; padding: 20px; border: 1px solid black;">Дата создания</th>
    </tr>
    </thead>
    <tbody>
    <tr>
    <tr>
        <td style="margin: 20px; padding: 20px; border: 1px solid black;">
            <div><?= $task->description; ?></div>
            </td>
        <td style="margin: 20px; padding: 20px; border: 1px solid black;">
            <div><?= $task->status; ?></div>
            </td>
        <td style="margin: 20px; padding: 20px; border: 1px solid black;">
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
        <td style="margin: 20px; padding: 20px; border: 1px solid black;">
                    <div><?= $task->user->fio ?? $task->user->username; ?></div>
    </td>
        <td style="margin: 20px; padding: 20px; border: 1px solid black;">
            <div><?= $task->date_end; ?></div>
            </td>
        <td style="margin: 20px; padding: 20px; border: 1px solid black;">
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

