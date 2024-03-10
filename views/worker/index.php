<?php
/** @var yii\web\View $this */

use app\models\TaskModel;
use yii\helpers\Html;

$this->title = 'Актуальные задачи по исполнителям';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
foreach ($workers as $user): ?>
    <h5 class="m-4"><?= $user->fio ?? $user->username; ?></h5>

    <?php
    $taskCount = count($user->tasks);
    $notResolvedTasks = array_filter($user->tasks, function ($task) {
        return $task->status !== TaskModel::IS_READY;
    });

    if (empty($user->tasks)) {
        echo '<p class="text-secondary m-2">У этого исполнителя нет задач</p>';
    } else if (empty($notResolvedTasks)) {
        echo '<p class="text-secondary m-2">У этого исполнителя нет задач в работе</p>';
    } else {
        echo '<p class="text-secondary m-2">Задачи исполнителя</p>';
    }
    ?>

    <div class="workers_tasks w-100 d-flex flex-row flex-wrap">
        <?php foreach ($user->tasks as $task):
            if ($task->status !== TaskModel::IS_READY) {

                $deadlineVar = $task->date_end;
                $deadline = new DateTime($deadlineVar);
                $now = new DateTime();
                $intervalFromDeadline = $deadline->diff($now);

                $daysF = ($intervalFromDeadline->d > 0) ? str_pad($intervalFromDeadline->d, 2, '0', STR_PAD_LEFT) : '';
                $hoursF = str_pad($intervalFromDeadline->h, 2, '0', STR_PAD_LEFT);
                $minutesF = str_pad($intervalFromDeadline->i, 2, '0', STR_PAD_LEFT);

                $intervalToDeadline = $now->diff($deadline);
                $daysT = ($intervalToDeadline->d > 0) ? str_pad($intervalToDeadline->d, 2, '0', STR_PAD_LEFT) : '';
                $hoursT = str_pad($intervalToDeadline->h, 2, '0', STR_PAD_LEFT);
                $minutesT = str_pad($intervalToDeadline->i, 2, '0', STR_PAD_LEFT);

                ?>
                <ul class="list-unstyled w-50">
                    <li class="m-2 p-2 fz-18 rounded-3 border border-opacity-50 border-3 <?php if ($now > $deadline) { ?> border-danger
                    <?php }
                    else if ($task->status === TaskModel::IS_NEW || $task->status === TaskModel::IS_READY) { ?> border-success <?php }
                    else if ($task->status === TaskModel::AT_WORK || $task->status === TaskModel::IN_TEST) { ?> border-primary <?php }
                    else if ($task->status === TaskModel::ON_REVIEW || $task->status === TaskModel::READY_TO_RELEASE || TaskModel::NEED_INFO) { ?> border-warning <?php }
                    ?>">
                        <?= Html::a($task->name, ['task/update/' . $task->id], ['class' => 'text-primary my-link text-decoration-none', 'target' => '_blank']); ?>
                        <div class="mt-3 d-flex flex-row justify-content-between">
                            Статус
                            <div>
                                <span><?= $task->status; ?></span>
                            </div>
                        </div>
                        <div class="mt-3 d-flex flex-row justify-content-between">
                            Story_point
                            <div>
                                <span><?= $task->story_point; ?></span>
                            </div>
                        </div>
                        <?php if ($now >= $deadline) { ?>
                            <div class="mt-3 text-danger d-flex flex-row justify-content-between">
                                Просрочена на
                                <div>
                                    <?php echo $daysF ? '<span>' . $daysF . '</span> д' : ''; ?>
                                    <span><?= $hoursF; ?></span> ч
                                    <span><?= $minutesF; ?></span> мин
                                </div>
                            </div>
                        <?php } else { ?>
                            <div class="mt-3 text-success d-flex flex-row justify-content-between">
                                На выполнение осталось
                                <div>
                                    <?php echo $daysT ? '<span>' . $daysT . '</span> д' : ''; ?>
                                    <?= $hoursT; ?> ч
                                    <?= $minutesT; ?> мин
                                </div>
                            </div>
                        <?php } ?>
                    </li>
                </ul>
            <?php } endforeach; ?>
    </div>
<?php endforeach; ?>

