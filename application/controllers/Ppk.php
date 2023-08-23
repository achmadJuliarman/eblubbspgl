<?php

class Ppk extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		if($this->session->userdata('admin_kategori') != 7)
		{
			echo '<script>alert("Anda tidak dapat mengakses");</script>';
			$this->session->sess_destroy();
			redirect(base_url('login','refresh'));
		}
		$this->load->helper(array('url','form'));
		$this->load->model(array('m_pimpinan','m_bendahara','m_kontrak'));
		$this->load->library(array('format_terbilang','format_tanggal'));
	}

	// function index()
	// {
	// 	$data['isi'] = 'admin/dashboard_pimpinan';
	// 	//$data['result'] = $this->m_kontrak->list_kontrak()->result();
	// 	//$data['jumlah'] = $this->m_kontrak->list_kontrak()->num_rows();
	// 	$this->load->view('new/pimpinan_index',$data);
	// }

//---------------BENDAHARA PENERIMAAN--------------

	function index()
	{
		$data['isi'] = 'ppk/content';
		$data['result'] = $this->m_kontrak->list_pengajuan()->result();
		$data['jumlah'] = $this->m_kontrak->list_pengajuan()->num_rows();
		$data['result_kontrak'] = $this->m_kontrak->list_termin_pembayaran()->result();
		$this->load->view('new_design/index',$data);
	}

	function rkakl()
	{
		$data['isi'] = 'ppk/content_rkakl';
		$data['result_rkakl'] = $this->m_kontrak->list_pengajuan_rkakl()->result();
		$data['jumlah_rkakl'] = $this->m_kontrak->list_pengajuan_rkakl()->num_rows();
		$data['result_kontrak'] = $this->m_kontrak->list_termin_pembayaran()->result();
		$this->load->view('new_design/index',$data);
	}

	function approve()
	{
		$id_pengajuan = $this->uri->segment(3);
		$status = $this->uri->segment(4);
		$tanggal = DATE("Y-m-d");
		$this->db->query("UPDATE pengajuan SET status_pengajuan=$status WHERE id_pengajuan=$id_pengajuan");
		echo '<script>alert("Data Berhasil Disimpan");</script>';
		redirect('ppk','refresh');
	}

	function tolak()
	{
		$id_pengajuan	= addslashes($this->input->post('id_pengajuan'));
		$keterangan_tolak	= addslashes($this->input->post('keterangan_tolak'));
		$this->db->query("UPDATE pengajuan SET status_pengajuan=2,keterangan_tolak='$keterangan_tolak' WHERE id_pengajuan=$id_pengajuan");
		echo '<script>alert("Data Berhasil Disimpan");</script>';
		redirect('ppk','refresh');
	}

	function tolakrkakl()
	{
		$id_pengajuan	= addslashes($this->input->post('id_pengajuan'));
		$keterangan_tolak	= addslashes($this->input->post('keterangan_tolak'));
		$this->db->query("UPDATE pengajuan_rkakl SET status_pengajuan=2,keterangan_tolak='$keterangan_tolak' WHERE id_pengajuan=$id_pengajuan");
		echo '<script>alert("Data Berhasil Disimpan");</script>';
		redirect('ppk','refresh');
	}

	function approve_rkakl()
	{
		$id_pengajuan = $this->uri->segment(3);
		$status = $this->uri->segment(4);
		$tanggal = DATE("Y-m-d");
		$this->db->query("UPDATE pengajuan_rkakl SET status_pengajuan=$status WHERE id_pengajuan=$id_pengajuan");
		echo '<script>alert("Data Berhasil Disimpan");</script>';
		redirect('ppk','refresh');
	}

	function detail_kontrak()
	{
		$id_kontrak	= $this->uri->segment(3);
		$data['result'] = $this->db->query("SELECT k.id_kontrak,k.nama_kontrak,k.nilai_kontrak,rl.nama AS rumah_layanan,p2.nama AS pejabat_teknis,dl.nama_layanan,p.nama AS pic,k.tgl_ttd,k.tgl_mulai,k.tgl_akhir,k.keterangan,k.file  FROM kontrak AS k
																				INNER JOIN rumah_layanan AS rl ON k.id_rumah_layanan = rl.id_rumah_layanan
																				INNER JOIN detail_layanan AS dl ON k.id_jasa = dl.id_detail
																				INNER JOIN perusahaan AS per ON k.id_perusahaan = per.id_perusahaan
																				INNER JOIN pegawai2 AS p ON k.pic = p.id
																				INNER JOIN pegawai2 AS p2 ON rl.id_pegawai = p2.id
																				WHERE k.id_kontrak = $id_kontrak")->row();
		$data['isi'] = 'admin/ppk_detail_kontrak';
		$this->load->view('new/index',$data);
	}

	function detail_rkakl()
	{
		$id_rkakl	= $this->uri->segment(3);
		$data['result'] = $this->m_kontrak->pilih_rkakl($id_rkakl);
		$data['result_rkakl'] = $this->db->query("SELECT rkakl.id_rkakl,rkakl.keterangan,rkakl.jumlah,rkakl.tahun,rkakl.id_layanan,a.kode,a.nama_akun FROM detail_rkakl AS dr INNER JOIN rkakl ON dr.id_rkakl = rkakl.id_rkakl INNER JOIN akun AS a ON dr.akun = a.id_akun WHERE dr.id_rkakl = $id_rkakl ORDER BY a.id_akun")->result();
		$data['jumlah'] = $this->db->query("SELECT rkakl.id_rkakl,rkakl.keterangan,rkakl.jumlah,rkakl.tahun,rkakl.id_layanan,a.kode,a.nama_akun FROM detail_rkakl AS dr INNER JOIN rkakl ON dr.id_rkakl = rkakl.id_rkakl INNER JOIN akun AS a ON dr.akun = a.id_akun WHERE dr.id_rkakl = $id_rkakl ORDER BY a.id_akun")->num_rows();
		$data['isi'] = 'admin/ppk_detail_rkakl';
		$this->load->view('new/index',$data);
	}

	function edit_pengajuan()
	{
		$id_pengajuan	= $this->input->post('id_pengajuan');
		$jumlah	= $this->input->post('jumlah');
			$data=array(
			 'jumlah'=> $jumlah
		 );
				$this->db->where('id_pengajuan', $id_pengajuan);
				$this->db->update('pengajuan', $data);
				echo '<script>alert("Data Berhasil Disimpan");</script>';
				redirect('ppk','refresh');
	}

	function edit_pengajuan_rkakl()
	{
		$id_pengajuan	= $this->input->post('id_pengajuan');
		$jumlah	= $this->input->post('jumlah');
			$data=array(
			 'jumlah'=> $jumlah
		 );
				$this->db->where('id_pengajuan', $id_pengajuan);
				$this->db->update('pengajuan_rkakl', $data);
				echo '<script>alert("Data Berhasil Disimpan");</script>';
				redirect('ppk/rkakl','refresh');
	}

}
?>
