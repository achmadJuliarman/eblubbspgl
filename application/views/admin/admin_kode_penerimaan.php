                <div class="container-fluid">
                    <div class="row">
                        <div class="col s12">
                            <div class="card">
                                <div class="card-content">
                                    <h4 class="card-title">Daftar Kode Penerimaan</h4>
                                    <h6 class="card-subtitle">You have <?php echo $jumlah; ?> Kode Penerimaan</h6>
                                    <table id="demo-foo-addrow2" class="table table-bordered table-hover toggle-circle" data-page-size="10">
                                      <thead>
                                          <tr>
                                            <th width="5%" data-sort-ignore="true"><center>No.</center></th>
                                            <th width="75%">Kode Penerimaan</th>
                                            <th width="20%" data-sort-ignore="true"><center>Action</center></th>
                                          </tr>
                                      </thead>
                                      <div class="m-t-40">
                                          <div class="d-flex">
                                              <div class="mr-auto">
                                                  <div class="form-group">
                                                    <a href="#modaltambah" class="btn btn-success btn-with-icon btn-block rounded-5 modal-trigger"><i class="far fa-file-alt"></i> Tambah Kode Penerimaan</a>
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
                                            <td><center><?= $no ?></center></td>
                                            <td>
                                              <b><?php echo $a->kode." - ".$a->nama_akun; ?></b>
                                            </td>
                                            <td>
                                              <center>
                                                <a href="#modaledit<?php echo $a->id_akun;?>" class="btn btn-small green btn-outline tooltipped modal-trigger" data-position="top" data-delay="50" data-tooltip="Edit Kode Penerimaan"><i class="far fa-file-alt"></i></a>
                                                <a href="<?php echo base_url();?>admin/hapus_kode_penerimaan/<?php echo $a->id_akun;?>" class="btn btn-small red btn-outline tooltipped" data-position="top" data-delay="50" data-tooltip="Hapus Kode Penerimaan" onclick="javascript: return confirm('Yakin akan menghapus data ?')"><i class="fas fa-trash"></i></a>
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

                <div id="modaltambah" class="modal">
                  <?php echo form_open_multipart('admin/input_kode_penerimaan');?>
                    <div class="modal-content">
                        <h4>Data Kode Penerimaan</h4>
                            <div class="row">
                                <div class="input-field col s12">
                                  <input id="nama" type="number" name="kode" maxlength="6" min="1" required>
                                  <label for="nama">Kode Penerimaan</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                  <input id="kode" type="text" name="nama_akun" required>
                                  <label for="kode">Keterangan</label>
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

                <?php foreach ($result AS $a) { ?>
                <div id="modaledit<?php echo $a->id_akun?>" class="modal">
                  <?php echo form_open_multipart('admin/edit_kode_penerimaan');?>
                    <div class="modal-content">
                        <h4>Data Kode Penerimaan</h4>
                            <div class="row">
                                <div class="input-field col s12">
                                  <input id="id_akun" type="text" name="id_akun" maxlength="100" value="<?php echo $a->id_akun; ?>" hidden>
                                  <input id="nama" type="number" name="kode" maxlength="6" min="1" value="<?php echo $a->kode; ?>" disabled>
                                  <label for="nama">Kode Penerimaan</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                  <input id="kode" type="text" name="nama_akun" maxlength="100" value="<?php echo $a->nama_akun; ?>" required>
                                  <label for="kode">Keterangan</label>
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
