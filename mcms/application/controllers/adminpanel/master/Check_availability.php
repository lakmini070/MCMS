<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


Class Check_availability extends CI_Controller {

    private $table_name = "tbl_doctor_schedule";

    private $redirect_path = "adminpanel/master/check_availability/add_check_availability";

    public function __construct() {
        parent::__construct();

        if ($this->session->userdata('oba_is_logged_inbackendsession') != "1") {
            redirect('adminpanel/login');
        }

        set_title("Check Availability");

    }

    public function add_check_availability() {
        $data = array();
        if (empty($data))
            $data['saveStatus'] = 'A';

        $this->load->model('admin_model');
        $data['list_data'] = $this->admin_model->get_check_availability();

        $data['title'] ='Add new Shedule';

        $sql_user_type = "SELECT tbl_user.vFirstName,tbl_user.vLastName,tbl_user.id FROM tbl_user WHERE tbl_user.cEnable = 'Y' AND tbl_user.id = '223' ";
        $data['iUserTypeArr'] = $this->common_model->populate_drop_down($sql_user_type);
        
        $this->load->view('adminpanel/header_view');
        $this->load->view('adminpanel/masterdata/check_availability_view',$data);
        $this->load->view('adminpanel/footer_view');
    }

    public function edit_check_availability() {    //book appointment

			$this->load->model('admin_model');
            $data['title'] ='Add Appoinment';
            $data['saveStatus']='E';

            $data['list_data'] = $this->admin_model->get_check_availability();
            $recID = $this->uri->segment(5);

			// check data to editcheck availablity 
            $data['edit_check_availability'] = $this->admin_model->get_edit_check_availability('id',$recID,$this->table_name);
            $sql_user_type = "SELECT tbl_user.vFirstName,tbl_user.vLastName,tbl_user.id FROM tbl_user WHERE tbl_user.cEnable = 'Y' AND tbl_user.id = '223' ";
			$data['iUserTypeArr'] = $this->common_model->populate_drop_down($sql_user_type);


	$userid=$this->session->userdata('oba_userbackendsession');  // get current user id from sessions 
	$oba_iUserTypeBackendsession=$this->session->userdata('oba_iUserTypeBackendsession');  // get current user type from sessions

		if($oba_iUserTypeBackendsession==34){   // check if the user type is paitint
				$addwhere=" and tbl_user.id = '".$userid."'"; //relevent patient only select
				}else{
				$addwhere="";}

		$sql_Patient = "SELECT tbl_user.vFirstName,tbl_user.vLastName,tbl_user.id FROM tbl_user WHERE tbl_user.cEnable = 'Y' AND tbl_user.iUserType = '34' ".$addwhere." ";
       // echo $sql_Patient; exit();
		$data['PatientArr'] = $this->common_model->populate_drop_down($sql_Patient);


            $this->load->view('adminpanel/header_view');
            $this->load->view('adminpanel/masterdata/check_availability_view',$data);
            $this->load->view('adminpanel/footer_view');


    }

	public function view_check_availability() {
        $data = array();
        if (empty($data))
            $data['saveStatus'] = 'V';

            $this->load->model('admin_model');
            $data['list_data'] = $this->admin_model->get_check_availability();

            $this->load->view('adminpanel/header_view');
            $this->load->view('adminpanel/masterdata/check_availability_view',$data);
            $this->load->view('adminpanel/footer_view');
        }

    public function save_check_availability() {

        $save_status ='A';
        $SheduleID = $this->input->post('id', TRUE);
		$app_num = $this->input->post('app_num', TRUE);
		$p_id = $this->input->post('iP_id', TRUE);


        $this->load->model('admin_model');
        $this->load->model('common_model');

        $res =$this->admin_model->save_check_availability($save_status,$SheduleID);
            if ($res=='F') {
                $this->session->set_flashdata('message_error', 'Save fail!');
				redirect(base_url() . 'adminpanel/master/check_availability/edit_check_availability/'.$SheduleID);
            }else{

		//$sql_Email = "SELECT tbl_user.vEmail FROM tbl_user where tbl_user.id='".$p_id."'";
		//$P_email = $this->common_model->populate_drop_down($sql_Email);	
		//$to_email=$P_email[0]->vEmail; 
        $sql_Name = "SELECT tbl_user.vUserName FROM tbl_user where tbl_user.id='".$p_id."'";
        $P_pname = $this->common_model->populate_drop_down($sql_Name);
        $to_name = $P_pname[0]->vUserName;
             
        $dSheduleDate = $this->input->post('dSheduleDate', TRUE);
        $vSheduleEndTime = $this->input->post('vSheduleEndTime', TRUE);
        $vSheduleStartTime = $this->input->post('vSheduleStartTime', TRUE);

        $vSheduleStartTime  = date("H:i", strtotime($vSheduleStartTime));
        $sheduletime=$vSheduleStartTime;

        if($app_num!=1){
            $minutes=($app_num*10)-10;
            $mtime = strtotime("+".$minutes." minutes", strtotime($sheduletime));
            $sheduletime= date('H:i:s', $mtime);     
        }
//echo $sheduletime; exit();

            $to       ='lakudesh@gmail.com';//$to_email
            $subject  = 'Appoinment Confirmed';
            $message  = "Hi ".$to_name.",<br>
            Your Appointment is confirmed<br>
            Appointment No:".$app_num."<br>
            Date:".$dSheduleDate."<br>
            Time:".$sheduletime."";


            $headers  = 'From: lakminitest@gmail.com' . "\r\n" .
            'MIME-Version: 1.0' . "\r\n" .
            'Content-type: text/html; charset=utf-8';
            mail($to, $subject, $message, $headers);


            $this->session->set_flashdata('message_saved', 'Email Sent & Saved Successfully, Appointment Number : '.$app_num);
            redirect(base_url() . 'adminpanel/master/check_availability/view_check_availability');
            }
    }   

}

?>
