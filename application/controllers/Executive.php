<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Executive extends CI_Controller { 

    function __construct() {
        parent::__construct();
        		$this->load->database();
                $this->load->library('session');
    }


    public function index (){
		
		$count_notice = $this->db->get('executive')->num_rows();
		$config = array();
		$config = manager($count_notice, 9 );
		$config['base_url']  = base_url().'executive/index/';
		$this->pagination->initialize($config);
		$page_data['per_page']    = $config['per_page'];
		
        $this->load->view('frontend/executive', $page_data);
    }
}