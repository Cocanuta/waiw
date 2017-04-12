<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="col-lg-4 col-lg-offset-4">
    <h2>Almost There!</h2>
    <h5>Hello <span><?= $first_name; ?></span>. Your username is <span><?= $email; ?></span></h5>
    <small>Please enter a password to begin using the site.</small>

    <?= form_open(site_url().'auth/complete/token/'.$token, array('class' => 'form-signin')); ?>
    <div class="form-group">
        <?= form_password(array('name' => 'password', 'id' => 'password', 'placeholder' => 'Password', 'class' => 'form-control', 'value' => set_value('password'))); ?>
        <?= form_error('password'); ?>
    </div>
    <div class="form-group">
        <?= form_password(array('name' => 'passconf', 'id' => 'passconf', 'placeholder' => 'Confirm Password', 'class' => 'form-control', 'value' => set_value('passconf'))); ?>
        <?= form_error('passconf'); ?>
    </div>
    <?= form_hidden('user_id', $user_id);?>
    <?= form_submit(array('value' => 'Complete', 'class'=>'btn btn-lg btn-primary btn-block')); ?>
    <?= form_close(); ?>
</div>
