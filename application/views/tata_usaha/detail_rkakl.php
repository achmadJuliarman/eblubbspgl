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
                                <a href="#modalro" class="btn mb-1 waves-effect waves-light gradient-45deg-light-blue-cyan btn-block modal-trigger">Tambah Data</a>
                                <table class="display table table-bordered" cellspacing="0" width="100%">
                                  <!-- <table id="page-length-option" class="display" width="100%"> -->
                                      <thead>
                                        <tr>
                                          <th width="30%">Kode Akun</th>
                                          <th width="15%">Pagu</th>
                                          <th width="15%">Pengajuan</th>
                                          <th width="15%">Realisasi</th>
                                          <th width="15%">Saldo</th>
                                          <th></th>
                                        </tr>
                                      </thead>
                                      <?php $ro = $this->db->query("SELECT *,detail_rkakl.id AS id_detail_rkakl FROM detail_rkakl INNER JOIN rkakl ON detail_rkakl.id_rkakl = rkakl.id_rkakl INNER JOIN akun AS a ON detail_rkakl.akun = a.id_akun WHERE detail_rkakl.id_rkakl = $result->id_rkakl")->result(); ?>
                                      <tbody>
                                        <?php if ($jumlah == 0) { ?>
                                          <tr>
                                            <td colspan="3">Belum ada Rencana Operasional</td>
                                          </tr>
                                        <?php } else { ?>
                                        <?php $total=0;$total_p=0;$total_r=0;$total_s=0; foreach ($ro as $a) { ?>
                                          <?php $tgl=date('Y'); $pengajuan = $this->db->query("SELECT SUM(jumlah) AS pengajuan,SUM(jumlah_realisasi) AS realisasi FROM pengajuan_rkakl WHERE id_detail_rkakl = $a->id AND YEAR(tgl_pengajuan)= $tgl")->row(); ?>
                                          <tr>
                                            <td><?php echo $a->kode." ".$a->nama_akun;?></td>
                                            <td><?php echo "Rp. ".number_format($a->biaya,0,'','.' ).",-"; ?></td>
                                            <td><?php echo "Rp. ".number_format($pengajuan->pengajuan,0,'','.' ).",-"; ?></td>
                                            <td><?php echo "Rp. ".number_format($pengajuan->realisasi,0,'','.' ).",-"; ?></td>
                                            <?php $saldo = $a->biaya - $pengajuan->realisasi;?>
                                            <td><?php echo "Rp. ".number_format($saldo,0,'','.' ).",-"; ?></td>
                                            <td>
                                              <a href="#edit_rkakl<?php echo $a->id;?>" class="btn-floating green tooltipped modal-trigger" data-position="top" data-tooltip="Edit RO"><i class="material-icons dp48">edit</i></a>
                                              <a href="<?php echo base_url(); ?>tata_usaha/hapus_detail_rkakl/<?php echo $result->id_rkakl; ?>/<?php echo $a->id_detail_rkakl; ?>" class="btn-floating red tooltipped" data-position="top" data-tooltip="Hapus RKAKL" onclick="javascript: return confirm('Yakin akan menghapus data ?')"><i class="material-icons dp48">delete</i></a>
                                            </td>
                                          </tr>
                                          <?php $total=$total+$a->biaya;$total_p=$total_p+$pengajuan->pengajuan;$total_r=$total_r+$pengajuan->realisasi;$total_s=$total_s+$saldo; } ?>
                                          <tr>
                                            <th>
                                              <strong>TOTAL</strong>
                                            </th>
                                            <th class="tx-medium"><strong><?= 'Rp. '.number_format($total).',-' ?></strong></th>
                                            <th class="tx-medium tx-danger"><strong><?= 'Rp. '.number_format($total_p).',-' ?></strong></th>
                                            <th class="tx-medium tx-success"><strong><?= 'Rp. '.number_format($total_r).',-' ?></strong></th>
                                            <th class="tx-medium tx-warning"><strong><?= 'Rp. '.number_format($total_s).',-' ?></strong></th>
                                            <th></th>
                                          </tr>
                                          <tr>
                                            <td colspan="5">
                                              <?php $persen = $total/$result->jumlah*100; ?>
                                              <?php
                                              if ($persen < 30)
                                              {
                                                $label = "blue";
                                              }
                                              elseif ($persen >= 30 && $persen <= 50)
                                              {
                                                $label = "green";
                                              }
                                              elseif ($persen > 50 && $persen <= 70)
                                              {
                                                $label = "orange";
                                              }
                                              elseif ($persen > 70)
                                              {
                                                $label = "red";
                                              }
                                              ?>
                                              *Biaya Operasional sebesar : <span class="badge <?php echo $label; ?>"><?= 'Rp. '.number_format($total).',-'." ( ".round($persen,2)." %) ";?> </span>&nbsp; dari nilai RKAKL : <span class="badge <?php echo $label; ?>"> <?= 'Rp. '.number_format($result->jumlah).',-';?> </span>
                                            </td>
                                          </tr>

                                        <?php } ?>
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
<div id="modalro" class="modal">
  <?php echo form_open_multipart('tata_usaha/input_detail_rkakl');?>
    <div class="modal-content">
        <h4>Data Rencana Operasional</h4>
              <div class="row">
                <div class="input-field col s12">
                  <input type="text" name= "id_rkakl" value="<?php echo $result->id_rkakl; ?>" hidden>
                  <?php $akun = $this->db->query("SELECT * FROM akun")->result(); ?>
                  <select name="akun" id="akun">
                      <option value="" disabled selected>Kode Akun</option>
                      <?php foreach ($akun as $a) { ?>
                        <option value="<?php echo $a->id_akun; ?>"><?php echo $a->kode." - ".$a->nama_akun; ?></option>
                      <?php } ?>
                  </select>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="a6" type="number" name="biaya" maxlength="30">
                    <label for="a9">Jumlah</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <button class="btn cyan waves-effect waves-light left" type="submit" name="action">Simpan</button>
                </div>
            </div>
      </div>
  </form>
</div>
<?php foreach ($ro as $a) { ?>
<div id="edit_rkakl<?php echo $a->id; ?>" class="modal">
  <div class="modal-content">
      <h4>Data RO</h4>
        <?php echo form_open_multipart('tata_usaha/edit_detail_rkakl');?>
          <div class="row">
              <div class="input-field col s12 l12">
                <input id="judul_kontrak" type="text" name= "id_rkakl" value="<?php echo $result->id_rkakl; ?>" hidden>
                <input id="id_ro" type="text" name= "id" value="<?php echo $a->id; ?>" hidden>
                <?php echo $a->kode." - ".$a->nama_akun; ?>
              </div>
              <div class="input-field col s12 l12">
                  <input id="a6" type="number" name="biaya" value="<?php echo $a->biaya; ?>" maxlength="20" required>
                  <label for="a6">Jumlah </label>
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
