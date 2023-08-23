<div id="main">
      <div class="row">
        <div class="col s12">
            <div class="container">
                <div class="section section-data-tables">

                  <div class="card">
                      <div class="card-content">
                          <!-- <h4 class="card-title">Daftar Kontrak</h4> -->
                          <a href="#modalro" class="btn btn-success btn-with-icon btn-block rounded-5 modal-trigger"><i class="far fa-file-alt"></i> Tambah Pengajuan</a>
                          <br>
                          <div class="row">
                              <div class="col s12">
                                <table id="example" class="display table table-bordered" cellspacing="0" width="100%">
                                  <!-- <table id="page-length-option" class="responsive-table" width="100%"> -->
                                      <thead>
                                        <tr>
                                          <th width="5%" data-sort-ignore="true"><center>No.</center></th>
                                          <th width="50%">Keterangan</th>
                                          <th width="15%">Jumlah</th>
                                          <th width="20%" data-sort-ignore="true"><center>Action</center></th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <?php $no=1; foreach($result AS $a) { ?>
                                          <tr>
                                            <td><center><?php echo $no; ?></center></td>
                                            <td>
                			                        <span class="label label-table label-info"><?php echo $a->no_urut; ?></span>
                                              <br/>
                                              <b><?php echo $a->keterangan_rkakl." ( ".$a->kode_akun." - ".$a->nama_akun." ) "; ?></b><br>
                                              <?php echo $a->keterangan; ?><br>
                                              File : <a href="<?php echo base_url();?>uploads/pengajuan/<?php echo $a->file;?>" target="_blank"><?php echo $a->file;?></a>
                                            </td>
                                            <td><?php echo "Rp.".number_format($a->jumlah).",-"; ?></td>
                                            <td>
                                              <center>
                                                <!-- <a href="<?php echo base_url();?>pejabat_teknis/detail_rkakl/<?php echo $a->id_rkakl;?>" class="btn btn-small cyan btn-outline tooltipped" data-position="top" data-delay="50" data-tooltip="Detail RKAKL"><i class="fas fa-cog"></i></a> -->
                                              <?php if($a->status_pengajuan == 0 ) { ?>
                                                <a href="#modaledit<?php echo $a->id_pengajuan; ?>" class="btn-floating gradient-45deg-light-blue-cyan tooltipped modal-trigger" data-position="top" data-tooltip="Edit Pengajuan RKAKL"><i class="material-icons dp48">edit</i></a>
                                                <a href="<?php echo base_url();?>pejabat_teknis/hapus_pengajuan_rkakl/<?php echo $a->id_pengajuan;?>" class="btn-floating red tooltipped" data-position="top" data-tooltip="Hapus Pengajuan RKAKL" onclick="javascript: return confirm('Yakin akan menghapus data ?')"><i class="material-icons dp48">delete</i></a>
                                              <?php } elseif ($a->status_pengajuan == 1) { ?>
                                                <?php if ($a->status_realisasi == 1) { ?>
                                                  <span class="badge green">Realisasi</span> <br>
                                                <?php echo "Rp. ".number_format($a->jumlah_realisasi,0,'','.' ).",-"; ?>
                                                <?php } else {?>
                                                  <span class="badge orange">Approved</span>
                                                <?php } ?>
                                              <?php } elseif ($a->status_pengajuan == 2) { ?>
                                                <span class="badge red">Ditolak (<?php echo $a->keterangan_tolak; ?>)</span>
                                              <?php } ?>
                                              </center>
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




<div id="modalro" class="modal">
  <?php echo form_open_multipart('pejabat_teknis/input_pengajuan_rkakl');?>
    <div class="modal-content">
        <h4>Data RKAKL</h4>
<div class="row">
            <div class="input-field col s12">
                <input id="a6" type="text" disabled value="OTOMATIS">
                <label for="a9">No Urut</label>
            </div>
        </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="a6" type="text" name="keterangan" required>
                    <label for="a9">Keterangan</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                  <select name="id_detail_rkakl" required>
                      <option value="" disabled selected>Pilih Data RKAKL</option>
                      <?php foreach ($rkakl as $a) { ?>
                        <?php $total = $this->db->query("SELECT SUM(jumlah) AS total FROM pengajuan_rkakl WHERE id_detail_rkakl = $a->id")->row();?>
                        <?php $saldo = $a->biaya - $total->total;?>
                        <option value="<?php echo $a->id; ?>"><?php echo $a->keterangan." ( ".$a->kode_akun." - ".$a->nama_akun." ) Pagu : "."Rp. ".number_format($a->biaya,0,'','.' ).",-"." saldo : "."Rp. ".number_format($saldo,0,'','.' ).",-"; ?></option>
                      <?php } ?>
                  </select>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="a6" type="number" name="jumlah" maxlength="20" required>
                    <label for="a9">Jumlah</label>
                </div>
            </div>
            File Pendukung
            <div class="row">
                <div class="input-field col s12">
                    <input id="a9" type="file" name="file" required>
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
<?php foreach ($result as $a) { ?>
  <div id="modaledit<?php echo $a->id_pengajuan; ?>" class="modal">
    <?php echo form_open_multipart('pejabat_teknis/edit_pengajuan_rkakl');?>
      <div class="modal-content">
          <h4>Data RKAKL</h4>
              <div class="row">
                  <div class="input-field col s12">
                      <input id="id_pengajuan" type="text" name="id_pengajuan" value="<?php echo $a->id_pengajuan; ?>" maxlength="20" hidden>
                      <input id="a6" type="text" name="keterangan" value="<?php echo $a->keterangan; ?>">
                      <label for="a9">Keterangan</label>
                  </div>
              </div>
              <div class="row">
                  <div class="input-field col s12">
                    <select name="id_detail_rkakl">
                      <?php $total = $this->db->query("SELECT SUM(jumlah) AS total FROM pengajuan_rkakl WHERE id_detail_rkakl = $a->id")->row();?>
                      <?php $saldo = $a->biaya - $total->total;?>
                      <option value="<?php echo $a->id; ?>" selected><?php echo $a->keterangan_rkakl." ( ".$a->kode_akun." - ".$a->nama_akun." ) Pagu : "."Rp. ".number_format($a->biaya,0,'','.' ).",-"." saldo : "."Rp. ".number_format($saldo,0,'','.' ).",-"; ?></option>
                        <?php foreach ($rkakl as $b) { ?>
                          <?php $total = $this->db->query("SELECT SUM(jumlah) AS total FROM pengajuan_rkakl WHERE id_detail_rkakl = $b->id")->row();?>
                          <?php $saldo = $b->biaya - $total->total;?>
                          <option value="<?php echo $b->id; ?>"><?php echo $b->keterangan." ( ".$b->kode_akun." - ".$b->nama_akun." ) Pagu : "."Rp. ".number_format($b->biaya,0,'','.' ).",-"." saldo : "."Rp. ".number_format($saldo,0,'','.' ).",-"; ?></option>
                        <?php } ?>
                    </select>
                  </div>
              </div>
              <div class="row">
                  <div class="input-field col s12">
                      <input id="a6" type="number" name="jumlah" value="<?php echo $a->jumlah; ?>" maxlength="20">
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
