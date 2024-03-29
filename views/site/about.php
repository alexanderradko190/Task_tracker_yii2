<?php

/** @var yii\web\View $this */

use yii\bootstrap5\Tabs;
use yii\helpers\Html;

$this->title = 'Yii2 tracker';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about w-100">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="w-80 text-dark fs-5 lh-sm mt-3">
        <p>
            Таск-трекер на фреймворке Yii2. При создании новой задачи к ней привязывается текущий авторизованный
            пользователь
        </p>
        <p>
            На отдельную страницу выводится список всех исполнителей с их текущими задачами
        </p>
        <p>
            У каждого таска устанавливается статус при
            создании задачи, который можно изменять в дальнейшем при изменении статуса задачи
        </p>
        <p>
            Формы просмотра, создания и редактирования задач
            не видны пользователям, которые не авторизованы в системе
        </p>
        <p>
            Для удобства мониторинга на странице задач сделал сортировку по дате добавления, story point и дедлайну
        </p>
        <p>
            Реализовал выделение просроченных задач и расчет времени до дедлайна, также указывается, сколько времени
            задача находится в просроченных
        </p>
        <p>
            Также есть рейтинг исполнителей по количеству story_point
        </p>
    </div>
</div>


