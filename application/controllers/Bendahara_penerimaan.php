<?php
ini_set('display_startup_errors', 1); error_reporting(E_ALL); 
class Bendahara_penerimaan extends CI_Controller {

	function __construct()
	{
		parent::__construct();
			if($this->session->userdata('admin_kategori') != 5)
			{
				echo '<script>alert("Anda tidak dapat mengakses");</script>';
				$this->session->sess_destroy();
				redirect(base_url('login','refresh'));
			}
		$this->load->helper(array('url','form'));
		$this->load->model(array('m_pimpinan','m_bendahara','m_kontrak'));
		$this->load->library(array('format_terbilang','format_tanggal','api_bios','pdfgenerator'));
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
		$data['isi'] = 'bendahara_penerimaan/content';
		$data['result'] = $this->m_kontrak->list_termin_pembayaran_kontrak()->result();
		$data['result_penerimaan'] = $this->m_kontrak->list_kode_penerimaan()->result();
		$data['jumlah'] = $this->m_kontrak->list_termin_pembayaran_kontrak()->num_rows();
		$this->load->view('new_design/index',$data);
	}

	function old()
	{
		$data['isi'] = 'bendahara_penerimaan/content';
		$data['result'] = $this->m_kontrak->list_termin_pembayaran_kontrak()->result();
		$data['result_penerimaan'] = $this->m_kontrak->list_kode_penerimaan()->result();
		$data['jumlah'] = $this->m_kontrak->list_termin_pembayaran_kontrak()->num_rows();
		$this->load->view('new_design/index',$data);
	}

	function terlambat()
	{
		$id_satker = $this->session->userdata('admin_id_satker');
		$data['status'] = 'terlambat';
		$data['isi'] = 'bendahara_penerimaan/content';
		$data['result'] = $this->db->query("SELECT *, DATEDIFF(CURRENT_DATE(), t.tgl_termin) AS selisih FROM termin AS t INNER JOIN kontrak AS k ON t.id_kontrak = k.id_kontrak INNER JOIN perusahaan AS p ON k.id_perusahaan=p.id_perusahaan WHERE t.status_cetak_invoice = 1 AND t.status_pembayaran=0 AND DATEDIFF(CURRENT_DATE(), t.tgl_termin) > 30 AND k.status='K' AND k.id_satker=$id_satker")->result();
		$data['result_penerimaan'] = $this->m_kontrak->list_kode_penerimaan()->result();
		$data['jumlah'] = $this->db->query("SELECT *, DATEDIFF(CURRENT_DATE(), t.tgl_termin) AS selisih FROM termin AS t INNER JOIN kontrak AS k ON t.id_kontrak = k.id_kontrak INNER JOIN perusahaan AS p ON k.id_perusahaan=p.id_perusahaan WHERE t.status_cetak_invoice = 1 AND t.status_pembayaran=0 AND DATEDIFF(CURRENT_DATE(), t.tgl_termin) > 30 AND k.status='K' AND k.id_satker=$id_satker")->num_rows();
		$this->load->view('new_design/index',$data);
	}

	function realisasi()
	{
		$data['status'] = 'realisasi';
		$data['isi'] = 'bendahara_penerimaan/content';
		$data['result'] = $this->m_kontrak->list_termin_pembayaran_kontrak_realisasi()->result();
		$data['result_penerimaan'] = $this->m_kontrak->list_kode_penerimaan()->result();
		$data['jumlah'] = $this->m_kontrak->list_termin_pembayaran_kontrak_realisasi()->num_rows();
		$this->load->view('new_design/index',$data);
	}

	function list_kategori()
	{
		$data['isi'] = 'admin/bendahara_penerimaan_kategori_po';
		$data['result'] = $this->m_kontrak->list_kategori_layanan()->result();
		//$data['result_penerimaan'] = $this->m_kontrak->list_kode_penerimaan()->result();
		//$data['jumlah'] = $this->m_kontrak->list_termin_pembayaran()->num_rows();
		$this->load->view('new/index',$data);
	}

	function list_po()
	{
		$kategori = $this->uri->segment(3);
		//$data['isi'] = 'admin/bendahara_penerimaan_list_po';
		$data['isi'] = 'bendahara_penerimaan/list_po';
		$data['result'] = $this->m_kontrak->list_po($kategori)->result();
		$data['result_penerimaan'] = $this->m_kontrak->list_kode_penerimaan()->result();
		$data['jumlah'] = $this->m_kontrak->list_po($kategori)->num_rows();
		$data['kategori'] = $kategori;
		$this->load->view('new_design/index',$data);
	}

	function input_po()
	{
		$kategori = $this->uri->segment(3);
		$id_satker = $this->session->userdata('admin_id_satker');
		if($kategori == 1)
		{
			$data['isi'] = 'bendahara_penerimaan/input_lab';
		}
		elseif($kategori == 2)
		{
			$data['isi'] = 'bendahara_penerimaan/input_gedung';
		}
		elseif($kategori == 3)
		{
			$data['isi'] = 'bendahara_penerimaan/input_wisma';
		}
		elseif($kategori == 4)
		{
			$data['isi'] = 'bendahara_penerimaan/input_lain';
		}
		$data['perusahaan'] = $this->m_kontrak->list_perusahaan()->result();
		$data['result_client'] = $this->db->query("SELECT * FROM perusahaan WHERE id_satker = $id_satker AND kategori=5")->result();
		$data['result_client_all'] = $this->db->query("SELECT * FROM perusahaan WHERE id_satker = $id_satker")->result();
		$data['result'] = $this->db->query("SELECT * FROM detail_layanan WHERE id_kategori = 4 AND id_satker = 2 AND kode_layanan LIKE 'BLK.BLU%' ")->result();
		$data['kategori'] = $kategori;
		$this->load->view('new_design/index',$data);
	}

