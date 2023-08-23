<?php

class New_home extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		//$this->load->model(array('m_sejarah','m_artikel','m_wi','m_testimonial','m_event','m_diklat','m_galeri','m_home','m_display','m_agenda','m_saran','m_peserta','m_diklat','m_gebyar','m_slider','m_instansi','m_pengumuman'));
	}

	function index()
	{
		$data['isi'] = 'new/content';
		$this->load->view('new/index',$data);
	}

	function search()
	{
		$data['isi'] = 'new/search';
		$this->load->view('new/index',$data);
	}

	function login()
	{
		//$data['isi'] = 'new/login';
		$this->load->view('new/login');
	}

	function registrasi()
	{
		//$data['isi'] = 'new/login';
		$this->load->view('new/registrasi');
	}

	function kartu_peserta()
	{
		$data['isi'] = 'new/kartu_peserta';
		$this->load->view('new/index',$data);
	}

	function status()
	{
		$data['isi'] = 'new/status';
		$this->load->view('new/index',$data);
	}

	function profile()
	{
		$data['isi'] = 'new/profile';
		$this->load->view('new/index',$data);
	}

	function edit_profile()
	{
		$data['isi'] = 'new/edit_profile';
		$this->load->view('new/index',$data);
	}

}
?>
