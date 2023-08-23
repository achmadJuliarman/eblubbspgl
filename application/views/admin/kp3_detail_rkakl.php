<div class="container-fluid">
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <h4 class="card-title">Detail RKAKL</h4>
                    <h6 class="card-subtitle"><?php echo $result->keterangan; ?></h6>
                    <table class="table table-striped table-dashboard-two mg-b-0" width="100%">
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
                      <?php // $jumlah_ro = $this->db->query("SELECT ro.id_ro,ro.id_kontrak,ro.keterangan,SUM(ro.biaya) AS pengajuan,SUM(ro.realisasi) AS realisasi,a.kode,a.nama_akun,SUM(ro.biaya) AS jumlah FROM rencana_operasional AS ro INNER JOIN akun AS a ON ro.akun = a.id_akun WHERE ro.id_kontrak = $result->id_kontrak GROUP BY ro.akun")->num_rows(); ?>
                      <tbody>
                        <?php if ($jumlah == 0) { ?>
                          <tr>
                            <td colspan="3">Belum ada Rencana Operasional</td>
                          </tr>
                        <?php } else { ?>
                        <?php $total=0;$total_p=0;$total_r=0;$total_s=0; foreach ($ro as $a) { ?>
                          <?php $pengajuan = $this->db->query("SELECT SUM(jumlah) AS pengajuan,SUM(jumlah_realisasi) AS realisasi FROM pengajuan_rkakl WHERE id_detail_rkakl = $a->id")->row(); ?>
                          <tr>
                            <td><?php echo $a->kode." ".$a->nama_akun;?></td>
                            <td><?php echo "Rp. ".number_format($a->biaya,0,'','.' ).",-"; ?></td>
                            <td><?php echo "Rp. ".number_format($pengajuan->pengajuan,0,'','.' ).",-"; ?></td>
                            <td><?php echo "Rp. ".number_format($pengajuan->realisasi,0,'','.' ).",-"; ?></td>
                            <?php $saldo = $a->biaya - $pengajuan->realisasi;?>
                            <td><?php echo "Rp. ".number_format($saldo,0,'','.' ).",-"; ?></td>
                              <td>
                                <a href="#edit_rkakl<?php echo $a->id;?>" class="btn btn-small green btn-outline tooltipped modal-trigger" data-position="top" data-delay="50" data-tooltip="Edit RO"><i class="fas fa-edit"></i></a>
                                <a href="<?php echo base_url(); ?>pejabat_teknis/hapus_detail_rkakl/<?php echo $result->id_rkakl; ?>/<?php echo $a->id_detail_rkakl; ?>" class="btn btn-small red btn-outline tooltipped modal-trigger" data-position="top" data-delay="50" data-tooltip="Hapus RO" onclick="javascript: return confirm('Yakin akan menghapus data ?')"><i class="fas fa-trash"></i></a>
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

                          </tr>
                          <td colspan="5">
                            <?php $persen = $total/$result->jumlah*100; ?>
                            <?php
                            if ($persen < 30)
                            {
                              $label = "label-info";
                            }
                            elseif ($persen >= 30 && $persen <= 50)
                            {
                              $label = "label-success";
                            }
                            elseif ($persen > 50 && $persen <= 70)
                            {
                              $label = "label-warning";
                            }
                            elseif ($persen > 70)
                            {
                              $label = "label-danger";
                            }
                            ?>
                            *Biaya Operasional sebesar : <span class="label label-table <?php echo $label; ?>"><?= 'Rp. '.number_format($total).',-'." ( ".round($persen,2)." %) ";?> </span>&nbsp; dari nilai RKAKL : <span class="label label-table <?php echo $label; ?>"> <?= 'Rp. '.number_format($result->jumlah).',-';?> </span>
                          </td>
                        <?php } ?>
                    </tbody>
                    </table>
                    <a href="#modalro" class="btn btn-success btn-with-icon btn-block rounded-5 modal-trigger"><i class="far fa-file-alt"></i> Tambah Biaya Operasional</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="modalro" class="modal">
  <?php echo form_open_multipart('pejabat_teknis/input_detail_rkakl');?>
    <div class="modal-content">
        <h4>Data Rencana Operasional</h4>
              <div class="row">
                <div class="input-field col s12">
                  <input type="text" name= "id_rkakl" value="<?php echo $result->id_rkakl; ?>" hidden>
                  <?php $akun = $this->db->query("SELECT * FROM akun")->result(); ?>
                  <select name="akun" id="akun" required>
                      <option value="" disabled selected>Kode Akun</option>
                      <?php foreach ($akun as $a) { ?>
                        <option value="<?php echo $a->id_akun; ?>"><?php echo $a->kode." - ".$a->nama_akun; ?></option>
                      <?php } ?>
                  </select>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="a6" type="number" name="biaya" maxlength="20" min="1">
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
        <?php echo form_open_multipart('pejabat_teknis/edit_detail_rkakl');?>
          <div class="row">
              <div class="input-field col s12 l12">
                <input id="judul_kontrak" type="text" name= "id_rkakl" value="<?php echo $result->id_rkakl; ?>" hidden>
                <input id="id_ro" type="text" name= "id" value="<?php echo $a->id; ?>" hidden>
                <?php echo $a->kode." - ".$a->nama_akun; ?>
              </div>
              <div class="input-field col s12 l12">
                  <input id="a6" type="number" name="biaya" value="<?php echo $a->biaya; ?>" min="1" maxlength="20" required>
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
