<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


Class Myprescription extends CI_Controller {

    private $table_name = "tbl_prescription";

    private $redirect_path = "adminpanel/master/Myprescription/add_Myprescription";

    public function __construct() {
        parent::__construct();

        if ($this->session->userdata('oba_is_logged_inbackendsession') != "1") {
            redirect('adminpanel/login');
        }

        set_title("Add Myprescription");

    }



        public function view_detail_myprescription() {

            $data['title'] ='Edit Myprescription Details';
            $this->load->model('admin_model');
            $data['saveStatus']='E';

            $this->load->model('admin_model');

            $sql_data = "SELECT
			tbl_prescription.id,
			tbl_prescription.iAge,
			tbl_prescription.dDate,
			tbl_prescription.iAppointmentNumber,
			tbl_prescription.tDescription,
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
        $data['edit_myprescription'] = $this->admin_model->get_edit_data($recID,$this->table_name);


$sql_user_type_p = "SELECT tbl_user.vFirstName,tbl_user.vLastName,tbl_user.id FROM tbl_user WHERE tbl_user.cEnable = 'Y' AND tbl_user.iUserType = '34' ORDER BY tbl_user.vFirstName ASC";

        $data['iUserTypeArr_p'] = $this->common_model->populate_drop_down($sql_user_type_p);


		//print_r($data['iUserTypeArr_p']); exit();
		
$sql_user_type = "SELECT tbl_user.vFirstName,tbl_user.vLastName,tbl_user.id FROM tbl_user WHERE tbl_user.cEnable = 'Y' AND tbl_user.id = '223' ";

        $data['iUserTypeArr'] = $this->common_model->populate_drop_down($sql_user_type);
       // print_r($data['iUserTypeArr']); exit();

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

$sql_data4 = "SELECT * FROM `tbl_drug` WHERE `cEnable`='Y' ORDER by `vDrugName` ASC";

            $data['drug_data'] = $this->common_model->populate_drop_down($sql_data4);
            $this->load->view('adminpanel/header_view');
            $this->load->view('adminpanel/masterdata/myprescription_view',$data);
            $this->load->view('adminpanel/footer_view');



    }

	public function view_myprescription() {
        $data = array();
        if (empty($data))
            $data['saveStatus'] = 'V';

            $this->load->model('admin_model');
			$P_userid=$this->session->userdata('oba_userbackendsession');
            $sql_data = "SELECT
			tbl_prescription.id,
			tbl_prescription.iAge,
			tbl_prescription.dDate,
			tbl_prescription.iAppointmentNumber,
			tbl_prescription.tDescription,
			tbl_prescription.cEnable,
			concat(tbl_user.vFirstName,' ',tbl_user.vLastName ) as patient_name,
			concat(doctor.vFirstName,' ',doctor.vLastName ) as doc_name
			FROM
			tbl_prescription
			INNER JOIN tbl_user ON tbl_prescription.iP_id = tbl_user.id
			INNER JOIN tbl_user AS doctor ON tbl_prescription.d_id = doctor.id
			where tbl_prescription.iP_id = ".$P_userid."
			ORDER BY
			tbl_prescription.id DESC";


        $data['list_data'] = $this->common_model->populate_drop_down($sql_data);


            $this->load->view('adminpanel/header_view');

            $this->load->view('adminpanel/masterdata/myprescription_view',$data);
            $this->load->view('adminpanel/footer_view');
        }

}

?>
