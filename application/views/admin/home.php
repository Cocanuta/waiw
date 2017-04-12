<?php
/**
 * Created by PhpStorm.
 * User: Ben
 * Date: 06/04/2017
 * Time: 10:35
 */
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="col-lg-10 col-lg-offset-1">
    <h2>Admin Home</h2>
    <div class="panel panel-default">
        <div class="panel-heading">
            Movies
        </div>
        <div class="panel-body">
            <a href="<?= site_url() . 'admin/movie/search-tmdb' ?>" class="btn btn-primary pull-right">Add Movie</a>
        </div>
        <div class="panel-body">
            <ul class="list-group">
                <?php foreach($movies as $movie) : ?>
                    <a href="#" class="list-group-item">
                        <?= $movie->title ?>
                        <?= ((count($movie->phobia_heights) > 0) ? '<span class="badge">Heights</span>' : '') ?>
                        <?= ((count($movie->phobia_clowns) > 0) ? '<span class="badge">Clowns</span>' : '') ?>
                        <?= ((count($movie->phobia_puppets) > 0) ? '<span class="badge">Puppets</span>' : '') ?>
                        <?= ((count($movie->phobia_needles) > 0) ? '<span class="badge">Needles</span>' : '') ?>
                        <?= ((count($movie->phobia_snakes) > 0) ? '<span class="badge">Snakes</span>' : '') ?>
                        <?= ((count($movie->phobia_spiders) > 0) ? '<span class="badge">Spiders</span>' : '') ?>
                        <?= ((count($movie->phobia_blood) > 0) ? '<span class="badge">Blood</span>' : '') ?>
                        <?= ((count($movie->phobia_vomit) > 0) ? '<span class="badge">Vomit</span>' : '') ?>
                    </a>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>