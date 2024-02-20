<?php
/** @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Сортировка по ате добавления';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="tasks-info-page w-80">
    <table class="w-100">
        <thead>
        <tr>
            <th style="border: 1px solid black; height: 70px; padding-top: 1rem; padding-bottom: 1rem; padding-left: 3rem;">Задача</th>
            <th style="border: 1px solid black; height: 70px; padding-top: 1rem; padding-bottom: 1rem; padding-left: 3rem;">Дедлайн</th>
            <th style="border: 1px solid black; height: 70px; padding-top: 1rem; padding-bottom: 1rem; padding-left: 3rem;">Story point</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="p-0 m-0" style="border: 1px solid black;">

                <?php foreach($tasks as $task):
                    ?>
                    <div class="task-name m-0" style="border-bottom: 1px solid black; height: 70px; padding-top: 1rem; padding-bottom: 1rem; padding-left: 3rem;">
                        <?= Html::a($task->name, ['task/'.$task->id], ['class' => 'my-link text-decoration-none fz-18 text-black', 'target' => '_blank']); ?>
                    </div>
                <?php
                endforeach;
                ?></td>
            <td class="p-0 m-0" style="border: 1px solid black;">

                <?php foreach($tasks as $task):
                    ?>
                    <div class="task-name m-0" style="border-bottom: 1px solid black; height: 70px; padding-top: 1rem; padding-bottom: 1rem; padding-left: 3rem;">
                        <p><?= $task->date_end; ?></p>
                    </div>
                <?php
                endforeach;
                ?></td>
            <td class="p-0 m-0" style="border: 1px solid black;">

                <?php foreach($tasks as $task):
                    ?>
                    <div class="task-name m-0" style="border-bottom: 1px solid black; height: 70px; padding-top: 1rem; padding-bottom: 1rem; padding-left: 3rem;">
                        <p><?= $task->story_point; ?></p>
                    </div>
                <?php
                endforeach;
                ?></td>
        </tr>
        </tbody>
    </table>
</div>