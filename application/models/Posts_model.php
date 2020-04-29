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
            'user_id' => $this->session->user_data('id')
        );
        return $this->db->insert('posts', $data);
    }

    public function show_posts()
    {
        $this->db->select('users.name as user_name, users.photo as user_photo,posts.id as post_id ,posts.title as post_title,
        posts.created_at as post_date, posts.content as post_content, posts.url as post_url, tags.name as post_tags');
        $this->db->from('users');
        $this->db->join('posts', 'posts.user_id = users.id');
        $this->db->join('posts_tags', 'posts_tags.post_id = posts.id');
        $this->db->join('tags', 'tags.id = posts_tags.id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_post($id)
    {
        $this->db->select('*');
        $this->db->from('posts');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function update_post()
    {
        $data = array(
            'title' => $this->input->post('title'),
            'content' => $this->input->post('content'),
            'url' => $this->input->post('url')
        );
        $this->db->where('id', $this->input->post('id'));
        return $this->db->update('posts', $data);
    }

    public function delete_post($id)
    {
        $this->db->from("posts_tags");
        $this->db->join("posts", "posts.id = posts_tags.post_id");
        $this->db->where("post_id", $id);
        $this->db->delete("posts");
    }
}
