<?php
class Posts_model extends CI_Model{
    public function __construct(){
        $this->load->database();
    }

    public function create_post(){
        $data = array(
            'title' => $this->input->post('title'),
            'content' => $this->input->post('content'),
            'url' => $this->input->post('url'),
            'user_id' => 1
        );
        return $this->db->insert('posts',$data);
    }
}