<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_product');
		$this->load->library(array('template', 'form_validation'));
	}

	public function index()
	{
		$data['title'] 		= 'Master Produk';
		$data['subtitle']	= 'Tambah produk';
		
		$this->template->adminTemplate('backEnd/products/form', $data);
	}

}

/* End of file Product.php */
/* Location: ./application/controllers/Product.php */