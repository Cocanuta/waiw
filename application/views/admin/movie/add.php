<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="col-lg-10 col-lg-offset-1">
    <h2>Add Movie</h2>
    <?= form_open(site_url().'admin/movie/add/' . $movie->id, array('class' => 'form-addmovie')); ?>
    <div class="form-group">
        <?= form_input(array('name' => 'title', 'id' => 'title', 'placeholder' => 'Title', 'class' => 'form-control', 'value' => $movie->title)); ?>
        <?= form_error('title'); ?>
    </div>
    <div class="form-group">
        <?= form_textarea(array('name' => 'overview', 'id' => 'overview', 'placeholder' => 'Overview', 'class' => 'form-control', 'value' => $movie->overview)); ?>
        <?= form_error('overview'); ?>
    </div>
    <div class="form-group">
        <?= form_input(array('name' => 'runtime', 'id' => 'runtime', 'placeholder' => 'Runtime', 'class' => 'form-control', 'value' => $movie->runtime)); ?>
        <?= form_error('runtime'); ?>
    </div>
    <div class="form-group">
        <?= form_input(array('name' => 'release_date', 'id' => 'release_date', 'placeholder' => 'Release Date', 'class' => 'form-control', 'value' => $movie->release_date)); ?>
        <?= form_error('release_date'); ?>
    </div>
    <div class="form-group">
        <?= form_input(array('name' => 'tmdb_id', 'id' => 'tmdb_id', 'placeholder' => 'tMDb ID', 'class' => 'form-control', 'value' => $movie->id)); ?>
        <?= form_error('tmdb_id'); ?>
    </div>
    <div class="form-group">
        <?php for($i = 0; $i < 5; $i++) : ?>
            <div class="col-lg-2 well">
                <img src="http://image.tmdb.org/t/p/w185/<?= $posters[$i]->file_path ?>" class="img-responsive">
                <?= form_radio(array('name' => 'poster', 'id' => 'poster', 'value' => $i, 'checked' => ($i == 0)?"checked":"")); ?>
            </div>
        <?php endfor; ?>
    </div>
    <div class="form-group">
        <?= form_dropdown('phobia_type', array('none' => 'None', 'vomit' => 'Vomit', 'blood' => 'Blood', 'spiders' => 'Spiders', 'snakes' => 'Snakes', 'needles' => 'Needles', 'puppets' => 'Puppets', 'clowns' => 'Clowns', 'heights' => 'Heights'), 'none', array('id' => 'phobia_type', 'class' => 'form-control')); ?>
        <?= form_input(array('name' => 'phobia_start_time', 'id' => 'phobia_start_time', 'placeholder' => 'Phobia Start Time', 'class' => 'form-control', 'value' => set_value('phobia_start_time'))); ?>
        <?= form_input(array('name' => 'phobia_duration', 'id' => 'phobia_duration', 'placeholder' => 'Phobia Duration', 'class' => 'form-control', 'value' => set_value('phobia_duration'))); ?>
        <?= form_input(array('name' => 'phobia_notes', 'id' => 'phobia_notes', 'placeholder' => 'Phobia Notes', 'class' => 'form-control', 'value' => set_value('phobia_notes'))); ?>
        <?= form_error('phobia_start_time'); ?>
        <?= form_error('phobia_duration'); ?>
        <?= form_error('phobia_notes'); ?>
    </div>
    <?= form_submit(array('value' => 'Add', 'class' => 'btn btn-lg btn-primary btn-block')); ?>
    <?= form_close(); ?>
</div>