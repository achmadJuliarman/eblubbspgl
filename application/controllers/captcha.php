DATA HOSTED WITH ♥ BY PASTEBIN.COM - DOWNLOAD RAW - SEE ORIGINAL
<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Captcha extends CI_Controller {
  function __construct(){
    parent::__construct();
  }

  function index()
  {
    $options = array(
        'img_path'=>'./captcha/', #folder captcha yg sudah dibuat tadi
        'img_url'=>base_url('captcha/'), #ini arahnya juga ke folder captcha
        'img_width'=>'145', #lebar image captcha
        'img_height'=>'45', #tinggi image captcha
        'expiration'=>7200, #waktu expired
        'font_path' => FCPATH . 'assets/font/coolvetica.ttf', #load font jika mau ganti fontnya
        'pool' => '0123456789', #tipe captcha (angka/huruf, atau kombinasi dari keduanya)

        # atur warna captcha-nya di sini ya.. gunakan kode RGB
        'colors' => array(
                'background' => array(242, 242, 242),
                'border' => array(255, 255, 255),
                'text' => array(0, 0, 0),
                'grid' => array(255, 40, 40))
           );
    $cap = create_captcha($options);
    $data['image'] = $cap['image'];
    $this->session->set_userdata('mycaptcha', $cap['word']);
    $data['word'] = $this->session->userdata('mycaptcha');
    $this->load->view('login',$data);
  }
}
