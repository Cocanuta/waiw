<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="col-lg-4 col-lg-offset-4">
    <h2>Please Login</h2>
    <?= form_open(site_url().'auth/login', array('class' => 'form-signin')); ?>
    <div class="form-group">
        <?= form_input(array('name' => 'email', 'id' => 'email', 'placeholder' => 'Email', 'class' => 'form-control', 'value' => set_value('email'))); ?>
        <?= form_error('email'); ?>
    </div>
    <div class="form-group">
        <?= form_password(array('name' => 'password', 'id' => 'password', 'placeholder' => 'Password', 'class' => 'form-control', 'value' => set_value('password'))); ?>
        <?= form_error('password'); ?>
    </div>
    <?= form_submit(array('value' => 'Login', 'class'=>'btn btn-lg btn-primary btn-block')); ?>
    <?= form_close(); ?>
    <p>Don't have an account? Click to <a href="<?= site_url().'auth/register'; ?>">Register</a></p>
    <p>Click <a href="<?= site_url().'auth/forgot'; ?>">here</a> if you forgot your password.</p>
</div>
