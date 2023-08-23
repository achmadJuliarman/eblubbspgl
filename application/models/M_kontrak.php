<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kontrak extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function add_kontrak($data)
	{
		return 	$this->db->insert('kontrak', $data);
	}

	public function history_kontrak($data)
	{
		return 	$this->db->insert('history', $data);
	}

	public function history_dokumen($data)
	{
		return 	$this->db->insert('history_dokumen', $data);
	}

	public function edit_kontrak($id_kontrak,$data)
	{
		$this->db->where('id_kontrak', $id_kontrak);
		$this->db->update('kontrak', $data);
	}

	public function adendum_kontrak($data)
	{
		$this->db->insert('adendum', $data);
		//$this->db->update('kontrak', $data);
	}

	public function list_progress()
	{
		//$tahun = DATE('Y');
		$id_satker = $this->session->userdata('admin_id_satker');
		$this->db->select('*,k.status AS status_kegiatan');
		$this->db->from('kegiatan AS k');
		$this->db->join('kontrak AS kon','k.id_kontrak=kon.id_kontrak');
		$this->db->join('rumah_layanan AS rl','kon.id_rumah_layanan=rl.id_rumah_layanan');
		$this->db->where('k.status',1);
		$this->db->or_where('k.status',4);
		$this->db->where('kon.id_satker',$id_satker);
		return $query = $this->db->get();
	}

	public function list_kendala()
	{
		$id = $this->session->userdata('admin_id');
		$this->db->select('dk.id_kendala,dk.solusi,dk.tanggal,dk.status,k.keterangan,u1.username AS pengirim,u2.username AS penerima');
		$this->db->from('detail_kendala AS dk');
		$this->db->join('kendala AS k','dk.id_kendala=k.id_kendala');
		$this->db->join('user AS u1','dk.pengirim=u1.id_user');
		$this->db->join('user AS u2','dk.penerima=u2.id_user');
		$this->db->where('dk.penerima',$id);
		return $query = $this->db->get();
	}

	public function list_kendala_all()
	{
		$tahun = DATE('Y');
		$this->db->select('k.id_kendala,k.id_kegiatan,k.status,k.tanggal,k.tanggal,k.is_read,rl.nama,keg.nama_kegiatan,k.keterangan,rl.kode');
		//$this->db->from('detail_kendala AS dk');
		$this->db->from('kendala AS k','dk.id_kendala=k.id_kendala');
		$this->db->join('kegiatan AS keg','k.id_kegiatan=keg.id_kegiatan');
		$this->db->join('kontrak AS kon','keg.id_kontrak=kon.id_kontrak');
		$this->db->join('rumah_layanan AS rl','kon.id_rumah_layanan=rl.id_rumah_layanan');
		$this->db->where('YEAR(k.tanggal)',$tahun);
		return $query = $this->db->get();
	}

	public function list_kendala_inbox($id)
	{
		$this->db->select('k.keterangan,k.id_kendala,rl.kode,rl.nama,u.username,k.id_kegiatan');
		$this->db->from('kendala AS k');
		$this->db->join('kegiatan AS keg','k.id_kegiatan=keg.id_kegiatan');
		$this->db->join('kontrak AS kon','keg.id_kontrak=kon.id_kontrak');
		$this->db->join('rumah_layanan AS rl','kon.id_rumah_layanan=rl.id_rumah_layanan');
		$this->db->join('user AS u','u.id_pegawai=rl.id_pegawai');
		$this->db->where('k.id_kendala',$id);
		return $query = $this->db->get();
	}



	public function list_detail_kendala($id)
	{
		$this->db->select('dk.id_detail_kendala,dk.id_kendala,dk.solusi,dk.status,dk.tanggal,dk.is_read,keg.nama_kegiatan,k.keterangan,u1.username AS pengirim,u2.username AS penerima,rl.nama,rl.kode,dk.detail_keterangan');
		$this->db->from('detail_kendala AS dk');
		$this->db->join('kendala AS k','dk.id_kendala=k.id_kendala');
		$this->db->join('kegiatan AS keg','k.id_kegiatan=keg.id_kegiatan');
		$this->db->join('kontrak AS kon','keg.id_kontrak=kon.id_kontrak');
		$this->db->join('rumah_layanan AS rl','kon.id_rumah_layanan=rl.id_rumah_layanan');
		$this->db->join('user AS u1','dk.pengirim=u1.id_user');
		$this->db->join('user AS u2','dk.penerima=u2.id_user');
		$this->db->where('dk.id_kendala',$id);
		return $query = $this->db->get();
	}

	public function list_rkakl()
	{
		$tahun = DATE('Y');
		$id_pegawai = $this->session->userdata('admin_id_pegawai');
		$this->db->select('*');
		$this->db->from('rkakl AS r');
		$this->db->join('rumah_layanan AS rl','r.id_layanan=rl.id_rumah_layanan');
		$this->db->join('user AS u','rl.id_pegawai=u.id_pegawai');
		$this->db->where('u.id_pegawai',$id_pegawai);
		$this->db->order_by('r.id_rkakl','DESC');
		return $query = $this->db->get();
	}

	public function list_detail_rkakl()
	{
		$tahun = DATE('Y');
		$id_rumah_layanan = $this->session->userdata('admin_id_rumah_layanan');
		$this->db->select('*,a.kode AS kode_akun');
		$this->db->from('detail_rkakl AS dr');
		$this->db->join('rkakl AS r','dr.id_rkakl=r.id_rkakl');
		$this->db->join('akun AS a','dr.akun = a.id_akun');
		$this->db->join('rumah_layanan AS rl','r.id_layanan = rl.id_rumah_layanan');
		$this->db->where('r.id_layanan',$id_rumah_layanan);
		return $query = $this->db->get();
	}



	public function list_kontrak_detail($id_satker,$pilih_tahun)
	{
		$this->db->select('*');
		$this->db->from('termin AS t');
		$this->db->join('kontrak AS k','t.id_kontrak = k.id_kontrak');
		$this->db->join('perusahaan AS p','k.id_perusahaan=p.id_perusahaan');
		//$this->db->where('status','K');
		$this->db->where('k.id_satker',$id_satker);
		$this->db->where('t.status_pembayaran',0);
		$this->db->where('YEAR(k.tgl_akhir)<=',$pilih_tahun);
		$this->db->group_by('k.id_kontrak');
		$this->db->order_by('t.id_termin','DESC');
		return $query = $this->db->get();
	}

	// public function list_kontrak_detail($id_satker,$pilih_tahun)
	// {
	// 	$this->db->select('*');
	// 	$this->db->from('kontrak AS k');
	// 	$this->db->join('perusahaan AS p','k.id_perusahaan=p.id_perusahaan');
	// 	//$this->db->where('status','K');
	// 	$this->db->where('k.id_satker',$id_satker);
	// 	$this->db->where('YEAR(k.tgl_akhir)<=',$pilih_tahun);
	// 	return $query = $this->db->get();
	// }

	public function list_kontrak_detail_satker($id_rumah_layanan,$pilih_tahun)
	{
		$this->db->select('*');
		$this->db->from('kontrak AS k');
		$this->db->join('perusahaan AS p','k.id_perusahaan=p.id_perusahaan');
		//$this->db->where('status','K');
		$this->db->where('k.id_rumah_layanan',$id_rumah_layanan);
		$this->db->where('YEAR(k.tgl_akhir)',$pilih_tahun);
		$this->db->order_by('k.id_kontrak','DESC');
		return $query = $this->db->get();
	}

