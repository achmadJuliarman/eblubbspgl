<div class="container-fluid">
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <h4 class="card-title">Daftar Pengajuan</h4>
                    <h6 class="card-subtitle">You have <?php echo $jumlah; ?> Pengajuan</h6>
                    <table id="demo-foo-addrow2" class="table table-bordered table-hover toggle-circle" data-page-size="7">
                      <thead>
                        <tr>
                          <th width="5%" data-sort-ignore="true"><center>No.</center></th>
                          <th width="50%">Keterangan</th>
                          <th width="15%">Jumlah</th>
                          <th width="20%" data-sort-ignore="true"><center>Action</center></th>
                        </tr>
                          <!-- <tr>
                              <th data-sort-initial="true" data-toggle="true">First Name</th>
                              <th>Last Name</th>
                              <th data-hide="phone, tablet">Job Title</th>
                              <th data-hide="phone, tablet">DOB</th>
                              <th data-hide="phone, tablet">Status</th>
                              <th data-sort-ignore="true" class="min-width">Delete</th>
                          </tr> -->
                      </thead>
                      <div class="m-t-40">
                          <div class="d-flex">
                              <div class="mr-auto">
                                  <div class="form-group">
                                    <a href="#modalro" class="btn btn-success btn-with-icon btn-block rounded-5 modal-trigger"><i class="far fa-file-alt"></i> Tambah Pengajuan</a>
                                  </div>
                              </div>
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
			      <span class="label label-table label-info"><?php echo $a->no_urut; ?></span>
                              <br/>
                              <b><?php echo $a->keterangan_rkakl." ( ".$a->kode_akun." - ".$a->nama_akun." ) "; ?></b><br>
                              <?php echo $a->keterangan; ?>
                            </td>
                            <td><?php echo "Rp.".number_format($a->jumlah).",-"; ?></td>
                            <td>
                              <center>
                                <!-- <a href="<?php echo base_url();?>pejabat_teknis/detail_rkakl/<?php echo $a->id_rkakl;?>" class="btn btn-small cyan btn-outline tooltipped" data-position="top" data-delay="50" data-tooltip="Detail RKAKL"><i class="fas fa-cog"></i></a> -->
                                <?php if($a->status_pengajuan == 0 ) { ?>
                                <a href="#modaledit<?php echo $a->id_pengajuan; ?>" class="btn btn-small green btn-outline tooltipped modal-trigger" data-position="top" data-delay="50" data-tooltip="Edit Pengajuan"><i class="far fa-file-alt"></i></a>
                                <a href="<?php echo base_url();?>pejabat_teknis/hapus_pengajuan_rkakl/<?php echo $a->id_pengajuan;?>" class="btn btn-small red btn-outline tooltipped" data-position="top" data-delay="50" data-tooltip="Hapus Pengajuan" onclick="javascript: return confirm('Yakin akan menghapus data ?')"><i class="fas fa-trash"></i></a>
                              <?php } elseif ($a->status_pengajuan == 1) { ?>
                                <span class="label label-table label-success">Approved</span>
                              <?php } elseif ($a->status_pengajuan == 2) { ?>
                                <span class="label label-table label-danger">Ditolak (<?php echo $a->keterangan_tolak; ?>)</span> 
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
        </div>
    </div>
</div>
<div id="modalro" class="modal">
  <?php echo form_open_multipart('pejabat_teknis/input_pengajuan_rkakl');?>
    <div class="modal-content">
        <h4>Data RKAKL</h4>
<div class="row">
            <div class="input-field col s12">
                <input id="a6" type="text" name="no_urut" hidden value="<?php echo $no_urut; ?>">
                <input id="a6" type="text" disabled value="<?php echo $no_urut; ?>">
                <label for="a9">No Urut</label>
            </div>
        </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="a6" type="text" name="keterangan">
                    <label for="a9">Keterangan</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                  <select name="id_detail_rkakl">
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
                    <input id="a6" type="number" name="jumlah" maxlength="20">
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
                      <button class="btn cyan waves-effect waves-light left" type="submit" name="action">Simpan</button>
                  </div>
              </div>
        </div>
    </form>
  </div>
<?php } ?>
