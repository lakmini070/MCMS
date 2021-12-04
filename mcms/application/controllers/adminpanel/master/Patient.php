<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


Class Patient extends CI_Controller {

    private $table_name = "tbl_user";

    private $redirect_path = "adminpanel/master/Patient/add_Patient";

    public function __construct() {
        parent::__construct();

        if ($this->session->userdata('oba_is_logged_inbackendsession') != "1") {
            redirect('adminpanel/login');
        }
        set_title("Add Patient");

    }

    public function add_patient() {
        $data = array();
        if (empty($data))
            $data['saveStatus'] = 'A';

        $this->load->model('admin_model');
        $data['list_data'] = $this->admin_model->get_patient(); //call function get_patient

        $data['title'] ='Register a New Patient';

        $sql_user_type = "SELECT tbl_user_type.vAccTypeName,tbl_user_type.id FROM tbl_user_type WHERE tbl_user_type.cEnable = 'Y' AND tbl_user_type.id = '34' ORDER BY tbl_user_type.vAccTypeName ASC";
        $data['iUserTypeArr'] = $this->common_model->populate_drop_down($sql_user_type);
      

        $this->load->view('adminpanel/header_view');
        $this->load->view('adminpanel/masterdata/patient_view',$data);
        $this->load->view('adminpanel/footer_view');
    }

    public function edit_patient() {
        $data['title'] ='Edit Patient Details';
        $this->load->model('admin_model');
        $data['saveStatus']='E';

        $data['list_data'] = $this->admin_model->get_patient();
        $recID = $this->uri->segment(5);
        $data['edit_patient'] = $this->admin_model->get_edit_user('id',$recID,$this->table_name);
        $data['iUserTypeArr'] = $this->admin_model->get_user_types();

        $this->load->view('adminpanel/header_view');
        $this->load->view('adminpanel/masterdata/patient_view',$data);
        $this->load->view('adminpanel/footer_view');


    }

	public function view_patient() {
        $data = array();
        if (empty($data))
            $data['saveStatus'] = 'V';
            $this->load->model('admin_model');
            $data['list_data'] = $this->admin_model->get_patient();


            $this->load->view('adminpanel/header_view');
            $this->load->view('adminpanel/masterdata/patient_view',$data);
            $this->load->view('adminpanel/footer_view');
        }

       public function save_user() {

        $save_status = $this->input->post('cSaveStatus', TRUE);
        $resetType = $this->input->post('resetType', TRUE);

        $recID = $this->input->post('id', TRUE);
        if ($save_status === 'E'){

            if ($resetType == 'Y'){

            $this->form_validation->set_rules('vUserName', 'user name', 'required|trim|xss_clean');
            $this->form_validation->set_rules('pPassword', 'password', 'required|trim|min_length[6]|max_length[14]|xss_clean');
            $this->form_validation->set_rules('pPasswordConfirm', 'confirm password', 'required|trim|matches[pPassword]|xss_clean');
            }else{

                $this->form_validation->set_rules('vFirstName', 'first name', 'required|trim|xss_clean');
                $this->form_validation->set_rules('vLastName', 'last name', 'required|trim|xss_clean');
            }


            }else{

//fresh data validation

            
             $this->form_validation->set_rules('pPassword', 'password', 'required|trim|min_length[6]|max_length[14]|xss_clean');
             $this->form_validation->set_rules('pPasswordConfirm', 'confirm password', 'required|trim|matches[pPassword]|xss_clean');
             $this->form_validation->set_rules('vFirstName', 'first name', 'required|trim|xss_clean');
             $this->form_validation->set_rules('vLastName', 'last name', 'required|trim|xss_clean');
             //$this->form_validation->set_rules('vContactNo', 'contact number', 'trim|xss_clean');

             $this->form_validation->set_message('is_unique', 'User name you entered is already exists.');

        }

//run above validation rules

        if ($this->form_validation->run()) {     //run

            $this->load->model('admin_model');
            $this->load->model('common_model');

            if ($save_status === 'E') {
                $res =$this->admin_model->save_user($save_status,$recID);
                if ($res=='AV') {
                    $this->session->set_flashdata('message_error', 'Somone else have this username!');
                    redirect(base_url() . 'adminpanel/master/patient/edit_patient/'.$recID);
                }elseif($res=='TR'){

                    $this->session->set_flashdata('message_saved', 'Saved successfully.');

                    redirect(base_url() . 'adminpanel/master/patient/view_patient');
                } else {
                    $this->session->set_flashdata('message_error', 'Save fail!');
					redirect(base_url() . 'adminpanel/master/patient/edit_patient'.$recID);
                }
            } else {
                echo $res =$this->admin_model->save_user($save_status,$recID);

                if ($res=='AV') {
                    $this->session->set_flashdata('message_error', 'Somone else have this username!');
                    redirect(base_url() . 'adminpanel/master/patient/view_patient');

                }elseif($res=='TR'){
                    $this->session->set_flashdata('message_saved', 'Saved successfully.');
                    redirect(base_url() . 'adminpanel/master/patient/view_patient');
                }else {

                    $this->session->set_flashdata('message_error', 'Save fail!');
                    redirect(base_url() . 'adminpanel/master/patient/add_patient');
                }
            }
        } else {


            if ($save_status === 'E') {
                $this->session->set_flashdata('message_error', 'Save fail!');
                redirect(base_url() . 'adminpanel/master/patient/edit_patient/'.$recID);
            } else {
                $this->session->set_flashdata('message_error', 'Save fail!');
                $this->add_patient();
            }
        }
    }


    public function check_username(){
        $this->load->model('admin_model');
        if(isset($_POST['username']))
        {
            $this->output
           ->set_content_type("application/json")
           ->set_output(json_encode($this->admin_model->check_username($_POST['username'])));
        }
    }



    public function active_record() {
        $recID = $this->uri->segment(5);

            $tDes = "Patient is activated. ID = $recID";
            $this->common_model->add_log($tDes);
            $this->load->model('admin_model');
            $this->admin_model->active_record($recID,'tbl_user');

            $redirect_path = "adminpanel/master/patient/view_patient";
            redirect(base_url() . $redirect_path);
    }

    public function deactive_record() {
        $recID = $this->uri->segment(5);

            $tDes = "Patient is deactivated. ID = $recID";
            $this->common_model->add_log($tDes);

            $this->load->model('admin_model');
            $this->admin_model->deactive_record($recID,'tbl_user');

            $redirect_path = "adminpanel/master/patient/view_patient";
            redirect(base_url() . $redirect_path);

    }


    public function delete_record() {
	$recID = $this->uri->segment(5);

        $tDes = "Patient Data has been Deleted";
        $this->common_model->add_log($tDes);
        $this->load->model('admin_model');

        $this->admin_model->delete_record($recID,'tbl_user','user');


        $redirect_path = "adminpanel/master/patient/view_patient";
        redirect(base_url() . $redirect_path);

    }

}

?>
