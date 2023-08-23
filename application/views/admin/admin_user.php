                <div class="container-fluid">
                    <div class="row">
                        <div class="col s12">
                            <div class="card">
                                <div class="card-content">
                                    <h4 class="card-title">Daftar User</h4>
                                    <h6 class="card-subtitle">You have <?php echo $jumlah; ?> User</h6>
                                    <table id="demo-foo-addrow2" class="table table-bordered table-hover toggle-circle" data-page-size="10">
                                      <thead>
                                          <tr>
                                            <th width="5%" data-sort-ignore="true"><center>No.</center></th>
                                            <th width="50%">Username / Nama Pegawai</th>
                                            <th width="25%">Kategori</th>
                                            <th width="20%" data-sort-ignore="true"><center>Action</center></th>
                                          </tr>
                                      </thead>
                                      <div class="m-t-40">
                                          <div class="d-flex">
                                              <div class="mr-auto">
                                                  <div class="form-group">
                                                    <a href="#modaltambah" class="btn btn-success btn-with-icon btn-block rounded-5 modal-trigger"><i class="far fa-file-alt"></i> Tambah User</a>
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
                                              <b><?php echo $a->username; ?></b><br/>
                                              <?php echo $a->nama;?>
                                            </td>
                                            <td>
                                              <b><?php echo $a->kategori; ?></b>
                                            </td>
                                            <td>
                                              <center>
                                                <a href="#modaledit<?php echo $a->id_user;?>" class="btn btn-small green btn-outline tooltipped modal-trigger" data-position="top" data-delay="50" data-tooltip="Edit User"><i class="far fa-file-alt"></i></a>
                                                <a href="<?php echo base_url();?>admin/reset_password/<?php echo $a->id_user;?>" class="btn btn-small blue btn-outline tooltipped" data-position="top" data-delay="50" data-tooltip="Reset Password" onclick="javascript: return confirm('Yakin akan mereset data ?')"><i class="fas fa-exchange-alt"></i></a>
                                                <a href="<?php echo base_url();?>admin/hapus_user/<?php echo $a->id_user;?>" class="btn btn-small red btn-outline tooltipped" data-position="top" data-delay="50" data-tooltip="Hapus User" onclick="javascript: return confirm('Yakin akan menghapus data ?')"><i class="fas fa-trash"></i></a>
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
                  <?php echo form_open_multipart('admin/input_user','class="col s12"');?>
                    <div class="modal-content">
                        <h4>Data User</h4>
                            <div class="row">
                                <div class="input-field col s12">
                                  <input id="nama" type="email" name="username" maxlength="100" required>
                                  <label for="nama">Username</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                  <input id="kode" type="password" name="password" maxlength="100" required>
                                  <label for="kode">Password</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12 m12">
                                  <select name="id_pegawai" required>
                                      <option value="" disabled selected>Pilih Pegawai</option>
                                      <?php foreach ($pegawai as $a) { ?>
                                        <option value="<?php echo $a->id; ?>"><?php echo $a->nama; ?></option>
                                      <?php } ?>
                                  </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12 m12">
                                  <select name="kategori" required>
                                      <option value="" disabled selected>Pilih Kategori</option>
                                      <?php foreach ($kategori_user as $a) { ?>
                                        <option value="<?php echo $a->id_kategori; ?>"><?php echo $a->kategori; ?></option>
                                      <?php } ?>
                                  </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12 m12">
                                  <select name="is_kontrak" required>
                                      <option value="" disabled selected>Kategori Pengeluaran</option>
                                      <option value="0">Pengajuan RKAKL</option>
                                      <option value="1">Pengajuan Rencana Operasional</option>
                                  </select>
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
                <div id="modaledit<?php echo $a->id_user;?>" class="modal">
                  <?php echo form_open_multipart('admin/edit_user');?>
                    <div class="modal-content">
                        <h4>Data User</h4>
                            <div class="row">
                                <div class="input-field col s12">
                                  <input id="id_user" type="text" name="id_user" maxlength="100" value="<?php echo $a->id_user; ?>" hidden>
                                  <input id="username" type="email" name="username" maxlength="100" value="<?php echo $a->username; ?>" required disabled>
                                  <label for="username">Username</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                  <select name="id_pegawai" required>
                                      <option value="<?php echo $a->id_pegawai; ?>" selected><?php echo $a->nama; ?></option>
                                      <?php foreach ($pegawai as $b) { ?>
                                        <option value="<?php echo $b->id; ?>"><?php echo $b->nama; ?></option>
                                      <?php } ?>
                                  </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                  <select name="kategori" required>
                                      <option value="<?php echo $a->id_kategori; ?>" selected><?php echo $a->kategori; ?></option>
                                      <?php foreach ($kategori_user as $c) { ?>
                                        <option value="<?php echo $c->id_kategori; ?>"><?php echo $c->kategori; ?></option>
                                      <?php } ?>
                                  </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12 m12">
                                  <select name="is_kontrak" required>
                                    <?php if ($a->is_kontrak == 1) { ?>
                                      <option value="<?php echo $a->is_kontrak; ?>" selected>Pengajuan Rencana Operasional</option>
                                      <option value="0">Pengajuan RKAKL</option>
                                    <?php } else { ?>
                                      <option value="<?php echo $a->is_kontrak; ?>" selected>Pengajuan RKAKL</option>
                                      <option value="1">Pengajuan Rencana Operasional</option>
                                    <?php } ?>
                                  </select>
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
