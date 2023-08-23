<?php

class Login extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url','captcha'));
		$this->load->library('format_tanggal');
		$this->load->model(array('m_login'));
	}

	function index()
	{
		$this->load->view('new_login');
	}

	// function index()
	// {
	// 	$random_number = substr(number_format(time() * rand(),0,'',''),0,6);
 	// 	$config_captcha = array(
	// 	'word' => $random_number,
	// 	'img_path'  => './captcha/',
	// 	'img_url'  => base_url().'captcha/',
	// 	'img_width'  => '145',
	// 	'img_height' => 45,
	// 	'border' => 0,
	// 	'expiration' => 7200,
	// 	'colors' => array(
  //               'background' => array(242, 242, 242),
  //               'border' => array(255, 255, 255),
  //               'text' => array(0, 0, 0),
  //               'grid' => array(255, 40, 40))
	//  );
	//  // create captcha image
	//  $cap = create_captcha($config_captcha);
	//  // store image html code in a variable
	//  $data['image'] = $cap['image'];
	//  // store the captcha word in a session
	//  $data['mycaptcha'] = $cap['word'];
	//  $this->session->set_userdata('mycaptcha', $cap['word']);
	//  //echo $mycaptcha = $this->session->userdata('mycaptcha');
	//  $this->load->view('login', $data);
	// //echo base_url().'captcha/';
	// }

	public function do_login()
	{
				//$captcha 		= $this->input->post('captcha');
				//$mycaptcha 		= $this->input->post('mycaptcha');
				//echo $mycaptcha;
				//echo $this->session->userdata('mycaptcha');
				$username 		= $this->security->xss_clean($this->input->post('username'));
        $password 		= $this->security->xss_clean($this->input->post('password'));
				$password 		= md5($password);
				$token 		= $this->input->post('token');
      	// $q_cek	= $this->db->query("SELECT u.id_user,u.username,p.nama,j.jabatan,p.id_jabatan,p.id_kategori,rl.id_rumah_layanan,p.id_satker,u.kategori,s.nama_satker,u.id_pegawai,u.is_kontrak,s.satker,s.key FROM user AS u
				// 														INNER JOIN pegawai2 AS p ON u.id_pegawai=p.id
				// 														INNER JOIN satker AS s ON p.id_satker = s.id_satker
				// 														INNER JOIN jabatan AS j ON p.id_jabatan = j.id_jabatan
				// 														LEFT JOIN rumah_layanan AS rl ON rl.id_pegawai=p.id
				// 														WHERE u.username = '$username' AND u.password = '$password'");
				$q_cek = $this->m_login->cek_username($username,$password);
				$j_cek	= $q_cek->num_rows();
				$d_cek	= $q_cek->row();

				$url = "https://www.google.com/recaptcha/api/siteverify";
				$data = [
					'secret' => "6LfdJqYZAAAAALIXVqRA-7g8EPnVaGBvWpGSUUBu",
					'response' => $token,
					'remoteip' => $_SERVER['REMOTE_ADDR']
				];

				$options = array(
					'http' => array (
						'header' => "Content-type: application/x-www-form-urlencoded\r\n",
						'method' => 'POST',
						'content' => http_build_query($data)
					)
				);
				$context = stream_context_create($options);
				$response = file_get_contents($url, false, $context);
				$res = json_decode($response, true);
				// if ($res['success'] == true)
				// {
					if($j_cek == 1)
					{
	        		$data = array(
								'admin_id' => $d_cek->id_user,
								'admin_username' => $d_cek->username,
								'admin_nama' => $d_cek->nama,
								'admin_jabatan' => $d_cek->jabatan,
								'admin_id_jabatan' => $d_cek->id_jabatan,
								'admin_id_rumah_layanan' => $d_cek->id_rumah_layanan,
								'admin_id_satker' => $d_cek->id_satker,
								'admin_nama_satker' => $d_cek->nama_satker,
								'admin_satker' => $d_cek->satker,
								'admin_key_satker' => $d_cek->key,
								'admin_id_kategori' => $d_cek->id_kategori,
								'admin_kategori' => $d_cek->kategori,
								'admin_is_kontrak' => $d_cek->is_kontrak,
								'admin_id_pegawai' => $d_cek->id_pegawai,
								'admin_valid' => "true"
	                    );
	            $this->session->set_userdata($data);
							$kategori = $this->session->userdata('admin_kategori');
							//echo $this->session->userdata('admin_valid');
							//echo $this->session->userdata('admin_id_jabatan');
							//echo '<script>alert(".$this->session->userdata('admin_id_jabatan');.");</script>';
							$id_user = $this->session->userdata('admin_id');
							$keterangan = "Login Sistem";
							$data=array(
							 'id_user'=> $id_user,
							 'keterangan'=> $keterangan,
							 'tanggal'=> DATE("Y-m-d H:i:s")
						 	);
							$this->db->insert('log_history',$data);

							if ($kategori == 1) {
								redirect(base_url("afin"));
							}
							elseif ($kategori == 2) {
								redirect(base_url("program"));
							}
							elseif ($kategori == 3) {
								redirect(base_url("pejabat_teknis"));
							}
							elseif ($kategori == 4) {
								redirect(base_url("bendahara_pengeluaran"));
							}
							elseif ($kategori == 5) {
								redirect(base_url("bendahara_penerimaan"));
							}
							elseif ($kategori == 6) {
								redirect(base_url("pimpinan"));
							}
							elseif ($kategori == 7) {
								redirect(base_url("ppk"));
							}
							elseif ($kategori == 8) {
								redirect(base_url("pejabat_keuangan"));
							}
							elseif ($kategori == 9) {
								redirect(base_url("tata_usaha"));
							}
							elseif ($kategori == 0) {
								redirect(base_url("monev"));
							}
							elseif ($kategori == 10) {
								redirect(base_url("kaban"));
							}
							elseif ($kategori == 999) {
								redirect(base_url("admin"));
							}
							elseif ($kategori == 998) {
								redirect(base_url("pimpinan_lemigas"));
							}

							//echo $this->session->userdata('admin_valid');
							//echo $this->session->userdata('admin_id_jabatan');
	            //redirect(base_url("admin"));
	        }
					else
					{
						echo '<script>alert("Username atau Password Salah");</script>';
						redirect('login','refresh');
					}
				//}
				// else
				// {
				// 	echo '<script>alert("Captcha Tidak Sesuai");</script>';
				// 	redirect('login','refresh');
				// }
	}

	public function logout()
	{
			$id_user = $this->session->userdata('admin_id');
			$keterangan = "Logout Sistem";
			$data=array(
			 'id_user'=> $id_user,
			 'keterangan'=> $keterangan,
			 'tanggal'=> DATE("Y-m-d H:i:s")
			);
			$this->db->insert('log_history',$data);
      $this->session->sess_destroy();
			redirect('login');
  }



  function getCaptcha($SecretKey)
    {
			$SITE_KEY = "6LfdJqYZAAAAAOZ0aNTAhv8RVVp90sH6SQTDMcO5";
			$SECRET_KEY = "6LfdJqYZAAAAALIXVqRA-7g8EPnVaGBvWpGSUUBu";
      $Response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$SECRET_KEY."&response={$SecretKey}");
      $Return = json_decode($Response);
      return $Return;
    }


