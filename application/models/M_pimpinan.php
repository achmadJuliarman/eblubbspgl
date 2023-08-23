<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pimpinan extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function list_rba()
	{
		//$tahun = DATE("Y");
		$tahun = 2019;
		$this->db->select('*');
		$this->db->from('rba');
		$this->db->where('tahun',$tahun);
		$this->db->order_by('id_layanan');
		return $query = $this->db->get();
		//return $this->db->query("SELECT *,t_artikel.id AS id_artikel FROM t_artikel INNER JOIN t_user ON t_artikel.id_user = t_user.id INNER JOIN t_kategori ON t_artikel.id_kategori = t_kategori.id ORDER BY t_artikel.id DESC LIMIT 6")->result();
	}

	public function list_layanan()
	{
		$tahun = 2019;
		$this->db->select('jl.id_jenis_layanan AS id,jl.jenis,jl.kode,SUM(k.nilai_kontrak) AS jumlah');
		$this->db->from('kontrak AS k');
		$this->db->join('jenis_layanan AS jl', 'k.id_jasa = jl.id_jenis_layanan');
		$this->db->where('RIGHT(tgl_ttd,4)',$tahun);
		$this->db->group_by('jl.jenis');
		$this->db->order_by('jl.id_jenis_layanan');
		return $query = $this->db->get();
		//return $this->db->query("SELECT *,t_artikel.id AS id_artikel FROM t_artikel INNER JOIN t_user ON t_artikel.id_user = t_user.id INNER JOIN t_kategori ON t_artikel.id_kategori = t_kategori.id ORDER BY t_artikel.id DESC LIMIT 6")->result();
	}

	public function detail_list_layanan($id)
	{
		$this->db->select('*');
		$this->db->from('kontrak AS k');
		$this->db->where('k.id_rba',$id);
		return $query = $this->db->get();
		//return $this->db->query("SELECT *,t_artikel.id AS id_artikel FROM t_artikel INNER JOIN t_user ON t_artikel.id_user = t_user.id INNER JOIN t_kategori ON t_artikel.id_kategori = t_kategori.id ORDER BY t_artikel.id DESC LIMIT 6")->result();
	}

	public function simpan($data)
	{
		return 	$this->db->insert('t_diklat', $data);
	}

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
