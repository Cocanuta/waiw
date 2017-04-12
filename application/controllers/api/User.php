<?php

/**
 * Created by PhpStorm.
 * User: Ben
 * Date: 05/04/2017
 * Time: 23:45
 */
require_once APPPATH.'libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class User extends REST_Controller
{
    function __construct($config = 'rest')
    {
        parent::__construct($config);
    }

    public function index_get()
    {
        $this->response($this->db->get('users')->result());
    }
}