<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->library('tmdb');
		$this->load->model('movie_model');
        $poster_url = $this->config->item('image_base_url');

        $movies = $this->movie_model->get_all();

        echo "<pre style='word-wrap: break-word; white-space: pre-wrap;'>";
        if($this->session->has_userdata('first_name'))
        {
            echo "Welcome " . $this->session->userdata('first_name');
            if($this->session->has_userdata('role') && $this->session->userdata('role') == $this->config->item('roles')[1])
            {
                echo " you are an Admin";
            }
        }
        else
        {
            echo '<a href="' . site_url() . 'auth/login">Login</a>';
        }
        foreach($movies as $movie)
        {
            $poster = $poster_url.$this->tmdb->movie_images($movie->tmdb_id)->posters[0]->file_path;
            echo "\n<a href=" . base_url('movie/') . $movie->tmdb_id . "><img src=" . $poster . "></a>";
            echo "\n" . $movie->title;
            //var_dump($movie);
            $phobias = 0;
            if(count($movie->phobia_vomit) > 0) { $phobias += 1; }
            if(count($movie->phobia_blood) > 0) { $phobias += 1; }
            if(count($movie->phobia_spiders) > 0) { $phobias += 1; }
            if(count($movie->phobia_snakes) > 0) { $phobias += 1; }
            if(count($movie->phobia_needles) > 0) { $phobias += 1; }
            if(count($movie->phobia_puppets) > 0) { $phobias += 1; }
            if(count($movie->phobia_clowns) > 0) { $phobias += 1; }
            if(count($movie->phobia_heights) > 0) { $phobias += 1; }

            echo "\n" . $phobias . " phobia" . (($phobias > 1) ? "s" : "") . " occur" . (($phobias > 1) ? "" : "s");
        }
        echo "</pre>";

	}

	public function movie($tmdb_id)
    {
        $this->load->library('tmdb');
        $this->load->config('tmdb');
        $poster_url  = $this->config->item('image_base_url');

        $movie_poster = $this->tmdb->movie_images($tmdb_id);

        $this->load->model('movie_model');

        $phobias = $this->movie_model->get_tmdb($tmdb_id);

        echo "<pre style='word-wrap: break-word; white-space: pre-wrap;'>";
        echo "Title: " . $phobias->title;
        echo "\nOverview:" . $phobias->overview;
        echo "\n<img src=" . $poster_url . $movie_poster->posters[0]->file_path . ">";
        if(isset($phobias->phobia_vomit))
        {
            foreach ($phobias->phobia_vomit as $phobia)
            {
                if($phobia[0] == 0 && $phobia[1] == 0)
                {
                    echo "\nVomit";
                    echo "\nThis occurs throughout the whole movie.";
                    echo "\nNotes: " . $phobia[2];
                }
                else
                {
                    echo "\nVomit";
                    echo "\nStarts At: " . $phobia[0] . "m";
                    echo "\nLasts: " . $phobia[1] . "s";
                    echo "\nNotes: " . $phobia[2];
                }
            }
        }
        if(isset($phobias->phobia_blood))
        {
            foreach ($phobias->phobia_blood as $phobia)
            {
                if($phobia[0] == 0 && $phobia[1] == 0)
                {
                    echo "\nBlood";
                    echo "\nThis occurs throughout the whole movie.";
                    echo "\nNotes: " . $phobia[2];
                }
                else
                {
                    echo "\nBlood";
                    echo "\nStarts At: " . $phobia[0] . "m";
                    echo "\nLasts: " . $phobia[1] . "s";
                    echo "\nNotes: " . $phobia[2];
                }
            }
        }
        if(isset($phobias->phobia_spiders))
        {
            foreach ($phobias->phobia_spiders as $phobia)
            {
                if($phobia[0] == 0 && $phobia[1] == 0)
                {
                    echo "\nSpiders";
                    echo "\nThis occurs throughout the whole movie.";
                    echo "\nNotes: " . $phobia[2];
                }
                else
                {
                    echo "\nSpiders";
                    echo "\nStarts At: " . $phobia[0] . "m";
                    echo "\nLasts: " . $phobia[1] . "s";
                    echo "\nNotes: " . $phobia[2];
                }
            }
        }
        if(isset($phobias->phobia_snakes))
        {
            foreach ($phobias->phobia_snakes as $phobia)
            {
                if($phobia[0] == 0 && $phobia[1] == 0)
                {
                    echo "\nSnakes";
                    echo "\nThis occurs throughout the whole movie.";
                    echo "\nNotes: " . $phobia[2];
                }
                else
                {
                    echo "\nSnakes";
                    echo "\nStarts At: " . $phobia[0] . "m";
                    echo "\nLasts: " . $phobia[1] . "s";
                    echo "\nNotes: " . $phobia[2];
                }
            }
        }
        if(isset($phobias->phobia_needles))
        {
            foreach ($phobias->phobia_needles as $phobia)
            {
                if($phobia[0] == 0 && $phobia[1] == 0)
                {
                    echo "\nNeedles";
                    echo "\nThis occurs throughout the whole movie.";
                    echo "\nNotes: " . $phobia[2];
                }
                else
                {
                    echo "\nNeedles";
                    echo "\nStarts At: " . $phobia[0] . "m";
                    echo "\nLasts: " . $phobia[1] . "s";
                    echo "\nNotes: " . $phobia[2];
                }
            }
        }
        if(isset($phobias->phobia_puppets))
        {
            foreach ($phobias->phobia_puppets as $phobia)
            {
                if($phobia[0] == 0 && $phobia[1] == 0)
                {
                    echo "\nPuppets";
                    echo "\nThis occurs throughout the whole movie.";
                    echo "\nNotes: " . $phobia[2];
                }
                else
                {
                    echo "\nPuppets";
                    echo "\nStarts At: " . $phobia[0] . "m";
                    echo "\nLasts: " . $phobia[1] . "s";
                    echo "\nNotes: " . $phobia[2];
                }
            }
        }
        if(isset($phobias->phobia_clowns))
        {
            foreach ($phobias->phobia_clowns as $phobia)
            {
                if($phobia[0] == 0 && $phobia[1] == 0)
                {
                    echo "\nClowns";
                    echo "\nThis occurs throughout the whole movie.";
                    echo "\nNotes: " . $phobia[2];
                }
                else
                {
                    echo "\nClowns";
                    echo "\nStarts At: " . $phobia[0] . "m";
                    echo "\nLasts: " . $phobia[1] . "s";
                    echo "\nNotes: " . $phobia[2];
                }
            }
        }
        if(isset($phobias->phobia_heights))
        {
            foreach ($phobias->phobia_heights as $phobia)
            {
                if($phobia[0] == 0 && $phobia[1] == 0)
                {
                    echo "\nHeights";
                    echo "\nThis occurs throughout the whole movie.";
                    echo "\nNotes: " . $phobia[2];
                }
                else
                {
                    echo "\nHeights";
                    echo "\nStarts At: " . $phobia[0] . "m";
                    echo "\nLasts: " . $phobia[1] . "s";
                    echo "\nNotes: " . $phobia[2];
                }
            }
        }
        echo"</pre>";
    }
}
