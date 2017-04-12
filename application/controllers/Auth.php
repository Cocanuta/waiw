<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: Ben
 * Date: 05/04/2017
 * Time: 20:33
 */
class Auth extends CI_Controller
{
    public $status;
    public $roles;

    function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', 'user_model', TRUE);
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->status = $this->config->item('status');
        $this->roles = $this->config->item('roles');
    }

    public function register()
    {
        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

        if($this->form_validation->run() == FALSE)
        {
            $this->template->load_public('auth/register', "Register");
        }
        else
        {
            if($this->user_model->isDuplicate($this->input->post('email')))
            {
                $this->session->set_flashdata('flash_message', 'User email already exists');
                redirect(site_url().'auth/login');
            }
            else
            {
                $clean = $this->security->xss_clean($this->input->post(NULL, TRUE));
                $id = $this->user_model->insertUser($clean);
                $token = $this->user_model->insertToken($id);

                $qstring = $this->base64url_encode($token);
                $url = site_url() . 'auth/complete/token/' . $qstring;
                $link = '<a href="' . $url . '">' . $url . '</a>';

                $message = '';
                $message .= '<strong>You have signed up with your website</strong><br>';
                $message .= '<strong>Please click:</strong> ' . $link;

                echo $message;
                exit;
            }
        }
    }

    public function complete()
    {
        $token = $this->base64url_decode($this->uri->segment(4));
        $cleanToken = $this->security->xss_clean($token);

        $user_info = $this->user_model->isTokenValid($cleanToken);

        if(!$user_info)
        {
            $this->session->set_flashdata('flash_message', 'Token is invalid or expired');
            redirect(site_url().'auth/login');
        }
        $data = array(
            'first_name' => $user_info->first_name,
            'email' => $user_info->email,
            'user_id' => $user_info->id,
            'token' => $this->base64url_encode($token)
        );

        $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|matches[password]');

        if($this->form_validation->run() == FALSE)
        {
            $this->template->load_public('auth/complete', "Complete Registration", $data);
        }
        else
        {
            $this->load->library('password');
            $post = $this->input->post(NULL, TRUE);
            $cleanPost = $this->security->xss_clean($post);

            $hashed = $this->password->create_hash($cleanPost['password']);
            $cleanPost['password'] = $hashed;
            unset($cleanPost['passconf']);
            $userInfo = $this->user_model->updateUserInfo($cleanPost);

            if(!$userInfo)
            {
                $this->session->set_flashdata('flash_message', 'There was a problem updating your record.');
                redirect(site_url().'auth/login');
            }

            unset($userInfo->password);

            foreach($userInfo as $key=>$val)
            {
                $this->session->set_userdata($key, $val);
            }
            redirect(site_url());

        }
    }

    public function login()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if($this->form_validation->run() == FALSE)
        {
            $this->template->load_public('auth/login', "Login");
        }
        else
        {
            $post = $this->input->post();
            $clean = $this->security->xss_clean($post);

            $userInfo = $this->user_model->checkLogin($clean);

            if(!$userInfo)
            {
                $this->session->set_flashdata('flash_message', 'The login was unsuccessful');
                redirect(site_url().'auth/login');
            }
            foreach($userInfo as $key=>$val)
            {
                $this->session->set_userdata($key, $val);
            }
            redirect(site_url());
        }
    }

    public function forgot()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

        if($this->form_validation->run() == FALSE)
        {
            $this->template->load_public('auth/forgot', "Password Recovery");
        }
        else
        {
            $email = $this->input->post('email');
            $clean = $this->security->xss_clean($email);
            $userInfo = $this->user_model->getUserInfoByEmail($clean);

            if(!$userInfo)
            {
                $this->session->set_flashdata('flash_message', 'We cant find your email address.');
                redirect(site_url().'auth/login');
            }

            if($userInfo->status != $this->status[1])
            {
                $this->session->set_flashdata('flash_message', 'Your account is not approved yet, check your email');
                redirect(site_url().'auth/login');
            }

            $token = $this->user_model->insertToken($userInfo->id);
            $qstring = $this->base64url_encode($token);
            $url = site_url() . 'auth/reset-password/token/' . $qstring;
            $link = '<a href="' . $url. '">' . $url . '</a>';

            $message = '';
            $message .= '<strong>A password reset has been requested for this email account</strong><br>';
            $message .= '<strong>Please click:</strong> ' . $link;
            echo $message;
            exit;
        }
    }

    public function reset_password()
    {
        $token = $this->base64url_decode($this->uri->segment(4));
        $cleanToken = $this->security->xss_clean($token);

        $user_info = $this->user_model->isTokenValid($cleanToken); //either false or array();

        if(!$user_info){
            $this->session->set_flashdata('flash_message', 'Token is invalid or expired');
            redirect(site_url().'auth/login');
        }
        $data = array(
            'first_name'=> $user_info->first_name,
            'email'=>$user_info->email,
            'token'=>$this->base64url_encode($token)
        );

        $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|matches[password]');

        if ($this->form_validation->run() == FALSE) {
            $this->template->load_public('auth/reset_password', 'Reset Password', $data);
        }else{

            $this->load->library('password');
            $post = $this->input->post(NULL, TRUE);
            $cleanPost = $this->security->xss_clean($post);
            $hashed = $this->password->create_hash($cleanPost['password']);
            $cleanPost['password'] = $hashed;
            $cleanPost['user_id'] = $user_info->id;
            unset($cleanPost['passconf']);
            if(!$this->user_model->updatePassword($cleanPost)){
                $this->session->set_flashdata('flash_message', 'There was a problem updating your password');
            }else{
                $this->session->set_flashdata('flash_message', 'Your password has been updated. You may now login');
                $this->user_model->removeToken($cleanToken);
            }
            redirect(site_url().'auth/login');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect(site_url());
    }

    public function base64url_encode($data)
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    public function base64url_decode($data)
    {
        return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
    }
}