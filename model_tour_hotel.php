<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_tour_hotel extends CI_Model {
	
	var $table = 'hotel_booking';
	
	public function insert(){
		$unique_id = unique_id($this->table);
		$data = array(
			'unique_id'			=> $unique_id,
			'tour_hotel_name'   => $this->input->post('tour_hotel_name'),
            'tour_country_id'   => $this->input->post('tour_country_id'),
            'tour_city_id'      => $this->input->post('tour_city_id'),
			'sort'              => $this->input->post('sort'),
            'date_added'        => date('YmdHis'),
            'added_by'          => $this->session->userdata('admin_id'),
            'last_modified'     => date('YmdHis'),
            'modified_by'       => $this->session->userdata('admin_id'),
			'flag'				=> $this->input->post('flag'),
			'flag_memo'			=> $this->input->post('flag_memo')
		);
		$this->db->insert($this->table, $data);
			
		// Query for log :)
		$row = $this->db->order_by($this->table . '_id', 'asc')->get_where($this->table, array('unique_id' => $data['unique_id']))->row_array();
		
		action_log('ADD', $this->table, $row['unique_id'], $row[$this->table. '_name'], 'ADDED ' . $this->table. ' ( ' . $row[$this->table. '_name'] . ' ) ');
	}
	
	public function update(){
        $data = array(
			'unique_id'			=> $this->input->post('id'),
			'tour_hotel_name'    => $this->input->post('tour_hotel_name'),
            'tour_country_id'   => $this->input->post('tour_country_id'),
            'tour_city_id'      => $this->input->post('tour_city_id'),
			'sort'              => $this->input->post('sort'),
            'last_modified'     => date('YmdHis'),
            'modified_by'       => $this->session->userdata('admin_id'),
			'flag'				=> $this->input->post('flag'),
			'flag_memo'			=> $this->input->post('flag_memo')
		);
		// Kalo ada, kita update aja :)
		$this->db->where($this->table . '_id', $this->input->post('id'));
		$this->db->update($this->table, $data);
		
		$row = $this->db->get_where($this->table, array('unique_id' => $this->input->post('id')))->row_array();
		if($row['flag'] != 3){
			action_log('UPDATE', $this->table, $row['unique_id'], $row[$this->table . '_name'], 'MODIFY ' . $this->table . ' ( ' . $row[$this->table . '_name'] . ' ) ');
		} else {
			action_log('DELETE', $this->table, $row['unique_id'], $row[$this->table . '_name'], 'DELETED ' . $this->table . ' ( ' . $row[$this->table . '_name'] . ' ) ');
		}
	}

    public function package_data($item_id){
	    $this->db->select("
	        booking_detail.dp_date_payment, 
	        booking_detail.dp_reference, 
	        booking_detail.dp_number, 
	        booking_detail.full_date_payment, 
	        booking_detail.full_reference, 
	        booking_detail.full_number, 
	        booking_detail.payment_number, 
	        booking_detail.payment_status
	    ");
	    $this->db->join('booking_detail','booking.booking_id = booking_detail.booking_id');
	    $this->db->join('package_booking','booking_detail.item_id = package_booking.package_booking_id');
	    $this->db->join('package_product','package_booking.package_product_id = package_product.package_product_id');
	    $this->db->where('booking.flag','1');
	    $this->db->where('booking_detail.item_type','5');
	    $this->db->where('booking.booking_id',$item_id);
	    $result = $this->db->get('booking')->row_array();
	    // pre($result);
	    return $result;
	}
}