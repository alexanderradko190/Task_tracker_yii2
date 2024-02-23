<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


$this->title = 'Создать задачу';
$this->params['breadcrumbs'][] = $this->title;
?>

    <?php
    $user = Yii::$app->user->identity;
    ?>
    <div class="task-create-page d-flex">
    <div class="task-create-form w-50 my-auto">

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($task, 'name')->textInput() ?>

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

<?= $form->field($task, 'story_point')->dropDownList([
    '0' => 'не указано',
    '1' => '1',
    '2' => '2',
    '3' => '3',
    '4' => '4',
    '5' => '5',
    '6' => '6',
    '7' => '7',
    '8' => '8',
    '9' => '9',
    '10' => '10',
]); ?>

<?= $form->field($task, 'date_end')->textInput(['type' => 'date']); ?>

    <div class="form-group d-flex justify-content-between">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        <?= Html::button('Отменить действие', ['id' => 'cancel-button', 'class' => 'btn btn-danger']) ?>
    </div>

<?php ActiveForm::end(); ?>
    </div>
    </div>

<?php
$this->registerJs("
    $('#cancel-button').on('click', function() {
        window.history.back();
    });
");
?>
