<?php

class Bendahara_pengeluaran extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		if($this->session->userdata('admin_kategori') != 4)
		{
			echo '<script>alert("Anda tidak dapat mengakses");</script>';
			$this->session->sess_destroy();
			redirect(base_url('login','refresh'));
		}
		$this->load->helper(array('url','form'));
		$this->load->model(array('m_pimpinan','m_bendahara','m_kontrak'));
		$this->load->library(array('format_terbilang','format_tanggal','api_bios'));
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
		//$data['isi'] = 'admin/bendahara_pengeluaran_content';
		$data['isi'] = 'bendahara_pengeluaran/content';
		$data['cek'] = $this->m_kontrak->list_pengajuan_sync()->num_rows();
		$data['result'] = $this->m_kontrak->list_pengajuan_approved()->result();
		//$data['result_rkakl'] = $this->m_kontrak->list_pengajuan_rkakl_approved()->result();
		$data['jumlah'] = $this->m_kontrak->list_pengajuan_approved()->num_rows();
		//$data['jumlah_rkakl'] = $this->m_kontrak->list_pengajuan_rkakl_approved()->num_rows();
		$data['result_pengeluaran'] = $this->m_kontrak->list_kode_akun()->result();
		$this->load->view('new_design/index',$data);
	}

	function rkakl()
	{
		//$data['isi'] = 'admin/bendahara_pengeluaran_content';
		$data['isi'] = 'bendahara_pengeluaran/content_rkakl';
		//$data['result'] = $this->m_kontrak->list_pengajuan_approved()->result();
		$data['cek'] = $this->m_kontrak->list_pengajuan_rkakl_sync()->num_rows();
		$data['result_rkakl'] = $this->m_kontrak->list_pengajuan_rkakl_approved()->result();
		//$data['jumlah'] = $this->m_kontrak->list_pengajuan_approved()->num_rows();
		$data['jumlah_rkakl'] = $this->m_kontrak->list_pengajuan_rkakl_approved()->num_rows();
		$data['result_pengeluaran'] = $this->m_kontrak->list_kode_akun()->result();
		$this->load->view('new_design/index',$data);
	}

	function sync_bios()
	{
		$data['isi'] = 'bendahara_pengeluaran/sync_bios';
		$data['result_rkakl'] = $this->m_kontrak->list_pengajuan_sync()->result();
		$this->load->view('new_design/index',$data);
	}

	function input_realisasi()
	{
		$id_pengajuan	= addslashes($this->input->post('id_pengajuan'));
		$tgl_realisasi	= addslashes($this->input->post('tgl_realisasi'));
		$jumlah_realisasi	= addslashes($this->input->post('jumlah_realisasi'));
		$cek = $this->db->query("SELECT * FROM pengajuan WHERE id_pengajuan = $id_pengajuan")->row();
		$tanggal = DATE("Y/m/d");
		if ($tgl_realisasi < $cek->tgl_pengajuan)
		{
			echo '<script>alert("Tanggal Realisasi tidak boleh kurang dari tanggal Pengajuan");</script>';
			redirect('bendahara_pengeluaran', 'refresh');
		}
		else
		{
			$data_pengajuan=array(
				'status_realisasi'=> 1,
			 'tgl_realisasi'=> $tgl_realisasi,
				'status_sync'=> 1,
			 'tgl_sync'=> $tanggal,
			 'jumlah_realisasi'=> $jumlah_realisasi
		 	);
			$this->db->where('id_pengajuan', $id_pengajuan);
	 	 	$this->db->update('pengajuan', $data_pengajuan);

			$satker = $this->session->userdata('admin_satker');
			$key = $this->session->userdata('admin_key_satker');
			$id_satker = $this->session->userdata('admin_id_satker');
			$detail = $this->db->query("SELECT * FROM rencana_operasional WHERE id_ro=$cek->id_ro")->row();
			$kode_akun = $this->db->query("SELECT kode FROM akun WHERE id_akun=$detail->akun")->row();
			$total_realisasi = $this->db->query("SELECT SUM(jumlah_realisasi) AS jumlah FROM pengajuan AS pr INNER JOIN rencana_operasional AS ro ON pr.id_ro = dr.id_ro WHERE pr.id_ro = $cek->id_ro AND pr.tgl_sync = '$tgl_realisasi'")->row();

			$tgl_transaksi =  date("Y/m/d", strtotime($tgl_realisasi));
			

			$url = 'https://training-bios2.kemenkeu.go.id/api/token';
			$data = array(
				'satker' => $satker,
				'key' => $key,
			);
			$tahun = date("Y");
			$yesterday = strtotime("yesterday");
			$response = $this->api_bios->get_content_token($url, json_encode($data));
			$response_token = json_decode($response, true);

			$pengeluaran = $this->db->query("SELECT sum(jmlh) AS jumlah, kd_akun, max(tanggal) as tgl_transaksi FROM( SELECT sum(p.jumlah_realisasi) as jmlh ,a.kode AS kd_akun, max(p.tgl_realisasi) as tanggal FROM pengajuan AS p INNER JOIN rencana_operasional AS ro ON p.id_ro = ro.id_ro INNER JOIN akun AS a ON ro.akun = a.id_akun INNER JOIN kontrak AS k ON ro.id_kontrak = k.id_kontrak WHERE k.id_satker = $id_satker AND p.status_realisasi = 1 AND YEAR(tgl_pengajuan)= $tahun group by kd_akun UNION ALL SELECT sum(p.jumlah_realisasi) as jmlh, a.kode AS kd_akun, max(p.tgl_realisasi) as tanggal FROM pengajuan_rkakl AS p INNER JOIN detail_rkakl AS dr ON p.id_detail_rkakl = dr.id INNER JOIN akun AS a ON dr.akun = a.id_akun INNER JOIN rkakl AS r ON dr.id_rkakl = r.id_rkakl INNER JOIN rumah_layanan AS rl ON r.id_layanan = rl.id_rumah_layanan WHERE rl.id_satker = $id_satker AND p.status_realisasi = 1 AND p.status_pengajuan = 1 AND YEAR(p.tgl_realisasi) = $tahun group by kd_akun)t GROUP by kd_akun;")->result_array();
				$url = 'https://training-bios2.kemenkeu.go.id/api/ws/keuangan/akuntansi/pengeluaran';
				foreach ($pengeluaran as $keluar) {
					$dataPengeluaran = array(
						'tgl_transaksi' => $keluar['tgl_transaksi'],
						'kd_akun' => $keluar['kd_akun'],
						'jumlah' => $keluar['jumlah'],
					);
					$responseLayanan = $this->api_bios->get_content($url, json_encode($dataPengeluaran), $response_token['token']);
				}


		 	echo '<script>alert("Data Berhasil Disimpan");</script>';
		 	redirect('bendahara_pengeluaran', 'refresh');
		}
	}

	function input_realisasi_rkakl()
	{
		$id_pengajuan	= addslashes($this->input->post('id_pengajuan'));
		$tgl_realisasi	= addslashes($this->input->post('tgl_realisasi'));
		$jumlah_realisasi	= addslashes($this->input->post('jumlah_realisasi'));
		$cek = $this->db->query("SELECT * FROM pengajuan_rkakl WHERE id_pengajuan = $id_pengajuan")->row();
		$tanggal = DATE("Y/m/d");
		if ($tgl_realisasi < $cek->tgl_pengajuan)
		{
			echo '<script>alert("Tanggal Realisasi tidak boleh kurang dari tanggal Pengajuan");</script>';
			redirect('bendahara_pengeluaran', 'refresh');
		}
		else
		{
			$data_pengajuan=array(
				'status_realisasi'=> 1,
			 'tgl_realisasi'=> $tgl_realisasi,
			 'status_sync'=> 1,
			'tgl_sync'=> $tanggal,
			 'jumlah_realisasi'=> $jumlah_realisasi
		 	);
			$this->db->where('id_pengajuan', $id_pengajuan);
	 	 	$this->db->update('pengajuan_rkakl', $data_pengajuan);

			$satker = $this->session->userdata('admin_satker');
			$key = $this->session->userdata('admin_key_satker');
			$id_satker = $this->session->userdata('admin_id_satker');

			$detail = $this->db->query("SELECT * FROM detail_rkakl WHERE id=$cek->id_detail_rkakl")->row();
			$kode_akun = $this->db->query("SELECT kode FROM akun WHERE id_akun=$detail->akun")->row();
			$total_realisasi = $this->db->query("SELECT SUM(jumlah_realisasi) AS jumlah FROM pengajuan_rkakl AS pr INNER JOIN detail_rkakl AS dr ON pr.id_detail_rkakl = dr.id WHERE pr.id_detail_rkakl = $cek->id_detail_rkakl AND pr.tgl_sync = '$tgl_realisasi'")->row();

			//echo $kode_akun->kode;

			$tgl_transaksi =  date("Y/m/d", strtotime($tgl_realisasi));
			
			$url = 'https://bios.kemenkeu.go.id/api/token';
			$data = array(
				'satker' => $satker,
				'key' => $key,
			);
			$tahun = date("Y");
			$yesterday = strtotime("yesterday");
			$response = $this->api_bios->get_content_token($url, json_encode($data));
			$response_token = json_decode($response, true);

			$pengeluaran = $this->db->query("SELECT sum(jmlh) AS jumlah, kd_akun, max(tanggal) as tgl_transaksi FROM( SELECT sum(p.jumlah_realisasi) as jmlh ,a.kode AS kd_akun, max(p.tgl_realisasi) as tanggal FROM pengajuan AS p INNER JOIN rencana_operasional AS ro ON p.id_ro = ro.id_ro INNER JOIN akun AS a ON ro.akun = a.id_akun INNER JOIN kontrak AS k ON ro.id_kontrak = k.id_kontrak WHERE k.id_satker = $id_satker AND p.status_realisasi = 1 AND YEAR(tgl_pengajuan)= $tahun group by kd_akun UNION ALL SELECT sum(p.jumlah_realisasi) as jmlh, a.kode AS kd_akun, max(p.tgl_realisasi) as tanggal FROM pengajuan_rkakl AS p INNER JOIN detail_rkakl AS dr ON p.id_detail_rkakl = dr.id INNER JOIN akun AS a ON dr.akun = a.id_akun INNER JOIN rkakl AS r ON dr.id_rkakl = r.id_rkakl INNER JOIN rumah_layanan AS rl ON r.id_layanan = rl.id_rumah_layanan WHERE rl.id_satker = $id_satker AND p.status_realisasi = 1 AND p.status_pengajuan = 1 AND YEAR(p.tgl_realisasi) = $tahun group by kd_akun)t GROUP by kd_akun;")->result_array();
				$url = 'https://bios.kemenkeu.go.id/api/ws/keuangan/akuntansi/pengeluaran';
				foreach ($pengeluaran as $keluar) {
					$dataPengeluaran = array(
						'tgl_transaksi' => $keluar['tgl_transaksi'],
						'kd_akun' => $keluar['kd_akun'],
						'jumlah' => $keluar['jumlah'],
					);
					$responseLayanan = $this->api_bios->get_content($url, json_encode($dataPengeluaran), $response_token['token']);
				}


		 	echo '<script>alert("Data Berhasil Disimpan");</script>';
		 	redirect('bendahara_pengeluaran/rkakl', 'refresh');
		}
	}

	function sync()
	{
		$satker = $this->session->userdata('admin_satker');
		$key = $this->session->userdata('admin_key_satker');
		$url = 'https://training-bios2.kemenkeu.go.id/api/token';
		$data = array(
			'satker' => $satker,
			'key' => $key,
		);
		$response = $this->api_bios->get_content_token($url, json_encode($data));
		$response_token = json_decode($response, true);

		$tanggal = DATE("Y/m/d");

		$result = $this->m_kontrak->list_pengajuan_sync()->result();

		foreach ($result as $a)
		{
			//$detail = $this->db->query("SELECT * FROM rencana_operasional WHERE id_ro=$a->id_ro")->row();
			//$kode_akun = $this->db->query("SELECT kode FROM akun WHERE id_akun=$detail->akun")->row();

			//$tgl_transaksi =  date("Y/m/d", strtotime($tgl_realisasi));
			$url = 'https://training-bios2.kemenkeu.go.id/api/ws/pengeluaran/prod';
			$data_penerimaan = array(
				'kd_akun' => $a->kode,
				'jumlah' => $a->jumlah_realisasi,
				'tgl_transaksi' => $tanggal,
			);
			$response_penerimaan = $this->api_bios->get_content($url, json_encode($data_penerimaan),$response_token['token']);
			$response_json = json_decode($response_penerimaan, true);
		}

		echo '<script>alert("'.$response_json['message'].'");</script>';
		redirect('bendahara_pengeluaran', 'refresh');
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

	function saldo()
	{
		$id_satker = $this->session->userdata('admin_id_satker');
		$data['isi'] = 'bendahara_pengeluaran/input_saldo';
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
		 	redirect('bendahara_pengeluaran/saldo', 'refresh');

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
		redirect('bendahara_pengeluaran/saldo', 'refresh');
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
			'kdbank' => $kdbank
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
		redirect('bendahara_pengeluaran/saldo', 'refresh');
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
		redirect('bendahara_pengeluaran/saldo', 'refresh');
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
		redirect('bendahara_pengeluaran/saldo', 'refresh');
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
		redirect('bendahara_pengeluaran/saldo', 'refresh');
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
		redirect('bendahara_pengeluaran/saldo', 'refresh');
	}

}
?>
