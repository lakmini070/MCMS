<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


Class Today_appointment_report extends CI_Controller {

    private $table_name = "tbl_drug";

    private $redirect_path = "adminpanel/master/today_appointment_report/view_today_appointment";

    public function __construct() {
        parent::__construct();

        if ($this->session->userdata('oba_is_logged_inbackendsession') != "1") {
            redirect('adminpanel/login');
        }
        //set_title("Add Drug");
    }



	public function view_today_appointment() {
        $data = array();
        if (empty($data))
            $data['saveStatus'] = 'V';

            $this->load->model('admin_model');
			$date = date('Y-m-d');
			$sql_data = "SELECT
tbl_doctor_schedule.dSheduleDate,
tbl_doctor_schedule.vSheduleStartTime,
tbl_doctor_schedule.vSheduleEndTime,
tbl_appointment.iAppointmentNumber,
concat(tbl_user.vFirstName,' ',tbl_user.vLastName ) as patient_name,
concat(doctor.vFirstName,' ',doctor.vLastName ) as doc_name
FROM
tbl_doctor_schedule
INNER JOIN tbl_user AS doctor ON tbl_doctor_schedule.d_id = doctor.id
INNER JOIN tbl_appointment ON tbl_doctor_schedule.id = tbl_appointment.iShedule_id
INNER JOIN tbl_user ON tbl_appointment.iP_id = tbl_user.id
WHERE tbl_doctor_schedule.dSheduleDate='$date'
ORDER BY
tbl_appointment.id ASC";

        $data['list_data'] = $this->common_model->populate_drop_down($sql_data);

            $this->load->view('adminpanel/header_view');
            $this->load->view('adminpanel/masterdata/today_appointment_report_view',$data);
            $this->load->view('adminpanel/footer_view');
        }
}

?>
