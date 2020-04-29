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
        $photo = $this->input->post('photo');
        $password = $this->input->post('password');

        $password_hashed = password_hash($password, PASSWORD_DEFAULT);

        $data = array(
            'name' => $name,
            'email' => $email,
            'photo' => $photo,
            'password' => $password_hashed
        );

        return $this->db->insert('users', $data);
    }
}
