<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_admin');
	}

	public function index()
	{
		$this->cekLogin();

		if($this->input->post('login') == 'Login')
		{
			$user = $this->input->post('username', TRUE);
			$pass = $this->input->post('password', TRUE);

			$cek  = $this->m_admin->get_where('as_users', array('username' => $user));

			if ($cek->num_rows() > 0) 
			{
			 	$data = $cek->row();

			 	if(password_verify($pass, $data->password)){
			 		$dataUser = array(
			 			'userID'=> $data->userID,
			 			'user'  => $data->fullname,
			 			'level' => $data->level,
			 			'login'	=> TRUE
			 		);
			 		$this->session->set_userdata($dataUser);
			 		redirect('admin');
			 	}
			 	else{
			 		$this->session->set_flashdata('fail', 'Password yang anda masukan salah!');
			 	}
			} 

			else {
			 	$this->session->set_flashdata('fail', 'Email tidak terdaftar!');
			} 
		}


		$this->load->view('backEnd/admin/login');
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('login');
	}

	public function cekLogin()
	{
		if($this->session->userdata('userID')){
			redirect('admin');
		}
	}

}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */