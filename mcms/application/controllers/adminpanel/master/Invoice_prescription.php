<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


Class Invoice_prescription extends CI_Controller {

    private $table_name = "tbl_prescription";

    private $redirect_path = "adminpanel/master/invoice_prescription/add_invoice_prescription";

    public function __construct() {
        parent::__construct();

        if ($this->session->userdata('oba_is_logged_inbackendsession') != "1") {
            redirect('adminpanel/login');
        }

        set_title("Add Invoice prescription");

    }
    public function create_invoice() {
        $data['title'] ='Prescription Details';
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
			$sql_data = "SELECT
			tbl_prescription.id,
			tbl_prescription.iAge,
			tbl_prescription.dDate,
			tbl_prescription.iAppointmentNumber,
			tbl_prescription.tDescription,
			tbl_prescription.cEnable,
			tbl_prescription.fReport,
			concat(tbl_user.vFirstName,' ',tbl_user.vLastName ) as patient_name,
			concat(doctor.vFirstName,' ',doctor.vLastName ) as doc_name,
			doctor.id as iDoctorId,
			tbl_user.id as iPatientId
			FROM
			tbl_prescription
			INNER JOIN tbl_user ON tbl_prescription.iP_id = tbl_user.id
			INNER JOIN tbl_user AS doctor ON tbl_prescription.d_id = doctor.id
			where tbl_prescription.id='".$recID."'
			ORDER BY
			tbl_prescription.id DESC";

            $data['edit_prescription'] = $this->common_model->populate_drop_down($sql_data);


            
            $sql_data678 = "SELECT
            tbl_prescription_detail.iQuantity,
            tbl_prescription_detail.Dusage,
            tbl_drug.vDrugName
            FROM
            tbl_prescription_detail
            INNER JOIN tbl_drug ON tbl_prescription_detail.iDrugId = tbl_drug.id
            where tbl_prescription_detail.iPrescriptionId='".$recID."'
            ORDER BY
            tbl_prescription_detail.id asc";
            $data['edit_prescription_data'] = $this->common_model->populate_drop_down($sql_data678);


			$sql_data4 = "SELECT * FROM `tbl_drug` WHERE `cEnable`='Y' ORDER by `vDrugName` ASC";
            $data['drug_data'] = $this->common_model->populate_drop_down($sql_data4);


            $sql_user_type_p = "SELECT tbl_user.vFirstName,tbl_user.vLastName,tbl_user.id FROM tbl_user WHERE tbl_user.cEnable = 'Y' AND tbl_user.iUserType = '34' ORDER BY tbl_user.vFirstName ASC";
            $data['iUserTypeArr_p'] = $this->common_model->populate_drop_down($sql_user_type_p);


	
		    $sql_user_type = "SELECT tbl_user.vFirstName,tbl_user.vLastName,tbl_user.id FROM tbl_user WHERE tbl_user.cEnable = 'Y' AND tbl_user.id = '223' ";
            $data['iUserTypeArr'] = $this->common_model->populate_drop_down($sql_user_type);
      

            $this->load->view('adminpanel/header_view');
            $this->load->view('adminpanel/masterdata/invoice_prescription_view',$data);
            $this->load->view('adminpanel/footer_view');



    }

	public function view_invoice_prescription() {
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
			tbl_prescription.cEnable,
			concat(tbl_user.vFirstName,' ',tbl_user.vLastName ) as patient_name,
			concat(doctor.vFirstName,' ',doctor.vLastName ) as doc_name
			FROM
			tbl_prescription
			INNER JOIN tbl_user ON tbl_prescription.iP_id = tbl_user.id
			INNER JOIN tbl_user AS doctor ON tbl_prescription.d_id = doctor.id
            Left JOIN tbl_invoice_header ON tbl_prescription.id = tbl_invoice_header.iPres_id
            where tbl_invoice_header.iPres_id is null
			ORDER BY
			tbl_prescription.id DESC";


        $data['list_data'] = $this->common_model->populate_drop_down($sql_data);


            $this->load->view('adminpanel/header_view');

            $this->load->view('adminpanel/masterdata/invoice_prescription_view',$data);
            $this->load->view('adminpanel/footer_view');
        }

 public function save_invoice_prescription() {

        $save_status = $this->input->post('cSaveStatus', TRUE);
        $recID = $this->input->post('id', TRUE);

            $this->load->model('admin_model');
            $this->load->model('common_model');

            if ($save_status === 'E') {
                //$res =$this->admin_model->save_prescription($save_status,$recID);
				$res =$this->common_model->update_prescription('tbl_invoice');

                if ($res=='F') {
                    $this->session->set_flashdata('message_error', 'Save fail!');
					redirect(base_url() . 'adminpanel/master/invoice_prescription/edit_invoice_prescription/'.$recID);
                }else{
                    $this->session->set_flashdata('message_saved', 'Saved successfully.');
                    redirect(base_url() . 'adminpanel/master/invoice_prescription/view_invoice_prescription');
                } 
            } else {
                //$res =$this->admin_model->save_prescription($save_status,$recID);
				$res =$this->common_model->save_prescription('tbl_invoice');
                if ($res=='F') {
                    $this->session->set_flashdata('message_error', 'Save fail!');
					redirect(base_url() . 'adminpanel/master/invoice_prescription/edit_invoice_prescription/'.$recID);
                }else{
                    $this->session->set_flashdata('message_saved', 'Saved successfully.');
                    redirect(base_url() . 'adminpanel/master/invoice_prescription/view_invoice_prescription');
                }
            }

    }

	public function save_invoice() {

        $save_status = $this->input->post('cSaveStatus', TRUE);
        $recID = $this->input->post('id', TRUE);

            $this->load->model('admin_model');
            $this->load->model('common_model');

            if ($save_status === 'E') {
                $res =$this->admin_model->save_invoice($save_status,$recID);


                if ($res=='F') {
                    $this->session->set_flashdata('message_error', 'Save fail..!');
					redirect(base_url() . 'adminpanel/master/invoice_prescription/create_invoice/'.$recID);
                }else{
                    $this->session->set_flashdata('message_saved', 'Saved successfully.');
                    redirect(base_url() . 'adminpanel/master/invoice_prescription/create_invoice/'.$recID);
                } 
            } else {
                $res =$this->admin_model->save_invoice($save_status,$recID);

                if ($res=='F') {
                    $this->session->set_flashdata('message_error', 'Save fail!');
					redirect(base_url() . 'adminpanel/master/invoice_prescription/create_invoice/'.$recID);
                }else{
                    $this->session->set_flashdata('message_saved', 'Saved successfully.');
                    redirect(base_url() . 'adminpanel/master/invoice_prescription/create_invoice/'.$recID);
                }
            }

    }


}

?>
