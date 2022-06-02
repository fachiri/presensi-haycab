<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_auth');
	}
    
	public function index()
	{
        if($this->session->userdata('in') == 'login')
        {
            redirect('dashboard');
        }else{
            $this->load->view('v_login');
        }
	}

	public function auth()
	{
		$username = $this->input->post('email');
		$password = $this->input->post('password');
		$role = $this->input->post('role');
		if($role == 1)
		{
			$this->M_auth->auth_operator($password,$username);
		}else{
			$this->M_auth->auth($password,$username);
		}
	}

	public function log_out()
	{
		$this->session->sess_destroy();
		return redirect('/');
	}
}
