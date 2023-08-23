<div id="main">
      <div class="row">
        <div class="col s12">
            <div class="container">
                <div class="section section-data-tables">
                  <div class="card">
                      <div class="card-content">
                          <h4 class="card-title">Daftar Pengajuan Operasional</h4>
                          <!-- <?php if($cek > 0) { ?>
                            <a href="<?php echo base_url();?>bendahara_pengeluaran/sync" class="btn mb-1 waves-effect waves-light red mr-1" onclick="javascript: return confirm('Yakin akan menyimpan data?')">Sync BIOS (<?php echo $cek; ?>)<i class="material-icons left">info</i></a>
                          <?php } else { ?>
                            <a href="#" class="btn mb-1 waves-effect waves-light green mr-1">Sync BIOS<i class="material-icons left">check</i></a>
                          <?php } ?> -->
                          <div class="row">
                              <div class="col s12">
                                <table id="example" class="display table table-bordered" cellspacing="0" width="100%">
                                  <thead>
                                      <tr>
                                        <th width="5%" style="text-align:center;">No.</th>
                                        <th style="text-align:center;">Nama Kegiatan</th>
                                        <th style="text-align:center;">Tgl Pengajuan</th>
                                        <th style="text-align:center;">Jumlah Pengajuan</th>
                                        <th style="text-align:center;">Realisasi</th>
                                        <th style="text-align:center;">Sync</th>
                                        <th style="text-align:center;">Action</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                    <?php $no=1; foreach($result AS $a) { ?>
                                      <tr>
                                        <td style="text-align:center;"><?php echo $no; ?></td>
                                        <td style="font-size: 12px;">
              			                      <span class="badge blue" style="font-size: 11px;"><?php echo "Nomor Urut :".$a->no_urut; ?></span>
                                          <br/>
                                          <span class="badge red" style="font-size: 11px;"><?php echo $a->kode." - ".$a->nama_akun; ?></span>
                                          <br/>
                                          <b><?= $a->nama_kegiatan ?></b>
                                          <br>
                                          <?= $a->keterangan ?>
                                        </td>
                                        <td><?php echo $this->format_tanggal->jin_date_str($a->tgl_pengajuan); ?></td>
                                        <td><?php echo "Rp.".number_format($a->jumlah).",-"; ?></td>
                                        <td><?php echo "Rp.".number_format($a->jumlah_realisasi).",-"; ?></td>
                                        <td>
                                          <?php if ($a->status_sync == 0) { ?>
                                            <a href="#" class="btn btn-floating red"><i class="material-icons dp48">close</i></a>
                                          <?php } else { ?>
                                            <a href="#" class="btn btn-floating green"><i class="material-icons dp48">check</i></a>
                                          <?php } ?>
                                        </td>
                                        <td style="text-align:center;">
                                            <a href="<?php echo base_url();?>bendahara_pengeluaran/detail_kontrak/<?php echo $a->id_kontrak;?>" class="btn btn-floating blue tooltipped" data-position="top" data-tooltip="Preview"><i class="material-icons dp48">info</i></a>
                                          <?php if ($a->status_realisasi == 0 ) { ?>
                                            <a href="#modalrealisasi<?php echo $a->id_pengajuan;?>" class="btn btn-floating red tooltipped modal-trigger" data-position="top" data-tooltip="Input Realisasi"><i class="material-icons dp48">done</i></a>
                                          <?php } else { ?>
                                            <a href="#modalrealisasi<?php echo $a->id_pengajuan;?>" class="btn btn-floating green tooltipped modal-trigger" data-position="top" data-tooltip="Realisasi : <?php echo $this->format_tanggal->jin_date_str($a->tgl_realisasi); ?>"><i class="material-icons dp48">done</i></a>
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
    </div>
</div>

<?php foreach ($result as $a) { ?>
  <div id="modalrealisasi<?php echo $a->id_pengajuan; ?>" class="modal">
      <div class="modal-content">
          <h4>Input Realiasi</h4>
            <?php echo form_open_multipart('bendahara_pengeluaran/input_realisasi');?>
              <div class="row">
                  <div class="input-field col s12">
                    <?php $jumlah = "Rp.".number_format($a->jumlah).",-"; ?>
                    <input id="id_termin" type="text" name="id_pengajuan" value="<?php echo $a->id_pengajuan; ?>" hidden>

                      Tanggal Pengajuan : <?php echo $this->format_tanggal->jin_date_str($a->tgl_pengajuan); ?><br>
                      Jumlah Pengajuan : <?php echo $jumlah; ?>

                  </div>
              </div>
              <div class="row">
                  <div class="input-field col s12">
                    <input id="a9" type="date" name = "tgl_realisasi" required>
                    <label for="a9">Tanggal Realisasi</label>
                  </div>
              </div>
              <div class="row">
                  <div class="input-field col s12">
                    <input id="a1" type="number" name ="jumlah_realisasi" min="1" required>
                    <label for="a9">Jumlah Realisasi</label>
                  </div>
              </div>
            <div class="row">
                <div class="input-field col s12">
                    <button class="btn cyan waves-effect waves-light left" type="submit" name="action" onclick="javascript: return confirm('Yakin akan menyimpan data?')">Simpan</button>
                </div>
            </div>
          </form>
        </div>
  </div>
<?php } ?>
