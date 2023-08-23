<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Sidara extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    function index_get() {
        $satker = $this->uri->segment(2);
        $tahun = date("Y");
        $result = $this->db->query("SELECT  SUM(IF(YEAR(t.tgl_pembayaran) = $tahun AND t.status_pembayaran=1, t.jumlah_realisasi, 0)) AS realisasi,
                                            SUM(IF(YEAR(t.tgl_invoice) = $tahun AND t.status_cetak_invoice=1, t.jumlah, 0)) AS invoice
                                            FROM termin AS t INNER JOIN kontrak AS k ON t.id_kontrak = k.id_kontrak WHERE k.id_satker = $satker")->result();
        header('Access-Control-Allow-Origin: *');
        $this->response($result);
    }
}
?>
