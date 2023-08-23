<?php

defined('BASEPATH') OR exit('No direct script access allowed');
//$root = realpath($_SERVER["DOCUMENT_ROOT"]);
//include "$root/inc/include1.php";

$document_root = $_SERVER['DOCUMENT_ROOT'];
echo "root: $document_root";

require(APPPATH.'libraries/REST_Controller.php');
   use Restserver\Libraries\REST_Controller;
   //use CI_Controller;
require(APPPATH.'libraries/Format.php');

class Api extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    //Menampilkan data kontak
    function index_get() {
        $id = $this->get('id');
        if ($id == '') {
            $kontak = $this->db->get('pegawai2')->result();
        } else {
            $this->db->where('id', $id);
            $kontak = $this->db->get('pegawai2')->result();
        }
        $this->response($kontak, 200);
    }

    //Masukan function selanjutnya disini
}
?>
