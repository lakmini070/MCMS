<?php



if (!defined('BASEPATH'))

    exit('No direct script access allowed');

/*

 * This library class used for view data from flexigrid edit ,change status and delete from flexigrid.

  */



Class Common_library {



    public function __construct() {

        $this->ci = & get_instance();        

        $this->ci->load->model('common_model');

        log_message('debug', "Common Class Initialized");

    }

}
?>

