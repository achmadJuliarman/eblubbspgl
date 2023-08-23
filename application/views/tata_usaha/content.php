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
                                <a href="#modaltambah" class="btn mb-1 waves-effect waves-light gradient-45deg-light-blue-cyan mr-1 modal-trigger">Tambah Data<i class="material-icons left">add_circle</i></a>
                                <table id="example" class="display table table-bordered" cellspacing="0" width="100%">
                                  <!-- <table id="page-length-option" class="display" width="100%"> -->
                                      <thead>
                                        <tr>
                                          <th width="5%"><center>No.</center></th>
                                          <th width="50%">Keterangan</th>
                                          <th width="15%">Jumlah</th>
                                          <th width="20%"><center>Action</center></th>
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
                                                <a href="<?php echo base_url();?>tata_usaha/detail_rkakl/<?php echo $a->id_rkakl;?>" class="btn-floating gradient-45deg-light-blue-cyan tooltipped" data-position="top" data-tooltip="Detail RKAKL"><i class="material-icons dp48">info</i></a>
                                                <!-- <a href="<?php echo base_url();?>tata_usaha/edit_rkakl/<?php echo $a->id_rkakl;?>" class="btn btn-small green btn-outline tooltipped" data-position="top" data-delay="50" data-tooltip="Edit RKAKL"><i class="far fa-file-alt"></i></a> -->
                                                <a href="#modaledit<?php echo $a->id_rkakl; ?>" class="btn-floating green tooltipped modal-trigger" data-position="top" data-tooltip="Edit RKAKL"><i class="material-icons dp48">edit</i></a>
                                                <a href="<?php echo base_url();?>tata_usaha/hapus_rkakl/<?php echo $a->id_rkakl;?>" class="btn-floating red tooltipped" data-position="top" data-tooltip="Hapus RKAKL" onclick="javascript: return confirm('Yakin akan menghapus data ?')"><i class="material-icons dp48">delete</i></a>
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

<div id="modaltambah" class="modal">
  <?php echo form_open_multipart('tata_usaha/input_rkakl');?>
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
                    <input id="a6" type="number" name="jumlah" maxlength="20" required min="1">
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
<?php foreach($result AS $a) { ?>
<div id="modaledit<?php echo $a->id_rkakl; ?>" class="modal">
  <?php echo form_open_multipart('tata_usaha/edit_rkakl');?>
    <div class="modal-content">
        <h4>Data RKAKL</h4>
            <div class="row">
                <div class="input-field col s12">
                    <input id="a6" type="text" name="id_rkakl" value="<?php echo $a->id_rkakl; ?>" hidden>
                    <input id="a6" type="text" name="keterangan" value="<?php echo $a->keterangan; ?>" required>
                    <label for="a9">Keterangan</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="a6" type="number" name="jumlah" value="<?php echo $a->jumlah; ?>" maxlength="20" required min="1">
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
