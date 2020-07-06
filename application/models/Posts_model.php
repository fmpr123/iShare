<?php
class Posts_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function create_post()
    {
        //Create post
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
        $this->db->insert('posts', $data);

        //Create tags
        $post_id = $this->Posts_model->get_latest_post();
        $string = $this->input->post('tags');
        $array = explode(" ", $string);
        $array_size = count($array);

        for ($i = 0; $i < $array_size - 1; $i++) {
            $tag = $this->Posts_model->get_tag_id($array[$i]);
            $data = array(
                'post_id' => $post_id,
                'tag_id' => $tag
            );
            $this->db->insert('posts_tags', $data);
        }
        $this->Posts_model->like_post($post_id);
        return "Done";
    }

    public function get_posts()
    {
        $this->db->select('users.id as user_id, users.name as user_name, users.photo as user_photo, posts.id as post_id, posts.title as post_title,
        posts.created_at as post_date, posts.content as post_content, posts.url as post_url, posts.image_url as image,
        posts.rating as rating, posts.complaints as complaints, posts.private as private, posts.bloqued as bloqued, GROUP_CONCAT(tags.name) as tags');
        $this->db->from('users');
        $this->db->join('posts', 'posts.user_id = users.id');
        $this->db->join('posts_tags', 'posts_tags.post_id = posts.id');
        $this->db->join('tags', 'tags.id = posts_tags.tag_id');
        $this->db->order_by('post_id', 'DESC');
        $this->db->group_by('post_id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_post($id)
    {
        $this->db->select('users.id as user_id, users.name as user_name, users.photo as user_photo, posts.id as post_id, posts.title as post_title,
        posts.created_at as post_date, posts.content as post_content, posts.url as post_url, posts.image_url as image,
        posts.rating as rating, posts.complaints as complaints, posts.private as private, posts.bloqued as bloqued, GROUP_CONCAT(tags.name) as tags');
        $this->db->from('users');
        $this->db->where('posts.id', $id);
        $this->db->join('posts', 'posts.user_id = users.id');
        $this->db->join('posts_tags', 'posts_tags.post_id = posts.id');
        $this->db->join('tags', 'tags.id = posts_tags.tag_id');
        $this->db->order_by('post_id', 'DESC');
        $this->db->group_by('post_id');
        $query = $this->db->get();
        return $query->row_array();
    }

    public function update_post()
    {
        //Update post
        $post_id = $this->input->post('id');
        $data = array(
            'title' => $this->input->post('title'),
            'content' => $this->input->post('content'),
            'url' => $this->input->post('url')
        );
        $this->db->where('id', $post_id);
        $this->db->update('posts', $data);

        //Update tags
        //First delete tags of post being edited
        $this->db->where("post_id", $post_id);
        $this->db->delete("posts_tags");
        //Then insert new tags
        $string = $this->input->post('tags');
        $array = explode(" ", $string);
        $array_size = count($array);

        for ($i = 0; $i < $array_size - 1; $i++) {
            $tag = $this->Posts_model->get_tag_id($array[$i]);
            $data = array(
                'post_id' => $post_id,
                'tag_id' => $tag
            );
            $this->db->insert('posts_tags', $data);
        }
        return "Done";
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
        $result = $this->Posts_model->check_like($id);
        if (empty($result)) {
            $this->db->set('rating', 'rating+1', FALSE);
            $this->db->where('id', $id);
            $this->db->update('posts');

            $data = array(
                'post_id' => $id,
                'user_id' => $this->session->userdata('id')
            );
            return $this->db->insert('posts_rating', $data);
        } else {
            $this->db->set('rating', 'rating-1', FALSE);
            $this->db->where('id', $id);
            $this->db->update('posts');

            $this->db->where("post_id", $id);
            $this->db->where("user_id", $this->session->userdata('id'));
            return $this->db->delete("posts_rating");
        }
    }

    public function get_tags()
    {
        $this->db->select('id, name');
        $this->db->from('tags');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_latest_post()
    {
        $this->db->select_max('id');
        $this->db->from('posts');
        return $this->db->get()->row()->id;
    }

    public function get_tag_id($tag)
    {
        $this->db->select('id');
        $this->db->from('tags');
        $this->db->where("name", $tag);
        return $this->db->get()->row()->id;
    }

    public function check_like($id)
    {
        $this->db->select('id');
        $this->db->from('posts_rating');
        $this->db->where("post_id", $id);
        $this->db->where("user_id", $this->session->userdata('id'));
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_ratings()
    {
        $this->db->select('*');
        $this->db->from('posts_rating');
        $query = $this->db->get();
        return $query->result_array();
    }
}
