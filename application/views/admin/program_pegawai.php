                <div class="container-fluid">
                    <div class="row">
                        <div class="col s12">
                            <div class="card">
                                <div class="card-content">
                                    <h4 class="card-title">Daftar Pegawai</h4>
                                    <h6 class="card-subtitle">You have <?php echo $jumlah; ?> Pegawai</h6>
                                    <table id="demo-foo-addrow2" class="table table-bordered table-hover toggle-circle" data-page-size="10">
                                      <thead>
                                          <tr>
                                            <th width="5%" data-sort-ignore="true"><center>No.</center></th>
                                            <th width="50%">NIP / NAMA</th>
                                            <th width="15%">Jabatan</th>
                                            <th width="10%">Kategori</th>
                                            <th width="20%" data-sort-ignore="true"><center>Action</center></th>
                                          </tr>
                                      </thead>
                                      <div class="m-t-40">
                                          <div class="d-flex">
                                              <div class="mr-auto">
                                                  <div class="form-group">
                                                    <a href="#modaltambah" class="btn btn-success btn-with-icon btn-block rounded-5 modal-trigger"><i class="far fa-file-alt"></i> Tambah Pegawai</a>
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
                                              <b><?php echo $a->nip." - ".$a->nama; ?></b>
                                            </td>
                                            <td>
                                              <b><?php echo $a->jabatan; ?></b>
                                            </td>
                                            <td>
                                              <b><?php echo $a->kategori; ?></b>
                                            </td>
                                            <td>
                                              <center>
                                                <a href="#modaledit<?php echo $a->id;?>" class="btn btn-small green btn-outline tooltipped modal-trigger" data-position="top" data-delay="50" data-tooltip="Edit Pegawai"><i class="far fa-file-alt"></i></a>
                                                <a href="<?php echo base_url();?>program/hapus_pegawai/<?php echo $a->id;?>" class="btn btn-small red btn-outline tooltipped" data-position="top" data-delay="50" data-tooltip="Hapus Pegawai" onclick="javascript: return confirm('Yakin akan menghapus data ?')"><i class="fas fa-trash"></i></a>
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
                  <?php echo form_open_multipart('program/input_pegawai');?>
                    <div class="modal-content">
                        <h4>Data Pegawai</h4>
                            <div class="row">
                                <div class="input-field col s12">
                                  <input id="nama" type="number" name="nip" maxlength="20" min="1" required>
                                  <label for="nama">NIP</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                  <input id="kode" type="text" name="nama" maxlength="100" required>
                                  <label for="kode">Nama Pegawai</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                  <select name="id_jabatan" required>
                                      <option value="" disabled selected>Pilih Jabatan</option>
                                      <?php foreach ($jabatan as $a) { ?>
                                        <option value="<?php echo $a->id_jabatan; ?>"><?php echo $a->jabatan; ?></option>
                                      <?php } ?>
                                  </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                  <select name="id_kategori" required>
                                      <option value="" disabled selected>Pilih Kategori</option>
                                      <?php foreach ($kategori as $a) { ?>
                                        <option value="<?php echo $a->id_kategori; ?>"><?php echo $a->kategori; ?></option>
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

                <?php foreach ($result AS $a) { ?>
                <div id="modaledit<?php echo $a->id?>" class="modal">
                  <?php echo form_open_multipart('program/edit_pegawai');?>
                    <div class="modal-content">
                        <h4>Data Pegawai</h4>
                            <div class="row">
                                <div class="input-field col s12">
                                  <input id="id" type="text" name="id" maxlength="100" value="<?php echo $a->id; ?>" hidden>
                                  <input id="kode" type="number" name="nip" maxlength="20" value="<?php echo $a->nip; ?>" min="1" required>
                                  <label for="kode">NIP</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                  <input id="nama" type="text" name="nama" maxlength="100" value="<?php echo $a->nama; ?>" required>
                                  <label for="nama">Nama Pegawai</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                  <select name="id_jabatan" required>
                                      <option value="<?php echo $a->id_jabatan; ?>" selected><?php echo $a->jabatan; ?></option>
                                      <?php foreach ($jabatan as $b) { ?>
                                        <option value="<?php echo $b->id_jabatan; ?>"><?php echo $b->jabatan; ?></option>
                                      <?php } ?>
                                  </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                  <select name="id_kategori" required>
                                      <option value="<?php echo $a->id_kategori; ?>" selected><?php echo $a->kategori; ?></option>
                                      <?php foreach ($kategori as $c) { ?>
                                        <option value="<?php echo $c->id_kategori; ?>"><?php echo $c->kategori; ?></option>
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
