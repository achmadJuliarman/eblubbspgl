<?php

class Bendahara extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		if($this->session->userdata('admin_kategori') != 5 || $this->session->userdata('admin_kategori') != 4)
		{
			echo '<script>alert("Anda tidak dapat mengakses");</script>';
			$this->session->sess_destroy();
			redirect(base_url('login','refresh'));
		}
		$this->load->helper(array('url','form'));
		$this->load->model(array('m_pimpinan','m_bendahara','m_kontrak'));
		$this->load->library(array('format_terbilang'));
	}

	// function index()
	// {
	// 	$data['isi'] = 'admin/dashboard_pimpinan';
	// 	//$data['result'] = $this->m_kontrak->list_kontrak()->result();
	// 	//$data['jumlah'] = $this->m_kontrak->list_kontrak()->num_rows();
	// 	$this->load->view('new/pimpinan_index',$data);
	// }

//---------------BENDAHARA PENERIMAAN--------------

	function bendahara_penerimaan()
	{
		$data['isi'] = 'admin/bendahara_penerimaan_content';
		$data['result'] = $this->m_kontrak->list_termin()->result();
		$data['jumlah'] = $this->m_kontrak->list_termin()->num_rows();
		$this->load->view('new/index',$data);
	}

	function bendahara_realisasi()
	{
		$data['isi'] = 'home/bendahara_realisasi';
		$this->load->view('home/bendahara_index',$data);
	}

	function bendahara_input_po()
	{
		$data['isi'] = 'home/bendahara_input_po';
		$this->load->view('home/bendahara_index',$data);
	}

	function list_ba_po()
	{
		$data['isi'] = 'admin/bendahara_ba_po';
		$data['result'] = $this->m_bendahara->list_ba()->result();
		$this->load->view('new/index',$data);
	}

	function rekap_po()
	{
		$data['isi'] = 'admin/bendahara_rekap_po';
		$data['layanan'] = $this->m_bendahara->list_jenis_layanan()->result();
		$this->load->view('new/index',$data);
	}

	function bendahara_cetak_invoice()
	{
		$id = $this->uri->segment(3);
		$data['result'] = $this->m_bendahara->cetak_invoice_po($id)->row();
		$get = $this->m_bendahara->cetak_invoice_po($id)->row();
		$data['terbilang'] = $this->format_terbilang->terbilang($get->nilai_po);
		$this->load->view('home/bendahara_invoice_po',$data);
	}

	function bendahara_cetak_kwitansi()
	{
		$id = $this->uri->segment(3);
		$data['result'] = $this->m_bendahara->cetak_kwitansi_po($id)->row();
		$get = $this->m_bendahara->cetak_invoice_po($id)->row();
		$data['terbilang'] = $this->format_terbilang->terbilang($get->nilai_po);
		$this->load->view('home/bendahara_kwitansi_po',$data);
	}

	function bendahara_cetak_berita_acara()
	{
		$id = $this->uri->segment(3);
		$data['result'] = $this->m_bendahara->cetak_ba_po($id)->result();
		$this->load->view('home/bendahara_berita_acara_po',$data);
	}

	function bendahara_pindah()
	{
		$id = $this->uri->segment(3);
		$data['isi'] = 'home/bendahara_pindah_po';
		$data['hasil_po'] = $this->m_bendahara->cetak_kwitansi_po($id)->row();
		$this->load->view('home/bendahara_index',$data);
	}

	function detail()
	{
		$id = $this->uri->segment(3);
		$data['result'] = $this->m_bendahara->detail($id)->result();
		$data['sample'] = $this->m_bendahara->jumlah_sample($id)->row();
		$data['isi'] = 'home/bendahara_rekap_detail_po';
		$this->load->view('home/bendahara_index',$data);
	}

	// function bendahara_pindah_operasional()
	// {
	// 	$id = $this->uri->segment(3);
	// 	$data['result'] = $this->m_bendahara->pindah_operasional($id);
	// 	echo '<script>alert("Data Berhasil Disimpan!");</script>';
	// 	redirect('home/bendahara_list_po','refresh');
	// }

	function bendahara_pindah_operasional()
	{
		$id = addslashes($this->input->post('id'));
		$keterangan = addslashes($this->input->post('keterangan'));
		//$no_lab = addslashes($this->input->post('no_lab'));
		$tgl_sertifikat = addslashes($this->input->post('tgl_sertifikat'));
		$no_sertifikat = addslashes($this->input->post('no_sertifikat'));
		$data['result'] = $this->m_bendahara->pindah_operasional($id,$keterangan,$no_sertifikat,$tgl_sertifikat);
		echo '<script>alert("Data Berhasil Disimpan!");</script>';
		redirect('home/bendahara_list_po','refresh');
	}

}
?>