public function list_po($kategori)
	{
		$tahun = DATE('Y');
		$id_satker = $this->session->userdata('admin_id_satker');
		//$this->db->select('*,LEFT(created_time,10) as tanggal');
		$this->db->select('*,t.tgl_termin as tanggal');
		$this->db->from('termin AS t');
		$this->db->join('kontrak AS k','t.id_kontrak=k.id_kontrak');
		$this->db->join('perusahaan AS p','k.id_perusahaan=p.id_perusahaan');
		$this->db->join('detail_layanan AS dl','k.id_jasa=dl.id_detail');
		$this->db->where('k.status','PO');
		$this->db->where('dl.id_kategori',$kategori);
		$this->db->where('k.id_satker',$id_satker);
		$this->db->order_by('t.id_termin','DESC');
		$this->db->where('YEAR(t.tgl_termin)',$tahun);
		return $query = $this->db->get();
	}

public function list_po_all()
	{
		$tahun = DATE('Y');
		$id_satker = $this->session->userdata('admin_id_satker');
		//$this->db->select('*,LEFT(created_time,10) as tanggal');
		$this->db->select('*,t.tgl_termin as tanggal');
		$this->db->from('termin AS t');
		$this->db->join('kontrak AS k','t.id_kontrak=k.id_kontrak');
		$this->db->join('perusahaan AS p','k.id_perusahaan=p.id_perusahaan');
		$this->db->join('detail_layanan AS dl','k.id_jasa=dl.id_detail');
		$this->db->join('jenis_layanan AS jl','dl.id_layanan=jl.id_jenis_layanan');
		$this->db->where('k.status','PO');
		$this->db->where('k.id_satker',$id_satker);
		$this->db->order_by('t.id_termin','DESC');
		$this->db->where('YEAR(k.tgl_akhir)>=',$tahun);
		return $query = $this->db->get();
	}

	public function list_termin()
	{
		$tahun = DATE('Y');
		$id_satker = $this->session->userdata('admin_id_satker');
		$this->db->select('t.id_termin,t.termin,t.id_kontrak,k.nama_kontrak,k.tgl_mulai,k.tgl_akhir,k.nilai_kontrak,p.nama_perusahaan');
		$this->db->from('termin AS t');
		$this->db->join('kontrak AS k','t.id_kontrak=k.id_kontrak');
		$this->db->join('perusahaan AS p','k.id_perusahaan=p.id_perusahaan');
		$this->db->where('RIGHT(k.tgl_akhir,4)',$tahun);
		$this->db->where('t.status_termin',1);
		$this->db->where('k.id_satker',$id_satker);
		$this->db->where('YEAR(k.tgl_akhir)>=',$tahun);
		$this->db->order_by('t.id_termin','DESC');
		return $query = $this->db->get();
	}

public function list_pengajuan()
	{
		$id_satker = $this->session->userdata('admin_id_satker');
		$this->db->select('p.id_pengajuan,p.jumlah,p.status_realisasi,p.status_pengajuan,p.tgl_pengajuan,p.keterangan,keg.nama_kegiatan,k.nama_kontrak,k.id_kontrak,a.kode,a.nama_akun,p.tgl_realisasi,p.no_urut,p.file');
		$this->db->from('pengajuan AS p');
		$this->db->join('rencana_operasional AS ro','p.id_ro = ro.id_ro');
		$this->db->join('kegiatan AS keg','ro.id_kegiatan = keg.id_kegiatan');
		$this->db->join('kontrak AS k','ro.id_kontrak = k.id_kontrak');
		$this->db->join('akun AS a','ro.akun = a.id_akun');
		$this->db->where('k.id_satker',$id_satker);
		$this->db->order_by('p.id_pengajuan','DESC');
		return $query = $this->db->get();
	}

public function list_pengajuan_approved()
	{
		$id_satker = $this->session->userdata('admin_id_satker');
		$tahun = DATE('Y');
		$this->db->select('p.id_pengajuan,p.jumlah,p.status_realisasi,p.status_pengajuan,p.tgl_pengajuan,p.keterangan,keg.nama_kegiatan,k.nama_kontrak,k.id_kontrak,a.kode,a.nama_akun,p.tgl_realisasi,p.jumlah_realisasi,p.no_urut,p.status_sync');
		$this->db->from('pengajuan AS p');
		$this->db->join('rencana_operasional AS ro','p.id_ro = ro.id_ro');
		$this->db->join('kegiatan AS keg','ro.id_kegiatan = keg.id_kegiatan');
		$this->db->join('kontrak AS k','ro.id_kontrak = k.id_kontrak');
		$this->db->join('akun AS a','ro.akun = a.id_akun');
		$this->db->where('YEAR(p.tgl_pengajuan)',$tahun);
		$this->db->where('k.id_satker',$id_satker);
		$this->db->where('p.status_pengajuan',1);
		$this->db->order_by('p.id_pengajuan','DESC');
		return $query = $this->db->get();
	}

public function list_pengajuan_sync()
	{
		$id_satker = $this->session->userdata('admin_id_satker');
		$this->db->select('p.id_pengajuan,p.jumlah,p.status_realisasi,p.status_pengajuan,p.tgl_pengajuan,p.keterangan,keg.nama_kegiatan,k.nama_kontrak,k.id_kontrak,a.kode,a.nama_akun,p.tgl_realisasi,p.jumlah_realisasi,p.no_urut');
		$this->db->from('pengajuan AS p');
		$this->db->join('rencana_operasional AS ro','p.id_ro = ro.id_ro');
		$this->db->join('kegiatan AS keg','ro.id_kegiatan = keg.id_kegiatan');
		$this->db->join('kontrak AS k','ro.id_kontrak = k.id_kontrak');
		$this->db->join('akun AS a','ro.akun = a.id_akun');
		$this->db->where('k.id_satker',$id_satker);
		$this->db->where('p.status_sync',0);
		$this->db->order_by('p.id_pengajuan','DESC');
		return $query = $this->db->get();
	}

public function list_pengajuan_rkakl()
	{
		$tahun = DATE('Y');
		$id_satker = $this->session->userdata('admin_id_satker');
		$this->db->select('p.id_pengajuan,p.jumlah,p.status_realisasi,p.status_pengajuan,p.tgl_pengajuan,p.keterangan,a.kode AS kode_akun,a.nama_akun,dr.id,r.keterangan AS keterangan_rkakl,p.id_detail_rkakl,dr.biaya,r.id_rkakl,p.tgl_realisasi,p.no_urut,p.file');
		$this->db->from('pengajuan_rkakl AS p');
		$this->db->join('detail_rkakl AS dr','p.id_detail_rkakl = dr.id');
		$this->db->join('rkakl AS r','dr.id_rkakl = r.id_rkakl');
		$this->db->join('akun AS a','dr.akun = a.id_akun');
		$this->db->join('rumah_layanan AS rl','r.id_layanan = rl.id_rumah_layanan');
		$this->db->where('YEAR(p.tgl_pengajuan)',$tahun);
		$this->db->where('rl.id_satker',$id_satker);
		$this->db->order_by('p.id_pengajuan','DESC');
		return $query = $this->db->get();
	}

public function list_pengajuan_rkakl_approved()
	{
		$id_satker = $this->session->userdata('admin_id_satker');
		$this->db->select('p.id_pengajuan,p.jumlah,p.status_realisasi,p.status_pengajuan,p.tgl_pengajuan,p.keterangan,a.kode AS kode_akun,a.nama_akun,dr.id,r.keterangan AS keterangan_rkakl,p.id_detail_rkakl,dr.biaya,r.id_rkakl,p.tgl_realisasi,p.jumlah_realisasi,p.no_urut,p.status_sync');
		$this->db->from('pengajuan_rkakl AS p');
		$this->db->join('detail_rkakl AS dr','p.id_detail_rkakl = dr.id');
		$this->db->join('rkakl AS r','dr.id_rkakl = r.id_rkakl');
		$this->db->join('akun AS a','dr.akun = a.id_akun');
		$this->db->join('rumah_layanan AS rl','r.id_layanan = rl.id_rumah_layanan');
		$this->db->where('p.status_pengajuan',1);
		$this->db->where('rl.id_satker',$id_satker);
		$this->db->order_by('p.id_pengajuan','DESC');
		return $query = $this->db->get();
	}

public function list_pengajuan_rkakl_sync()
	{
		$id_satker = $this->session->userdata('admin_id_satker');
		$this->db->select('p.id_pengajuan,p.jumlah,p.status_realisasi,p.status_pengajuan,p.tgl_pengajuan,p.keterangan,a.kode AS kode_akun,a.nama_akun,dr.id,r.keterangan AS keterangan_rkakl,p.id_detail_rkakl,dr.biaya,r.id_rkakl,p.tgl_realisasi,p.jumlah_realisasi,p.no_urut');
		$this->db->from('pengajuan_rkakl AS p');
		$this->db->join('detail_rkakl AS dr','p.id_detail_rkakl = dr.id');
		$this->db->join('rkakl AS r','dr.id_rkakl = r.id_rkakl');
		$this->db->join('akun AS a','dr.akun = a.id_akun');
		$this->db->join('rumah_layanan AS rl','r.id_layanan = rl.id_rumah_layanan');
		$this->db->where('rl.id_satker',$id_satker);
		$this->db->where('p.status_sync',0);
		$this->db->order_by('p.id_pengajuan','DESC');
		return $query = $this->db->get();
	}

public function list_pengajuan_kp3()
	{
		$id_satker = $this->session->userdata('admin_id_satker');
		$this->db->select('p.id_pengajuan,p.jumlah,p.status_realisasi,p.status_pengajuan,p.tgl_pengajuan,p.keterangan,keg.nama_kegiatan,k.nama_kontrak,k.id_kontrak,a.kode,a.nama_akun,p.no_urut');
		$this->db->from('pengajuan AS p');
		$this->db->join('rencana_operasional AS ro','p.id_ro = ro.id_ro');
		$this->db->join('kegiatan AS keg','ro.id_kegiatan = keg.id_kegiatan');
		$this->db->join('kontrak AS k','ro.id_kontrak = k.id_kontrak');
		$this->db->join('akun AS a','ro.akun = a.id_akun');
		$this->db->where('k.id_satker',$id_satker);
		$this->db->order_by('p.id_pengajuan','DESC');
		return $query = $this->db->get();
	}

public function list_pengajuan_kp3_non()
	{
		$id_rumah_layanan = $this->session->userdata('admin_id_rumah_layanan');
		$this->db->select('p.id_pengajuan,p.jumlah,p.status_realisasi,p.status_pengajuan,p.tgl_pengajuan,p.keterangan,a.kode AS kode_akun,a.nama_akun,dr.id,r.keterangan AS keterangan_rkakl,p.id_detail_rkakl,dr.biaya,p.keterangan_tolak,p.no_urut,p.jumlah_realisasi,p.file');
		$this->db->from('pengajuan_rkakl AS p');
		$this->db->join('detail_rkakl AS dr','p.id_detail_rkakl = dr.id');
		$this->db->join('rkakl AS r','dr.id_rkakl = r.id_rkakl');
		$this->db->join('akun AS a','dr.akun = a.id_akun');
		$this->db->join('rumah_layanan AS rl','r.id_layanan = rl.id_rumah_layanan');
		$this->db->where('r.id_layanan',$id_rumah_layanan);
		$this->db->order_by('p.id_pengajuan','DESC');
		return $query = $this->db->get();
	}

	public function list_termin_pembayaran()
	{
		$tahun = DATE('Y');
		$id_satker = $this->session->userdata('admin_id_satker');
		$this->db->select('t.id_termin,t.termin,t.id_kontrak,k.nama_kontrak,k.tgl_mulai,k.tgl_akhir,k.nilai_kontrak,p.nama_perusahaan,t.jumlah,t.status_cetak_invoice,t.status_cetak_kwitansi,t.status_pembayaran,k.id_jasa,k.id_rumah_layanan,t.no_invoice,t.no_kwitansi');
		$this->db->from('termin AS t');
		$this->db->join('kontrak AS k','t.id_kontrak=k.id_kontrak');
		$this->db->join('perusahaan AS p','k.id_perusahaan=p.id_perusahaan');
		$this->db->where('RIGHT(k.tgl_akhir,4)',$tahun);
		$this->db->where('t.status_termin',1);
		$this->db->where('k.id_satker',$id_satker);
		$this->db->order_by('t.id_termin','DESC');
		//$this->db->where('YEAR(k.tgl_akhir)>=',$tahun);
		return $query = $this->db->get();
	}

	public function list_termin_pembayaran_kontrak()
	{
		$tahun = DATE('Y');
		$id_satker = $this->session->userdata('admin_id_satker');
		return $this->db->query("SELECT *,t.termin AS keterangan_termin FROM termin AS t INNER JOIN kontrak AS k ON t.id_kontrak = k.id_kontrak INNER JOIN perusahaan AS p ON k.id_perusahaan=p.id_perusahaan WHERE (k.status = 'K' AND t.status_pembayaran = 0 AND k.id_satker = $id_satker) OR (k.status='K' AND YEAR(t.tgl_termin)>=$tahun AND k.id_satker = $id_satker) ORDER BY t.id_termin DESC");
		// $this->db->select('t.id_termin,t.termin,t.id_kontrak,k.nama_kontrak,k.tgl_mulai,k.tgl_akhir,k.nilai_kontrak,p.nama_perusahaan,t.jumlah,t.status_cetak_invoice,t.status_cetak_kwitansi,t.status_pembayaran,k.id_jasa,k.id_rumah_layanan,t.no_invoice,t.no_kwitansi,t.status_realisasi,t.jumlah_realisasi,t.tgl_pembayaran,t.tgl_invoice,t.jumlah_penagihan');
		// $this->db->from('termin AS t');
		// $this->db->join('kontrak AS k','t.id_kontrak=k.id_kontrak');
		// $this->db->join('perusahaan AS p','k.id_perusahaan=p.id_perusahaan');
		// //$this->db->where('YEAR(k.tgl_akhir)',$tahun);
		// $this->db->where('t.status_termin',1);
		// $this->db->where('k.id_satker',$id_satker);
		// $this->db->where('k.status','K');
		// $this->db->where('YEAR(t.tgl_termin)>=',$tahun);
		// //$this->db->or_where('t.status_pembayaran',0);
		// $this->db->order_by('t.id_termin',DESC);
		//$this->db->where('YEAR(k.tgl_akhir)>=',$tahun);
		//return $query = $this->db->get();
	}

	public function list_termin_pembayaran_kontrak_realisasi()
	{
		$tahun = DATE('Y');
		$id_satker = $this->session->userdata('admin_id_satker');
		$this->db->select('t.id_termin,t.termin,t.id_kontrak,k.nama_kontrak,k.tgl_mulai,k.tgl_akhir,k.nilai_kontrak,p.nama_perusahaan,t.jumlah,t.status_cetak_invoice,t.status_cetak_kwitansi,t.status_pembayaran,k.id_jasa,k.id_rumah_layanan,t.no_invoice,t.no_kwitansi,t.status_realisasi,t.jumlah_realisasi,t.tgl_pembayaran,t.tgl_invoice,t.jumlah_penagihan,DATEDIFF(CURRENT_DATE(), tgl_termin) AS selisih');
		$this->db->from('termin AS t');
		$this->db->join('kontrak AS k','t.id_kontrak=k.id_kontrak');
		$this->db->join('perusahaan AS p','k.id_perusahaan=p.id_perusahaan');
		$this->db->where('YEAR(t.tgl_termin)',$tahun);
		$this->db->where('t.status_pembayaran',1);
		$this->db->where('k.id_satker',$id_satker);
		$this->db->where('k.status','K');
		$this->db->order_by('t.id_termin','DESC');
		//$this->db->where('DATEDIFF(CURRENT_DATE(), tgl_termin)', > 30);
		//$this->db->where('YEAR(k.tgl_akhir)>=',$tahun);
		return $query = $this->db->get();
	}

	public function list_kontrak()
	{
		$tahun = DATE('Y');
		$id_satker = $this->session->userdata('admin_id_satker');
		$this->db->select('*,p2.nama AS nama_pic,datediff(current_date(), k.tgl_akhir) as selisih');
		$this->db->from('kontrak AS k');
		$this->db->join('perusahaan AS p','k.id_perusahaan=p.id_perusahaan');
		$this->db->join('rumah_layanan AS rl','k.id_rumah_layanan=rl.id_rumah_layanan');
		$this->db->join('pegawai2 AS p2','k.pic=p2.id', 'left');
		$this->db->where('k.status','K');
		$this->db->where('k.id_satker',$id_satker);
		$this->db->order_by('created_time','DESC');
		return $query = $this->db->get();
	}

	public function list_kontrak_kp3()
	{
		$tahun = DATE('Y');
		$id_rumah_layanan = $this->session->userdata('admin_id_rumah_layanan');
		$this->db->select('*');
		$this->db->from('kontrak AS k');
		$this->db->join('perusahaan AS p','k.id_perusahaan=p.id_perusahaan');
		$this->db->join('rumah_layanan AS rl','k.id_rumah_layanan=rl.id_rumah_layanan');
		//$this->db->where('RIGHT(k.tgl_akhir,4)',$tahun);
		$this->db->where('k.status','K');
		$this->db->where('k.id_rumah_layanan',$id_rumah_layanan);
		$this->db->order_by('created_time','DESC');
		//$this->db->where('YEAR(k.tgl_akhir)>=',$tahun);
		return $query = $this->db->get();
	}

	public function list_rumah_layanan()
	{
		$id_satker = $this->session->userdata('admin_id_satker');
		$this->db->select('rl.id_rumah_layanan,rl.nama,rl.kode,rl.id_pegawai,p.nip,p.nama AS nama_pegawai');
		$this->db->from('rumah_layanan AS rl');
		$this->db->join('pegawai2 AS p','rl.id_pegawai=p.id');
		$this->db->where('rl.id_satker',$id_satker);
		return $query = $this->db->get();
	}

	public function list_jenis_layanan()
	{
		$id_satker = $this->session->userdata('admin_id_satker');
		$this->db->select('*,jl.kode AS kode_layanan,rl.kode AS kode_rumah_layanan');
		$this->db->from('jenis_layanan AS jl');
		$this->db->join('rumah_layanan AS rl','.jl.id_rumah_layanan=rl.id_rumah_layanan');
		$this->db->where('rl.id_satker',$id_satker);
		return $query = $this->db->get();
	}

	public function list_detail_layanan()
	{
		$id_satker = $this->session->userdata('admin_id_satker');
		$this->db->select('dl.id_detail,dl.id_layanan,dl.nama_layanan,dl.kode_layanan,dl.id_satker,jl.jenis,jl.kode');
		$this->db->from('detail_layanan AS dl');
		$this->db->join('jenis_layanan AS jl','dl.id_layanan=jl.id_jenis_layanan');
		$this->db->where('dl.id_satker',$id_satker);
		return $query = $this->db->get();
	}

	public function list_perusahaan()
	{
		$this->db->select('*');
		$this->db->from('perusahaan');
		return $query = $this->db->get();
	}

	public function list_kategori_layanan()
	{
		$this->db->select('*');
		$this->db->from('kategori_layanan');
		$this->db->where('id_kategori >',0);
		return $query = $this->db->get();
	}

	public function list_kode_penerimaan()
	{
		$this->db->select('*');
		$this->db->from('akun_penerimaan');
		return $query = $this->db->get();
	}

	public function list_kode_akun()
	{
		$this->db->select('*');
		$this->db->from('akun');
		return $query = $this->db->get();
	}

	public function list_rba()
	{
		$this->db->select('*');
		$this->db->from('rba');
		return $query = $this->db->get();
	}

	public function list_kategori()
	{
		$this->db->select('*');
		$this->db->from('kategori');
		return $query = $this->db->get();
	}

	public function list_kategori_user()
	{
		$this->db->select('*');
		$this->db->from('kategori_user');
		return $query = $this->db->get();
	}

	public function list_jabatan()
	{
		$this->db->select('*');
		$this->db->from('jabatan');
		$this->db->order_by('jabatan');
		return $query = $this->db->get();
	}

	public function list_target_tahun($tahun)
	{
		$id_satker = $this->session->userdata('admin_id_satker');
		$this->db->select('*');
		$this->db->from('target AS t');
		$this->db->join('rumah_layanan AS rl','t.id_rumah_layanan=rl.id_rumah_layanan');
		$this->db->where('rl.id_satker',$id_satker);
		$this->db->where('t.tahun',$tahun);
		return $query = $this->db->get();
	}

	public function list_target()
	{
		$id_satker = $this->session->userdata('admin_id_satker');
		$this->db->select('*');
		$this->db->from('target AS t');
		$this->db->join('rumah_layanan AS rl','t.id_rumah_layanan=rl.id_rumah_layanan');
		$this->db->where('rl.id_satker',$id_satker);
		return $query = $this->db->get();
	}

	public function sum_target($pilih_tahun)
	{
		//$tahun = DATE('Y');
		$id_satker = $this->session->userdata('admin_id_satker');
		$this->db->select('SUM(t.jumlah) AS jumlah');
		$this->db->from('target AS t');
		$this->db->join('rumah_layanan AS rl','t.id_rumah_layanan=rl.id_rumah_layanan');
		$this->db->join('satker AS s','rl.id_satker=s.id_satker');
		$this->db->where('rl.id_satker',$id_satker);
		$this->db->where('t.tahun',$pilih_tahun);
		return $query = $this->db->get();
	}

	public function sum_target_all($pilih_tahun)
	{
		//$tahun = DATE('Y');
		$id_satker = $this->session->userdata('admin_id_satker');
		$this->db->select('SUM(jumlah) AS jumlah');
		$this->db->from('target AS t');
		$this->db->join('rumah_layanan AS rl','t.id_rumah_layanan=rl.id_rumah_layanan');
		$this->db->join('satker AS s','rl.id_satker=s.id_satker');
		//$this->db->where('rl.id_satker',$id_satker);
		$this->db->where('t.tahun',$pilih_tahun);
		return $query = $this->db->get();
	}

	public function list_user()
	{
		$id_satker = $this->session->userdata('admin_id_satker');
		$this->db->select('*,u.kategori AS id_kategori');
		$this->db->from('user AS u');
		$this->db->join('pegawai2 AS p','u.id_pegawai=p.id');
		$this->db->join('kategori_user AS k','u.kategori=k.id_kategori');
		$this->db->order_by('u.username');
		$this->db->where('p.id_satker',$id_satker);
		return $query = $this->db->get();
	}

	public function list_pegawai()
	{
		$id_satker = $this->session->userdata('admin_id_satker');
		$this->db->select('*');
		$this->db->from('pegawai2 AS p');
		$this->db->join('jabatan AS j','p.id_jabatan=j.id_jabatan');
		$this->db->join('kategori AS k','p.id_kategori=k.id_kategori');
		$this->db->order_by('p.nama');
		$this->db->where('p.id_satker',$id_satker);
		return $query = $this->db->get();
	}

	public function list_pejabat_teknis()
	{
		$id_satker = $this->session->userdata('admin_id_satker');
		$this->db->select('*');
		$this->db->from('pegawai2');
		$this->db->order_by('nama');
		$this->db->where('id_kategori',2);
		$this->db->where('id_satker',$id_satker);
		return $query = $this->db->get();
	}

	public function pilih_kontrak($id_kontrak)
	{
		return $this->db->query("SELECT k.id_kontrak,k.nama_kontrak,k.no_kontrak,k.nilai_kontrak,rl.nama AS rumah_layanan,p2.nama AS pejabat_teknis,dl.nama_layanan AS nama_jasa,p.nama AS pic,k.tgl_ttd,k.tgl_mulai,k.tgl_akhir,k.keterangan,k.file,k.termin,k.id_rumah_layanan,rl.kode,k.id_jasa,dl.kode_layanan AS kode_jasa,k.id_rumah_layanan,k.id_perusahaan,per.nama_perusahaan,k.pic,p.nip,p.nama,k.status,k.file_sk,k.status_ro,k.approve_time,k.max_operasional  FROM kontrak AS k
															INNER JOIN rumah_layanan AS rl ON k.id_rumah_layanan = rl.id_rumah_layanan
															INNER JOIN detail_layanan AS dl ON k.id_jasa = dl.id_detail
															INNER JOIN perusahaan AS per ON k.id_perusahaan = per.id_perusahaan
															LEFT JOIN pegawai2 AS p ON k.pic = p.id
															LEFT JOIN pegawai2 AS p2 ON rl.id_pegawai = p2.id
															WHERE k.id_kontrak = $id_kontrak")->row();
	}

	public function pilih_rkakl($id_rkakl)
	{
		return $this->db->query("SELECT * FROM rkakl WHERE id_rkakl = $id_rkakl")->row();
	}

	public function detail($id_rkakl)
	{
		return $this->db->query("SELECT * FROM detail_rkakl INNER JOIN rkakl ON detail_rkakl.id_rkakl = rkakl.id_rkakl WHERE detail_rkakl.id_rkakl = $id_rkakl")->result();
	}



}
