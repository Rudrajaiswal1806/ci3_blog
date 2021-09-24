<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserProfile extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		 $this->load->library('form_validation');
		$this->load->model('UserModel','user');
		$this->check_user();
	}

	public function index()
	{
		$data['title']="profile | Techblog";
		$this->render('home/user/profile',$data);
	}
	public function add_blog()
	{
		$data['title']="Add Blog | Techblog";
		$data['category']=$this->user->getBlogCategory();
		if(isset($_FILES['image']) )
		{
				$new_name = time().'.'.pathinfo($_FILES["image"]['name'])['extension'];
			   $config['upload_path']          = 'blog-img/';
                $config['allowed_types']        = 'gif|jpg|png';
              	$config['max_size']='5028';
              	$config['file_name']=$new_name;
                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('image'))
                {
                        $error = array('error' => $this->upload->display_errors());
                }
                else{
                	$post_data['image']=$new_name;
                }
		}
		if($this->input->post('save') )
		{
			
			   $this->form_validation->set_rules('cate_id', 'Blog Category', 'required');
               $this->form_validation->set_rules('content', 'Blog Content', 'required');
               $this->form_validation->set_rules('title', 'Title', 'required');
        		 if ($this->form_validation->run() == FALSE)
                {
                	
                        redirect(base_url('add-blog'));
                }
                else
                {
                	$post_data['user_id']=$_SESSION['USERSESSION']['userid'];
                	$post_data['title']=$this->input->post('title');
                	$post_data['cate_id']=$this->input->post('cate_id');
                	$post_data['content']=$this->input->post('content');
               		$save = $this->user->save_blog($post_data);
               		if($save)
               		{
               			$this->session->set_flashdata('success','blog Saved successfully');
               			
               		}
               		else{
               				$this->session->set_flashdata('error','Some Error Occurred !');
               		
               		}         
                } 
                redirect(base_url('add-blog'));
        }
		$this->render('home/user/add-blog',$data);
	}
	public function logout()
	{
		unset($_SESSION['USERSESSION']);
		redirect(base_url('login'));
	}
}
