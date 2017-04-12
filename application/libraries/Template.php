<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Ben
 * Date: 05/04/2017
 * Time: 21:09
 */
class Template
{
    public function load_public($view, $title=null, $data=array())
    {
        $ci=&get_instance();
        $header['pageTitle'] = "WAIW";
        if($title !== NULL)
        {
            $header['pageTitle'] = "WAIW " . $title;
        }
        $ci->load->view('public/header', $header);
        $ci->load->view('public/' . $view, $data);
        $ci->load->view('public/footer');
    }

    public function load_admin($view, $title=null, $data=array())
    {
        $ci=&get_instance();
        $header['pageTitle'] = "WAIW";
        if($title !== NULL)
        {
            $header['pageTitle'] = "WAIW " . $title;
        }
        $ci->load->view('admin/header', $header);
        $ci->load->view('admin/' . $view, $data);
        $ci->load->view('admin/footer');
    }
}