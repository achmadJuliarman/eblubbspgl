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
                  <h4 class="card-header font-18 mt-0"><center>MENU BENDAHARA</center></h4>
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
                            <a class="btn btn-primary btn-lg waves-effect waves-light" href="<?php echo base_url(); ?>bendahara_penerimaan/list_kontrak/1"> <span>PO LAB PENGUJIAN</span> </a>
                            <a class="btn btn-warning btn-lg waves-effect waves-light" href="<?php echo base_url(); ?>bendahara_penerimaan/list_kontrak/2"> <span>PO GEDUNG</span> </a>
                            <a class="btn btn-success btn-lg waves-effect waves-light" href="<?php echo base_url(); ?>bendahara_penerimaan/list_kontrak/3"> <span>PO WISMA</span> </a>
                            <a class="btn btn-info btn-lg waves-effect waves-light" href="<?php echo base_url(); ?>bendahara_penerimaan/list_kontrak/4"> <span>PO LAINNYA</span> </a>
                            <a class="btn btn-danger btn-lg waves-effect waves-light" href="<?php echo base_url(); ?>bendahara_penerimaan/list_kontrak/5"> <span>BERITA ACARA</span> </a>
                          </h1>
                        </center>
                  </div>
              </div>
          </div>
          <div class="col-lg-4">
              <div class="card m-b-30 text-white bg-primary">
                  <div class="card-body">
                    <p class="card-stats-title">INVOICE <?php echo $tahun; ?></p>
                    <h4 class="card-stats-number white-text"><?php echo $invoice; ?></h4>
                  </div>
              </div>
          </div>
          <div class="col-lg-4">
              <div class="card m-b-30 text-white bg-primary">
                  <div class="card-body">
                    <p class="card-stats-title">INVOICE REALISASI <?php echo $tahun; ?></p>
                    <h4 class="card-stats-number white-text"><?php echo $realiasi; ?></h4>
                  </div>
              </div>
          </div>
          <div class="col-lg-4">
              <div class="card m-b-30 text-white bg-primary">
                  <div class="card-body">
                    <p class="card-stats-title">INVOICE TERLAMBAT <?php echo $tahun; ?></p>
                    <h4 class="card-stats-number white-text"><?php echo $terlambat; ?></h4>
                  </div>
              </div>
          </div>
          <div class="col-lg-12">
              <div class="card m-b-30">
                  <h4 class="card-header font-18 mt-0"><center>TERMIN PEMBAYARAN</center></h4>
                  <div class="card-body">
                    <div class="table-responsive">
                                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead class="thead-light">
                                          <tr>
                                            <th style="text-align:center;" width="5%">No.</th>
                                            <th style="text-align:center;" width="60%">Judul kontrak</th>
                                            <th style="text-align:center;" width="10%">Jumlah</th>
                                            <th style="text-align:center;" width="25%">Action</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <?php $no=1; foreach($result AS $a) { ?>
                                            <tr>
                                              <td style="text-align:center;"><?php echo $no; ?></td>
                                              <td>
                                                <b><?= $a->nama_kontrak ?></b><br/>
                                                <span class="badge badge-primary" style="font-size: 11px;"><?php echo $a->nama_perusahaan; ?></span>
                                                <?php if (is_null(strtotime($a->tgl_invoice))) {$hari=0;}else{$tanggal=strtotime($a->tgl_invoice); $tanggal_hari_ini=strtotime("now"); $hari = ($tanggal_hari_ini - $tanggal) / (60 * 60 * 24); }?>
                                                <?php if ($a->status_pembayaran == 0) { ?>
                                                  <?php if ($hari >= 30) { ?>
                                                      <?php if($a->jumlah_penagihan > 0) { ?>
                                                        <?php $status_penagihan = $this->db->query("SELECT * FROM penagihan WHERE id_termin = $a->id_termin AND keterangan = $a->jumlah_penagihan")->row();?>
                                                        <?php $tanggal_telat=strtotime($status_penagihan->tgl_termin); $tanggal_hari_ini=strtotime("now"); $hari_penagihan = ($tanggal_hari_ini - $tanggal_telat) / (60 * 60 * 24); ?>
                                                        <span class="badge badge-danger" style="font-size: 11px;">Terlambat <?php echo ceil($hari_penagihan)." Hari";?></span>
                                                      <?php } else { ?>
                                                        <span class="badge badge-danger" style="font-size: 11px;">Terlambat <?php echo ceil($hari)." Hari";?></span>
                                                      <?php } ?>
                                                    <?php } ?>
                                                  <?php } ?>
                                                  <?php if ($a->jumlah_penagihan > 0) { ?>
                                                    <?php $penagihan = $this->db->query("SELECT * FROM penagihan WHERE id_termin = $a->id_termin AND keterangan = $a->jumlah_penagihan")->row();?>
                                                    <?php if($a->jumlah_penagihan < 4) { ?>
                                                      <span class="badge badge-success" style="font-size: 11px;">Termin <?php echo $a->termin; ?> </span> <br> <a href="<?php echo base_url(); ?>bendahara_penerimaan/cetak_surat_penagihan/<?php echo $penagihan->id; ?>" target="_blank"><span class="badge badge-warning" style="font-size: 11px;">Penagihan ke-<?php echo $a->jumlah_penagihan; ?></span></a>
                                                    <?php } else { ?>
                                                      <span class="badge badge-danger" style="font-size: 11px;">Piutang Macet</span>
                                                    <?php } ?>
                                                  <?php } else { ?>
                                                    <span class="badge badge-success" style="font-size: 11px;">Termin <?php echo $a->termin; ?></span>
                                                  <?php } ?>
                                              </td>
                                              <td style="text-align:center;"><?php echo "Rp.".number_format($a->jumlah).",-"; ?></td>
                                              <td style="text-align:center;">
                                                <a href="<?php echo base_url();?>bendahara_penerimaan/detail_kontrak/<?php echo $a->id_kontrak;?>" class="btn btn-primary waves-effect waves-light m-b-5"><i class="fas fa-eye"></i> View</a>
                                              <?php if($a->status_cetak_invoice == 0 && $a->status_cetak_kwitansi==0 && $a->status_realisasi == 0) { ?>
                                                <a href="<?php echo base_url();?>bendahara_penerimaan/cetak_invoice/<?php echo $a->id_termin;?>/<?php echo $a->id_jasa;?>/<?php echo $a->id_rumah_layanan;?>" class="btn btn-success waves-effect waves-light m-b-5 tooltipped" data-toggle="tooltip" data-placement="top" title="Cetak Invoice" onclick="javascript: return confirm('Yakin akan mencetak invoice ?')"><i class="fas fa-print"></i></a>
                                              <?php } elseif($a->status_cetak_invoice == 1 && $a->status_cetak_kwitansi==0 && $a->status_realisasi == 0) { ?>
                                                <a href="<?php echo base_url();?>bendahara_penerimaan/preview_invoice/<?php echo $a->id_termin;?>" class="btn btn-success waves-effect waves-light m-b-5" data-toggle="tooltip" data-placement="top" title="<?php echo "No. Invoice : ".$a->no_invoice; ?>" target="_blank"><i class="fas fa-check"></i></a>
                                                <a href="<?php echo base_url();?>bendahara_penerimaan/cetak_kwitansi/<?php echo $a->id_termin;?>/<?php echo $a->id_jasa;?>/<?php echo $a->id_rumah_layanan;?>" class="btn-floating orange tooltipped" data-toggle="tooltip" data-placement="top" title="Cetak Kwitansi" onclick="javascript: return confirm('Yakin akan mencetak kwitansi ?')"><i class="fas fa-print"></i></a>
                                              <?php } elseif($a->status_cetak_invoice == 1 && $a->status_cetak_kwitansi==1 && $a->status_realisasi == 0) { ?>
                                                <a href="<?php echo base_url();?>bendahara_penerimaan/preview_invoice/<?php echo $a->id_termin;?>" class="btn btn-success waves-effect waves-light m-b-5" data-toggle="tooltip" data-placement="top" title="<?php echo "No. Invoice : ".$a->no_invoice; ?>" target="_blank"><i class="fas fa-check"></i></a>
                                                <a href="<?php echo base_url();?>bendahara_penerimaan/preview_kwitansi/<?php echo $a->id_termin;?>" class="btn btn-success waves-effect waves-light m-b-5" data-toggle="tooltip" data-placement="top" title="<?php echo "No. Kwitansi : ".$a->no_kwitansi; ?>" target="_blank"><i class="fas fa-check"></i></a>
                                                <a href="#modalrealisasi<?php echo $a->id_termin;?>" class="btn btn-danger waves-effect waves-light m-b-5" data-target=".modalrealisasi<?php echo $a->id_termin; ?>" data-toggle="modal"><i class="fas fa-exclamation-circle"></i></a>
                                            <?php } elseif($a->status_cetak_invoice == 1 && $a->status_cetak_kwitansi==1 && $a->status_realisasi == 1) { ?>
                                                <a href="<?php echo base_url();?>bendahara_penerimaan/preview_invoice/<?php echo $a->id_termin;?>" class="btn btn-success waves-effect waves-light m-b-5" data-toggle="tooltip" data-placement="top" title="<?php echo "No. Invoice : ".$a->no_invoice; ?>" target="_blank"><i class="fas fa-check"></i></a>
                                                <a href="<?php echo base_url();?>bendahara_penerimaan/preview_kwitansi/<?php echo $a->id_termin;?>" class="btn btn-success waves-effect waves-light m-b-5" data-toggle="tooltip" data-placement="top" title="<?php echo "No. Kwiwansi : ".$a->no_kwitansi; ?>" target="_blank"><i class="fas fa-check"></i></a>
                                                <a href="#" class="btn btn-success waves-effect waves-light m-b-5" data-toggle="tooltip" data-placement="top" title="<?php echo "Rp.".number_format($a->jumlah_realisasi).",-"; ?> Tanggal (<?php echo $this->format_tanggal->jin_date_str($a->tgl_pembayaran); ?>)"><i class="fas fa-check"></i></a>
                                              <?php } ?>

                                              <?php if ($a->status_pembayaran == 0) { ?>
                                                <?php if ($hari >= 30) { ?>
                                                    <?php if($a->jumlah_penagihan < 3) { ?>
                                                      <br>
                                                      <a href="<?php echo base_url();?>bendahara_penerimaan/cetak_penagihan/<?php echo $a->id_termin;?>" class="btn btn-danger waves-effect waves-light m-b-5" title="Cetak Surat Penagihan" onclick="javascript: return confirm('Yakin akan mencetak surat penagihan ?')"><i class="fas fa-print"></i> Cetak Penagihan</a>
                                                    <?php } elseif($a->jumlah_penagihan == 3) { ?>
                                                      <br>
                                                      <a href="#modalmacet<?php echo $a->id_termin;?>" class="btn-floating red tooltipped modal-trigger" data-toggle="tooltip" data-placement="top" title="Dilimpahkan ke Biro Keuangan" onclick="javascript: return confirm('Yakin akan dilimpahkan ke biro keuangan ?')"><i class="material-icons left">send</i></a>
                                                    <?php } elseif($a->jumlah_penagihan > 3) { ?>
                                                      <br>
                                                      <a href="#" class="btn btn-danger waves-effect waves-light m-b-5"><i class="fas fa-check"></i> Berkas dilimpahkan ke Biro Keuangan</a>
                                                    <?php } ?>
                                                  <?php } ?>
                                                <?php } ?>
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

<?php foreach ($result as $a) { ?>
  <div class="modal fade modalrealisasi<?php echo $a->id_termin; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title mt-0" id="myLargeModalLabel">Realisasi</h5>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <?php echo form_open_multipart('bendahara_penerimaan/input_realisasi', 'id="form"');?>
        <div class="modal-body">
            <div class="row">
                <div class="input-field col s12">
                  <input id="id_termin" type="text" name="id_termin" value="<?php echo $a->id_termin; ?>" hidden>
                  <input id="a1" type="number" name ="jumlah_realisasi" value="<?php echo $a->jumlah; ?>" hidden>
                </div>
            </div>
            <div class="form-group row">
                <label for="example-date-input" class="col-sm-3 col-form-label">Akun Penerimaan</label>
                <div class="col-sm-9">
                  <select class="form-control select2" name="id_penerimaan" required>
                      <option value="" disabled selected>Pilih Akun Penerimaan</option>
                      <?php foreach ($result_penerimaan as $a) { ?>
                        <option value="<?php echo $a->id_akun; ?>"><?php echo $a->kode." - ".$a->nama_akun; ?></option>
                      <?php } ?>
                  </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="example-date-input" class="col-sm-3 col-form-label">Tanggal Pembayaran</label>
                <div class="col-sm-4">
                    <input class="form-control" type="date" id="example-date-input" name="tgl_pembayaran" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="example-date-input" class="col-sm-3 col-form-label"></label>
                <div class="col-sm-4">
                  <button type="submit" class="btn btn-success" onclick="javascript: return confirm('Yakin akan menyimpan data ?')">Simpan</button>
                </div>
            </div>
          </div>
        </form>
        </div>
      </div>
  </div>
<?php } ?>
  <?php foreach ($result as $a) { ?>
  <div class="modal fade modalmacet<?php echo $a->id_termin; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title mt-0" id="myLargeModalLabel">Keterangan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <div class="modal-body">
            <?php echo form_open_multipart('bendahara_penerimaan/piutang_macet');?>
              <div class="row">
                  <div class="input-field col s12">
                    <input id="id_termin" type="text" name="id_termin" value="<?php echo $a->id_termin; ?>" hidden>
                    <textarea name="keterangan"></textarea>
                  </div>
              </div>
            <div class="row">
                <div class="input-field col s12">
                    <button class="btn cyan waves-effect waves-light left" type="submit" name="action" onclick="javascript: return confirm('Yakin akan menyimpan data ?')">Simpan</button>
                </div>
            </div>
          </form>
        </div>
        </div>
    </div>
  </div>
<?php } ?>
