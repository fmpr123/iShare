<?php
class Search_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function search_title($search, $choice)
    {
        $filter = "";
        if ($choice == "recent") {
            $filter == "post_date";
            $choice == "ASC";
        } else if ($choice == "old") {
            $filter == "post_date";
            $choice == "DESC";
        }

        $this->db->select('users.name as user_name, users.photo as user_photo,posts.id as post_id ,posts.title as post_title,
        posts.created_at as post_date, posts.content as post_content, posts.url as post_url, posts.image_url as image');
        $this->db->from('users');
        $this->db->order_by($filter, $choice);
        $this->db->join('posts', 'posts.user_id = users.id');
        $this->db->like('title', $search);
        $query = $this->db->get();
        return $query->result_array();
    }
}
