<?php

$this->title = 'Инфо';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php

use yii\bootstrap5\Tabs;

?>

<div class="row">
    <div class="mt-1 mb-3 fs-5">
        Список всех исполнителей и всех задач, у которых статус не 'Решена'
    </div>
    <div class="col-md-12">
        <?php
        echo Tabs::widget([
            'items' => [
                [
                    'label' => 'Исполнители',
                    'content' => $this->render('_workers_tab', ['workers' => $workers]),
                    'active' => true,
                    'options' => ['class' => 'vh-100 pt-3 ps-4 text-dark fs-6 lh-lg border border-dark border-opacity-25 border-1 rounded-3'],
                ],
                [
                    'label' => 'Задачи',
                    'content' => $this->render('_tasks_tab', ['tasks' => $tasks]),
                    'options' => ['class' => 'vh-100 pt-3 ps-4 text-dark fs-6 lh-lg border border-dark border-opacity-25 border-1 rounded-3'],
                ],
            ],
        ]);
        ?>
    </div>
</div>
