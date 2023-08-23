<?php $tahun = DATE("Y"); ?>
<?php $id_satker = $this->session->userdata('admin_id_satker'); ?>
<?php $invoice = $this->db->query("SELECT * FROM termin INNER JOIN kontrak ON termin.id_kontrak = kontrak.id_kontrak WHERE termin.status_cetak_invoice = 1 AND kontrak.status='K' AND kontrak.id_satker=$id_satker")->num_rows(); ?>
<?php $realiasi = $this->db->query("SELECT * FROM termin INNER JOIN kontrak ON termin.id_kontrak = kontrak.id_kontrak WHERE termin.status_pembayaran = 1 AND kontrak.status='K' AND kontrak.id_satker=$id_satker")->num_rows(); ?>
<?php $terlambat = $this->db->query("SELECT id_termin, DATEDIFF(CURRENT_DATE(), tgl_termin) AS selisih FROM termin INNER JOIN kontrak ON termin.id_kontrak = kontrak.id_kontrak WHERE status_cetak_invoice = 1 AND status_pembayaran=0 AND DATEDIFF(CURRENT_DATE(), tgl_termin) > 30 AND kontrak.status='K' AND kontrak.id_satker=$id_satker")->num_rows();?>
<div class="container-fluid">
  <div class="row">
    <a href="<?php echo base_url(); ?>bendahara_penerimaan">
      <div class="col l4 m8 s12">
          <div class="card success-gradient card-hover">
            <div class="card-content">
                <div class="d-flex no-block align-items-center">
                    <div>
                        <h4 class="white-text m-b-5"><?php echo $invoice; ?></h4>
                        <h6 class="white-text op-5">INVOICE <?php echo $tahun; ?></h6>
                    </div>
                    <div class="ml-auto">
                      <span class="white-text display-6"><i class="material-icons">equalizer</i></span>
                    </div>
                </div>
            </div>
          </div>
      </div>
    </a>
    <a href="<?php echo base_url(); ?>bendahara_penerimaan/realisasi">
      <div class="col l4 m8 s12">
          <div class="card success-gradient card-hover">
            <div class="card-content">
                <div class="d-flex no-block align-items-center">
                    <div>
                        <h4 class="white-text m-b-5"><?php echo $realiasi; ?></h4>
                        <h6 class="white-text op-5 text-darken-2"> INVOICE REALISASI <?php echo $tahun; ?></h6>
                    </div>
                    <div class="ml-auto">
                        <span class="white-text display-6"><i class="material-icons">equalizer</i></span>
                    </div>
                </div>
            </div>
          </div>
      </div>
    </a>
    <a href="<?php echo base_url(); ?>bendahara_penerimaan/terlambat">
      <div class="col l4 m8 s12">
          <div class="card warning-gradient card-hover">
              <div class="card-content">
                  <div class="d-flex no-block align-items-center">
                      <div>
                          <h4 class="white-text m-b-5"><?php echo $terlambat; ?></h4>
                          <h6 class="white-text op-5">INVOICE TERLAMBAT <?php echo $tahun; ?></h6>
                      </div>
                      <div class="ml-auto">
                        <span class="white-text display-6"><i class="material-icons">equalizer</i></span>
                      </div>
                  </div>
              </div>
          </div>
      </div>
    </a>
  </div>
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <h4 class="card-title">Daftar Termin Pembayaran</h4>
                    <h6 class="card-subtitle">You have <?php echo $jumlah; ?> Termin</h6>
                    <table id="demo-foo-addrow2" class="table table-bordered table-hover toggle-circle" data-page-size="7">
                      <thead>
                        <tr>
                          <th width="5%" data-sort-ignore="true"><center>No.</center></th>
                          <th width="25%">Judul kontrak</th>
                          <th width="15%">Termin</th>
                          <th width="10%">Realisasi</th>
                          <th width="15%">Tanggal Realisasi</th>
                          <th width="30%" data-sort-ignore="true"><center>Action</center></th>
                        </tr>
                      </thead>
                      <div class="m-t-40">
                          <div class="d-flex">
                              <div class="ml-auto">
                                  <div class="form-group">
                                      <input id="demo-input-search2" type="text" placeholder="Search" autocomplete="off">
                                  </div>
                              </div>
                          </div>
                      </div>
                      <tbody>
                        <?php $no=1; foreach($result AS $a) { ?>
                          <tr>
                            <td><center><?php echo $no; ?></center></td>
                            <td>
                              <?= $a->nama_kontrak ?>
                              <br/>
                              <span class="label label-table label-success"><?php echo $a->nama_perusahaan; ?></span>
                              <?php $tanggal=strtotime($a->tgl_invoice); $tanggal_hari_ini=strtotime("now"); $hari = ($tanggal_hari_ini - $tanggal) / (60 * 60 * 24); ?>
                              <?php if ($a->status_pembayaran == 0) { ?>
                                <!-- <?php if ($a->jumlah_penagihan > 0) { ?>
                                  <?php $tagihan = $this->db->query("SELECT * FROM penagihan WHERE id_termin = $a->id_termin AND keterangan = $a->jumlah_penagihan")->row(); echo $penagihan->tgl_termin; echo $a->id_termin; ?>
                                <?php } ?> -->
                                <?php if ($hari >= 30) { ?>
                                  <br/>
                                  <?php if($a->jumlah_penagihan > 0) { ?>
                                    <?php $status_penagihan = $this->db->query("SELECT * FROM penagihan WHERE id_termin = $a->id_termin AND keterangan = $a->jumlah_penagihan")->row();?>
                                    <?php $tanggal_telat=strtotime($status_penagihan->tgl_termin); $tanggal_hari_ini=strtotime("now"); $hari_penagihan = ($tanggal_hari_ini - $tanggal_telat) / (60 * 60 * 24); ?>
                                    <span class="label label-table label-warning">Terlambat <?php echo ceil($hari_penagihan)." Hari";?></span>
                                  <?php } else { ?>
                                    <span class="label label-table label-warning">Terlambat <?php echo ceil($hari)." Hari";?></span>
                                  <?php } ?>
                                  <br/>
                                  <?php if($a->jumlah_penagihan < 3) { ?>
                                    <a href="<?php echo base_url();?>bendahara_penerimaan/cetak_penagihan/<?php echo $a->id_termin;?>" class="btn btn-medium" onclick="javascript: return confirm('Yakin akan mencetak surat penagihan ?')"><i class="fas fa-print"></i> Cetak Surat Penagihan</a>
                                  <?php } elseif($a->jumlah_penagihan == 3) { ?>
                                    <a href="#modalmacet<?php echo $a->id_termin;?>" class="btn btn-medium red btn-outline modal-trigger"><i class="fas fa-print"></i> Dilimpahkan ke Biro Keuangan</a>
                                  <?php } elseif($a->jumlah_penagihan > 3) { ?>
                                    <span class="label label-table label-danger">Berkas dilimpahkan ke Biro Keuangan</span>
                                  <?php } ?>
                                <?php } ?>
                              <?php } ?>
                            </td>
                            <td>
                              <center>
                                <?php if ($a->jumlah_penagihan > 0) { ?>
                                  <?php $penagihan = $this->db->query("SELECT * FROM penagihan WHERE id_termin = $a->id_termin AND keterangan = $a->jumlah_penagihan")->row();?>
                                  <?php if($a->jumlah_penagihan < 4) { ?>
                                    <a href="<?php echo base_url(); ?>bendahara_penerimaan/cetak_surat_penagihan/<?php echo $penagihan->id; ?>" target="_blank"><span class="label label-table label-danger">Termin <?php echo $a->termin; ?></span> <br> <span class="label label-table label-warning">Penagihan ke-<?php echo $a->jumlah_penagihan; ?></span></a>
                                  <?php } else { ?>
                                    <span class="label label-table label-danger">Piutang Macet</span>
                                  <?php } ?>
                                <?php } else { ?>
                                  <span class="label label-table label-danger">Termin <?php echo $a->termin; ?></span>
                                <?php } ?>
                              </center>
                            </td>
                            <td><?php echo "Rp.".number_format($a->jumlah_realisasi).",-"; ?></td>
                            <td><?php echo $this->format_tanggal->jin_date_str($a->tgl_pembayaran); ?></td>
                            <!-- <td><?php echo "Rp.".number_format($a->nilai_kontrak).",-"; ?></td> -->
                            <td>
                              <center>
                                  <a href="<?php echo base_url();?>bendahara_penerimaan/detail_kontrak/<?php echo $a->id_kontrak;?>" class="btn btn-small blue btn-outline tooltipped" data-position="top" data-delay="50" data-tooltip="Preview"><i class="fas fa-eye"></i></a>
                                <?php if($a->status_cetak_invoice == 0 && $a->status_cetak_kwitansi==0 && $a->status_realisasi == 0) { ?>
                                  <a href="<?php echo base_url();?>bendahara_penerimaan/cetak_invoice/<?php echo $a->id_termin;?>/<?php echo $a->id_jasa;?>/<?php echo $a->id_rumah_layanan;?>" class="btn btn-small green btn-outline tooltipped" data-position="top" data-delay="50" data-tooltip="Cetak Invoice" onclick="javascript: return confirm('Yakin akan mencetak invoice ?')"><i class="fas fa-print"></i></a>
                                <?php } elseif($a->status_cetak_invoice == 1 && $a->status_cetak_kwitansi==0 && $a->status_realisasi == 0) { ?>
                                  <a href="<?php echo base_url();?>bendahara_penerimaan/preview_invoice/<?php echo $a->id_termin;?>" class="btn btn-small green btn-outline tooltipped" data-position="top" data-delay="50" data-tooltip="<?php echo $a->no_invoice; ?>" target="_blank"><i class="fas fa-check-circle"></i></a>
                                  <a href="<?php echo base_url();?>bendahara_penerimaan/cetak_kwitansi/<?php echo $a->id_termin;?>/<?php echo $a->id_jasa;?>/<?php echo $a->id_rumah_layanan;?>" class="btn btn-small orange btn-outline tooltipped" data-position="top" data-delay="50" data-tooltip="Cetak Kwitansi" onclick="javascript: return confirm('Yakin akan mencetak kwitansi ?')"><i class="fas fa-print"></i></a>
                                <?php } elseif($a->status_cetak_invoice == 1 && $a->status_cetak_kwitansi==1 && $a->status_realisasi == 0) { ?>
                                  <a href="<?php echo base_url();?>bendahara_penerimaan/preview_invoice/<?php echo $a->id_termin;?>" class="btn btn-small green btn-outline tooltipped" data-position="top" data-delay="50" data-tooltip="<?php echo $a->no_invoice; ?>" target="_blank"><i class="fas fa-check-circle"></i></a>
                                  <a href="<?php echo base_url();?>bendahara_penerimaan/preview_kwitansi/<?php echo $a->id_termin;?>" class="btn btn-small orange btn-outline tooltipped" data-position="top" data-delay="50" data-tooltip="<?php echo $a->no_kwitansi; ?>" target="_blank"><i class="fas fa-check-circle"></i></a>
                                  <a href="#modalrealisasi<?php echo $a->id_termin;?>" class="btn btn-small red btn-outline tooltipped modal-trigger" data-position="top" data-delay="50" data-tooltip="Input Realisasi"><i class="fas fa-check-circle"></i></a>
                              <?php } elseif($a->status_cetak_invoice == 1 && $a->status_cetak_kwitansi==1 && $a->status_realisasi == 1) { ?>
                                <a href="<?php echo base_url();?>bendahara_penerimaan/preview_invoice/<?php echo $a->id_termin;?>" class="btn btn-small green btn-outline tooltipped" data-position="top" data-delay="50" data-tooltip="<?php echo $a->no_invoice; ?>" target="_blank"><i class="fas fa-check-circle"></i></a>
                                <a href="<?php echo base_url();?>bendahara_penerimaan/preview_kwitansi/<?php echo $a->id_termin;?>" class="btn btn-small green btn-outline tooltipped" data-position="top" data-delay="50" data-tooltip="<?php echo $a->no_kwitansi; ?>" target="_blank"><i class="fas fa-check-circle"></i></a>
                                  <a href="#" class="btn btn-small green btn-outline"><i class="fas fa-check-circle"></i> Realisasi</a>
                                <?php } ?>
                              </center>
                            </td>
                          </tr>
                        <?php $no=$no+1; } ?>
                      </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="6">
                                    <div class="text-right">
                                        <ul class="pagination">
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
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
                                <input id="a1" type="number" name ="jumlah_realisasi" value="<?php echo $a->jumlah; ?>" hidden>
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
                                <button class="btn cyan waves-effect waves-light left" type="submit" name="action">Simpan</button>
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
        </div>
    </div>
</div>
