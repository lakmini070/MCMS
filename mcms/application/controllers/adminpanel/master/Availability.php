<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


Class Availability extends CI_Controller {

    private $table_name = "tbl_doctor_schedule";

    private $redirect_path = "adminpanel/master/availability/add_availability";

    public function __construct() {
        parent::__construct();

        if ($this->session->userdata('oba_is_logged_inbackendsession') != "1") {
            redirect('adminpanel/login');
        }

        set_title("Add Availability");

    }

    public function add_availability() {
        $data = array();
        if (empty($data))
            $data['saveStatus'] = 'A';

        $this->load->model('admin_model');
        $data['list_data'] = $this->admin_model->get_availability();

        $data['title'] ='Add new Shedule';

        $sql_user_type = "SELECT tbl_user.vFirstName,tbl_user.vLastName,tbl_user.id FROM tbl_user WHERE tbl_user.cEnable = 'Y' AND tbl_user.id = '223' ";
        $data['iUserTypeArr'] = $this->common_model->populate_drop_down($sql_user_type);
      

        $this->load->view('adminpanel/header_view');
        $this->load->view('adminpanel/masterdata/availability_view',$data);
        $this->load->view('adminpanel/footer_view');
    }

    public function edit_availability() {

        $data['title'] ='Edit Availability Details';
        $this->load->model('admin_model');
        $data['saveStatus']='E';

        $data['list_data'] = $this->admin_model->get_availability();
        $recID = $this->uri->segment(5);
        $data['edit_availability'] = $this->admin_model->get_edit_availability('id',$recID,$this->table_name);
        $sql_user_type = "SELECT tbl_user.vFirstName,tbl_user.vLastName,tbl_user.id FROM tbl_user WHERE tbl_user.cEnable = 'Y' AND tbl_user.id = '223' ";
        $data['iUserTypeArr'] = $this->common_model->populate_drop_down($sql_user_type);

        $this->load->view('adminpanel/header_view');
        $this->load->view('adminpanel/masterdata/availability_view',$data);
        $this->load->view('adminpanel/footer_view');

    }

	public function view_availability() {
        $data = array();
        if (empty($data))
            $data['saveStatus'] = 'V';

            $this->load->model('admin_model');
            $data['list_data'] = $this->admin_model->get_availability();
            
            $this->load->view('adminpanel/header_view');
            $this->load->view('adminpanel/masterdata/availability_view',$data);
            $this->load->view('adminpanel/footer_view');
        }

       public function save_availability() {

        $save_status = $this->input->post('cSaveStatus', TRUE);
        $recID = $this->input->post('id', TRUE);

            $this->load->model('admin_model');
            $this->load->model('common_model');

            if ($save_status === 'E') {
                $res =$this->admin_model->save_availability($save_status,$recID);
                if ($res=='F') {
                    $this->session->set_flashdata('message_error', 'Save fail!');
					redirect(base_url() . 'adminpanel/master/availability/edit_availability/'.$recID);
                }else{
                    $this->session->set_flashdata('message_saved', 'Saved successfully.');
                    redirect(base_url() . 'adminpanel/master/availability/view_availability');
                } 
            } else {
                $res =$this->admin_model->save_availability($save_status,$recID);
                if ($res=='F') {
                    $this->session->set_flashdata('message_error', 'Save fail!');
					redirect(base_url() . 'adminpanel/master/availability/edit_availability/'.$recID);
                }else{
                    $this->session->set_flashdata('message_saved', 'Saved successfully.');
                    redirect(base_url() . 'adminpanel/master/availability/view_availability');
                }
            }
    }


    public function active_record() {
        $recID = $this->uri->segment(5);

            $tDes = "Availability is activated. ID = $recID";
            $this->common_model->add_log($tDes);

            $this->load->model('admin_model');
            $this->admin_model->active_record($recID,$this->table_name);

            $redirect_path = "adminpanel/master/availability/view_availability";
            redirect(base_url() . $redirect_path);

    }

    public function deactive_record() {
        $recID = $this->uri->segment(5);

            $tDes = "Availability is deactivated. ID = $recID";
            $this->common_model->add_log($tDes);

            $this->load->model('admin_model');
            $this->admin_model->deactive_record($recID,$this->table_name);

            $redirect_path = "adminpanel/master/availability/view_availability";
            redirect(base_url() . $redirect_path);

    }


    public function delete_record() {

	$recID = $this->uri->segment(5);
	
        $tDes = "Availability Data has been Deleted";
        $this->common_model->add_log($tDes);
        $this->load->model('admin_model');

        $this->admin_model->delete_record($recID,$this->table_name,'shedule');

        $redirect_path = "adminpanel/master/availability/view_availability";
        redirect(base_url() . $redirect_path);

    }

}

?>
