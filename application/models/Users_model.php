<?php
class Users_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function user_verification()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $this->db->where('email', $email);
        $result = $this->db->get('users');

        if ($result->num_rows() == 1) {
            $user_data = $result->result_array();
            $password_hash = $user_data[0]['password'];
            if (password_verify($password, $password_hash)) {
                return $user_data;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function register()
    {
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $password_hashed = password_hash($password, PASSWORD_DEFAULT);
        $image_name = $name;

        $config['upload_path'] = './images/user_photo';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 1000000;
        $config['max_width'] = 2000;
        $config['max_height'] = 2000;
        $config['file_name'] = $image_name;

        $this->load->library('upload', $config);

        $this->upload->do_upload('photo');

        $data = array(
            'name' => $name,
            'email' => $email,
            'photo' => $this->input->post('name'),
            'password' => $password_hashed,
            'isAdmin' => 0
        );

        return $this->db->insert('users', $data);
    }
}
