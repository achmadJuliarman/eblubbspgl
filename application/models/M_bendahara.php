<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_bendahara extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function rumah_layanan($id)
	{
		$this->db->select('*');
		$this->db->from('rumah_layanan');
		$this->db->where('id_rumah_layanan',$id);
		return $query = $this->db->get();
	}

	public function list_po()
	{
		$this->db->select('*');
		$this->db->from('po');
		//$this->db->where('status',0);
		return $query = $this->db->get();
	}

	public function list_ba()
	{
		$id_satker = $this->session->userdata('admin_id_satker');
		$this->db->select('*,COUNT(t.id_termin) AS jumlah');
		$this->db->from('termin AS t');
		$this->db->join('kontrak AS k','t.id_kontrak = k.id_kontrak');
		$this->db->where('t.status_realisasi',1);
		$this->db->where('t.tgl_operasional !=',NULL);
		$this->db->where('k.id_satker',$id_satker);
		$this->db->group_by('t.tgl_operasional');
		return $query = $this->db->get();
	}

	public function jenis_layanan($id)
	{
		$this->db->select('*');
		$this->db->from('jenis_layanan');
		$this->db->where('id_jenis_layanan',$id);
		return $query = $this->db->get();
	}

	public function list_jenis_layanan()
	{
		$this->db->select('*');
		$this->db->from('jenis_layanan');
		return $query = $this->db->get();
	}

	public function jenis_layanan_rekap()
	{
		$this->db->select('*');
		$this->db->from('jenis_layanan');
		$this->db->where('id_jenis_layanan',$id);
		return $query = $this->db->get();
	}

	public function detail_layanan($id)
	{
		$this->db->select('*');
		$this->db->from('detail_layanan');
		$this->db->where('id_detail',$id);
		return $query = $this->db->get();
	}

	public function cetak_invoice($id)
	{
		$this->db->select('*,t.keterangan AS termin_keterangan');
		$this->db->from('termin AS t');
		$this->db->join('kontrak AS k','t.id_kontrak=k.id_kontrak');
		$this->db->join('perusahaan AS p','k.id_perusahaan=p.id_perusahaan');
		$this->db->where('t.id_termin',$id);
		return $query = $this->db->get();
	}

	public function cetak_invoice_po($id)
	{
		$this->db->select('*');
		$this->db->from('termin AS t');
		$this->db->join('kontrak AS k','t.id_kontrak=k.id_kontrak');
		$this->db->join('perusahaan AS p','k.id_perusahaan=p.id_perusahaan');
		$this->db->where('t.id_termin',$id);
		return $query = $this->db->get();
	}

	public function cetak_kwitansi_po($id)
	{
		$this->db->select('*');
		$this->db->from('po');
		$this->db->where('id_po',$id);
		return $query = $this->db->get();
	}

	public function cetak_ba_po($id)
	{
		$tahun = DATE("Y");
		$this->db->select('*');
		$this->db->from('termin AS t');
		$this->db->join('kontrak AS k','t.id_kontrak=k.id_kontrak');
		$this->db->join('perusahaan AS p','k.id_perusahaan=p.id_perusahaan');
		$this->db->where('t.tgl_operasional',$id);
		return $query = $this->db->get();
	}

	public function cetak_ba_po_kategori($kategori)
	{
		$id_satker = $this->session->userdata('admin_id_satker');
		$tahun = DATE("Y");
		$this->db->select('*');
		$this->db->from('termin AS t');
		$this->db->join('kontrak AS k','t.id_kontrak=k.id_kontrak');
		$this->db->join('perusahaan AS p','k.id_perusahaan=p.id_perusahaan');
		$this->db->join('detail_layanan AS dl','k.id_jasa=dl.id_detail');
		$this->db->where('dl.id_kategori',$kategori);
		//$this->db->where('YEAR(t.tgl_termin)',$tahun);
		$this->db->where('k.id_satker',$id_satker);
		$this->db->where('k.status','PO');
		return $query = $this->db->get();
	}

	public function detail($id)
	{
		$this->db->select('*');
		$this->db->from('po');
		$this->db->where('id_jasa',$id);
		return $query = $this->db->get();
	}

	public function jumlah_sample($id)
	{
		$this->db->select('SUM(jumlah_sample) AS jumlah');
		$this->db->from('po');
		$this->db->where('id_jasa',$id);
		return $query = $this->db->get();
	}

	public function simpan($data)
	{
		return 	$this->db->insert('t_diklat', $data);
	}

	// public function pindah_operasional($id,$keterangan,$no_sertifikat,$tgl_sertifikat)
	// {
	// 	$tanggal = date("Y-m-d");
	// 	return 	$this->db->query("UPDATE po SET status = 1,keterangan='$keterangan',no_sertifikat='$no_sertifikat',tgl_sertifikat='$tgl_sertifikat',tgl_operasional='$tanggal' WHERE id_po = $id");
	// }

	public function simpan_foto($data)
	{
		return 	$this->db->insert('t_foto_diklat', $data);
	}

	public function hapus($id)
	{
		$this->db->where('id',$id);
		return $this->db->delete('m_dokumen');
	}



}
