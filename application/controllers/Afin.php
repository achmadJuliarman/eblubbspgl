<?php

class Afin extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		if($this->session->userdata('admin_valid') != "true")
		{
			$this->session->sess_destroy();
			redirect(base_url("login"));
		}
		$this->load->helper(array('url','form'));
		$this->load->model(array('m_pimpinan','m_bendahara','m_kontrak'));
		$this->load->library(array('format_terbilang','format_tanggal','api_bios'));
	}

	function index()
	{
		$id_satker = $this->session->userdata('admin_id_satker');
		$bulan = DATE("m");
		$tahun = DATE("Y");
		$data['isi'] = 'afin/content';
		$data['result'] = $this->m_kontrak->list_kontrak()->result();
		$data['adendum'] = $this->db->query("SELECT * FROM adendum AS a INNER JOIN kontrak AS k ON a.id_kontrak = k.id_kontrak WHERE YEAR(a.tgl_adendum) = $tahun AND k.id_satker=$id_satker GROUP BY k.id_kontrak")->num_rows();
		//$data['expired'] = $this->db->query("SELECT datediff(current_date(), tgl_akhir) AS selisih FROM kontrak WHERE selisih between 0 AND -31 AND STATUS='K' AND id_satker=$id_satker")->num_rows();
		//$data['expired'] = $this->db->query("SELECT datediff(current_date(), tgl_akhir) AS selisih FROM kontrak WHERE selisih between 0 AND -31 AND STATUS='K' AND id_satker=$id_satker")->num_rows();
		$data['jumlah_kontrak'] = $this->m_kontrak->list_kontrak()->num_rows();
		$data['jumlah'] = $this->m_kontrak->list_kontrak()->num_rows();
		$this->load->view('new_design/index',$data);
	}

	function adendum()
	{
		$id_satker = $this->session->userdata('admin_id_satker');
		$bulan = DATE("m");
		$tahun = DATE("Y");
		$data['isi'] = 'afin/content';
		$data['result'] = $this->db->query("SELECT * FROM adendum AS a INNER JOIN kontrak AS k ON a.id_kontrak = k.id_kontrak INNER JOIN rumah_layanan AS rl ON k.id_rumah_layanan=rl.id_rumah_layanan INNER JOIN perusahaan AS p ON k.id_perusahaan=p.id_perusahaan WHERE YEAR(a.tgl_adendum) = $tahun AND k.id_satker=$id_satker GROUP BY k.id_kontrak")->result();
		$data['adendum'] = $this->db->query("SELECT * FROM adendum AS a INNER JOIN kontrak AS k ON a.id_kontrak = k.id_kontrak WHERE YEAR(a.tgl_adendum) = $tahun AND k.id_satker=$id_satker GROUP BY k.id_kontrak ")->num_rows();
		$data['expired'] = $this->db->query("SELECT * FROM kontrak WHERE MONTH(tgl_akhir) = $bulan AND YEAR(tgl_akhir) = $tahun AND STATUS='K' AND id_satker=$id_satker")->num_rows();
		$data['jumlah'] = $this->db->query("SELECT * FROM kontrak WHERE MONTH(tgl_akhir) = $bulan AND YEAR(tgl_akhir) = $tahun AND STATUS='K' AND id_satker=$id_satker")->num_rows();
		$data['jumlah_kontrak'] = $this->m_kontrak->list_kontrak()->num_rows();
		$this->load->view('new_design/index',$data);
	}

	function coba()
	{
		$this->load->view('afin/coba');
	}

	function old()
	{
		$id_satker = $this->session->userdata('admin_id_satker');
		$bulan = DATE("m");
		$tahun = DATE("Y");
		$data['isi'] = 'admin/afin_content';
		$data['result'] = $this->m_kontrak->list_kontrak()->result();
		$data['adendum'] = $this->db->query("SELECT * FROM adendum AS a INNER JOIN kontrak AS k ON a.id_kontrak = k.id_kontrak WHERE YEAR(a.tgl_adendum) = $tahun AND k.id_satker=$id_satker GROUP BY k.id_kontrak ")->num_rows();
		$data['expired'] = $this->db->query("SELECT * FROM kontrak WHERE MONTH(tgl_akhir) = $bulan AND YEAR(tgl_akhir) = $tahun AND STATUS='K' AND id_satker=$id_satker ")->num_rows();
		$data['jumlah_kontrak'] = $this->m_kontrak->list_kontrak()->num_rows();
		$data['jumlah'] = $this->m_kontrak->list_kontrak()->num_rows();
		$this->load->view('new/index',$data);
	}

	function expired()
	{
		$id_satker = $this->session->userdata('admin_id_satker');
		$bulan = DATE("m");
		$tahun = DATE("Y");
		$data['isi'] = 'afin/content';
		$data['result'] = $this->db->query("SELECT * FROM kontrak AS k INNER JOIN rumah_layanan AS rl ON k.id_rumah_layanan=rl.id_rumah_layanan INNER JOIN perusahaan AS p ON k.id_perusahaan=p.id_perusahaan WHERE MONTH(k.tgl_akhir) = $bulan AND YEAR(k.tgl_akhir) = $tahun AND k.status='K' AND k.id_satker=$id_satker")->result();
		$data['adendum'] = $this->db->query("SELECT * FROM adendum AS a INNER JOIN kontrak AS k ON a.id_kontrak = k.id_kontrak WHERE YEAR(a.tgl_adendum) = $tahun AND k.id_satker=$id_satker GROUP BY k.id_kontrak ")->num_rows();
		$data['expired'] = $this->db->query("SELECT * FROM kontrak WHERE MONTH(tgl_akhir) = $bulan AND YEAR(tgl_akhir) = $tahun AND STATUS='K' AND id_satker=$id_satker")->num_rows();
		$data['jumlah'] = $this->db->query("SELECT * FROM kontrak WHERE MONTH(tgl_akhir) = $bulan AND YEAR(tgl_akhir) = $tahun AND STATUS='K' AND id_satker=$id_satker")->num_rows();
		$data['jumlah_kontrak'] = $this->m_kontrak->list_kontrak()->num_rows();
		$this->load->view('new_design/index',$data);
	}

	function setting_kontrak()
	{
		$id_kontrak	= $this->uri->segment(3);
		//echo $id_kontrak;
		$data['isi'] = 'admin/program_detail_kontrak';
		$data['result'] = $this->m_kontrak->pilih_kontrak($id_kontrak);
		//$data['jumlah'] = $this->m_kontrak->list_kontrak()->num_rows();
		$this->load->view('new/index',$data);
	}

	function add_kontrak()
	{
		//$data['isi'] = 'admin/afin_input_kontrak';
		$data['isi'] = 'afin/input_kontrak';
		$data['rumah_layanan'] = $this->m_kontrak->list_rumah_layanan()->result();
		$data['detail_layanan'] = $this->m_kontrak->list_detail_layanan()->result();
		$data['perusahaan'] = $this->m_kontrak->list_perusahaan()->result();
		$data['pegawai'] = $this->m_kontrak->list_pegawai()->result();
		$data['rba'] = $this->m_kontrak->list_rba()->result();
		//$data['jumlah'] = $this->m_kontrak->list_kontrak()->num_rows();
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
		$data['isi'] = 'detail_kontrak';
		$this->load->view('new_design/index',$data);
	}

	function pilih_kontrak()
	{
		$id_kontrak	= $this->uri->segment(3);
		$data['result'] = $this->m_kontrak->pilih_kontrak($id_kontrak);
		$data['isi'] = 'afin/edit_kontrak';
		$data['rumah_layanan'] = $this->m_kontrak->list_rumah_layanan()->result();
		$data['detail_layanan'] = $this->m_kontrak->list_detail_layanan()->result();
		$data['perusahaan'] = $this->m_kontrak->list_perusahaan()->result();
		$data['pegawai'] = $this->m_kontrak->list_pegawai()->result();
		$data['rba'] = $this->m_kontrak->list_rba()->result();
		//$data['jumlah'] = $this->m_kontrak->list_kontrak()->num_rows();
		$this->load->view('new_design/index',$data);
	}

	function adendum_kontrak()
	{
		$id_kontrak	= $this->uri->segment(3);
		$data['result'] = $this->m_kontrak->pilih_kontrak($id_kontrak);
		$data['isi'] = 'afin/adendum_kontrak';
		$data['rumah_layanan'] = $this->m_kontrak->list_rumah_layanan()->result();
		$data['detail_layanan'] = $this->m_kontrak->list_detail_layanan()->result();
		$data['perusahaan'] = $this->m_kontrak->list_perusahaan()->result();
		$data['pegawai'] = $this->m_kontrak->list_pegawai()->result();
		$data['rba'] = $this->m_kontrak->list_rba()->result();
		//$data['jumlah'] = $this->m_kontrak->list_kontrak()->num_rows();
		$this->load->view('new_design/index',$data);
	}

	function tambah_kontrak()
	{
		$id_satker = $this->session->userdata('admin_id_satker');
		$nama_kontrak	= addslashes($this->input->post('nama_kontrak'));
		$termin	= addslashes($this->input->post('termin'));
		$max_operasional	= addslashes($this->input->post('max_operasional'));
		$nilai_kontrak	= addslashes($this->input->post('nilai_kontrak'));
		$no_kontrak	= addslashes($this->input->post('no_kontrak'));
		$tgl_ttd	= addslashes($this->input->post('tgl_ttd'));
		$rumah_layanan	= addslashes($this->input->post('rumah_layanan'));
		$jasa	= addslashes($this->input->post('jasa'));
		//$perusahaan	= addslashes($this->input->post('perusahaan'));
		$pic	= addslashes($this->input->post('pic'));
		//$rba	= addslashes($this->input->post('rba'));
		$status	= addslashes($this->input->post('status'));
		$keterangan	= addslashes($this->input->post('keterangan'));
		$tgl_mulai	= addslashes($this->input->post('tgl_mulai'));
		$tgl_akhir	= addslashes($this->input->post('tgl_akhir'));
		//$tgl = htmlspecialchars($this->input->post('daterange'));
		//$startDate  = explode(" ",$tgl)[0];
	  //$endDate    = explode(" ",$tgl)[2];
		$nama_perusahaan	= addslashes($this->input->post('nama_perusahaan'));
		$cek = $this->db->query("SELECT id_perusahaan FROM perusahaan WHERE nama_perusahaan='$nama_perusahaan'")->row();
		$cek_perusahaan = $this->db->query("SELECT id_perusahaan FROM perusahaan WHERE nama_perusahaan='$nama_perusahaan'")->num_rows();
		$created_time = DATE("Y-m-d H:i:s");
		$id_admin = $this->session->userdata('admin_id');
		if ($cek_perusahaan == 0)
		{
			echo '<script>alert("Data Client tidak ditemukan");</script>';
			redirect('afin/add_kontrak', 'refresh');
		}
		else
		{
			if ($tgl_mulai > $tgl_akhir)
			{
				echo '<script>alert("Tanggal Akhir lebih kecil dari tanggal Mulai");</script>';
				redirect('afin/add_kontrak', 'refresh');
			}
			else
			{
			$id_perusahaan =  $cek->id_perusahaan;
			$data = array(
				 'id_satker' => $id_satker,
				 'termin' => $termin,
				 'max_operasional' => $max_operasional,
				 'nama_kontrak' => $nama_kontrak,
				 'nilai_kontrak' => $nilai_kontrak,
				 'no_kontrak' => $no_kontrak,
				 'tgl_ttd' => $tgl_ttd,
				 'id_rumah_layanan' => $rumah_layanan,
				 'id_jasa' => $jasa,
				 'id_perusahaan' => $id_perusahaan,
				 'pic' => $pic,
				 //'id_rba' => $rba,
				 'tgl_mulai' => $tgl_mulai,
				 'tgl_akhir' => $tgl_akhir,
				 'created_time' => $created_time,
				 'created_by' => $id_admin,
				 'status' => $status,
				 'keterangan' => $keterangan
			);
			//echo $tgl_mulai.";".$tgl_akhir.";".$keterangan;
			$this->m_kontrak->add_kontrak($data);

			$id_user = $this->session->userdata('admin_id');
			$keterangan = "Tambah Kontrak ".$nama_kontrak;
			$data=array(
			 'id_user'=> $id_user,
			 'keterangan'=> $keterangan,
			 'tanggal'=> DATE("Y-m-d H:i:s")
			);
			$this->db->insert('log_history',$data);

			echo '<script>alert("Data Berhasil Disimpan");</script>';
			redirect('afin', 'refresh');
			}
		}

	}

	function edit_kontrak()
	{
		$id_admin = $this->session->userdata('admin_id');
		$id_kontrak	= addslashes($this->input->post('id_kontrak'));
		$id_satker = $this->session->userdata('admin_id_satker');
		$nama_kontrak	= addslashes($this->input->post('nama_kontrak'));
		$termin	= addslashes($this->input->post('termin'));
		$max_operasional	= addslashes($this->input->post('max_operasional'));
		$nilai_kontrak	= addslashes($this->input->post('nilai_kontrak'));
		$no_kontrak	= addslashes($this->input->post('no_kontrak'));
		$tgl_ttd	= addslashes($this->input->post('tgl_ttd'));
		$rumah_layanan	= addslashes($this->input->post('rumah_layanan'));
		$jasa	= addslashes($this->input->post('jasa'));
		//$perusahaan	= addslashes($this->input->post('perusahaan'));
		$pic	= addslashes($this->input->post('pic'));
		//$rba	= addslashes($this->input->post('rba'));
		$status	= addslashes($this->input->post('status'));
		$keterangan	= addslashes($this->input->post('keterangan'));
		$tgl_mulai	= addslashes($this->input->post('tgl_mulai'));
		$tgl_akhir	= addslashes($this->input->post('tgl_akhir'));
		//$tgl = htmlspecialchars($this->input->post('daterange'));
		//$startDate  = explode(" ",$tgl)[0];
	  //$endDate    = explode(" ",$tgl)[2];
		$nama_perusahaan	= addslashes($this->input->post('nama_perusahaan'));
		$created_time = DATE("Y-m-d H:i:s");
		$cek = $this->db->query("SELECT id_perusahaan FROM perusahaan WHERE nama_perusahaan='$nama_perusahaan'")->row();
		$cek_perusahaan = $this->db->query("SELECT id_perusahaan FROM perusahaan WHERE nama_perusahaan='$nama_perusahaan'")->num_rows();
		if ($cek_perusahaan == 0)
		{
			echo '<script>alert("Data Client tidak ditemukan");</script>';
			redirect('afin/pilih_kontrak/'.$id_kontrak, 'refresh');
		}
		else
		{
			if ($tgl_mulai > $tgl_akhir)
			{
				echo '<script>alert("Tanggal Akhir lebih kecil dari tanggal Mulai");</script>';
				redirect('afin/pilih_kontrak/'.$id_kontrak, 'refresh');
			}
			else
			{
				$id_perusahaan =  $cek->id_perusahaan;
				$data = array(
					 'id_satker' => $id_satker,
					 'termin' => $termin,
					 'max_operasional' => $max_operasional,
					 'nama_kontrak' => $nama_kontrak,
					 'nilai_kontrak' => $nilai_kontrak,
					 'no_kontrak' => $no_kontrak,
					 'tgl_ttd' => $tgl_ttd,
					 'id_rumah_layanan' => $rumah_layanan,
					 'id_jasa' => $jasa,
					 'id_perusahaan' => $id_perusahaan,
					 'pic' => $pic,
					 //'id_rba' => $rba,
					 'tgl_mulai' => $tgl_mulai,
					 'tgl_akhir' => $tgl_akhir,
					 'status' => $status,
					 'keterangan' => $keterangan
				);
				//echo $tgl_mulai.";".$tgl_akhir.";".$keterangan;
				//echo $nama_kontrak;
				$this->m_kontrak->edit_kontrak($id_kontrak,$data);
				//$last = $this->db->query("SELECT id_kontrak FROM kontrak ORDER BY id_kontrak DESC LIMIT 1")->row();
				$keterangan_kontrak = "Kontrak diedit oleh";
				$data = array(
					 'id_user' => $id_admin,
					 'id_kontrak' => $id_kontrak,
					 'keterangan' => $keterangan_kontrak,
					 'tanggal' => $created_time
				);
				$this->m_kontrak->history_kontrak($data);

				$id_user = $this->session->userdata('admin_id');
				$keterangan = "Edit Kontrak ".$nama_kontrak;
				$data=array(
				 'id_user'=> $id_user,
				 'keterangan'=> $keterangan,
				 'tanggal'=> DATE("Y-m-d H:i:s")
				);
				$this->db->insert('log_history',$data);
				echo '<script>alert("Data Berhasil Disimpan");</script>';
				redirect('afin', 'refresh');
			}
		}
	}

	function simpan_adendum_kontrak()
	{
		$id_admin = $this->session->userdata('admin_id');
		$id_kontrak	= addslashes($this->input->post('id_kontrak'));
		$no_kontrak	= addslashes($this->input->post('no_kontrak'));
		$nilai_kontrak	= addslashes($this->input->post('nilai_kontrak'));
		$tgl_ttd	= addslashes($this->input->post('tgl_ttd'));
		$keterangan	= addslashes($this->input->post('keterangan'));
		$keterangan_adendum	= addslashes($this->input->post('keterangan_adendum'));
		$tgl_mulai	= addslashes($this->input->post('tgl_mulai'));
		$tgl_akhir	= addslashes($this->input->post('tgl_akhir'));
		$created_time = DATE("Y-m-d H:i:s");
		$cek = $this->db->query("SELECT * FROM kontrak WHERE id_kontrak = $id_kontrak")->row();
		//echo $cek->tgl_akhir;
		//echo $tgl_akhir;
		if ($cek->tgl_akhir != $tgl_akhir)
		{
			$set_keterangan = "Adendum Kontrak Tanggal Selesai kontrak diubah dari tanggal ".$cek->tgl_akhir." menjadi tanggal ".$tgl_akhir." Keterangan : ".$keterangan_adendum;
		}
		elseif ($cek->no_kontrak != $no_kontrak)
		{
			$set_keterangan = "Adendum Kontrak Nomor Kontrak diubah dari ".$cek->no_kontrak." menjadi ".$no_kontrak." Keterangan : ".$keterangan_adendum;
		}
		elseif ($cek->keterangan != $keterangan)
		{
			$set_keterangan = "Adendum Kontrak Ruang Lingkup Kontrak diubah dari ".$cek->keterangan." menjadi ".$keterangan." Keterangan : ".$keterangan_adendum;
		}
		if ($tgl_mulai > $tgl_akhir)
		{
			echo '<script>alert("Tanggal Akhir lebih kecil dari tanggal Mulai");</script>';
			redirect('afin/adendum_kontrak/'.$id_kontrak, 'refresh');
		}
		$data_adendum = array(
			 'id_kontrak' => $id_kontrak,
			 'tgl_adendum' => DATE("Y-m-d H:i:s"),
			 'keterangan_adendum' => $set_keterangan
		);
		$this->m_kontrak->adendum_kontrak($data_adendum);
		$data = array(
			 'nilai_kontrak' => $nilai_kontrak,
			 'no_kontrak' => $no_kontrak,
			 'tgl_ttd' => $tgl_ttd,
			 'tgl_mulai' => $tgl_mulai,
			 'tgl_akhir' => $tgl_akhir,
			 'keterangan' => $keterangan
		);
		$this->m_kontrak->edit_kontrak($id_kontrak,$data);
		$keterangan_kontrak = "Kontrak diadendum oleh";
		$data = array(
			 'id_user' => $id_admin,
			 'id_kontrak' => $id_kontrak,
			 'keterangan' => $keterangan_kontrak,
			 'tanggal' => $created_time
		);
		$this->m_kontrak->history_kontrak($data);

		$id_user = $this->session->userdata('admin_id');
		$keterangan = "Adendum Kontrak ".$cek->nama_kontrak;
		$data=array(
		 'id_user'=> $id_user,
		 'keterangan'=> $keterangan,
		 'tanggal'=> DATE("Y-m-d H:i:s")
		);
		$this->db->insert('log_history',$data);

		echo '<script>alert("Data Berhasil Disimpan");</script>';
		redirect('afin', 'refresh');

	}

	function hapus_kontrak()
	{
		$id_kontrak	= $this->uri->segment(3);

		$cek = $this->db->query("SELECT * FROM kontrak WHERE id_kontrak = $id_kontrak")->row();
		$id_user = $this->session->userdata('admin_id');
		$keterangan = "Tambah Kontrak ".$cek->nama_kontrak;
		$data=array(
		 'id_user'=> $id_user,
		 'keterangan'=> $keterangan,
		 'tanggal'=> DATE("Y-m-d H:i:s")
		);
		$this->db->insert('log_history',$data);

		$this->db->query("DELETE FROM kontrak WHERE id_kontrak = $id_kontrak");
		echo '<script>alert("Data Berhasil Dihapus");</script>';
		redirect('afin', 'refresh');
	}

	function upload()
	{
		$id_kontrak	= addslashes($this->input->post('id_kontrak'));
		$created_time = DATE("Y-m-d H:i:s");
		$id_admin = $this->session->userdata('admin_id');
		$uploadpath = './uploads/kontrak';
		$config['upload_path'] = $uploadpath;
		$config['allowed_types'] = 'pdf';
		$config['max_size']	= '20000';
		//$config['file_name'] = "1SuratTugas";
		$this->upload->initialize($config);
		if (!$this->upload->do_upload('file'))
		{
			$error = $this->upload->display_errors();
			echo '<script>alert("Data Gagal Disimpan!'.$error.'");</script>';
			//echo $id_kontrak;
			redirect('afin/detail_kontrak/'.$id_kontrak,'refresh');
		}
		else
		{
			$upload = $this->upload->data();
			$file	= $upload['file_name'];
			$this->db->query("UPDATE kontrak SET file='$file' WHERE id_kontrak=$id_kontrak");
			$data = array(
				 'id_user' => $id_admin,
				 'id_kontrak' => $id_kontrak,
				 'file' => $file,
				 'tanggal' => $created_time
			);
			$this->m_kontrak->history_dokumen($data);
			echo '<script>alert("Data Berhasil disimpan");</script>';
			redirect('afin/detail_kontrak/'.$id_kontrak,'refresh');
		}
	}

	function upload_sk()
	{
		$id_kontrak	= addslashes($this->input->post('id_kontrak'));
		$uploadpath = './uploads';
		$config['upload_path'] = $uploadpath;
		$config['allowed_types'] = 'pdf';
		$config['max_size']	= '20000';
		//$config['file_name'] = "1SuratTugas";
		$this->upload->initialize($config);
		if (!$this->upload->do_upload('sk'))
		{
			$error = $this->upload->display_errors();
			echo '<script>alert("Data Gagal Disimpan!'.$error.'");</script>';
			//echo $id_kontrak;
			redirect('home/afin_detail_kontrak?id='.$id_kontrak,'refresh');
		}
		else
		{
			$upload = $this->upload->data();
			$file	= $upload['file_name'];
			$this->db->query("UPDATE kontrak SET sk='$file' WHERE id_kontrak=$id_kontrak");
			echo '<script>alert("Data Berhasil disimpan");</script>';
			redirect('home/afin_detail_kontrak?id='.$id_kontrak,'refresh');
		}
	}

	function export()
	{
		include APPPATH.'third_party/PHPExcel/PHPExcel.php';

    // Panggil class PHPExcel nya
    $phpexcel = new PHPExcel();
    // Settingan awal fil excel
    $phpexcel->getProperties()->setCreator('Monika ESDM');
    $phpexcel->getProperties()->setLastModifiedBy('Monika ESDM');
    $phpexcel->getProperties()->setTitle("Data Kontrak");

    $phpexcel->setActiveSheetIndex(0); // Set kolom A1 dengan tulisan "DATA SISWA"

    $phpexcel->setActiveSheetIndex(0)->setCellValue('A1', "NO"); // Set kolom A1 dengan tulisan "NO"
    $phpexcel->setActiveSheetIndex(0)->setCellValue('B1', "NAMA KONTRAK"); // Set kolom B1 dengan tulisan "NIS"
    $phpexcel->setActiveSheetIndex(0)->setCellValue('C1', "NO KONTRAK"); // Set kolom B1 dengan tulisan "NIS"
    $phpexcel->setActiveSheetIndex(0)->setCellValue('D1', "NILAI KONTRAK"); // Set kolom B1 dengan tulisan "NIS"
    $phpexcel->setActiveSheetIndex(0)->setCellValue('E1', "TANGGAL MULAI"); // Set kolom B1 dengan tulisan "NIS"
    $phpexcel->setActiveSheetIndex(0)->setCellValue('F1', "TANGGAL SELESAI"); // Set kolom B1 dengan tulisan "NIS"
    $phpexcel->setActiveSheetIndex(0)->setCellValue('G1', "NAMA PERUSAHAAN"); // Set kolom B1 dengan tulisan "NIS"
    $kontrak = $this->m_kontrak->list_kontrak()->result();
    $no = 1; // Untuk penomoran tabel, di awal set dengan 1
    $numrow = 2; // Set baris pertama untuk isi tabel adalah baris ke 4
    foreach($kontrak as $data)
		{ // Lakukan looping pada variabel siswa
      $phpexcel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
      $phpexcel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data->nama_kontrak);
      $phpexcel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data->no_kontrak);
      $phpexcel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data->nilai_kontrak);
      $phpexcel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data->tgl_mulai);
      $phpexcel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $data->tgl_akhir);
      $phpexcel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $data->nama_perusahaan);
      $no = $no + 1;
      $numrow = $numrow + 1;
    }
    $phpexcel->getActiveSheet(0)->setTitle("Data Kontrak");
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="Kontrak.xlsx"'); // Set nama file excel nya
    header('Cache-Control: max-age=0');
    $write = PHPExcel_IOFactory::createWriter($phpexcel, 'Excel2007');
    $write->save('php://output');
  	}

	function ikm()
	{
		$id_satker = $this->session->userdata('admin_id_satker');
		$bulan = DATE("m");
		$tahun = DATE("Y");
		$data['isi'] = 'afin/ikm';
		$data['last_ikm'] = $this->db->query("SELECT * FROM ikm WHERE ikm.id_satker=$id_satker order by 'id_ikm' DESC")->result();

		$this->load->view('new_design/index', $data);
	}

	function input_ikm()
	{
		date_default_timezone_set('Asia/Jakarta');
		$id_satker = $this->session->userdata('admin_id_satker');
		$tanggal_awal	= addslashes($this->input->post('tanggal_awal'));
		$tanggal_akhir	= addslashes($this->input->post('tanggal_akhir'));
		$nilai_ikm	= addslashes($this->input->post('nilai_ikm'));
		$data = array(
			'id_satker' => $id_satker,
			'tanggal_awal' => $tanggal_awal,
			'tanggal_akhir' => $tanggal_akhir,
			'nilai_ikm' => $nilai_ikm,
		);
		$this->db->insert('ikm', $data);

		$id_user = $this->session->userdata('admin_id');
		$keterangan = "Tambah IKM Periode Tanggal  " . $tanggal_awal . "-" . $tanggal_akhir;
		$data = array(
			'id_user' => $id_user,
			'keterangan' => $keterangan,
			'tanggal' => DATE("Y-m-d H:i:s")
		);
		$this->db->insert('log_history', $data);

		$satker = $this->session->userdata('admin_satker');
		$key = $this->session->userdata('admin_key_satker');

		$url = 'https://bios.kemenkeu.go.id/api/token';
		$data = array(
			'satker' => $satker,
			'key' => $key,
		);
		$response = $this->api_bios->get_content_token($url, json_encode($data));
		$response_token = json_decode($response, true);
		$ikm = $this->db->query("SELECT tanggal_akhir as tgl_transaksi, nilai_ikm as nilai_indeks FROM ikm WHERE id_satker=$id_satker order by tanggal_akhir desc")->row_array();
		$url = 'https://bios.kemenkeu.go.id/api/ws/barang_jasa/layanan/ikm_barang_jasa';
		$responseLayanan = $this->api_bios->get_content($url, json_encode($ikm), $response_token['token']);
		$response_bios = json_decode($responseLayanan, true);
		if($id_satker == 1){
			$last_status = $response_bios['message'];
			$data = array(
				'last_status' => $last_status,
				'last_updated' => DATE("Y-m-d H:i:s")
			);
			$this->db->where('id_webservice', 10);
			$this->db->update('webservicebios', $data);
		}
		$tahun = date("Y");
		echo '<script>alert("Data Berhasil Disimpan");</script>';
		redirect('afin/ikm', 'refresh');
	}

	function delete_ikm()
	{
		date_default_timezone_set('Asia/Jakarta');
		$id_ikm	= $this->uri->segment(3);

		$this->db->where('id_ikm', $id_ikm);
		$this->db->delete('ikm');

		$id_satker = $this->session->userdata('admin_id_satker');
		$satker = $this->session->userdata('admin_satker');
		$key = $this->session->userdata('admin_key_satker');

		$url = 'https://bios.kemenkeu.go.id/api/token';
		$data = array(
			'satker' => $satker,
			'key' => $key,
		);
		$response = $this->api_bios->get_content_token($url, json_encode($data));
		$response_token = json_decode($response, true);
		$ikm = $this->db->query("SELECT tanggal_akhir as tgl_transaksi, nilai_ikm as nilai_indeks FROM ikm WHERE id_satker=$id_satker order by tanggal_akhir desc")->row_array();
		$url = 'https://bios.kemenkeu.go.id/api/ws/barang_jasa/layanan/ikm_barang_jasa';
		$responseLayanan = $this->api_bios->get_content($url, json_encode($ikm), $response_token['token']);
		$response_bios = json_decode($responseLayanan, true);
		if($id_satker == 1){
			$last_status = $response_bios['message'];
			$data = array(
				'last_status' => $last_status,
				'last_updated' => DATE("Y-m-d H:i:s")
			);
			$this->db->where('id_webservice', 10);
			$this->db->update('webservicebios', $data);
		}
		$tahun = date("Y");
		$id_user = $this->session->userdata('admin_id');
		$keterangan = "Hapus IKM";
		$data = array(
			'id_user' => $id_user,
			'keterangan' => $keterangan,
			'tanggal' => DATE("Y-m-d H:i:s")
		);
		$this->db->insert('log_history', $data);

		echo '<script>alert("Data Berhasil Dihapus");</script>';
		redirect('afin/ikm', 'refresh');
	}

}
?>
