<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


Class Patient_report extends CI_Controller {

    private $table_name = "tbl_user";

    private $redirect_path = "adminpanel/master/Patient_report/view_Patient";

    public function __construct() {
        parent::__construct();

        if ($this->session->userdata('oba_is_logged_inbackendsession') != "1") {
            redirect('adminpanel/login');
        }
        
    }

	public function view_patient() {
        $data = array();
        if (empty($data))
            $data['saveStatus'] = 'V';
            $this->load->model('admin_model');

            $data['list_data'] = $this->admin_model->get_patient();

            $this->load->view('adminpanel/header_view');
            $this->load->view('adminpanel/masterdata/patient_report_view',$data);
            $this->load->view('adminpanel/footer_view');
        }
}

?>
