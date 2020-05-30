<?php
class Search_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_search()
    {
        $choice = $this->input->post('choice');
        $search = $this->input->post('search');

        $this->db->select('users.name as user_name, users.photo as user_photo,posts.id as post_id ,posts.title as post_title,
        posts.created_at as post_date, posts.content as post_content, posts.url as post_url, posts.image_url as image');
        $this->db->from('users');
        $this->db->order_by('post_id', 'DESC');
        $this->db->join('posts', 'posts.user_id = users.id');
        $this->db->where($choice, $search);
        $query = $this->db->get();
        return $query->result_array();
    }
}
