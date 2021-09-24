<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->session->userdata('USERSESSION') ? redirect(base_url('user-profile')):true;
		$this->load->library('form_validation');
		$this->load->model('UserModel','user');
	}
	public function login()
	{

		$data['title']="Login | Techblog";
		if($this->input->post('email') && $this->input->post('password'))
		{
			$user_id = trim($this->input->post('email'));
			$user_info = $this->user->check_user($user_id);
			$password = trim($this->input->post('password'));
			if($user_info)
			{
				if(password_verify($password, $user_info->password))
				{
					$this->setUserSession($user_info);
					redirect(base_url('user-profile'));
				}
			}
			else{
				$this->session->set_flashdata('error','Email Or Password Not Match');
				redirect(base_url('login'));
			}
		}

		$this->render('home/user/login',$data);
	}
	public function register()
	{

		$data['title']="Register | Techblog";
		if($this->input->post('check_email'))
		{
			$return = array();
			$email = trim($this->input->post('check_email'));
			$chk = $this->user->check_email($email);
			if($chk)
			{
				$return['avl']=0;
				$return['msg']=$email." Email Already Exist";
			}
			else{
				$return['avl']=1;	
			}
			echo json_encode($return);exit;
		}
		if($this->input->post('save'))
		{
			$post_data = $this->input->post();
			$post_data = array_map('trim',$post_data);
			 $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[user.user_id]');
             $this->form_validation->set_rules('password', 'Password', 'required');
             $this->form_validation->set_rules('cpassword', 'Password Confirmation', 'required|matches[password]');
             if($this->form_validation->run() == FALSE)
             {
             	$this->session->set_flashdata('error','Some Error Occourred Try Again');
             	redirect(base_url('register'));
             }
			$insert_data['user_id']=$post_data['email'];
			$insert_data['password']=password_hash($post_data['password'], PASSWORD_DEFAULT);
			$save = $this->user->save_user($insert_data);
			if( $save )
			{
				$this->session->set_flashdata('success','your Registered Successfully! Login to Post Your Blog');
				redirect(base_url('login'));
			}
			else{
					$this->session->set_flashdata('error','Some Error Occureed Try Again');
				    redirect(base_url('register'));
				}
		}
		$this->render('home/user/register',$data);
	}


}
