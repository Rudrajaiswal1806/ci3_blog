<?php
class UserModel extends CI_Model{

	public function save_user($post_data)
	{
		return $this->db->insert('user',$post_data);
	}
	public function check_user($email)
	{
		return $this->db->where('user_id',$email)->get('user')->row();
	}
	public function getBlogCategory()
	{
		return $this->db->select('id,title')->from('blog_category')->get()->result();
	}
	public function save_blog($post_data)
	{
		return $this->db->insert('blog_content',$post_data);
	}
	public function check_email($email)
	{
		return $this->db->where('user_id',$email)->get('user')->num_rows();
	}
}

?>