<?php

class Admin extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		if($this->session->userdata('admin_valid') != "true")
		{
			$this->session->sess_destroy();
			redirect(base_url("login"));
		}
		$this->load->helper(array('url','form'));
		$this->load->model(array('m_pimpinan','m_bendahara','m_kontrak'));
		$this->load->library(array('format_terbilang','api_email', 'api_bios'));
	}

	function index()
	{
		$satker = $this->session->userdata('admin_id_satker');
		// if ($satker == 0)
		// {
		// 	echo "ADMIN SES";
		// }
		// else
		// {
		// 	echo "ADMIN SATKER";
		// }
		//$data['result'] = $this->db->query("SELECT *,DATE(uat.created_at) AS tanggal FROM user_audit_trails AS uat INNER JOIN user AS u ON uat.user_id = u.id_user INNER JOIN pegawai2 AS p ON u.id_pegawai = p.id WHERE p.id_satker=$satker GROUP BY DATE(uat.created_at)")->result();
		//$data['isi'] = 'adminsatker/setting_satker';
		$satker = $this->session->userdata('admin_id_satker');
		$data['result'] = $this->db->query("SELECT * FROM satker WHERE id_satker=$satker")->row();
		$data['isi'] = 'adminsatker/setting_satker';
		$this->load->view('new_design/index',$data);
	}

	function detail_history()
	{
		$id_satker = $this->session->userdata('admin_id_satker');
		$tanggal	= $this->uri->segment(3);
		$data['result'] = $this->db->query("SELECT *,DATE(uat.created_at) AS tanggal FROM user_audit_trails AS uat INNER JOIN user AS u ON uat.user_id = u.id_user INNER JOIN pegawai2 AS p ON u.id_pegawai = p.id WHERE DATE(uat.created_at) = '$tanggal' AND p.id_satker=$id_satker")->result();
		$data['isi'] = 'admin/admin_detail_history';
		$this->load->view('new/index',$data);
	}

	//-----------RUMAH LAYANAN--------------

		function rumah_layanan()
		{
			$id_satker = $this->session->userdata('admin_id_satker');
			$data['isi'] = 'admin/admin_rumah_layanan';
			$data['result'] = $this->m_kontrak->list_rumah_layanan()->result();
			$data['jumlah'] = $this->m_kontrak->list_rumah_layanan()->num_rows();
			$data['result_pegawai'] = $this->m_kontrak->list_pejabat_teknis()->result();
			$this->load->view('new/index',$data);
		}

		function input_rumah_layanan()
		{
			$id_satker = $this->session->userdata('admin_id_satker');
			$nama	= $this->input->post('nama');
			$kode	= $this->input->post('kode');
			$id_pegawai	= $this->input->post('id_pegawai');
			$cek = $this->db->query("SELECT * FROM rumah_layanan WHERE kode = '$kode'")->num_rows();
			if ($cek > 0)
			{
				echo '<script>alert("KODE PELAKSANA LAYANAN Sudah Ada");</script>';
				redirect('admin/rumah_layanan','refresh');
			}
			else
			{
				$data=array(
				 'id_satker'=> $id_satker,
				 'nama'=> $nama,
				 'kode'=> $kode,
				 'id_pegawai' => $id_pegawai
			 );
				$this->db->insert('rumah_layanan',$data);
				echo '<script>alert("Data Berhasil Disimpan");</script>';
				redirect('admin/rumah_layanan','refresh');
			}
		}

		function edit_rumah_layanan()
		{
			date_default_timezone_set('Asia/Jakarta');
			$id_rumah_layanan	= $this->input->post('id_rumah_layanan');
			$nama	= $this->input->post('nama');
			$kode	= $this->input->post('kode');
			$id_pegawai	= $this->input->post('id_pegawai');
			$cek = $this->db->query("SELECT * FROM rumah_layanan WHERE kode = '$kode'")->num_rows();
			if ($cek > 0)
			{
				echo '<script>alert("KODE PELAKSANA LAYANAN Sudah Ada");</script>';
				redirect('admin/rumah_layanan','refresh');
			}
			else
			{
				$data=array(
				 'nama'=> $nama,
				 'kode'=> $kode,
				 'id_pegawai' => $id_pegawai
			 );
				$this->db->where('id_rumah_layanan', $id_rumah_layanan);
				$this->db->update('rumah_layanan', $data);
				echo '<script>alert("Data Berhasil Disimpan");</script>';
				redirect('admin/rumah_layanan','refresh');
			}
		}

		function hapus_rumah_layanan()
		{
			$id_rumah_layanan	= $this->uri->segment(3);
			$this->db->query("DELETE FROM rumah_layanan WHERE id_rumah_layanan = $id_rumah_layanan");
			echo '<script>alert("Data Berhasil Dihapus");</script>';
			redirect('admin/rumah_layanan', 'refresh');
		}

	//-----------JENIS LAYANAN--------------

		function jenis_layanan()
		{
			$id_satker = $this->session->userdata('admin_id_satker');
			$data['isi'] = 'admin/admin_jenis_layanan';
			$data['result'] = $this->m_kontrak->list_jenis_layanan()->result();
			$data['rumah_layanan'] = $this->db->query("SELECT * FROM rumah_layanan WHERE id_satker = $id_satker")->result();
			$data['jumlah'] = $this->m_kontrak->list_jenis_layanan()->num_rows();
			$this->load->view('new/index',$data);
		}

		function detail_jenis_layanan()
		{
			$id_layanan	= $this->uri->segment(3);
			$data['result'] = $this->db->query("SELECT * FROM detail_layanan AS dl
																					INNER JOIN jenis_layanan AS jl ON dl.id_layanan = jl.id_jenis_layanan
																					INNER JOIN kategori_layanan AS kl ON dl.id_kategori = kl.id_kategori
																					WHERE dl.id_layanan = $id_layanan")->result();
			$data['datpil'] = $this->db->query("SELECT * FROM jenis_layanan AS dl
																					WHERE id_jenis_layanan = $id_layanan")->row();
		 	$data['kategori'] = $this->db->query("SELECT * FROM kategori_layanan")->result();
			$data['isi'] = 'admin/admin_detail_layanan';
			$this->load->view('new/index',$data);
		}

		function input_jenis_layanan()
		{
			$id_satker = $this->session->userdata('admin_id_satker');
			$id_rumah_layanan	= $this->input->post('id_rumah_layanan');
			$jenis	= $this->input->post('jenis');
			$kode	= $this->input->post('kode');
			$cek = $this->db->query("SELECT * FROM jenis_layanan WHERE kode = '$kode'")->num_rows();
			if ($cek > 0)
			{
				echo '<script>alert("KODE LAYANAN Sudah Ada");</script>';
				redirect('admin/jenis_layanan','refresh');
			}
			else
			{
				$data=array(
				 'id_satker'=> $id_satker,
				 'id_rumah_layanan'=> $id_rumah_layanan,
				 'jenis'=> $jenis,
				 'kode'=> $kode
			 );
				$this->db->insert('jenis_layanan',$data);
				echo '<script>alert("Data Berhasil Disimpan");</script>';
				redirect('admin/jenis_layanan','refresh');
			}
		}

		function edit_jenis_layanan()
		{
			date_default_timezone_set('Asia/Jakarta');
			$id_jenis_layanan	= $this->input->post('id_jenis_layanan');
			$id_rumah_layanan	= $this->input->post('id_rumah_layanan');
			$jenis	= $this->input->post('jenis');
			$kode	= $this->input->post('kode');
			$cek = $this->db->query("SELECT * FROM jenis_layanan WHERE kode = '$kode'")->num_rows();
			if ($cek > 0)
			{
				echo '<script>alert("KODE LAYANAN Sudah Ada");</script>';
				redirect('admin/jenis_layanan','refresh');
			}
			else
			{
				$data=array(
				 'id_rumah_layanan'=> $id_rumah_layanan,
				 'jenis'=> $jenis,
				 'kode'=> $kode
			 );
				$this->db->where('id_jenis_layanan', $id_jenis_layanan);
				$this->db->update('jenis_layanan', $data);
				echo '<script>alert("Data Berhasil Disimpan");</script>';
				redirect('admin/jenis_layanan','refresh');
			}
		}

		function hapus_jenis_layanan()
		{
			$id_jenis_layanan	= $this->uri->segment(3);
			$this->db->query("DELETE FROM jenis_layanan WHERE id_jenis_layanan = $id_jenis_layanan");
			echo '<script>alert("Data Berhasil Dihapus");</script>';
			redirect('admin/jenis_layanan', 'refresh');
		}

		function input_detail_layanan()
		{
			$id_satker = $this->session->userdata('admin_id_satker');
			$id_layanan	= $this->input->post('id_layanan');
			$nama_layanan	= $this->input->post('nama_layanan');
			$kode_layanan	= $this->input->post('kode_layanan');
			$id_kategori	= $this->input->post('id_kategori');
			$data=array(
			 'id_satker'=> $id_satker,
			 'id_layanan'=> $id_layanan,
			 'id_kategori'=> $id_kategori,
			 'nama_layanan'=> $nama_layanan,
			 'kode_layanan'=> $kode_layanan
		 );
			$this->db->insert('detail_layanan',$data);
			echo '<script>alert("Data Berhasil Disimpan");</script>';
			redirect('admin/detail_jenis_layanan/'.$id_layanan,'refresh');
		}

		function edit_detail_layanan()
		{
			date_default_timezone_set('Asia/Jakarta');
			$id_detail	= $this->input->post('id_detail');
			$id_layanan	= $this->input->post('id_layanan');
			$nama_layanan	= $this->input->post('nama_layanan');
			$kode_layanan	= $this->input->post('kode_layanan');
			$id_kategori	= $this->input->post('id_kategori');
			$data=array(
				'id_kategori'=> $id_kategori,
			 'nama_layanan'=> $nama_layanan,
			 'kode_layanan'=> $kode_layanan
		 );
			$this->db->where('id_detail', $id_detail);
			$this->db->update('detail_layanan', $data);
			echo '<script>alert("Data Berhasil Disimpan");</script>';
			redirect('admin/detail_jenis_layanan/'.$id_layanan,'refresh');
		}

		function hapus_detail_layanan()
		{
			$id_layanan	= $this->uri->segment(3);
			$id_detail_layanan	= $this->uri->segment(4);
			$this->db->query("DELETE FROM detail_layanan WHERE id_detail = $id_detail_layanan");
			echo '<script>alert("Data Berhasil Dihapus");</script>';
			redirect('admin/detail_jenis_layanan/'.$id_layanan,'refresh');
		}


	//-----------KODE PENERIMAAN--------------

		function kode_penerimaan()
		{
			$data['isi'] = 'admin/admin_kode_penerimaan';
			$data['result'] = $this->m_kontrak->list_kode_penerimaan()->result();
			$data['jumlah'] = $this->m_kontrak->list_kode_penerimaan()->num_rows();
			$this->load->view('new/index',$data);
		}

		function input_kode_penerimaan()
		{
			$nama_akun	= $this->input->post('nama_akun');
			$kode	= $this->input->post('kode');
			$data=array(
			 'nama_akun'=> $nama_akun,
			 'kode'=> $kode
		 	);
			$cek = $this->db->query("SELECT * FROM akun_penerimaan WHERE kode='$kode'")->num_rows();
			if ($cek > 0)
			{
				echo '<script>alert("Kode Akun Sudah Ada");</script>';
				redirect('admin/kode_penerimaan','refresh');
			}
			else
			{
				$this->db->insert('akun_penerimaan',$data);
				echo '<script>alert("Data Berhasil Disimpan");</script>';
				redirect('admin/kode_penerimaan','refresh');
			}
		}

		function edit_kode_penerimaan()
		{
			$id_akun	= $this->input->post('id_akun');
			$nama_akun	= $this->input->post('nama_akun');
			//$kode	= $this->input->post('kode');
			$data=array(
			 'nama_akun'=> $nama_akun
			 //'kode'=> $kode
		 );
		 //$cek = $this->db->query("SELECT * FROM akun_penerimaan WHERE kode='$kode'")->num_rows();
		 // if ($cek > 0)
		 // {
			//  echo '<script>alert("Kode Akun Sudah Ada");</script>';
			//  redirect('admin/kode_penerimaan','refresh');
		 // }
		 // else
		 // {
			 $this->db->where('id_akun', $id_akun);
	 		 $this->db->update('akun_penerimaan', $data);
	 		 echo '<script>alert("Data Berhasil Disimpan");</script>';
	 		 redirect('admin/kode_penerimaan','refresh');
		 //}
		}

		function hapus_kode_penerimaan()
		{
			$id_akun	= $this->uri->segment(3);
			$this->db->query("DELETE FROM akun_penerimaan WHERE id_akun = $id_akun");
			echo '<script>alert("Data Berhasil Dihapus");</script>';
			redirect('admin/kode_penerimaan', 'refresh');
		}


	//-----------TARGET PENERIMAAN--------------

		function target()
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
			$data['isi'] = 'admin/admin_target';
			$data['pilih_tahun'] = $pilih_tahun;
			$data['rumah_layanan'] = $this->m_kontrak->list_rumah_layanan()->result();
			$data['result'] = $this->m_kontrak->list_target_tahun($pilih_tahun)->result();
			$data['jumlah'] = $this->m_kontrak->list_target_tahun($pilih_tahun)->num_rows();
			$this->load->view('new/index',$data);
		}

		function input_target()
		{
			$id_rumah_layanan	= $this->input->post('id_rumah_layanan');
			$jumlah	= $this->input->post('jumlah');
			$tahun = DATE("Y");
			$data=array(
			 'id_rumah_layanan'=> $id_rumah_layanan,
			 'jumlah'=> $jumlah,
			 'tahun' => $tahun
		 	);
			$cek = $this->db->query("SELECT * FROM target WHERE id_rumah_layanan='$id_rumah_layanan' AND tahun = $tahun")->num_rows();
			if ($cek > 0)
			{
				echo '<script>alert("Target Pelaksana Layanan Sudah Ada");</script>';
				redirect('admin/target','refresh');
			}
			else
			{
				$this->db->insert('target',$data);
				echo '<script>alert("Data Berhasil Disimpan");</script>';
				redirect('admin/target','refresh');
			}
		}

		function edit_target()
		{
			$id_target	= $this->input->post('id_target');
			$jumlah	= $this->input->post('jumlah');
			$data=array(
			 'jumlah'=> $jumlah
		 );
			 $this->db->where('id_target', $id_target);
	 		 $this->db->update('target', $data);
	 		 echo '<script>alert("Data Berhasil Disimpan");</script>';
	 		 redirect('admin/target','refresh');
		}

		function hapus_target()
		{
			$id_target	= $this->uri->segment(3);
			$this->db->query("DELETE FROM target WHERE id_target = $id_target");
			echo '<script>alert("Data Berhasil Dihapus");</script>';
			redirect('admin/target', 'refresh');
		}


	//-----------KODE AKUN--------------

		function kode_akun()
		{
			$data['isi'] = 'admin/admin_kode_akun';
			$data['result'] = $this->m_kontrak->list_kode_akun()->result();
			$data['jumlah'] = $this->m_kontrak->list_kode_akun()->num_rows();
			$this->load->view('new/index',$data);
		}

		function input_kode_akun()
		{
			$nama_akun	= $this->input->post('nama_akun');
			$kode	= $this->input->post('kode');
			$data=array(
			 'nama_akun'=> $nama_akun,
			 'kode'=> $kode
		 	);
			$cek = $this->db->query("SELECT * FROM akun WHERE kode='$kode'")->num_rows();
			if ($cek > 0)
			{
				echo '<script>alert("Kode Akun Sudah Ada");</script>';
				redirect('admin/kode_akun','refresh');
			}
			else
			{
				$this->db->insert('akun',$data);
				echo '<script>alert("Data Berhasil Disimpan");</script>';
				redirect('admin/kode_akun','refresh');
			}
		}

		function edit_kode_akun()
		{
			$id_akun	= $this->input->post('id_akun');
			$nama_akun	= $this->input->post('nama_akun');
			//$kode	= $this->input->post('kode');
			$data=array(
			 'nama_akun'=> $nama_akun
			 //'kode'=> $kode
		 );
		 //$cek = $this->db->query("SELECT * FROM akun WHERE kode='$kode'")->num_rows();
		 // if ($cek > 0)
		 // {
			//  echo '<script>alert("Kode Akun Sudah Ada");</script>';
			//  redirect('admin/kode_akun','refresh');
		 // }
		 // else
		 // {
			 $this->db->where('id_akun', $id_akun);
	 		 $this->db->update('akun', $data);
	 		 echo '<script>alert("Data Berhasil Disimpan");</script>';
	 		 redirect('admin/kode_akun','refresh');
		 //}
		}

		function hapus_kode_akun()
		{
			$id_akun	= $this->uri->segment(3);
			$this->db->query("DELETE FROM akun WHERE id_akun = $id_akun");
			echo '<script>alert("Data Berhasil Dihapus");</script>';
			redirect('admin/kode_akun', 'refresh');
		}


	//-----------PEGAWAI--------------

		function pegawai()
		{
			$data['isi'] = 'admin/admin_pegawai';
			$data['result'] = $this->m_kontrak->list_pegawai()->result();
			$data['jumlah'] = $this->m_kontrak->list_pegawai()->num_rows();
			$data['jabatan'] = $this->m_kontrak->list_jabatan()->result();
			$data['kategori'] = $this->m_kontrak->list_kategori()->result();
			$this->load->view('new/index',$data);
		}

		function input_pegawai()
		{
			date_default_timezone_set('Asia/Jakarta');
			$id_satker = $this->session->userdata('admin_id_satker');
			$nip	= $this->input->post('nip');
			$nama	= $this->input->post('nama');
			$id_jabatan	= $this->input->post('id_jabatan');
			$id_kategori	= $this->input->post('id_kategori');
			$status_kepeg	= $this->input->post('status_kepeg');
			$data=array(
			 'id_satker'=> $id_satker,
			 'nip'=> $nip,
			 'nama'=> $nama,
			 'id_jabatan'=> $id_jabatan,
			 'id_kategori'=> $id_kategori,
			 'status_kepeg'=> $status_kepeg
		 	);
			$cek = $this->db->query("SELECT * FROM pegawai2 WHERE nip='$nip'")->num_rows();
			if ($cek > 0)
			{
				echo '<script>alert("NIP Sudah Ada");</script>';
				redirect('admin/pegawai','refresh');
			}
			else
			{
				$this->db->insert('pegawai2',$data);
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

				$pns = $this->db->query("SELECT COUNT(*) AS jumlah_pns FROM pegawai2 WHERE id_satker = $id_satker AND status_kepeg='pns';")->row_array();
				$non_pns = $this->db->query("SELECT COUNT(*) AS jumlah_non_pns FROM pegawai2 WHERE id_satker = $id_satker AND status_kepeg='non_pns';")->row_array();
				$pppk = $this->db->query("SELECT COUNT(*) AS jumlah_pppk FROM pegawai2 WHERE id_satker = $id_satker AND status_kepeg='pppk';")->row_array();
				$tenaga_professional = $this->db->query("SELECT COUNT(*) AS jumlah_tenaga_professional FROM pegawai2 WHERE id_satker = $id_satker AND status_kepeg='tenaga_professional';")->row_array();
				$url = 'https://bios.kemenkeu.go.id/api/ws/barang_jasa/sdm/sdm_barang_jasa';

				$sdm = array(
					'tgl_transaksi' => date('Y-m-d', $yesterday),
					'pns' => $pns['jumlah_pns'],
					'non_pns' => $non_pns['jumlah_non_pns'],
					'pppk' => $pppk['jumlah_pppk'],
					'tenaga_professional' => $tenaga_professional['jumlah_tenaga_professional']
				);
				$responseLayanan = $this->api_bios->get_content($url, json_encode($sdm), $response_token['token']);
				$response_bios = json_decode($responseLayanan, true);
				if($id_satker == 1){
					$last_status = $response_bios['message'];
					$data = array(
						'last_status' => $last_status,
						'last_updated' => DATE("Y-m-d H:i:s")
					);
					$this->db->where('id_webservice', 12);
					$this->db->update('webservicebios', $data);
				}
				//var_dump($data);
				echo '<script>alert("Data Berhasil Disimpan");</script>';
				redirect('admin/pegawai','refresh');
			}
		}

		function edit_pegawai()
		{
			date_default_timezone_set('Asia/Jakarta');
			$id_satker = $this->session->userdata('admin_id_satker');
			$nip	= $this->input->post('nip');
			$nama	= $this->input->post('nama');
			$id_jabatan	= $this->input->post('id_jabatan');
			$id_kategori	= $this->input->post('id_kategori');
			$status_kepeg	= $this->input->post('status_kepeg');
			$id	= $this->input->post('id');
			$data=array(
			 'id_satker'=> $id_satker,
			 'nip'=> $nip,
			 'nama'=> $nama,
			 'id_jabatan'=> $id_jabatan,
			 'id_kategori'=> $id_kategori,
			 'status_kepeg'=> $status_kepeg
		 	);
			 $this->db->where('id', $id);
	 		 $this->db->update('pegawai2', $data);
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

				$pns = $this->db->query("SELECT COUNT(*) AS jumlah_pns FROM pegawai2 WHERE id_satker = $id_satker AND status_kepeg='pns';")->row_array();
				$non_pns = $this->db->query("SELECT COUNT(*) AS jumlah_non_pns FROM pegawai2 WHERE id_satker = $id_satker AND status_kepeg='non_pns';")->row_array();
				$pppk = $this->db->query("SELECT COUNT(*) AS jumlah_pppk FROM pegawai2 WHERE id_satker = $id_satker AND status_kepeg='pppk';")->row_array();
				$tenaga_professional = $this->db->query("SELECT COUNT(*) AS jumlah_tenaga_professional FROM pegawai2 WHERE id_satker = $satker AND status_kepeg='tenaga_professional';")->row_array();
				$url = 'https://bios.kemenkeu.go.id/api/ws/barang_jasa/sdm/sdm_barang_jasa';

				$sdm = array(
					'tgl_transaksi' => date('Y-m-d', $yesterday),
					'pns' => $pns['jumlah_pns'],
					'non_pns' => $non_pns['jumlah_non_pns'],
					'pppk' => $pppk['jumlah_pppk'],
					'tenaga_professional' => $tenaga_professional['jumlah_tenaga_professional']
				);

				$responseLayanan = $this->api_bios->get_content($url, json_encode($sdm), $response_token['token']);
				$response_bios = json_decode($responseLayanan, true);
				if($id_satker == 1){
					$last_status = $response_bios['message'];
					$data = array(
						'last_status' => $last_status,
						'last_updated' => DATE("Y-m-d H:i:s")
					);
					$this->db->where('id_webservice', 12);
					$this->db->update('webservicebios', $data);
				}
	 		 echo '<script>alert("Data Berhasil Disimpan");</script>';
	 		 redirect('admin/pegawai','refresh');
		}

		function hapus_pegawai()
		{
			date_default_timezone_set('Asia/Jakarta');
			$id_satker = $this->session->userdata('admin_id_satker');
			$id	= $this->uri->segment(3);
			$this->db->query("DELETE FROM pegawai2 WHERE id = $id");
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

				$pns = $this->db->query("SELECT COUNT(*) AS jumlah_pns FROM pegawai2 WHERE id_satker = $id_satker AND status_kepeg='pns';")->row_array();
				$non_pns = $this->db->query("SELECT COUNT(*) AS jumlah_non_pns FROM pegawai2 WHERE id_satker = $id_satker AND status_kepeg='non_pns';")->row_array();
				$pppk = $this->db->query("SELECT COUNT(*) AS jumlah_pppk FROM pegawai2 WHERE id_satker = $id_satker AND status_kepeg='pppk';")->row_array();
				$tenaga_professional = $this->db->query("SELECT COUNT(*) AS jumlah_tenaga_professional FROM pegawai2 WHERE id_satker = $satker AND status_kepeg='tenaga_professional';")->row_array();
				$url = 'https://bios.kemenkeu.go.id/api/ws/barang_jasa/sdm/sdm_barang_jasa';

				$sdm = array(
					'tgl_transaksi' => date('Y-m-d', $yesterday),
					'pns' => $pns['jumlah_pns'],
					'non_pns' => $non_pns['jumlah_non_pns'],
					'pppk' => $pppk['jumlah_pppk'],
					'tenaga_professional' => $tenaga_professional['jumlah_tenaga_professional']
				);

				$responseLayanan = $this->api_bios->get_content($url, json_encode($sdm), $response_token['token']);
				$response_bios = json_decode($responseLayanan, true);
				if($id_satker == 1){
					$last_status = $response_bios['message'];
					$data = array(
						'last_status' => $last_status,
						'last_updated' => DATE("Y-m-d H:i:s")
					);
					$this->db->where('id_webservice', 12);
					$this->db->update('webservicebios', $data);
				}
			echo '<script>alert("Data Berhasil Dihapus");</script>';
			redirect('admin/pegawai', 'refresh');
		}

	//-----------JABATAN--------------

			function jabatan()
			{
				$data['isi'] = 'admin/admin_jabatan';
				$data['result'] = $this->m_kontrak->list_jabatan()->result();
				$data['jumlah'] = $this->m_kontrak->list_jabatan()->num_rows();
				$this->load->view('new/index',$data);
			}

			function input_jabatan()
			{
				$jabatan	= $this->input->post('jabatan');
				$data=array(
				 'jabatan'=> $jabatan
			 );
				$this->db->insert('jabatan',$data);
				echo '<script>alert("Data Berhasil Disimpan");</script>';
				redirect('admin/jabatan','refresh');
			}

			function edit_jabatan()
			{
				date_default_timezone_set('Asia/Jakarta');
				$id_jabatan	= $this->input->post('id_jabatan');
				$jabatan	= $this->input->post('jabatan');
				$data=array(
				 'jabatan'=> $jabatan
			 );
				$this->db->where('id_jabatan', $id_jabatan);
				$this->db->update('jabatan', $data);
				echo '<script>alert("Data Berhasil Disimpan");</script>';
				redirect('admin/jabatan','refresh');
			}

			function hapus_jabatan()
			{
				$id_jabatan	= $this->uri->segment(3);
				$cek = $this->db->query("SELECT * FROM pegawai2 WHERE id_jabatan='$id_jabatan'")->num_rows();
				if ($cek > 0)
				{
					echo '<script>alert("Jabatan Tidak Bisa Dihapus");</script>';
					redirect('admin/jabatan','refresh');
				}
				else
				{
					$this->db->query("DELETE FROM jabatan WHERE id_jabatan = $id_jabatan");
					echo '<script>alert("Data Berhasil Dihapus");</script>';
					redirect('admin/jabatan', 'refresh');
				}

			}

	//-----------USER--------------

			function user()
			{
				$data['isi'] = 'admin/admin_user';
				$data['result'] = $this->m_kontrak->list_user()->result();
				$data['jumlah'] = $this->m_kontrak->list_user()->num_rows();
				$data['pegawai'] = $this->m_kontrak->list_pegawai()->result();
				$data['kategori_user'] = $this->m_kontrak->list_kategori_user()->result();
				$this->load->view('new/index',$data);
			}

			function input_user()
			{
				$username	= $this->input->post('username');
				$password	= $this->input->post('password');
				$new_password	= md5($password);
				$id_pegawai	= $this->input->post('id_pegawai');
				$kategori	= $this->input->post('kategori');
				$is_kontrak	= $this->input->post('is_kontrak');
				$data=array(
				 'username'=> $username,
				 'password'=> $new_password,
				 'id_pegawai'=> $id_pegawai,
				 'is_kontrak'=> $is_kontrak,
				 'kategori'=> $kategori
			 	);
				$cek_username = $this->db->query("SELECT * FROM user WHERE username='$username'")->num_rows();
				$cek_pegawai = $this->db->query("SELECT * FROM user WHERE id_pegawai='$id_pegawai'")->num_rows();
				if ($cek_username > 0)
				{
					echo '<script>alert("Username Sudah Terdaftar");</script>';
					redirect('admin/user','refresh');
				}
				elseif ($cek_pegawai > 0)
				{
					echo '<script>alert("Pegawai Sudah Terdaftar");</script>';
					redirect('admin/user','refresh');
				}
				else
				{
					$email = $username;
					$subject = "REGISTRASI AKUN MONIKA";
					$content = "Selamat. Email Anda telah berhasil diregistrasikan pada aplikasi Monika dengan Password : <b>".$password."</b>. Silahkan login menggunakan username dan password yang telah dibuat.";
					$response = $this->api_email->send_email($email,$subject,$content);
					$this->db->insert('user',$data);
					echo '<script>alert("Data Berhasil Disimpan");</script>';
					redirect('admin/user','refresh');
				}

			}

			function edit_user()
			{
				$id_user	= $this->input->post('id_user');
				//$username	= $this->input->post('username');
				$id_pegawai	= $this->input->post('id_pegawai');
				$kategori	= $this->input->post('kategori');
				$is_kontrak	= $this->input->post('is_kontrak');
				$data=array(
				 //'username'=> $username,
				 'id_pegawai'=> $id_pegawai,
				 'is_kontrak'=> $is_kontrak,
				 'kategori'=> $kategori
			 	);
				//$cek = $this->db->query("SELECT * FROM user WHERE username='$username' AND id_pegawai='$id_pegawai'")->num_rows();
				$cek = $this->db->query("SELECT id_pegawai FROM user WHERE id_user='$id_user'")->row();
				$cek_pegawai = $this->db->query("SELECT * FROM user WHERE id_pegawai='$id_pegawai'")->num_rows();
				if ($cek->id_pegawai == $id_pegawai)
				{
					$this->db->where('id_user', $id_user);
					$this->db->update('user', $data);
					echo '<script>alert("Data Berhasil Disimpan");</script>';
					redirect('admin/user','refresh');
				}
				else
				{
					if ($cek_pegawai > 0)
					{
						echo '<script>alert("Pegawai Sudah Terdaftar");</script>';
						redirect('admin/user','refresh');
					}
					else
					{
						$this->db->where('id_user', $id_user);
						$this->db->update('user', $data);
						echo '<script>alert("Data Berhasil Disimpan");</script>';
						redirect('admin/user','refresh');
					}
				}
			}

			function reset_password()
			{
				$id_user	= $this->uri->segment(3);
				$password	= rand(10,1000000);
				$new_password	= md5($password);
				$data=array(
				 'password'=> $new_password
			 	);
				$this->db->where('id_user', $id_user);
				$this->db->update('user', $data);
				$cek = $this->db->query("SELECT * FROM user WHERE id_user = $id_user")->row();
				$email = $cek->username;
				$subject = "RESET PASSWORD MONIKA";
				$content = "Password telah direset dengan Password Baru : <b>".$password."</b>. Silahkan login menggunakan password yang baru";
				$response = $this->api_email->send_email($email,$subject,$content);
				echo '<script>alert("Password Baru : '.$password.'");</script>';
				redirect('admin/user','refresh');
			}

			function hapus_user()
			{
				$id_user	= $this->uri->segment(3);
				$this->db->query("DELETE FROM user WHERE id_user = $id_user");
				echo '<script>alert("Data Berhasil Dihapus");</script>';
				redirect('admin/user', 'refresh');
			}

			function setting_satker()
			{
				$satker = $this->session->userdata('admin_id_satker');
				$data['result'] = $this->db->query("SELECT * FROM satker WHERE id_satker=$satker")->row();
				$data['isi'] = 'adminsatker/setting_satker';
				$this->load->view('new_design/index',$data);
			}

			function simpan_setting_satker()
			{
				$id_satker	= $this->input->post('id_satker');
				$nama_satker	= $this->input->post('nama_satker');
				$satker	= $this->input->post('satker');
				$key	= $this->input->post('key');
				$pic	= $this->input->post('pic');
				$nama_ttd	= $this->input->post('nama_ttd');
				$nip_ttd	= $this->input->post('nip_ttd');
				$data=array(
				 'nama_satker'=> $nama_satker,
				 'satker'=> $satker,
				 'pic'=> $pic,
				 'nama_ttd'=> $nama_ttd,
				 'nip_ttd'=> $nip_ttd,
				 'key'=> $key
			 	);
				$this->db->where('id_satker', $id_satker);
				$this->db->update('satker', $data);
				echo '<script>alert("Data Berhasil Disimpan");</script>';
				redirect('admin/setting_satker','refresh');

			}

			function bios()
			{
				$id_satker = $this->session->userdata('admin_id_satker');
				$data['isi'] = 'admin/admin_bios';
				$data['result'] = $this->db->query("SELECT * FROM webservicebios WHERE webservicebios.id_satker=$id_satker")->result();
				$data['satker'] = $id_satker;
				$this->load->view('new_design/index',$data);
			}

			function api_tekmira_harian()
			{
				date_default_timezone_set('Asia/Jakarta');
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
				$url = 'https://training-bios2.kemenkeu.go.id/api/get/data/status';
				foreach ($penerimaan as $terima) {
					$dataPenerimaan = array(
						'tgl_transaksi' => $terima['tgl_transaksi'],
						'kd_akun' => $terima['kd_akun'],
						'jumlah' => $terima['jumlah'],
					);
					$responseLayanan = $this->api_bios->get_content($url, json_encode($dataPenerimaan), $response_token['token']);
					$response_bios = json_decode($responseLayanan, true);
					
					$last_status = $response_bios['message'];
					$data = array(
						'last_status' => $last_status,
						'last_updated' => DATE("Y-m-d H:i:s")
					);
					$this->db->where('id_webservice', 1);
					$this->db->update('webservicebios', $data);
				}


				$pengeluaran = $this->db->query("SELECT sum(jmlh) AS jumlah, kd_akun, max(tanggal) as tgl_transaksi FROM( SELECT sum(p.jumlah_realisasi) as jmlh ,a.kode AS kd_akun, max(p.tgl_realisasi) as tanggal FROM pengajuan AS p INNER JOIN rencana_operasional AS ro ON p.id_ro = ro.id_ro INNER JOIN akun AS a ON ro.akun = a.id_akun INNER JOIN kontrak AS k ON ro.id_kontrak = k.id_kontrak WHERE k.id_satker = $id_satker AND p.status_realisasi = 1 AND YEAR(tgl_pengajuan)= $tahun group by kd_akun UNION ALL SELECT sum(p.jumlah_realisasi) as jmlh, a.kode AS kd_akun, max(p.tgl_realisasi) as tanggal FROM pengajuan_rkakl AS p INNER JOIN detail_rkakl AS dr ON p.id_detail_rkakl = dr.id INNER JOIN akun AS a ON dr.akun = a.id_akun INNER JOIN rkakl AS r ON dr.id_rkakl = r.id_rkakl INNER JOIN rumah_layanan AS rl ON r.id_layanan = rl.id_rumah_layanan WHERE rl.id_satker = $id_satker AND p.status_realisasi = 1 AND p.status_pengajuan = 1 AND YEAR(p.tgl_realisasi) = $tahun group by kd_akun)t GROUP by kd_akun;")->result_array();
				$url = 'https://bios.kemenkeu.go.id/api/ws/keuangan/akuntansi/pengeluaran';
				foreach ($pengeluaran as $keluar) {
					$dataPengeluaran = array(
						'tgl_transaksi' => $keluar['tgl_transaksi'],
						'kd_akun' => $keluar['kd_akun'],
						'jumlah' => $keluar['jumlah'],
					);
					$responseLayanan = $this->api_bios->get_content($url, json_encode($dataPengeluaran), $response_token['token']);
					$response_bios = json_decode($responseLayanan, true);
					
					$id_satker = $this->session->userdata('admin_id_satker');
					$last_status = $response_bios['message'];
					$data = array(
						'last_status' => $last_status,
						'last_updated' => DATE("Y-m-d H:i:s")
					);
					$this->db->where('id_webservice', 2);
					$this->db->update('webservicebios', $data);					
				}


				$operasional = $this->db->query("SELECT no_rekening, saldo_akhir, kdbank FROM operasional WHERE id_satker = $id_satker;")->result_array();
				$url = 'https://bios.kemenkeu.go.id/api/ws/keuangan/saldo/saldo_operasional';
				foreach ($operasional as $ops) {
					$dataOperasional = array(
						'tgl_transaksi' => date('Y-m-d', $yesterday),
						'no_rekening' => $ops['no_rekening'],
						'saldo_akhir' => $ops['saldo_akhir'],
						'kdbank' => $ops['kdbank']
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


				$deposito = $this->db->query("SELECT no_bilyet, nilai_deposito, nilai_bunga FROM deposito WHERE id_satker = 1;")->result_array();
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

				redirect('admin/bios','refresh');
			}

			function api_tekmira_bulanan()
			{
				date_default_timezone_set('Asia/Jakarta');
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

				$umum = $this->db->query("SELECT max(t.tgl_pembayaran) AS tgl_transaksi, sum(t.jumlah_realisasi) AS jumlah FROM termin AS t INNER JOIN kontrak AS k ON t.id_kontrak = k.id_kontrak WHERE k.id_rumah_layanan = 1 AND YEAR(t.tgl_pembayaran) = $tahun AND t.status_pembayaran=1;")->row_array();
				$url = 'https://bios.kemenkeu.go.id/api/ws/barang_jasa/layanan/jasa_pemanfaatan_aset';
				$responseLayanan = $this->api_bios->get_content($url, json_encode($umum), $response_token['token']);
				$response_bios = json_decode($responseLayanan, true);
				$last_status = $response_bios['message'];
				$data = array(
					'last_status' => $last_status,
					'last_updated' => DATE("Y-m-d H:i:s")
				);
				$this->db->where('id_webservice', 5);
				$this->db->update('webservicebios', $data);


				$mineral = $this->db->query("SELECT max(t.tgl_pembayaran) AS tgl_transaksi, sum(t.jumlah_realisasi) AS jumlah FROM termin AS t INNER JOIN kontrak AS k ON t.id_kontrak = k.id_kontrak WHERE k.id_rumah_layanan = 4 AND YEAR(t.tgl_pembayaran) = $tahun AND t.status_pembayaran=1;")->row_array();
				$url = 'https://bios.kemenkeu.go.id/api/ws/barang_jasa/layanan/jasa_pengujian_mineral';
				$responseLayanan = $this->api_bios->get_content($url, json_encode($mineral), $response_token['token']);
				$response_bios = json_decode($responseLayanan, true);
				$last_status = $response_bios['message'];
				$data = array(
					'last_status' => $last_status,
					'last_updated' => DATE("Y-m-d H:i:s")
				);
				$this->db->where('id_webservice', 6);
				$this->db->update('webservicebios', $data);


				$batubara = $this->db->query("SELECT max(t.tgl_pembayaran) AS tgl_transaksi, sum(t.jumlah_realisasi) AS jumlah FROM termin AS t INNER JOIN kontrak AS k ON t.id_kontrak = k.id_kontrak WHERE k.id_rumah_layanan = 5 AND YEAR(t.tgl_pembayaran) = $tahun AND t.status_pembayaran=1;")->row_array();
				$url = 'https://bios.kemenkeu.go.id/api/ws/barang_jasa/layanan/jasa_pengujian_batubara';
				$responseLayanan = $this->api_bios->get_content($url, json_encode($batubara), $response_token['token']);
				$response_bios = json_decode($responseLayanan, true);
				$last_status = $response_bios['message'];
				$data = array(
					'last_status' => $last_status,
					'last_updated' => DATE("Y-m-d H:i:s")
				);
				$this->db->where('id_webservice', 7);
				$this->db->update('webservicebios', $data);


				$lab = $this->db->query("SELECT max(t.tgl_pembayaran) AS tgl_transaksi, sum(t.jumlah_realisasi) AS jumlah FROM termin AS t INNER JOIN kontrak AS k ON t.id_kontrak = k.id_kontrak WHERE k.id_rumah_layanan = 2 AND YEAR(t.tgl_pembayaran) = $tahun AND t.status_pembayaran=1;")->row_array();
				$url = 'https://bios.kemenkeu.go.id/api/ws/barang_jasa/layanan/jasa_pengujian_laboratorium';
				$responseLayanan = $this->api_bios->get_content($url, json_encode($lab), $response_token['token']);
				$response_bios = json_decode($responseLayanan, true);
				$last_status = $response_bios['message'];
				$data = array(
					'last_status' => $last_status,
					'last_updated' => DATE("Y-m-d H:i:s")
				);
				$this->db->where('id_webservice', 8);
				$this->db->update('webservicebios', $data);


				$tambang = $this->db->query("SELECT max(t.tgl_pembayaran) AS tgl_transaksi, sum(t.jumlah_realisasi) AS jumlah FROM termin AS t INNER JOIN kontrak AS k ON t.id_kontrak = k.id_kontrak WHERE k.id_rumah_layanan = 3 AND YEAR(t.tgl_pembayaran) = $tahun AND t.status_pembayaran=1;")->row_array();
				$url = 'https://bios.kemenkeu.go.id/api/ws/barang_jasa/layanan/jasa_pengujian_penambangan_mineral_batubara';
				$responseLayanan = $this->api_bios->get_content($url, json_encode($tambang), $response_token['token']);
				$response_bios = json_decode($responseLayanan, true);
				$last_status = $response_bios['message'];
				$data = array(
					'last_status' => $last_status,
					'last_updated' => DATE("Y-m-d H:i:s")
				);
				$this->db->where('id_webservice', 9);
				$this->db->update('webservicebios', $data);
				redirect('admin/bios','refresh');
			}

			function test()
			{
				$data['isi'] = 'adminsatker/test';
				$this->load->view('new_design/index',$data);
				//$this->load->view('adminsatker/test');
			}

}
?>
