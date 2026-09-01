<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class NonTeachingStaff extends CI_Controller { 

    function __construct() {
        parent::__construct();
        		$this->load->database();
                $this->load->library('session');
    }


    public function index (){
		
		
		$user_array = ['accountant', 'librarian','hostel','hrm'];
		for ($i=0; $i < sizeof($user_array); $i++){
			$user_list = $this->db->get($user_array[$i])->num_rows();
		}
		$count_notice = $user_list;
		$config = array();
		$config = manager($count_notice, 9 );
		$config['base_url']  = base_url().'nonTeachingStaff/index/';
		$this->pagination->initialize($config);
		$page_data['per_page']    = $config['per_page'];
		
        $this->load->view('frontend/non_teaching', $page_data);
    }
}