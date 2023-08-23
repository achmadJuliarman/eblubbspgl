<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Pengeluaran extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    //Menampilkan data kontak
    function index_get() {
        //$kontak = $this->db->query("SELECT SUM(t.jumlah_realisasi) AS jumlah FROM termin AS t INNER JOIN kontrak AS k ON t.id_kontrak = k.id_kontrak AND YEAR(t.tgl_termin) = 2020 AND t.status_pembayaran=1")->row();
        $kontak = $this->db->query("SELECT * FROM pengajuan AS p INNER JOIN rencana_operasional AS ro ON p.id_ro = ro.id_ro INNER JOIN kontrak AS k ON ro.id_kontrak = k.id_kontrak AND p.status_realisasi = 1 AND YEAR(p.tgl_pengajuan) = 2020")->result();
        $this->response($kontak, 200);
    }

    //Masukan function selanjutnya disini
}
?>
