<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * Created by PhpStorm.
 * User: Ben
 * Date: 06/04/2017
 * Time: 09:35
 */
class Admin extends CI_Controller
{
    public $status;
    public $roles;

    function __construct()
    {
        parent::__construct();
        $this->load->model('Movie_model', 'movie_model', TRUE);
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->status = $this->config->item('status');
        $this->roles = $this->config->item('roles');

        if($this->session->has_userdata('role') == FALSE || $this->session->userdata('role') != $this->roles[1])
        {
            $this->session->set_flashdata('flash_message', 'You do not have permission to access this area.');
            redirect(site_url());
        }
    }

    public function index()
    {
        $this->load->helper('image');
        $data['movies'] = $this->movie_model->get_all();
        $this->template->load_admin('home', 'Admin Home', $data);
    }

    public function tmdb_search()
    {
        $this->template->load_admin('movie/search_tmdb', 'Search');
    }

    public function do_search()
    {
        $search = $this->input->post('search');
        $this->load->library('tmdb');
        $data['tmdb'] = $this->tmdb->search_movies($search);
        echo json_encode($data['tmdb']->results);
    }

    public function add_movie($tmdb_id)
    {
        $this->load->library(array('tmdb', 'form_validation'));
        $data['movie'] = $this->tmdb->movie_info($tmdb_id);
        $data['posters'] = $this->tmdb->movie_images($tmdb_id)->posters;

        $this->form_validation->set_rules('title', 'Title', 'required');

        if(!$data['movie'])
        {
            redirect(site_url() . 'admin/movie/search-tmdb');
        }

        if($this->form_validation->run() == FALSE)
        {
            $this->template->load_admin('movie/add', 'Add Movie', $data);
        }
        else
        {
            $post = $this->input->post();
            $clean = $this->security->xss_clean($post);

            if($_POST['phobia_type'] != 'none')
            {
                $phobia_string = $_POST['phobia_start_time'] . '#' . $_POST['phobia_duration'] . '#' . $_POST['phobia_notes'];
                if($_POST['phobia_type'] == 'vomit')
                    $_POST['phobia_vomit'] = $phobia_string;
                if($_POST['phobia_type'] == 'blood')
                    $_POST['phobia_blood'] = $phobia_string;
                if($_POST['phobia_type'] == 'spiders')
                    $_POST['phobia_spiders'] = $phobia_string;
                if($_POST['phobia_type'] == 'snakes')
                    $_POST['phobia_snakes'] = $phobia_string;
                if($_POST['phobia_type'] == 'needles')
                    $_POST['phobia_needles'] = $phobia_string;
                if($_POST['phobia_type'] == 'puppets')
                    $_POST['phobia_puppets'] = $phobia_string;
                if($_POST['phobia_type'] == 'clowns')
                    $_POST['phobia_clowns'] = $phobia_string;
                if($_POST['phobia_type'] == 'heights')
                    $_POST['phobia_heights'] = $phobia_string;
            }

            $id = $this->movie_model->insert();
            copy('http://image.tmdb.org/t/p/original/' . $data['posters'][$_POST['poster']]->file_path, 'images/movies/posters/' . $id . '.jpg');

            $this->session->set_flashdata('flash_message', $data['movie']->title . ' added.');
            redirect(site_url() . 'admin');
        }
    }
}