<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_users extends CI_Model {

    public function can_log() {
        $this->db->where('vUserName', $this->input->post('vUserName'));
        $this->db->where('pPassword', hash('sha256', $this->input->post('pPassword')));
        $this->db->where('cEnable', 'Y');
        $query = $this->db->get('tbl_user');
        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function get_user_id() {
        $this->db->select('tbl_user.id,tbl_user.vUserName,tbl_user.iUserType,tbl_user.vFirstName,tbl_user.vLastName,tbl_user_type.vAccTypeName');
        $this->db->from('tbl_user');
        $this->db->join('tbl_user_type', 'tbl_user.iUserType = tbl_user_type.id');
        $this->db->where('tbl_user.vUserName', $this->input->post('vUserName'));
        $this->db->where('tbl_user.pPassword', hash('sha256', $this->input->post('pPassword')));
        $this->db->where('tbl_user.cEnable', 'Y');
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->row_array();
        } else {
            return array();
        }
    }
  

    public function add_user() {
        $data = array(
            'vUserName' => $this->input->post('uName'),
            'pPassword' => hash('sha256', $this->input->post('password'))
        );

        $query = $this->db->insert('user', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

}

?>
