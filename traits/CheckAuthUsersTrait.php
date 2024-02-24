<?php

namespace app\traits;

use Yii;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

trait CheckAuthUsersTrait
{
    public function checkAuthorization()
    {
        $allowedUrls = ['/site/about', '/site/login', '/site/signup'];

        $currentUrl = Url::to();
        $isActiveUrl = ArrayHelper::isIn($currentUrl, $allowedUrls);

        if (Yii::$app->user->isGuest && !$isActiveUrl) {
            throw new \yii\web\ForbiddenHttpException('У вас нет разрешения на доступ к этой странице.');
        }
    }
}

