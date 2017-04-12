<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="col-lg-12">
    <h1>WAIW</h1>
    <h5>WHAT AM I WATCHING</h5>

    <div class="row">
    <?php foreach($movies as $movie) : ?>
        <div class="col-md-2 panel panel-default" style="margin: 15px; padding: 10px 10px 0px 10px;">
            <img src="<?= site_url() . 'images/movies/posters/' . $movie->id . '-200x300.jpg' ?>" class="img-rounded img-responsive">
            <p class="text-center"><strong><?= $movie->title ?></strong></p>
            <p class="text-center"><?= count($movie->phobia_vomit) +  count($movie->phobia_blood) + count($movie->phobia_spiders) + count($movie->phobia_snakes) + count($movie->phobia_needles) + count($movie->phobia_puppets) + count($movie->phobia_clowns) + count($movie->phobia_heights) . ' phobia occurance(s)' ?></p>
        </div>
    <?php endforeach; ?>
    </div>
</div>
