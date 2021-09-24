<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	public function render($view,$data=false)
	{
		$this->load->view('home/common/header',$data);
		$this->load->view($view);
		$this->load->view('home/common/footer');
	}
	public function setUserSession($data)
	{
		if(!empty($data))
		{
			$sess = array('userid'=>$data->user_id);
			$this->session->set_userdata('USERSESSION',$sess);
		}
	}
	public function check_user()
	{
		if(!$this->session->userdata('USERSESSION'))
		{
			redirect(base_url('login'));
		}
	}
}
