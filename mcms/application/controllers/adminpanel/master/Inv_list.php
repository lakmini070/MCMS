<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


Class Inv_list extends CI_Controller {

    private $table_name = "tbl_invoice_header";

    private $redirect_path = "adminpanel/master/inv_list/add_inv_list";

    public function __construct() {
        parent::__construct();

        if ($this->session->userdata('oba_is_logged_inbackendsession') != "1") {
            redirect('adminpanel/login');
        }
        set_title("Invoice List");

    }

    public function view_inv_list() {
        $data = array();
        $data['saveStatus'] = 'V';

        $this->load->model('admin_model');
		$date=date('Y-m-d');
		$sql_user_type = "SELECT
		tbl_invoice_header.dSaveDate,
		tbl_invoice_header.id,
		tbl_invoice_header.iPatientId,
		tbl_invoice_header.iDoctorId,
		tbl_invoice_header.fDoctorCharge,
concat(tbl_user.vFirstName,' ',tbl_user.vLastName ) as patient_name,
concat(doctor.vFirstName,' ',doctor.vLastName ) as doc_name
FROM
tbl_invoice_header
INNER JOIN tbl_user ON tbl_invoice_header.iPatientId = tbl_user.id
INNER JOIN tbl_user AS doctor ON tbl_invoice_header.iDoctorId = doctor.id
ORDER BY
tbl_invoice_header.id DESC";


        $data['list_data'] = $this->common_model->populate_drop_down($sql_user_type);

        $data['title'] ='Invoice Details';

        $this->load->view('adminpanel/header_view');
        $this->load->view('adminpanel/masterdata/inv_list_view',$data);
        $this->load->view('adminpanel/footer_view');
    }

     public function edit_inv_list() {
        $data = array();
        if (empty($data))
            $data['saveStatus'] = 'E';
		$recID = $this->uri->segment(5);
        $this->load->model('admin_model');
		$date=date('Y-m-d');
		$sql_user_type = "SELECT
		tbl_invoice_header.dSaveDate,
		tbl_invoice_header.dPrescriptionDate,
		tbl_invoice_header.tDescription,
		tbl_invoice_header.id,
		tbl_invoice_header.iPatientId,
		tbl_invoice_header.iDoctorId,
		tbl_invoice_header.fDoctorCharge,
concat(tbl_user.vFirstName,' ',tbl_user.vLastName ) as patient_name,
concat(doctor.vFirstName,' ',doctor.vLastName ) as doc_name
FROM
tbl_invoice_header
INNER JOIN tbl_user ON tbl_invoice_header.iPatientId = tbl_user.id
INNER JOIN tbl_user AS doctor ON tbl_invoice_header.iDoctorId = doctor.id
where tbl_invoice_header.id='$recID'
ORDER BY
tbl_invoice_header.id DESC";
        $data['list_data'] = $this->common_model->populate_drop_down($sql_user_type);

		$sql_user_type2 = "SELECT
		tbl_invoice_detail.iDrugId,
		tbl_invoice_detail.iQuantity,
		tbl_invoice_detail.fUnitPrice,
		tbl_invoice_detail.fPrice,
		tbl_drug.vDrugName
FROM
tbl_invoice_detail
INNER JOIN tbl_drug ON tbl_invoice_detail.iDrugId = tbl_drug.id
where tbl_invoice_detail.iInvoiceId='$recID'
ORDER BY
tbl_invoice_detail.id ASC";
        $data['list_data_detail'] = $this->common_model->populate_drop_down($sql_user_type2);

        $this->load->view('adminpanel/header_view');
        $this->load->view('adminpanel/masterdata/inv_list_view',$data);
        $this->load->view('adminpanel/footer_view');
    }


}

?>
