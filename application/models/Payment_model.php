<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Payment_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function pay($invoice_id) {

      $checker = array(
        'invoice_id' => $invoice_id
      );

      $updater = array(
        'due' => 0,
        'amount_paid' => $this->db->get_where('invoice', array('invoice_id' => $invoice_id))->row()->amount_paid + $this->db->get_where('invoice', array('invoice_id' => $invoice_id))->row()->due,
        'creation_timestamp' => strtotime(date("m/d/Y")),
        'payment_method' => '2',
        'status' => 'paid',
		'year' => get_settings('session')
      );
      $this->db->where($checker);
      $this->db->update('invoice', $updater);
    }

}
