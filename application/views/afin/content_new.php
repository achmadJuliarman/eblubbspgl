<?php $tahun = DATE("Y"); ?>
<?php $id_satker = $this->session->userdata('admin_id_satker'); ?>
<?php $invoice = $this->db->query("SELECT * FROM termin INNER JOIN kontrak ON termin.id_kontrak = kontrak.id_kontrak WHERE termin.status_cetak_invoice = 1 AND kontrak.status='K' AND kontrak.id_satker=$id_satker")->num_rows(); ?>
<?php $realiasi = $this->db->query("SELECT * FROM termin INNER JOIN kontrak ON termin.id_kontrak = kontrak.id_kontrak WHERE termin.status_pembayaran = 1 AND kontrak.status='K' AND kontrak.id_satker=$id_satker")->num_rows(); ?>
<?php $terlambat = $this->db->query("SELECT id_termin, DATEDIFF(CURRENT_DATE(), tgl_termin) AS selisih FROM termin INNER JOIN kontrak ON termin.id_kontrak = kontrak.id_kontrak WHERE status_cetak_invoice = 1 AND status_pembayaran=0 AND DATEDIFF(CURRENT_DATE(), tgl_termin) > 30 AND kontrak.status='K' AND kontrak.id_satker=$id_satker")->num_rows();?>
<div class="wrapper">
    <div class="container-fluid">
      <div class="row">

          <!-- <div class="col-lg-12">
              <div class="card m-b-10 text-white bg-primary">
                  <div class="card-body">
                    <p>
                      <h5>SELAMAT DATANG, <?php echo $this->session->userdata('admin_nama'); ?></h5>
                      <h6><?php echo $this->session->userdata('admin_nama_satker'); ?></h6>
                    </p>
                  </div>
              </div>
          </div> -->
          <div class="col-lg-12">
              <div class="card m-b-30">
                  <h4 class="card-header font-18 mt-0"><center>MENU AFIN</center></h4>
                  <div class="card-body">
                    <center>
                      <p>
                        <h5>SELAMAT DATANG, <?php echo $this->session->userdata('admin_nama'); ?></h5>
                        <h6><?php echo $this->session->userdata('admin_nama_satker'); ?></h6>
                      </p>
                    </center>
                      <!-- <p class="card-text">With supporting text below as a natural lead-in to
                          additional content.</p> -->
                        <center>
                          <h1>
                            <a class="btn btn-secondary btn-lg waves-effect waves-light" href="<?php echo base_url(); ?>perusahaan"> <span>CLIENT</span> </a>
                            <a class="btn btn-primary btn-lg waves-effect waves-light" href="<?php echo base_url(); ?>bendahara_penerimaan/list_kontrak/1"> <span>KONTRAK</span> </a>
                          </h1>
                        </center>
                  </div>
              </div>
          </div>
          <div class="col-lg-4">
              <div class="card m-b-30 text-white bg-primary">
                  <div class="card-body">
                    <p class="card-stats-title">JUMLAH KONTRAK</p>
                    <h4 class="card-stats-number white-text"><?php echo $jumlah_kontrak; ?></h4>
                  </div>
              </div>
          </div>
          <div class="col-lg-4">
              <div class="card m-b-30 text-white bg-primary">
                  <div class="card-body">
                    <p class="card-stats-title">JUMLAH KONTRAK ADENDUM</p>
                    <h4 class="card-stats-number white-text"><?php echo $adendum; ?></h4>
                  </div>
              </div>
          </div>
          <div class="col-lg-4">
              <div class="card m-b-30 text-white bg-primary">
                  <div class="card-body">
                    <p class="card-stats-title">KONTRAK BERAKHIR BULAN INI</p>
                    <h4 class="card-stats-number white-text"><?php echo $expired; ?></h4>
                  </div>
              </div>
          </div>
          <div class="col-lg-12">
              <div class="card m-b-30">
                  <h4 class="card-header font-18 mt-0"><center>DATA KONTRAK</center></h4>
                  <div class="card-body">
                    <div class="table-responsive">
                                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead class="thead-light">
                                          <tr>
                                            <th style="text-align:center;" width="5%">No.</th>
                                            <th style="text-align:center;" width="40%">Judul kontrak</th>
                                            <th style="text-align:center;" width="30%">Tgl Pelaksanaan</th>
                                            <th style="text-align:center;" width="15%">Nilai Kontrak</th>
                                            <th style="text-align:center;" width="10%">Action</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <?php $no=1; foreach($result AS $a) { ?>
                                            <tr>
                                              <td style="text-align:center;"><?php echo $no; ?></td>
                                              <td>
                                                <b><?= $a->nama_kontrak ?></b><br/>
                                                <span class="badge badge-primary" style="font-size: 11px;"><?php echo $a->nama_perusahaan; ?></span>
                                                <span class="badge badge-success" style="font-size: 11px;"><?php echo $a->nama; ?></span>
                                                <br>
                                                <?php echo $a->no_kontrak; ?></strong> (Tanggal : <?php echo $this->format_tanggal->jin_date_str($a->tgl_ttd); ?>)
                                              </td>
                                              <td style="text-align:center;"><?php echo $this->format_tanggal->jin_date_str($a->tgl_mulai); ?> s/d <?php echo $this->format_tanggal->jin_date_str($a->tgl_akhir); ?></td>
                                              <td style="text-align:center;"><?php echo "Rp.".number_format($a->nilai_kontrak).",-"; ?></td>
                                              <td style="text-align:center;">
                                                  <a href="<?php echo base_url();?>afin/adendum_kontrak/<?php echo $a->id_kontrak;?>" class="btn btn-info mo-mb-2" data-toggle="tooltip" data-placement="top" title="Adendum"><i class="fas fa-paper-plane"></i></a>
                                                  <a href="<?php echo base_url();?>afin/pilih_kontrak/<?php echo $a->id_kontrak;?>" class="btn btn-warning mo-mb-2" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a>
                                                  <?php $cek_kegiatan = $this->db->query("SELECT * FROM kegiatan WHERE id_kontrak = $a->id_kontrak;")->num_rows(); ?>
                                                  <?php $cek_ro = $this->db->query("SELECT * FROM rencana_operasional WHERE id_kontrak = $a->id_kontrak;")->num_rows(); ?>
                                                  <?php if($cek_kegiatan == 0 && $cek_ro == 0) { ?>
                                                  <a href="<?php echo base_url();?>afin/hapus_kontrak/<?php echo $a->id_kontrak;?>" class="btn btn-danger mo-mb-2" onclick="javascript: return confirm('Yakin akan menghapus data ?')" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fas fa-trash"></i></a>
                                                <?php }  ?>
                                              </td>
                                            </tr>
                                          <?php $no=$no+1; } ?>
                                        </tbody>
                                    </table>
                                </div>
                  </div>
              </div>
          </div>
      </div>
    </div>
</div>