public function update_password()
		{
			$kategori = $this->session->userdata('admin_kategori');
			$id_user 		= $this->input->post('id_user');
			$password 		= $this->input->post('password');
			$new_password 		= $this->input->post('new_password');
			$confirm_password 		= $this->input->post('confirm_password');
			//$password	= rand(10,1000000);
			$encrypt_password	= md5($password);
			$new_encrypt_password	= md5($new_password);
			$cek = $this->db->query("SELECT * FROM user WHERE id_user = $id_user")->row();
			if ($encrypt_password != $cek->password)
			{
				echo '<script>alert("Password salah");</script>';
			}
			else
			{
				//echo '<script>alert("Password benar");</script>';
				if ($new_password != $confirm_password)
				{
					echo '<script>alert("Konfirmasi Password tidak sesuai");</script>';
				}
				else
				{
					$data=array(
					 'password'=> $new_encrypt_password
					);
					$this->db->where('id_user', $id_user);
					$this->db->update('user', $data);
					$keterangan = "Update Password";
					$data=array(
					 'id_user'=> $id_user,
					 'keterangan'=> $keterangan,
					 'tanggal'=> DATE("Y-m-d H:i:s")
					);
					$this->db->insert('log_history',$data);
					//$email = $cek->username;
					//$subject = "RESET PASSWORD MONIKA";
					//$content = "Password telah direset dengan Password Baru : <b>".$new_password."</b>. Silahkan login menggunakan password yang baru";
					//$response = $this->api_email->send_email($email,$subject,$content);
					echo '<script>alert("Password berhasil diubah");</script>';
				}
			}

			if ($kategori == 1) {
				redirect('afin','refresh');
			}
			elseif ($kategori == 2) {
				redirect('program','refresh');
			}
			elseif ($kategori == 3) {
				redirect('pejabat_teknis','refresh');
			}
			elseif ($kategori == 4) {
				redirect('bendahara_pengeluaran','refresh');
			}
			elseif ($kategori == 5) {
				redirect('bendahara_penerimaan','refresh');
			}
			elseif ($kategori == 6) {
				redirect('pimpinan','refresh');
			}
			elseif ($kategori == 7) {
				redirect('ppk','refresh');
			}
			elseif ($kategori == 8) {
				redirect('pejabat_keuangan','refresh');
			}
			elseif ($kategori == 9) {
				redirect('tata_usaha','refresh');
			}
			elseif ($kategori == 0) {
				redirect('monev','refresh');
			}
			elseif ($kategori == 10) {
				redirect('kaban','refresh');
			}
			elseif ($kategori == 999) {
				redirect('admin','refresh');
			}
			elseif ($kategori == 998) {
				redirect(base_url("pimpinan_lemigas"));
			}


			// $data=array(
			//  'password'=> $new_password
			// );
			// $this->db->where('id_user', $id_user);
			// $this->db->update('user', $data);
			// $cek = $this->db->query("SELECT * FROM user WHERE id_user = $id_user")->row();
			// $email = $cek->username;
			// $subject = "RESET PASSWORD MONIKA";
			// $content = "Password telah direset dengan Password Baru : <b>".$password."</b>. Silahkan login menggunakan password yang baru";
			// $response = $this->api_email->send_email($email,$subject,$content);
			//echo '<script>alert("Password Baru : '.$password.'");</script>';
			//redirect('admin/user','refresh');
		}



	public function test()
	{
		$token 		= $this->input->post('token');
		$url = "https://www.google.com/recaptcha/api/siteverify";
		$data = [
			'secret' => "6Lc4xfoUAAAAABqU-h7X5AQMWDbiuYWY-BE_2ShD",
			'response' => $token,
			'remoteip' => $_SERVER['REMOTE_ADDR']
		];

		$options = array(
			'http' => array (
				'header' => "Content-type: application/x-www-form-urlencoded\r\n",
				'method' => 'POST',
				'content' => http_build_query($data)
			)
		);
		$context = stream_context_create($options);
		$response = file_get_contents($url, false, $context);
		$res = json_decode($response, true);
		if($res['success'] == true)
		{
			echo "OK";
		}
		else
		{
			echo "GAGAL";
			redirect('login',refresh);
		}
	}

}
?>
