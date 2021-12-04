<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


Class Drug extends CI_Controller {

    private $table_name = "tbl_drug";
    private $redirect_path = "adminpanel/master/Drug/add_Drug";

    public function __construct() {
        parent::__construct();

        if ($this->session->userdata('oba_is_logged_inbackendsession') != "1") {
            redirect('adminpanel/login');
        }
        set_title("Add Drug");
    }

    public function add_drug() {
        $data = array();
        if (empty($data))
            $data['saveStatus'] = 'A';

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
			ORDER BY
			tbl_drug.vDrugName ASC";

        $data['list_data'] = $this->common_model->populate_drop_down($sql_data);
        $data['title'] ='Add a New Drug';

        $this->load->view('adminpanel/header_view');
        $this->load->view('adminpanel/masterdata/drug_view',$data);
        $this->load->view('adminpanel/footer_view');
    }

    public function edit_drug() {
	
        $data['title'] ='Edit Drug Details';
        $this->load->model('admin_model');
        $data['saveStatus']='E';

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
			ORDER BY
			tbl_drug.vDrugName ASC";

        $data['list_data'] = $this->common_model->populate_drop_down($sql_data);
            $recID = $this->uri->segment(5);

			$sql_data2 = "SELECT
			tbl_drug.id,
			tbl_drug.vDrugName,
			tbl_drug.iQuantity,
			tbl_drug.fUnitPrice,
			tbl_drug.cEnable,
			tbl_drug.iMinQty
			FROM
			tbl_drug
			where tbl_drug.id='".$recID."'
			ORDER BY
			tbl_drug.vDrugName ASC";

        $data['edit_drug'] = $this->common_model->populate_drop_down($sql_data2);

            $this->load->view('adminpanel/header_view');
            $this->load->view('adminpanel/masterdata/drug_view',$data);
            $this->load->view('adminpanel/footer_view');

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
			tbl_drug.cEnable,
			tbl_drug.iMinQty
			FROM
			tbl_drug
			ORDER BY
			tbl_drug.vDrugName ASC";

        $data['list_data'] = $this->common_model->populate_drop_down($sql_data);

            $this->load->view('adminpanel/header_view');
            $this->load->view('adminpanel/masterdata/drug_view',$data);
            $this->load->view('adminpanel/footer_view');
        }

 public function save_drug() {

        $save_status = $this->input->post('cSaveStatus', TRUE);
        $recID = $this->input->post('id', TRUE);

            $this->load->model('admin_model');
            $this->load->model('common_model');

            if ($save_status === 'E') {
                //$res =$this->admin_model->save_drug($save_status,$recID);
				$res =$this->common_model->update_drug('tbl_drug');

                if ($res=='F') {
                    $this->session->set_flashdata('message_error', 'Save fail!');
					redirect(base_url() . 'adminpanel/master/drug/edit_drug/'.$recID);
                }else{
                    $this->session->set_flashdata('message_saved', 'Saved successfully.');
                    redirect(base_url() . 'adminpanel/master/drug/view_drug');
                } 
            } else {
                //$res =$this->admin_model->save_drug($save_status,$recID);
				$res =$this->common_model->save_drug('tbl_drug');
                if ($res=='F') {
                    $this->session->set_flashdata('message_error', 'Save fail!');
					redirect(base_url() . 'adminpanel/master/drug/edit_drug/'.$recID);
                }else{
                    $this->session->set_flashdata('message_saved', 'Saved successfully.');
                    redirect(base_url() . 'adminpanel/master/drug/view_drug');
                }
            }

    }



    public function active_record() {
        $recID = $this->uri->segment(5);

            $tDes = "Drug is activated. ID = $recID";
            $this->common_model->add_log($tDes);

            $this->load->model('admin_model');
            $this->admin_model->active_record($recID,$this->table_name);

            $redirect_path = "adminpanel/master/drug/view_drug";
            redirect(base_url() . $redirect_path);

    }

    public function deactive_record() {
        $recID = $this->uri->segment(5);

            $tDes = "Drug is deactivated. ID = $recID";
            $this->common_model->add_log($tDes);

            $this->load->model('admin_model');
            $this->admin_model->deactive_record($recID,$this->table_name);

            $redirect_path = "adminpanel/master/drug/view_drug";
            redirect(base_url() . $redirect_path);

    }


    public function delete_record() {
	$recID = $this->uri->segment(5);

        $tDes = "Drug Data has been Deleted";
        $this->common_model->add_log($tDes);
        $this->load->model('admin_model');

        $this->admin_model->delete_record($recID,$this->table_name,'drug');

        $redirect_path = "adminpanel/master/drug/view_drug";
        redirect(base_url() . $redirect_path);

    }

}

?>
