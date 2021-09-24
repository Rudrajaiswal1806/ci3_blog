<?php
class HomeModel extends CI_Model{

	public function all_blog($where)
	{
		return $this->db->select('b.id,b.title,b.content,b.image,b.created_date,c.title as category')
							->from('blog_content as b')
							->join('blog_category as c','c.id = b.cate_id','INNER')
							->WHERE($where)->get()
							->result();
	}
	public function blog_details($where)
	{
		return $this->db->select('b.id,b.title,b.content,b.image,b.created_date,c.title as category')
							->from('blog_content as b')
							->join('blog_category as c','c.id = b.cate_id','INNER')
							->WHERE($where)->get()
							->row();
	}
	public function save_like($post)
	{
		return $this->db->insert('blog_like',$post);
	}
	public function already_liked($where)
	{
		return $this->db->where($where)->get('blog_like')->num_rows();
	}
	public function save_comment($post)
	{
		return $this->db->insert('blog_comment',$post);
	}
	public function already_comment($where)
	{
		return $this->db->where($where)->get('blog_comment')->num_rows();
	}
	public function total_like($id)
	{
		return $this->db->query("select count(*) as total from blog_like where blog_id = ''".$id."'")->row()->total;
	}
	public function total_comments($id)
	{
				return $this->db->query("select count(*) as total from blog_comment where blog_id = ''".$id."'")->row()->total;

	}
	public function all_comment($id,$user_id)
	{
		return $this->db->query("select u.user_id, b.comment from blog_comment as b inner join user as u on u.user_id = b.user_id and b.user_id != '".$user_id."' and b.blog_id = '".$id."'")->result();
	}
	public function my_comment($id,$user_id)
	{
			return $this->db->query("select u.user_id, b.comment from blog_comment as b inner join user as u on u.user_id = b.user_id and b.user_id = '".$user_id."' and b.id = '".$id."'")->row();
	
	}
	public function update_comment($where,$data)
	{
		return $this->db->where($where)->update('blog_comment',$data);
	}
	public function remove_like($where)
	{
		return $this->db->where($where)->delete('blog_like');
	}
	public function delete_comment($where)
	{
		return $this->db->where($where)->delete('blog_comment');
	}
}


?>