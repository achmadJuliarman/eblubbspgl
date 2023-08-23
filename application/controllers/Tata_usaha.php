<?php

class Tata_usaha extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		if($this->session->userdata('admin_kategori') != 9)
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
		$data['isi'] = 'tata_usaha/content';
		$data['result'] = $this->m_kontrak->list_rkakl()->result();
		$data['jumlah'] = $this->m_kontrak->list_rkakl()->num_rows();
		$this->load->view('new_design/index',$data);
	}

	function list_pengajuan()
	{
		$tahun = DATE("Y");
		$id_rumah_layanan = $this->session->userdata('admin_id_rumah_layanan');
		$data['rkakl'] = $this->m_kontrak->list_detail_rkakl()->result();
		$data['result'] = $this->m_kontrak->list_pengajuan_kp3_non()->result();
		$data['jumlah'] = $this->m_kontrak->list_pengajuan_kp3_non()->num_rows();
		$getkode_kp3 = $this->db->query("SELECT kode FROM rumah_layanan WHERE id_rumah_layanan = $id_rumah_layanan")->row();
		$getkode = $this->db->query("SELECT * FROM pengajuan_rkakl WHERE YEAR(tgl_pengajuan) = $tahun")->num_rows();
		$getkode = $getkode + 1 ;
		if ($getkode < 10)
		{
			$kode = '000'.$getkode;
		}
		else if ($getkode > 9 && $getkode < 100)
		{
			$kode = '00'.$getkode;
		}
		else if ($getkode > 99 && $getkode < 1000)
		{
			$kode = '0'.$getkode;
		}
		else if ($getkode > 999)
		{
			$kode = $getkode;
		}
		$data['no_urut'] = $getkode_kp3->kode."/".$tahun."/".$kode;
		$data['isi'] = 'tata_usaha/pengajuan';
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

	function input_rkakl()
	{
		$id_rkakl	= $this->input->post('id_rkakl');
		$keterangan	= $this->input->post('keterangan');
		$jumlah	= $this->input->post('jumlah');
		$tahun	= DATE("Y");
		$id_pegawai =  $this->session->userdata('admin_id_pegawai');
		$cek = $this->db->query("SELECT id_rumah_layanan FROM rumah_layanan WHERE id_pegawai = $id_pegawai")->row();
		$id_layanan	= $cek->id_rumah_layanan;
			$data=array(
			 'id_rkakl'=> $id_rkakl,
			 'jumlah'=> $jumlah,
			 'tahun'=> $tahun,
			 'keterangan'=> $keterangan,
			 'id_layanan'=> $id_layanan
		 );
			$this->db->insert('rkakl',$data);
			echo '<script>alert("Data Berhasil Disimpan");</script>';
			redirect('tata_usaha','refresh');
	}

	function input_detail_rkakl()
	{
		$id_rkakl	= $this->input->post('id_rkakl');
		$biaya	= $this->input->post('biaya');
		$akun	= $this->input->post('akun');
			$data=array(
			 'id_rkakl'=> $id_rkakl,
			 'biaya'=> $biaya,
			 'akun'=> $akun
		 );
		$cek = $this->db->query("SELECT * FROM detail_rkakl WHERE id_rkakl = $id_rkakl AND akun = $akun")->num_rows();
		if ($cek > 0)
		{
			echo '<script>alert("Kode Akun sudah ada");</script>';
			redirect('tata_usaha/detail_rkakl/'.$id_rkakl,'refresh');
		}
		else
		{
			$max = $this->db->query("SELECT jumlah FROM rkakl WHERE id_rkakl = $id_rkakl")->row();
			$max_akun = $this->db->query("SELECT biaya FROM detail_rkakl WHERE id_rkakl = $id_rkakl")->row();
			$usulan = (($biaya)/$max->jumlah)*100;
			if ($usulan > 70)
			{
				echo '<script>alert("Melebihi 70%");</script>';
				redirect('tata_usaha/detail_rkakl/'.$id_rkakl,'refresh');
			}
			else
			{
				$this->db->insert('detail_rkakl',$data);
				echo '<script>alert("Data Berhasil Disimpan");</script>';
				redirect('tata_usaha/detail_rkakl/'.$id_rkakl,'refresh');
			}
		}
	}

	function input_pengajuan_rkakl()
	{
		$tahun = DATE("Y");
		$id_detail_rkakl	= $this->input->post('id_detail_rkakl');
		$id_rumah_layanan = $this->session->userdata('admin_id_rumah_layanan');
		$jumlah	= $this->input->post('jumlah');
		$keterangan	= htmlspecialchars($this->input->post('keterangan', TRUE), ENT_QUOTES);
		//$no_urut	= $this->input->post('no_urut');
		$getkode_kp3 = $this->db->query("SELECT kode FROM rumah_layanan WHERE id_rumah_layanan = $id_rumah_layanan")->row();
		$getkode = $this->db->query("SELECT * FROM pengajuan_rkakl WHERE YEAR(tgl_pengajuan) = $tahun")->num_rows();
		$getkode = $getkode + 1;
		if ($getkode < 10)
		{
			$kode = '000'.$getkode;
		}
		else if ($getkode > 9 && $getkode < 100)
		{
			$kode = '00'.$getkode;
		}
		else if ($getkode > 99 && $getkode < 1000)
		{
			$kode = '0'.$getkode;
		}
		else if ($getkode > 999)
		{
			$kode = $getkode;
		}
		$no_urut = $getkode_kp3->kode."/RKAKL/".$tahun."/".$kode;
		$tanggal = DATE("Y-m-d");
			$data=array(
			 'id_detail_rkakl'=> $id_detail_rkakl,
			 'jumlah'=> $jumlah,
			 'no_urut'=> $no_urut,
			 'tgl_pengajuan'=> $tanggal,
			 'keterangan'=> $keterangan
		 );
		$max = $this->db->query("SELECT SUM(jumlah) AS total FROM pengajuan_rkakl WHERE id_detail_rkakl = $id_detail_rkakl")->row();
		$max_akun = $this->db->query("SELECT biaya FROM detail_rkakl WHERE id = $id_detail_rkakl")->row();
		$usulan = $jumlah+$max->total;
		if($usulan > $max_akun->biaya)
		{
			echo '<script>alert("Melebihi Pagu");</script>';
			redirect('tata_usaha/list_pengajuan','refresh');
		}
		else
		{
			$this->db->insert('pengajuan_rkakl',$data);
			echo '<script>alert("Data Berhasil Disimpan");</script>';
			redirect('tata_usaha/list_pengajuan','refresh');
		}
	}

	// function input_pengajuan_rkakl()
	// {
	// 	$id_detail_rkakl	= $this->input->post('id_detail_rkakl');
	// 	$no_urut	= $this->input->post('no_urut');
	// 	$jumlah	= $this->input->post('jumlah');
	// 	$keterangan	= $this->input->post('keterangan');
	// 	$tanggal = DATE("Y-m-d");
	// 		$data=array(
	// 		 'id_detail_rkakl'=> $id_detail_rkakl,
	// 		 'no_urut'=> $no_urut,
	// 		 'jumlah'=> $jumlah,
	// 		 'tgl_pengajuan'=> $tanggal,
	// 		 'keterangan'=> $keterangan
	// 	 );
 	// 	$max = $this->db->query("SELECT SUM(jumlah) AS total FROM pengajuan_rkakl WHERE id_detail_rkakl = $id_detail_rkakl")->row();
 	// 	$max_akun = $this->db->query("SELECT biaya FROM detail_rkakl WHERE id = $id_detail_rkakl")->row();
 	// 	$usulan = $jumlah+$max->total;
	// 	if($usulan > $max_akun->biaya)
	// 	{
	// 		echo '<script>alert("Melebihi Pagu");</script>';
	// 		redirect('tata_usaha/list_pengajuan','refresh');
	// 	}
	// 	else
	// 	{
	// 		$this->db->insert('pengajuan_rkakl',$data);
	// 		echo '<script>alert("Data Berhasil Disimpan");</script>';
	// 		redirect('tata_usaha/list_pengajuan','refresh');
	// 	}
	// }

	function hapus_pengajuan_rkakl()
	{
		$id_pengajuan	= $this->uri->segment(3);
		$this->db->query("DELETE FROM pengajuan_rkakl WHERE id_pengajuan = $id_pengajuan");
		echo '<script>alert("Data Berhasil Dihapus");</script>';
		redirect('tata_usaha/list_pengajuan','refresh');
	}

	function detail_rkakl()
	{
		$id_rkakl	= $this->uri->segment(3);
		//$akun	= $this->uri->segment(4);
		$data['result'] = $this->m_kontrak->pilih_rkakl($id_rkakl);
		$data['result_rkakl'] = $this->db->query("SELECT dr.id AS id_rkakl,rkakl.id_rkakl,rkakl.keterangan,rkakl.jumlah,rkakl.tahun,rkakl.id_layanan,a.kode,a.nama_akun FROM detail_rkakl AS dr INNER JOIN rkakl ON dr.id_rkakl = rkakl.id_rkakl INNER JOIN akun AS a ON dr.akun = a.id_akun WHERE dr.id_rkakl = $id_rkakl ORDER BY a.id_akun")->result();
		$data['jumlah'] = $this->db->query("SELECT rkakl.id_rkakl,rkakl.keterangan,rkakl.jumlah,rkakl.tahun,rkakl.id_layanan,a.kode,a.nama_akun FROM detail_rkakl AS dr INNER JOIN rkakl ON dr.id_rkakl = rkakl.id_rkakl INNER JOIN akun AS a ON dr.akun = a.id_akun WHERE dr.id_rkakl = $id_rkakl ORDER BY a.id_akun")->num_rows();
		$data['isi'] = 'tata_usaha/detail_rkakl';
		$this->load->view('new_design/index',$data);
	}

	function edit_rkakl()
	{
		$id_rkakl	= $this->input->post('id_rkakl');
		$keterangan	= $this->input->post('keterangan');
		$jumlah	= $this->input->post('jumlah');
			$data=array(
			 'keterangan'=> $keterangan,
			 'jumlah'=> $jumlah
		 );
			$this->db->where('id_rkakl', $id_rkakl);
			$this->db->update('rkakl', $data);
			echo '<script>alert("Data Berhasil Disimpan");</script>';
			redirect('tata_usaha','refresh');
	}

	function edit_pengajuan_rkakl()
	{
		$id_pengajuan	= $this->input->post('id_pengajuan');
		$id_detail_rkakl	= $this->input->post('id_detail_rkakl');
		$jumlah	= $this->input->post('jumlah');
		$keterangan	= $this->input->post('keterangan');
			$data=array(
			 'jumlah'=> $jumlah,
			 'id_detail_rkakl'=> $id_detail_rkakl,
			 'keterangan'=> $keterangan
		 );
		 	$max = $this->db->query("SELECT SUM(jumlah) AS total FROM pengajuan_rkakl WHERE id_detail_rkakl = $id_detail_rkakl")->row();
  		$max_akun = $this->db->query("SELECT biaya FROM detail_rkakl WHERE id = $id_detail_rkakl")->row();
  		$usulan = $jumlah+$max->total;
	 		if($usulan > $max_akun->biaya)
	 		{
	 			echo '<script>alert("Melebihi Pagu");</script>';
	 			redirect('tata_usaha/list_pengajuan','refresh');
	 		}
	 		else
	 		{
				$this->db->where('id_pengajuan', $id_pengajuan);
				$this->db->update('pengajuan_rkakl', $data);
				echo '<script>alert("Data Berhasil Disimpan");</script>';
				redirect('tata_usaha/list_pengajuan','refresh');
	 		}
	}

	function edit_detail_rkakl()
	{
		$id_rkakl	= $this->input->post('id_rkakl');
		$id	= $this->input->post('id');
		$akun	= $this->input->post('akun');
		$biaya	= $this->input->post('biaya');
			$data=array(
			 'biaya'=> $biaya
		 );
		$max = $this->db->query("SELECT jumlah FROM rkakl WHERE id_rkakl = $id_rkakl")->row();
		$max_akun = $this->db->query("SELECT biaya FROM detail_rkakl WHERE id_rkakl = $id_rkakl")->row();
		$usulan = (($biaya)/$max->jumlah)*100;
		if ($usulan > 70)
		{
			echo '<script>alert("Melebihi 70%");</script>';
			redirect('tata_usaha/detail_rkakl/'.$id_rkakl,'refresh');
		}
		else
		{
			$this->db->where('id', $id);
			$this->db->update('detail_rkakl', $data);
			echo '<script>alert("Data Berhasil Disimpan");</script>';
			redirect('tata_usaha/detail_rkakl/'.$id_rkakl,'refresh');
		}
	}

	function hapus_detail_rkakl()
	{
		$id_rkakl	= $this->uri->segment(3);
		$id_detail_rkakl	= $this->uri->segment(4);
		$cek = $this->db->query("SELECT * FROM pengajuan_rkakl WHERE id_detail_rkakl = $id_detail_rkakl")->num_rows();
		if ($cek > 0)
		{
			echo '<script>alert("Kode Akun Tidak bisa daihapus");</script>';
			redirect('tata_usaha/detail_rkakl/'.$id_rkakl,'refresh');
		}
		else
		{
			$this->db->query("DELETE FROM detail_rkakl WHERE id = $id_detail_rkakl");
			echo '<script>alert("Kode Akun berhasil dihapus");</script>';
			redirect('tata_usaha/detail_rkakl/'.$id_rkakl,'refresh');
		}
		// $this->db->query("DELETE FROM pengajuan_rkakl WHERE id_pengajuan = $id_pengajuan");
		// echo '<script>alert("Data Berhasil Dihapus");</script>';
		// redirect('tata_usaha/list_pengajuan','refresh');
	}

	function hapus_rkakl()
	{
		$id_rkakl	= $this->uri->segment(3);
		$cek = $this->db->query("SELECT * FROM pengajuan_rkakl AS pr INNER JOIN detail_rkakl AS dr ON pr.id_detail_rkakl = dr.id INNER JOIN rkakl AS r ON dr.id_rkakl = r.id_rkakl WHERE r.id_rkakl = $id_rkakl")->num_rows();
		if ($cek > 0)
		{
			echo '<script>alert("Data Tidak bisa dihapus");</script>';
			redirect('tata_usaha','refresh');
		}
		else
		{
			$this->db->query("DELETE FROM rkakl WHERE id_rkakl = $id_rkakl");
			echo '<script>alert("Data Berhasil Dihapus");</script>';
			redirect('tata_usaha','refresh');
		}
	}


}
?>
