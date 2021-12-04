<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


//class Header_helper {
if (!function_exists('set_title')) {

    function set_title($title) {
        $ci = & get_instance();
        $ci->header_title = $title;
    }

}

if (!function_exists('get_title')) {

    function get_title() {
        $ci = & get_instance();
        return $ci->header_title;
    }

}



if (!function_exists('get_last_activity')) {

    function get_last_activity() {

        $ci = & get_instance();
        $ci->load->database();
        $sql = "SELECT
Max(tbl_logs.dDateTime) as time
FROM
tbl_logs";

        $result = $ci->db->query($sql);
        if ($result->num_rows() > 0) {
            $ret = $result->row();
            return $ret->time;
        } else {
            return NULL;
        }
    }

}

if (!function_exists('get_shedule_data')) {

    function get_shedule_data($shedule_id) {

        $ci = & get_instance();
        $ci->load->database();
        $sql = "SELECT * FROM `tbl_appointment` WHERE `iShedule_id`=".$shedule_id."";
        $result = $ci->db->query($sql);
        if ($result->num_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }

}


if (!function_exists('invoice_detail_tot'))
{
    function invoice_detail_tot($inv_id) {
        		
        $ci =& get_instance();
        $ci->load->database();
        $sql = "SELECT sum(`fPrice`) as sumval FROM `tbl_invoice_detail` WHERE `iInvoiceId`= '$inv_id'";
		$result = $ci->db->query($sql);
        if ($result->num_rows() > 0) {
        return $result->result();                        
        }else{
        return array();
        } 
        }      
}


if (!function_exists('load_user_profile_pic'))
{
    function load_user_profile_pic($id) {
        		
        $ci =& get_instance();
        $ci->load->database();

        $sql = "SELECT
tbl_user.fProfilePic
FROM
tbl_user
WHERE
tbl_user.id = '$id'
";
        $result = $ci->db->query($sql);
        if ($result->num_rows() > 0) {
                $ret = $result->row();
                return $ret->fProfilePic;
        }else{
            return NULL;
        } 
    }
}


if (!function_exists('get_current_appointment_count'))
{
    function get_current_appointment_count($id) {
        		
        $ci =& get_instance();
        $ci->load->database();

        $sql = "SELECT count(`iShedule_id`) as num_appointments FROM `tbl_appointment` WHERE `iShedule_id`= '$id' and `cEnable`= 'Y'";
        $result = $ci->db->query($sql);
        if ($result->num_rows() > 0) {
                $ret = $result->row();
                return $ret->num_appointments;
        }else{
            return NULL;
        } 
    }
}




?>
