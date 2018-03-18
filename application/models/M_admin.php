<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_admin extends CI_Model {

	public function insert($table = '', $data = '')
	{
		$this->db->insert($table, $data);
		return $this->db->insert_id();		
	}	

	public function get_all($table = '')
	{
		$this->db->from($table);
		return $this->db->get();
	}

	public function get_where($table = null, $where = null)
	{
		$this->db->from($table);
		$this->db->where($where);

		return $this->db->get();
	}

	public function update($table = null, $data = null, $where = null)
	{
		$this->db->update($table, $data, $where);
	}

}

/* End of file M_admin.php */
/* Location: ./application/models/M_admin.php */