<?php

class Pimpinan extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		if($this->session->userdata('admin_valid') != "true" && $this->session->userdata('admin_valid') != 6)
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
		$id_satker = $this->session->userdata('admin_id_satker');
		$tahun	= addslashes($this->input->post('tahun'));
		if ($tahun == "")
		{
			$pilih_tahun = DATE('Y');
		}
		else
		{
			$pilih_tahun = $tahun;
		}
		//$data['isi'] = 'admin/dashboard_kaban';
		$data['pilih_tahun'] = $pilih_tahun;
		//$tahun = DATE('Y');
		$data['isi'] = 'admin/dashboard_pimpinan';
		//$data['result_terkontrak'] = $this->db->query("SELECT SUM(nilai_kontrak) AS jumlah FROM kontrak WHERE id_satker = $id_satker AND YEAR(tgl_akhir) = $pilih_tahun")->row();
		$data['result_terkontrak'] = $this->db->query("SELECT SUM(t.jumlah) AS jumlah FROM termin AS t INNER JOIN kontrak AS k ON t.id_kontrak = k.id_kontrak WHERE YEAR(t.tgl_termin) = $pilih_tahun AND k.id_satker = $id_satker")->row();
		$data['result_realisasi'] = $this->db->query("SELECT SUM(t.jumlah_realisasi) AS jumlah FROM termin AS t INNER JOIN kontrak AS k ON t.id_kontrak = k.id_kontrak WHERE k.id_satker = $id_satker AND YEAR(t.tgl_pembayaran) = $pilih_tahun AND t.status_pembayaran=1")->row();
		$data['realisasi'] = $this->db->query("SELECT SUM(t.jumlah_realisasi) AS jumlah FROM termin AS t INNER JOIN kontrak AS k ON t.id_kontrak = k.id_kontrak WHERE k.id_satker = $id_satker AND YEAR(t.tgl_pembayaran) < $pilih_tahun AND t.status_pembayaran=1")->row();
		$data['result_invoice'] = $this->db->query("SELECT SUM(t.jumlah) AS jumlah FROM termin AS t INNER JOIN kontrak AS k ON t.id_kontrak = k.id_kontrak INNER JOIN perusahaan AS p ON k.id_perusahaan = p.id_perusahaan WHERE k.id_satker = $id_satker AND YEAR(t.tgl_invoice) = $pilih_tahun AND t.status_cetak_invoice=1")->row();
		$data['result_piutang'] = $this->db->query("SELECT SUM(t.jumlah) AS jumlah FROM termin AS t INNER JOIN kontrak AS k ON t.id_kontrak = k.id_kontrak INNER JOIN perusahaan AS p ON k.id_perusahaan = p.id_perusahaan WHERE k.id_satker = $id_satker AND YEAR(t.tgl_invoice) <= $pilih_tahun AND t.status_cetak_invoice=1 AND t.status_pembayaran=0")->row();
		$data['result_pengeluaran'] = $this->db->query("SELECT SUM(p.jumlah_realisasi) AS jumlah FROM pengajuan AS p INNER JOIN rencana_operasional AS ro ON p.id_ro = ro.id_ro INNER JOIN kontrak AS k ON ro.id_kontrak = k.id_kontrak WHERE k.id_satker = $id_satker AND p.status_realisasi = 1 AND YEAR(p.tgl_realisasi) = $pilih_tahun")->row();
		$data['result_pengeluaran_rkakl'] = $this->db->query("SELECT SUM(p.jumlah_realisasi) AS jumlah FROM pengajuan_rkakl AS p INNER JOIN detail_rkakl AS dr ON p.id_detail_rkakl = dr.id INNER JOIN rkakl AS r ON dr.id_rkakl = r.id_rkakl INNER JOIN rumah_layanan AS rl ON r.id_layanan = rl.id_rumah_layanan WHERE rl.id_satker = $id_satker AND p.status_realisasi = 1 AND YEAR(p.tgl_realisasi) = $pilih_tahun")->row();
		$data['pelaksana_layanan'] = $this->db->query("SELECT id_rumah_layanan,nama FROM rumah_layanan WHERE id_satker = $id_satker")->result();
		$data['result_target'] = $this->m_kontrak->sum_target($pilih_tahun)->row();
		$data['result_selisih'] = $data['result_invoice'] - $data['result_realisasi']; 
		$this->load->view('new/pimpinan_index',$data);
	}


	public function detail_kontrak()
	{
		$id_rumah_layanan	= $this->uri->segment(3);
		$pilih_tahun	= $this->uri->segment(4);
		//$data['result'] = $this->db->query("SELECT k.nama_kontrak,p.nama_perusahaan,k.tgl_mulai,k.tgl_akhir,k.nilai_kontrak,k.status,k.id_kontrak,t.jumlah,t.termin FROM termin AS t INNER JOIN kontrak AS k ON t.id_kontrak = k.id_kontrak INNER JOIN perusahaan AS p ON k.id_perusahaan = p.id_perusahaan WHERE k.id_rumah_layanan = $id_rumah_layanan AND YEAR(t.tgl_termin) <= $pilih_tahun")->result();
		//$data['result'] = $this->db->query("SELECT k.nama_kontrak,p.nama_perusahaan,k.tgl_mulai,k.tgl_akhir,k.nilai_kontrak,k.status,k.id_kontrak,k.nilai_kontrak FROM kontrak AS k INNER JOIN perusahaan AS p ON k.id_perusahaan = p.id_perusahaan WHERE k.id_rumah_layanan = $id_rumah_layanan AND YEAR(k.tgl_akhir) >= $pilih_tahun")->result();
		//$data['result'] = $this->db->query("SELECT k.nama_kontrak,p.nama_perusahaan,k.tgl_mulai,k.tgl_akhir,k.nilai_kontrak,k.status,k.id_kontrak FROM kontrak AS k INNER JOIN perusahaan AS p ON k.id_perusahaan = p.id_perusahaan WHERE k.id_rumah_layanan = $id_rumah_layanan AND YEAR(k.tgl_akhir) = $pilih_tahun")->result();
		//$data['result'] = $this->db->query("SELECT k.nama_kontrak,p.nama_perusahaan,k.tgl_mulai,k.tgl_akhir,k.nilai_kontrak,k.status,k.id_kontrak,t.jumlah,t.termin FROM termin AS t INNER JOIN kontrak AS k ON t.id_kontrak = k.id_kontrak INNER JOIN perusahaan AS p ON k.id_perusahaan = p.id_perusahaan WHERE k.id_rumah_layanan = $id_rumah_layanan AND YEAR(t.tgl_termin) <= $pilih_tahun AND t.status_cetak_invoice=1")->result();
		
		
		// $data['result'] = $this->db->query("SELECT k.nama_kontrak,p.nama_perusahaan,k.tgl_mulai,k.tgl_akhir,k.nilai_kontrak,k.status,k.id_kontrak,k.nilai_kontrak FROM termin AS t INNER JOIN kontrak AS k ON t.id_kontrak = k.id_kontrak INNER JOIN perusahaan AS p ON k.id_perusahaan = p.id_perusahaan WHERE YEAR(t.tgl_termin) <= $pilih_tahun AND t.status_pembayaran = 0 AND k.id_rumah_layanan = $id_rumah_layanan group by k.id_kontrak")->result();
		$data['result'] = $this->db->query("SELECT k.nama_kontrak,p.nama_perusahaan,k.tgl_mulai,k.tgl_akhir,k.nilai_kontrak,k.status,k.id_kontrak,k.nilai_kontrak FROM termin AS t 
			INNER JOIN kontrak AS k ON t.id_kontrak = k.id_kontrak INNER JOIN perusahaan AS p ON k.id_perusahaan = p.id_perusahaan 
			WHERE (k.id_rumah_layanan = $id_rumah_layanan AND YEAR(t.tgl_termin) = $pilih_tahun) OR 
				(k.id_rumah_layanan = $id_rumah_layanan AND YEAR(t.tgl_pembayaran) > 0 AND YEAR(t.tgl_pembayaran) < $pilih_tahun AND t.status_pembayaran = 0)
			group by k.id_kontrak")->result();
		$data['isi'] = 'admin/dashboard_detail_kontrak';
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

	public function detail_invoice()
	{
		$id_rumah_layanan	= $this->uri->segment(3);
		$pilih_tahun	= $this->uri->segment(4);
		$data['result'] = $this->db->query("SELECT k.nama_kontrak,p.nama_perusahaan,k.tgl_mulai,k.tgl_akhir,t.jumlah,t.termin,k.status,k.id_kontrak,t.status_pembayaran,t.tgl_invoice,t.jumlah_penagihan,t.id_termin FROM termin AS t INNER JOIN kontrak AS k ON t.id_kontrak = k.id_kontrak INNER JOIN perusahaan AS p ON k.id_perusahaan = p.id_perusahaan WHERE k.id_rumah_layanan = $id_rumah_layanan AND YEAR(t.tgl_invoice) = $pilih_tahun AND t.status_cetak_invoice=1")->result();
		$data['isi'] = 'admin/dashboard_detail_invoice';
		$this->load->view('new/pimpinan_index',$data);
	}

	public function detail_realisasi()
	{
		$id_rumah_layanan	= $this->uri->segment(3);
		$pilih_tahun	= $this->uri->segment(4);
		$data['result'] = $this->db->query("SELECT k.nama_kontrak,p.nama_perusahaan,k.tgl_mulai,k.tgl_akhir,t.jumlah,t.termin,k.status,k.id_kontrak FROM termin AS t INNER JOIN kontrak AS k ON t.id_kontrak = k.id_kontrak INNER JOIN perusahaan AS p ON k.id_perusahaan = p.id_perusahaan WHERE k.id_rumah_layanan = $id_rumah_layanan AND YEAR(t.tgl_pembayaran) = $pilih_tahun AND t.status_pembayaran=1")->result();
		$data['isi'] = 'admin/dashboard_detail_realisasi';
		$this->load->view('new/pimpinan_index',$data);
	}

	public function detail_pengeluaran()
	{
		$id_rumah_layanan	= $this->uri->segment(3);
		$pilih_tahun	= $this->uri->segment(4);
		$data['result'] = $this->db->query("SELECT k.nama_kontrak,p.jumlah_realisasi,p.keterangan,p.tgl_realisasi,a.nama_akun,a.kode FROM pengajuan AS p INNER JOIN rencana_operasional AS ro ON p.id_ro = ro.id_ro INNER JOIN akun AS a ON ro.akun = a.id_akun INNER JOIN kontrak AS k ON ro.id_kontrak = k.id_kontrak WHERE k.id_rumah_layanan = $id_rumah_layanan AND p.status_realisasi = 1 AND p.status_pengajuan = 1 AND YEAR(tgl_realisasi)=$pilih_tahun")->result();
		$data['result_rkakl'] = $this->db->query("SELECT p.id_pengajuan,p.jumlah,p.status_realisasi,p.status_pengajuan,p.tgl_pengajuan,p.keterangan,a.kode AS kode_akun,a.nama_akun,dr.id,r.keterangan AS keterangan_rkakl,p.id_detail_rkakl,dr.biaya,r.id_rkakl,p.tgl_realisasi,p.jumlah_realisasi FROM pengajuan_rkakl AS p INNER JOIN detail_rkakl AS dr ON p.id_detail_rkakl = dr.id INNER JOIN akun AS a ON dr.akun = a.id_akun INNER JOIN rkakl AS r ON dr.id_rkakl = r.id_rkakl INNER JOIN rumah_layanan AS rl ON r.id_layanan = rl.id_rumah_layanan WHERE r.id_layanan = $id_rumah_layanan AND p.status_realisasi = 1 AND p.status_pengajuan = 1 AND YEAR(p.tgl_realisasi) = $pilih_tahun")->result();
		$data['isi'] = 'admin/dashboard_detail_pengeluaran';
		$this->load->view('new/pimpinan_index',$data);
	}

	public function detail_piutang()
	{
		$id_rumah_layanan	= $this->uri->segment(3);
		//$pilih_tahun	= $this->uri->segment(4);
		//$data['result'] = $this->db->query("SELECT k.nama_kontrak,p.nama_perusahaan,k.tgl_mulai,k.tgl_akhir,t.jumlah,t.termin,k.status,k.id_kontrak,t.status_pembayaran,t.tgl_invoice,t.jumlah_penagihan FROM termin AS t INNER JOIN kontrak AS k ON t.id_kontrak = k.id_kontrak INNER JOIN perusahaan AS p ON k.id_perusahaan = p.id_perusahaan WHERE k.id_rumah_layanan = $id_rumah_layanan AND YEAR(t.tgl_invoice) = $pilih_tahun AND t.status_cetak_invoice=1")->result();
		$data['result'] = $this->db->query("SELECT k.nama_kontrak,p.nama_perusahaan,k.tgl_mulai,k.tgl_akhir,t.jumlah,t.termin,k.status,k.id_kontrak,t.status_pembayaran,t.tgl_invoice,t.jumlah_penagihan,t.id_termin FROM termin AS t INNER JOIN kontrak AS k ON t.id_kontrak = k.id_kontrak INNER JOIN perusahaan AS p ON k.id_perusahaan = p.id_perusahaan WHERE k.id_rumah_layanan = $id_rumah_layanan AND t.status_cetak_invoice=1 AND t.status_pembayaran = 0")->result();
		$data['isi'] = 'admin/dashboard_detail_piutang';
		$this->load->view('new/pimpinan_index',$data);
	}

	public function detail_piutang_grafik()
	{
		$id_satker = $this->session->userdata('admin_id_satker');
		$pilih_tahun = DATE('Y');
		$data['pelaksana_layanan'] = $this->db->query("SELECT id_rumah_layanan,nama FROM rumah_layanan WHERE id_satker = $id_satker")->result();
		//$id_rumah_layanan	= $this->uri->segment(3);
		//$pilih_tahun	= $this->uri->segment(4);
		//$data['result'] = $this->db->query("SELECT k.nama_kontrak,p.nama_perusahaan,k.tgl_mulai,k.tgl_akhir,t.jumlah,t.termin,k.status,k.id_kontrak,t.status_pembayaran,t.tgl_invoice,t.jumlah_penagihan FROM termin AS t INNER JOIN kontrak AS k ON t.id_kontrak = k.id_kontrak INNER JOIN perusahaan AS p ON k.id_perusahaan = p.id_perusahaan WHERE k.id_rumah_layanan = $id_rumah_layanan AND YEAR(t.tgl_invoice) = $pilih_tahun AND t.status_cetak_invoice=1")->result();
		$data['result_lancar'] = $this->db->query("SELECT SUM(t.jumlah) AS total_piutang, t.jumlah_penagihan,k.id_rumah_layanan FROM termin AS t INNER JOIN kontrak AS k ON t.id_kontrak = k.id_kontrak INNER JOIN perusahaan AS p ON k.id_perusahaan = p.id_perusahaan WHERE k.id_satker = $id_satker AND t.status_cetak_invoice=1 AND t.status_pembayaran = 0 AND t.jumlah_penagihan IS NULL GROUP BY t.jumlah_penagihan,k.id_rumah_layanan")->result();
		$data['result_kurang'] = $this->db->query("SELECT SUM(t.jumlah) AS total_piutang, t.jumlah_penagihan,k.id_rumah_layanan FROM termin AS t INNER JOIN kontrak AS k ON t.id_kontrak = k.id_kontrak INNER JOIN perusahaan AS p ON k.id_perusahaan = p.id_perusahaan WHERE k.id_satker = $id_satker AND t.status_cetak_invoice=1 AND t.status_pembayaran = 0 AND t.jumlah_penagihan = 1 GROUP BY t.jumlah_penagihan,k.id_rumah_layanan")->result();
		$data['result_diragukan'] = $this->db->query("SELECT SUM(t.jumlah) AS total_piutang, t.jumlah_penagihan,k.id_rumah_layanan FROM termin AS t INNER JOIN kontrak AS k ON t.id_kontrak = k.id_kontrak INNER JOIN perusahaan AS p ON k.id_perusahaan = p.id_perusahaan WHERE k.id_satker = $id_satker AND t.status_cetak_invoice=1 AND t.status_pembayaran = 0 AND t.jumlah_penagihan = 2 GROUP BY t.jumlah_penagihan,k.id_rumah_layanan")->result();
		$data['result_macet'] = $this->db->query("SELECT SUM(t.jumlah) AS total_piutang, t.jumlah_penagihan,k.id_rumah_layanan FROM termin AS t INNER JOIN kontrak AS k ON t.id_kontrak = k.id_kontrak INNER JOIN perusahaan AS p ON k.id_perusahaan = p.id_perusahaan WHERE k.id_satker = $id_satker AND t.status_cetak_invoice=1 AND t.status_pembayaran = 0 AND t.jumlah_penagihan = 3 GROUP BY t.jumlah_penagihan,k.id_rumah_layanan")->result();
		$data['lancar'] = $this->db->query("SELECT SUM(t.jumlah) AS total_piutang, t.jumlah_penagihan,k.id_rumah_layanan FROM termin AS t INNER JOIN kontrak AS k ON t.id_kontrak = k.id_kontrak INNER JOIN perusahaan AS p ON k.id_perusahaan = p.id_perusahaan WHERE k.id_satker = $id_satker AND t.status_cetak_invoice=1 AND t.status_pembayaran = 0 AND t.jumlah_penagihan IS NULL GROUP BY t.jumlah_penagihan")->row();
		$data['kurang'] = $this->db->query("SELECT SUM(t.jumlah) AS total_piutang, t.jumlah_penagihan,k.id_rumah_layanan FROM termin AS t INNER JOIN kontrak AS k ON t.id_kontrak = k.id_kontrak INNER JOIN perusahaan AS p ON k.id_perusahaan = p.id_perusahaan WHERE k.id_satker = $id_satker AND t.status_cetak_invoice=1 AND t.status_pembayaran = 0 AND t.jumlah_penagihan = 1 GROUP BY t.jumlah_penagihan")->row();
		$data['diragukan'] = $this->db->query("SELECT SUM(t.jumlah) AS total_piutang, t.jumlah_penagihan,k.id_rumah_layanan FROM termin AS t INNER JOIN kontrak AS k ON t.id_kontrak = k.id_kontrak INNER JOIN perusahaan AS p ON k.id_perusahaan = p.id_perusahaan WHERE k.id_satker = $id_satker AND t.status_cetak_invoice=1 AND t.status_pembayaran = 0 AND t.jumlah_penagihan = 2 GROUP BY t.jumlah_penagihan")->row();
		$data['macet'] = $this->db->query("SELECT SUM(t.jumlah) AS total_piutang, t.jumlah_penagihan,k.id_rumah_layanan FROM termin AS t INNER JOIN kontrak AS k ON t.id_kontrak = k.id_kontrak INNER JOIN perusahaan AS p ON k.id_perusahaan = p.id_perusahaan WHERE k.id_satker = $id_satker AND t.status_cetak_invoice=1 AND t.status_pembayaran = 0 AND t.jumlah_penagihan = 3 GROUP BY t.jumlah_penagihan")->row();
		$data['isi'] = 'admin/dashboard_detail_piutang_grafik';
		$this->load->view('new/pimpinan_index',$data);
	}

}
?>
