<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_login extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function cek_username($username,$password)
	{
		$this->db->select('u.id_user,u.username,p.nama,j.jabatan,p.id_jabatan,p.id_kategori,rl.id_rumah_layanan,p.id_satker,u.kategori,s.nama_satker,u.id_pegawai,u.is_kontrak,s.satker,s.key');
		$this->db->from('user AS u');
		$this->db->join('pegawai2 AS p','u.id_pegawai=p.id');
		$this->db->join('satker AS s','p.id_satker = s.id_satker');
		$this->db->join('jabatan AS j','p.id_jabatan = j.id_jabatan');
		$this->db->join('rumah_layanan AS rl','rl.id_pegawai=p.id','LEFT');
		$this->db->where('u.username',$username);
		$this->db->where('u.password',$password);
		return $query = $this->db->get();
	}

}
