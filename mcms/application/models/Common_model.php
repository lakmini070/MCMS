<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Common_model extends CI_Model {

    public function add_log($tDes, $title = '') {
       
        if (empty($title))
            $title = get_title();

        $logData = array(
            'vPage' => $title,
            'iUserId' => $this->session->userdata('oba_userbackendsession'),
            'tDes' => $tDes,
	       'cEnable' => 'Y',
            'dDateTime' => date('Y-m-d H:i:s')
        );
        $this->db->insert('tbl_logs', $logData);
         //echo $this->db->last_query();        exit();
    }

    public function save_data($tbl_name) {
        $fields = $this->db->list_fields($tbl_name);

        $data = array();
        foreach ($fields as $field) {
            $f_string = "";
            $f_string = $field[0];

            if ($field !== "id")
                $data[$field] = $this->input->post($field, TRUE);

            if ($f_string === 'p')
                $data[$field] = md5($this->input->post($field, TRUE));

            if ($f_string === 'f') {

                $filevalidate = $_FILES[$field]['name'];

                if ($filevalidate != '') {

                    $imagename = $this->doupload($field);

                    $img = $imagename['upload_data']['file_name'];


                    $data[$field] = $img;
                }
            }
        }

        $query = $this->db->insert($tbl_name, $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
	

	public function save_drug($tbl_name) {
        $fields = $this->db->list_fields($tbl_name);

        $data = array();
        foreach ($fields as $field) {
            $f_string = "";
            $f_string = $field[0];

            if ($field !== "id"){
                $data[$field] = $this->input->post($field, TRUE);
            }

            if ($f_string === 'p'){
                $data[$field] = md5($this->input->post($field, TRUE));
            }

            if ($f_string === 'f') {

                $filevalidate = $_FILES[$field]['name'];

                if ($filevalidate != '') {

                    $imagename = $this->doupload($field);

                    $img = $imagename['upload_data']['file_name'];


                    $data[$field] = $img;
                }
            }
        }

        $query = $this->db->insert($tbl_name, $data);
		//echo $this->db->last_query(); exit();
        if ($query) {
            return $this->db->insert_id();
        } else {
            return 'F';
        }
    }



		public function update_prescription($tbl_name) {
            $fields = $this->db->list_fields($tbl_name);

        $data = array();
        foreach ($fields as $field) {
            $f_string = "";
            $f_string = $field[0];


            if ($field === "id"){
                $id = $this->input->post($field, TRUE);
            }
            else if ($f_string === 'p'){
                $data[$field] = md5($this->input->post($field, TRUE));
            }
            else if ($f_string === 'f') {
//echo "dd"; exit();
                 $filevalidate = $_FILES[$field]['name']; 

                if ($filevalidate != '') {

                    $imagename = $this->doupload($field);

                    $img = $imagename['upload_data']['file_name'];

                    if ($img != "")
                        $data[$field] = $img;
                }
            }


            else if ($f_string === 't'){
                if($this->input->post($field)===""){
                    $data[$field] = NULL;
                }else{
                    $data[$field] = trim($this->input->post($field));
                }
            }
            else{
                if($this->input->post($field)===NULL || $this->input->post($field)===""){
                    $data[$field] = NULL;
                }else{
                    $data[$field] = trim($this->input->post($field));
                }
            }
        }
        $query = $this->db->update($tbl_name, $data, "id = $id");
       //echo $query; exit();
        if ($query) {
            return "done";
        } else {
            return 'F';
        }
    }

	public function update_drug($tbl_name) {
        $fields = $this->db->list_fields($tbl_name);

        $data = array();
        foreach ($fields as $field) {
            $f_string = "";
            $f_string = $field[0];


            if ($field === "id")
                $id = $this->input->post($field, TRUE);
            else if ($f_string === 'p')
                $data[$field] = md5($this->input->post($field, TRUE));
            else if ($f_string === 't'){
                if($this->input->post($field)===""){
                    $data[$field] = NULL;
                }else{
                    $data[$field] = trim($this->input->post($field));
                }
            }
            else{
                if($this->input->post($field)===NULL || $this->input->post($field)===""){
                    $data[$field] = NULL;
                }else{
                    $data[$field] = trim($this->input->post($field));
                }
            }
        }
        $query = $this->db->update($tbl_name, $data, "id = $id");
       //echo $query; exit();
        if ($query) {
            return "done";
        } else {
            return 'F';
        }
    }



    public function update_password_data() {

        $uUserID = $this->session->userdata('oba_userbackendsession');

        $this->db->select('pPassword');
        $this->db->where('id', $uUserID);
        $query = $this->db->get('tbl_user');
        $row = $query->row();
        $currentPW = $row->pPassword;


        $newpw = hash('sha256', $this->input->post('pPassword', TRUE));//md5($this->input->post('pPassword', TRUE));
        $currentPW2 = hash('sha256', $this->input->post('pPasswordold', TRUE));//md5($this->input->post('pPasswordold', TRUE));

        if ($currentPW == $currentPW2) {
            $data = array();
            $data['pPassword'] = $newpw;

            $query = $this->db->update('tbl_user', $data, "id = $uUserID");
            if ($query) {
                return 'SS'; //save success
            } else {
                return 'FA';
            }
        } else {
            return 'NM';  //not match
        }
    }

     public function save_profile_pic() {

        $fProfilePic = $this->input->post('fProfilePic', TRUE);
        $uploadpath = $this->input->post('uploadpath', TRUE);
        $uUserID = $this->session->userdata('oba_userbackendsession');

        $dte=date("ymdHms");

        $insArrCusE=array();
        $field_name="fProfilePic";

        //if($_FILES[$field_name]['name']!='') {
            $fileSaveName=$dte.$_FILES['fProfilePic']['name'];
            $uppth2=$uploadpath."/".$fileSaveName;	
            copy ($_FILES['fProfilePic']['tmp_name'], $uppth2);

            //exit();

            $insArrCusE[$field_name]=$fileSaveName;
        //}
        
        $this->db->trans_start();
        $this->db->where('id', $uUserID);
        $this->db->update('tbl_user', $insArrCusE);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return 0;
        } else {
            return 1;
        }
    }

    function get_edit_data($userID, $tbl_name) {
        $result = $this->db->get_where($tbl_name, array('id' => $userID));
        //echo $this->db->last_query(); exit();
        if ($result->num_rows() > 0) {
            return $result->row_array();
        }
        return array();
    }




    function chge_status($userID, $tbl_name) {
        $this->db->select('cEnable');
        $this->db->where('id', $userID);
        $query = $this->db->get($tbl_name);

        if ($query->num_rows() > 0) {
            $row = $query->row();
            $status = $row->cEnable;
        }

        if ($status === 'Y')
            $status = 'N';
        else
            $status = 'Y';

        $arrData = array(
            'cEnable' => $status
        );

        $this->db->update($tbl_name, $arrData, "id = $userID");
    }

    function del_records($userID, $tbl_name) {
        $this->db->where('id', $userID);
        $this->db->delete($tbl_name);
    }


    // populate drop down for many table
    public function populate_drop_down($query) {
        $query = $this->db->query($query);
        return $query->result();
    }

    // populate drop down for one table
    public function populate_drop_down_one($table, $field, $oderby) {
        $this->db->select($field);
        $this->db->group_by($field);
        $this->db->where('cEnable', 'Y');
        $this->db->order_by($oderby);
        $query = $this->db->get($table);
         //echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

	public function populate_drop_down_group_by($table, $field,$groupby,$oderby) {
        $this->db->select($field);
        $this->db->group_by($groupby);
        $this->db->where('cEnable', 'Y');
        $this->db->order_by($oderby);
        $query = $this->db->get($table);
         //echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }



    public function doupload($field) {

        $curentpath = FCPATH;

        $uploadpath = $this->input->post("uploadpath", TRUE);

        $filename = $_FILES[$field]['name'];

        //  $path = str_replace("allianceadmin", $uploadpath, $curentpath);
        $path = $curentpath . $uploadpath;

        $field_name = $field;
        $config['upload_path'] = $path;
        $config['allowed_types'] = 'gif|jpg|png|pdf|doc|docs|mp3|wav|ogg|mp4';

        $config['max_size'] = '99999999900000000';


        $config['file_name'] = time() . $filename;


        if (!is_dir($config['upload_path']))
            die("THE UPLOAD DIRECTORY DOES NOT EXIST");
        //echo 'dd';
        //print_r($config);
        $this->load->library('upload', $config);

        $this->upload->initialize($config);
        $uploadfile = $this->upload->do_upload($field_name);

        $field_name;

        if (!$uploadfile) {

            echo 'error';
        } else {

            return array('upload_data' => $this->upload->data());
        }
    }


     public function view_profile()
        {
            $userid=$this->session->userdata('oba_userbackendsession');
            $this->db->select('tbl_user.id,
tbl_user.vTitle,
tbl_user.vUserName,
tbl_user.vFirstName,
tbl_user.vLastName,
tbl_user.dRegDate,
tbl_user.vEmail,
tbl_user.vContactNo,
tbl_user.tAddress,
tbl_user.dLastUpDate,
tbl_user.fProfilePic,
tbl_user_type.vAccTypeName');
            $this->db->from('tbl_user');
            $this->db->join('tbl_user_type','tbl_user_type.id = tbl_user.iUserType');
            $this->db->where('tbl_user.id', $userid);
            $result = $this->db->get();

            if ($result->num_rows() > 0) {
            return $result->result_array();
            }

            return array();
        }


}

?>
