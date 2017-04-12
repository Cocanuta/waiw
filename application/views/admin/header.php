<?php
/**
 * Created by PhpStorm.
 * User: Ben
 * Date: 06/04/2017
 * Time: 10:35
 */
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html>
<head>
    <title><?= $pageTitle ?></title>

    <!-- CSS -->
    <link rel="stylesheet" href="<?= site_url() . 'assets/css/bootstrap.css' ?>">

    <!-- JS -->
    <script src="<?= site_url() . 'assets/js/jquery-3.2.0.min.js' ?>"></script>
    <script src="<?= site_url() . 'assets/js/bootstrap.js' ?>"></script>

</head>
<body>

<?php
$arr = $this->session->flashdata();
if(!empty($arr['flash_message'])) : ?>
    <div class="alert alert-warning alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <?= $arr['flash_message'] ?>
    </div>
<?php endif; ?>
<div class="container">
    <div class="row">