<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class AboutUs extends CI_Controller { 

    function __construct() {
        parent::__construct();
        		$this->load->database();
                $this->load->library('session');
    }


    public function index (){
        $this->load->view('frontend/about_us', $page_data);
    }
}