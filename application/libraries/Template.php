<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Template
{
	protected $ci;

	public function __construct()
	{
        $this->ci =& get_instance();
	}

	public function adminTemplate($template, $data='')
	{
		$data['content'] = $this->ci->load->view($template, $data, TRUE);
		$data['nav']		 = $this->ci->load->view('backEnd/nav', $data, TRUE);

		$this->ci->load->view('backEnd/template', $data);
	}

	

}

/* End of file Template.php */
/* Location: ./application/libraries/Template.php */
