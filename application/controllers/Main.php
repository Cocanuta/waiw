<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: Ben
 * Date: 06/04/2017
 * Time: 11:24
 */
class Main extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->model('Movie_model', 'movie_model', TRUE);
        $data['movies'] =  $this->movie_model->get_all();

        $this->template->load_public('home', 'Home', $data);
    }

    public function resize() {
        // basic info
        $path = $this->uri->uri_string();
        $pathinfo = pathinfo($path);
        $sizetmp = explode("-", $pathinfo["filename"]);
        $size = end($sizetmp);
        $original = $pathinfo["dirname"] . "/" . str_ireplace("-" . $size, "", $pathinfo["basename"]);

        // original image not found, show 404
        if (!file_exists($original)) {
            echo $original;
            show_404($original);
        }

        // load the allowed image sizes
        $this->load->config("images");
        $sizes = $this->config->item("image_sizes");
        $allowed = FALSE;

        if (stripos($size, "x") !== FALSE) {
            // dimensions are provided as size
            @list($width, $height) = explode("x", $size);

            // security check, to avoid users requesting random sizes
            foreach ($sizes as $s) {
                if ($width == $s[0] && $height == $s[1]) {
                    $allowed = TRUE;
                    break;
                }
            }
        } else if (isset($sizes[$size])) {
            // optional, the preset is provided instead of the dimensions
            // NOTE: the controller will be executed EVERY time you request the image this way
            @list($width, $height) = $sizes[$size];
            $allowed = TRUE;

            // set the correct output path
            $path = str_ireplace($size, $width . "x" . $height, $path);
        }

        // only continue with a valid width and height
        if ($allowed && $width >= 0 && $height >= 0) {
            // initialize library
            $config["source_image"] = $original;
            $config['new_image'] = $path;
            $config["width"] = $width;
            $config["height"] = $height;
            $config["dynamic_output"] = FALSE; // always save as cache

            $this->load->library('image_lib');
            $this->image_lib->initialize($config);

            $this->image_lib->fit();
        }

        // check if the resulting image exists, else show the original
        if (file_exists($path)) {
            $output = $path;
        } else {
            $output = $original;
        }

        $info = getimagesize($output);

        // output the image
        header("Content-Disposition: filename={$output};");
        header("Content-Type: {$info["mime"]}");
        header('Content-Transfer-Encoding: binary');
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s', time()) . ' GMT');

        readfile($output);
    }
}