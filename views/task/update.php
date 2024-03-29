<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Обновить задачу';
$this->params['breadcrumbs'][] = $this->title;
?>

    <div class="task-update-page d-flex">
        <div class="task-update-form w-50 my-auto">
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($task, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($task, 'description')->textInput() ?>

            <?= $form->field($task, 'status')->dropDownList([
                'Новая' => 'Новая',
                'В работе' => 'В работе',
                'На ревью' => 'На ревью',
                'В тестировании' => 'В тестировании',
                'Готова к релизу' => 'Готова к релизу',
                'Решена' => 'Решена',
                'Требуется информация' => 'Требуется информация'
            ]) ?>

            <?= $form->field($task, 'date_end')->textInput(['type' => 'date', 'value' => date('Y-m-d', strtotime($task->date_end))]) ?>

            <?= $form->field($task, 'story_point')->dropDownList([
                '0' => 'не указано',
                '1' => '1',
                '2' => '2',
                '3' => '3',
                '4' => '4',
                '5' => '5',
                '6' => '6',
                '7' => '7',
                '8' => '7',
                '9' => '9',
                '10' => '10',
            ]); ?>

            <?= $form->field($task, 'created_at')->textInput([
                'type' => 'date',
                'value' => date('Y-m-d', strtotime($task->created_at)),
                'readonly' => true
            ]) ?>

            <?= $form->field($task, 'user_id')->dropDownList(ArrayHelper::map($workers, 'id', 'username'), ['options' => [$currentWorker->id => ['selected' => true]]]) ?>

            <div class="form-group d-flex justify-content-between">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success mt-4']) ?>
                <?= Html::button('Отменить действие', ['id' => 'cancel-button', 'class' => 'btn btn-danger mt-4']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

<?php
$this->registerJs("
    $('#cancel-button').on('click', function() {
    var taskId = " . $task->id . ";
    var url = '/task/' + taskId;
    window.location.href = url;
        window.history.back();
    });
");
?>