<?php

$role = '';

if (Yii::$app->user->can('admin')) {
    $role = "admin";
} else if (Yii::$app->user->can('doctor')) {
    $role = "doctor";
} else if (Yii::$app->user->can('guest')) {
    $role = "guest";
}

if ($role) {
    $menu = require "left-{$role}.php";

    echo $this->render(
        'left-view',
        [
            'menu'           => $menu,
            'user'           => Yii::$app->user->identity,
            'directoryAsset' => $directoryAsset,
        ]
    );
}
