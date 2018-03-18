<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->cekLogin();
		$this->load->model('m_admin');
		$this->load->library(array('template', 'form_validation'));
	}

	public function index()
	{
		
		$this->template->adminTemplate('backEnd/dashboard');
	}

	public function profile()
	{
		$data['title']		= 'Profile';
		$data['subtitle']	= 'Edit Profile';

		if($this->input->post('simpan') == 'SIMPAN')
		{
			$this->form_validation->set_rules('fullname', 'Nama Lengkap', "required|trim|min_length[3]|regex_match[/^[a-z A-Z.']+$/]");
			$this->form_validation->set_rules('username', 'Username', 'required|trim|min_length[3]');
			$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
			$this->form_validation->set_rules('password', 'Password', 'required');

			if($this->form_validation->run() == TRUE)
			{
				$ID  = $this->session->userdata('userID');
				$get = $this->m_admin->get_where('as_users', array('userID' => $ID))->row();

				if(!password_verify($this->input->post('password', TRUE), $get->password))
				{
				$data['alertSweet'] = '<script>
																swal({
															    title: "Oops!!",
															    text: "Password yang anda masukan salah",
															    icon: "warning",
															    dangerMode: true,
															  })

															  .then(redirect => {
															    if (redirect) {
															      window.location.replace("'.base_url().'login/logout");
															    }
															  });
															</script>';

				}
				else{

					$config['upload_path']		= './assets/backEnd/dist/img/';
					$config['allowed_types']	= 'jpg|png|jpeg';
					$config['max_size']				= '2048';
					$config['file_name']			= 'gambar'.time();

					$this->load->library('upload', $config);

					$dataUser = array(
						'fullname'	=> $this->input->post('fullname', TRUE),
						'address'		=> $this->input->post('address', TRUE),
						'cellphone'	=> $this->input->post('cellphone', TRUE),
						'cellphone'	=> $this->input->post('cellphone', TRUE),
						'email'			=> $this->input->post('email', TRUE)
					);

					if($this->upload->do_upload('foto')){
						$gbr = $this->upload->data();
						//process update

						unlink('assets/backEnd/dist/img/'.$this->input->post('old_pic', TRUE));
						$dataUser['foto']	= $gbr['file_name'];

						$this->m_admin->update('as_users', $dataUser, array('userID' => $ID));
						$this->session->set_flashdata('success', 'Data berhasil di update');
					}
					else{
						$this->m_admin->update('as_users', $dataUser, array('userID' => $ID));
						$this->session->set_flashdata('success', 'Data berhasil di update');
					}

					

					// $this->m_admin->update('as_users', $dataUser, array('userID' => $ID));
					// $this->session->set_flashdata('success', 'Data berhasil di update');
				}

			}

		}

		$userID  = $this->session->userdata('userID');
		$getData = $this->m_admin->get_where('as_users', array('userID' => $userID))->row();

		$data['fullname'] 	= $getData->fullname;
		$data['username']		= $getData->username;
		$data['address']		= $getData->address;
		$data['email']			= $getData->email;
		$data['cellphone']	= $getData->cellphone;
		$data['foto']				= $getData->foto;

		$this->template->adminTemplate('backEnd/admin/edit_profile', $data);
	}

	public function edit_password()
	{
		$data['title']		= 'Edit Password';
		$data['subtitle']	= '';

		if($this->input->post('submit', TRUE) == 'SUBMIT')
		{
			$this->form_validation->set_rules('newPassword', 'Password Baru', 'required');
			$this->form_validation->set_rules('password', 'Password Lama', 'required');

			if($this->form_validation->run() == TRUE)
			{
				$ID  = $this->session->userdata('userID');
				$get = $this->m_admin->get_where('as_users', array('userID' => $ID))->row();

				if(!password_verify($this->input->post('password', TRUE), $get->password))
				{
					$data['alertSweet'] = '<script>
																swal({
															    title: "Oops!!",
															    text: "Password yang anda masukan salah",
															    icon: "warning",
															    dangerMode: true,
															  })

															  .then(redirect => {
															    if (redirect) {
															      window.location.replace("'.base_url().'admin/edit_password");
															    }
															  });
															</script>';

				}
				else
				{
					$pass = $this->input->post('newPassword');
					$dataPassword['password']	= password_hash($pass, PASSWORD_DEFAULT, ['cost' => 10]);

					$this->m_admin->update('as_users', $dataPassword, array('userID' => $ID));
					echo '<script>
									alert("Password berhasil diupdate, silahkan lakukan login kembali");
									window.location.replace("'.base_url().'login/logout")
								</script>';


				}


			}

		}


		$this->template->adminTemplate('backEnd/admin/edit_password', $data);
	}


	public function cekLogin()
	{
		if(!$this->session->userdata('userID')){
			redirect('login');
		}
	}

}

/* End of file Admin.php */
/* Location: ./application/controllers/Admin.php */