<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_model extends CI_Model {


public function get_edit_data($recID, $table_name) {

        $this->db->from($table_name);
        $this->db->where('id', $recID);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return array();
    }


public function get_all_data($table){

        $this->db->select('*');
        $this->db->from($table);

        $result = $this->db->get();

        if ($this->db->affected_rows() > 0) {
            return $result->result();
        }
        return array();
    } 


public function get_all_patient_details() {

        $this->db->select('*');
        $this->db->from('tbl_patient_details');
        $this->db->order_by("tbl_patient_details.id", "ASC");
        $result = $this->db->get();

        if ($result->num_rows() > 0) {
            return $result->result();
        }
        return array();
    }




 public function save_invoice($save_status, $recID) {

        $data = array(
                'dPrescriptionDate' => $this->input->post('dPrescriptionDate', TRUE),
            'iPres_id' => $this->input->post('iPres_id', TRUE),
                'iDoctorId' => $this->input->post('iDoctorId', TRUE),
				'iPatientId' => $this->input->post('iPatientId', TRUE),
                'tDescription' => $this->input->post('tDescription', TRUE),
                'fDoctorCharge' => $this->input->post('dcharge', TRUE),
                'dSaveDate' => date('Y-m-d'),
                'iUserID' => $this->session->userdata('oba_userbackendsession'),
				'cEnable'=>'Y'
            );


		$this->db->trans_start();
        if ($save_status != 'E') {
            //print_r($data);
			$this->db->insert('tbl_invoice_header', $data);
			//echo $this->db->last_query();  exit();
            $insert_id_H = $this->db->insert_id(); 


			$iDrugID=$this->input->post('iDrugID', TRUE);
			$iQty=$this->input->post('iQty', TRUE);
			$dPrice=$this->input->post('dPrice', TRUE);
			for ($x = 0; $x < count($iDrugID); $x++) { 

		$Drugandprice=$iDrugID[$x];
		$Drugandprice_array=explode("_",$Drugandprice);
		$drugID=$Drugandprice_array[0];
		$qtyprice=$Drugandprice_array[1];
		$price=$qtyprice*$iQty[$x];
			 $data2 = array(
                'iInvoiceId' => $insert_id_H,
                'iDrugId' => $drugID,
				'iQuantity' => $iQty[$x],
                'fUnitPrice' => $qtyprice,
                'fPrice' => $price,
				'cEnable'=>'Y'
            );

			$updatesql="update tbl_drug set iQuantity=iQuantity-$iQty[$x] where id='$drugID'";
			$query = $this->db->query($updatesql);

        $this->db->from('tbl_drug');
		$this->db->where('tbl_drug.id', $drugID);
		$result = $this->db->get();

            $data=$result->result();
			$av_qty= $data[0]->iQuantity;
			$min_qty= $data[0]->iMinQty;
			$vDrugName= $data[0]->vDrugName;

			if($min_qty>=$av_qty){


$to       = 'lakminitest@gmail.com';
$subject  = 'Appoinment Confirmed';
$message  = "Hi,<br>
Reach the reorder level of ".$vDrugName."<br>
Available Quantity:".$av_qty."<br>
Minimum Order Quantity:".$min_qty."";


$headers  = 'From: lakminitest@gmail.com' . "\r\n" .
            'MIME-Version: 1.0' . "\r\n" .
            'Content-type: text/html; charset=utf-8';

			mail($to, $subject, $message, $headers);

			}
			//echo $this->db->last_query();  exit();

			$this->db->insert('tbl_invoice_detail', $data2);
            $insert_id = $this->db->insert_id(); 
			//echo $this->db->last_query();  exit();
			}

         }  else {


            $this->db->where('id', $recID);
            $this->db->update('tbl_invoice_header', $data);

			$this->db->where('iInvoiceId', $recID);
			$this->db->delete('tbl_invoice_detail');

			$iDrugID=$this->input->post('iDrugID', TRUE);
			$iQty=$this->input->post('iQty', TRUE);
			$dPrice=$this->input->post('dPrice', TRUE);
			for ($x = 0; $x < count($iDrugID); $x++) { 

		$Drugandprice=$iDrugID[$x];
		$Drugandprice_array=explode("_",$Drugandprice);
		$drugID=$Drugandprice_array[0];
		$qtyprice=$Drugandprice_array[1];
		$price=$qtyprice*$iQty[$x];
			 $data2 = array(
                'iInvoiceId' => $recID,
                'iDrugId' => $drugID,
				'iQuantity' => $iQty[$x],
                'fUnitPrice' => $qtyprice,
                'fPrice' => $price,
				'cEnable'=>'Y'
            );

			$updatesql="update tbl_drug set iQuantity=iQuantity-$iQty[$x] where id='$drugID'";
			$query = $this->db->query($updatesql);

			$this->db->insert('tbl_invoice_detail', $data2);
            $insert_id = $this->db->insert_id(); 

		} 

		 }

        $this->db->trans_complete();
	   //return 1;
       //print_r($this->db->last_query());      exit();
        if ($this->db->trans_status() === FALSE) {
            return 'F';
        } else {
            return 1;
        }
    }
// ends here 


public function save_patient_details($save_status, $recID,$table) {

        $data = array(
                'Title' => $this->input->post('Title', TRUE),
                'First_Name' => $this->input->post('First_Name', TRUE),
'Last_Name' => $this->input->post('Last_Name', TRUE),
                'DOB' => $this->input->post('DOB', TRUE),
                'Status' => $this->input->post('Status', TRUE),
                'Address' => $this->input->post('Address', TRUE),
                'NIC' => $this->input->post('NIC', TRUE)
            );

        $this->db->trans_start();

        if ($save_status === 'A') {

            $this->db->insert($table, $data);
            $insert_id = $this->db->insert_id(); 

         }  else {


            $this->db->where('id', $recID);
            $this->db->update($table, $data);

} 
        $this->db->trans_complete();
       //print_r($this->db->last_query());      exit();
        if ($this->db->trans_status() === FALSE) {
            return 'F';
        } else {
            return 1;
        }
    }
// ends here

    public function get_user() {

        $this->db->select('tbl_user.id,tbl_user.vFirstName,tbl_user.vUserName,tbl_user.vLastName,tbl_user.cEnable,tbl_user.vContactNo,tbl_user.vEmail,tbl_user.iUserType,tbl_user_type.vAccTypeName');
        $this->db->from('tbl_user');
        $this->db->join('tbl_user_type', 'tbl_user.iUserType = tbl_user_type.id');

        $iUserType = $this->session->userdata('oba_iUserTypeBackendsession');   //Current loged user, usertype 
        if ($iUserType != 1) {
            $this->db->where('tbl_user.iUserType !=', 1);  // load not admins
        }

        $this->db->order_by("tbl_user.id", "DESC");
        $result = $this->db->get();

        if ($result->num_rows() > 0) {
            return $result->result();
        }
        return array();

    }

        public function get_patient() {

        $this->db->select('tbl_user.id,tbl_user.vFirstName,tbl_user.vUserName,tbl_user.vLastName,tbl_user.cEnable,tbl_user.vContactNo,tbl_user.vEmail,tbl_user.iUserType,tbl_user_type.vAccTypeName');
        $this->db->from('tbl_user');
        $this->db->join('tbl_user_type', 'tbl_user.iUserType = tbl_user_type.id');

                    $this->db->where('tbl_user.iUserType', 34);


        $this->db->order_by("tbl_user.id", "ASC");
        $result = $this->db->get();
//echo($this->db->last_query());      exit();
        if ($result->num_rows() > 0) {
            return $result->result();
        }
        return array();
    }


 public function get_availability() {

	   
    $this->db->select('tbl_doctor_schedule.*,tbl_user.vFirstName,tbl_user.vLastName');
    $this->db->from('tbl_doctor_schedule');
	$this->db->join('tbl_user', 'tbl_doctor_schedule.d_id = tbl_user.id');
    $this->db->where('tbl_doctor_schedule.d_id', 223);
    $this->db->order_by("tbl_doctor_schedule.dSheduleDate", "DESC");
    $result = $this->db->get();
		// echo $this->db->last_query();exit();
    if ($result->num_rows() > 0) {
        return $result->result();
    }else{
        return array();
	}
 }


		public function get_check_availability() {

		$date=date('Y-m-d');
  
	    $this->db->select('tbl_doctor_schedule.*,tbl_user.vFirstName,tbl_user.vLastName,tbl_doctor_schedule.vSheduleStartTime');
        $this->db->from('tbl_doctor_schedule');
		$this->db->join('tbl_user', 'tbl_doctor_schedule.d_id = tbl_user.id');
        $this->db->where('tbl_doctor_schedule.d_id', 223);
		$this->db->where('tbl_doctor_schedule.dSheduleDate >=', $date);
     	$this->db->order_by("tbl_doctor_schedule.dSheduleDate", "ASC");
        $result = $this->db->get();
		//echo $this->db->last_query();exit();
        if ($result->num_rows() > 0) {
            return $result->result();
        }else{
        return array();
		} 

    }
    public function check_username($username) {

        $this->db->select('vUserName');
        $this->db->where('vUserName', $username);
        $query = $this->db->get('tbl_user');
        $row = $query->row();

        if(isset($row)){
            return 'AV';
        }else{
            return 'NA';
        }
    }



    public function save_user($save_status, $recID) {

        $resetType = $this->input->post('resetType', TRUE);
        $vUserName = $this->input->post('vUserName', TRUE);

        $this->db->select('vUserName');
        $this->db->where('vUserName', $vUserName);  //already existing username
        $this->db->where('id !=', $recID);  //2nd time check
        $query = $this->db->get('tbl_user');
        $row = $query->row();
        if(isset($row)){
            return 'AV';
        }

        $data = array(
            'vTitle' => $this->input->post('vTitle', TRUE),
            'vUserName' => $this->input->post('vUserName', TRUE),
            'vFirstName' => $this->input->post('vFirstName', TRUE),
            'vLastName' => $this->input->post('vLastName', TRUE),
            'vEmail' => $this->input->post('vEmail', TRUE),
            'pPassword' => hash('sha256', $this->input->post('pPassword', TRUE)),
            'vContactNo' => $this->input->post('vContactNo', TRUE),
            'iUserType' => $this->input->post('iUserType', TRUE),
            'tAddress' => $this->input->post('tAddress', TRUE),
            'dRegDate' => date('Y-m-d H:i:s'),
            'dLastUpDate' => date('Y-m-d H:i:s'),
            'cEnable' => $this->input->post('cEnable', TRUE),

        );

        $data4 = array(
            'vFirstName' => $this->input->post('vFirstName', TRUE),
            'vLastName' => $this->input->post('vLastName', TRUE),
            'vTitle' => $this->input->post('vTitle', TRUE),
            'vEmail' => $this->input->post('vEmail', TRUE),
            'vContactNo' => $this->input->post('vContactNo', TRUE),
            'tAddress' => $this->input->post('tAddress', TRUE),
            'iUserType' => $this->input->post('iUserType', TRUE),
            'dLastUpDate' => date('Y-m-d H:i:s'),
            'tAddress' => $this->input->post('tAddress', TRUE),
            'cEnable' => $this->input->post('cEnable', TRUE),

        );
        $this->db->trans_start();
        if ($save_status === 'A') {

            $this->db->insert('tbl_user', $data);
            $insert_id = $this->db->insert_id();


            $tDes = "New user registered. Name: $vFirstName";
            $this->load->model('common_model');
            $this->common_model->add_log($tDes);



        } else {
            if ($resetType == 'Y') {
                $data4['pPassword'] =  hash('sha256', $this->input->post('pPassword', TRUE));
                $data4['vUserName'] = $this->input->post('vUserName', TRUE);
            } 

            $this->db->where('id', $recID);
            $this->db->update('tbl_user', $data4);

            $tDes = "User details updated. User Id: $recID ";
            $this->load->model('common_model');
            $this->common_model->add_log($tDes);
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return 'FA';
        } else {
            return 'TR';
        }
    }


	public function save_availability($save_status, $recID) {

        $data = array(
            'd_id' => $this->input->post('d_id', TRUE),
            'dSheduleDate' => $this->input->post('dSheduleDate', TRUE),
            'vSheduleStartTime' => $this->input->post('vSheduleStartTime', TRUE),
            'vSheduleEndTime' => $this->input->post('vSheduleEndTime', TRUE),
            'iPatient_count' => $this->input->post('iPatient_count', TRUE),
            'cEnable' => $this->input->post('cEnable', TRUE),
        );

        $this->db->trans_start();
        if ($save_status === 'A') {

            $this->db->insert('tbl_doctor_schedule', $data);
            $insert_id = $this->db->insert_id();
            //echo $this->db->last_query();exit();

            $tDes = "New Shedule added";
            $this->load->model('common_model');
            $this->common_model->add_log($tDes);

        } else {

            $this->db->where('id', $recID);
            $this->db->update('tbl_doctor_schedule', $data);
			//echo $this->db->last_query();exit();
			$insert_id = $recIDs;

            $tDes = "Shedule data updated ";
            $this->load->model('common_model');
            $this->common_model->add_log($tDes);
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return 'F';
        } else {
            return $insert_id;
        }
    }


	public function doupload($field) {

        $curentpath = FCPATH;

        $uploadpath = 'medical_reports';

        $filename = $_FILES[$field]['name'];


        $path = $curentpath . $uploadpath; 

        $field_name = $field;
        $config['upload_path'] = $path;
        $config['allowed_types'] = 'gif|jpg|png|pdf|doc|docs|mp3|wav|ogg|mp4';

        $config['max_size'] = '99999999900000000';


        $config['file_name'] = time() . $filename;


        if (!is_dir($config['upload_path']))
            die("aaaaaaTHE UPLOAD DIRECTORY DOES NOT EXIST");
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


	public function save_prescription($save_status, $recID) {
        $image_name = '';
        $field='fReport';
        $filevalidate = $_FILES[$field]['name'];

                if ($filevalidate != '') {

                    $imagename = $this->doupload('fReport');

                    $img = $imagename['upload_data']['file_name'];


                    $image_name = $img;
                }

				//echo $image_name; exit();
        $data = array(
            'iP_id' => $this->input->post('iP_id', TRUE),
            'd_id' => $this->input->post('d_id', TRUE),
            'iAppointmentNumber' => $this->input->post('iAppointmentNumber', TRUE),
            'dDate' => $this->input->post('dDate', TRUE),
            'iAge' => $this->input->post('iAge', TRUE),
            'tDescription' => $this->input->post('tDescription', TRUE),
             #'Shedule_Time' => $this->input->post('Shedule_Time', TRUE),
			'cEnable' => $this->input->post('cEnable', TRUE),
			'fReport' => $image_name,
        );



        $this->db->trans_start();
        if ($save_status === 'A') {

            $this->db->insert('tbl_prescription', $data);
            $insert_id = $this->db->insert_id();
            //echo $this->db->last_query();exit();

            $insert_id_H = $this->db->insert_id(); 


            $iDrugID=$this->input->post('iDrugID', TRUE);
            $iQty=$this->input->post('iQty', TRUE);
           
            $Dusage=$this->input->post('Dusage', TRUE);
            for ($x = 0; $x < count($iDrugID); $x++) { 

        $Drugandprice=$iDrugID[$x];
        $Drugandprice_array=explode("_",$Drugandprice);
        $drugID=$Drugandprice_array[0];
        
        
             $data2 = array(
                'iPrescriptionId' => $insert_id_H,
                'iDrugId' => $drugID,
                'iQuantity' => $iQty[$x],
                'Dusage' => $Dusage[$x],
                'cEnable'=>'Y'
            );


            //echo $this->db->last_query();  exit();


            $this->db->insert('tbl_prescription_detail', $data2);
            $insert_id = $this->db->insert_id(); 
            //echo $this->db->last_query();  exit();
                }
//echo "hi";
               // exit();
            $tDes = "New Prescription added";
            $this->load->model('common_model');
            $this->common_model->add_log($tDes);



        } else {


            $this->db->where('id', $recID);
            $this->db->update('tbl_prescription', $data);
			//echo $this->db->last_query();exit();
			

            $this->db->where('iPrescriptionId', $recID);
            $this->db->delete('tbl_prescription_detail');

            $iDrugID=$this->input->post('iDrugID', TRUE);
            $iQty=$this->input->post('iQty', TRUE);
            $Dusage=$this->input->post('Dusage', TRUE);
            for ($x = 0; $x < count($iDrugID); $x++) { 

        $Drugandprice=$iDrugID[$x];
        $Drugandprice_array=explode("_",$Drugandprice);
        $drugID=$Drugandprice_array[0];
        
       
             $data2 = array(
                'iPrescriptionId' => $recID,
                'iDrugId' => $drugID,
                'iQuantity' => $iQty[$x],
                'Dusage' => $Dusage[$x],
                'cEnable'=>'Y'
            );

            $this->db->insert('tbl_prescription_detail', $data2);
            $insert_id = $this->db->insert_id(); 
        }
        

            $tDes = "prescription data updated ";
            $this->load->model('common_model');
            $this->common_model->add_log($tDes);
        }


        $this->db->trans_complete();
     
 if ($this->db->trans_status() === FALSE) {
            return 'F';
        } else {
            return 1;
        }

       
    }

	public function save_check_availability($save_status, $recID) {
        $data = array(
            'iP_id' => $this->input->post('iP_id', TRUE),
            'iShedule_id' => $recID,
            'iAppointmentNumber' => $this->input->post('app_num', TRUE),
            'cEnable' => 'Y',
        );

        $this->db->trans_start();
        if ($save_status === 'A') {

            $this->db->insert('tbl_appointment', $data);
            $insert_id = $this->db->insert_id();
            
            $tDes = "New Appointment added";
            $this->load->model('common_model');
            $this->common_model->add_log($tDes);
        }

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                return 'F';
            } else {
                return $insert_id;
        }
    }


	public function get_edit_user($colid,$recID, $table_name) {

        $this->db->from($table_name);
        $this->db->where($colid, $recID);
        //$this->db->order_by('dDate', "Desc");
        //$this->db->limit('3');
        $query = $this->db->get();
        // echo $this->db->last_query();
        //exit();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return array();
    }

	public function get_edit_availability($colid,$recID, $table_name) {

        $this->db->from($table_name);
        $this->db->where($colid, $recID);
        //$this->db->order_by('dDate', "Desc");
        //$this->db->limit('3');
        $query = $this->db->get();
        // echo $this->db->last_query();
        //exit();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return array();
    }

		public function get_edit_check_availability($colid,$recID, $table_name) {

        $this->db->from($table_name);
        $this->db->where($colid, $recID);
        //$this->db->order_by('dDate', "Desc");
        //$this->db->limit('3');
        $query = $this->db->get();
        // echo $this->db->last_query();
        //exit();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return array();
    }

    public function get_user_types() {

        $iUserType = $this->session->userdata('oba_iUserTypeBackendsession');
        if ($iUserType != 1) {
            $this->db->where('id !=', 1);
        }

        $this->db->order_by("id", "ASC");
        $result = $this->db->get('tbl_user_type');


        if ($result->num_rows() > 0) {
            return $result->result();
        }
        return array();
    }

    public function get_edit_usertype($recID, $table_name) {

        $this->db->from($table_name);
        $this->db->where('id', $recID);
        //$this->db->order_by('dDate', "Desc");
        //$this->db->limit('3');
        $query = $this->db->get();
        // echo $this->db->last_query();
        //exit();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return array();
    }

    public function get_user_detail() {

        $this->db->select('tbl_user.id,tbl_user.vFirstName,tbl_user.vUserName,tbl_user.vLastName,tbl_user.cEnable,tbl_user.vContactNo,tbl_user.vEmail,tbl_user.iUserType');
        $this->db->from('tbl_user');
        $this->db->join('tbl_user_type', 'tbl_user.iUserType = tbl_user_type.id');

        $this->db->order_by("tbl_user.vFirstName", "ASC");
        $result = $this->db->get();

        if ($result->num_rows() > 0) {
            return $result->result();
        }
        return array();
    }

    //

    public function save_user_type($save_status, $recID) {


        $vAccTypeName=$this->input->post('vAccTypeName', TRUE); 
        $vAccDescription=$this->input->post('vAccDescription', TRUE);
        $cEnable=$this->input->post('cEnable', TRUE);
        $formid=$this->input->post('formid', TRUE);
        $date=date('Y-m-d H:i:s');

        //exit();

        $data = array(
            'vAccTypeName' => $vAccTypeName,
            'vAccDescription' => $vAccDescription,
            'dLastUpDate' => $date,
            'cEnable' => $cEnable,
            'dSaveDate' => $date
        );

        //var_dump($data); exit();


        if ($save_status === 'A') {
            $this->db->trans_start();
            $this->db->insert('tbl_user_type', $data);
            $insert_id = $this->db->insert_id();
            //exit();
            for($i=0; $i<=count($formid); $i++){
                if(isset($formid[$i])){
                    $viewD='view'.$formid[$i];
                    $editD='edit'.$formid[$i];
                    $deleteD='delete'.$formid[$i];

                    $view=$this->input->post($viewD, TRUE);
                    if($view==''){
                        $view=0;
                    }
                    $edit=$this->input->post($editD, TRUE); 
                    if($edit==''){
                        $edit=0;
                    }
                    $delete=$this->input->post($deleteD, TRUE);
                    if($delete==''){
                        $delete=0;
                    }


                    $permission=$view.','.$edit.','.$delete;
                    $data_t = array();
                    $data_t['iUserTypeID'] = $insert_id;
                    $data_t['iFormID'] = $formid[$i];
                    $data_t['vPrivilages'] = $permission;


                    $this->db->insert('tbl_privilage', $data_t);
                }
            }
            $this->db->trans_complete();

        }else{

            $this->db->trans_start();
            $this->db->where('id', $recID);
            $this->db->update('tbl_user_type', $data);

            $this->db->where('iUserTypeID', $recID);
            $this->db->delete('tbl_privilage');


            for($i=0; $i<=count($formid); $i++){
                if(isset($formid[$i])){
                    $viewD='view'.$formid[$i];
                    $editD='edit'.$formid[$i];
                    $deleteD='delete'.$formid[$i];


                    $view=$this->input->post($viewD, TRUE);
                    if($view==''){
                        $view=0;
                    }
                    $edit=$this->input->post($editD, TRUE); 
                    if($edit==''){
                        $edit=0;
                    }
                    $delete=$this->input->post($deleteD, TRUE);
                    if($delete==''){
                        $delete=0;
                    }

                    $permission=$view.','.$edit.','.$delete;
                    $data_t = array();
                    $data_t['iUserTypeID'] = $recID;
                    $data_t['iFormID'] = $formid[$i];
                    $data_t['vPrivilages'] = $permission;

                    $this->db->insert('tbl_privilage', $data_t);



                }
            }

            $this->db->trans_complete();
        }


        if ($this->db->trans_status() === FALSE) {
            return false;
        } else {
            return true;
        }
    }


    public function delete_privilages() {
        $iUserTypeID = $this->uri->segment(5);

        $this->db->trans_start();
        $this->db->where('id', $iUserTypeID);
        $this->db->delete('tbl_user_type');

        $this->db->where('iUserTypeID', $iUserTypeID);
        $this->db->delete('tbl_privilage');

        $this->db->trans_complete();


        if ($this->db->trans_status() === FALSE) {
            $this->session->set_flashdata('message', 'Data delete faild.');
            return false;
        } else {
            $this->session->set_flashdata('message', 'Data successfully deleted.');
            $tDes = "Record has been deleteed";
            $this->load->model('common_model');
            $this->common_model->add_log($tDes);
            return true;
        }
    }

    public function delete_record($recID, $tblName,$titile) {

        $this->db->trans_start();

        $this->db->where('id', $recID);
        $this->db->delete($tblName);

        $this->db->trans_complete();
         //print_r($this->db->last_query());      exit();
		// echo $this->db->last_query();exit();
        if ($this->db->trans_status() === FALSE) {
            $this->session->set_flashdata('message', 'Data delete faild.');
            return false;
        } else {
            $this->session->set_flashdata('message', 'Data successfully deleted.');
            $tDes = "$titile has been deleted ID = $recID";
            $this->load->model('common_model');
            $this->common_model->add_log($tDes);
            return true;
        }
    }

    public function active_record($recID, $tblName) {

        $data = array(
            'cEnable' => 'Y'
        );

        $this->db->trans_start();
        $this->db->where('id', $recID);
        $this->db->update($tblName, $data);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            $this->session->set_flashdata('message', 'Request faild.');
            return false;
        } else {
            $this->session->set_flashdata('message', 'Data successfully activated.');
            return true;
        }
    }

    public function deactive_record($recID, $tblName) {

        $data = array(
            'cEnable' => 'N'
        );

        $this->db->trans_start();
        $this->db->where('id', $recID);
        $this->db->update($tblName, $data);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            $this->session->set_flashdata('message', 'Request faild.');
            return false;
        } else {
            $this->session->set_flashdata('message', 'Data successfully deactivated.');
            return true;
        }
    }

    public function get_user_log() {

        $this->db->select('tbl_logs.id,tbl_logs.vPage,tbl_logs.tDes,tbl_logs.dDateTime,tbl_logs.vIP,tbl_user.vFirstName');
        $this->db->from('tbl_logs');
        $this->db->join('tbl_user', 'tbl_logs.iUserID = tbl_user.id');
        $this->db->order_by("tbl_logs.dDateTime", "DESC");

        $result = $this->db->get();

        if ($result->num_rows() > 0) {
            return $result->result();
        }
        return array();
    }



}
?>