<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


Class Drug_report extends CI_Controller {

    private $table_name = "tbl_drug";

    private $redirect_path = "adminpanel/master/Drug_report/view_drug";

    public function __construct() {
        parent::__construct();

        if ($this->session->userdata('oba_is_logged_inbackendsession') != "1") {
            redirect('adminpanel/login');
        }
        //set_title("Add Drug");
    }

	public function view_drug() {
        $data = array();
        if (empty($data))
            $data['saveStatus'] = 'V';

            $this->load->model('admin_model');

            $sql_data = "SELECT
			tbl_drug.id,
			tbl_drug.vDrugName,
			tbl_drug.iQuantity,
			tbl_drug.fUnitPrice,
			tbl_drug.cEnable
			FROM
			tbl_drug
			ORDER BY
			tbl_drug.vDrugName ASC";
        $data['list_data'] = $this->common_model->populate_drop_down($sql_data);



		$sql_data = "SELECT
tbl_drug.vDrugName,
sum(tbl_invoice_detail.iQuantity) as iQuantity
FROM
tbl_invoice_header
INNER JOIN tbl_invoice_detail ON tbl_invoice_detail.iInvoiceId = tbl_invoice_header.id
INNER JOIN tbl_drug ON tbl_invoice_detail.iDrugId = tbl_drug.id
WHERE
tbl_invoice_header.dSaveDate BETWEEN '".date('Y-m-01')."' AND '".date('Y-m-t')."'
GROUP BY
tbl_invoice_detail.iDrugId
ORDER BY
sum(tbl_invoice_detail.iQuantity) DESC LIMIT 6";


        $data['list_data_for_fast'] = $this->common_model->populate_drop_down($sql_data);

            $this->load->view('adminpanel/header_view');

            $this->load->view('adminpanel/masterdata/drug_report_view',$data);
            $this->load->view('adminpanel/footer_view');
        }



}

?>
