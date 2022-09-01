<?php

/** @var $model User */

use app\models\User;


/** @var $this \app\core\View */

$this->title = 'Login';

?>
<div class="container">
    <div class="wrapper">
        <div class="title"><span>Login Form</span></div>
        <?php $form = \app\core\form\Form::begin('', 'post') ?>
        <div class="row">
            <i class="fas fa-user"></i>
            <?php echo $form->field($model, 'email','Your email') ?></div>
        <div class="row">
            <i class="fas fa-lock"></i>
            <?php echo $form->field($model, 'password', 'Your Password')->passwordField() ?>
        </div>
        <div class="row">
            <button type="submit">Login</button>
        </div>
        <div class="signup-link">
            Not a member? <a href="/MaSTMVC/index.php/register">Signup now</a>
        </div>
        <?php \app\core\form\Form::end() ?>

    </div>
</div>