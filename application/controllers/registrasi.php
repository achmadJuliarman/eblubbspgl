<?php
class Registrasi extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		//$this->load->model(array('m_peserta','m_instansi','m_diklat'));
		$this->load->library(array('session','form_validation', 'Recaptcha','email','format_tanggal'));
		$this->load->helper(array('captcha','url','form'));
	}

	function index()
	{
		$data = array(
						 'action' => site_url('registrasi/registrasi'),
						 'username' => set_value('username'),
						 'password' => set_value('password'),
						 'captcha' => $this->recaptcha->getWidget(), // menampilkan recaptcha
						 'script_captcha' => $this->recaptcha->getScriptTag() // javascript recaptcha ditaruh di head
				 );
		$data['script_captcha'] = $this->recaptcha->getScriptTag();
		//$data['isi'] = 'home/registrasi';
		$this->load->view('home/registrasi',$data);
	}

	function cari()
	{
		$data['isi'] = 'registrasi/cari';
		$data['result'] = $this->m_peserta->list_peserta_registrasi();
		$this->load->view('registrasi/index',$data);
	}

	function cari_peserta()
	{
		$id	= $this->input->post('id' , TRUE);
		$data['isi'] = 'registrasi/view_profile';
		$data['result'] = $this->m_peserta->view_profile($id)->row();
		$this->load->view('registrasi/index',$data);
	}

	function konfirmasi_data_peserta()
	{
		$id = $this->uri->segment(3);
		$data = array(
             'action' => site_url('registrasi/login'),
             'username' => set_value('username'),
             'password' => set_value('password'),
             'captcha' => $this->recaptcha->getWidget(), // menampilkan recaptcha
             'script_captcha' => $this->recaptcha->getScriptTag() // javascript recaptcha ditaruh di head
         );
 		$data['script_captcha'] = $this->recaptcha->getScriptTag();
		$data['isi'] = 'registrasi/set_password';
		$data['result'] = $this->m_peserta->view_profile($id)->row();
		$this->load->view('registrasi/index',$data);
	}

	function set_password()
	{
		//$id = $this->uri->segment(3);
		//$password = $this->uri->segment(3);
		//$konfirmasi_password = $this->uri->segment(3);
		//echo "id:".$id;
		$id	= $this->input->post('id' , TRUE);
		$name	= addslashes($this->input->post('name' , TRUE));
		$email	= addslashes($this->input->post('email' , TRUE));
		$handphone	= addslashes($this->input->post('handphone' , TRUE));
		$password	= addslashes($this->input->post('password' , TRUE));
		$konfirmasi_password	= addslashes($this->input->post('konfirmasi_password' , TRUE));
		$identity_card_number	= addslashes($this->input->post('identity_card_number' , TRUE));
		$uuid = uniqid('', true);
		$hash = $this->hashSSHA($password);
		$encrypted_password = $hash["encrypted"]; // encrypted password
		$salt = $hash["salt"]; // salt
		$recaptcha = $this->input->post('g-recaptcha-response');
		$response = $this->recaptcha->verifyResponse($recaptcha);
		if (!isset($response['success']) || $response['success'] <> true)
		{
			echo '<script>alert("Data Gagal Disimpan! Pastikan Captcha sudah di checklist");</script>';
			redirect('registrasi/konfirmasi_data_peserta/'.$id, 'refresh');
		}
		else
		{
			if ($konfirmasi_password == $password)
			{
				// $config['charset'] = 'utf-8';
				// $config['useragent'] = 'Codeigniter';
				// $config['protocol']= "sendmail";
				// $config['mailtype']= "html";
				// $config['smtp_host']= "smtp.gmail.com";//pengaturan smtp
				// $config['smtp_port']= "465";
				// $config['smtp_timeout']= "400";
				// $config['smtp_user']= "ppsdmgeominerba@gmail.com"; // isi dengan email kamu
				// $config['smtp_pass']= "geominerba18"; // isi dengan password kamu
				// $config['crlf']="\r\n";
				// $config['newline']="\r\n";
				// $config['wordwrap'] = TRUE;
				// $this->email->initialize($config);
				// $this->email->set_newline("\r\n");
				// $this->email->from('ppsdmgeominerba@gmail.com', 'PPSDM Geominerba');
				// $this->email->to($email);
				// $this->email->subject('Registrasi Akun PPSDM Geominerba');
				// $mail_data['name'] = $name;
				// $message = $this->load->view('registrasi/email', $mail_data, true);
				// $this->email->message($message);
				// $this->email->send();
        $config = Array (
					'protocol' => 'smtp',
					'smtp_host' => 'ssl://smtp.googlemail.com',
					'smtp_port' => 25,
					'smtp_user' => 'ariefekaputra09@gmail.com',
					'smtp_pass' => 'rajonrondo9',
					'mail_type' => 'html',
					'smtp_crypto' => 'ssl',
					'smtp_timeout' => 5,
					'charset' => 'iso-8859-1'
				);             	// 'UTF-8', 'ISO-8859-15', ...; NULL (preferable) means config_item('charset'), i.e. the character set of the site.
				//$this->email->initialize($config);
				$this->load->library('email',$config);
				$this->email->set_newline("\r\n");
				$this->email->from('ariefekaputra09@gmail.com', 'Site name');
				$this->email->to($email);
				$this->email->subject('Notification Mail');
				$this->email->message('Your message');
				$this->email->send();
				if($this->email->send())
				  {
						// $this->m_peserta->simpan($data);
						// $this->m_peserta->simpan_peserta($data);
						// echo '<script>alert("Data Berhasil Disimpan! Silahkan check email untuk konfirmasi Akun");</script>';
						// redirect('registrasi', 'refresh');
						$data = array(
									'name' => $name,
									'email' => $email,
									'handphone' => $handphone,
									'unique_id' => $uuid,
									'encrypted_password' => $encrypted_password,
									'password' => $password,
									'salt' => $salt,
									'identity_card_number' => $identity_card_number,
									'created_at' => date("Y-m-d H:i:s"),
									'updated_at' => NULL
								);
						$this->m_peserta->simpan_user($data);
						$last = $this->m_peserta->get_user_last();
						$data = array(
											'user_id' => $last->id,
											'name' => $name,
											'email' => $email,
											'handphone' => $handphone,
											'unique_id' => $uuid,
											'encrypted_password' => $encrypted_password,
											'password' => $password,
											'salt' => $salt,
											'identity_card_number' => $identity_card_number,
											'created_at' => date("Y-m-d H:i:s"),
											'updated_at' => NULL
										);
						$this->m_peserta->simpan_peserta($data);
						$data = array(
											'status_registrasi' => 1
										);
						$this->m_peserta->update_status_registrasi_peserta($email,$data);
						echo '<script>alert("Data Berhasil Disimpan");</script>';
			      redirect('registrasi', 'refresh');
				  }
				else
				  {
						// echo '<script>alert("Gagal mengirim verifikasi email");</script>';
						// redirect('registrasi', 'refresh');
						show_error($this->email->print_debugger());
				  }
			}
			else
			{
				echo '<script>alert("Data Gagal Disimpan! Password tidak sama");</script>';
	      redirect('registrasi/konfirmasi_data_peserta/'.$id, 'refresh');
			}
		}

		// $this->load->view('registrasi/index',$data);
	}

	function signup()
	{
	 $data = array(
            'action' => site_url('registrasi/login'),
            'username' => set_value('username'),
            'password' => set_value('password'),
            'captcha' => $this->recaptcha->getWidget(), // menampilkan recaptcha
            'script_captcha' => $this->recaptcha->getScriptTag() // javascript recaptcha ditaruh di head
        );
		$data['script_captcha'] = $this->recaptcha->getScriptTag();
		$this->load->view('registrasi/register',$data);
	}

	// function create_captcha()
	// {
	//  $config_captcha = array(
	// 		 'img_path'  => './captcha/',
	// 		 'img_url'  => base_url().'captcha/',
	// 		 'img_width'  => '200',
	// 		 'img_height' => 30,
	// 		 'border' => 0,
	// 		 'expiration' => 7200
	// 		);
	// 	$cap = create_captcha($config_captcha);
	// 	$image = $cap['image'];
	// 	$this->session->set_userdata('captchaword', $cap['word']);
	// 	return $image;
	// }

	public function hashSSHA($password)
	{
			$salt = sha1(rand());
			$salt = substr($salt, 0, 10);
			$encrypted = base64_encode(sha1($password . $salt, true) . $salt);
			$hash = array("salt" => $salt, "encrypted" => $encrypted);
			return $hash;
	}

	public function checkhashSSHA($salt, $password)
	{
			$hash = base64_encode(sha1($password . $salt, true) . $salt);
			return $hash;
	}

	public function login()
	{
			$email	= $this->input->post('email' , TRUE);
			$password	= $this->input->post('password' , TRUE);
			$q_cek	= $this->m_peserta->get_user($email);
			$j_cek	= $q_cek->num_rows();
			$d_cek	= $q_cek->row();
			if($j_cek == 1)
			{
					//echo "berhasil";
					$result = $q_cek->row();
					$salt = $result->salt;
					$encrypted_password = $result->encrypted_password;
					$hash = $this->checkhashSSHA($salt, $password);
					if ($encrypted_password == $hash)
					{
							//autentikasi user berhasil
							$data = array(
	                    'admin_id' => $d_cek->id,
	                    'admin_name' => $d_cek->name,
	                    'admin_email' => $d_cek->email,
	                    'admin_hp' => $d_cek->handphone,
	                    'admin_image' => $d_cek->image,
	                    'admin_point' => $d_cek->point,
											'admin_valid' => "true"
	                    );
	            $this->session->set_userdata($data);
							redirect(base_url("home_peserta"));
					}
					else
					{
						echo '<script>alert("Login Gagal ! Email atau Password Salah");</script>';
						redirect('registrasi', 'refresh');
					}
			}
			else
			{
				echo '<script>alert("Login Gagal ! Data Tidak Ditemukan");</script>';
				redirect('registrasi', 'refresh');
			}


			//$stmt = mysql_query("SELECT * FROM participants WHERE email = '$email'");
					//$user = mysql_fetch_assoc($stmt);
					// verifikasi password user
					// $salt = $data->salt;
					// $encrypted_password = $data->encrypted_password;
					// echo $hash = base64_encode(sha1($password . $salt, true) . $salt);
					// $hash = $this->checkhashSSHA($salt, $password);
					// if ($encrypted_password == $hash)
					// {
					// 		echo "berhasil";
					// }
					// else
					// {
					// 		echo "gagal";
					// }
	}

	function add_peserta()
	{
		// $this->form_validation->set_rules('name', 'Nama', 'trim|alpha_dash');
		// $this->form_validation->set_rules('handphone', 'Handphone ', 'trim|numeric');
		$recaptcha = $this->input->post('g-recaptcha-response');
		$response = $this->recaptcha->verifyResponse($recaptcha);
		if (!isset($response['success']) || $response['success'] <> true)
		{
			echo '<script>alert("Data Gagal Disimpan! Pastikan Captcha sudah di checklist");</script>';
      redirect('registrasi/signup', 'refresh');
		}
		else
		{
			date_default_timezone_set('Asia/Jakarta');
			$name	= addslashes($this->input->post('name' , TRUE));
			$email	= addslashes($this->input->post('email' , TRUE));
			$handphone	= addslashes($this->input->post('handphone' , TRUE));
			$password	= addslashes($this->input->post('password' , TRUE));
			$identity_card_number	= addslashes($this->input->post('identity_card_number' , TRUE));
			$uuid = uniqid('', true);
			$hash = $this->hashSSHA($password);
			$encrypted_password = $hash["encrypted"]; // encrypted password
			$salt = $hash["salt"]; // salt
			$data = array(
						'name' => $name,
						'email' => $email,
						'handphone' => $handphone,
						'unique_id' => $uuid,
						'encrypted_password' => $encrypted_password,
						'password' => $password,
						'salt' => $salt,
						'identity_card_number' => $identity_card_number,
						'created_at' => date("Y-m-d H:i:s"),
						'updated_at' => NULL
					);
			$q_cek	= $this->m_peserta->get_user_existed($email);
			$j_cek	= $q_cek->num_rows();
			$d_cek	= $q_cek->row();
			if($j_cek == 1)
			{
				echo '<script>alert("Data Gagal Disimpan! Email sudah terdaftar");</script>';
				redirect('registrasi/signup', 'refresh');
			}
			else
			{
				$config['charset'] = 'utf-8';
		    $config['useragent'] = 'Codeigniter';
		    $config['protocol']= "smtp";
		    $config['mailtype']= "html";
				$config['smtp_host']= "ssl://smtp.gmail.com";//pengaturan smtp
				$config['smtp_port']= "465";
				//$config['smtp_timeout']= "400";
				$config['smtp_user']= "ppsdmgeominerba@gmail.com"; // isi dengan email kamu
				$config['smtp_pass']= "geominerba18"; // isi dengan password kamu
		    $config['crlf']="\r\n";
		    $config['newline']="\r\n";
		    $config['wordwrap'] = TRUE;
				$this->email->initialize($config);
				$this->email->from('ppsdmgeominerba@gmail.com', 'PPSDM Geominerba');
				$this->email->to($email);
				$this->email->subject('Registrasi Akun PPSDM Geominerba');
				$mail_data['name'] = $name;
				$message = $this->load->view('registrasi/email', $mail_data, true);
				$this->email->message($message);
				$this->email->send();
				if($this->email->send())
			    {
						// $this->m_peserta->simpan($data);
						// $this->m_peserta->simpan_peserta($data);
						// echo '<script>alert("Data Berhasil Disimpan! Silahkan check email untuk konfirmasi Akun");</script>';
						// redirect('registrasi', 'refresh');
						$this->m_peserta->simpan($data);
						$last = $this->m_peserta->get_user_last();
						$data = array(
									'user_id' => $last->id,
									'name' => $name,
									'email' => $email,
									'handphone' => $handphone,
									'unique_id' => $uuid,
									'encrypted_password' => $encrypted_password,
									'password' => $password,
									'salt' => $salt,
									'identity_card_number' => $identity_card_number,
									'created_at' => date("Y-m-d H:i:s"),
									'updated_at' => NULL
								);
						$this->m_peserta->simpan_peserta($data);
						echo '<script>alert("Data Berhasil Disimpan! Silahkan check email untuk konfirmasi Akun");</script>';
						redirect('registrasi', 'refresh');
			    }
				else
			    {
						echo '<script>alert("Gagal mengirim verifikasi email");</script>';
						redirect('registrasi', 'refresh');
			    }
			}
		}
	}

	function self_registration()
	{
		$recaptcha = $this->input->post('g-recaptcha-response');
		$response = $this->recaptcha->verifyResponse($recaptcha);
		if (!isset($response['success']) || $response['success'] <> true)
		{
			echo '<script>alert("Data Gagal Disimpan! Pastikan Captcha sudah di checklist");</script>';
      redirect('registrasi/signup', 'refresh');
		}
		else
		{
			date_default_timezone_set('Asia/Jakarta');
			$name	= addslashes($this->input->post('name' , TRUE));
			$email	= addslashes($this->input->post('email' , TRUE));
			$handphone	= addslashes($this->input->post('handphone' , TRUE));
			$password	= addslashes($this->input->post('password' , TRUE));
			$identity_card_number	= addslashes($this->input->post('identity_card_number' , TRUE));
			$uuid = uniqid('', true);
			$hash = $this->hashSSHA($password);
			$encrypted_password = $hash["encrypted"]; // encrypted password
			$salt = $hash["salt"]; // salt
			$q_cek	= $this->m_peserta->get_user_existed($email);
			$j_cek	= $q_cek->num_rows();
			$d_cek	= $q_cek->row();
			if($j_cek == 1)
			{
				echo '<script>alert("Data Gagal Disimpan! Email sudah terdaftar");</script>';
				redirect('registrasi/signup', 'refresh');
			}
			else
			{
				$config['charset'] = 'utf-8';
		    $config['useragent'] = 'Codeigniter';
		    $config['protocol']= "smtp";
		    $config['mailtype']= "html";
				$config['smtp_host']= "ssl://smtp.gmail.com";//pengaturan smtp
				$config['smtp_port']= "465";
				//$config['smtp_timeout']= "400";
				$config['smtp_user']= "ppsdmgeominerba@gmail.com"; // isi dengan email kamu
				$config['smtp_pass']= "geominerba18"; // isi dengan password kamu
		    $config['crlf']="\r\n";
		    $config['newline']="\r\n";
		    $config['wordwrap'] = TRUE;
				$this->email->initialize($config);
				$this->email->from('info.geominerba@esdm.go.id', 'PPSDM Geominerba');
				$this->email->to($email);
				$this->email->subject('Registrasi Akun PPSDM Geominerba');
				$mail_data['name'] = $name;
				$message = $this->load->view('registrasi/email', $mail_data, true);
				$this->email->message($message);
				$this->email->send();
				if($this->email->send())
			    {
						// $this->m_peserta->simpan($data);
						// $this->m_peserta->simpan_peserta($data);
						// echo '<script>alert("Data Berhasil Disimpan! Silahkan check email untuk konfirmasi Akun");</script>';
						// redirect('registrasi', 'refresh');
						$data_user = array(
									'name' => $name,
									'email' => $email,
									'handphone' => $handphone,
									'unique_id' => $uuid,
									'encrypted_password' => $encrypted_password,
									'password' => $password,
									'salt' => $salt,
									'identity_card_number' => $identity_card_number,
									'created_at' => date("Y-m-d H:i:s"),
									'updated_at' => NULL
								);
							$this->m_peserta->simpan_user($data_user);
							$last = $this->m_peserta->get_user_last();
							$data_peserta = array(
										'user_id' => $last->id,
										'name' => $name,
										'email' => $email,
										'handphone' => $handphone,
										'unique_id' => $uuid,
										'encrypted_password' => $encrypted_password,
										'password' => $password,
										'salt' => $salt,
										'identity_card_number' => $identity_card_number,
										'created_at' => date("Y-m-d H:i:s"),
										'updated_at' => NULL
									);
							$this->m_peserta->simpan_peserta($data_peserta);
							echo '<script>alert("Data Berhasil Disimpan! Silahkan check email untuk konfirmasi Akun");</script>';
							redirect('registrasi', 'refresh');
			    }
				else
			    {
						echo '<script>alert("Berhasil melakukan registrasi, namun gagal mengirim verifikasi email");</script>';
						redirect('registrasi', 'refresh');
			    }
			}
		}
	}

	function add_peserta_diklat()
	{
			date_default_timezone_set('Asia/Jakarta');
			$name	= addslashes($this->input->post('name' , TRUE));
			$email	= addslashes($this->input->post('email' , TRUE));
			$handphone	= addslashes($this->input->post('handphone' , TRUE));
			$password	= addslashes($this->input->post('password' , TRUE));
			$birthplace	= addslashes($this->input->post('birthplace' , TRUE));
			$agency_id	= addslashes($this->input->post('agency_id' , TRUE));
			$gender_id	= addslashes($this->input->post('gender_id' , TRUE));
			$agency_id_suggest	= addslashes($this->input->post('agency_id_suggest' , TRUE));
			$birthdate	= $this->format_tanggal->jin_date_sql($this->input->post('birthdate'));
			$identity_card_number	= addslashes($this->input->post('identity_card_number' , TRUE));
			$schedule_id	= addslashes($this->input->post('schedule_id' , TRUE));
			$uuid = uniqid('', true);
			$hash = $this->hashSSHA($password);
			$encrypted_password = $hash["encrypted"]; // encrypted password
			$salt = $hash["salt"]; // salt
			$data = array(
						'name' => $name,
						'email' => $email,
						'handphone' => $handphone,
						'unique_id' => $uuid,
						'encrypted_password' => $encrypted_password,
						'password' => $password,
						'salt' => $salt,
						'identity_card_number' => $identity_card_number,
						'created_at' => date("Y-m-d H:i:s"),
						'updated_at' => NULL
					);
			$q_cek	= $this->m_peserta->get_user_existed($email);
			$j_cek	= $q_cek->num_rows();
			$d_cek	= $q_cek->row();
			if($j_cek == 1)
			{
				echo '<script>alert("Data Gagal Disimpan! Email sudah terdaftar");</script>';
				redirect('registrasi/registrasi_online/'.$schedule_id, 'refresh');
			}
			else
			{
					$this->m_peserta->simpan_user($data);
					$lastuser = $this->m_peserta->get_user_last();
					if ($agency_id=="Lainnya")
					{
						$dataagency = array(
									'name' => $agency_id_suggest
								);
						$this->m_instansi->simpan($dataagency);
						$lastinstansi = $this->m_instansi->get_last();
						$data = array(
									'user_id' => $lastuser->id,
									'name' => $name,
									'email' => $email,
									'handphone' => $handphone,
									'unique_id' => $uuid,
									'encrypted_password' => $encrypted_password,
									'password' => $password,
									'salt' => $salt,
									'identity_card_number' => $identity_card_number,
									'birthdate' => $birthdate,
									'birthplace' => $birthplace,
									'agency_id' => $lastinstansi->id,
									'gender_id' => $gender_id,
									'status' => 1,
									'created_at' => date("Y-m-d H:i:s")
								);
					}
					else
					{
						$data = array(
									'user_id' => $lastuser->id,
									'name' => $name,
									'email' => $email,
									'handphone' => $handphone,
									'unique_id' => $uuid,
									'encrypted_password' => $encrypted_password,
									'password' => $password,
									'salt' => $salt,
									'identity_card_number' => $identity_card_number,
									'birthdate' => $birthdate,
									'birthplace' => $birthplace,
									'agency_id' => $agency_id,
									'gender_id' => $gender_id,
									'status' => 1,
									'created_at' => date("Y-m-d H:i:s")
								);
					}
					$this->m_peserta->simpan_peserta($data);
					$last = $this->m_peserta->get_peserta_last();
					$participant_id	= $last->id;
					$data = array(
								'schedule_id' => $schedule_id,
								'participant_id' => $participant_id,
								'created_at' => date("Y-m-d H:i:s")
							);
					$this->m_peserta->simpan_peserta_diklat($data);
					echo '<script>alert("Data Berhasil Disimpan!");</script>';
					redirect('registrasi/registrasi_online/'.$schedule_id, 'refresh');
			}
	}

	function email()
	{
		$this->load->view('registrasi/email');
	}

	function list_diklat_peserta()
	{
		$data['result'] = $this->m_diklat->jadwal_diklat_online()->result();
		$data['isi'] = 'home_penyelenggara/list_diklat_penyelenggara';
		$this->load->view('home_penyelenggara/index',$data);
	}

	public function registrasi_online()
	{
		$id 	= $this->uri->segment(3);
		$data['instansi'] = $this->m_instansi->list_instansi()->result();
		$data['result'] = $this->m_diklat->get_diklat($id);
		$data['isi'] = 'home_penyelenggara/registrasi_manual';
		$this->load->view('home_penyelenggara/index',$data);
	}

	// function check_captcha()
	// {
	// 	if ($this->input->post('captcha') == $this->session->userdata('captchaword'))
	// 	{ return true; }
	// 	else
	// 	{
	// 			$this->form_validation->set_message('çheck_captcha', 'Captcha is wrong');
	// 			return false;
	// 	}
	// }

	// public function login()
  //   {
  //       $this->form_validation->set_rules('username', ' ', 'trim|required');
  //       $this->form_validation->set_rules('password', ' ', 'trim|required');
  //       $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
  //       $recaptcha = $this->input->post('g-recaptcha-response');
  //       $response = $this->recaptcha->verifyResponse($recaptcha);
  //       if ($this->form_validation->run() == FALSE || !isset($response['success']) || $response['success'] <> true) {
  //           $this->index();
  //       } else {
  //           echo 'Berhasil';
  //       }
  //   }

	public function send_mail()
	{
		$config = Array(
      'protocol' => 'smtp',
      'smtp_host' => 'ssl://smtp.googlemail.com',
      'smtp_port' => 465,
      'smtp_user' => 'ariefekaputra09@gmail.com', //isi dengan gmailmu!
      'smtp_pass' => 'rajonrondo9', //isi dengan password gmailmu!
      'mailtype' => 'html',
      'charset' => 'iso-8859-1',
      'wordwrap' => TRUE
    );
    $this->load->library('email', $config);
    $this->email->set_newline("\r\n");
    $this->email->from($email);
    $this->email->to('ariefekaputra09@gmail.com'); //email tujuan. Isikan dengan emailmu!
    $this->email->subject('Test');
    $this->email->message('Test');
    if($this->email->send())
    {
      echo 'Email sent';
    }
    else
    {
      show_error($this->email->print_debugger());
    }
	}

}
?>
