<?php
class Search_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function search_title($search)
    {
        $this->db->select('users.name as user_name, users.photo as user_photo, posts.id as post_id, posts.title as post_title,
        posts.created_at as post_date, posts.content as post_content, posts.url as post_url, posts.image_url as image, GROUP_CONCAT(tags.name) as tags');
        $this->db->from('users');
        $this->db->join('posts', 'posts.user_id = users.id');
        $this->db->join('posts_tags','posts_tags.post_id = posts.id');
        $this->db->join('tags','tags.id = posts_tags.tag_id');
        $this->db->order_by('post_id', 'DESC');
        $this->db->group_by('post_id');
        $this->db->like('posts.title', $search)->or_like('users.name', $search)->or_like('posts.content', $search)->or_like('tags.name', $search);
        $query = $this->db->get();
        return $query->result_array();
    }
}
