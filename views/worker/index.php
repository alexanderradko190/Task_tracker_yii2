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
        <div class="workers_tasks w-100 d-flex flex-row flex-wrap">
        <?php
        foreach($user->tasks as $task):

            $deadlineVar = $task->date_end;
            $deadline = new DateTime($deadlineVar);
            $now = new DateTime();
            $intervalFromDeadline = $now->diff($deadline);
            $hoursF = str_pad($intervalFromDeadline->h, 2, STR_PAD_LEFT);
            $minutesF = str_pad($intervalFromDeadline->i, 2, STR_PAD_LEFT);
            $intervalFromDeadline = $deadline->diff($now);
            $hoursT = str_pad($intervalFromDeadline->h, 2, STR_PAD_LEFT);
            $minutesT = str_pad($intervalFromDeadline->i, 2, STR_PAD_LEFT);
            $overdueH = $hoursF;
            $overdueM = $minutesF;
            $untilH = $hoursT;
            $untilM = $minutesT;
            ?>
            <ul class="list-unstyled w-50">
            <li class="m-2 p-2 fz-18 rounded-3<?php if ($now > $deadline) { ?> border border-opacity-25 border-danger border-3 <?php }
            else { ?> border border-dark border-1 <?php } ?>">
                <?= Html::a($task->name, ['task/'.$task->id], ['class' => 'text-primary my-link text-decoration-none', 'target' => '_blank']); ?>
                <?php if ($now >= $deadline) { ?>
                   <div class="mt-3 text-danger d-flex flex-row justify-content-between">
                       Просрочена на
                       <div>
                           <span><?= $overdueH; ?></span> ч
                           <span><?= $overdueM; ?></span> мин
                       </div>
                   </div>
               <?php } else {?>
                    <div class="mt-3 text-success d-flex flex-row justify-content-between">
                        На выполнение осталось
                        <div>
                            <?= $untilH; ?> ч
                            <?= $untilM; ?> мин
                        </div>
                    </div>
                <?php } ?>
                <div class="mt-3 d-flex flex-row justify-content-between">
                    Дедлайн
                    <div>
                        <?= $task->date_end; ?>
                    </div>
                </div>
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
            </li>
            </ul>
        <?php
        endforeach;
        ?>
        </div>
        <?php
        endforeach;
?>

