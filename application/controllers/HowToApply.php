<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class howToApply extends CI_Controller { 

    function __construct() {
        parent::__construct();
        		$this->load->database();
                $this->load->library('session');
    }


    public function index (){
        $this->load->view('frontend/how_to_apply');
    }
}