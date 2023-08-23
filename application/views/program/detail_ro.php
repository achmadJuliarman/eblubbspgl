<div id="main">
      <div class="row">
        <div class="col s12">
            <div class="container">
                <div class="section section-data-tables">
                  <div class="card-content">
                    <div class="row">
                      <div class="col s12">
                          <div class="card-panel gradient-45deg-light-blue-cyan" style="color: rgba(255, 255, 255, 0.901961);">
                            <span style="color: rgba(255, 255, 255, 0.901961);font-size:20px;"><center>DETAIL KONTRAK</center></span>
                          </div>
                      </div>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-content">
                        <small>Judul Kontrak </small>
                        <h6><b><?php echo $result->nama_kontrak;?></b></h6>
                        <small>Pelaksana Layanan </small>
                        <h6><?php echo $result->rumah_layanan;?></h6>
                        <small>Pejabat Teknis </small>
                        <h6><?php echo $result->pejabat_teknis;?></h6>
                        <small>Nilai Kontrak</small>
                        <h6><?php echo "Rp. ".number_format($result->nilai_kontrak,0,'','.' ).",-"; ?></h6>
                        <small>Tanggal Pelaksanaan</small>
                        <h6><?php echo $result->tgl_mulai." s/d ".$result->tgl_akhir;?></h6>
                        <small>Jumlah Termin</small>
                        <h6><?php echo $result->termin;?></h6>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-content">
                    <table class="table table-bordered table-hover toggle-circle">
                      <thead>
                          <tr>
                            <th width="5%" data-sort-ignore="true"><center>No.</center></th>
                            <th width="50%">Kode Akun / Nama Kegiatan</th>
                            <th width="25%" data-sort-ignore="true"><center>Jumlah</center></th>
                            <th width="20%" data-sort-ignore="true"><center>Action</center></th>
                          </tr>
                      </thead>
                      <div class="m-t-40">
                          <div class="d-flex">
                              <div class="mrl-auto">
                                  <div class="form-group">
                                    <a href="<?php echo base_url(); ?>pejabat_teknis/setting_kontrak/<?php echo $result->id_kontrak; ?>" class="btn btn-small green btn-outline" ><i class="material-icons left">home</i> Kembali Ke Kontrak</a>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <tbody>
                        <?php $no=1; foreach($result_ro AS $a) { ?>
                          <tr>
                            <td><center><?= $no ?></center></td>
                            <td>
                              <?php echo $a->kode." - ".$a->nama_akun; ?>
                              <br>
                              <b><?php echo $a->nama_kegiatan; ?></b>
                            </td>
                            <td>
                              <center><?php echo "Rp. ".number_format($a->biaya,0,'','.' ).",-"; ?></center>
                            </td>
                            <td>
                              <center>
                              <a href="#editro<?php echo $a->id_ro;?>" class="btn btn-floating blue btn-outline tooltipped modal-trigger" data-position="top" data-delay="50" data-tooltip="Edit RO"><i class="material-icons dp48">edit</i></a>
                              <?php $cek = $this->db->query("SELECT * FROM pengajuan WHERE id_ro = $a->id_ro")->num_rows(); ?>
                              <?php if ($cek < 1) { ?>
                                <a href="<?php echo base_url();?>program/hapus_ro/<?php echo $a->id_ro;?>/<?php echo $a->id_kontrak;?>/<?php echo $a->akun;?>" class="btn btn-floating red btn-outline tooltipped" data-position="top" data-delay="50" data-tooltip="Hapus RO" onclick="javascript: return confirm('Yakin akan menghapus data ?')"><i class="material-icons dp48">delete</i></a>
                              <?php } ?>
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
    </div>
</div>

                <?php foreach ($result_ro as $a) { ?>
                <div id="editro<?php echo $a->id_ro; ?>" class="modal">
                  <div class="modal-content">
                      <h4>Data RO</h4>
                        <?php echo form_open_multipart('program/edit_ro');?>
                          <div class="row">
                              <div class="input-field col s12 l12">
                                <input id="judul_kontrak" type="text" name= "id_kontrak" value="<?php echo $result->id_kontrak; ?>" hidden>
                                <input id="akun" type="text" name= "akun" value="<?php echo $a->akun; ?>" hidden>
                                <input id="id_ro" type="text" name= "id_ro" value="<?php echo $a->id_ro; ?>" hidden>
                                <?php echo $a->nama_kegiatan; ?>
                              </div>
                              <div class="input-field col s12 l12">
                                  <input id="a6" type="number" name="biaya" value="<?php echo $a->biaya; ?>" maxlength="20" min="1" required>
                                  <label for="a6">Jumlah </label>
                              </div>
                          </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <button class="btn cyan waves-effect waves-light left" type="submit" name="action">Simpan</button>
                            </div>
                        </div>
                      </form>
                    </div>
                </div>
                <?php } ?>
