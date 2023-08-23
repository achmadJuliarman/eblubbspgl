                <div class="container-fluid">
                    <div class="row">
                        <div class="col s12">
                            <div class="card">
                                <div class="card-content">
                                    <h4 class="card-title">Daftar Pelaksana Layanan</h4>
                                    <h6 class="card-subtitle">You have <?php echo $jumlah; ?> Pelaksana Layanan</h6>
                                    <table id="demo-foo-addrow2" class="table table-bordered table-hover toggle-circle" data-page-size="10">
                                      <thead>
                                          <tr>
                                            <th width="5%" data-sort-ignore="true"><center>No.</center></th>
                                            <th width="50%">Nama Pelaksana Layanan</th>
                                            <th width="25%" data-sort-ignore="true"><center>Kode</center></th>
                                            <th width="20%" data-sort-ignore="true"><center>Action</center></th>
                                          </tr>
                                      </thead>
                                      <div class="m-t-40">
                                          <div class="d-flex">
                                              <div class="mr-auto">
                                                  <div class="form-group">
                                                    <a href="#modaltambah" class="btn btn-success btn-with-icon btn-block rounded-5 modal-trigger"><i class="far fa-file-alt"></i> Tambah Pelaksana Layanan</a>
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
                                              <b><?php echo $a->nama; ?></b><br/>
                                              Pejabat Teknis : <?php echo $a->nama_pegawai; ?>
                                            </td>
                                            <td>
                                              <center><?php echo $a->kode; ?></center>
                                            </td>
                                            <td>
                                              <center>
                                                <a href="#modaledit<?php echo $a->id_rumah_layanan;?>" class="btn btn-small green btn-outline tooltipped modal-trigger" data-position="top" data-delay="50" data-tooltip="Edit Pelaksana Layanan"><i class="far fa-file-alt"></i></a>
                                                <a href="<?php echo base_url();?>program/hapus_rumah_layanan/<?php echo $a->id_rumah_layanan;?>" class="btn btn-small red btn-outline tooltipped" data-position="top" data-delay="50" data-tooltip="Hapus Pelaksana Layanan" onclick="javascript: return confirm('Yakin akan menghapus data ?')"><i class="fas fa-trash"></i></a>
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
                  <?php echo form_open_multipart('program/input_rumah_layanan');?>
                    <div class="modal-content">
                        <h4>Data Pelaksana Layanan</h4>
                            <div class="row">
                                <div class="input-field col s12">
                                  <input id="nama" type="text" name="nama" maxlength="100" required>
                                  <label for="nama">Nama Pelaksana Layanan</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                  <input id="kode" type="text" name="kode" maxlength="100" required>
                                  <label for="kode">Kode Pelaksana Layanan</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                  <select name="id_pegawai" required>
                                      <option value="" disabled selected>Pilih Pejabat Teknis</option>
                                      <?php foreach ($result_pegawai as $a) { ?>
                                        <option value="<?php echo $a->id; ?>"><?php echo $a->nip." - ".$a->nama; ?></option>
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
                <div id="modaledit<?php echo $a->id_rumah_layanan?>" class="modal">
                  <?php echo form_open_multipart('program/edit_rumah_layanan');?>
                    <div class="modal-content">
                        <h4>Data Pelaksana Layanan</h4>
                            <div class="row">
                                <div class="input-field col s12">
                                  <input id="id_rumah_layanan" type="text" name="id_rumah_layanan" maxlength="100" value="<?php echo $a->id_rumah_layanan; ?>" hidden>
                                  <input id="nama" type="text" name="nama" maxlength="100" value="<?php echo $a->nama; ?>" required>
                                  <label for="nama">Nama Pelaksana Layanan</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                  <input id="kode" type="text" name="kode" maxlength="100" value="<?php echo $a->kode; ?>" required>
                                  <label for="kode">Kode Pelaksana Layanan</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                  <select name="id_pegawai" required>
                                      <option value="<?php echo $a->id_pegawai; ?>" selected><?php echo $a->nip." - ".$a->nama_pegawai; ?></option>
                                      <?php foreach ($result_pegawai as $b) { ?>
                                        <option value="<?php echo $b->id; ?>"><?php echo $b->nip." - ".$b->nama; ?></option>
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
