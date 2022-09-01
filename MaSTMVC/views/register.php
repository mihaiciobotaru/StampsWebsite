<?php

/** @var $model User */

use app\models\User;

/** @var $this \app\core\View */

$this->title = 'Register';


?>
<div class="container">
    <div class="wrapper">
        <div class="title"><span>Register Form</span></div>
        <?php $form = \app\core\form\Form::begin('', 'post') ?>

        <div class="row">
            <i class="fas fa-user"></i>
            <?php echo $form->field($model, 'firstname', 'First Name') ?>
        </div>
        <div class="row">
            <i class="fas fa-user"></i>
            <?php echo $form->field($model, 'lastname', 'Last Name') ?>
        </div>
        <div class="row">
            <i class="fas fa-user"></i>
            <?php echo $form->field($model, 'username', 'Your username') ?>
        </div>
        <div class="row">
            <i class="fas fa-envelope"></i>
            <?php echo $form->field($model, 'email', 'Your Email') ?>
        </div>
        <div class="row">
            <i class="fas fa-lock"></i>
            <?php echo $form->field($model, 'password', 'Password')->passwordField() ?>
        </div>
        <div class="row">
            <i class="fas fa-lock"></i>
            <?php echo $form->field($model, 'confirmPassword', 'Confirm Password')->passwordField() ?>
        </div>

        <div class="row">
            <button type="submit">Register</button>
        </div>
        <?php \app\core\form\Form::end() ?>
    </div>
</div>
