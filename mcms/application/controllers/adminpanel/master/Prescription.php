<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Prescription extends CI_Controller {
    private $table_name = "tbl_prescription";
    private $redirect_path = "adminpanel/master/Prescription/add_Prescription";
    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('oba_is_logged_inbackendsession') != "1") {
            redirect('adminpanel/login');
        }
        set_title("Add Prescription");
    }
    public function add_prescription() {
        $data = array();
        if (empty($data))
            $data['saveStatus'] = 'A';

        $this->load->model('admin_model');

		$sql_data = "SELECT
			tbl_prescription.id,
			tbl_prescription.iAge,
			tbl_prescription.dDate,
			tbl_prescription.iAppointmentNumber,
			tbl_prescription.cEnable,
            #tbl_prescription.Shedule_Time

			concat(tbl_user.vFirstName,' ',tbl_user.vLastName ) as patient_name,
			concat(doctor.vFirstName,' ',doctor.vLastName ) as doc_name
			FROM
			tbl_prescription
			INNER JOIN tbl_user ON tbl_prescription.iP_id = tbl_user.id
			INNER JOIN tbl_user AS doctor ON tbl_prescription.d_id = doctor.id
			ORDER BY
			tbl_prescription.id DESC";

        $data['list_data'] = $this->common_model->populate_drop_down($sql_data);
        $data['pres_data']=array();
        $data['title'] ='Register a New Prescription';


        $sql_user_type_p = "SELECT
tbl_user.vFirstName,
tbl_user.vLastName,
tbl_user.id,
tbl_doctor_schedule.dSheduleDate
FROM
tbl_user
INNER JOIN tbl_appointment ON tbl_appointment.iP_id = tbl_user.id
INNER JOIN tbl_doctor_schedule ON tbl_appointment.iShedule_id = tbl_doctor_schedule.id
WHERE
tbl_user.cEnable = 'Y' AND
tbl_user.iUserType = '34' AND
tbl_doctor_schedule.dSheduleDate ='".date('Y-m-d')."'
ORDER BY
tbl_user.vFirstName ASC";

	//echo $sql_user_type_p; exit();
        $data['iUserTypeArr_p'] = $this->common_model->populate_drop_down($sql_user_type_p);
		//print_r($data['iUserTypeArr_p']); exit();



$sql_user_type = "SELECT tbl_user.vFirstName,tbl_user.vLastName,tbl_user.id FROM tbl_user WHERE tbl_user.cEnable = 'Y' AND tbl_user.id = '223' ";
        $data['iUserTypeArr'] = $this->common_model->populate_drop_down($sql_user_type);
       // print_r($data['iUserTypeArr']); exit();



$sql_data4 = "SELECT * FROM `tbl_drug` WHERE `cEnable`='Y' ORDER by `vDrugName` ASC";
            $data['drug_data'] = $this->common_model->populate_drop_down($sql_data4);


        $this->load->view('adminpanel/header_view');
        $this->load->view('adminpanel/masterdata/prescription_view',$data);
        $this->load->view('adminpanel/footer_view');
    }

        public function edit_prescription() {


            $data['title'] ='Edit Prescription Details';
            $this->load->model('admin_model');
            $data['saveStatus']='E';

            $this->load->model('admin_model');


            $sql_data = "SELECT
			tbl_prescription.id,
			tbl_prescription.iAge,
			tbl_prescription.dDate,
			tbl_prescription.iAppointmentNumber,
			tbl_prescription.tDescription,
             #tbl_prescription.Shedule_Time,
			tbl_prescription.cEnable,
			concat(tbl_user.vFirstName,' ',tbl_user.vLastName ) as patient_name,
			concat(doctor.vFirstName,' ',doctor.vLastName ) as doc_name
			FROM
			tbl_prescription
			INNER JOIN tbl_user ON tbl_prescription.iP_id = tbl_user.id
			INNER JOIN tbl_user AS doctor ON tbl_prescription.d_id = doctor.id
			ORDER BY
			tbl_prescription.id DESC";


        $data['list_data'] = $this->common_model->populate_drop_down($sql_data);
            $recID = $this->uri->segment(5);
            $data['edit_prescription'] = $this->admin_model->get_edit_data($recID,$this->table_name);

$sql_user_type_p = "SELECT tbl_user.vFirstName,tbl_user.vLastName,tbl_user.id FROM tbl_user WHERE tbl_user.cEnable = 'Y' AND tbl_user.iUserType = '34' ORDER BY tbl_user.vFirstName ASC";
        $data['iUserTypeArr_p'] = $this->common_model->populate_drop_down($sql_user_type_p);
		//print_r($data['iUserTypeArr_p']); exit();


$sql_user_type = "SELECT tbl_user.vFirstName,tbl_user.vLastName,tbl_user.id FROM tbl_user WHERE tbl_user.cEnable = 'Y' AND tbl_user.id = '223' ";
        $data['iUserTypeArr'] = $this->common_model->populate_drop_down($sql_user_type);
       // print_r($data['iUserTypeArr']); exit();


$sql_data4 = "SELECT * FROM `tbl_drug` WHERE `cEnable`='Y' ORDER by `vDrugName` ASC";
            $data['drug_data'] = $this->common_model->populate_drop_down($sql_data4);


            $sql_data123123 = "SELECT
            tbl_prescription_detail.iPrescriptionId,
            tbl_prescription_detail.iDrugId,
            tbl_prescription_detail.iQuantity,
            tbl_prescription_detail.Dusage
            FROM
            tbl_prescription_detail
            Where
            tbl_prescription_detail.iPrescriptionId='".$recID."'
            ORDER BY
            tbl_prescription_detail.id DESC";

        $data['pres_data'] = $this->common_model->populate_drop_down($sql_data123123);
   // print_r( $data['pres_data'] );
   // exit();    
            $this->load->view('adminpanel/header_view');
            $this->load->view('adminpanel/masterdata/prescription_view',$data);
            $this->load->view('adminpanel/footer_view');


    }

	public function view_prescription() {
        $data = array();
        if (empty($data))
            $data['saveStatus'] = 'V';

            $this->load->model('admin_model');

            $sql_data = "SELECT
			tbl_prescription.id,
			tbl_prescription.iAge,
			tbl_prescription.dDate,
			tbl_prescription.iAppointmentNumber,
			tbl_prescription.tDescription,
            #tbl_prescription.Shedule_Time,
			tbl_prescription.cEnable,
			concat(tbl_user.vFirstName,' ',tbl_user.vLastName ) as patient_name,
			concat(doctor.vFirstName,' ',doctor.vLastName ) as doc_name
			FROM
			tbl_prescription
			INNER JOIN tbl_user ON tbl_prescription.iP_id = tbl_user.id
			INNER JOIN tbl_user AS doctor ON tbl_prescription.d_id = doctor.id
			ORDER BY
			tbl_prescription.id DESC";


        $data['list_data'] = $this->common_model->populate_drop_down($sql_data);

            $this->load->view('adminpanel/header_view');
            $this->load->view('adminpanel/masterdata/prescription_view',$data);
            $this->load->view('adminpanel/footer_view');
        }


 public function save_prescription() {

        $save_status = $this->input->post('cSaveStatus', TRUE);
        $recID = $this->input->post('id', TRUE);

            $this->load->model('admin_model');
            $this->load->model('common_model');

            if ($save_status === 'E') {
                $res =$this->admin_model->save_prescription($save_status,$recID);
				
                if ($res=='F') {
                    $this->session->set_flashdata('message_error', 'Save fail!');
					redirect(base_url() . 'adminpanel/master/prescription/edit_prescription/'.$recID);
                }else{
                    $this->session->set_flashdata('message_saved', 'Saved successfully.');
                    redirect(base_url() . 'adminpanel/master/prescription/view_prescription');
                } 
            } else {
                $res =$this->admin_model->save_prescription($save_status,$recID);
				
                if ($res=='F') {
                    $this->session->set_flashdata('message_error', 'Save fail!');
					redirect(base_url() . 'adminpanel/master/prescription/edit_prescription/'.$recID);
                }else{
                    $this->session->set_flashdata('message_saved', 'Saved successfully.');
                    redirect(base_url() . 'adminpanel/master/prescription/view_prescription');
                }
            }

    }


    public function active_record() {
        $recID = $this->uri->segment(5);

            $tDes = "Prescription is activated. ID = $recID";
            $this->common_model->add_log($tDes);
            $this->load->model('admin_model');
            $this->admin_model->active_record($recID,$this->table_name);

            $redirect_path = "adminpanel/master/prescription/view_prescription";
            redirect(base_url() . $redirect_path);

    }

    public function deactive_record() {
        $recID = $this->uri->segment(5);


            $tDes = "Prescription is deactivated. ID = $recID";
            $this->common_model->add_log($tDes);

            $this->load->model('admin_model');
            $this->admin_model->deactive_record($recID,$this->table_name);

            $redirect_path = "adminpanel/master/prescription/view_prescription";
            redirect(base_url() . $redirect_path);
    }


    public function delete_record() {
	$recID = $this->uri->segment(5);

        $tDes = "Prescription Data has been Deleted";
        $this->common_model->add_log($tDes);
        $this->load->model('admin_model');

        $this->admin_model->delete_record($recID,$this->table_name,'prescription');
        $redirect_path = "adminpanel/master/prescription/view_prescription";
        redirect(base_url() . $redirect_path);

    }
}

?>
