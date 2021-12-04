<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


Class Min_drug_report extends CI_Controller {

    private $table_name = "tbl_drug";

    private $redirect_path = "adminpanel/master/Min_drug_report/view_min_drug";

    public function __construct() {
        parent::__construct();

        if ($this->session->userdata('oba_is_logged_inbackendsession') != "1") {
            redirect('adminpanel/login');
        }
        //set_title("Add Drug");
    }


	public function view_min_drug() {
        $data = array();
        if (empty($data))
            $data['saveStatus'] = 'V';
            $this->load->model('admin_model');

            $sql_data = "SELECT
			tbl_drug.id,
			tbl_drug.vDrugName,
			tbl_drug.iQuantity,
			tbl_drug.fUnitPrice,
			tbl_drug.cEnable,
			tbl_drug.iMinQty
			FROM
			tbl_drug
			where tbl_drug.iQuantity <= tbl_drug.iMinQty
			ORDER BY
			tbl_drug.vDrugName ASC";

        $data['list_data'] = $this->common_model->populate_drop_down($sql_data);


            $this->load->view('adminpanel/header_view');
            $this->load->view('adminpanel/masterdata/min_drug_report_view',$data);
            $this->load->view('adminpanel/footer_view');
        }
}

?>