	function edit_po()
	{
		$id_termin = $this->uri->segment(3);
		$id_kontrak = $this->uri->segment(4);
		$kategori = $this->uri->segment(5);
		$id_satker = $this->session->userdata('admin_id_satker');
		if($kategori == 1)
		{
			$data['isi'] = 'admin/bendahara_edit_lab';
		}
		elseif($kategori == 2)
		{
			$data['isi'] = 'admin/bendahara_edit_gedung';
		}
		elseif($kategori == 3)
		{
			$data['isi'] = 'admin/bendahara_edit_wisma';
		}
		elseif($kategori == 4)
		{
			$data['isi'] = 'admin/bendahara_edit_lain';
		}
		$data['hasil'] = $this->db->query("SELECT *,rl.nama AS rumah_layanan,p2.nama AS pejabat_teknis,LEFT(k.created_time,10) AS tanggal,per.nama_perusahaan,k.kategori AS kategori_kesdm,k.keterangan AS keterangan_termin  FROM kontrak AS k
																			 INNER JOIN rumah_layanan AS rl ON k.id_rumah_layanan = rl.id_rumah_layanan
																			 INNER JOIN detail_layanan AS dl ON k.id_jasa = dl.id_detail
																			 INNER JOIN jenis_layanan AS jl ON dl.id_layanan = jl.id_jenis_layanan
																			 INNER JOIN perusahaan AS per ON k.id_perusahaan = per.id_perusahaan
																			 INNER JOIN pegawai2 AS p2 ON rl.id_pegawai = p2.id
																			 INNER JOIN termin AS t ON t.id_kontrak = k.id_kontrak
																			 WHERE k.id_kontrak = $id_kontrak")->row();
		$data['result_client'] = $this->db->query("SELECT * FROM perusahaan WHERE id_satker = $id_satker AND kategori=5")->result();
		$data['result_client_all'] = $this->db->query("SELECT * FROM perusahaan WHERE id_satker = $id_satker")->result();
		$data['result'] = $this->db->query("SELECT * FROM detail_layanan WHERE id_kategori = $kategori AND id_satker = $id_satker")->result();
		$data['kategori'] = $kategori;
		$this->load->view('new/index',$data);
	}

	function add_po()
	{
		$data['isi'] = 'admin/bendahara_input_po';
		$data['rumah_layanan'] = $this->m_kontrak->list_rumah_layanan()->result();
		$data['detail_layanan'] = $this->m_kontrak->list_detail_layanan()->result();
		$data['perusahaan'] = $this->m_kontrak->list_perusahaan()->result();
		$data['pegawai'] = $this->m_kontrak->list_pegawai()->result();
		$data['rba'] = $this->m_kontrak->list_rba()->result();
		$this->load->view('new/index',$data);
	}

	// function tambah_po()
	// {
	// 	echo $nama_perusahaan	= addslashes($this->input->post('nama_perusahaan'));
	// 	$cek = $this->db->query("SELECT id_perusahaan FROM perusahaan WHERE nama_perusahaan='$nama_perusahaan'")->row();
	// 	echo $cek->id_perusahaan;
	// }

	function tambah_po()
	{ 
		$tahun = DATE("Y");
		$id_satker = $this->session->userdata('admin_id_satker');
		$id_admin = $this->session->userdata('admin_id');
		//$nama_kontrak	= addslashes($this->input->post('nama_kontrak'));
		$kategori	= addslashes($this->input->post('kategori'));
		$kategori_kesdm	= addslashes($this->input->post('kategori_kesdm'));
		$nilai_kontrak	= addslashes($this->input->post('nilai_kontrak'));
		$no_kontrak	= addslashes($this->input->post('no_kontrak'));
		//$tgl_ttd	= addslashes($this->input->post('tgl_ttd'));
		//$rumah_layanan	= addslashes($this->input->post('rumah_layanan'));
		//$jasa	= addslashes($this->input->post('jasa'));
		$id_jasa	= addslashes($this->input->post('id_jasa'));
		//$perusahaan	= addslashes($this->input->post('perusahaan'));
		//$id_perusahaan	= addslashes($this->input->post('id_perusahaan'));
		$nama_perusahaan	= addslashes($this->input->post('nama_perusahaan'));
		$cek = $this->db->query("SELECT id_perusahaan FROM perusahaan WHERE nama_perusahaan='$nama_perusahaan'")->row();
		$cek_perusahaan = $this->db->query("SELECT id_perusahaan FROM perusahaan WHERE nama_perusahaan='$nama_perusahaan'")->num_rows();
		$no_lab	= addslashes($this->input->post('no_lab'));
		$keterangan	= addslashes($this->input->post('keterangan'));
		$jumlah_sample	= addslashes($this->input->post('jumlah_sample'));
		$tgl_acara	= addslashes($this->input->post('tgl_acara'));
		$waktu_acara	= addslashes($this->input->post('waktu_acara'));
		$tgl_checkin	= addslashes($this->input->post('tgl_checkin'));
		$tgl_checkout	= addslashes($this->input->post('tgl_checkout'));
		$jumlah_kamar	= addslashes($this->input->post('jumlah_kamar'));
		if ($cek_perusahaan == 0)
		{
			echo '<script>alert("Data Client tidak ditemukan");</script>';
			redirect('bendahara_penerimaan/input_po/'.$kategori, 'refresh');
		}
		else
		{
			if ($kategori == 3)
			{
				if ($tgl_checkin > $tgl_checkout)
				{
					echo '<script>alert("Tanggal Check In lebih besar dari Tanggal Check Out");</script>';
					redirect('bendahara_penerimaan/input_po/'.$kategori, 'refresh');
				}
			}
			$id_perusahaan =  $cek->id_perusahaan;
			$urutan = $this->db->query("SELECT COUNT(id_termin) AS jumlah FROM termin WHERE no_invoice IS NOT NULL")->row();
			$nomor = $urutan->jumlah + 1;
			if ($nomor < 10) {
				$nomor = "00".$nomor;
			}
			elseif ($nomor > 9 && $nomor <100) {
				$nomor = "0".$nomor;
			}
			elseif ($nomor > 99 && $nomor <1000) {
				$nomor = $nomor;
			}
			$rumah_layanan = $this->db->query("SELECT id_rumah_layanan FROM jenis_layanan WHERE id_jenis_layanan=(SELECT id_layanan FROM detail_layanan WHERE id_detail = $id_jasa)")->row();
			$kode_rumah_layanan = $this->db->query("SELECT kode FROM rumah_layanan WHERE id_rumah_layanan=$rumah_layanan->id_rumah_layanan")->row();
			$kode_detail_layanan = $this->db->query("SELECT kode_layanan FROM detail_layanan WHERE id_detail=$id_jasa")->row();
			//$no_invoice = $nomor."/".$kode_rumah_layanan->kode."/PO/".$kode_detail_layanan->kode_layanan."/".$tahun;
			$no_invoice	= addslashes($this->input->post('no_invoice'));
			$tgl_termin	= addslashes($this->input->post('tgl_termin'));
			$created_time = DATE("Y-m-d H:i:s");
			$tanggal = DATE("Y-m-d");
			$data = array(
				 'id_satker' => $id_satker,
				 'no_lab' => $no_lab,
				 'jumlah_sample' => $jumlah_sample,
				 //'nama_kontrak' => $nama_kontrak,
				 'nilai_kontrak' => $nilai_kontrak,
				 'kategori' => $kategori_kesdm,
				 //'no_kontrak' => $no_kontrak,
				 'tgl_akhir'=> $tanggal,
				 'tgl_mulai'=> $tanggal,
				 'tgl_acara' => $tgl_acara,
				 'waktu_acara' => $waktu_acara,
				 'id_rumah_layanan' => $rumah_layanan->id_rumah_layanan,
				 'id_jasa' => $id_jasa,
				 'id_perusahaan' => $id_perusahaan,
				 'tgl_checkin' => $tgl_checkin,
				 'tgl_checkout' => $tgl_checkout,
				 'jumlah_kamar' => $jumlah_kamar,
				 'created_time' => $created_time,
				 'created_by' => $id_admin,
				 'termin'=> 1,
				 'status' => 'PO',
				 'keterangan' => $keterangan
			);
			//echo $tgl_mulai.";".$tgl_akhir.";".$keterangan;
			$this->m_kontrak->add_kontrak($data);
			$last = $this->db->query("SELECT id_kontrak FROM kontrak ORDER BY id_kontrak DESC LIMIT 1 ")->row();
			$data_termin=array(
			 'id_kontrak'=> $last->id_kontrak,
			 'termin'=> 1,
			 'status_termin'=> 1,
			 //'tgl_termin'=> $tanggal,
			 'tgl_termin'=> $tgl_termin,
			 'no_invoice' => $no_invoice,
			 'jumlah'=> $nilai_kontrak
		 );
		 	$this->db->insert('termin',$data_termin);
			echo '<script>alert("Data Berhasil Disimpan");</script>';
			redirect('bendahara_penerimaan/list_po/'.$kategori, 'refresh');
		}

	}

	function simpan_edit_po()
	{
		$tahun = DATE("Y");
		$id_satker = $this->session->userdata('admin_id_satker');
		$id_admin = $this->session->userdata('admin_id');
		$kategori	= addslashes($this->input->post('kategori'));
		$id_kontrak	= addslashes($this->input->post('id_kontrak'));
		$id_termin	= addslashes($this->input->post('id_termin'));
		$kategori_kesdm	= addslashes($this->input->post('kategori_kesdm'));
		$nilai_kontrak	= addslashes($this->input->post('nilai_kontrak'));
		$id_jasa	= addslashes($this->input->post('id_jasa'));
		$nama_perusahaan	= addslashes($this->input->post('nama_perusahaan'));
		$cek = $this->db->query("SELECT id_perusahaan FROM perusahaan WHERE nama_perusahaan='$nama_perusahaan'")->row();
		$cek_perusahaan = $this->db->query("SELECT id_perusahaan FROM perusahaan WHERE nama_perusahaan='$nama_perusahaan'")->num_rows();

		$no_lab	= addslashes($this->input->post('no_lab'));
		$keterangan	= addslashes($this->input->post('keterangan'));
		$jumlah_sample	= addslashes($this->input->post('jumlah_sample'));
		$tgl_acara	= addslashes($this->input->post('tgl_acara'));
		$waktu_acara	= addslashes($this->input->post('waktu_acara'));
		$tgl_checkin	= addslashes($this->input->post('tgl_checkin'));
		$tgl_checkout	= addslashes($this->input->post('tgl_checkout'));
		$jumlah_kamar	= addslashes($this->input->post('jumlah_kamar'));
		$rumah_layanan = $this->db->query("SELECT id_rumah_layanan FROM jenis_layanan WHERE id_jenis_layanan=(SELECT id_layanan FROM detail_layanan WHERE id_detail = $id_jasa)")->row();
		$kode_rumah_layanan = $this->db->query("SELECT kode FROM rumah_layanan WHERE id_rumah_layanan=$rumah_layanan->id_rumah_layanan")->row();
		$kode_detail_layanan = $this->db->query("SELECT kode_layanan FROM detail_layanan WHERE id_detail=$id_jasa")->row();
		$no_invoice	= addslashes($this->input->post('no_invoice'));
		$tgl_termin	= addslashes($this->input->post('tgl_termin'));
		$created_time = DATE("Y-m-d H:i:s");
		$tanggal = DATE("Y-m-d");
		if ($cek_perusahaan == 0)
		{
			echo '<script>alert("Data Client tidak ditemukan");</script>';
			redirect('bendahara_penerimaan/edit_po/'.$id_termin.'/'.$id_kontrak.'/'.$kategori, 'refresh');
		}
		else
		{
			if ($kategori == 3)
			{
				if ($tgl_checkin > $tgl_checkout)
				{
					echo '<script>alert("Tanggal Check In lebih besar dari Tanggal Check Out");</script>';
					redirect('bendahara_penerimaan/edit_po/'.$id_termin.'/'.$id_kontrak.'/'.$kategori, 'refresh');
				}
			}
			$id_perusahaan =  $cek->id_perusahaan;
			$data = array(
			 'id_satker' => $id_satker,
			 'no_lab' => $no_lab,
			 'jumlah_sample' => $jumlah_sample,
			 'nilai_kontrak' => $nilai_kontrak,
			 'kategori' => $kategori_kesdm,
			 'tgl_akhir'=> $tanggal,
			 'tgl_acara' => $tgl_acara,
			 'waktu_acara' => $waktu_acara,
			 'id_rumah_layanan' => $rumah_layanan->id_rumah_layanan,
			 'id_jasa' => $id_jasa,
			 'id_perusahaan' => $id_perusahaan,
			 'tgl_checkin' => $tgl_checkin,
			 'tgl_checkout' => $tgl_checkout,
			 'jumlah_kamar' => $jumlah_kamar,
			 'created_time' => $created_time,
			 'created_by' => $id_admin,
			 'termin'=> 1,
			 'status' => 'PO',
			 'keterangan' => $keterangan
		);
		$this->db->where('id_kontrak', $id_kontrak);
		$this->db->update('kontrak', $data);
		$data_termin=array(
			 'id_kontrak'=> $id_kontrak,
			 'tgl_termin'=> $tgl_termin,
			 'no_invoice' => $no_invoice,
			 'jumlah'=> $nilai_kontrak
		);
		$this->db->where('id_termin', $id_termin);
		$this->db->update('termin', $data_termin);
	 	//$this->db->insert('termin',$data_termin);
		echo '<script>alert("Data Berhasil Disimpan");</script>';
		redirect('bendahara_penerimaan/list_po/'.$kategori, 'refresh');
		}
	}

	function preview_po()
	{
		 $kategori	= $this->uri->segment(3);
		 $id_kontrak	= $this->uri->segment(4);
		 //$data['result'] = $this->db->query("SELECT k.id_kontrak,k.nama_kontrak,k.nilai_kontrak,rl.nama AS rumah_layanan,p2.nama AS pejabat_teknis,dl.nama_layanan,k.keterangan,LEFT(k.created_time,10) AS tanggal,k.no_lab,k.jumlah_sample,k.no_sertifikat,k.tgl_sertifikat,t.no_invoice,t.no_kwitansi,t.tgl_termin  FROM kontrak AS k
		 $data['result'] = $this->db->query("SELECT *,rl.nama AS rumah_layanan,p2.nama AS pejabat_teknis,LEFT(k.created_time,10) AS tanggal,per.nama_perusahaan,k.kategori AS kategori_kesdm  FROM kontrak AS k
		 																		INNER JOIN rumah_layanan AS rl ON k.id_rumah_layanan = rl.id_rumah_layanan
																				INNER JOIN detail_layanan AS dl ON k.id_jasa = dl.id_detail
		 																		INNER JOIN jenis_layanan AS jl ON dl.id_layanan = jl.id_jenis_layanan
		 																		INNER JOIN perusahaan AS per ON k.id_perusahaan = per.id_perusahaan
		 																		INNER JOIN pegawai2 AS p2 ON rl.id_pegawai = p2.id
																				INNER JOIN termin AS t ON t.id_kontrak = k.id_kontrak
		 																		WHERE k.id_kontrak = $id_kontrak")->row();
		if($kategori == 1)
				{
					$data['isi'] = 'admin/bendahara_detail_lab';
				}
		elseif($kategori == 2)
				{
					$data['isi'] = 'admin/bendahara_detail_gedung';
				}
		elseif($kategori == 3)
				{
					$data['isi'] = 'admin/bendahara_detail_wisma';
				}
		elseif($kategori == 4)
				{
					$data['isi'] = 'admin/bendahara_detail_lainnya';
				}
		 //$data['isi'] = 'admin/bendahara_detail_kontrak';
		 $this->load->view('new/index',$data);
	}


	function list_ba_po()
	{
		//$data['isi'] = 'admin/bendahara_penerimaan_list_ba_po';
		$data['isi'] = 'bendahara_penerimaan/list_ba_po';
		$data['result'] = $this->m_bendahara->list_ba()->result();
		$this->load->view('new_design/index',$data);
	}

	function rekap_po_all()
	{
		$data['isi'] = 'admin/bendahara_rekap_po';
		$data['layanan'] = $this->m_bendahara->list_jenis_layanan()->result();
		$this->load->view('new/index',$data);
	}

	function cetak_rekap_po()
	{
		$kategori = $this->uri->segment(3);
		//$data['result'] = $this->m_bendahara->cetak_ba_po_kategori($kategori)->result();
		$this->data['result'] = $this->m_bendahara->cetak_ba_po_kategori($kategori)->result();
		$this->data['title_pdf'] = 'REKAP PO MONIKA';
		// filename dari pdf ketika didownload
		$file_pdf = 'rekap_po';
		// setting paper
		$paper = 'A4';
		//orientasi paper potrait / landscape
		$orientation = "landscape";
		if($kategori == 1)
		{
			//$orientation = "landscape";
			$html = $this->load->view('cetak/bendahara_cetak_rekap_po_lab',$this->data, true, $data);
			//$this->load->view('admin/bendahara_cetak_rekap_po_lab',$data);
		}
		elseif($kategori == 2)
		{
			$html = $this->load->view('cetak/bendahara_cetak_rekap_po_gedung',$this->data, true, $data);
			//$this->load->view('admin/bendahara_cetak_rekap_po_gedung',$data);
		}
		elseif($kategori == 3)
		{
			$html = $this->load->view('cetak/bendahara_cetak_rekap_po_wisma',$this->data, true, $data);
			//$this->load->view('admin/bendahara_cetak_rekap_po_wisma',$data);
		}
		elseif($kategori == 4)
		{
			$html = $this->load->view('cetak/bendahara_cetak_rekap_po_lainnya',$this->data, true, $data);
			//$this->load->view('admin/bendahara_cetak_rekap_po_lainnya',$data);
		}
		//$html = $this->load->view('cetak/bendahara_invoice',$this->data, true, $data);
		// run dompdf
		//$this->pdfgenerator->set_option('isRemoteEnabled', true);
		$this->pdfgenerator->generate($html, $file_pdf,$paper,$orientation);
	}

	function cetak_invoice()
	{
		$id = $this->uri->segment(3);
		$id_jasa = $this->uri->segment(4);
		$id_rumah_layanan = $this->uri->segment(5);
		$data['result'] = $this->m_bendahara->cetak_invoice($id)->row();
		$get = $this->m_bendahara->cetak_invoice($id)->row();
		$data['terbilang'] = $this->format_terbilang->terbilang($get->jumlah);
		$tanggal = DATE("Y-m-d");
		$tahun = DATE("Y");
		$urutan = $this->db->query("SELECT COUNT(id_termin) AS jumlah FROM termin WHERE no_invoice IS NOT NULL")->row();
		$nomor = $urutan->jumlah + 1;
		if ($nomor < 10) {
			$nomor = "00".$nomor;
		}
		elseif ($nomor > 9 && $nomor <100) {
			$nomor = "0".$nomor;
		}
		elseif ($nomor > 99 && $nomor <1000) {
			$nomor = $nomor;
		}
		$rumah_layanan = $this->db->query("SELECT id_rumah_layanan FROM jenis_layanan WHERE id_jenis_layanan=(SELECT id_layanan FROM detail_layanan WHERE id_detail = $id_jasa)")->row();
		$kode_rumah_layanan = $this->db->query("SELECT kode FROM rumah_layanan WHERE id_rumah_layanan=$id_rumah_layanan")->row();
		$kode_detail_layanan = $this->db->query("SELECT kode_layanan FROM detail_layanan WHERE id_detail=$id_jasa")->row();
		$no_invoice = $nomor."/".$kode_rumah_layanan->kode."/K/".$kode_detail_layanan->kode_layanan."/".$tahun;
		$this->db->query("UPDATE termin SET status_cetak_invoice=1,status_termin=1,tgl_invoice='$tanggal',no_invoice='$no_invoice' WHERE id_termin=$id");
		//$this->load->view('admin/bendahara_invoice',$data);
		redirect('bendahara_penerimaan', 'refresh');
	}

	function preview_invoice()
	{
		$id = $this->uri->segment(3);
		$id_satker = $this->session->userdata('admin_id_satker');
		$this->data['result'] = $this->m_bendahara->cetak_invoice($id)->row();
		$get = $this->m_bendahara->cetak_invoice($id)->row();
		$this->data['terbilang'] = $this->format_terbilang->terbilang($get->jumlah);
		$this->data['satker'] = $this->db->query("SELECT * FROM satker WHERE id_satker = $id_satker")->row();
		$this->data['title_pdf'] = 'Invoice MONIKA';
		// filename dari pdf ketika didownload
		$file_pdf = 'invoice';
		// setting paper
		$paper = 'A4';
		//orientasi paper potrait / landscape
		$orientation = "portrait";
		$html = $this->load->view('cetak/bendahara_invoice',$this->data, true, $data);
		// run dompdf
		//$this->pdfgenerator->set_option('isRemoteEnabled', true);
		$this->pdfgenerator->generate($html, $file_pdf,$paper,$orientation);
		//$this->load->view('admin/bendahara_invoice',$data);
	}

	function cetak_invoice_po()
	{
		$id = $this->uri->segment(3);
		$kategori	= $this->uri->segment(4);
		$data['result'] = $this->m_bendahara->cetak_invoice_po($id)->row();
		$get = $this->m_bendahara->cetak_invoice_po($id)->row();
		$data['terbilang'] = $this->format_terbilang->terbilang($get->jumlah);
		$tanggal = DATE("Y-m-d");
		$this->db->query("UPDATE termin SET status_cetak_invoice=1,tgl_invoice='$tanggal' WHERE id_termin=$id");
		echo '<script>alert("Data Berhasil Disimpan");</script>';
		redirect('bendahara_penerimaan/list_po/'.$kategori, 'refresh');
		//$this->load->view('admin/bendahara_invoice_po',$data);
	}

	function preview_cetak_invoice_po()
	{
		$id = $this->uri->segment(3);
		$id_satker = $this->session->userdata('admin_id_satker');
		//$kategori	= $this->uri->segment(4);
		$this->data['result'] = $this->m_bendahara->cetak_invoice_po($id)->row();
		$get = $this->m_bendahara->cetak_invoice_po($id)->row();
		$this->data['terbilang'] = $this->format_terbilang->terbilang($get->jumlah);
		$tanggal = DATE("Y-m-d");
		$this->data['satker'] = $this->db->query("SELECT * FROM satker WHERE id_satker = $id_satker")->row();
		//echo '<script>alert("Data Berhasil Disimpan");</script>';
		//redirect('bendahara_penerimaan/list_po/'.$kategori, 'refresh');
		$this->data['title_pdf'] = 'Invoice MONIKA';
		// filename dari pdf ketika didownload
		$file_pdf = 'invoice';
		// setting paper
		$paper = 'A4';
		//orientasi paper potrait / landscape
		$orientation = "portrait";
		$html = $this->load->view('cetak/bendahara_invoice',$this->data, true, $data);
		// run dompdf
		//$this->pdfgenerator->set_option('isRemoteEnabled', true);
		$this->pdfgenerator->generate($html, $file_pdf,$paper,$orientation);
		//$this->load->view('admin/bendahara_invoice_po',$data);
	}

	function cetak_kwitansi()
	{
		$id = $this->uri->segment(3);
		$id_jasa = $this->uri->segment(4);
		$id_rumah_layanan = $this->uri->segment(5);
		$data['result'] = $this->m_bendahara->cetak_invoice($id)->row();
		$get = $this->m_bendahara->cetak_invoice($id)->row();
		$data['terbilang'] = $this->format_terbilang->terbilang($get->jumlah);
		$tanggal = DATE("Y-m-d");
		$tahun = DATE("Y");
		$urutan = $this->db->query("SELECT COUNT(id_termin) AS jumlah FROM termin WHERE no_kwitansi IS NOT NULL")->row();
		$nomor = $urutan->jumlah + 1;
		if ($nomor < 10) {
			$nomor = "00".$nomor;
		}
		elseif ($nomor > 9 && $nomor <100) {
			$nomor = "0".$nomor;
		}
		elseif ($nomor > 99 && $nomor <1000) {
			$nomor = $nomor;
		}
		$rumah_layanan = $this->db->query("SELECT id_rumah_layanan FROM jenis_layanan WHERE id_jenis_layanan=(SELECT id_layanan FROM detail_layanan WHERE id_detail = $id_jasa)")->row();
		$kode_rumah_layanan = $this->db->query("SELECT kode FROM rumah_layanan WHERE id_rumah_layanan=$id_rumah_layanan")->row();
		$kode_detail_layanan = $this->db->query("SELECT kode_layanan FROM detail_layanan WHERE id_detail=$id_jasa")->row();
		$no_kwitansi = $nomor."/".$kode_rumah_layanan->kode."/KW/".$kode_detail_layanan->kode_layanan."/".$tahun;
		$this->db->query("UPDATE termin SET status_cetak_kwitansi=1,tgl_kwitansi='$tanggal',no_kwitansi='$no_kwitansi' WHERE id_termin=$id");
		//$this->load->view('admin/bendahara_kwitansi',$data);
		redirect('bendahara_penerimaan', 'refresh');
	}

	function preview_kwitansi()
	{
		$id = $this->uri->segment(3);
		$id_satker = $this->session->userdata('admin_id_satker');
		$this->data['result'] = $this->m_bendahara->cetak_invoice($id)->row();
		$get = $this->m_bendahara->cetak_invoice($id)->row();
		$this->data['terbilang'] = $this->format_terbilang->terbilang($get->jumlah);
		$this->data['satker'] = $this->db->query("SELECT * FROM satker WHERE id_satker = $id_satker")->row();
		$this->data['title_pdf'] = 'Kuitansi MONIKA';
		// filename dari pdf ketika didownload
		$file_pdf = 'kuitansi';
		// setting paper
		$paper = 'A4';
		//orientasi paper potrait / landscape
		$orientation = "portrait";
		$html = $this->load->view('cetak/bendahara_kwitansi',$this->data, true, $data);
		// run dompdf
		//$this->pdfgenerator->set_option('isRemoteEnabled', true);
		$this->pdfgenerator->generate($html, $file_pdf,$paper,$orientation);
		//$this->load->view('admin/bendahara_kwitansi',$data);
	}

	function cetak_kwitansi_po()
	{
		$id = $this->uri->segment(3);
		$kategori = $this->uri->segment(4);
		$tanggal = DATE("Y-m-d");
		$tahun = DATE("Y");
		$urutan = $this->db->query("SELECT COUNT(id_termin) AS jumlah FROM termin WHERE no_kwitansi IS NOT NULL")->row();
		$nomor = $urutan->jumlah + 1;
		if ($nomor < 10) {
			$nomor = "00".$nomor;
		}
		elseif ($nomor=10 && $nomor <100) {
			$nomor = "0".$nomor;
		}
		elseif ($nomor=100 && $nomor <1000) {
			$nomor = $nomor;
		}
		$get = $this->m_bendahara->cetak_invoice_po($id)->row();
		$rumah_layanan = $this->db->query("SELECT id_rumah_layanan FROM jenis_layanan WHERE id_jenis_layanan=(SELECT id_layanan FROM detail_layanan WHERE id_detail = $get->id_jasa)")->row();
		$kode_rumah_layanan = $this->db->query("SELECT kode FROM rumah_layanan WHERE id_rumah_layanan=$rumah_layanan->id_rumah_layanan")->row();
		$kode_detail_layanan = $this->db->query("SELECT kode_layanan FROM detail_layanan WHERE id_detail=$get->id_jasa")->row();
		$no_kwitansi = $nomor."/".$kode_rumah_layanan->kode."/KW/".$kode_detail_layanan->kode_layanan."/".$tahun;
		$this->db->query("UPDATE termin SET status_cetak_kwitansi=1,tgl_kwitansi='$tanggal',no_kwitansi='$no_kwitansi' WHERE id_termin=$id");
		$data['result'] = $this->m_bendahara->cetak_invoice_po($id)->row();
		$get = $this->m_bendahara->cetak_invoice_po($id)->row();
		$data['terbilang'] = $this->format_terbilang->terbilang($get->jumlah_realisasi);
		echo '<script>alert("Data Berhasil Disimpan");</script>';
		redirect('bendahara_penerimaan/list_po/'.$kategori, 'refresh');
		//$this->load->view('admin/bendahara_kwitansi_po',$data);
	}

	function preview_cetak_kwitansi_po()
	{
		$id = $this->uri->segment(3);
		$id_satker = $this->session->userdata('admin_id_satker');
		$this->data['result'] = $this->m_bendahara->cetak_invoice_po($id)->row();
		$get = $this->m_bendahara->cetak_invoice_po($id)->row();
		$this->data['terbilang'] = $this->format_terbilang->terbilang($get->jumlah_realisasi);
		$this->data['satker'] = $this->db->query("SELECT * FROM satker WHERE id_satker = $id_satker")->row();
		$this->data['title_pdf'] = 'Kuitansi MONIKA';
		// filename dari pdf ketika didownload
		$file_pdf = 'kuitansi';
		// setting paper
		$paper = 'A4';
		//orientasi paper potrait / landscape
		$orientation = "portrait";
		$html = $this->load->view('cetak/bendahara_kwitansi',$this->data, true, $data);
		// run dompdf
		//$this->pdfgenerator->set_option('isRemoteEnabled', true);
		$this->pdfgenerator->generate($html, $file_pdf,$paper,$orientation);
		//$this->load->view('admin/bendahara_kwitansi_po',$data);
	}

	function cetak_berita_acara()
	{
		$id = $this->uri->segment(3);
		$this->data['result'] = $this->m_bendahara->cetak_ba_po($id)->result();
		$this->data['title_pdf'] = 'BERITA ACARA MONIKA';
		// filename dari pdf ketika didownload
		$file_pdf = 'berita_acara';
		// setting paper
		$paper = 'A4';
		//orientasi paper potrait / landscape
		$orientation = "portrait";
		$html = $this->load->view('cetak/bendahara_berita_acara_po',$this->data, true, $data);
		// run dompdf
		//$this->pdfgenerator->set_option('isRemoteEnabled', true);
		$this->pdfgenerator->generate($html, $file_pdf,$paper,$orientation);
		//$this->load->view('admin/bendahara_berita_acara_po',$data);
	}

	function bendahara_pindah()
	{
		$id = $this->uri->segment(3);
		$data['isi'] = 'home/bendahara_pindah_po';
		$data['hasil_po'] = $this->m_bendahara->cetak_kwitansi_po($id)->row();
		$this->load->view('home/bendahara_index',$data);
	}

	function input_realisasi_po()
	{
		$kategori	= addslashes($this->input->post('kategori'));
		$id_termin	= addslashes($this->input->post('id_termin'));
		$id_kontrak	= addslashes($this->input->post('id_kontrak'));
		$id_penerimaan	= addslashes($this->input->post('id_penerimaan'));
		$tgl_pembayaran	= addslashes($this->input->post('tgl_pembayaran'));
		$jumlah_realisasi	= addslashes($this->input->post('jumlah_realisasi'));
		//$no_lab	= addslashes($this->input->post('no_lab'));
		$no_sertifikat	= addslashes($this->input->post('no_sertifikat'));
		$tgl_sertifikat	= addslashes($this->input->post('tgl_sertifikat'));
		$cek = $this->db->query("SELECT * FROM kontrak WHERE id_kontrak = $id_kontrak")->row();
		/*if ($tgl_pembayaran < $cek->tgl_akhir)
		{
			echo '<script>alert("Tanggal Pembayaran tidak boleh kurang dari tanggal PO");</script>';
			redirect('bendahara_penerimaan/list_po/'.$kategori, 'refresh');
		}
		else
		{*/
			$data_termin=array(
				'id_penerimaan'=> $id_penerimaan,
				'status_pembayaran'=> 1,
			 'tgl_pembayaran'=> $tgl_pembayaran,
			 'jumlah_realisasi'=> $jumlah_realisasi
		 	);
			$this->db->where('id_termin', $id_termin);
	 	 	$this->db->update('termin', $data_termin);
			if ($kategori == 1)
			{
				$data=array(
				 'no_sertifikat'=> $no_sertifikat,
				 'tgl_sertifikat'=> $tgl_sertifikat
				 //'no_lab'=> $no_lab

			 );
			 $this->db->where('id_kontrak', $id_kontrak);
	  	         $this->db->update('kontrak', $data);
			}

			$satker = $this->session->userdata('admin_satker');
			$key = $this->session->userdata('admin_key_satker');

			$kode_akun = $this->db->query("SELECT kode FROM akun_penerimaan WHERE id_akun=$id_penerimaan")->row();
			$tgl_transaksi =  date("Y/m/d", strtotime($tgl_pembayaran));

			$url = 'https://bios.kemenkeu.go.id/api/token';
			$data = array(
				'satker' => $satker,
				'key' => $key,
			);
			$tahun = date("Y");
			$yesterday = strtotime("yesterday");
			$id_satker = $this->session->userdata('admin_id_satker');
			$response = $this->api_bios->get_content_token($url, json_encode($data));
			$response_token = json_decode($response, true);
			$penerimaan = $this->db->query("SELECT max(t.tgl_pembayaran) as tgl_transaksi, ap.kode as kd_akun, sum(t.jumlah_realisasi) as jumlah FROM termin AS t INNER JOIN kontrak AS k ON t.id_kontrak = k.id_kontrak INNER JOIN akun_penerimaan AS ap ON t.id_penerimaan = ap.id_akun WHERE k.id_satker = $id_satker AND YEAR(tgl_pembayaran) = $tahun AND t.status_pembayaran=1 GROUP BY kd_akun;")->result_array();
			$url = 'https://bios.kemenkeu.go.id/api/ws/keuangan/akuntansi/penerimaan';
			foreach ($penerimaan as $terima) {
				$dataPenerimaan = array(
					'tgl_transaksi' => $terima['tgl_transaksi'],
					'kd_akun' => $terima['kd_akun'],
					'jumlah' => $terima['jumlah'],
				);
				$responseLayanan = $this->api_bios->get_content($url, json_encode($dataPenerimaan), $response_token['token']);
			}
		 	echo '<script>alert("Data Berhasil Disimpan");</script>';
		 	redirect('bendahara_penerimaan/list_po/'.$kategori, 'refresh');

	}

	function input_realisasi()
	{
		$id_termin	= addslashes($this->input->post('id_termin'));
		$id_penerimaan	= addslashes($this->input->post('id_penerimaan'));
		$tgl_pembayaran	= addslashes($this->input->post('tgl_pembayaran'));
		$jumlah_realisasi	= addslashes($this->input->post('jumlah_realisasi'));
		$cek = $this->db->query("SELECT * FROM kontrak WHERE id_kontrak = (SELECT id_kontrak FROM termin WHERE id_termin = $id_termin)")->row();
		if ($tgl_pembayaran < $cek->tgl_mulai)
		{
			echo '<script>alert("Tanggal Pembayaran tidak boleh lebih kecil dari tanggal mulai kontrak");</script>';
		 	redirect('bendahara_penerimaan', 'refresh');
		}
		else
		{
			$data_termin=array(
				'id_penerimaan'=> $id_penerimaan,
				'status_pembayaran'=> 1,
				'status_realisasi'=> 1,
			 'tgl_pembayaran'=> $tgl_pembayaran,
			 'jumlah_realisasi'=> $jumlah_realisasi
		 	);
			$this->db->where('id_termin', $id_termin);
	 	 	$this->db->update('termin', $data_termin);

			$satker = $this->session->userdata('admin_satker');
			$key = $this->session->userdata('admin_key_satker');

			$kode_akun = $this->db->query("SELECT kode FROM akun_penerimaan WHERE id_akun=$id_penerimaan")->row();
			$tgl_transaksi =  date("Y/m/d", strtotime($tgl_pembayaran));
			$total_realisasi = $this->db->query("SELECT SUM(jumlah_realisasi) AS jumlah FROM termin WHERE id_penerimaan = $id_penerimaan AND tgl_pembayaran = '$tgl_pembayaran'")->row();


			$id_satker = $this->session->userdata('admin_id_satker');
			$satker = $this->session->userdata('admin_satker');
			$key = $this->session->userdata('admin_key_satker');
			$url = 'https://bios.kemenkeu.go.id/api/token';
			$data = array(
				'satker' => $satker,
				'key' => $key,
			);
			$tahun = date("Y");
			$yesterday = strtotime("yesterday");
			$response = $this->api_bios->get_content_token($url, json_encode($data));
			$response_token = json_decode($response, true);
			$penerimaan = $this->db->query("SELECT max(t.tgl_pembayaran) as tgl_transaksi, ap.kode as kd_akun, sum(t.jumlah_realisasi) as jumlah FROM termin AS t INNER JOIN kontrak AS k ON t.id_kontrak = k.id_kontrak INNER JOIN akun_penerimaan AS ap ON t.id_penerimaan = ap.id_akun WHERE k.id_satker = $id_satker AND YEAR(tgl_pembayaran) = $tahun AND t.status_pembayaran=1 GROUP BY kd_akun;")->result_array();
			$url = 'https://bios.kemenkeu.go.id/api/ws/keuangan/akuntansi/penerimaan';
			foreach ($penerimaan as $terima) {
				$dataPenerimaan = array(
					'tgl_transaksi' => $terima['tgl_transaksi'],
					'kd_akun' => $terima['kd_akun'],
					'jumlah' => $terima['jumlah'],
				);
				$responseLayanan = $this->api_bios->get_content($url, json_encode($dataPenerimaan), $response_token['token']);
			}
		 	echo '<script>alert("Data Berhasil Disimpan");</script>';
		 	redirect('bendahara_penerimaan', 'refresh');
		}

	}

	function saldo()
	{
		$id_satker = $this->session->userdata('admin_id_satker');
		$data['isi'] = 'bendahara_penerimaan/input_saldo';
		$data['datpil'] = $this->db->query("SELECT * FROM satker WHERE id_satker = $id_satker")->row();
		$data['deposito'] = $this->db->query("SELECT * FROM deposito WHERE id_satker = $id_satker")->result();
		$data['operasional'] = $this->db->query("SELECT * FROM operasional INNER JOIN bank on operasional.kdbank = bank.kdbank ORDER BY operasional.kdbank")->result();
		$data['bank'] = $this->db->query("SELECT * FROM bank ORDER BY nama_bank")->result();
		$this->load->view('new_design/index',$data);
	}

	function input_saldo()
	{
		$id_satker = $this->session->userdata('admin_id_satker');
		$kode_pengelolaan	= addslashes($this->input->post('kode_pengelolaan'));
		$rek_pengelolaan	= addslashes($this->input->post('rek_pengelolaan'));
		$saldo_pengelolaan	= addslashes($this->input->post('saldo_pengelolaan'));
		$kode_operasional	= addslashes($this->input->post('kode_operasional'));
		$rek_operasional	= addslashes($this->input->post('rek_operasional'));
		$saldo_operasional	= addslashes($this->input->post('saldo_operasional'));
		$kode_dana_kelola	= addslashes($this->input->post('kode_dana_kelola'));
		$rek_dana_kelola	= addslashes($this->input->post('rek_dana_kelola'));
		$saldo_dana_kelola	= addslashes($this->input->post('saldo_dana_kelola'));
		$kode_deposito	= addslashes($this->input->post('kode_deposito'));
		$rek_deposito	= addslashes($this->input->post('rek_deposito'));
		$saldo_deposito	= addslashes($this->input->post('saldo_deposito'));
		$tanggal = DATE("Y/m/d");
			$data=array(
				'saldo_pengelolaan'=> $saldo_pengelolaan,
				'saldo_operasional'=> $saldo_operasional,
				'saldo_dana_kelola'=> $saldo_dana_kelola,
				'saldo_deposito'=> $saldo_deposito
		 	);
			$this->db->where('id_satker', $id_satker);
	 	 	$this->db->update('satker', $data);

		 	echo '<script>alert("Data Berhasil Disimpan");</script>';
		 	redirect('bendahara_penerimaan/saldo', 'refresh');

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

	function pindah_operasional()
	{
		$id_termin	= $this->uri->segment(3);
		$kategori	= $this->uri->segment(4);
		$tgl_operasional = DATE("Y-m-d");
			$data=array(
			 'status_realisasi'=> 1,
			 'tgl_operasional'=> $tgl_operasional
		 );
		 $this->db->where('id_termin', $id_termin);
		 $this->db->update('termin', $data);
		echo '<script>alert("Data Berhasil Disimpan!");</script>';
		redirect('bendahara_penerimaan/list_po/'.$kategori, 'refresh');
	}

	function hapus_po()
	{
		$id_termin	= $this->uri->segment(3);
		$id_kontrak	= $this->uri->segment(4);
		$kategori	= $this->uri->segment(5);
		$this->db->query("DELETE FROM termin WHERE id_termin = $id_termin");
		$this->db->query("DELETE FROM kontrak WHERE id_kontrak = $id_kontrak");
		echo '<script>alert("Data Berhasil Dihapus!");</script>';
		redirect('bendahara_penerimaan/list_po/'.$kategori, 'refresh');
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
		$data['isi'] = 'bendahara_penerimaan/detail_kontrak';
		$this->load->view('new_design/index',$data);
	}

	function cetak_penagihan()
	{
		$id_termin = $this->uri->segment(3);
		$tanggal = DATE("Y-m-d");
		$get = $this->db->query("SELECT * FROM termin WHERE id_termin = $id_termin")->row();
		$jumlah_penagihan = $get->jumlah_penagihan + 1;
		$this->db->query("UPDATE termin SET jumlah_penagihan=$jumlah_penagihan WHERE id_termin=$id_termin");
		$data=array(
		 'id_termin'=> $id_termin,
		 'tgl_termin'=> $tanggal,
		 'keterangan'=> $jumlah_penagihan
	 	);
		$this->db->insert('penagihan', $data);
		echo '<script>alert("Surat Penagihan berhasil dibuat!");</script>';
		redirect('bendahara_penerimaan', 'refresh');
	}

	function piutang_macet()
	{
		$id_termin = addslashes($this->input->post('id_termin'));
		$keterangan = addslashes($this->input->post('keterangan'));
		$tanggal = DATE("Y-m-d");
		$get = $this->db->query("SELECT * FROM termin WHERE id_termin = $id_termin")->row();
		$jumlah_penagihan = $get->jumlah_penagihan + 1;
		$this->db->query("UPDATE termin SET jumlah_penagihan=$jumlah_penagihan,keterangan = '$keterangan' WHERE id_termin=$id_termin");
		$data=array(
		 'id_termin'=> $id_termin,
		 'tgl_termin'=> $tanggal,
		 'keterangan'=> $jumlah_penagihan
	 	);
		$this->db->insert('penagihan', $data);
		redirect('bendahara_penerimaan', 'refresh');
	}

	function cetak_surat_penagihan()
	{
		$id = $this->uri->segment(3);
		$data['result'] = $this->db->query("SELECT p.keterangan,per.nama_perusahaan,t.tgl_invoice,t.termin,t.jumlah,t.no_invoice FROM penagihan AS p INNER JOIN termin AS t ON p.id_termin = t.id_termin INNER JOIN kontrak AS k ON t.id_kontrak = k.id_kontrak INNER JOIN perusahaan AS per ON k.id_perusahaan = per.id_perusahaan WHERE p.id = $id")->row();
		// $tanggal = DATE("Y-m-d");
		// $get = $this->db->query("SELECT * FROM termin WHERE id_termin = $id_termin")->row();
		// $jumlah_penagihan = $get->jumlah_penagihan + 1;
		// $this->db->query("UPDATE termin SET jumlah_penagihan=$jumlah_penagihan WHERE id_termin=$id_termin");
		// $data=array(
		//  'id_termin'=> $id_termin,
		//  'tgl_termin'=> $tanggal,
		//  'keterangan'=> $jumlah_penagihan
	 	// );
		// $this->db->insert('penagihan', $data);
		// redirect('bendahara_penerimaan', 'refresh');
		$this->load->view('admin/surat_penagihan',$data);
	}

	function preview_invoice_detail()
	{
		$id = $this->uri->segment(3);
		$id_satker = $this->session->userdata('admin_id_satker');
		$this->data['result'] = $this->m_bendahara->cetak_invoice_penagihan($id)->row();
		$get = $this->m_bendahara->cetak_invoice_penagihan($id)->row();
		$this->data['terbilang'] = $this->format_terbilang->terbilang($get->jumlah);
		$this->data['satker'] = $this->db->query("SELECT * FROM satker WHERE id_satker = $id_satker")->row();
		$this->data['title_pdf'] = 'Invoice MONIKA';
		// filename dari pdf ketika didownload
		$file_pdf = 'invoice';
		// setting paper
		$paper = 'A4';
		//orientasi paper potrait / landscape
		$orientation = "portrait";
		$html = $this->load->view('cetak/bendahara_invoice',$this->data, true, $data);
		// run dompdf
		//$this->pdfgenerator->set_option('isRemoteEnabled', true);
		$this->pdfgenerator->generate($html, $file_pdf,$paper,$orientation);
		//$this->load->view('admin/bendahara_invoice',$data);
	}


	function input_operasional()
	{
		date_default_timezone_set('Asia/Jakarta');
		$id_satker 		= $this->session->userdata('admin_id_satker');
		$no_rekening	= addslashes($this->input->post('no_rekening'));
		$saldo_akhir	= addslashes($this->input->post('saldo_akhir'));
		$kdbank			= addslashes($this->input->post('kdbank'));

		$data = array(
			'id_satker' => $id_satker,
			'no_rekening' => $no_rekening,
			'saldo_akhir' => $saldo_akhir,
			'kdbank' => $kdbank,
		);
		$this->db->insert('operasional', $data);


		$satker = $this->session->userdata('admin_satker');
		$key = $this->session->userdata('admin_key_satker');
		$url = 'https://bios.kemenkeu.go.id/api/token';
		$data = array(
			'satker' => $satker,
			'key' => $key,
		);
		$tahun = date("Y");
		$yesterday = strtotime("yesterday");
		$response = $this->api_bios->get_content_token($url, json_encode($data));
		$response_token = json_decode($response, true);

		var_dump($response_token);
		$operasional = $this->db->query("SELECT no_rekening, saldo_akhir, kdbank FROM operasional WHERE id_satker = $id_satker;")->result_array();
		$url = 'https://bios.kemenkeu.go.id/api/ws/keuangan/saldo/saldo_operasional';
		foreach ($operasional as $ops) {
			$dataOperasional = array(
				'tgl_transaksi' => date('Y-m-d', $yesterday),
				'no_rekening' => $ops['no_rekening'],
				'saldo_akhir' => $ops['saldo_akhir'],
				'kdbank' => $ops['kdbank'],
			);
			$responseLayanan = $this->api_bios->get_content($url, json_encode($dataOperasional), $response_token['token']);
			$response_bios = json_decode($responseLayanan, true);
			$last_status = $response_bios['message'];
			$data = array(
				'last_status' => $last_status,
				'last_updated' => DATE("Y-m-d H:i:s")
			);
			$this->db->where('id_webservice', 3);
			$this->db->update('webservicebios', $data);
		}

		$id_user = $this->session->userdata('admin_id');
		$keterangan = "Penambahan Rekening Operasional  " . $id_user;
		$data = array(
			'id_user' => $id_user,
			'keterangan' => $keterangan,
			'tanggal' => DATE("Y-m-d H:i:s")
		);
		$this->db->insert('log_history', $data);

		echo '<script>alert("Data Berhasil Disimpan");</script>';
		redirect('bendahara_penerimaan/saldo', 'refresh');
	}

	function edit_operasional()
	{
		date_default_timezone_set('Asia/Jakarta');
		$id_satker 		= $this->session->userdata('admin_id_satker');
		$id_operasional	= addslashes($this->input->post('id_operasional'));
		$no_rekening	= addslashes($this->input->post('no_rekening'));
		$saldo_akhir	= addslashes($this->input->post('saldo_akhir'));
		$kdbank			= addslashes($this->input->post('kdbank'));

		$data = array(
			'id_satker' => $id_satker,
			'no_rekening' => $no_rekening,
			'saldo_akhir' => $saldo_akhir,
			'kdbank' => $kdbank,
		);
		$this->db->where('id_operasional', $id_operasional);
		$this->db->update('operasional', $data);


		$satker = $this->session->userdata('admin_satker');
		$key = $this->session->userdata('admin_key_satker');
		$url = 'https://bios.kemenkeu.go.id/api/token';
		$data = array(
			'satker' => $satker,
			'key' => $key,
		);
		$tahun = date("Y");
		$yesterday = strtotime("yesterday");
		$response = $this->api_bios->get_content_token($url, json_encode($data));
		$response_token = json_decode($response, true);

		$operasional = $this->db->query("SELECT no_rekening, saldo_akhir, kdbank FROM operasional WHERE id_satker = $id_satker;")->result_array();
		$url = 'https://bios.kemenkeu.go.id/api/ws/keuangan/saldo/saldo_operasional';
		foreach ($operasional as $ops) {
			$dataOperasional = array(
				'tgl_transaksi' => date('Y-m-d', $yesterday),
				'no_rekening' => $ops['no_rekening'],
				'saldo_akhir' => $ops['saldo_akhir'],
				'kdbank' => $ops['kdbank'],
			);
			$responseLayanan = $this->api_bios->get_content($url, json_encode($dataOperasional), $response_token['token']);
			$response_bios = json_decode($responseLayanan, true);
			$last_status = $response_bios['message'];
			$data = array(
				'last_status' => $last_status,
				'last_updated' => DATE("Y-m-d H:i:s")
			);
			$this->db->where('id_webservice', 3);
			$this->db->update('webservicebios', $data);
		}

		$id_user = $this->session->userdata('admin_id');
		$keterangan = "Update Rekening Operasional  " . $id_user;
		$data = array(
			'id_user' => $id_user,
			'keterangan' => $keterangan,
			'tanggal' => DATE("Y-m-d H:i:s")
		);
		$this->db->insert('log_history', $data);

		echo '<script>alert("Data Berhasil Disimpan");</script>';
		redirect('bendahara_penerimaan/saldo', 'refresh');
	}

	function delete_operasional()
	{
		date_default_timezone_set('Asia/Jakarta');
		$id_satker 		= $this->session->userdata('admin_id_satker');
		$id_operasional	= $this->uri->segment(3);

		$this->db->where('id_operasional', $id_operasional);
		$this->db->delete('operasional');

		$satker = $this->session->userdata('admin_satker');
		$key = $this->session->userdata('admin_key_satker');
		$url = 'https://bios.kemenkeu.go.id/api/token';
		$data = array(
			'satker' => $satker,
			'key' => $key,
		);
		$tahun = date("Y");
		$yesterday = strtotime("yesterday");
		$response = $this->api_bios->get_content_token($url, json_encode($data));
		$response_token = json_decode($response, true);

		$operasional = $this->db->query("SELECT no_rekening, saldo_akhir, kdbank FROM operasional WHERE id_satker = $id_satker;")->result_array();
		$url = 'https://bios.kemenkeu.go.id/api/ws/keuangan/saldo/saldo_operasional';
		foreach ($operasional as $ops) {
			$dataOperasional = array(
				'tgl_transaksi' => date('Y-m-d', $yesterday),
				'no_rekening' => $ops['no_rekening'],
				'saldo_akhir' => $ops['saldo_akhir'],
				'kdbank' => $ops['kdbank'],
			);
			$responseLayanan = $this->api_bios->get_content($url, json_encode($dataOperasional), $response_token['token']);
			$response_bios = json_decode($responseLayanan, true);
			$last_status = $response_bios['message'];
			$data = array(
				'last_status' => $last_status,
				'last_updated' => DATE("Y-m-d H:i:s")
			);
			$this->db->where('id_webservice', 3);
			$this->db->update('webservicebios', $data);
		}

		$id_user = $this->session->userdata('admin_id');
		$keterangan = "Hapus Rekening Operasional  " . $id_user;
		$data = array(
			'id_user' => $id_user,
			'keterangan' => $keterangan,
			'tanggal' => DATE("Y-m-d H:i:s")
		);
		$this->db->insert('log_history', $data);

		echo '<script>alert("Data Berhasil Disimpan");</script>';
		redirect('bendahara_penerimaan/saldo', 'refresh');
	}

	function input_deposito()
	{
		date_default_timezone_set('Asia/Jakarta');
		$id_satker = $this->session->userdata('admin_id_satker');
		$no_bilyet	= addslashes($this->input->post('no_bilyet'));
		$nilai_deposito	= addslashes($this->input->post('nilai_deposito'));
		$nilai_bunga	= addslashes($this->input->post('nilai_bunga'));

		$data = array(
			'id_satker' => $id_satker,
			'no_bilyet' => $no_bilyet,
			'nilai_deposito' => $nilai_deposito,
			'nilai_bunga' => $nilai_bunga,
		);
		$this->db->insert('deposito', $data);

		$satker = $this->session->userdata('admin_satker');
		$key = $this->session->userdata('admin_key_satker');
		$url = 'https://bios.kemenkeu.go.id/api/token';
		$data = array(
			'satker' => $satker,
			'key' => $key,
		);
		$tahun = date("Y");
		$yesterday = strtotime("yesterday");
		$response = $this->api_bios->get_content_token($url, json_encode($data));
		$response_token = json_decode($response, true);

		$deposito = $this->db->query("SELECT no_bilyet, nilai_deposito, nilai_bunga FROM deposito WHERE id_satker = $id_satker;")->result_array();
		$url = 'https://bios.kemenkeu.go.id/api/ws/keuangan/saldo/saldo_pengelolaan_kas';
		foreach ($deposito as $deposit) {
			$dataDeposit = array(
				'tgl_transaksi' => date('Y-m-d', $yesterday),
				'no_bilyet' => $deposit['no_bilyet'],
				'nilai_deposito' => $deposit['nilai_deposito'],
				'nilai_bunga' => $deposit['nilai_bunga'],
			);
			$responseLayanan = $this->api_bios->get_content($url, json_encode($dataDeposit), $response_token['token']);
			$response_bios = json_decode($responseLayanan, true);
			$last_status = $response_bios['message'];
			$data = array(
				'last_status' => $last_status,
				'last_updated' => DATE("Y-m-d H:i:s")
			);
			$this->db->where('id_webservice', 4);
			$this->db->update('webservicebios', $data);
			//var_dump($responseLayanan);
		}

		$id_user = $this->session->userdata('admin_id');
		$keterangan = "Penambahan Bilyet  " . $id_user;
		$data = array(
			'id_user' => $id_user,
			'keterangan' => $keterangan,
			'tanggal' => DATE("Y-m-d H:i:s")
		);
		$this->db->insert('log_history', $data);

		echo '<script>alert("Data Berhasil Disimpan");</script>';
		redirect('bendahara_penerimaan/saldo', 'refresh');
	}

	function edit_deposito()
	{
		date_default_timezone_set('Asia/Jakarta');
		$id_satker = $this->session->userdata('admin_id_satker');
		$id_deposito	= addslashes($this->input->post('id_deposito'));
		$no_bilyet	= addslashes($this->input->post('no_bilyet'));
		$nilai_deposito	= addslashes($this->input->post('nilai_deposito'));
		$nilai_bunga	= addslashes($this->input->post('nilai_bunga'));


		$data = array(
			'id_satker' => $id_satker,
			'no_bilyet' => $no_bilyet,
			'nilai_deposito' => $nilai_deposito,
			'nilai_bunga' => $nilai_bunga
		);


		$this->db->where('id_deposito', $id_deposito);
		$this->db->update('deposito', $data);

		$satker = $this->session->userdata('admin_satker');
		$key = $this->session->userdata('admin_key_satker');
		$url = 'https://bios.kemenkeu.go.id/api/token';
		$data = array(
			'satker' => $satker,
			'key' => $key,
		);
		$tahun = date("Y");
		$yesterday = strtotime("yesterday");
		$response = $this->api_bios->get_content_token($url, json_encode($data));
		$response_token = json_decode($response, true);

		$deposito = $this->db->query("SELECT no_bilyet, nilai_deposito, nilai_bunga FROM deposito WHERE id_satker = $id_satker;")->result_array();
		$url = 'https://bios.kemenkeu.go.id/api/ws/keuangan/saldo/saldo_pengelolaan_kas';
		foreach ($deposito as $deposit) {
			$dataDeposit = array(
				'tgl_transaksi' => date('Y-m-d', $yesterday),
				'no_bilyet' => $deposit['no_bilyet'],
				'nilai_deposito' => $deposit['nilai_deposito'],
				'nilai_bunga' => $deposit['nilai_bunga']
			);
			$responseLayanan = $this->api_bios->get_content($url, json_encode($dataDeposit), $response_token['token']);
			$response_bios = json_decode($responseLayanan, true);
			$last_status = $response_bios['message'];
			$data = array(
				'last_status' => $last_status,
				'last_updated' => DATE("Y-m-d H:i:s")
			);
			$this->db->where('id_webservice', 4);
			$this->db->update('webservicebios', $data);
			//var_dump($responseLayanan);
		}

		$id_user = $this->session->userdata('admin_id');
		$keterangan = "Update Bilyet  " . $id_user;
		$data = array(
			'id_user' => $id_user,
			'keterangan' => $keterangan,
			'tanggal' => DATE("Y-m-d H:i:s")
		);
		$this->db->insert('log_history', $data);

		echo '<script>alert("Data Berhasil Disimpan");</script>';
		redirect('bendahara_penerimaan/saldo', 'refresh');
	}

	function delete_deposito()
	{
		date_default_timezone_set('Asia/Jakarta');
		$id_satker = $this->session->userdata('admin_id_satker');
		$satker = $this->session->userdata('admin_satker');
		$id_deposito	= $this->uri->segment(3);

		$this->db->where('id_deposito', $id_deposito);
		$this->db->delete('deposito');

		$satker = $this->session->userdata('admin_satker');
		$key = $this->session->userdata('admin_key_satker');
		$url = 'https://bios.kemenkeu.go.id/api/token';
		$data = array(
			'satker' => $satker,
			'key' => $key,
		);
		$tahun = date("Y");
		$yesterday = strtotime("yesterday");
		$response = $this->api_bios->get_content_token($url, json_encode($data));
		$response_token = json_decode($response, true);

		$deposito = $this->db->query("SELECT no_bilyet, nilai_deposito, nilai_bunga FROM deposito WHERE id_satker = $id_satker;")->result_array();
		$url = 'https://bios.kemenkeu.go.id/api/ws/keuangan/saldo/saldo_pengelolaan_kas';
		foreach ($deposito as $deposit) {
			$dataDeposit = array(
				'tgl_transaksi' => date('Y-m-d', $yesterday),
				'no_bilyet' => $deposit['no_bilyet'],
				'nilai_deposito' => $deposit['nilai_deposito'],
				'nilai_bunga' => $deposit['nilai_bunga']
			);
			$responseLayanan = $this->api_bios->get_content($url, json_encode($dataDeposit), $response_token['token']);
			$response_bios = json_decode($responseLayanan, true);
			$last_status = $response_bios['message'];
			$data = array(
				'last_status' => $last_status,
				'last_updated' => DATE("Y-m-d H:i:s")
			);
			$this->db->where('id_webservice', 4);
			$this->db->update('webservicebios', $data);
			//var_dump($responseLayanan);
		}
		
		$id_user = $this->session->userdata('admin_id');
		$keterangan = "Hapus Deposito";
		$data = array(
			'id_user' => $id_user,
			'keterangan' => $keterangan,
			'tanggal' => DATE("Y-m-d H:i:s")
		);
		$this->db->insert('log_history', $data);

		echo '<script>alert("Data Berhasil Dihapus");</script>';
		redirect('bendahara_penerimaan/saldo', 'refresh');
	}

}
?>
