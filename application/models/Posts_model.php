<?php
class Posts_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function create_post()
    {
        $url = $this->input->post('url');
        $target = urlencode($url);
        $key = "8f9f867a82e13139b24bf9c7d9cb9387";
        $ret = file_get_contents("https://api.linkpreview.net?key={$key}&q={$target}");
        $result = json_decode($ret);
        $image = $result->image;

        $data = array(
            'title' => $this->input->post('title'),
            'content' => $this->input->post('content'),
            'url' => $url,
            'image_url' => $image,
            'user_id' => $this->session->userdata('id')
        );
        return $this->db->insert('posts', $data);
    }

    public function get_posts()
    {
        $this->db->select('users.name as user_name, users.photo as user_photo, posts.id as post_id, posts.title as post_title,
        posts.created_at as post_date, posts.content as post_content, posts.url as post_url, posts.image_url as image, GROUP_CONCAT(tags.name) as tags');
        $this->db->from('users');
        $this->db->join('posts', 'posts.user_id = users.id');
        $this->db->join('posts_tags','posts_tags.post_id = posts.id');
        $this->db->join('tags','tags.id = posts_tags.tag_id');
        $this->db->order_by('post_id', 'DESC');
        $this->db->group_by('post_id');
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
        $this->db->where("post_id", $id);
        $this->db->delete("posts_tags");
        $this->db->where("id", $id);
        return $this->db->delete("posts");
    }

    public function private_post($id)
    {
        $data = array(
            'private' => 1
        );
        $this->db->where('id', $id);
        return $this->db->update('posts', $data);
    }

    public function report_post($id)
    {
        $this->db->set('complaints', 'complaints+1', FALSE);
        $this->db->where('id', $id);
        return $this->db->update('posts');
    }

    public function like_post($id)
    {
        $this->db->set('rating', 'rating+1', FALSE);
        $this->db->where('id', $id);
        return $this->db->update('posts');
    }
}

// Posts com as tags
// public function show_posts()
//     {
//         $this->db->select('users.name as user_name, users.photo as user_photo,posts.id as post_id ,posts.title as post_title,
//         posts.created_at as post_date, posts.content as post_content, posts.url as post_url, tags.name as post_tags');
//         $this->db->from('users');
//         $this->db->join('posts', 'posts.user_id = users.id');
//         $this->db->join('posts_tags', 'posts_tags.post_id = posts.id');
//         $this->db->join('tags', 'tags.id = posts_tags.id');
//         $query = $this->db->get();
//         return $query->result_array();
//     }
