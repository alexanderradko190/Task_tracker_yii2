<?php
/** @var $this yii\web\View */

use yii\helpers\Url;

$this->title = 'Все задачи';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="tasks-info-page w-80">
    <div class="show-menu d-inline-block">
        Сортировка по статусам
    </div>
    <ul class="hide-block list-unstyled">
        <li class="mb-1">
            <a href="<?= Url::to(['/?status=Новая']) ?>" class="my-link text-dark text-decoration-none" data-status="new">Новая</a>
        </li>
        <li class="mb-1">
            <a href="<?= Url::to(['/?status=В работе']) ?>" class="my-link text-dark text-decoration-none" data-status="atwork">В работе</a>
        </li>
        <li class="mb-1">
            <a href="<?= Url::to(['/?status=На ревью']) ?>" class="my-link text-dark text-decoration-none" data-status="review">На ревью</a>
        </li>
        <li class="mb-1">
            <a href="<?= Url::to(['/?status=В тестировании']) ?>" class="my-link text-dark text-decoration-none" data-status="intest">В тестировании</a>
        </li>
        <li class="mb-1">
            <a href="<?= Url::to(['/?status=Готова к релизу']) ?>" class="my-link text-dark text-decoration-none" data-status="readytorelease">Готова к релизу</a>
        </li>
        <li class="mb-1">
            <a href="<?= Url::to(['/?status=Требуется информация']) ?>" class="my-link text-dark text-decoration-none" data-status="needinfo">Требуется информация</a>
        </li>
    </ul>
    <table class="w-100 mt-4">
        <thead>
        <tr>
            <th style="width: 30%;">
                Задача
            </th>
            <th style="width: 15%;">
                Статус
            </th>
            <th style="width: 20%;">
                Дедлайн
            </th>
            <th style="width: 15%;">
                Story point
            </th>
            <th style="width: 20%;">
                Исполнитель
            </th>
        </tr>
        </thead>
        <tbody id="tasks-table"></tbody>
    </table>
    <div id="empty-list"></div>
</div>

<style>
    table {
        position: relative;
    }
    #main.flex-shrink-0 {
        height: 0;
    }
    .show-menu {
        cursor: pointer;
        margin-top: 25px;
        margin-bottom: 50px;
    }
    .hide-block {
        position: fixed;
        background: #ffffff;
        padding: 15px;
        width: 250px;
        box-shadow: 0 0 3px rgba(128, 128, 128, 0.5);
        border-radius: 7px;
        top: 150px;
        left: 80px;
        display: none;
        z-index: 1000;
        margin-top: 10px;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        fetch('<?= Url::to(['/?status=*']) ?>', {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
            .then(response => response.json())
            .then(data => {
                document.getElementById('tasks-table').innerHTML = '';
                document.getElementById('empty-list').innerHTML = '';
                if (!data.length) {
                    document.getElementById('tasks-table').innerHTML = '';
                    document.getElementById('empty-list').innerHTML = '<div>Нет задач с таким статусом</div>';
                }
                data.map(function (task) {
                    document.getElementById('tasks-table').innerHTML += `<tr>
            <td class="p-0 m-0">
                    <div class="task-name pt-3 pb-3">
                        <a href="task/${task.id}", class="m-0 p-0 my-link text-decoration-none fz-18 text-black" target = '_blank'>  ${task.name}</a>
                    </div>
                          </td>
            <td class="p-0 m-0">
                    <div class="task-name pt-3 pb-3">
                        <p class="m-0 p-0">
                        ${task.status}
                        </p>
                    </div>
            </td>
            <td class="p-0 m-0">

                    <div class="task-name pt-3 pb-3">
                        <p class="m-0 p-0">
                          ${new Date(task.date_end).toLocaleDateString()}
                        </p>
                    </div>
                           </td>
            <td class="p-0 m-0">
                    <div class="task-name pt-3 pb-3">
                        <p class="m-0 p-0">
                          ${task.story_point}
                        </p>
                    </div>
                           </td>
            <td class="p-0 m-0">
                    <div class="task-name pt-3 pb-3">
                        <p class="m-0 p-0">
                              ${task.user.username}
                        </p>
                    </div>
                           </td>
        </tr>`;
                })

            })
            .catch(error => console.error('Ошибка:', error));

        var links = document.querySelectorAll('.hide-block a');
        links.forEach(function(link) {
            link.addEventListener('click', function (e) {
                e.preventDefault();
                var status = e.target.dataset.status;
                fetch(e.target.href, {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('tasks-table').innerHTML = '';
                        document.getElementById('empty-list').innerHTML = '';
                        if (!data.length) {
                            document.getElementById('tasks-table').innerHTML = '';
                            document.getElementById('empty-list').innerHTML = '<div>Нет задач с таким статусом</div>';
                        }
                        data.map(function (task) {
                            document.getElementById('tasks-table').innerHTML += `<tr>
            <td class="p-0 m-0">
                    <div class="task-name pt-3 pb-3">
                        <a href="task/${task.id}", class="m-0 p-0 my-link text-decoration-none fz-18 text-black" target = '_blank'>  ${task.name}</a>
                    </div>
                          </td>
            <td class="p-0 m-0">
                    <div class="task-name pt-3 pb-3">
                        <p class="m-0 p-0">
                        ${task.status}
                        </p>
                    </div>
            </td>
            <td class="p-0 m-0">

                    <div class="task-name pt-3 pb-3">
                        <p class="m-0 p-0">
                          ${new Date(task.date_end).toLocaleDateString()}
                        </p>
                    </div>
                           </td>
            <td class="p-0 m-0">
                    <div class="task-name pt-3 pb-3">
                        <p class="m-0 p-0">
                          ${task.story_point}
                        </p>
                    </div>
                           </td>
            <td class="p-0 m-0">
                    <div class="task-name pt-3 pb-3">
                        <p class="m-0 p-0">
                              ${task.user.username}
                        </p>
                    </div>
                           </td>
        </tr>`;
                        })

                    })
                    .catch(error => console.error('Ошибка:', error));
            });
        });
    });

</script>

<script>

    document.addEventListener('DOMContentLoaded', function () {

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

        var showBtn = document.querySelector('.show-menu');
        var hideBlock = document.querySelector('.hide-block');
        showBtn.addEventListener('click', function () {
            if (hideBlock.style.display === 'block') {
                hideBlock.style.display = 'none';
            } else {
                hideBlock.style.display = 'block';
            }
        });

        var targetLinks = document.querySelectorAll('a.text-dark');
        targetLinks.forEach(function(targetLink) {
            targetLink.addEventListener('click', function (event) {
                event.preventDefault();
                // Удаляем классы у всех ссылок
                targetLinks.forEach(function(targetLink) {
                    targetLink.classList.remove('text-primary');
                    targetLink.classList.add('text-dark');
                });
                // Добавляем классы к ссылке, на которую произошел клик
                this.classList.remove('text-dark');
                this.classList.add('text-primary');
            });
        });

    });

</script>





