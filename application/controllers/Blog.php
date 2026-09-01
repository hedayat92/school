<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Blog extends CI_Controller { 

    function __construct() {
        parent::__construct();
        		$this->load->database();
                $this->load->library('session');
				$this->load->model('event_model');	
    }


    public function index (){

		$count_notice = $this->db->get('news')->num_rows();
		$config = array();
		$config = manager($count_notice, 2 );
		$config['base_url']  = base_url().'blog/index/';
		$this->pagination->initialize($config);
		$page_data['per_page']    = $config['per_page'];


        $this->load->view('frontend/blog', $page_data);
    }
	
	
	function details($slug = null){
	  $page_data['news_details'] = $this->db->get_where('news', array('slug' => $slug))->row();
	  $this->load->view('frontend/blog_details', $page_data);
	
	}
	
}