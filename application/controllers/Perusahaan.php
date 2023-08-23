<?php

class Perusahaan extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		if($this->session->userdata('admin_valid') != "true")
		{
			$this->session->sess_destroy();
			redirect(base_url("login"));
		}
		$this->load->helper(array('url','form'));
		$this->load->model(array('m_pimpinan','m_bendahara','m_kontrak','m_perusahaan'));
		$this->load->library(array('format_terbilang'));
	}

	// function index()
	// {
	// 	$data['isi'] = 'admin/afin_content';
	// 	$this->load->view('admin/index',$data);
	// }

	// function index()
	// {
	// 	$data['isi'] = 'admin/perusahaan_content';
	// 	$data['result'] = $this->m_perusahaan->list_perusahaan()->result();
	// 	$data['jumlah'] = $this->m_perusahaan->list_perusahaan()->num_rows();
	// 	$this->load->view('new/index',$data);
	// }

	function index()
	{
		$data['isi'] = 'client/content';
		$data['result'] = $this->m_perusahaan->list_perusahaan()->result();
		$data['jumlah'] = $this->m_perusahaan->list_perusahaan()->num_rows();
		$this->load->view('new_design/index',$data);
	}

	// function add_perusahaan()
	// {
	// 	$data['isi'] = 'admin/afin_input_perusahaan';
	// 	$data['kategori'] = $this->db->query("SELECT * FROM kategori_client")->result();
	// 	$this->load->view('new/index',$data);
	// }

	function add_perusahaan()
	{
		$data['isi'] = 'client/input_client';
		$data['kategori'] = $this->db->query("SELECT * FROM kategori_client")->result();
		$this->load->view('new_design/index',$data);
	}

	function pilih_perusahaan()
	{
		$id_perusahaan	= $this->uri->segment(3);
		$data['result'] = $this->m_perusahaan->pilih_perusahaan($id_perusahaan);
		$data['kategori'] = $this->db->query("SELECT * FROM kategori_client")->result();
		$data['isi'] = 'client/edit_client';
		$this->load->view('new_design/index',$data);
	}

	function tambah_perusahaan()
	{
		$nama_perusahaan	= addslashes($this->input->post('nama_perusahaan'));
		$alamat	= addslashes($this->input->post('alamat'));
		$no_telp	= addslashes($this->input->post('no_telp'));
		$penanggung_jawab	= addslashes($this->input->post('penanggung_jawab'));
		$bidang_pekerjaan	= addslashes($this->input->post('bidang_pekerjaan'));
		$npwp	= addslashes($this->input->post('npwp'));
		$kategori	= addslashes($this->input->post('kategori'));
		$id_satker = $this->session->userdata('admin_id_satker');
		$cek = $this->db->query("SELECT * FROM perusahaan WHERE npwp = '$npwp'")->num_rows();
		if ($cek > 0)
		{
			echo '<script>alert("Data NPWP / NIK Sudah Ada");</script>';
			redirect('perusahaan', 'refresh');
		}
		else
		{
			$data = array(
				 'alamat' => $alamat,
				 'nama_perusahaan' => $nama_perusahaan,
				 'no_telp' => $no_telp,
				 'penanggung_jawab' => $penanggung_jawab,
				 'npwp' => $npwp,
				 'kategori' => $kategori,
				 'id_satker' => $id_satker,
				 'bidang_pekerjaan' => $bidang_pekerjaan
			);
			//echo $nama_kontrak;
			$this->m_perusahaan->add_perusahaan($data);
			echo '<script>alert("Data Berhasil Disimpan");</script>';
			redirect('perusahaan', 'refresh');
		}
	}

	function edit_perusahaan()
	{
		$id_perusahaan	= addslashes($this->input->post('id_perusahaan'));
		$nama_perusahaan	= addslashes($this->input->post('nama_perusahaan'));
		$alamat	= addslashes($this->input->post('alamat'));
		$no_telp	= addslashes($this->input->post('no_telp'));
		$penanggung_jawab	= addslashes($this->input->post('penanggung_jawab'));
		$bidang_pekerjaan	= addslashes($this->input->post('bidang_pekerjaan'));
		$npwp	= addslashes($this->input->post('npwp'));
		$kategori	= addslashes($this->input->post('kategori'));
		$cek = $this->db->query("SELECT * FROM perusahaan WHERE npwp = '$npwp'")->num_rows();
		if ($cek > 0)
		{
			echo '<script>alert("Data NPWP / NIK Sudah Ada");</script>';
			redirect('perusahaan', 'refresh');
		}
		else
		{
		$data = array(
			 'alamat' => $alamat,
			 'nama_perusahaan' => $nama_perusahaan,
			 'no_telp' => $no_telp,
			 'penanggung_jawab' => $penanggung_jawab,
			 'npwp' => $npwp,
			 'kategori' => $kategori,
			 'bidang_pekerjaan' => $bidang_pekerjaan
		);
		//echo $nama_kontrak;
		$this->m_perusahaan->edit_perusahaan($id_perusahaan,$data);
		echo '<script>alert("Data Berhasil Disimpan");</script>';
		redirect('perusahaan', 'refresh');
		}
	}

	function hapus_perusahaan()
	{
		$id_perusahaan	= $this->uri->segment(3);
		$this->db->query("DELETE FROM perusahaan WHERE id_perusahaan = $id_perusahaan");
		echo '<script>alert("Data Berhasil Dihapus");</script>';
		redirect('perusahaan', 'refresh');
	}

}
?>
