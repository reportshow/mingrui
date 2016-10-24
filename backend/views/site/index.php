<?php



$role = '';

if (Yii::$app->user->can('admin')) {
    $role = "admin";
} else if (Yii::$app->user->can('doctor')) {
    $role = "doctor";
} else if (Yii::$app->user->can('guest')) {
    $role = "guest";
}

$abc =100;

  require "index-{$role}.php";

