<?php
class Posts_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function create_post()
    {
        $data = array(
            'title' => $this->input->post('title'),
            'content' => $this->input->post('content'),
            'url' => $this->input->post('url'),
            'user_id' => 1
        );
        return $this->db->insert('posts', $data);
    }

    public function show_posts()
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->join('posts', 'posts.user_id = users.id');
        $query = $this->db->get();
        return $query->result_array();
    }
}
