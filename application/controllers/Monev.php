<?php

class Monev extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		if($this->session->userdata('admin_kategori') != 10)
		{
			$this->session->sess_destroy();
			redirect(base_url("login"));
		}
		$this->load->helper(array('url','form'));
		$this->load->model(array('m_pimpinan','m_bendahara','m_kontrak'));
		$this->load->library(array('format_terbilang'));
	}

	function index()
	{
		$data['isi'] = 'admin/dashboard_monev';
		$this->load->view('new/pimpinan_index',$data);
	}

}
?>
