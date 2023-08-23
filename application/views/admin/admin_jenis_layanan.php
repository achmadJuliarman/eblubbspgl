                <div class="container-fluid">
                    <div class="row">
                        <div class="col s12">
                            <div class="card">
                                <div class="card-content">
                                    <h4 class="card-title">Daftar Jenis Layanan</h4>
                                    <h6 class="card-subtitle">You have <?php echo $jumlah; ?> Jenis Layanan</h6>
                                    <table id="demo-foo-addrow2" class="table table-bordered table-hover toggle-circle" data-page-size="10">
                                      <thead>
                                          <tr>
                                            <th width="5%" data-sort-ignore="true"><center>No.</center></th>
                                            <th width="35%">Nama Pelaksana Layanan</th>
                                            <th width="25%">Nama Jenis Layanan</th>
                                            <th width="15%" data-sort-ignore="true"><center>Kode</center></th>
                                            <th width="20%" data-sort-ignore="true"><center>Action</center></th>
                                          </tr>
                                      </thead>
                                      <div class="m-t-40">
                                          <div class="d-flex">
                                              <div class="mr-auto">
                                                  <div class="form-group">
                                                    <a href="#modaltambah" class="btn btn-success btn-with-icon btn-block rounded-5 modal-trigger"><i class="far fa-file-alt"></i> Tambah Jenis Layanan</a>
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
                                              <?php echo $a->nama; ?>
                                            </td>
                                            <td>
                                              <b><?php echo $a->jenis; ?></b>
                                            </td>
                                            <td>
                                              <center><?php echo $a->kode_layanan; ?></center>
                                            </td>
                                            <td>
                                              <center>
                                                <a href="<?php echo base_url();?>admin/detail_jenis_layanan/<?php echo $a->id_jenis_layanan;?>" class="btn btn-small cyan btn-outline tooltipped" data-position="top" data-delay="50" data-tooltip="Detail Layanan"><i class="fas fa-cog"></i></a>
                                                <a href="#modaledit<?php echo $a->id_jenis_layanan;?>" class="btn btn-small green btn-outline tooltipped modal-trigger" data-position="top" data-delay="50" data-tooltip="Edit Jenis Layanan"><i class="far fa-file-alt"></i></a>
                                                <a href="<?php echo base_url();?>admin/hapus_jenis_layanan/<?php echo $a->id_jenis_layanan;?>" class="btn btn-small red btn-outline tooltipped" data-position="top" data-delay="50" data-tooltip="Hapus Jenis Layanan" onclick="javascript: return confirm('Yakin akan menghapus data ?')"><i class="fas fa-trash"></i></a>
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
                  <?php echo form_open_multipart('admin/input_jenis_layanan');?>
                    <div class="modal-content">
                        <h4>Data Jenis Layanan</h4>
                            <div class="row">
                                <div class="input-field col s12">
                                  <select name="id_rumah_layanan" required>
                                      <option value="" disabled selected>Pelaksana Layanan</option>
                                      <?php foreach ($rumah_layanan as $a) { ?>
                                        <option value="<?php echo $a->id_rumah_layanan; ?>"><?php echo $a->kode." - ".$a->nama; ?></option>
                                      <?php } ?>
                                  </select>
                                  <label>Pilih Pelaksana Layanan</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                  <input id="nama" type="text" name="jenis" maxlength="100" required>
                                  <label for="nama">Jenis Layanan</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                  <input id="kode" type="text" name="kode" maxlength="100" required>
                                  <label for="kode">Kode Jenis Layanan</label>
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
                <div id="modaledit<?php echo $a->id_jenis_layanan?>" class="modal">
                  <?php echo form_open_multipart('admin/edit_jenis_layanan');?>
                    <div class="modal-content">
                        <h4>Data Jenis Layanan</h4>
                            <div class="row">
                                <div class="input-field col s12">
                                  <select name="id_rumah_layanan" requireds>
                                      <option value="<?php echo $a->id_rumah_layanan; ?>" selected><?php echo $a->kode." - ".$a->nama; ?></option>
                                      <?php foreach ($rumah_layanan as $rl) { ?>
                                        <option value="<?php echo $rl->id_rumah_layanan; ?>"><?php echo $rl->kode." - ".$rl->nama; ?></option>
                                      <?php } ?>
                                  </select>
                                  <label>Pilih Pelaksana Layanan</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                  <input id="id_jenis_layanan" type="text" name="id_jenis_layanan" maxlength="100" value="<?php echo $a->id_jenis_layanan; ?>" hidden>
                                  <input id="nama" type="text" name="jenis" maxlength="100" value="<?php echo $a->jenis; ?>" required>
                                  <label for="nama">Nama Jenis Layanan</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                  <input id="kode" type="text" name="kode" maxlength="100" value="<?php echo $a->kode; ?>" required>
                                  <label for="kode">Kode Jenis Layanan</label>
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
