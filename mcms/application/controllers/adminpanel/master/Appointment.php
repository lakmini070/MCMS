<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


Class Appointment extends CI_Controller {

    private $table_name = "tbl_appointment";
   	private $redirect_path = "adminpanel/master/appointment/add_appointment";

    public function __construct() {
        parent::__construct();

        if ($this->session->userdata('oba_is_logged_inbackendsession') != "1") {
            redirect('adminpanel/login');
        }
        set_title("Add appointment");
    }


 public function view_appointment() {
        $data = array();
        if (empty($data))
            $data['saveStatus'] = 'A';

        $this->load->model('admin_model');
		$date=date('Y-m-d');
		$sql_user_type = "SELECT
tbl_appointment.id,
tbl_appointment.iShedule_id,
tbl_appointment.iP_id,
tbl_appointment.iAppointmentNumber,
tbl_appointment.cEnable,
concat(tbl_user.vFirstName,' ',tbl_user.vLastName ) as patient_name,
tbl_doctor_schedule.dSheduleDate,
tbl_doctor_schedule.vSheduleStartTime,
tbl_doctor_schedule.vSheduleEndTime,
concat(doctor.vFirstName,' ',doctor.vLastName ) as doc_name
FROM
tbl_appointment
INNER JOIN tbl_user ON tbl_appointment.iP_id = tbl_user.id
INNER JOIN tbl_doctor_schedule ON tbl_appointment.iShedule_id = tbl_doctor_schedule.id
INNER JOIN tbl_user AS doctor ON tbl_doctor_schedule.d_id = doctor.id
WHERE
tbl_doctor_schedule.dSheduleDate >=  $date
ORDER BY
tbl_appointment.iShedule_id DESC, tbl_appointment.id ASC";
        $data['list_data'] = $this->common_model->populate_drop_down($sql_user_type);

        $data['title'] ='Appointment Details';	

        $this->load->view('adminpanel/header_view');
        $this->load->view('adminpanel/masterdata/appointment_view',$data);
        $this->load->view('adminpanel/footer_view');
    }

    public function test_visits() {

        $this->load->model('admin_model');
		$sql_user_type = "SELECT
tbl_prescription.iP_id,
Count(tbl_prescription.iP_id) AS visits,
tbl_user.vFirstName,
tbl_user.vLastName
FROM
tbl_prescription
INNER JOIN tbl_user ON tbl_prescription.iP_id = tbl_user.id
GROUP BY
tbl_prescription.iP_id";
        $data['list_data'] = $this->common_model->populate_drop_down($sql_user_type);
        $this->load->view('adminpanel/masterdata/visit_view',$data);

    }


    public function active_record() {
        $recID = $this->uri->segment(5);
        $tDes = "appointment is activated. ID = $recID";
        
            $this->common_model->add_log($tDes);
            $this->load->model('admin_model');
            $this->admin_model->active_record($recID,$this->table_name);

            $redirect_path = "adminpanel/master/appointment/view_appointment";
            redirect(base_url() . $redirect_path);

    }

    public function deactive_record() {
        $recID = $this->uri->segment(5);


            $tDes = "appointment is deactivated. ID = $recID";
            $this->common_model->add_log($tDes);

            $this->load->model('admin_model');
            $this->admin_model->deactive_record($recID,$this->table_name);

            $redirect_path = "adminpanel/master/appointment/view_appointment";
            redirect(base_url() . $redirect_path);

    }

}

?>