<?php

class Program extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('admin_kategori') != 2) {
			echo '<script>alert("Anda tidak dapat mengakses");</script>';
			$this->session->sess_destroy();
			redirect(base_url('login', 'refresh'));
		}
		$this->load->helper(array('url', 'form'));
		$this->load->model(array('M_pimpinan', 'm_bendahara', 'm_kontrak'));
		$this->load->library(array('format_terbilang', 'format_tanggal', 'api_bios'));
	}

	function index()
	{
		$id_satker = $this->session->userdata('admin_id_satker');
		$bulan = DATE("m");
		$tahun = DATE("Y");
		$data['isi'] = 'program/content';
		//$data['isi'] = 'admin/afin_content';
		$data['adendum'] = $this->db->query("SELECT * FROM adendum WHERE YEAR(tgl_adendum) = $tahun GROUP BY id_kontrak")->num_rows();
		$data['expired'] = $this->db->query("SELECT * FROM kontrak WHERE MONTH(tgl_akhir) = $bulan AND YEAR(tgl_akhir) = $tahun AND STATUS='K'")->num_rows();
		$data['result'] = $this->m_kontrak->list_kontrak()->result();
		$data['jumlah_kontrak'] = $this->m_kontrak->list_kontrak()->num_rows();
		$data['jumlah'] = $this->m_kontrak->list_kontrak()->num_rows();
		//$this->load->view('new/index',$data);
		$this->load->view('new_design/index', $data);
	}

	function inbox()
	{
		$data['isi'] = 'admin/inbox';
		//$data['result'] = $this->m_kontrak->list_kontrak()->result();
		//$data['jumlah'] = $this->m_kontrak->list_kontrak()->num_rows();
		$this->load->view('new/index', $data);
	}

	//-----------RUMAH LAYANAN--------------

	function rumah_layanan()
	{
		$id_satker = $this->session->userdata('admin_id_satker');
		$data['isi'] = 'admin/program_rumah_layanan';
		$data['result'] = $this->m_kontrak->list_rumah_layanan()->result();
		$data['jumlah'] = $this->m_kontrak->list_rumah_layanan()->num_rows();
		$data['result_pegawai'] = $this->m_kontrak->list_pejabat_teknis()->result();
		$this->load->view('new/index', $data);
	}

	function input_rumah_layanan()
	{
		$id_satker = $this->session->userdata('admin_id_satker');
		$nama	= $this->input->post('nama');
		$kode	= $this->input->post('kode');
		$id_pegawai	= $this->input->post('id_pegawai');
		$data = array(
			'id_satker' => $id_satker,
			'nama' => $nama,
			'kode' => $kode,
			'id_pegawai' => $id_pegawai
		);
		$this->db->insert('rumah_layanan', $data);
		echo '<script>alert("Data Berhasil Disimpan");</script>';
		redirect('program/rumah_layanan', 'refresh');
	}

	function edit_rumah_layanan()
	{
		date_default_timezone_set('Asia/Jakarta');
		$id_rumah_layanan	= $this->input->post('id_rumah_layanan');
		$nama	= $this->input->post('nama');
		$kode	= $this->input->post('kode');
		$id_pegawai	= $this->input->post('id_pegawai');
		$data = array(
			'nama' => $nama,
			'kode' => $kode,
			'id_pegawai' => $id_pegawai
		);
		$this->db->where('id_rumah_layanan', $id_rumah_layanan);
		$this->db->update('rumah_layanan', $data);
		echo '<script>alert("Data Berhasil Disimpan");</script>';
		redirect('program/rumah_layanan', 'refresh');
	}

	function hapus_rumah_layanan()
	{
		$id_rumah_layanan	= $this->uri->segment(3);
		$this->db->query("DELETE FROM rumah_layanan WHERE id_rumah_layanan = $id_rumah_layanan");
		echo '<script>alert("Data Berhasil Dihapus");</script>';
		redirect('program/rumah_layanan', 'refresh');
	}

	//-----------JENIS LAYANAN--------------

	function jenis_layanan()
	{
		$id_satker = $this->session->userdata('admin_id_satker');
		$data['isi'] = 'admin/program_jenis_layanan';
		$data['result'] = $this->m_kontrak->list_jenis_layanan()->result();
		$data['rumah_layanan'] = $this->db->query("SELECT * FROM rumah_layanan WHERE id_satker = $id_satker")->result();
		$data['jumlah'] = $this->m_kontrak->list_jenis_layanan()->num_rows();
		$this->load->view('new/index', $data);
	}

	function detail_jenis_layanan()
	{
		$id_layanan	= $this->uri->segment(3);
		$data['result'] = $this->db->query("SELECT * FROM detail_layanan AS dl
																				INNER JOIN jenis_layanan AS jl ON dl.id_layanan = jl.id_jenis_layanan
																				INNER JOIN kategori_layanan AS kl ON dl.id_kategori = kl.id_kategori
																				WHERE dl.id_layanan = $id_layanan")->result();
		$data['datpil'] = $this->db->query("SELECT * FROM jenis_layanan AS dl
																				WHERE id_jenis_layanan = $id_layanan")->row();
		$data['kategori'] = $this->db->query("SELECT * FROM kategori_layanan")->result();
		$data['isi'] = 'admin/program_detail_layanan';
		$this->load->view('new/index', $data);
	}

	function input_jenis_layanan()
	{
		$id_satker = $this->session->userdata('admin_id_satker');
		$id_rumah_layanan	= $this->input->post('id_rumah_layanan');
		$jenis	= $this->input->post('jenis');
		$kode	= $this->input->post('kode');
		$data = array(
			'id_satker' => $id_satker,
			'id_rumah_layanan' => $id_rumah_layanan,
			'jenis' => $jenis,
			'kode' => $kode
		);
		$this->db->insert('jenis_layanan', $data);
		echo '<script>alert("Data Berhasil Disimpan");</script>';
		redirect('program/jenis_layanan', 'refresh');
	}

	function edit_jenis_layanan()
	{
		date_default_timezone_set('Asia/Jakarta');
		$id_jenis_layanan	= $this->input->post('id_jenis_layanan');
		$id_rumah_layanan	= $this->input->post('id_rumah_layanan');
		$jenis	= $this->input->post('jenis');
		$kode	= $this->input->post('kode');
		$data = array(
			'id_rumah_layanan' => $id_rumah_layanan,
			'jenis' => $jenis,
			'kode' => $kode
		);
		$this->db->where('id_jenis_layanan', $id_jenis_layanan);
		$this->db->update('jenis_layanan', $data);
		echo '<script>alert("Data Berhasil Disimpan");</script>';
		redirect('program/jenis_layanan', 'refresh');
	}

	function hapus_jenis_layanan()
	{
		$id_jenis_layanan	= $this->uri->segment(3);
		$this->db->query("DELETE FROM jenis_layanan WHERE id_jenis_layanan = $id_jenis_layanan");
		echo '<script>alert("Data Berhasil Dihapus");</script>';
		redirect('program/jenis_layanan', 'refresh');
	}

	function input_detail_layanan()
	{
		$id_satker = $this->session->userdata('admin_id_satker');
		$id_layanan	= $this->input->post('id_layanan');
		$nama_layanan	= $this->input->post('nama_layanan');
		$kode_layanan	= $this->input->post('kode_layanan');
		$id_kategori	= $this->input->post('id_kategori');
		$data = array(
			'id_satker' => $id_satker,
			'id_layanan' => $id_layanan,
			'id_kategori' => $id_kategori,
			'nama_layanan' => $nama_layanan,
			'kode_layanan' => $kode_layanan
		);
		$this->db->insert('detail_layanan', $data);
		echo '<script>alert("Data Berhasil Disimpan");</script>';
		redirect('program/detail_jenis_layanan/' . $id_layanan, 'refresh');
	}

	function edit_detail_layanan()
	{
		date_default_timezone_set('Asia/Jakarta');
		$id_detail	= $this->input->post('id_detail');
		$id_layanan	= $this->input->post('id_layanan');
		$nama_layanan	= $this->input->post('nama_layanan');
		$kode_layanan	= $this->input->post('kode_layanan');
		$id_kategori	= $this->input->post('id_kategori');
		$data = array(
			'id_kategori' => $id_kategori,
			'nama_layanan' => $nama_layanan,
			'kode_layanan' => $kode_layanan
		);
		$this->db->where('id_detail', $id_detail);
		$this->db->update('detail_layanan', $data);
		echo '<script>alert("Data Berhasil Disimpan");</script>';
		redirect('program/detail_jenis_layanan/' . $id_layanan, 'refresh');
	}

	function hapus_detail_layanan()
	{
		$id_layanan	= $this->uri->segment(3);
		$id_detail_layanan	= $this->uri->segment(4);
		$this->db->query("DELETE FROM detail_layanan WHERE id_detail = $id_detail_layanan");
		echo '<script>alert("Data Berhasil Dihapus");</script>';
		redirect('program/detail_jenis_layanan/' . $id_layanan, 'refresh');
	}


	//-----------KODE PENERIMAAN--------------

	function kode_penerimaan()
	{
		$data['isi'] = 'admin/program_kode_penerimaan';
		$data['result'] = $this->m_kontrak->list_kode_penerimaan()->result();
		$data['jumlah'] = $this->m_kontrak->list_kode_penerimaan()->num_rows();
		$this->load->view('new/index', $data);
	}

	function input_kode_penerimaan()
	{
		$nama_akun	= $this->input->post('nama_akun');
		$kode	= $this->input->post('kode');
		$data = array(
			'nama_akun' => $nama_akun,
			'kode' => $kode
		);
		$cek = $this->db->query("SELECT * FROM akun_penerimaan WHERE kode='$kode'")->num_rows();
		if ($cek > 0) {
			echo '<script>alert("Kode Akun Sudah Ada");</script>';
			redirect('program/kode_penerimaan', 'refresh');
		} else {
			$this->db->insert('akun_penerimaan', $data);
			echo '<script>alert("Data Berhasil Disimpan");</script>';
			redirect('program/kode_penerimaan', 'refresh');
		}
	}

	function edit_kode_penerimaan()
	{
		$id_akun	= $this->input->post('id_akun');
		$nama_akun	= $this->input->post('nama_akun');
		//$kode	= $this->input->post('kode');
		$data = array(
			'nama_akun' => $nama_akun
			//'kode'=> $kode
		);
		//$cek = $this->db->query("SELECT * FROM akun_penerimaan WHERE kode='$kode'")->num_rows();
		// if ($cek > 0)
		// {
		//  echo '<script>alert("Kode Akun Sudah Ada");</script>';
		//  redirect('program/kode_penerimaan','refresh');
		// }
		// else
		// {
		$this->db->where('id_akun', $id_akun);
		$this->db->update('akun_penerimaan', $data);
		echo '<script>alert("Data Berhasil Disimpan");</script>';
		redirect('program/kode_penerimaan', 'refresh');
		//}
	}

	function hapus_kode_penerimaan()
	{
		$id_akun	= $this->uri->segment(3);
		$this->db->query("DELETE FROM akun_penerimaan WHERE id_akun = $id_akun");
		echo '<script>alert("Data Berhasil Dihapus");</script>';
		redirect('program/kode_penerimaan', 'refresh');
	}


	//-----------TARGET PENERIMAAN--------------

	function target()
	{
		$tahun	= addslashes($this->input->post('tahun'));
		if ($tahun == "") {
			$pilih_tahun = DATE('Y');
		} else {
			$pilih_tahun = $tahun;
		}
		$data['isi'] = 'admin/program_target';
		$data['rumah_layanan'] = $this->m_kontrak->list_rumah_layanan()->result();
		$data['result'] = $this->m_kontrak->list_target_tahun($pilih_tahun)->result();
		$data['jumlah'] = $this->m_kontrak->list_target_tahun($pilih_tahun)->num_rows();
		$this->load->view('new/index', $data);
	}

	function input_target()
	{
		$id_rumah_layanan	= $this->input->post('id_rumah_layanan');
		$jumlah	= $this->input->post('jumlah');
		$tahun = DATE("Y");
		$data = array(
			'id_rumah_layanan' => $id_rumah_layanan,
			'jumlah' => $jumlah,
			'tahun' => $tahun
		);
		$cek = $this->db->query("SELECT * FROM target WHERE id_rumah_layanan='$id_rumah_layanan' AND tahun = $tahun")->num_rows();
		if ($cek > 0) {
			echo '<script>alert("Target Pelaksana Layanan Sudah Ada");</script>';
			redirect('program/target', 'refresh');
		} else {
			$this->db->insert('target', $data);
			echo '<script>alert("Data Berhasil Disimpan");</script>';
			redirect('program/target', 'refresh');
		}
	}

	function edit_target()
	{
		$id_target	= $this->input->post('id_target');
		$jumlah	= $this->input->post('jumlah');
		$data = array(
			'jumlah' => $jumlah
		);
		$this->db->where('id_target', $id_target);
		$this->db->update('target', $data);
		echo '<script>alert("Data Berhasil Disimpan");</script>';
		redirect('program/target', 'refresh');
	}

	function hapus_target()
	{
		$id_target	= $this->uri->segment(3);
		$this->db->query("DELETE FROM target WHERE id_target = $id_target");
		echo '<script>alert("Data Berhasil Dihapus");</script>';
		redirect('program/target', 'refresh');
	}


	//-----------KODE AKUN--------------

	function kode_akun()
	{
		$data['isi'] = 'admin/program_kode_akun';
		$data['result'] = $this->m_kontrak->list_kode_akun()->result();
		$data['jumlah'] = $this->m_kontrak->list_kode_akun()->num_rows();
		$this->load->view('new/index', $data);
	}

	function input_kode_akun()
	{
		$nama_akun	= $this->input->post('nama_akun');
		$kode	= $this->input->post('kode');
		$data = array(
			'nama_akun' => $nama_akun,
			'kode' => $kode
		);
		$cek = $this->db->query("SELECT * FROM akun WHERE kode='$kode'")->num_rows();
		if ($cek > 0) {
			echo '<script>alert("Kode Akun Sudah Ada");</script>';
			redirect('program/kode_akun', 'refresh');
		} else {
			$this->db->insert('akun', $data);
			echo '<script>alert("Data Berhasil Disimpan");</script>';
			redirect('program/kode_akun', 'refresh');
		}
	}

	function edit_kode_akun()
	{
		$id_akun	= $this->input->post('id_akun');
		$nama_akun	= $this->input->post('nama_akun');
		//$kode	= $this->input->post('kode');
		$data = array(
			'nama_akun' => $nama_akun
			//'kode'=> $kode
		);
		//$cek = $this->db->query("SELECT * FROM akun WHERE kode='$kode'")->num_rows();
		// if ($cek > 0)
		// {
		//  echo '<script>alert("Kode Akun Sudah Ada");</script>';
		//  redirect('program/kode_akun','refresh');
		// }
		// else
		// {
		$this->db->where('id_akun', $id_akun);
		$this->db->update('akun', $data);
		echo '<script>alert("Data Berhasil Disimpan");</script>';
		redirect('program/kode_akun', 'refresh');
		//}
	}

	function hapus_kode_akun()
	{
		$id_akun	= $this->uri->segment(3);
		$this->db->query("DELETE FROM akun WHERE id_akun = $id_akun");
		echo '<script>alert("Data Berhasil Dihapus");</script>';
		redirect('program/kode_akun', 'refresh');
	}


	//-----------PEGAWAI--------------

	function pegawai()
	{
		$data['isi'] = 'admin/program_pegawai';
		$data['result'] = $this->m_kontrak->list_pegawai()->result();
		$data['jumlah'] = $this->m_kontrak->list_pegawai()->num_rows();
		$data['jabatan'] = $this->m_kontrak->list_jabatan()->result();
		$data['kategori'] = $this->m_kontrak->list_kategori()->result();
		$this->load->view('new/index', $data);
	}

	function input_pegawai()
	{
		$id_satker = $this->session->userdata('admin_id_satker');
		$nip	= $this->input->post('nip');
		$nama	= $this->input->post('nama');
		$id_jabatan	= $this->input->post('id_jabatan');
		$id_kategori	= $this->input->post('id_kategori');
		$data = array(
			'id_satker' => $id_satker,
			'nip' => $nip,
			'nama' => $nama,
			'id_jabatan' => $id_jabatan,
			'id_kategori' => $id_kategori
		);
		$cek = $this->db->query("SELECT * FROM pegawai2 WHERE nip='$nip'")->num_rows();
		if ($cek > 0) {
			echo '<script>alert("NIP Sudah Ada");</script>';
			redirect('program/pegawai', 'refresh');
		} else {
			$this->db->insert('pegawai2', $data);
			echo '<script>alert("Data Berhasil Disimpan");</script>';
			redirect('program/pegawai', 'refresh');
		}
	}

	function edit_pegawai()
	{
		$nip	= $this->input->post('nip');
		$nama	= $this->input->post('nama');
		$id_jabatan	= $this->input->post('id_jabatan');
		$id_kategori	= $this->input->post('id_kategori');
		$id	= $this->input->post('id');
		$data = array(
			'nip' => $nip,
			'nama' => $nama,
			'id_jabatan' => $id_jabatan,
			'id_kategori' => $id_kategori
		);
		$this->db->where('id', $id);
		$this->db->update('pegawai2', $data);
		echo '<script>alert("Data Berhasil Disimpan");</script>';
		redirect('program/pegawai', 'refresh');
	}

	function hapus_pegawai()
	{
		$id	= $this->uri->segment(3);
		$this->db->query("DELETE FROM pegawai2 WHERE id = $id");
		echo '<script>alert("Data Berhasil Dihapus");</script>';
		redirect('program/pegawai', 'refresh');
	}

	//-----------JABATAN--------------

	function jabatan()
	{
		$data['isi'] = 'admin/program_jabatan';
		$data['result'] = $this->m_kontrak->list_jabatan()->result();
		$data['jumlah'] = $this->m_kontrak->list_jabatan()->num_rows();
		$this->load->view('new/index', $data);
	}

	function input_jabatan()
	{
		$jabatan	= $this->input->post('jabatan');
		$data = array(
			'jabatan' => $jabatan
		);
		$this->db->insert('jabatan', $data);
		echo '<script>alert("Data Berhasil Disimpan");</script>';
		redirect('program/jabatan', 'refresh');
	}

	function edit_jabatan()
	{
		date_default_timezone_set('Asia/Jakarta');
		$id_jabatan	= $this->input->post('id_jabatan');
		$jabatan	= $this->input->post('jabatan');
		$data = array(
			'jabatan' => $jabatan
		);
		$this->db->where('id_jabatan', $id_jabatan);
		$this->db->update('jabatan', $data);
		echo '<script>alert("Data Berhasil Disimpan");</script>';
		redirect('program/jabatan', 'refresh');
	}

	function hapus_jabatan()
	{
		$id_jabatan	= $this->uri->segment(3);
		$cek = $this->db->query("SELECT * FROM pegawai2 WHERE id_jabatan='$id_jabatan'")->num_rows();
		if ($cek > 0) {
			echo '<script>alert("Jabatan Tidak Bisa Dihapus");</script>';
			redirect('program/jabatan', 'refresh');
		} else {
			$this->db->query("DELETE FROM jabatan WHERE id_jabatan = $id_jabatan");
			echo '<script>alert("Data Berhasil Dihapus");</script>';
			redirect('program/jabatan', 'refresh');
		}
	}

	//-----------USER--------------

	function user()
	{
		$data['isi'] = 'admin/program_user';
		$data['result'] = $this->m_kontrak->list_user()->result();
		$data['jumlah'] = $this->m_kontrak->list_user()->num_rows();
		$data['pegawai'] = $this->m_kontrak->list_pegawai()->result();
		$data['kategori_user'] = $this->m_kontrak->list_kategori_user()->result();
		$this->load->view('new/index', $data);
	}

	function input_user()
	{
		$username	= $this->input->post('username');
		$password	= md5($this->input->post('password'));
		$id_pegawai	= $this->input->post('id_pegawai');
		$kategori	= $this->input->post('kategori');
		$is_kontrak	= $this->input->post('is_kontrak');
		$data = array(
			'username' => $username,
			'password' => $password,
			'id_pegawai' => $id_pegawai,
			'is_kontrak' => $is_kontrak,
			'kategori' => $kategori
		);
		$cek_username = $this->db->query("SELECT * FROM user WHERE username='$username'")->num_rows();
		$cek_pegawai = $this->db->query("SELECT * FROM user WHERE id_pegawai='$id_pegawai'")->num_rows();
		if ($cek_username > 0) {
			echo '<script>alert("Username Sudah Terdaftar");</script>';
			redirect('program/user', 'refresh');
		} elseif ($cek_pegawai > 0) {
			echo '<script>alert("Pegawai Sudah Terdaftar");</script>';
			redirect('program/user', 'refresh');
		} else {
			$this->db->insert('user', $data);
			echo '<script>alert("Data Berhasil Disimpan");</script>';
			redirect('program/user', 'refresh');
		}
	}

	function edit_user()
	{
		$id_user	= $this->input->post('id_user');
		//$username	= $this->input->post('username');
		$id_pegawai	= $this->input->post('id_pegawai');
		$kategori	= $this->input->post('kategori');
		$is_kontrak	= $this->input->post('is_kontrak');
		$data = array(
			//'username'=> $username,
			'id_pegawai' => $id_pegawai,
			'is_kontrak' => $is_kontrak,
			'kategori' => $kategori
		);
		//$cek = $this->db->query("SELECT * FROM user WHERE username='$username' AND id_pegawai='$id_pegawai'")->num_rows();
		$cek = $this->db->query("SELECT id_pegawai FROM user WHERE id_user='$id_user'")->row();
		$cek_pegawai = $this->db->query("SELECT * FROM user WHERE id_pegawai='$id_pegawai'")->num_rows();
		if ($cek->id_pegawai == $id_pegawai) {
			$this->db->where('id_user', $id_user);
			$this->db->update('user', $data);
			echo '<script>alert("Data Berhasil Disimpan");</script>';
			redirect('program/user', 'refresh');
		} else {
			if ($cek_pegawai > 0) {
				echo '<script>alert("Pegawai Sudah Terdaftar");</script>';
				redirect('program/user', 'refresh');
			} else {
				$this->db->where('id_user', $id_user);
				$this->db->update('user', $data);
				echo '<script>alert("Data Berhasil Disimpan");</script>';
				redirect('program/user', 'refresh');
			}
		}
	}

	function reset_password()
	{
		$id_user	= $this->uri->segment(3);
		$password	= rand(10, 1000000);
		$new_password	= md5($password);
		$data = array(
			'password' => $new_password
		);
		$this->db->where('id_user', $id_user);
		$this->db->update('user', $data);
		echo '<script>alert("Password Baru : ' . $password . '");</script>';
		redirect('program/user', 'refresh');
	}

	function hapus_user()
	{
		$id_user	= $this->uri->segment(3);
		$this->db->query("DELETE FROM user WHERE id_user = $id_user");
		echo '<script>alert("Data Berhasil Dihapus");</script>';
		redirect('program/user', 'refresh');
	}

	//-----------TERMIN--------------

	function input_termin()
	{
		date_default_timezone_set('Asia/Jakarta');
		$id_kontrak	= $this->input->post('id_kontrak');
		$termin	= $this->input->post('termin');
		$tgl_termin	= $this->input->post('tgl_termin');
		$jumlah	= $this->input->post('jumlah');
		$data = array();
		$total = 0;
		$cek = $this->db->query("SELECT * FROM kontrak WHERE id_kontrak=$id_kontrak")->row();
		foreach ($termin as $key => $val) {
			$data[] = array(
				'id_kontrak' => $id_kontrak,
				'termin' => $termin[$key],
				'tgl_termin' => $tgl_termin[$key],
				'jumlah' => $jumlah[$key]
			);
			$total = $total + $jumlah[$key];
			if ($tgl_termin[$key] < $cek->tgl_mulai) {
				echo '<script>alert("Tanggal kurang dari tanggal kontrak");</script>';
				redirect('program/setting_kontrak/' . $id_kontrak, 'refresh');
			} elseif ($tgl_termin[$key] > $cek->tgl_akhir) {
				echo '<script>alert("Tanggal melebihi tanggal kontrak");</script>';
				redirect('program/setting_kontrak/' . $id_kontrak, 'refresh');
			}
		}

		if ($total > $cek->nilai_kontrak) {
			echo '<script>alert("Jumlah Termin Melebihi Nilai Kontrak");</script>';
			redirect('program/setting_kontrak/' . $id_kontrak, 'refresh');
		} else {
			$this->db->insert_batch('termin', $data);
			echo '<script>alert("Data Berhasil Disimpan");</script>';
			redirect('program/setting_kontrak/' . $id_kontrak, 'refresh');
		}
	}

	function edit_termin()
	{
		date_default_timezone_set('Asia/Jakarta');
		$id_kontrak	= $this->input->post('id_kontrak');
		$id_termin	= $this->input->post('id_termin');
		$tgl_termin	= $this->input->post('tgl_termin');
		$jumlah	= $this->input->post('jumlah');
		//echo $id_kontrak;echo $id_termin;echo $tgl_termin;echo $jumlah;
		$cek = $this->db->query("SELECT * FROM kontrak WHERE id_kontrak=$id_kontrak")->row();
		$sum = $this->db->query("SELECT SUM(jumlah) AS total FROM termin WHERE id_kontrak = $id_kontrak AND id_termin <> $id_termin")->row();
		$total = $jumlah + $sum->total;
		if ($tgl_termin < $cek->tgl_mulai) {
			echo '<script>alert("Tanggal kurang dari tanggal kontrak");</script>';
			redirect('program/setting_kontrak/' . $id_kontrak, 'refresh');
		} elseif ($tgl_termin > $cek->tgl_akhir) {
			echo '<script>alert("Tanggal melebihi tanggal kontrak");</script>';
			redirect('program/setting_kontrak/' . $id_kontrak, 'refresh');
		}

		if ($total > $cek->nilai_kontrak) {
			echo '<script>alert("Jumlah Termin Melebihi Nilai Kontrak");</script>';
			redirect('program/setting_kontrak/' . $id_kontrak, 'refresh');
		} else {
			$this->db->query("UPDATE termin SET tgl_termin='$tgl_termin',jumlah=$jumlah WHERE id_termin=$id_termin");
			echo '<script>alert("Data Berhasil Disimpan");</script>';
			redirect('program/setting_kontrak/' . $id_kontrak, 'refresh');
		}
	}

	function pengajuan_pembayaran()
	{
		$tahun = DATE("Y");
		$id_kontrak	= $this->uri->segment(3);
		$id_termin	= $this->uri->segment(4);
		$urutan = $this->db->query("SELECT COUNT(id_termin) AS jumlah FROM termin WHERE no_invoice IS NOT NULL")->row();
		$nomor = $urutan->jumlah + 1;
		if ($nomor < 10) {
			$nomor = "00" . $nomor;
		} elseif ($nomor = 10 && $nomor < 100) {
			$nomor = "0" . $nomor;
		} elseif ($nomor = 100 && $nomor < 1000) {
			$nomor = $nomor;
		}
		$kode_rumah_layanan = $this->db->query("SELECT kode FROM rumah_layanan WHERE id_rumah_layanan=(SELECT id_rumah_layanan FROM kontrak WHERE id_kontrak =$id_kontrak)")->row();
		$kode_detail_layanan = $this->db->query("SELECT kode_layanan FROM detail_layanan WHERE id_detail=(SELECT id_jasa FROM kontrak WHERE id_kontrak =$id_kontrak)")->row();
		$kode_kontrak = $this->db->query("SELECT status FROM kontrak WHERE id_kontrak =$id_kontrak")->row();
		$no_invoice = $nomor . "/" . $kode_rumah_layanan->kode . "/" . $kode_kontrak->status . "/" . $kode_detail_layanan->kode_layanan . "/" . $tahun;
		$this->db->query("UPDATE termin SET status_termin=1,no_invoice='$no_invoice' WHERE id_termin=$id_termin");
		echo '<script>alert("Data Berhasil Disimpan");</script>';
		redirect('program/setting_kontrak/' . $id_kontrak, 'refresh');
	}

	function hapus_termin()
	{
		$id_kontrak	= $this->uri->segment(3);
		$id_termin	= $this->uri->segment(4);
		$this->db->query("DELETE FROM termin WHERE id_termin = $id_termin");
		echo '<script>alert("Data Berhasil Dihapus");</script>';
		redirect('program/setting_kontrak/' . $id_kontrak, 'refresh');
	}

	//-----------ANGGOTA TIM--------------

	function input_anggota()
	{
		$id_kontrak	= $this->input->post('id_kontrak');
		$id_pegawai	= $this->input->post('id_pegawai');
		$data = array(
			'id_kontrak' => $id_kontrak,
			'id_pegawai' => $id_pegawai
		);
		$this->db->insert('personil', $data);
		echo '<script>alert("Data Berhasil Disimpan");</script>';
		redirect('program/setting_kontrak/' . $id_kontrak, 'refresh');
	}


	//------------TIMELINE KEGIATAN--------------

	function input_timeline()
	{
		$id_kontrak	= $this->input->post('id_kontrak');
		$termin	= $this->input->post('termin');
		$cek = $this->db->query("SELECT * FROM termin WHERE id_termin = $termin")->row();
		$cek_kontrak = $this->db->query("SELECT * FROM kontrak WHERE id_kontrak = $id_kontrak")->row();
		$tgl_mulai	= $this->input->post('tgl_mulai');
		$tgl_akhir	= $this->input->post('tgl_akhir');
		if ($tgl_akhir > $cek->tgl_termin) {
			echo '<script>alert("Tanggal Akhir melebihi tanggal akhir termin");</script>';
			redirect('program/setting_kontrak/' . $id_kontrak, 'refresh');
		} else {
			if ($tgl_mulai < $cek_kontrak->tgl_mulai) {
				echo '<script>alert("Tanggal Mulai kurang dari tanggal mulai kontrak");</script>';
				redirect('program/setting_kontrak/' . $id_kontrak, 'refresh');
			} else {
				if ($tgl_mulai > $tgl_akhir) {
					echo '<script>alert("Tanggal Akhir lebih kecil dari tanggal Mulai");</script>';
					redirect('program/setting_kontrak/' . $id_kontrak, 'refresh');
				} else {
					$nama_kegiatan	= htmlspecialchars($this->input->post('nama_kegiatan', TRUE), ENT_QUOTES);
					$data = array(
						'id_kontrak' => $id_kontrak,
						'termin' => $termin,
						'tgl_mulai' => $tgl_mulai,
						'tgl_akhir' => $tgl_akhir,
						'nama_kegiatan' => $nama_kegiatan
					);
					$this->db->insert('kegiatan', $data);
					echo '<script>alert("Data Berhasil Disimpan");</script>';
					redirect('program/setting_kontrak/' . $id_kontrak, 'refresh');
				}
			}
		}
	}

	function edit_timeline()
	{
		$id_kontrak	= $this->input->post('id_kontrak');
		$id_kegiatan	= $this->input->post('id_kegiatan');
		$termin	= $this->input->post('termin');
		$id_termin	= $this->input->post('id_termin');
		$cek = $this->db->query("SELECT * FROM termin WHERE id_termin = $id_termin")->row();
		$cek_kontrak = $this->db->query("SELECT * FROM kontrak WHERE id_kontrak = $id_kontrak")->row();
		$tgl_mulai	= $this->input->post('tgl_mulai');
		$tgl_akhir	= $this->input->post('tgl_akhir');
		// $cek->tgl_termin;
		if ($tgl_akhir > $cek->tgl_termin) {
			echo '<script>alert("Tanggal Akhir melebihi tanggal akhir termin");</script>';
			redirect('program/setting_kontrak/' . $id_kontrak, 'refresh');
		} else {
			if ($tgl_mulai < $cek_kontrak->tgl_mulai) {
				echo '<script>alert("Tanggal Mulai kurang dari tanggal mulai kontrak");</script>';
				redirect('program/setting_kontrak/' . $id_kontrak, 'refresh');
			} else {
				if ($tgl_mulai > $tgl_akhir) {
					echo '<script>alert("Tanggal Akhir lebih kecil dari tanggal Mulai");</script>';
					redirect('program/setting_kontrak/' . $id_kontrak, 'refresh');
				} else {
					$nama_kegiatan	= htmlspecialchars($this->input->post('nama_kegiatan', TRUE), ENT_QUOTES);
					$data = array(
						'id_kontrak' => $id_kontrak,
						'termin' => $termin,
						'tgl_mulai' => $tgl_mulai,
						'tgl_akhir' => $tgl_akhir,
						'nama_kegiatan' => $nama_kegiatan
					);
					$this->db->where('id_kegiatan', $id_kegiatan);
					$this->db->update('kegiatan', $data);
					echo '<script>alert("Data Berhasil Disimpan");</script>';
					redirect('program/setting_kontrak/' . $id_kontrak, 'refresh');
				}
			}
		}
	}

	function hapus_timeline()
	{
		$id_kontrak	= $this->uri->segment(3);
		$id_kegiatan	= $this->uri->segment(4);
		$this->db->query("DELETE FROM kegiatan WHERE id_kegiatan = $id_kegiatan");
		echo '<script>alert("Data Berhasil Dihapus");</script>';
		redirect('program/setting_kontrak/' . $id_kontrak, 'refresh');
	}

	//-----------RENCANA OPERASIONAL--------------


	function input_ro()
	{
		$id_kontrak	= $this->input->post('id_kontrak');
		$id_kegiatan	= $this->input->post('id_kegiatan');
		$biaya	= $this->input->post('biaya');
		$akun	= $this->input->post('akun');
		$data = array(
			'id_kontrak' => $id_kontrak,
			'id_kegiatan' => $id_kegiatan,
			'biaya' => $biaya,
			'akun' => $akun
		);
		$max_kontrak = $this->db->query("SELECT nilai_kontrak FROM kontrak WHERE id_kontrak = $id_kontrak")->row();
		$max_akun = $this->db->query("SELECT SUM(biaya) AS biaya FROM rencana_operasional WHERE id_kontrak = $id_kontrak")->row();
		$max_operasional = $this->db->query("SELECT max_operasional FROM kontrak WHERE id_kontrak = $id_kontrak")->row();
		$usulan = (($biaya + $max_akun->biaya) / $max_kontrak->nilai_kontrak) * 100;
		//if ($usulan > 70)
		if ($usulan > $max_operasional->max_operasional) {
			echo '<script>alert("Melebihi Maksimal Operasional");</script>';
			redirect('program/setting_kontrak/' . $id_kontrak, 'refresh');
		} else {
			$this->db->insert('rencana_operasional', $data);
			echo '<script>alert("Data Berhasil Disimpan");</script>';
			redirect('program/setting_kontrak/' . $id_kontrak, 'refresh');
		}
	}

	function detail_ro()
	{
		$id_kontrak	= $this->uri->segment(3);
		$akun	= $this->uri->segment(4);
		$data['result'] = $this->m_kontrak->pilih_kontrak($id_kontrak);
		$data['result_ro'] = $this->db->query("SELECT ro.id_ro,ro.id_kontrak,ro.keterangan,ro.biaya,a.kode,a.nama_akun,ro.akun,k.nama_kegiatan FROM rencana_operasional AS ro INNER JOIN akun AS a ON ro.akun = a.id_akun INNER JOIN kegiatan AS k on ro.id_kegiatan = k.id_kegiatan WHERE ro.id_kontrak = $id_kontrak AND akun = $akun ORDER BY a.id_akun")->result();
		$data['isi'] = 'program/detail_ro';
		$this->load->view('new_design/index', $data);
	}

	function edit_ro()
	{
		$id_kontrak	= $this->input->post('id_kontrak');
		$id_ro	= $this->input->post('id_ro');
		$akun	= $this->input->post('akun');
		$biaya	= $this->input->post('biaya');
		$data = array(
			'biaya' => $biaya
		);
		$max_kontrak = $this->db->query("SELECT nilai_kontrak FROM kontrak WHERE id_kontrak = $id_kontrak")->row();
		$max_akun = $this->db->query("SELECT SUM(biaya) AS biaya FROM rencana_operasional WHERE id_kontrak = $id_kontrak")->row();
		//$usulan = (($biaya+$max_akun->biaya)/$max_kontrak->nilai_kontrak)*100;
		$usulan = ($biaya / $max_kontrak->nilai_kontrak) * 100;
		if ($usulan > 70) {
			echo '<script>alert("Melebihi 70%");</script>';
			redirect('program/detail_ro/' . $id_kontrak . '/' . $akun, 'refresh');
		} else {
			$this->db->where('id_ro', $id_ro);
			$this->db->update('rencana_operasional', $data);
			echo '<script>alert("Data Berhasil Disimpan");</script>';
			redirect('program/detail_ro/' . $id_kontrak . '/' . $akun, 'refresh');
		}
	}

	function hapus_ro()
	{
		$id	= $this->uri->segment(3);
		$id_kontrak	= $this->uri->segment(4);
		$akun	= $this->uri->segment(5);
		$this->db->query("DELETE FROM rencana_operasional WHERE id_ro = $id");
		echo '<script>alert("Data Berhasil Dihapus");</script>';
		redirect('program/detail_ro/' . $id_kontrak . '/' . $akun, 'refresh');
	}

	//-----------PENGAJUAN RO--------------


	function input_pengajuan()
	{
		$id_kontrak	= $this->input->post('id_kontrak');
		$id_ro	= $this->input->post('id_ro');
		$jumlah	= $this->input->post('jumlah');
		$keterangan	= $this->input->post('keterangan');
		$data = array(
			'id_ro' => $id_ro,
			'jumlah' => $jumlah,
			'keterangan' => $keterangan
		);
		$max_pagu = $this->db->query("SELECT biaya FROM rencana_operasional WHERE id_ro = $id_ro")->row();
		$max_akun = $this->db->query("SELECT SUM(jumlah) AS jumlah FROM pengajuan WHERE id_ro = $id_ro")->row();
		$usulan = $jumlah + $max_akun->jumlah;
		if ($usulan > $max_pagu->biaya) {
			echo '<script>alert("Melebihi Pagu");</script>';
			redirect('program/setting_kontrak/' . $id_kontrak, 'refresh');
		} else {
			$this->db->insert('pengajuan', $data);
			echo '<script>alert("Data Berhasil Disimpan");</script>';
			redirect('program/setting_kontrak/' . $id_kontrak, 'refresh');
		}
	}



	//-----------KONTRAK--------------


	function setting_kontrak()
	{
		$id_satker = $this->session->userdata('admin_id_satker');
		$id_kontrak	= $this->uri->segment(3);
		//echo $id_kontrak;
		//$data['isi'] = 'admin/program_detail_kontrak';
		$data['isi'] = 'program/detail_kontrak';
		$data['result'] = $this->m_kontrak->pilih_kontrak($id_kontrak);
		$data['result_termin'] = $this->db->query("SELECT * FROM termin WHERE id_kontrak = $id_kontrak")->result();
		$data['result_anggota'] = $this->db->query("SELECT * FROM personil WHERE id_kontrak = $id_kontrak")->result();
		$data['result_pegawai'] = $this->db->query("SELECT * FROM pegawai2 WHERE id_satker = $id_satker ORDER BY nama")->result();
		$data['result_ro'] = $this->db->query("SELECT * FROM rencana_operasional INNER JOIN akun ON rencana_operasional.akun = akun.id_akun INNER JOIN kegiatan ON rencana_operasional.id_kegiatan = kegiatan.id_kegiatan WHERE rencana_operasional.id_kontrak = $id_kontrak")->result();
		$data['result_pengajuan'] = $this->db->query("SELECT * FROM pengajuan INNER JOIN rencana_operasional ON pengajuan.id_ro = rencana_operasional.id_ro INNER JOIN akun ON rencana_operasional.akun = akun.id_akun INNER JOIN kegiatan ON rencana_operasional.id_kegiatan = kegiatan.id_kegiatan WHERE rencana_operasional.id_kontrak = $id_kontrak")->result();
		$data['jumlah_pengajuan'] = $this->db->query("SELECT * FROM pengajuan INNER JOIN rencana_operasional ON pengajuan.id_ro = rencana_operasional.id_ro INNER JOIN akun ON rencana_operasional.akun = akun.id_akun INNER JOIN kegiatan ON rencana_operasional.id_kegiatan = kegiatan.id_kegiatan WHERE rencana_operasional.id_kontrak = $id_kontrak")->num_rows();
		$data['result_timeline'] = $this->db->query("SELECT *,termin.termin AS termin_kegiatan,kegiatan.termin AS termin_id FROM kegiatan INNER JOIN termin ON kegiatan.termin = termin.id_termin WHERE kegiatan.id_kontrak = $id_kontrak")->result();
		//$data['jumlah'] = $this->m_kontrak->list_kontrak()->num_rows();
		//$this->load->view('new/index',$data);
		$this->load->view('new_design/index', $data);
	}

	function add_kontrak()
	{
		$data['isi'] = 'admin/afin_input_kontrak';
		$data['rumah_layanan'] = $this->m_kontrak->list_rumah_layanan()->result();
		$data['detail_layanan'] = $this->m_kontrak->list_detail_layanan()->result();
		$data['perusahaan'] = $this->m_kontrak->list_perusahaan()->result();
		$data['pegawai'] = $this->m_kontrak->list_pegawai()->result();
		$data['rba'] = $this->m_kontrak->list_rba()->result();
		//$data['jumlah'] = $this->m_kontrak->list_kontrak()->num_rows();
		$this->load->view('new/index', $data);
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
		$data['isi'] = 'detail_kontrak';
		$this->load->view('new_design/index', $data);
	}

	function pilih_kontrak()
	{
		$id_kontrak	= $this->uri->segment(3);
		$data['result'] = $this->m_kontrak->pilih_kontrak($id_kontrak);
		$data['isi'] = 'admin/afin_edit_kontrak';
		$data['rumah_layanan'] = $this->m_kontrak->list_rumah_layanan()->result();
		$data['detail_layanan'] = $this->m_kontrak->list_detail_layanan()->result();
		$data['perusahaan'] = $this->m_kontrak->list_perusahaan()->result();
		$data['pegawai'] = $this->m_kontrak->list_pegawai()->result();
		$data['rba'] = $this->m_kontrak->list_rba()->result();
		//$data['jumlah'] = $this->m_kontrak->list_kontrak()->num_rows();
		$this->load->view('admin/index', $data);
	}

	function upload_sk()
	{

		$id_kontrak	= addslashes($this->input->post('id_kontrak'));
		$uploadpath = './uploads/sk_tim';
		$config['upload_path'] = $uploadpath;
		$config['allowed_types'] = 'pdf';
		$config['max_size']	= '20000';
		//$config['file_name'] = "1SuratTugas";
		$this->upload->initialize($config);
		if (!$this->upload->do_upload('file')) {
			$error = $this->upload->display_errors();
			echo '<script>alert("Data Gagal Disimpan!' . $error . '");</script>';
			redirect('program/setting_kontrak/' . $id_kontrak, 'refresh');
		} else {
			$upload = $this->upload->data();
			$file	= $upload['file_name'];
			$this->db->query("UPDATE kontrak SET file_sk='$file' WHERE id_kontrak=$id_kontrak");
			echo '<script>alert("Data Berhasil disimpan");</script>';
			redirect('program/setting_kontrak/' . $id_kontrak, 'refresh');
		}
	}

	function konfirmasi_progress()
	{
		$id_kegiatan	= $this->uri->segment(3);
		$this->db->query("UPDATE kegiatan SET status = 4 WHERE id_kegiatan = $id_kegiatan");
		echo '<script>alert("Data Berhasil Dikonfirmasi");</script>';
		redirect('inbox/inbox_progress', 'refresh');
	}

	function setting_ro()
	{
		$id_kontrak	= addslashes($this->input->post('id_kontrak'));
		$max_operasional	= addslashes($this->input->post('max_operasional'));
		$persen	= addslashes($this->input->post('persen'));
		if ($persen > $max_operasional) {
			echo '<script>alert("Data Gagal Disimpan. RO melebihi batas maksimal");</script>';
			redirect('program/setting_kontrak/' . $id_kontrak, 'refresh');
		} else {
			$this->db->query("UPDATE kontrak SET max_operasional = $max_operasional WHERE id_kontrak = $id_kontrak");
			echo '<script>alert("Data Berhasil Disimpan");</script>';
			redirect('program/setting_kontrak/' . $id_kontrak, 'refresh');
		}
	}

	function hapus_anggota()
	{
		$id_kontrak	= $this->uri->segment(3);
		$id_personil	= $this->uri->segment(4);
		$this->db->query("DELETE FROM personil WHERE id_personil = $id_personil");
		echo '<script>alert("Data Berhasil Dihapus");</script>';
		redirect('program/setting_kontrak/' . $id_kontrak, 'refresh');
	}

	function rekap_po()
	{
		$data['isi'] = 'admin/program_list_po';
		$data['result'] = $this->m_kontrak->list_po_all()->result();
		$data['jumlah'] = $this->m_kontrak->list_po_all()->num_rows();
		$this->load->view('new/index', $data);
	}

	function rekomendasi()
	{
		$id_satker = $this->session->userdata('admin_id_satker');
		$bulan = DATE("m");
		$tahun = DATE("Y");
		$data['isi'] = 'program/rekomendasi';
		$data['rekomendasi'] = $this->db->query("SELECT * FROM rekomendasi WHERE rekomendasi.id_satker=$id_satker order by 'tahun_rekomendasi' DESC")->result();
		//var_dump($data);
		$this->load->view('new_design/index', $data);
	}
	function input_rekomendasi()
	{
		date_default_timezone_set('Asia/Jakarta');
		$id_satker = $this->session->userdata('admin_id_satker');
		$jumlah_rekomendasi	= addslashes($this->input->post('jumlah_rekomendasi'));
		$tahun_rekomendasi	= addslashes($this->input->post('tahun_rekomendasi'));
		$data = array(
			'id_satker' => $id_satker,
			'jumlah_rekomendasi' => $jumlah_rekomendasi,
			'tahun_rekomendasi' => $tahun_rekomendasi,
		);
		$this->db->insert('rekomendasi', $data);

		$id_user = $this->session->userdata('admin_id');
		$keterangan = "Tambah Rekomendasi Tahun " . $tahun_rekomendasi;
		$data = array(
			'id_user' => $id_user,
			'keterangan' => $keterangan,
			'tanggal' => DATE("Y-m-d H:i:s")
		);
		$this->db->insert('log_history', $data);

		$satker = $this->session->userdata('admin_satker');
		$key = $this->session->userdata('admin_key_satker');
		$id_satker = $this->session->userdata('admin_id_satker');
		$yesterday = strtotime("yesterday");
		$tomorrow = strtotime("tomorrow");
		$url = 'https://bios.kemenkeu.go.id/api/token';
		$data = array(
			'satker' => $satker,
			'key' => $key,
		);
		$response = $this->api_bios->get_content_token($url, json_encode($data));
		$response_token = json_decode($response, true);
		$rekomendasi = array(
			'tgl_transaksi' => date('Y-m-d', $yesterday),
			'jumlah' => $jumlah_rekomendasi
		);
		$url = 'https://bios.kemenkeu.go.id/api/ws/barang_jasa/layanan/rekomendasi_teknis_bidang_minerba';
		$responseLayanan = $this->api_bios->get_content($url, json_encode($rekomendasi), $response_token['token']);
		$response_bios = json_decode($responseLayanan, true);
		if($id_satker == 1){
			$last_status = $response_bios['message'];
			$data = array(
				'last_status' => $last_status,
				'last_updated' => DATE("Y-m-d H:i:s")
			);
			$this->db->where('id_webservice', 11);
			$this->db->update('webservicebios', $data);
		}
		//var_dump($rekomendasi);
		//$tahun = date("Y");
		echo '<script>alert("Data Berhasil Disimpan");</script>';
		redirect('program/rekomendasi', 'refresh');
	}
}
