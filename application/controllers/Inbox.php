<?php

class Inbox extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		if($this->session->userdata('admin_kategori') == 0)
		{
			echo '<script>alert("Anda tidak dapat mengakses");</script>';
			$this->session->sess_destroy();
			redirect(base_url('login','refresh'));
		}
		$this->load->helper(array('url','form'));
		$this->load->model(array('m_pimpinan','m_bendahara','m_kontrak'));
		$this->load->library(array('format_terbilang','format_tanggal'));
	}

	function index()
	{
		$kategori = $this->session->userdata('admin_kategori');
		//$data['result_progress'] = $this->m_kontrak->list_kontrak()->result();
		if ($kategori == 2)
		{
				$data['result_kendala'] = $this->m_kontrak->list_kendala_all()->result();
				$data['jumlah'] = $this->m_kontrak->list_kendala_all()->num_rows();
				$data['isi'] = 'admin/inbox_kendala';
		}
		else
		{
				$data['result_kendala'] = $this->m_kontrak->list_kendala()->result();
				$data['jumlah'] = $this->m_kontrak->list_kendala()->num_rows();
				$data['isi'] = 'admin/inbox_kendala_kp3';
		}
		//$data['jumlah'] = $this->m_kontrak->list_kontrak()->num_rows();
		$this->load->view('new/index',$data);
	}

	function inbox_progress()
	{
		$data['isi'] = 'inbox/progress';
		//$data['isi'] = 'admin/inbox_progress';
		$data['result_progress'] = $this->m_kontrak->list_progress()->result();
		$data['jumlah'] = $this->m_kontrak->list_progress()->num_rows();
		$this->load->view('new_design/index',$data);
		//$this->load->view('new/index',$data);
	}

	function detail_inbox()
	{
		$id	= $this->uri->segment(3);
		$data['isi'] = 'admin/inbox_detail';
		$data['result'] = $this->m_kontrak->list_detail_kendala($id)->result();
		//$data['kendala'] = $this->db->query("SELECT * FROM kendala WHERE id_kendala = $id")->row();
		$data['kendala'] = $this->m_kontrak->list_kendala_inbox($id)->row();
		$data['penerima'] = $this->m_kontrak->list_user()->result();
		$data['jumlah'] = $this->m_kontrak->list_detail_kendala($id)->num_rows();
		$this->load->view('new/index',$data);
	}

	function detail_inbox_kp3()
	{
		$id	= $this->uri->segment(3);
		$data['isi'] = 'admin/inbox_detail_kp3';
		$data['result'] = $this->m_kontrak->list_detail_kendala($id)->result();
		//$data['kendala'] = $this->db->query("SELECT * FROM kendala WHERE id_kendala = $id")->row();
		$data['kendala'] = $this->m_kontrak->list_kendala_inbox($id)->row();
		$data['penerima'] = $this->m_kontrak->list_user()->result();
		$data['detail'] = $this->m_kontrak->list_detail_kendala($id)->row();
		$this->load->view('new/index',$data);
	}

	function tambah_tanggapan()
	{
			$pengirim = $this->session->userdata('admin_id');
			$id_kendala	= $this->input->post('id_kendala');
			$id_kegiatan	= $this->input->post('id_kegiatan');
			$id_detail_kendala	= $this->input->post('id_detail_kendala');
			$penerima	= $this->input->post('penerima');
			$status	= $this->input->post('status');
			$solusi	= $this->input->post('solusi');
			$tanggal	= DATE("Y-m-d");
			$data=array(
			 'id_kendala'=> $id_kendala,
			 'pengirim'=> $pengirim,
			 'penerima'=> $penerima,
			 'status'=> $status,
			 'tanggal'=> $tanggal,
			 'solusi' => $solusi
		 );
		$this->db->insert('detail_kendala',$data);
		$this->db->query("UPDATE kendala SET status = $status WHERE id_kendala = $id_kendala");
		if ($status == 2)
		{
			$this->db->query("UPDATE kegiatan SET status = 3 WHERE id_kegiatan = $id_kegiatan");
		}
		echo '<script>alert("Data Berhasil Disimpan");</script>';
		redirect('inbox/detail_inbox/'.$id_kendala,'refresh');
	}

	function tambah_solusi()
	{
			$id_kendala	= $this->input->post('id_kendala');
			$id_detail_kendala	= $this->input->post('id_detail_kendala');
			$solusi	= $this->input->post('solusi');
			$tanggal_solusi	= DATE("Y-m-d");
			$data_detail=array(
			 'solusi'=> $solusi,
			 'tanggal_solusi'=> $tanggal_solusi,
			 'status' => 2
		 	);
			$this->db->where('id_detail_kendala', $id_detail_kendala);
			$this->db->update('detail_kendala', $data_detail);
			$data=array(
			 'status' => 2
		 	);
			$this->db->where('id_kendala', $id_kendala);
			$this->db->update('kendala', $data);
			echo '<script>alert("Data Berhasil Disimpan");</script>';
			redirect('inbox/detail_inbox_kp3/'.$id_kendala,'refresh');
	}

	function update_tanggapan()
	{
			$id_kendala	= $this->input->post('id_kendala');
			$id_detail_kendala	= $this->input->post('id_detail_kendala');
			$detail_keterangan	= $this->input->post('detail_keterangan');
			$status	= $this->input->post('status');
			$tanggal	= DATE("Y-m-d");
			if ($status == 1)
			{
				$data_detail=array(
				 'detail_keterangan'=> $detail_keterangan,
				 'solusi'=> NULL,
				 'tanggal'=> $tanggal,
				 'status' => $status
			 	);
			}
			else
			{
				$data_detail=array(
				 'status' => $status
			 	);
			}
			$this->db->where('id_detail_kendala', $id_detail_kendala);
			$this->db->update('detail_kendala', $data_detail);
			$data=array(
			 'status' => $status
		 	);
			$this->db->where('id_kendala', $id_kendala);
			$this->db->update('kendala', $data);
			echo '<script>alert("Data Berhasil Disimpan");</script>';
			redirect('inbox/detail_inbox/'.$id_kendala,'refresh');
	}

	function edit_rumah_layanan()
	{
		date_default_timezone_set('Asia/Jakarta');
		$id_rumah_layanan	= $this->input->post('id_rumah_layanan');
		$nama	= $this->input->post('nama');
		$kode	= $this->input->post('kode');
		$id_pegawai	= $this->input->post('id_pegawai');
		$data=array(
		 'nama'=> $nama,
		 'kode'=> $kode,
		 'id_pegawai' => $id_pegawai
	 );
		$this->db->where('id_rumah_layanan', $id_rumah_layanan);
		$this->db->update('rumah_layanan', $data);
		echo '<script>alert("Data Berhasil Disimpan");</script>';
		redirect('program/rumah_layanan','refresh');
	}

	function hapus_rumah_layanan()
	{
		$id_rumah_layanan	= $this->uri->segment(3);
		$this->db->query("DELETE FROM rumah_layanan WHERE id_rumah_layanan = $id_rumah_layanan");
		echo '<script>alert("Data Berhasil Dihapus");</script>';
		redirect('program/rumah_layanan', 'refresh');
	}

}
?>
