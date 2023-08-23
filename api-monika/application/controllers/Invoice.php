<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Invoice extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    //Menampilkan data kontak
    function index_get() {
        $satker = $this->uri->segment(2);
        $tahun = date("Y");
        //$kontak = $this->db->query("SELECT SUM(t.jumlah_realisasi) AS jumlah FROM termin AS t INNER JOIN kontrak AS k ON t.id_kontrak = k.id_kontrak AND YEAR(t.tgl_termin) = 2020 AND t.status_pembayaran=1")->row();
        $kontak = $this->db->query("SELECT t.no_invoice,t.jumlah,t.jumlah_realisasi,t.tgl_invoice,t.tgl_pembayaran,t.status_pembayaran,rl.id_satker FROM termin AS t INNER JOIN kontrak AS k ON t.id_kontrak = k.id_kontrak INNER JOIN rumah_layanan AS rl ON k.id_rumah_layanan = rl.id_rumah_layanan WHERE YEAR(t.tgl_invoice) = $tahun AND rl.id_satker = $satker")->result();
        $this->response($kontak);
    }

    //Masukan function selanjutnya disini
}
?>
