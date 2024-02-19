<?php
/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'Задачи по исполнителям';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
    foreach($workers as $user):
        ?>
        <h5 class="m-4"><?= $user->fio ?? $user->username; ?></h5>
        <p class="text-secondary m-2">Все задачи исполнителя</p>
        <?php
        foreach($user->tasks as $task):
            ?>
            <ul class="list-unstyled">
            <li>
                <?= Html::a($task->name, ['task/'.$task->id], ['class' => 'm-2 text-primary my-link text-decoration-none fz-18', 'target' => '_blank']); ?>
            </li>
            </ul>
        <?php
        endforeach;
        endforeach;
?>

