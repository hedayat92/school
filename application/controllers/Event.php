<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Event extends CI_Controller { 

    function __construct() {
        parent::__construct();
        		$this->load->database();
                $this->load->library('session');
				$this->load->model('event_model');	
    }


    public function index (){
		
		$count_notice = $this->db->get('noticeboard')->num_rows();
		$config = array();
		$config = manager($count_notice, 3 );
		$config['base_url']  = base_url().'event/index/';
		$this->pagination->initialize($config);
		$page_data['per_page']    = $config['per_page'];

        $this->load->view('frontend/events', $page_data);
    }
	
	
	function details($slug = null){
	
	$page_data['event_details'] = $this->db->get_where('noticeboard', array('slug' => $slug))->row();
	$this->load->view('frontend/EventDetails', $page_data);
	
	}

}