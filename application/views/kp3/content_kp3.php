<div id="main">
      <div class="row">
        <div class="col s12">
            <div class="container">
                <div class="section section-data-tables">
                  <div id="card-stats" class="pt-0">
                    <div class="row">
                      <div class="col s12 m6 l4">
                          <div class="card animate fadeRight">
                              <div class="card-content gradient-45deg-light-blue-cyan lighten-1 white-text">
                                  <p class="card-stats-title">TARGET PENDAPATAN</p>
                                  <h4 class="card-stats-number white-text"><?php echo "Rp. ".number_format($target->jumlah,0,'','.' ).",-"; ?></h4>
                              </div>
                          </div>
                      </div>
                      <div class="col s12 m6 l4">
                          <div class="card animate fadeRight">
                              <div class="card-content gradient-45deg-light-blue-cyan lighten-1 white-text">
                                  <p class="card-stats-title">REALISASI PENDAPATAN</p>
                                  <h4 class="card-stats-number white-text"><?php echo "Rp. ".number_format($realisasi->jumlah,0,'','.' ).",-"; ?></h4>
                              </div>
                          </div>
                      </div>
                      <div class="col s12 m6 l4">
                          <div class="card animate fadeRight">
                              <div class="card-content gradient-45deg-light-blue-cyan lighten-1 white-text">
                                  <p class="card-stats-title">TERKONTRAK</p>
                                  <h4 class="card-stats-number white-text"><?php echo "Rp. ".number_format($terkontrak->jumlah,0,'','.' ).",-"; ?></h4>
                              </div>
                          </div>
                      </div>
                      <div class="col s12 m6 l6">
                          <div class="card animate fadeRight">
                              <div class="card-content gradient-45deg-light-blue-cyan lighten-1 white-text">
                                  <p class="card-stats-title">INVOICE</p>
                                  <h4 class="card-stats-number white-text"><?php echo "Rp. ".number_format($invoice->jumlah,0,'','.' ).",-"; ?></h4>
                              </div>
                          </div>
                      </div>
                      <div class="col s12 m6 l6">
                          <div class="card animate fadeRight">
                              <div class="card-content gradient-45deg-light-blue-cyan lighten-1 white-text">
                                  <p class="card-stats-title">REALISASI BELANJA</p>
                                  <h4 class="card-stats-number white-text"><?php echo "Rp. ".number_format($pengeluaran->jumlah,0,'','.' ).",-"; ?></h4>
                              </div>
                          </div>
                      </div>

                    </div>
                  </div>
                  <div class="card">
                      <div class="card-content">
                        <a href="#modalro" class="btn btn-success btn-with-icon btn-block rounded-5 modal-trigger"><i class="far fa-file-alt"></i> Tambah RKAKL</a>
                        <br>
                          <!-- <h4 class="card-title">Daftar Kontrak</h4> -->
                          <div class="row">
                              <div class="col s12">
                                <table id="example" class="display table table-bordered" cellspacing="0" width="100%">
                                  <!-- <table id="page-length-option" class="display" width="100%"> -->
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
                                            <td><?php echo $a->keterangan; ?></td>
                                            <td><?php echo "Rp.".number_format($a->jumlah).",-"; ?></td>
                                            <td>
                                              <center>
                                                <a href="<?php echo base_url();?>pejabat_teknis/detail_rkakl/<?php echo $a->id_rkakl;?>" class="btn-floating green tooltipped modal-trigger" data-position="top" data-tooltip="Detail RKAKL"><i class="material-icons dp48">settings</i></a>
                                                <a href="#modaledit<?php echo $a->id_rkakl; ?>" class="btn-floating gradient-45deg-light-blue-cyan tooltipped modal-trigger" data-position="top" data-tooltip="Edit RKAKL"><i class="material-icons dp48">edit</i></a>
                                                <a href="<?php echo base_url();?>pejabat_teknis/hapus_rkakl/<?php echo $a->id_rkakl;?>" class="btn-floating red tooltipped" data-position="top" data-tooltip="Hapus RKAKL" onclick="javascript: return confirm('Yakin akan menghapus data ?')"><i class="material-icons dp48">delete</i></a>
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
  <?php echo form_open_multipart('pejabat_teknis/input_rkakl');?>
    <div class="modal-content">
        <h4>Data RKAKL</h4>
            <div class="row">
                <div class="input-field col s12">
                    <input id="a6" type="text" name="keterangan" required>
                    <label for="a9">Keterangan</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="a6" type="number" name="jumlah" maxlength="20" min="1" required>
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
<?php foreach($result AS $a) { ?>
  <div id="modaledit<?php echo $a->id_rkakl; ?>" class="modal">
    <?php echo form_open_multipart('pejabat_teknis/edit_rkakl');?>
      <div class="modal-content">
          <h4>Data RKAKL</h4>
              <div class="row">
                  <div class="input-field col s12">
                      <input id="id_rkakl" type="text" name="id_rkakl" value="<?php echo $a->id_rkakl; ?>" hidden maxlength="20" requireds>
                      <input id="a6" type="text" name="keterangan" value="<?php echo $a->keterangan; ?>" required>
                      <label for="a9">Keterangan</label>
                  </div>
              </div>
              <div class="row">
                  <div class="input-field col s12">
                      <input id="a6" type="number" name="jumlah" value="<?php echo $a->jumlah; ?>" maxlength="20" min="1" required>
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
