<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('HomeModel','home');
	}
	public function index()
	{
		$data['title']="Home | Techblog";
		$data['record']=$this->home->all_blog(array('b.approve'=>1));
		$this->render('home/home',$data);
	}
	public function blog_details($id=false)
	{
		if($this->input->post('bid') && $this->session->userdata('USERSESSION')['userid'])
		{
			$return = array();
			$user_id = $this->session->userdata('USERSESSION')['userid'];
			$blog_id = $this->input->post('bid');
			
			$delete = $this->home->delete_comment(array('blog_id'=>$blog_id,'user_id'=>$user_id));
			if($delete)
			{
				$return['d']=1;
				$return['msg']="deleted Successfully";
			}
			else{
				$return['d']=0;
				$return['msg']="Some Error Occourred";
			}
			echo json_encode($return);exit;
		}
		if(!empty($id))
		{
			$data['title']="blog Details | techblog";
			$data['record'] = $this->home->blog_details(array('b.id'=>$id));
			if($this->session->userdata('USERSESSION')['userid'])
			{
				$user_id = $this->session->userdata('USERSESSION')['userid'];
				$data['mycomment']=$this->home->my_comment($user_id,$id);
				$data['all']=$this->home->all_comment($user_id,$id);
				
			}
			$this->render('home/blog-details',$data);

		}
		else{
			redirect(base_url());
		}
	}

	public function like_blog()
	{
		$return = array();
		if($this->session->userdata('USERSESSION'))
		{
			$id = $this->input->post('id');
			$user_id = $this->session->userdata('USERSESSION')['userid'];
			$check = $this->home->already_liked(array('blog_id'=>$id,'user_id'=>$user_id));
			if($check < 1 )
			{
					$insert = $this->home->save_like(array('blog_id'=>$id,'user_id'=>$user_id));
		
				if($insert)
			{
				$return['save']=1;
				$return['msg']="Added in Like list";
			}
			else{
				$return['save']=0;
				$return['msg']="Some Error Occourred";
			}

			}
			else
			{
			$this->home->remove_like(array('blog_id'=>$id,'user_id'=>$user_id));
			$return['save']=0;
			$return['msg']="Removed From Like List !";
			}
		}
		else{
			$return['save']=0;
			$return['msg']="Please Login to Like this Blog";
		}
		echo json_encode($return);exit;
	}

	public function save_comment()
	{
		$return = array();
		if($this->session->userdata('USERSESSION'))
		{
			$id = $this->input->post('id');
			$comment = htmlentities($this->input->post('comment'));
			$user_id = $this->session->userdata('USERSESSION')['userid'];
			$check = $this->home->already_comment(array('blog_id'=>$id,'user_id'=>$user_id));
			if($check < 1 )
			{
					$insert = $this->home->save_comment(array('blog_id'=>$id,'user_id'=>$user_id,'comment'=>$comment));
		
				if($insert)
			{
				$return['save']=1;
				$return['msg']="Comment Saved Successfully0";
			}
			else{
				$return['save']=0;
				$return['msg']="Some Error Occourred";
			}

			}
			else
			{
			$return['save']=0;
			$return['msg']="Alrady Comment";
			}
		}
		else{
			$return['save']=0;
			$return['msg']="Please Login to comment this Blog";
		}
		echo json_encode($return);exit;
	}
	public function update_comment()
	{
		$return = array();
		if($this->session->userdata('USERSESSION'))
		{
			$id = $this->input->post('id');

			$comment = htmlentities($this->input->post('comment'));
			$user_id = $this->session->userdata('USERSESSION')['userid'];
			$update = $this->home->update_comment(array('blog_id'=>$id,'user_id'=>$user_id),array('comment'=>$comment));
			if($update)
			{
				$return['save']=1;
				$return['msg']="Updated Successfully !";
			}
			else{
				$return['save']=0;
				$return['msg']="Some Error Occourred !";
			}
		}
		else{
			$return['save']=0;
			$return['msg']="Please Login to comment this Blog";
		}
		echo json_encode($return);exit;
	}

}
