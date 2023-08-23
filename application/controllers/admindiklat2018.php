<?php

class Admindiklat2018 extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('format_tanggal');
	}

	function index()
	{
		$this->load->view('admin/login');
	}

	public function do_login()
	{
				$username 		= $this->security->xss_clean($this->input->post('username'));
        $password 		= md5($this->security->xss_clean($this->input->post('password')));
      	$q_cek	= $this->db->query("SELECT * FROM t_user WHERE username = '".$username."' AND password = '".$password."'");

				$j_cek	= $q_cek->num_rows();
				$d_cek	= $q_cek->row();
        if($j_cek == 1)
				{
        		$data = array(
                    'admin_id' => $d_cek->id,
                    'admin_username' => $d_cek->username,
                    'admin_level' => $d_cek->level,
										'admin_valid' => "true"
                    );
            $this->session->set_userdata($data);
						//echo $this->session->userdata('admin_valid');
            redirect(base_url("admin"));
        }
				else
				{
					$this->session->set_flashdata("k", "<div id=\"alert\" class=\"alert alert-error\">username or password is not valid</div>");
					redirect('login');
				}
	}

	public function logout()
	{
      $this->session->sess_destroy();
			redirect('login');
  }

}
?>
