<?php

class Pimpinan_lemigas extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		if($this->session->userdata('admin_kategori') != 998)
		{
			$this->session->sess_destroy();
			redirect(base_url("login"));
		}
		$this->load->helper(array('url','form'));
		$this->load->model(array('m_pimpinan','m_bendahara','m_kontrak'));
		$this->load->library(array('format_terbilang','format_tanggal'));
	}

	function index()
	{
		$tahun	= addslashes($this->input->post('tahun'));
		if ($tahun == "")
		{
			$pilih_tahun = DATE('Y');
		}
		else
		{
			$pilih_tahun = $tahun;
		}
		$data['isi'] = 'admin/dashboard_lemigas';
		$data['pilih_tahun'] = $pilih_tahun;

		$url_rekap="http://jlt.lemigas.esdm.go.id/db2json.php?qu=select%20*%20from%20ws_v_rekap_kp3%20where%20tahun=$pilih_tahun";
		$get_url_rekap = file_get_contents($url_rekap);
		$data_json_rekap = json_decode($get_url_rekap);

		$data['rekap_lemigas'] = $data_json_rekap;
		$this->load->view('new/pimpinan_index',$data);
	}

	function detail_lemigas_kontrak()
	{
		$pilih_tahun	= $this->uri->segment(3);
		$url_kontrak="http://jlt.lemigas.esdm.go.id/db2json.php?qu=SELECT%20kontrak_nama,kontrak_no,kontrak_tanggal,kontrak_tanggal_duedate,kontrak_nilai_rp,cust_nama%20FROM%20ws_kontrak%20WHERE%20YEAR(kontrak_tanggal)=$pilih_tahun%20ORDER%20BY%20kontrak_tanggal";
		$get_url_kontrak = file_get_contents($url_kontrak);
		$data_json_kontrak = json_decode($get_url_kontrak);
		$data['kontrak_lemigas'] = $data_json_kontrak;
		$data['isi'] = 'admin/dashboard_kaban_detail_lemigas_kontrak';
		$this->load->view('new/pimpinan_index',$data);
	}

	function detail_lemigas_invoice()
	{
		$pilih_tahun	= $this->uri->segment(3);
		$url_termin="http://jlt.lemigas.esdm.go.id/db2json.php?qu=SELECT%20*%20FROM%20ws_termin%20WHERE%20YEAR(termin_tgl)=$pilih_tahun%20AND%20status=2";
		$get_url_termin = file_get_contents($url_termin);
		$data_json_termin = json_decode($get_url_termin);
		$data['termin_lemigas'] = $data_json_termin;
		$url_realisasi="http://jlt.lemigas.esdm.go.id/db2json.php?qu=SELECT%20*%20FROM%20ws_termin%20WHERE%20YEAR(termin_tgl)=$pilih_tahun%20AND%20status=3";
		$get_url_realisasi = file_get_contents($url_realisasi);
		$data_json_realisasi = json_decode($get_url_realisasi);
		$data['realisasi_lemigas'] = $data_json_realisasi;
		$data['isi'] = 'admin/dashboard_kaban_detail_lemigas_invoice';
		$this->load->view('new/pimpinan_index',$data);
	}

	function detail_lemigas_realisasi()
	{
		$pilih_tahun	= $this->uri->segment(3);
		$url_realisasi="http://jlt.lemigas.esdm.go.id/db2json.php?qu=SELECT%20*%20FROM%20ws_termin%20WHERE%20YEAR(termin_tgl)=$pilih_tahun%20AND%20status=3";
		$get_url_realisasi = file_get_contents($url_realisasi);
		$data_json_realisasi = json_decode($get_url_realisasi);
		$data['realisasi_lemigas'] = $data_json_realisasi;
		$data['isi'] = 'admin/dashboard_kaban_detail_lemigas_realisasi';
		$this->load->view('new/pimpinan_index',$data);
	}

	function detail_lemigas_pengeluaran()
	{
		$pilih_tahun	= $this->uri->segment(3);
		//$url_ro="http://jlt.lemigas.esdm.go.id/db2json.php?qu=SELECT%20*%20FROM%20ws_rencana_operasional%20WHERE%20YEAR(tgl_ro)=$pilih_tahun%20AND%20status=%27SETUJU%27";
		//$url_ro="http://jlt.lemigas.esdm.go.id/db2json.php?qu=SELECT%20*%20FROM%20ws_rencana_operasional%20WHERE%20tahun_ro=$pilih_tahun%20AND%20status=%27SETUJU%27";
		$url_ro="http://jlt.lemigas.esdm.go.id/db2json.php?qu=SELECT%20*%20FROM%20ws_realisasi_operasional%20WHERE%20YEAR(tanggal)=$pilih_tahun%20AND%20jenis_bayar=%27MASTER%27";
		$get_url_ro = file_get_contents($url_ro);
		$data_json_ro = json_decode($get_url_ro);
		// print_r($data_json_ro);
		$data['ro_lemigas'] = $data_json_ro;
		$data['isi'] = 'admin/dashboard_kaban_detail_lemigas_pengeluaran';
		$this->load->view('new/pimpinan_index',$data);
	}

	function detail_kontrak()
	{
		$id_satker	= $this->uri->segment(3);
		$pilih_tahun	= $this->uri->segment(4);
		$data['result'] = $this->m_kontrak->list_kontrak_detail($id_satker,$pilih_tahun)->result();
		$data['isi'] = 'admin/dashboard_kaban_detail';
		$this->load->view('new/pimpinan_index',$data);
	}

	function info_detail_kontrak()
	{
		$id_kontrak	= $this->uri->segment(3);
		$data['result'] = $this->m_kontrak->pilih_kontrak($id_kontrak);
		$data['result_termin'] = $this->db->query("SELECT * FROM termin WHERE id_kontrak = $id_kontrak")->result();
		$data['jumlah_termin'] = $this->db->query("SELECT * FROM termin WHERE id_kontrak = $id_kontrak")->num_rows();
		$data['result_pengajuan'] = $this->db->query("SELECT * FROM pengajuan INNER JOIN rencana_operasional ON pengajuan.id_ro = rencana_operasional.id_ro INNER JOIN akun ON rencana_operasional.akun = akun.id_akun INNER JOIN kegiatan ON rencana_operasional.id_kegiatan = kegiatan.id_kegiatan WHERE rencana_operasional.id_kontrak = $id_kontrak")->result();
		$data['jumlah_pengajuan'] = $this->db->query("SELECT * FROM pengajuan INNER JOIN rencana_operasional ON pengajuan.id_ro = rencana_operasional.id_ro INNER JOIN akun ON rencana_operasional.akun = akun.id_akun INNER JOIN kegiatan ON rencana_operasional.id_kegiatan = kegiatan.id_kegiatan WHERE rencana_operasional.id_kontrak = $id_kontrak")->num_rows();
		$data['isi'] = 'admin/dashboard_kaban_info_detail';
		$this->load->view('new/pimpinan_index',$data);
	}

	function detail_invoice()
	{
		$id_satker	= $this->uri->segment(3);
		$pilih_tahun	= $this->uri->segment(4);
		$data['result'] = $this->db->query("SELECT k.nama_kontrak,p.nama_perusahaan,k.tgl_mulai,k.tgl_akhir,t.jumlah,t.termin,k.status,k.id_kontrak FROM termin AS t INNER JOIN kontrak AS k ON t.id_kontrak = k.id_kontrak INNER JOIN perusahaan AS p ON k.id_perusahaan = p.id_perusahaan WHERE k.id_satker = $id_satker AND YEAR(tgl_termin) = $pilih_tahun")->result();
		$data['isi'] = 'admin/dashboard_detail_invoice';
		$this->load->view('new/pimpinan_index',$data);
	}

	function detail_realisasi()
	{
		$id_satker	= $this->uri->segment(3);
		$pilih_tahun	= $this->uri->segment(4);
		$data['result'] = $this->db->query("SELECT k.nama_kontrak,p.nama_perusahaan,k.tgl_mulai,k.tgl_akhir,t.jumlah,t.termin,k.status,k.id_kontrak FROM termin AS t INNER JOIN kontrak AS k ON t.id_kontrak = k.id_kontrak INNER JOIN perusahaan AS p ON k.id_perusahaan = p.id_perusahaan WHERE k.id_satker = $id_satker AND YEAR(tgl_pembayaran) = $pilih_tahun AND t.status_pembayaran=1")->result();
		$data['isi'] = 'admin/dashboard_detail_realisasi';
		$this->load->view('new/pimpinan_index',$data);
	}

	function detail_pengeluaran()
	{
		$id_satker	= $this->uri->segment(3);
		$pilih_tahun	= $this->uri->segment(4);
		$data['result'] = $this->db->query("SELECT k.nama_kontrak,p.jumlah_realisasi,p.keterangan,p.tgl_realisasi,a.nama_akun,a.kode FROM pengajuan AS p INNER JOIN rencana_operasional AS ro ON p.id_ro = ro.id_ro INNER JOIN akun AS a ON ro.akun = a.id_akun INNER JOIN kontrak AS k ON ro.id_kontrak = k.id_kontrak WHERE k.id_satker = $id_satker AND p.status_realisasi = 1 AND YEAR(tgl_pengajuan)=$pilih_tahun")->result();
		$data['result_rkakl'] = $this->db->query("SELECT p.id_pengajuan,p.jumlah,p.status_realisasi,p.status_pengajuan,p.tgl_pengajuan,p.keterangan,a.kode AS kode_akun,a.nama_akun,dr.id,r.keterangan AS keterangan_rkakl,p.id_detail_rkakl,dr.biaya,r.id_rkakl,p.tgl_realisasi,p.jumlah_realisasi FROM pengajuan_rkakl AS p INNER JOIN detail_rkakl AS dr ON p.id_detail_rkakl = dr.id INNER JOIN akun AS a ON dr.akun = a.id_akun INNER JOIN rkakl AS r ON dr.id_rkakl = r.id_rkakl INNER JOIN rumah_layanan AS rl ON r.id_layanan = rl.id_rumah_layanan WHERE rl.id_satker = $id_satker AND p.status_realisasi = 1 AND p.status_pengajuan = 1 AND YEAR(p.tgl_realisasi) = $pilih_tahun")->result();
		$data['isi'] = 'admin/dashboard_detail_pengeluaran';
		$this->load->view('new/pimpinan_index',$data);
	}

}
?>
