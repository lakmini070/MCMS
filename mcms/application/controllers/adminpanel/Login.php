<?php
if (!defined('BASEPATH'))

    exit('No direct script access allowed');

Class Login extends CI_Controller {

    public function __construct() {

        parent::__construct();

    }

    public function index() {

        $oba_userbackendsession = $this->session->userdata('oba_userbackendsession');
        if ($oba_userbackendsession != '') {
            
            redirect('adminpanel/managedashboard');

        } else if ($oba_userbackendsession == '') {

            $data = array();
            $data['error'] = '';
            $this->load->view('adminpanel/login_view', $data);

        }

    }

    public function login_validation() {

        $this->load->library('form_validation');
        $this->form_validation->set_rules('vUserName', 'username', 'required|trim|xss_clean');
        $this->form_validation->set_rules('pPassword', 'password', 'required|trim|xss_clean|callback_username_check');

        if ($this->form_validation->run()) {
            $this->load->model('model_users');
            $userDetail = $this->model_users->get_user_id();   
            $data = array(
                'oba_userbackendsession' => $userDetail["id"],
                'oba_is_logged_inbackendsession' => 1,
                'oba_vUserNamebackendsession' => $userDetail["vUserName"],
                'oba_iUserTypeBackendsession' => $userDetail["iUserType"],
                'oba_iUserTypeNamebackendsession' => $userDetail["vAccTypeName"],
                'oba_vFirstNamebackendsession' => $userDetail["vFirstName"],
                'oba_vLastNamebackendsession' => $userDetail["vLastName"]
            );

            $this->session->set_userdata($data);
            // system log

            $tDes = "log into system";
            $this->common_model->add_log($tDes);
            redirect('adminpanel/managedashboard');

        } else {

            
            $data = array();

            $data['error'] = '';

            $this->load->view('adminpanel/login_view', $data);

        }        
    }

    public function username_check() {

        $this->load->model('model_users');
        if ($this->model_users->can_log()) {

            return true;

        } else {

            $this->form_validation->set_message('username_check', 'Incorect user name or password');
            return false;

        }

    }


    public function logout() {

        
        set_title('Logout');
        $tDes = "Sign out from system";
        $this->common_model->add_log($tDes);


        $array_items = array('oba_vLastNamebackendsession','oba_vFirstNamebackendsession','oba_iUserTypeNamebackendsession','oba_userbackendsession', 'oba_is_logged_inbackendsession', 'oba_iUserTypeBackendsession', 'oba_vUserNamebackendsession');

        $this->session->unset_userdata($array_items);       
        redirect('adminpanel/login');

    }
    
}

?>

