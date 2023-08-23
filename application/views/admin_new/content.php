<div class="wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
            <div class="card m-b-10 text-white bg-primary">
                <div class="card-body">
                  <p><h5>SELAMAT DATANG, <?php echo $this->session->userdata('admin_name'); ?></h5></p>
                </div>
            </div>
        </div>
          <div class="col-lg-12">
              <div class="card m-b-30">
                  <h4 class="card-header font-18 mt-0"><center>PILIH LAYANAN</center></h4>
                  <div class="card-body">
                      <!-- <p class="card-text">With supporting text below as a natural lead-in to
                          additional content.</p> -->
                        <center>
                          <h1>
                            <a class="btn btn-secondary btn-lg waves-effect waves-light" href="<?php echo base_url(); ?>client"> <i class="fa fa-plus"></i> <span>CLIENT</span> </a>
                            <a class="btn btn-primary btn-lg waves-effect waves-light" href="<?php echo base_url(); ?>bendahara_penerimaan/list_kontrak/1"> <i class="fa fa-plus"></i> <span>DIKLAT / BIMTEK</span> </a>
                            <a class="btn btn-warning btn-lg waves-effect waves-light" href="<?php echo base_url(); ?>bendahara_penerimaan/list_kontrak/2"> <i class="fa fa-plus"></i> <span>SEWA RUANGAN</span> </a>
                            <a class="btn btn-success btn-lg waves-effect waves-light" href="<?php echo base_url(); ?>bendahara_penerimaan/list_kontrak/3"> <i class="fa fa-plus"></i> <span>PENGINAPAN</span> </a>
                            <a class="btn btn-info btn-lg waves-effect waves-light" href="<?php echo base_url(); ?>bendahara_penerimaan/list_kontrak/4"> <i class="fa fa-plus"></i> <span>PENGGUNAAN LAHAN</span> </a>
                            <a class="btn btn-danger btn-lg waves-effect waves-light" href="<?php echo base_url(); ?>bendahara_penerimaan/list_kontrak/5"> <i class="fa fa-plus"></i> <span>PENYEWAAN PERALATAN</span> </a>
                            <a class="btn btn-secondary btn-lg waves-effect waves-light" href="<?php echo base_url(); ?>bendahara_penerimaan/list_kontrak/6"> <i class="fa fa-plus"></i> <span>LAYANAN LAINNYA</span> </a>
                          </h1>
                        </center>
                  </div>
              </div>
          </div>
          <div class="col-lg-12">
              <div class="card m-b-30">
                  <h4 class="card-header font-18 mt-0"><center>REKAP PENDAPATAN</center></h4>
                  <div class="card-body">
                    <div class="table-responsive">
                                    <table class="table mb-0">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Nama Layanan</th>
                                                <th>Target</th>
                                                <th>Terkontrak</th>
                                                <th>Invoice</th>
                                                <th>Realisasi</th>
                                                <th>Piutang</th>
                                                <th>Pengeluaran</th>
                                                <th>Surplus</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $total_target = 0; $total_invoice = 0; $total_terkontrak = 0; $total_realisasi = 0; foreach ($layanan as $a) { ?>
                                            <?php $target = $this->db->query("SELECT * FROM target WHERE id_layanan = $a->id_layanan AND tahun = 2021")->row(); ?>
                                            <?php $terkontrak = $this->db->query("SELECT SUM(t.jumlah) AS jumlah FROM termin AS t INNER JOIN kontrak AS k ON t.id_kontrak = k.id_kontrak INNER JOIN detail_layanan AS dl ON k.id_detail_layanan = dl.id_detail_layanan INNER JOIN m_layanan AS l ON dl.id_layanan = l.id_layanan WHERE l.id_layanan = $a->id_layanan AND YEAR(t.tgl_termin) = 2021")->row();?>
                                            <?php $invoice = $this->db->query("SELECT SUM(t.jumlah) AS jumlah FROM termin AS t INNER JOIN kontrak AS k ON t.id_kontrak = k.id_kontrak INNER JOIN detail_layanan AS dl ON k.id_detail_layanan = dl.id_detail_layanan INNER JOIN m_layanan AS l ON dl.id_layanan = l.id_layanan WHERE l.id_layanan = $a->id_layanan AND YEAR(t.tgl_termin) = 2021 AND t.status_cetak_invoice = 1")->row();?>
                                            <?php $realisasi = $this->db->query("SELECT SUM(t.jumlah) AS jumlah FROM termin AS t INNER JOIN kontrak AS k ON t.id_kontrak = k.id_kontrak INNER JOIN detail_layanan AS dl ON k.id_detail_layanan = dl.id_detail_layanan INNER JOIN m_layanan AS l ON dl.id_layanan = l.id_layanan WHERE l.id_layanan = $a->id_layanan AND YEAR(t.tgl_termin) = 2021 AND t.status_pembayaran = 1")->row();?>
                                            <tr>
                                              <td><?php echo $a->nama_layanan; ?></td>
                                              <td><?php echo "Rp. ".number_format($target->jumlah,0,'','.' ).",-"; ?></td>
                                              <td><?php echo "Rp. ".number_format($terkontrak->jumlah,0,'','.' ).",-"; ?></td>
                                              <td><?php echo "Rp. ".number_format($invoice->jumlah,0,'','.' ).",-"; ?></td>
                                              <td><?php echo "Rp. ".number_format($realisasi->jumlah,0,'','.' ).",-"; ?></td>
                                              <td><?php echo "Rp. ".number_format($invoice->jumlah - $realisasi->jumlah,0,'','.' ).",-"; ?></td>
                                              <td><?php echo "Rp. -"; ?></td>
                                              <td><?php echo "Rp. -"; ?></td>
                                            </tr>
                                            <?php $total_target = $total_target + $target->jumlah; $total_invoice = $total_invoice + $invoice->jumlah; $total_terkontrak = $total_terkontrak + $terkontrak->jumlah; $total_realisasi = $total_realisasi +  $realisasi->jumlah; } ?>
                                        </tbody>
                                        <thead class="thead-light">
                                            <tr>
                                                <th><b>TOTAL</b></th>
                                                <th><b><?php echo "Rp. ".number_format($total_target,0,'','.' ).",-"; ?></b></th>
                                                <th><b><?php echo "Rp. ".number_format($total_terkontrak,0,'','.' ).",-"; ?></b></th>
                                                <th><b><?php echo "Rp. ".number_format($total_invoice,0,'','.' ).",-"; ?></b></th>
                                                <th><b><?php echo "Rp. ".number_format($total_realisasi,0,'','.' ).",-"; ?></b></th>
                                                <th><b><?php echo "Rp. ".number_format($total_invoice - $total_realisasi,0,'','.' ).",-"; ?></b></th>
                                                <th><b><?php echo "Rp. -"; ?></b></th>
                                                <th><b><?php echo "Rp. -"; ?></b></th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                  </div>
              </div>
          </div>
      </div>
    </div> 
</div>
