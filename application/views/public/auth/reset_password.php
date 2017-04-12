<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="col-lg-4 col-lg-offset-4">
    <h2>Reset your password</h2>
    <h5>Hello <span><?php echo $first_name; ?></span>, Please enter your password 2x below to reset</h5>
<?php
echo form_open(site_url().'auth/reset-password/token/'.$token, array('class' => 'form-signin')); ?>
<div class="form-group">
    <?php echo form_password(array('name'=>'password', 'id'=> 'password', 'placeholder'=>'Password', 'class'=>'form-control', 'value' => set_value('password'))); ?>
    <?php echo form_error('password') ?>
</div>
<div class="form-group">
    <?php echo form_password(array('name'=>'passconf', 'id'=> 'passconf', 'placeholder'=>'Confirm Password', 'class'=>'form-control', 'value'=> set_value('passconf'))); ?>
    <?php echo form_error('passconf') ?>
</div>
<?php echo form_submit(array('value'=>'Reset Password', 'class'=>'btn btn-lg btn-primary btn-block')); ?>
<?php echo form_close(); ?>

</div>