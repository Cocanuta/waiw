<?php

/**
 * Created by PhpStorm.
 * User: Ben
 * Date: 05/04/2017
 * Time: 10:01
 */
class Movie_model extends CI_Model
{
    public $id;
    public $title;
    public $overview;
    public $runtime;
    public $release_date;
    public $tmdb_id;
    public $phobia_vomit;
    public $phobia_blood;
    public $phobia_spiders;
    public $phobia_snakes;
    public $phobia_needles;
    public $phobia_puppets;
    public $phobia_clowns;
    public $phobia_heights;

    public function get_tmdb($id)
    {
        $query = $this->db->get_where('movies', array('tmdb_id' => $id))->result()[0];
        $phobias_vomit_string = array_filter(explode('|', $query->phobia_vomit));
        $phobia_blood_string = array_filter(explode('|', $query->phobia_blood));
        $phobia_spiders_string = array_filter(explode('|', $query->phobia_spiders));
        $phobia_snakes_string = array_filter(explode('|', $query->phobia_snakes));
        $phobia_needles_string = array_filter(explode('|', $query->phobia_needles));
        $phobia_puppets_string = array_filter(explode('|', $query->phobia_puppets));
        $phobia_clowns_string = array_filter(explode('|', $query->phobia_clowns));
        $phobia_heights_string = array_filter(explode('|', $query->phobia_heights));
        $phobias = [];
        foreach($phobias_vomit_string as $item)
        {
            $phobias[] = explode('#', $item);
        }
        $query->phobia_vomit = $phobias;

        $phobias = [];
        foreach($phobia_blood_string as $item)
        {
            $phobias[] = explode('#', $item);
        }
        $query->phobia_blood = $phobias;

        $phobias = [];
        foreach($phobia_spiders_string as $item)
        {
            $phobias[] = explode('#', $item);
        }
        $query->phobia_spiders = $phobias;

        $phobias = [];
        foreach($phobia_snakes_string as $item)
        {
            $phobias[] = explode('#', $item);
        }
        $query->phobia_snakes = $phobias;

        $phobias = [];
        foreach($phobia_needles_string as $item)
        {
            $phobias[] = explode('#', $item);
        }
        $query->phobia_needles = $phobias;

        $phobias = [];
        foreach($phobia_puppets_string as $item)
        {
            $phobias[] = explode('#', $item);
        }
        $query->phobia_puppets = $phobias;

        $phobias = [];
        foreach($phobia_clowns_string as $item)
        {
            $phobias[] = explode('#', $item);
        }
        $query->phobia_clowns = $phobias;

        $phobias = [];
        foreach($phobia_heights_string as $item)
        {
            $phobias[] = explode('#', $item);
        }
        $query->phobia_heights = $phobias;

        return $query;
    }

    public function get_all($count = 0)
    {
        if($count == 0)
        {
            $lookup = $this->db->get('movies')->result();
            foreach($lookup as $query)
            {
                $phobias_vomit_string = array_filter(explode('|', $query->phobia_vomit));
                $phobia_blood_string = array_filter(explode('|', $query->phobia_blood));
                $phobia_spiders_string = array_filter(explode('|', $query->phobia_spiders));
                $phobia_snakes_string = array_filter(explode('|', $query->phobia_snakes));
                $phobia_needles_string = array_filter(explode('|', $query->phobia_needles));
                $phobia_puppets_string = array_filter(explode('|', $query->phobia_puppets));
                $phobia_clowns_string = array_filter(explode('|', $query->phobia_clowns));
                $phobia_heights_string = array_filter(explode('|', $query->phobia_heights));
                $phobias = [];
                foreach($phobias_vomit_string as $item)
                {
                    $phobias[] = explode('#', $item);
                }
                $query->phobia_vomit = $phobias;

                $phobias = [];
                foreach($phobia_blood_string as $item)
                {
                    $phobias[] = explode('#', $item);
                }
                $query->phobia_blood = $phobias;

                $phobias = [];
                foreach($phobia_spiders_string as $item)
                {
                    $phobias[] = explode('#', $item);
                }
                $query->phobia_spiders = $phobias;

                $phobias = [];
                foreach($phobia_snakes_string as $item)
                {
                    $phobias[] = explode('#', $item);
                }
                $query->phobia_snakes = $phobias;

                $phobias = [];
                foreach($phobia_needles_string as $item)
                {
                    $phobias[] = explode('#', $item);
                }
                $query->phobia_needles = $phobias;

                $phobias = [];
                foreach($phobia_puppets_string as $item)
                {
                    $phobias[] = explode('#', $item);
                }
                $query->phobia_puppets = $phobias;

                $phobias = [];
                foreach($phobia_clowns_string as $item)
                {
                    $phobias[] = explode('#', $item);
                }
                $query->phobia_clowns = $phobias;

                $phobias = [];
                foreach($phobia_heights_string as $item)
                {
                    $phobias[] = explode('#', $item);
                }
                $query->phobia_heights = $phobias;
            }
            return $lookup;
        }
        else
        {
            $query = $this->db->get('movies', $count);
            return $query->result();
        }
    }

    public function insert()
    {
        $this->title    = $_POST['title'];
        $this->overview  = $_POST['overview'];
        $this->runtime  = $_POST['runtime'];
        $this->release_date = $_POST['release_date'];
        $this->tmdb_id  = $_POST['tmdb_id'];
        $this->phobia_vomit =isset($_POST['phobia_vomit']) ? $_POST['phobia_vomit'] : NULL;
        $this->phobia_blood =isset($_POST['phobia_blood']) ? $_POST['phobia_blood'] : NULL;
        $this->phobia_spiders =isset($_POST['phobia_spiders']) ? $_POST['phobia_spiders'] : NULL;
        $this->phobia_snakes =isset($_POST['phobia_snakes']) ? $_POST['phobia_snakes'] : NULL;
        $this->phobia_needles =isset($_POST['phobia_needles']) ? $_POST['phobia_needles'] : NULL;
        $this->phobia_puppets =isset($_POST['phobia_puppets']) ? $_POST['phobia_puppets'] : NULL;
        $this->phobia_clowns =isset($_POST['phobia_clowns']) ? $_POST['phobia_clowns'] : NULL;
        $this->phobia_heights =isset($_POST['phobia_heights']) ? $_POST['phobia_heights'] : NULL;

        $this->db->insert('movies', $this);
        return $this->db->insert_id();
    }

    public function update()
    {
        $this->title    = $_POST['title'];
        $this->overview  = $_POST['overview'];
        $this->runtime  = $_POST['runtime'];
        $this->release_date = $_POST['release_date'];
        $this->tmdb_id  = $_POST['tmdb_id'];
        $this->phobia_vomit =$_POST['phobia_vomit'];
        $this->phobia_blood =$_POST['phobia_blood'];
        $this->phobia_spiders =$_POST['phobia_spiders'];
        $this->phobia_snakes =$_POST['phobia_snakes'];
        $this->phobia_needles =$_POST['phobia_needles'];
        $this->phobia_puppets =$_POST['phobia_puppets'];
        $this->phobia_clowns =$_POST['phobia_clowns'];
        $this->phobia_heights =$_POST['phobia_heights'];

        $this->db->update('movies', $this, array('id' => $_POST['id']));
    }

}