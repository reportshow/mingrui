<?php



$role = '';

if (Yii::$app->user->can('admin')) {
    $role = "admin";
} else if (Yii::$app->user->can('doctor')) {
    $role = "doctor";
} else if (Yii::$app->user->can('guest')) {
    $role = "guest";
}


  require "index-{$role}.php";

