<style>
table.dataTable thead tr th {
    word-wrap: break-word;
    word-break: break-all;
}
</style>

<?php foreach($result_rkakl AS $a) { ?>
<div id="modalpengajuanedit<?php echo $a->id_pengajuan;?>" class="modal">
  <?php echo form_open_multipart('ppk/edit_pengajuan_rkakl');?>
    <div class="modal-content">
        <h4>Data Pengajuan Operasional</h4>
        <input id="id_pengajuan" type="text" name="id_pengajuan" value="<?php echo $a->id_pengajuan; ?>" hidden>
            <div class="row">
                <div class="input-field col s12">
                    <input id="a6" type="number" name="jumlah" maxlength="20" value="<?php echo $a->jumlah; ?>" required>
                    <label for="a9">Jumlah</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <button class="btn cyan waves-effect waves-light left" type="submit" name="action" onclick="javascript: return confirm('Yakin akan menyimpan data ?')">Simpan</button>
                </div>
            </div>
      </div>
  </form>
</div>
<?php } ?>

<div id="main">
      <div class="row">
        <div class="col s12">
            <div class="container">
                <div class="section section-data-tables">
                  <div class="card">
                      <div class="card-content">
                          <!-- <h4 class="card-title">Daftar Kontrak</h4> -->
                          <div class="row">
                              <div class="col s12">
                                <table id="example" class="display table table-bordered" cellspacing="0" width="100%">
                                      <thead>
                                          <tr>
                                            <th style="text-align:center;" width="10%">No.</th>
                                            <th style="text-align:center;">Nama Kegiatan</th>
                                            <th style="text-align:center;" width="15%">Tgl Pengajuan</th>
                                            <th style="text-align:center;">Jumlah</th>
                                            <th style="text-align:center;" width="20%">action</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                        <?php $no=1; foreach($result_rkakl AS $a) { ?>
                                          <tr>
                                            <td style="text-align:center;"><?php echo $no; ?></td>
                                            <td style="font-size:12px;">
                                              <?php if ($a->status_pengajuan == 0) { ?> <span style="font-size: 10px;" class="badge orange">Menunggu Approval</span> <?php } elseif ($a->status_pengajuan == 1) { ?> <span style="font-size: 10px;" class="badge green">Approved PPK</span> <?php  } else { ?> <span style="font-size: 10px;" class="badge red">Ditolak PPK</span> <?php } ?>
                			                        <span style="font-size: 10px;" class="badge gradient-45deg-light-blue-cyan"><?php if($a->no_urut == NULL) { echo "Belum ada No. Urut"; } else { echo $a->no_urut; } ?></span><br/><span class="badge red" style="font-size: 10px;"><?php echo $a->kode." - ".$a->nama_akun; ?></span>
                                              <br/>
                                              <b><?= $a->keterangan_rkakl ?></b><br>
                                              Keterangan : <?= $a->keterangan ?><br>
                                              File : <a href="<?php echo base_url();?>uploads/pengajuan/<?php echo $a->file;?>" target="_blank"><?php if($a->file != NULL) { echo "Preview Dokumen"; } ?></a>
                                            </td>
                                            <td style="text-align:center;"><?php echo $this->format_tanggal->jin_date_str($a->tgl_pengajuan); ?></td>
                                            <td style="text-align:center;"><?php echo "Rp.".number_format($a->jumlah).",-"; ?></td>
                                            <td style="text-align:center;">
                                              <a href="<?php echo base_url();?>ppk/detail_rkakl/<?php echo $a->id_rkakl;?>" class="btn-floating blue tooltipped" data-position="top" data-tooltip="Detail RKAKL"><i class="material-icons right">remove_red_eye</i></a>
                                              <a href="#modalpengajuanedit<?php echo $a->id_pengajuan; ?>" class="btn-floating orange tooltipped modal-trigger" data-position="top" data-tooltip="Edit"><i class="material-icons dp48">edit</i></a>
                                            <?php if ($a->status_pengajuan == 0 ) { ?>
                                              <a href="<?php echo base_url();?>ppk/approve_rkakl/<?php echo $a->id_pengajuan;?>/1" class="btn-floating green tooltipped" data-position="top" data-tooltip="Approval" onclick="javascript: return confirm('Yakin akan memverifikasi data ?')"><i class="material-icons right">check</i></a>
                                              <a href="#modaltolakrkakl<?php echo $a->id_pengajuan;?>" class="btn-floating red tooltipped modal-trigger" data-position="top" data-tooltip="Tolak"><i class="material-icons right">close</i></a>
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
<?php foreach ($result_rkakl as $a) { ?>
  <div id="modaltolakrkakl<?php echo $a->id_pengajuan; ?>" class="modal">
    <?php echo form_open_multipart('ppk/tolakrkakl');?>
      <div class="modal-content">
        <div class="row">
            <div class="input-field col s12">
                <input id="id_pengajuan" type="text" name="id_pengajuan" value="<?php echo $a->id_pengajuan; ?>" hidden>
                <input id="keterangan_tolak" type="text" name="keterangan_tolak" maxlength="255" required></input>
                <label for="keterangan_tolak">Keterangan</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <button class="btn cyan waves-effect waves-light left" type="submit" name="action" onclick="javascript: return confirm('Yakin akan menyimpan data ?')">Simpan</button>
            </div>
        </div>
        </div>
      </form>
  </div>
<?php } ?>
