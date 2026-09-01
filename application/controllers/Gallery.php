<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Gallery extends CI_Controller { 

    function __construct() {
        parent::__construct();
        		$this->load->database();
                $this->load->library('session');
    }


    public function index (){
		
		$count_notice = $this->db->get('gallery')->num_rows();
		$config = array();
		$config = manager($count_notice, 9 );
		$config['base_url']  = base_url().'gallery/index/';
		$this->pagination->initialize($config);
		$page_data['per_page']    = $config['per_page'];
		
        $this->load->view('frontend/gallery', $page_data);
    }
	
	
	function details($gallery_id = null){
	  $page_data['gallery_id'] = $gallery_id;
	  $page_data['gallery_details'] = $this->db->get_where('galleryimagearray', array('gallery_id' => $gallery_id))->result_array();
	  $this->load->view('frontend/gallery_details', $page_data);
	
	}
	
	
}