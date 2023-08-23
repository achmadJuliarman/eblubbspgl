<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_perusahaan extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function list_perusahaan()
	{
		$id_satker = $this->session->userdata('admin_id_satker');
		$this->db->select('*');
		$this->db->from('perusahaan');
		$this->db->where('id_satker',$id_satker);
		return $query = $this->db->get();
	}

	public function pilih_perusahaan($id_perusahaan)
	{
		return $this->db->query("SELECT *,kategori_client.kategori AS nama_kategori FROM perusahaan INNER JOIN kategori_client ON perusahaan.kategori = kategori_client.id_kategori WHERE perusahaan.id_perusahaan = '$id_perusahaan' ")->row();
	}

	public function add_perusahaan($data)
	{
		return 	$this->db->insert('perusahaan', $data);
	}

	public function edit_perusahaan($id_perusahaan,$data)
	{
		$this->db->where('id_perusahaan', $id_perusahaan);
		$this->db->update('perusahaan', $data);
	}



}
