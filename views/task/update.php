<?php

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

    <?= $form->field($task, 'status')->textInput() ?>

    <?= $form->field($task, 'date_end')->textInput(['type' => 'datetime']) ?>

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

    <?= $form->field($task, 'created_at')->textInput(['type' => 'datetime']) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success mt-4']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
</div>