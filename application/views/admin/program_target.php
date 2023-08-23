                <div class="container-fluid">
                    <div class="row">
                        <div class="col s12">
                            <div class="card">
                                <div class="card-content">
                                  <div class="d-flex align-items-center">
                                      <div>
                                        <h4 class="card-title">Daftar Target</h4>
                                        <h6 class="card-subtitle">You have <?php echo $jumlah; ?> Target</h6>
                                      </div>
                                      <div class="ml-auto">
                                        <?php echo form_open_multipart('program/target');?>
                                          <div class="input-field dl support-select">
                                              <select name="tahun">
                                                  <?php $tahun = DATE("Y"); ?>
                                                  <option value="" selected>Pilih Tahun</option>
                                                  <option value="<?php echo $tahun; ?>"><?php echo $tahun; ?></option>
                                                  <option value="<?php echo $tahun-1; ?>"><?php echo $tahun-1; ?></option>
                                                  <option value="<?php echo $tahun-2; ?>"><?php echo $tahun-2; ?></option>
                                              </select>
                                          </div>
                                          <button class="btn btn-small green btn-outline" type="submit" name="action"><i class="fas fa-search"></i> Pilih</button>
                                        </form>
                                      </div>
                                  </div>
                                    <table id="demo-foo-addrow2" class="table table-bordered table-hover toggle-circle" data-page-size="10">
                                      <thead>
                                          <tr>
                                            <th width="5%" data-sort-ignore="true"><center>No.</center></th>
                                            <th width="30%">Pelaksana Layanan</th>
                                            <th width="45%">Target</th>
                                            <th width="20%" data-sort-ignore="true"><center>Action</center></th>
                                          </tr>
                                      </thead>
                                      <div class="m-t-40">
                                          <div class="d-flex">
                                              <div class="mr-auto">
                                                  <div class="form-group">
                                                    <a href="#modaltambah" class="btn btn-success btn-with-icon btn-block rounded-5 modal-trigger"><i class="far fa-file-alt"></i> Tambah Target</a>
                                                  </div>
                                              </div>

                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <input id="demo-input-search2" type="text" placeholder="Pencarian Data" autocomplete="off">
                                      </div>
                                      <tbody>
                                        <?php $no=1; foreach($result AS $a) { ?>
                                          <tr>
                                            <td><center><?= $no ?></center></td>
                                            <td>
                                              <b><?php echo $a->nama; ?></b>
                                            </td>
                                            <td><center><?php echo "Rp. ".number_format($a->jumlah,0,'','.' ).",-"; ?></center></td>
                                            <td>
                                              <center>
                                                <a href="#modaledit<?php echo $a->id_target;?>" class="btn btn-small green btn-outline tooltipped modal-trigger" data-position="top" data-delay="50" data-tooltip="Edit Target"><i class="far fa-file-alt"></i></a>
                                                <a href="<?php echo base_url();?>program/hapus_target/<?php echo $a->id_target;?>" class="btn btn-small red btn-outline tooltipped" data-position="top" data-delay="50" data-tooltip="Hapus Target" onclick="javascript: return confirm('Yakin akan menghapus data ?')"><i class="fas fa-trash"></i></a>
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
                  <?php echo form_open_multipart('program/input_target');?>
                    <div class="modal-content">
                        <h4>Data Target</h4>
                            <div class="row">
                                <div class="input-field col s12">
                                  <select name="id_rumah_layanan">
                                      <option value="" disabled selected>Pilih Pelaksana Layanan</option>
                                      <?php foreach ($rumah_layanan as $a) { ?>
                                        <option value="<?php echo $a->id_rumah_layanan; ?>"><?php echo $a->nama; ?></option>
                                      <?php } ?>
                                  </select>
                                </div>
                              </div>
                            <div class="row">
                                <div class="input-field col s12">
                                  <input id="nama" type="text" name="jumlah" maxlength="100" required>
                                  <label for="nama">Target</label>
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
                <div id="modaledit<?php echo $a->id_target?>" class="modal">
                  <?php echo form_open_multipart('program/edit_target');?>
                    <div class="modal-content">
                        <h4>Data Target</h4>
                            <div class="row">
                                <div class="input-field col s12">
                                  <input id="id_target" type="text" name="id_target" maxlength="100" value="<?php echo $a->id_target; ?>" hidden>
                                  <?php echo $a->nama; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                  <input id="nama" type="text" name="jumlah" maxlength="100" value="<?php echo $a->jumlah; ?>" required>
                                  <label for="nama">Target</label>
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
