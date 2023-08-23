                <div class="container-fluid">
                    <div class="row">
                        <div class="col s12">
                            <div class="card">
                                <div class="card-content">
                                    <h4 class="card-title">Daftar Detail Layanan</h4>
                                    <h6 class="card-subtitle"><?php echo $datpil->jenis; ?></h6>
                                    <table id="demo-foo-addrow2" class="table table-bordered table-hover toggle-circle" data-page-size="10">
                                      <thead>
                                          <tr>
                                            <th width="5%" data-sort-ignore="true"><center>No.</center></th>
                                            <th width="50%">Nama Detail Layanan</th>
                                            <th width="25%" data-sort-ignore="true"><center>Kode</center></th>
                                            <th width="20%" data-sort-ignore="true"><center>Action</center></th>
                                          </tr>
                                      </thead>
                                      <div class="m-t-40">
                                          <div class="d-flex">
                                              <div class="mr-auto">
                                                  <div class="form-group">
                                                    <a href="#modaltambah" class="btn btn-success btn-with-icon btn-block rounded-5 modal-trigger"><i class="far fa-file-alt"></i> Tambah Detail Layanan</a>
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
                                              <b><?php echo $a->nama_layanan; ?></b>
                                            </td>
                                            <td>
                                              <center><?php echo $a->kode_layanan; ?></center>
                                            </td>
                                            <td>
                                              <center>
                                                <a href="#modaledit<?php echo $a->id_detail;?>" class="btn btn-small green btn-outline tooltipped modal-trigger" data-position="top" data-delay="50" data-tooltip="Edit Detail Layanan"><i class="far fa-file-alt"></i></a>
                                                <a href="<?php echo base_url();?>program/hapus_detail_layanan/<?php echo $a->id_layanan;?>/<?php echo $a->id_detail;?>" class="btn btn-small red btn-outline tooltipped" data-position="top" data-delay="50" data-tooltip="Hapus Detail Layanan" onclick="javascript: return confirm('Yakin akan menghapus data ?')"><i class="fas fa-trash"></i></a>
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
                  <?php echo form_open_multipart('program/input_detail_layanan');?>
                    <div class="modal-content">
                        <h4>Data Detail Layanan</h4>
                            <div class="row">
                                <div class="input-field col s12">
                                  <input id="id_jenis_layanan" type="text" name="id_layanan" maxlength="100" value="<?php echo $datpil->id_jenis_layanan; ?>" hidden>
                                  <input id="nama" type="text" name="nama_layanan" maxlength="100" required>
                                  <label for="nama">Nama Layanan</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                  <input id="kode" type="text" name="kode_layanan" maxlength="100" required>
                                  <label for="kode">Kode Detail Layanan</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                  <select name="id_kategori" required>
                                      <option value="" disabled selected>Pilih Kategori</option>
                                      <option value="0">Non Kategori</option>
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
                <div id="modaledit<?php echo $a->id_detail?>" class="modal">
                  <?php echo form_open_multipart('program/edit_detail_layanan');?>
                    <div class="modal-content">
                        <h4>Data Detail Layanan</h4>
                            <div class="row">
                                <div class="input-field col s12">
                                  <input id="id_layanan" type="text" name="id_layanan" maxlength="100" value="<?php echo $a->id_layanan; ?>" hidden>
                                  <input id="id_detail" type="text" name="id_detail" maxlength="100" value="<?php echo $a->id_detail; ?>" hidden>
                                  <input id="nama" type="text" name="nama_layanan" maxlength="100" value="<?php echo $a->nama_layanan; ?>" required>
                                  <label for="nama">Nama Layanan</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                  <input id="kode" type="text" name="kode_layanan" maxlength="100" value="<?php echo $a->kode_layanan; ?>" required>
                                  <label for="kode">Kode Detail Layanan</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                  <select name="id_kategori" required>
                                      <option value="<?php echo $a->id_kategori; ?>" selected><?php echo $a->kategori?></option>
                                      <option value="0">Non Kategori</option>
                                      <?php foreach ($kategori as $b) { ?>
                                        <option value="<?php echo $b->id_kategori; ?>"><?php echo $b->kategori; ?></option>
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
