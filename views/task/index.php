<?php
/** @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Все задачи';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="tasks-info-page w-80">
    <table class="w-100">
        <thead>
        <tr>
            <th style="border: 1px solid black; padding-top: 1rem; padding-left: 3rem; border-bottom: none;">
                <p>
                    <?= Html::a('Сортировать по дате добавления', ['task/sort-date'], ['class' => 'mb-1 my-link text-primary text-decoration-none', 'target' => '_blank']) ?>
                </p>
            </th>
            <th style="border: 1px solid black; padding-top: 1rem; padding-left: 3rem; border-bottom: none;">
            </th>
            <th style="border: 1px solid black; padding-top: 1rem; padding-left: 3rem; border-bottom: none;">
                <p>
                    <?= Html::a('Сортировать по дедлайну', ['task/sort-priority'], ['class' => 'mb-1 my-link text-primary text-decoration-none', 'target' => '_blank']) ?>
                </p>
            </th>
            <th style="border: 1px solid black; padding-top: 1rem; padding-left: 3rem; border-bottom: none;">
                <p>
                    <?= Html::a('Сортировать по story_point', ['task/sort-sp'], ['class' => 'mb-1 my-link text-primary text-decoration-none', 'target' => '_blank']) ?>
                </p>
            </th>
            <th style="border: 1px solid black; padding-top: 1rem; padding-left: 3rem; border-bottom: none;">
            </th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th style="border: 1px solid black; height: 70px; padding-top: 0.5rem; padding-bottom: 1rem; padding-left: 3rem; border-top: none;">
                Задача
            </th>
            <th style="border: 1px solid black; height: 70px; padding-top: 0.5rem; padding-bottom: 1rem; padding-left: 3rem; border-top: none;">
                Статус
            </th>
            <th style="border: 1px solid black; height: 70px; padding-top: 0.5rem; padding-bottom: 1rem; padding-left: 3rem; border-top: none;">
                Дедлайн
            </th>
            <th style="border: 1px solid black; height: 70px; padding-top: 0.5rem; padding-bottom: 1rem; padding-left: 3rem; border-top: none;">
                Story point
            </th>
            <th style="border: 1px solid black; height: 70px; padding-top: 0.5rem; padding-bottom: 1rem; padding-left: 3rem; border-top: none;">
                Исполнитель
            </th>
        </tr>
        <tr>
            <td class="p-0 m-0 border border-dark">

                <?php foreach ($tasks as $task):
                    ?>

                    <div class="task-name m-0 border-bottom border-dark pt-3 pb-3 ps-5" style="height: 70px;">
                        <?= Html::a($task->name, ['task/' . $task->id], ['class' => 'my-link text-decoration-none fz-18 text-black', 'target' => '_blank']); ?>
                    </div>
                <?php
                endforeach;
                ?>
            </td>
            <td class="p-0 m-0" style="border: 1px solid black;">

                <?php foreach ($tasks as $task):
                    ?>
                    <div class="task-name m-0 border-bottom border-dark pt-3 pb-3 ps-5"
                         style="border-bottom: 1px solid black; height: 70px;">
                        <p><?= $task->status; ?></p>
                    </div>
                <?php
                endforeach;
                ?>
            </td>
            <td class="p-0 m-0" style="border: 1px solid black;">

                <?php foreach ($tasks as $task):
                    ?>

                    <div class="task-name m-0 border-bottom border-dark pt-3 pb-3 ps-5"
                         style="border-bottom: 1px solid black; height: 70px;">
                        <p><?= date('d-m-Y', strtotime($task->date_end)); ?></p>
                    </div>
                <?php
                endforeach;
                ?>
            </td>
            <td class="p-0 m-0" style="border: 1px solid black;">

                <?php foreach ($tasks as $task):
                    ?>
                    <div class="task-name m-0 border-bottom border-dark pt-3 pb-3 ps-5"
                         style="border-bottom: 1px solid black; height: 70px;">
                        <p><?= $task->story_point; ?></p>
                    </div>
                <?php
                endforeach;
                ?>
            </td>
            <td class="p-0 m-0" style="border: 1px solid black;">

                <?php foreach ($tasks as $task):
                    ?>
                    <div class="task-name m-0 border-bottom border-dark pt-3 pb-3 ps-5"
                         style="border-bottom: 1px solid black; height: 70px;">
                        <p><?= $task->user->fio ?? $task->user->username; ?></p>
                    </div>
                <?php
                endforeach;
                ?>
            </td>
        </tr>
        </tbody>
    </table>
</div>

<script>
    var links = document.querySelectorAll('.task-name a.text-black');
    for (var i = 0; i < links.length; i++) {
        links[i].addEventListener('mouseover', function (e) {
            e.target.classList.add('text-primary');
            e.target.classList.remove('text-black');
        });
        links[i].addEventListener('mouseout', function (e) {
            e.target.classList.add('text-black');
            e.target.classList.remove('text-primary');
        });
    }
</script>




