<?php $tahun = DATE("Y"); ?>
<?php $id_satker = $this->session->userdata('admin_id_satker'); ?>
<?php $invoice = $this->db->query("SELECT * FROM termin INNER JOIN kontrak ON termin.id_kontrak = kontrak.id_kontrak WHERE termin.status_cetak_invoice = 1 AND kontrak.status='K' AND kontrak.id_satker=$id_satker")->num_rows(); ?>
<?php $realiasi = $this->db->query("SELECT * FROM termin INNER JOIN kontrak ON termin.id_kontrak = kontrak.id_kontrak WHERE termin.status_pembayaran = 1 AND kontrak.status='K' AND kontrak.id_satker=$id_satker")->num_rows(); ?>
<?php $terlambat = $this->db->query("SELECT id_termin, DATEDIFF(CURRENT_DATE(), tgl_termin) AS selisih FROM termin INNER JOIN kontrak ON termin.id_kontrak = kontrak.id_kontrak WHERE status_cetak_invoice = 1 AND status_pembayaran=0 AND DATEDIFF(CURRENT_DATE(), tgl_termin) > 30 AND kontrak.status='K' AND kontrak.id_satker=$id_satker")->num_rows();?>
<div id="main">
      <div class="row">
        <div class="col s12">
            <div class="container">
                <div class="section section-data-tables">
                  <div id="card-stats" class="pt-0">
                      <div class="row">
                          <a href="<?php echo base_url(); ?>bendahara_penerimaan">
                          <div class="col s12 m6 l4">
                              <div class="card animate fadeLeft">
                                  <div class="card-content cyan white-text">
                                      <p class="card-stats-title">INVOICE <?php echo $tahun; ?></p>
                                      <h4 class="card-stats-number white-text"><?php echo $invoice; ?></h4>
                                  </div>
                              </div>
                          </div>
                          </a>
                          <a href="<?php echo base_url(); ?>bendahara_penerimaan/realisasi">
                          <div class="col s12 m6 l4">
                              <div class="card animate fadeLeft">
                                  <div class="card-content red accent-2 white-text">
                                      <p class="card-stats-title">INVOICE REALISASI <?php echo $tahun; ?></p>
                                      <h4 class="card-stats-number white-text"><?php echo $realiasi; ?></h4>
                                  </div>
                              </div>
                          </div>
                          </a>
                          <a href="<?php echo base_url(); ?>bendahara_penerimaan/terlambat">
                          <div class="col s12 m6 l4">
                              <div class="card animate fadeRight">
                                  <div class="card-content orange lighten-1 white-text">
                                      <p class="card-stats-title">INVOICE TERLAMBAT <?php echo $tahun; ?></p>
                                      <h4 class="card-stats-number white-text"><?php echo $terlambat; ?></h4>
                                  </div>
                              </div>
                          </div>
                          </a>
                      </div>
                  </div>
                  <div class="card">
                      <div class="card-content">
                          <!-- <h4 class="card-title">Daftar Kontrak</h4> -->
                          <div class="row">
                              <div class="col s12">
                                <table id="example" class="display table table-bordered" cellspacing="0" width="100%">
                                      <thead>
                                          <tr>
                                            <th style="text-align:center;" width="5%">No.</th>
                                            <th style="text-align:center;" width="50%">Judul kontrak</th>
                                            <th style="text-align:center;" width="10%">Jumlah Pengajuan</th>
                                            <th style="text-align:center;" width="10%">Jumlah Realisasi</th>
                                            <th style="text-align:center;" width="25%">Action</th>
                                            <!-- <th style="text-align:center;" width="10%">Realisasi</th> -->
                                            <!-- <th style="text-align:center;" width="15%">Tgl Realisasi</th> -->
                                            <!-- <th style="text-align:center;">Action</th> -->
                                          </tr>
                                      </thead>
                                      <tbody>
                                        <?php $no=1; foreach($result AS $a) { ?>
                                          <tr>
                                            <td style="text-align:center;"><?php echo $no; ?></td>
                                            <td>
                                              <b><?= $a->nama_kontrak ?></b><br/>
                                              <span class="badge gradient-45deg-light-blue-cyan" style="font-size: 11px;"><?php echo $a->nama_perusahaan; ?></span>
                                              <?php $tanggal=strtotime($a->tgl_invoice); $tanggal_hari_ini=strtotime("now"); $hari = ($tanggal_hari_ini - $tanggal) / (60 * 60 * 24); ?>
                                              <?php if ($a->status_pembayaran == 0) { ?>
                                                <?php if ($hari >= 30) { ?>
                                                    <?php if($a->jumlah_penagihan > 0) { ?>
                                                      <?php $status_penagihan = $this->db->query("SELECT * FROM penagihan WHERE id_termin = $a->id_termin AND keterangan = $a->jumlah_penagihan")->row();?>
                                                      <?php $tanggal_telat=strtotime($status_penagihan->tgl_termin); $tanggal_hari_ini=strtotime("now"); $hari_penagihan = ($tanggal_hari_ini - $tanggal_telat) / (60 * 60 * 24); ?>
                                                      <span class="badge gradient-45deg-purple-deep-orange" style="font-size: 11px;">Terlambat <?php echo ceil($hari_penagihan)." Hari";?></span>
                                                    <?php } else { ?>
                                                      <span class="badge gradient-45deg-purple-deep-orange" style="font-size: 11px;">Terlambat <?php echo ceil($hari)." Hari";?></span>
                                                    <?php } ?>
                                                  <?php } ?>
                                                <?php } ?>
                                                <?php if ($a->jumlah_penagihan > 0) { ?>
                                                  <?php $penagihan = $this->db->query("SELECT * FROM penagihan WHERE id_termin = $a->id_termin AND keterangan = $a->jumlah_penagihan")->row();?>
                                                  <?php if($a->jumlah_penagihan < 4) { ?>
                                                    <span class="badge green" style="font-size: 11px;">Termin <?php echo $a->termin; ?> </span> <br> <a href="<?php echo base_url(); ?>bendahara_penerimaan/cetak_surat_penagihan/<?php echo $penagihan->id; ?>" target="_blank"><span class="badge gradient-45deg-indigo-light-blue" style="font-size: 11px;">Penagihan ke-<?php echo $a->jumlah_penagihan; ?></span></a>
                                                  <?php } else { ?>
                                                    <span class="badge red">Piutang Macet</span>
                                                  <?php } ?>
                                                <?php } else { ?>
                                                  <span class="badge green" style="font-size: 11px;">Termin <?php echo $a->keterangan_termin; ?></span>
                                                <?php } ?>
                                                <br>
                                                <br>

                                            </td>
                                            <td style="font-size: 12px;text-align:center;"><?php echo "Rp.".number_format($a->jumlah).",-"; ?></td>
                                            <td style="font-size: 12px;text-align:center;"><?php echo "Rp.".number_format($a->jumlah_realisasi).",-"; ?></td>
                                            <td style="font-size: 12px;text-align:center;">
                                              <a href="<?php echo base_url();?>bendahara_penerimaan/detail_kontrak/<?php echo $a->id_kontrak;?>" class="btn-floating blue tooltipped" data-position="top" data-tooltip="Preview"><i class="material-icons right">remove_red_eye</i></a>
                                              <?php if ($a->status_pembayaran == 0) { ?>
                                                <?php if ($hari >= 30) { ?>
                                                    <?php if($a->jumlah_penagihan < 3) { ?>
                                                      <a href="<?php echo base_url();?>bendahara_penerimaan/cetak_penagihan/<?php echo $a->id_termin;?>" class="btn-floating red tooltipped" data-position="top" data-tooltip="Cetak Surat Penagihan" onclick="javascript: return confirm('Yakin akan mencetak surat penagihan ?')"><i class="material-icons left">print</i></a>
                                                    <?php } elseif($a->jumlah_penagihan == 3) { ?>
                                                      <a href="#modalmacet<?php echo $a->id_termin;?>" class="btn-floating red tooltipped modal-trigger" data-position="top" data-tooltip="Dilimpahkan ke Biro Keuangan" onclick="javascript: return confirm('Yakin akan dilimpahkan ke biro keuangan ?')"><i class="material-icons left">send</i></a>
                                                    <?php } elseif($a->jumlah_penagihan > 3) { ?>
                                                      <a class="btn-floating red tooltipped" data-position="top" data-tooltip="Berkas dilimpahkan ke Biro Keuangan"><i class="material-icons left">check_circle</i></a>
                                                    <?php } ?>
                                                  <?php } ?>
                                                <?php } ?>
                                            <?php if($a->status_cetak_invoice == 0 && $a->status_cetak_kwitansi==0 && $a->status_realisasi == 0) { ?>
                                              <a href="<?php echo base_url();?>bendahara_penerimaan/cetak_invoice/<?php echo $a->id_termin;?>/<?php echo $a->id_jasa;?>/<?php echo $a->id_rumah_layanan;?>" class="btn-floating green tooltipped" data-position="top" data-tooltip="Cetak Invoice" onclick="javascript: return confirm('Yakin akan mencetak invoice ?')"><i class="material-icons right">print</i></a>
                                            <?php } elseif($a->status_cetak_invoice == 1 && $a->status_cetak_kwitansi==0 && $a->status_realisasi == 0) { ?>
                                              <a href="<?php echo base_url();?>bendahara_penerimaan/preview_invoice/<?php echo $a->id_termin;?>" class="btn-floating green tooltipped" data-position="top" data-tooltip="<?php echo "No. Invoice : ".$a->no_invoice; ?>" target="_blank"><i class="material-icons right">check_circle</i></a>
                                              <a href="<?php echo base_url();?>bendahara_penerimaan/cetak_kwitansi/<?php echo $a->id_termin;?>/<?php echo $a->id_jasa;?>/<?php echo $a->id_rumah_layanan;?>" class="btn-floating orange tooltipped" data-position="top" data-tooltip="Cetak Kuitansi" onclick="javascript: return confirm('Yakin akan mencetak kuitansi ?')"><i class="material-icons right">print</i></a>
                                            <?php } elseif($a->status_cetak_invoice == 1 && $a->status_cetak_kwitansi==1 && $a->status_realisasi == 0) { ?>
                                              <a href="<?php echo base_url();?>bendahara_penerimaan/preview_invoice/<?php echo $a->id_termin;?>" class="btn-floating green tooltipped" data-position="top" data-tooltip="<?php echo "No. Invoice : ".$a->no_invoice; ?>" target="_blank"><i class="material-icons right">check_circle</i></a>
                                              <a href="<?php echo base_url();?>bendahara_penerimaan/preview_kwitansi/<?php echo $a->id_termin;?>" class="btn-floating green tooltipped" data-position="top" data-tooltip="<?php echo "No. Kuitansi : ".$a->no_kwitansi; ?>" target="_blank"><i class="material-icons right">check_circle</i></a>
                                              <a href="#modalrealisasi<?php echo $a->id_termin;?>" class="btn-floating red tooltipped modal-trigger" data-position="top" data-tooltip="Input Realisasi"><i class="material-icons right">report_problem</i></a>
                                          <?php } elseif($a->status_cetak_invoice == 1 && $a->status_cetak_kwitansi==1 && $a->status_realisasi == 1) { ?>
                                              <a href="<?php echo base_url();?>bendahara_penerimaan/preview_invoice/<?php echo $a->id_termin;?>" class="btn-floating green tooltipped" data-position="top" data-tooltip="<?php echo "No. Invoice : ".$a->no_invoice; ?>" target="_blank"><i class="material-icons right">check_circle</i></a>
                                              <a href="<?php echo base_url();?>bendahara_penerimaan/preview_kwitansi/<?php echo $a->id_termin;?>" class="btn-floating green tooltipped" data-position="top" data-tooltip="<?php echo "No. Kuitansi : ".$a->no_kwitansi; ?>" target="_blank"><i class="material-icons right">check_circle</i></a>
                                              <a href="#" class="btn-floating green tooltipped" data-position="top" data-tooltip="<?php echo "Rp.".number_format($a->jumlah_realisasi).",-"; ?> Tanggal (<?php echo $this->format_tanggal->jin_date_str($a->tgl_pembayaran); ?>)"><i class="material-icons right">check_circle</i></a>
                                            <?php } ?>
                                            </td>
                                            <!-- <td style="text-align:center;">
                                              <?php if($a->jumlah_realisasi == NULL) { ?>
                                                <span class="badge red">Belum ada Realisasi</span>
                                              <?php } else { ?>
                                                <span class="badge green"><?php echo $this->format_tanggal->jin_date_str($a->tgl_pembayaran); ?></span>&nbsp;<span class="badge green"><?php echo "Rp.".number_format($a->jumlah_realisasi).",-"; ?></span>
                                              <?php } ?>
                                            </td> -->

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
    </div>
</div>

<?php foreach ($result as $a) { ?>
  <div id="modalrealisasi<?php echo $a->id_termin; ?>" class="modal">
      <div class="modal-content">
          <h4>Realisasi</h4>
            <?php echo form_open_multipart('bendahara_penerimaan/input_realisasi');?>
              <div class="row">
                  <div class="input-field col s12">
                    <input id="id_termin" type="text" name="id_termin" value="<?php echo $a->id_termin; ?>" hidden>
                    <input id="a1" type="number" name ="jumlah_realisasi" value="<?php echo $a->jumlah; ?>">
                      <select name="id_penerimaan" required>
                          <option value="" disabled selected>Pilih Akun Penerimaan</option>
                          <?php foreach ($result_penerimaan as $a) { ?>
                            <option value="<?php echo $a->id_akun; ?>"><?php echo $a->kode." - ".$a->nama_akun; ?></option>
                          <?php } ?>
                      </select>
                  </div>
              </div>
              <div class="row">
                  <div class="input-field col s12">
                    <input id="a9" type="date" name = "tgl_pembayaran" required>
                    <label for="a9">Tanggal Pembayaran</label>
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
<?php } ?>
  <?php foreach ($result as $a) { ?>
  <div id="modalmacet<?php echo $a->id_termin; ?>" class="modal">
      <div class="modal-content">
          <h4>Keterangan</h4>
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
<?php } ?>
