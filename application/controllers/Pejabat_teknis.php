<?php

class Pejabat_teknis extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		if($this->session->userdata('admin_kategori') != 3)
		{
			$this->session->sess_destroy();
			redirect(base_url("login"));
		}
		$this->load->helper(array('url','form'));
		$this->load->model(array('m_pimpinan','m_bendahara','m_kontrak'));
		$this->load->library(array('format_terbilang','format_tanggal'));
	}

	// function index()
	// {
	// 	$data['isi'] = 'admin/afin_content';
	// 	$this->load->view('admin/index',$data);
	// }

	function index()
	{
		$tahun = DATE("Y");
		$is_kontrak = $this->session->userdata('admin_is_kontrak');
		$id_rumah_layanan = $this->session->userdata('admin_id_rumah_layanan');
		if ($is_kontrak == 1)
		{
			//$data['isi'] = 'admin/kp3_content';
			$data['isi'] = 'kp3/content';
			$data['result'] = $this->m_kontrak->list_kontrak_kp3()->result();
			$data['jumlah'] = $this->m_kontrak->list_kontrak_kp3()->num_rows();
			$pengeluaran = $this->db->query("SELECT SUM(p.jumlah_realisasi) AS jumlah FROM pengajuan AS p INNER JOIN rencana_operasional AS ro ON p.id_ro = ro.id_ro INNER JOIN kontrak AS k ON ro.id_kontrak = k.id_kontrak WHERE k.id_rumah_layanan = $id_rumah_layanan AND p.status_realisasi = 1 AND YEAR(p.tgl_realisasi) = $tahun")->row();
			//$data['pengeluaran'] = $this->db->query("SELECT SUM(p.jumlah_realisasi) AS jumlah FROM pengajuan AS p INNER JOIN rencana_operasional AS ro ON p.id_ro = ro.id_ro INNER JOIN kontrak AS k ON ro.id_kontrak = k.id_kontrak WHERE k.id_rumah_layanan = $id_rumah_layanan AND p.status_realisasi = 1 AND p.status_pengajuan = 1 AND YEAR(p.tgl_realisasi) = $tahun")->row();
			$data['pengeluaran'] = $pengeluaran;
		}
		else
		{
			//$data['isi'] = 'admin/kp3';
			$data['isi'] = 'kp3/content_kp3';
			$data['result'] = $this->m_kontrak->list_rkakl()->result();
			$data['jumlah'] = $this->m_kontrak->list_rkakl()->num_rows();
			$data['pengeluaran'] = $this->db->query("SELECT SUM(p.jumlah_realisasi) AS jumlah FROM pengajuan_rkakl AS p INNER JOIN detail_rkakl AS dr ON p.id_detail_rkakl = dr.id INNER JOIN rkakl AS r ON dr.id_rkakl = r.id_rkakl INNER JOIN rumah_layanan AS rl ON r.id_layanan = rl.id_rumah_layanan WHERE r.id_layanan = $id_rumah_layanan AND p.status_realisasi = 1 AND p.status_pengajuan = 1 AND YEAR(p.tgl_realisasi) = $tahun")->row();
		}
			$data['target'] = $this->db->query("SELECT SUM(jumlah) AS jumlah FROM target WHERE id_rumah_layanan = $id_rumah_layanan AND tahun = $tahun")->row();
			$terkontrak = $this->db->query("SELECT SUM(t.jumlah) AS jumlah FROM termin AS t INNER JOIN kontrak AS k ON t.id_kontrak = k.id_kontrak INNER JOIN perusahaan AS p ON k.id_perusahaan = p.id_perusahaan WHERE (k.id_rumah_layanan = $id_rumah_layanan AND YEAR(t.tgl_termin) = $tahun) OR (k.id_rumah_layanan = $id_rumah_layanan AND YEAR(t.tgl_pembayaran) = $tahun) OR (k.id_rumah_layanan = $id_rumah_layanan AND t.status_pembayaran = 0)")->row();
			//$data['terkontrak'] = $this->db->query("SELECT SUM(nilai_kontrak) AS jumlah FROM kontrak WHERE id_rumah_layanan = $id_rumah_layanan AND YEAR(tgl_akhir) = $tahun")->row();
			$data['terkontrak'] = $terkontrak;
			$invoice = $this->db->query("SELECT SUM(t.jumlah) AS jumlah FROM termin AS t INNER JOIN kontrak AS k ON t.id_kontrak = k.id_kontrak INNER JOIN perusahaan AS p ON k.id_perusahaan = p.id_perusahaan WHERE k.id_rumah_layanan = $id_rumah_layanan AND YEAR(t.tgl_invoice) = $tahun AND t.status_cetak_invoice=1")->row();
			$data['realisasi'] = $this->db->query("SELECT SUM(t.jumlah_realisasi) AS jumlah FROM termin AS t INNER JOIN kontrak AS k ON t.id_kontrak = k.id_kontrak WHERE k.id_rumah_layanan = $id_rumah_layanan AND YEAR(t.tgl_pembayaran) = $tahun AND t.status_pembayaran=1")->row();
			//$data['invoice'] = $this->db->query("SELECT SUM(t.jumlah) AS jumlah FROM termin AS t INNER JOIN kontrak AS k ON t.id_kontrak = k.id_kontrak WHERE k.id_rumah_layanan = $id_rumah_layanan AND YEAR(t.tgl_termin) = $tahun")->row();
			$data['invoice'] = $invoice;
			//$this->load->view('new/index',$data);
			$this->load->view('new_design/index',$data);
	}

	function list_pengajuan()
	{
		$tahun = DATE("Y");
		$id_rumah_layanan = $this->session->userdata('admin_id_rumah_layanan');
		//$data['isi'] = 'admin/kp3_pengajuan';
		$data['isi'] = 'kp3/pengajuan';
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
		$this->load->view('new_design/index',$data);
	}

	function input_anggota()
	{
		$id_kontrak	= $this->input->post('id_kontrak');
		$termin	= $this->input->post('termin');
		$tgl_termin	= $this->input->post('tgl_termin');
		$jumlah	= $this->input->post('jumlah');
		$data=array();
		foreach($termin AS $key => $val)
		{
			$data[]=array(
			 'id_kontrak'=> $id_kontrak,
			 'termin'=> $termin[$key],
			 'tgl_termin'=> $tgl_termin[$key],
			 'jumlah'=> $jumlah[$key]
		 );
		 //echo $termin[$key];
		 //echo $tgl_termin[$key];
	 }
	 //echo $data;
	 //sesuaikan nama dengan nama tabel
	 	$this->db->insert_batch('termin',$data);
		echo '<script>alert("Data Berhasil Disimpan");</script>';
		redirect('pejabat_teknis/setting_kontrak'.$id_kontrak,'refresh');
	}

	function input_timeline()
	{
		$id_kontrak	= $this->input->post('id_kontrak');
		$termin	= $this->input->post('termin');
		$tgl_mulai	= $this->input->post('tgl_mulai');
		$tgl_akhir	= $this->input->post('tgl_akhir');
		$nama_kegiatan	= htmlspecialchars($this->input->post('nama_kegiatan', TRUE), ENT_QUOTES);
			$data=array(
			 'id_kontrak'=> $id_kontrak,
			 'termin'=> $termin,
			 'tgl_mulai'=> $tgl_mulai,
			 'tgl_akhir'=> $tgl_akhir,
			 'nama_kegiatan'=> $nama_kegiatan
		 );
	 	$this->db->insert('kegiatan',$data);
		echo '<script>alert("Data Berhasil Disimpan");</script>';
		redirect('pejabat_teknis/setting_kontrak'.$id_kontrak,'refresh');
	}

	function input_ro()
	{
		$id_kontrak	= $this->input->post('id_kontrak');
		$id_kegiatan	= $this->input->post('id_kegiatan');
		$biaya	= $this->input->post('biaya');
		$akun	= $this->input->post('akun');
			$data=array(
			 'id_kontrak'=> $id_kontrak,
			 'id_kegiatan'=> $id_kegiatan,
			 'biaya'=> $biaya,
			 'akun'=> $akun
		 );
		$max_kontrak = $this->db->query("SELECT nilai_kontrak FROM kontrak WHERE id_kontrak = $id_kontrak")->row();
		$max_akun = $this->db->query("SELECT SUM(biaya) AS biaya FROM rencana_operasional WHERE id_kontrak = $id_kontrak")->row();
		$usulan = (($biaya+$max_akun->biaya)/$max_kontrak->nilai_kontrak)*100;
		if ($usulan > 70)
		{
			echo '<script>alert("Melebihi 70%");</script>';
			redirect('pejabat_teknis/setting_kontrak'.$id_kontrak,'refresh');
		}
		else
		{
			$this->db->insert('rencana_operasional',$data);
			echo '<script>alert("Data Berhasil Disimpan");</script>';
			redirect('pejabat_teknis/setting_kontrak'.$id_kontrak,'refresh');
		}
	}

	function input_rkakl()
	{
		$id_rkakl	= $this->input->post('id_rkakl');
		$keterangan	= htmlspecialchars($this->input->post('keterangan', TRUE), ENT_QUOTES);
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
			redirect('pejabat_teknis','refresh');
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
			redirect('pejabat_teknis/detail_rkakl/'.$id_rkakl,'refresh');
		}
		else
		{
			$max = $this->db->query("SELECT jumlah FROM rkakl WHERE id_rkakl = $id_rkakl")->row();
			$max_akun = $this->db->query("SELECT biaya FROM detail_rkakl WHERE id_rkakl = $id_rkakl")->row();
			$usulan = (($biaya)/$max->jumlah)*100;
			if ($usulan > 70)
			{
				echo '<script>alert("Melebihi 70%");</script>';
				redirect('pejabat_teknis/detail_rkakl/'.$id_rkakl,'refresh');
			}
			else
			{
				$this->db->insert('detail_rkakl',$data);
				echo '<script>alert("Data Berhasil Disimpan");</script>';
				redirect('pejabat_teknis/detail_rkakl/'.$id_rkakl,'refresh');
			}

		}
	}

	function input_pengajuan()
	{
		$tahun = DATE("Y");
		$id_kontrak	= $this->input->post('id_kontrak');
		$id_ro	= $this->input->post('id_ro');
		$jumlah	= $this->input->post('jumlah');
		$id_rumah_layanan = $this->session->userdata('admin_id_rumah_layanan');
		$keterangan	= htmlspecialchars($this->input->post('keterangan', TRUE), ENT_QUOTES);
		$getkode_kp3 = $this->db->query("SELECT kode FROM rumah_layanan WHERE id_rumah_layanan = $id_rumah_layanan")->row();
		$getkodelast = $this->db->query("SELECT * FROM pengajuan WHERE YEAR(tgl_pengajuan) = $tahun ORDER BY nomor DESC LIMIT 1")->row();
		$getkode = $getkodelast->nomor + 1;
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
		$no_urut = $getkode_kp3->kode."/".$tahun."/".$kode;
		//$no_urut = $this->input->post('no_urut');
		$tanggal = DATE("Y-m-d");
		$max_pagu = $this->db->query("SELECT SUM(biaya) AS biaya FROM rencana_operasional WHERE id_kontrak = $id_kontrak")->row();
		$max_akun = $this->db->query("SELECT SUM(p.jumlah) AS jumlah FROM pengajuan AS p INNER JOIN rencana_operasional AS ro ON p.id_ro = ro.id_ro WHERE ro.id_kontrak = $id_kontrak AND status_pengajuan != 2")->row();
		$usulan = $jumlah+$max_akun->jumlah;
		if($usulan > $max_pagu->biaya)
		{
			echo '<script>alert("Melebihi Pagu");</script>';
			redirect('pejabat_teknis/setting_kontrak/'.$id_kontrak,'refresh');
		}
		else
		{
			$uploadpath = './uploads/pengajuan';
			$config['upload_path'] = $uploadpath;
			$config['allowed_types'] = 'pdf';
			$config['max_size']	= '20000';
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('file'))
			{
				$error = $this->upload->display_errors();
				echo '<script>alert("Data Gagal Disimpan!'.$error.'");</script>';
				redirect('pejabat_teknis/setting_kontrak/'.$id_kontrak,'refresh');
			}
			else
			{
				$upload = $this->upload->data();
				$file	= $upload['file_name'];
				$data=array(
				 'id_ro'=> $id_ro,
				 'jumlah'=> $jumlah,
				'no_urut'=> $no_urut,
				'nomor'=> $getkode,
				 'tgl_pengajuan'=> $tanggal,
				 'file'=> $file,
				 'keterangan'=> $keterangan
			 );
			}
			$this->db->insert('pengajuan',$data);
			echo '<script>alert("Data Berhasil Disimpan");</script>';
			redirect('pejabat_teknis/setting_kontrak/'.$id_kontrak,'refresh');
		}
	}

	function edit_pengajuan()
	{
		//$tahun = DATE("Y");
		$id_pengajuan	= $this->input->post('id_pengajuan');
		$id_kontrak	= $this->input->post('id_kontrak');
		$id_ro	= $this->input->post('id_ro');
		$jumlah	= $this->input->post('jumlah');
		$keterangan	= htmlspecialchars($this->input->post('keterangan', TRUE), ENT_QUOTES);
		$data=array(
			 'id_ro'=> $id_ro,
			 'jumlah'=> $jumlah,
			 'keterangan'=> $keterangan
		 );
		$max_pagu = $this->db->query("SELECT SUM(biaya) AS biaya FROM rencana_operasional WHERE id_kontrak = $id_kontrak")->row();
		$max_akun = $this->db->query("SELECT SUM(p.jumlah) AS jumlah FROM pengajuan AS p INNER JOIN rencana_operasional AS ro ON p.id_ro = ro.id_ro WHERE ro.id_kontrak = $id_kontrak")->row();
		$usulan = $jumlah+$max_akun->jumlah;
		if($usulan > $max_pagu->biaya)
		{
			echo '<script>alert("Melebihi Pagu");</script>';
			redirect('pejabat_teknis/setting_kontrak/'.$id_kontrak,'refresh');
		}
		else
		{
			$this->db->where('id_pengajuan', $id_pengajuan);
			$this->db->update('pengajuan', $data);
			echo '<script>alert("Data Berhasil Disimpan");</script>';
			redirect('pejabat_teknis/setting_kontrak/'.$id_kontrak,'refresh');
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
		$getkodelast = $this->db->query("SELECT * FROM pengajuan_rkakl WHERE YEAR(tgl_pengajuan) = $tahun ORDER BY nomor DESC LIMIT 1")->row();
		$getkode = $getkodelast->nomor + 1;
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
 		$max = $this->db->query("SELECT SUM(jumlah) AS total FROM pengajuan_rkakl WHERE id_detail_rkakl = $id_detail_rkakl")->row();
 		$max_akun = $this->db->query("SELECT biaya FROM detail_rkakl WHERE id = $id_detail_rkakl")->row();
 		$usulan = $jumlah+$max->total;
		if($usulan > $max_akun->biaya)
		{
			echo '<script>alert("Melebihi Pagu");</script>';
			redirect('pejabat_teknis/list_pengajuan','refresh');
		}
		else
		{
			$uploadpath = './uploads/pengajuan';
			$config['upload_path'] = $uploadpath;
			$config['allowed_types'] = 'pdf';
			$config['max_size']	= '20000';
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('file'))
			{
				$error = $this->upload->display_errors();
				echo '<script>alert("Data Gagal Disimpan!'.$error.'");</script>';
				redirect('pejabat_teknis/list_pengajuan','refresh');
			}
			else
			{
				$upload = $this->upload->data();
				$file	= $upload['file_name'];
				$data=array(
				 'id_detail_rkakl'=> $id_detail_rkakl,
				 'jumlah'=> $jumlah,
				 'no_urut'=> $no_urut,
				 'nomor'=> $getkode,
				 'tgl_pengajuan'=> $tanggal,
				 'file'=> $file,
				 'keterangan'=> $keterangan
			 );
			}
			$this->db->insert('pengajuan_rkakl',$data);
			echo '<script>alert("Data Berhasil Disimpan");</script>';
			redirect('pejabat_teknis/list_pengajuan','refresh');
		}
	}

	function hapus_pengajuan()
	{
		$id_kontrak	= $this->uri->segment(3);
		$id_pengajuan	= $this->uri->segment(4);
		$this->db->query("DELETE FROM pengajuan WHERE id_pengajuan = $id_pengajuan");
		echo '<script>alert("Data Berhasil Dihapus");</script>';
		redirect('pejabat_teknis/setting_kontrak/'.$id_kontrak,'refresh');
	}

	function hapus_rkakl()
	{
		$id_rkakl	= $this->uri->segment(3);
		$cek = $this->db->query("SELECT * FROM pengajuan_rkakl AS pr INNER JOIN detail_rkakl AS dr ON pr.id_detail_rkakl = dr.id INNER JOIN rkakl AS r ON dr.id_rkakl = r.id_rkakl WHERE r.id_rkakl = $id_rkakl")->num_rows();
		if ($cek > 0)
		{
			echo '<script>alert("Data Tidak bisa dihapus");</script>';
			redirect('pejabat_teknis','refresh');
		}
		else
		{
			$this->db->query("DELETE FROM rkakl WHERE id_rkakl = $id_rkakl");
			echo '<script>alert("Data Berhasil Dihapus");</script>';
			redirect('pejabat_teknis','refresh');
		}
	}

	function hapus_pengajuan_rkakl()
	{
		$id_pengajuan	= $this->uri->segment(3);
		$this->db->query("DELETE FROM pengajuan_rkakl WHERE id_pengajuan = $id_pengajuan");
		echo '<script>alert("Data Berhasil Dihapus");</script>';
		redirect('pejabat_teknis/list_pengajuan','refresh');
	}

	function update_kegiatan()
	{
		$id_kontrak	= $this->input->post('id_kontrak');
		$id_kegiatan	= addslashes($this->input->post('id_kegiatan'));
		$keterangan	= htmlspecialchars($this->input->post('keterangan', TRUE), ENT_QUOTES);
		//echo $id_kontrak;echo $id_kegiatan;echo $keterangan;
		$uploadpath = './uploads';
		$config['upload_path'] = $uploadpath;
		$config['allowed_types'] = 'pdf';
		$config['max_size']	= '20000';
		$this->upload->initialize($config);
		if (!$this->upload->do_upload('file'))
		{
			$data=array(
			 'keterangan'=> $keterangan,
			 'status' => 1
		 	);
			//$this->db->query("UPDATE kegiatan SET keterangan='$keterangan' WHERE id_kegiatan=$id_kegiatan");
		}
		else
		{
			$upload = $this->upload->data();
			$file	= $upload['file_name'];
			$data=array(
			 'keterangan'=> $keterangan,
			 'bukti'=> $file,
			 'status' => 1
		 	);
			//$this->db->query("UPDATE kegiatan SET keterangan='$keterangan',bukti='$file' WHERE id_kegiatan=$id_kegiatan");
		}
		$this->db->where('id_kegiatan', $id_kegiatan);
		$this->db->update('kegiatan', $data);
		echo '<script>alert("Data Berhasil Disimpan");</script>';
		redirect('pejabat_teknis/setting_kontrak/'.$id_kontrak,'refresh');
	}

	function update_kendala()
	{
		$tanggal = DATE("Y-m-d");
		$id_kontrak	= $this->input->post('id_kontrak');
		$id_kegiatan	= addslashes($this->input->post('id_kegiatan'));
		$keterangan	= htmlspecialchars($this->input->post('keterangan', TRUE), ENT_QUOTES);
		$data=array(
		 'keterangan'=> $keterangan,
		 'id_kegiatan'=> $id_kegiatan,
		 //'status' => 1,
		 'tanggal' => $tanggal
		);
		$this->db->insert('kendala',$data);
		$this->db->query("UPDATE kegiatan SET status=2 WHERE id_kegiatan=$id_kegiatan");
		echo '<script>alert("Data Berhasil Disimpan");</script>';
		redirect('pejabat_teknis/setting_kontrak/'.$id_kontrak,'refresh');
	}

	function setting_kontrak()
	{
		$tahun = DATE("Y");
		$id_kontrak	= $this->uri->segment(3);
		$id_rumah_layanan = $this->session->userdata('admin_id_rumah_layanan');
		//echo $id_kontrak;
		//$data['isi'] = 'admin/kp3_detail_kontrak';
		$data['isi'] = 'kp3/detail_kontrak';
		$data['result'] = $this->m_kontrak->pilih_kontrak($id_kontrak);
		$data['result_termin'] = $this->db->query("SELECT * FROM termin WHERE id_kontrak = $id_kontrak")->result();
		$data['result_anggota'] = $this->db->query("SELECT * FROM personil WHERE id_kontrak = $id_kontrak")->result();
		$data['result_ro'] = $this->db->query("SELECT * FROM rencana_operasional INNER JOIN akun ON rencana_operasional.akun = akun.id_akun INNER JOIN kegiatan ON rencana_operasional.id_kegiatan = kegiatan.id_kegiatan WHERE rencana_operasional.id_kontrak = $id_kontrak")->result();
		$data['result_pengajuan'] = $this->db->query("SELECT *,pengajuan.keterangan AS keterangan_pengajuan FROM pengajuan INNER JOIN rencana_operasional ON pengajuan.id_ro = rencana_operasional.id_ro INNER JOIN akun ON rencana_operasional.akun = akun.id_akun INNER JOIN kegiatan ON rencana_operasional.id_kegiatan = kegiatan.id_kegiatan WHERE rencana_operasional.id_kontrak = $id_kontrak ORDER BY pengajuan.tgl_pengajuan")->result();
		$data['jumlah_pengajuan'] = $this->db->query("SELECT * FROM pengajuan INNER JOIN rencana_operasional ON pengajuan.id_ro = rencana_operasional.id_ro INNER JOIN akun ON rencana_operasional.akun = akun.id_akun INNER JOIN kegiatan ON rencana_operasional.id_kegiatan = kegiatan.id_kegiatan WHERE rencana_operasional.id_kontrak = $id_kontrak")->num_rows();
		$data['result_timeline'] = $this->db->query("SELECT *,termin.termin AS termin_id,kegiatan.status AS status_kegiatan FROM kegiatan INNER JOIN termin ON kegiatan.termin = termin.id_termin WHERE kegiatan.id_kontrak = $id_kontrak")->result();
		//$data['jumlah'] = $this->m_kontrak->list_kontrak()->num_rows();
		// $getkode_kp3 = $this->db->query("SELECT kode FROM rumah_layanan WHERE id_rumah_layanan = $id_rumah_layanan")->row();
		// $getkode = $this->db->query("SELECT * FROM pengajuan WHERE YEAR(tgl_pengajuan) = $tahun")->num_rows();
		// $getkode = $getkode + 1;
		// if ($getkode < 10)
		// {
		// 	$kode = '000'.$getkode;
		// }
		// else if ($getkode > 9 && $getkode < 100)
		// {
		// 	$kode = '00'.$getkode;
		// }
		// else if ($getkode > 99 && $getkode < 1000)
		// {
		// 	$kode = '0'.$getkode;
		// }
		// else if ($getkode > 999)
		// {
		// 	$kode = $getkode;
		// }
		// $data['no_urut'] = $getkode_kp3->kode."/".$tahun."/".$kode;
		//$this->load->view('new/index',$data);
		$this->load->view('new_design/index',$data);
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
		$data['isi'] = 'admin/afin_detail_kontrak';
		$this->load->view('new/index',$data);
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
		$this->load->view('admin/index',$data);
	}

	function detail_rkakl()
	{
		$id_rkakl	= $this->uri->segment(3);
		//$akun	= $this->uri->segment(4);
		$data['result'] = $this->m_kontrak->pilih_rkakl($id_rkakl);
		$data['result_rkakl'] = $this->db->query("SELECT rkakl.id_rkakl,rkakl.keterangan,rkakl.jumlah,rkakl.tahun,rkakl.id_layanan,a.kode,a.nama_akun FROM detail_rkakl AS dr INNER JOIN rkakl ON dr.id_rkakl = rkakl.id_rkakl INNER JOIN akun AS a ON dr.akun = a.id_akun WHERE dr.id_rkakl = $id_rkakl ORDER BY a.id_akun")->result();
		$data['jumlah'] = $this->db->query("SELECT rkakl.id_rkakl,rkakl.keterangan,rkakl.jumlah,rkakl.tahun,rkakl.id_layanan,a.kode,a.nama_akun FROM detail_rkakl AS dr INNER JOIN rkakl ON dr.id_rkakl = rkakl.id_rkakl INNER JOIN akun AS a ON dr.akun = a.id_akun WHERE dr.id_rkakl = $id_rkakl ORDER BY a.id_akun")->num_rows();
		//$data['isi'] = 'admin/kp3_detail_rkakl';
		$data['isi'] = 'kp3/detail_rkakl';
		$this->load->view('new_design/index',$data);
	}

	function edit_rkakl()
	{
		$id_rkakl	= $this->input->post('id_rkakl');
		$keterangan	= htmlspecialchars($this->input->post('keterangan', TRUE), ENT_QUOTES);
		$jumlah	= $this->input->post('jumlah');
			$data=array(
			 'keterangan'=> $keterangan,
			 'jumlah'=> $jumlah
		 );
			$this->db->where('id_rkakl', $id_rkakl);
			$this->db->update('rkakl', $data);
			echo '<script>alert("Data Berhasil Disimpan");</script>';
			redirect('pejabat_teknis','refresh');
	}

	function edit_pengajuan_rkakl()
	{
		$id_pengajuan	= $this->input->post('id_pengajuan');
		$id_detail_rkakl	= $this->input->post('id_detail_rkakl');
		$jumlah	= $this->input->post('jumlah');
		$keterangan	= htmlspecialchars($this->input->post('keterangan', TRUE), ENT_QUOTES);
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
	 			redirect('pejabat_teknis/list_pengajuan','refresh');
	 		}
	 		else
	 		{
				$this->db->where('id_pengajuan', $id_pengajuan);
				$this->db->update('pengajuan_rkakl', $data);
				echo '<script>alert("Data Berhasil Disimpan");</script>';
				redirect('pejabat_teknis/list_pengajuan','refresh');
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
			redirect('pejabat_teknis/detail_rkakl/'.$id_rkakl,'refresh');
		}
		else
		{
			$this->db->where('id', $id);
			$this->db->update('detail_rkakl', $data);
			echo '<script>alert("Data Berhasil Disimpan");</script>';
			redirect('pejabat_teknis/detail_rkakl/'.$id_rkakl,'refresh');
		}
	}

	function hapus_detail_rkakl()
	{
		$id_rkakl	= $this->uri->segment(3);
		$id_detail_rkakl	= $this->uri->segment(4);
		$cek = $this->db->query("SELECT * FROM pengajuan_rkakl WHERE id_detail_rkakl = $id_detail_rkakl")->num_rows();
		if ($cek > 0)
		{
			echo '<script>alert("Kode Akun Tidak bisa dihapus");</script>';
			redirect('pejabat_teknis/detail_rkakl/'.$id_rkakl,'refresh');
		}
		else
		{
			$this->db->query("DELETE FROM detail_rkakl WHERE id = $id_detail_rkakl");
			echo '<script>alert("Kode Akun berhasil daihapus");</script>';
			redirect('pejabat_teknis/detail_rkakl/'.$id_rkakl,'refresh');
		}
	}

	function detail_ro()
	{
		$id_kontrak	= $this->uri->segment(3);
		$akun	= $this->uri->segment(4);
		$data['result'] = $this->m_kontrak->pilih_kontrak($id_kontrak);
		$data['result_ro'] = $this->db->query("SELECT ro.id_ro,ro.id_kontrak,ro.keterangan,ro.biaya,a.kode,a.nama_akun,ro.akun,k.nama_kegiatan FROM rencana_operasional AS ro INNER JOIN akun AS a ON ro.akun = a.id_akun INNER JOIN kegiatan AS k on ro.id_kegiatan = k.id_kegiatan WHERE ro.id_kontrak = $id_kontrak AND akun = $akun ORDER BY a.id_akun")->result();
		$data['isi'] = 'kp3/detail_ro';
		$this->load->view('new_design/index',$data);
	}


}
?>
