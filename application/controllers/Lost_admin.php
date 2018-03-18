<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lost_admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_admin');
		$this->load->library('form_validation');
	}

	public function index()
	{
		if($this->input->post('submit', TRUE) == 'SUBMIT')
		{
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');

			if($this->form_validation->run() == TRUE)
			{
				$getData = $this->m_admin->get_where('as_users', array('email' => $this->input->post('email', TRUE)));

				if($getData->num_rows() > 0){
					//prosess

					$this->load->library('email');

					$config['charset']			= 'utf-8';
					$config['useragent']		= 'BoxStore';
					$config['protocol']			= 'smtp';
					$config['mailtype']			= 'html';
					$config['smtp_host']		= 'ssl://smtp.gmail.com';
					$config['smtp_port']		= '465';
					$config['smtp_timeout'] = '5';
					$config['smtp_user']		= 'setiawan.youngin@gmail.com';
					$config['smtp_pass']		= 'bismillah77';
					$config['crlf']					= "\r\n";
					$config['newline']			= "\r\n";
					$config['wordwrap']			= TRUE;

					$this->email->initialize($config);
					$key = md5(md5(time()));

					$this->email->from('setiawan.youngin@gmail.com', "BoxStore");
					$this->email->to($this->input->post('email', TRUE));
					$this->email->subject('Reset Password');
					$this->email->message(
						'Apakah anda lupa dengan password anda? silahkan klik <a href="'.base_url().'lost_admin/reset/'.$key.'">disini</a>.<br> jika anda tidak merasa request fitur ini silahkan abaikan pesan ini'
					);

					if($this->email->send())
					{
						$data['reset']	= $key;
						$cond['email']	= $this->input->post('email', TRUE);

						$this->m_admin->update('as_users', $data, $cond);
						$this->session->set_flashdata('success', 'Email berhasil dikirim... silahkan cek email anda');
					}
					else{
						$this->session->set_flashdata('fail', 'Email gagal dikirim... silahkan coba lagi.');
					}

				}
				else{
					$this->session->set_flashdata('fail', 'Email yang anda masukan tidak terdaftar!');
				}

			}
		}


		$this->load->view('backEnd/admin/lost_password');		
	}

	public function reset()
	{
		if($this->uri->segment(3)){

			if($this->input->post('submit', TRUE) == 'SUBMIT')
			{
				$this->form_validation->set_rules('newPassword', 'Password Baru', 'required|min_length[5]');
				$this->form_validation->set_rules('rePassword', 'Re-Password', 'required|matches[newPassword]');

				if($this->form_validation->run() == TRUE)
				{
					$pass = $this->input->post('newPassword', TRUE);
					$data['password']	= password_hash($pass, PASSWORD_DEFAULT, ['cost' => 10]);
					$data['reset']		= '';

					$cond['reset'] = $this->uri->segment(3);
					$this->m_admin->update('as_users', $data, $cond);

					echo '<script>
									alert("Password berhasil diupdate, silahkan lakukan login kembali");
									window.location.replace("'.base_url().'login")
								</script>';			
				}
			}

			$this->load->view('backEnd/admin/form_reset');
		}
		else{
			redirect('lost_admin');
		}
	}

}

/* End of file Lost_admin.php */
/* Location: ./application/controllers/Lost_admin.php */