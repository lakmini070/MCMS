<?php


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Frontend_model extends CI_Model {
    
    function __construct()
    {
        parent::__construct();
       //$this->load->helper('file');
        $this->load->library('email');
        $this->load->database();
        $this->load->model('Frontend_model');
    }


 

    

    

}

