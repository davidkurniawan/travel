<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_data extends CI_Model{
	function tampil_data(){
		return $this->db->get('master_national');
	}
 
	function input_data($data,$table){
		$this->db->insert_batch($data,$table);
	}
}