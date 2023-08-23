<div class="container-fluid">
  <div class="row">
      <div class="col l6 m16 s12">
          <div class="card danger-gradient card-hover">
              <div class="card-content">
                  <div class="d-flex no-block align-items-center">
                      <div>
                          <h4 class="white-text m-b-5"><?php echo "Rp. ".number_format($target->jumlah,0,'','.' ).",-"; ?></h4>
                          <h6 class="white-text op-5 light-blue-text">TARGET PENDAPATAN</h6>
                      </div>
                      <div class="ml-auto">
                        <span class="white-text display-6"><i class="material-icons">equalizer</i></span>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="col l6 m16 s12">
          <div class="card info-gradient card-hover">
            <div class="card-content">
                <div class="d-flex no-block align-items-center">
                    <div>
                        <h4 class="white-text m-b-5"><?php echo "Rp. ".number_format($realisasi->jumlah,0,'','.' ).",-"; ?></h4>
                        <h6 class="white-text op-5 text-darken-2">REALISASI</h6>
                    </div>
                    <div class="ml-auto">
                        <span class="white-text display-6"><i class="material-icons">equalizer</i></span>
                    </div>
                </div>
            </div>
          </div>
      </div>
      <div class="col l4 m8 s12">
          <div class="card success-gradient card-hover">
            <div class="card-content">
                <div class="d-flex no-block align-items-center">
                    <div>
                        <h4 class="white-text m-b-5"><?php echo "Rp. ".number_format($terkontrak->jumlah,0,'','.' ).",-"; ?></h4>
                        <h6 class="white-text op-5">TERKONTRAK</h6>
                    </div>
                    <div class="ml-auto">
                      <span class="white-text display-6"><i class="material-icons">equalizer</i></span>
                    </div>
                </div>
            </div>
          </div>
      </div>
      <div class="col l4 m8 s12">
          <div class="card success-gradient card-hover">
            <div class="card-content">
                <div class="d-flex no-block align-items-center">
                    <div>
                        <h4 class="white-text m-b-5"><?php echo "Rp. ".number_format($invoice->jumlah,0,'','.' ).",-"; ?></h4>
                        <h6 class="white-text op-5 text-darken-2">INVOICE</h6>
                    </div>
                    <div class="ml-auto">
                        <span class="white-text display-6"><i class="material-icons">equalizer</i></span>
                    </div>
                </div>
            </div>
          </div>
      </div>
      <div class="col l4 m8 s12">
          <div class="card warning-gradient card-hover">
              <div class="card-content">
                  <div class="d-flex no-block align-items-center">
                      <div>
                          <h4 class="white-text m-b-5"><?php echo "Rp. ".number_format($pengeluaran->jumlah,0,'','.' ).",-"; ?></h4>
                          <h6 class="white-text op-5">PENGELUARAN</h6>
                      </div>
                      <div class="ml-auto">
                        <span class="white-text display-6"><i class="material-icons">equalizer</i></span>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <h4 class="card-title">Daftar RKAKL</h4>
                    <h6 class="card-subtitle">You have <?php echo $jumlah; ?> RKAKL</h6>
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
                                    <a href="#modalro" class="btn btn-success btn-with-icon btn-block rounded-5 modal-trigger"><i class="far fa-file-alt"></i> Tambah RKAKL</a>
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
                            <td><?php echo $a->keterangan; ?></td>
                            <td><?php echo "Rp.".number_format($a->jumlah).",-"; ?></td>
                            <td>
                              <center>
                                <a href="<?php echo base_url();?>pejabat_teknis/detail_rkakl/<?php echo $a->id_rkakl;?>" class="btn btn-small cyan btn-outline tooltipped" data-position="top" data-delay="50" data-tooltip="Detail RKAKL"><i class="fas fa-cog"></i></a>
                                <a href="#modaledit<?php echo $a->id_rkakl; ?>" class="btn btn-small green btn-outline tooltipped modal-trigger" data-position="top" data-delay="50" data-tooltip="Edit RKAKL"><i class="far fa-file-alt"></i></a>
                                <a href="<?php echo base_url();?>pejabat_teknis/hapus_rkakl/<?php echo $a->id_rkakl;?>" class="btn btn-small red btn-outline tooltipped" data-position="top" data-delay="50" data-tooltip="Hapus RKAKL" onclick="javascript: return confirm('Yakin akan menghapus data ?')"><i class="fas fa-trash"></i></a>
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
