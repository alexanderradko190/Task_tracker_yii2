<?php

use yii\helpers\Url;

return [
    '/' => 'site/index',
    'task' => 'task/index',
    'task/<id>' => 'task/view',
    'task/update/<id>' => 'task/update',
    'task/create/' => 'task/create',
    'worker' => 'worker/index',
];