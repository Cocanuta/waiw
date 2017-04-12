<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="col-lg-4 col-lg-offset-4">
    <h2>Hello There</h2>
    <h5>Please enter the required information below.</h5>
    <?= form_open('/auth/register', array('class' => 'form_signin')); ?>
    <div class="form-group">
        <?= form_input(array('name' => 'first_name', 'id' => 'first_name', 'placeholder' => 'First Name', 'class' => 'form-control', 'value' => set_value('first_name'))); ?>
        <?= form_error('first_name'); ?>
    </div>
    <div class="form-group">
        <?= form_input(array('name' => 'last_name', 'id' => 'last_name', 'placeholder' => 'Last Name', 'class' => 'form-control', 'value' => set_value('last_name'))); ?>
        <?= form_error('last_name'); ?>
    </div>
    <div class="form-group">
        <?= form_input(array('name' => 'email', 'id' => 'email', 'placeholder' => 'Email', 'class' => 'form-control', 'value' => set_value('email'))); ?>
        <?= form_error('email'); ?>
    </div>
    <?= form_submit(array('value' => 'Sign Up', 'class' => 'btn btn-lg btn-primary btn-block')); ?>
    <?= form_close(); ?>
    </div>
</div>
