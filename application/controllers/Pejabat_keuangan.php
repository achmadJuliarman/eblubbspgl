<?php

class Pejabat_keuangan extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		if($this->session->userdata('admin_kategori') != 8)
		{
			echo '<script>alert("Anda tidak dapat mengakses");</script>';
			$this->session->sess_destroy();
			redirect(base_url('login','refresh'));
		}
		$this->load->helper(array('url','form'));
		$this->load->model(array('m_kontrak'));
		$this->load->library(array('format_terbilang','format_tanggal'));
	}

	function index()
	{
		$data['isi'] = 'pejabatkeuangan/content';
		$data['result'] = $this->m_kontrak->list_kontrak()->result();
		$data['jumlah'] = $this->m_kontrak->list_kontrak()->num_rows();
		$this->load->view('new_design/index',$data);
	}

	function approve()
	{
		$id_kontrak	= $this->uri->segment(3);
		$status_ro	= $this->uri->segment(4);
		$approve_time = DATE("Y-m-d H:i:s");
		$data = array(
			 'status_ro' => $status_ro,
			 'approve_time' => $approve_time
		);
		$this->db->where('id_kontrak', $id_kontrak);
		$this->db->update('kontrak', $data);
		echo '<script>alert("Data Berhasil Disimpan");</script>';
		redirect('pejabat_keuangan', 'refresh');
	}

}
?>
