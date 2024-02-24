<?php

use yii\bootstrap5\Html;

foreach ($tasks as $task) {
    echo Html::a($task->name, ['task/' . $task->id], ['class' => 'my-link text-decoration-none text-black', 'target' => '_blank']);
}
?>

<style>
    a.text-black:hover {
        color: #0d6efd !important;
    }
</style>
