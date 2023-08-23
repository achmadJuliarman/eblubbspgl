    <div class="container-fluid">
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                      <h5 class="card-title activator">Edit Data Perusahaan</h5>
                      <?php echo form_open_multipart('perusahaan/edit_perusahaan');?>
                          <div class="row">
                              <div class="input-field col s12">
                                  <input id="nama" type="text" name= "id_perusahaan" value="<?php echo $result->id_perusahaan; ?>" hidden>
                                  <input id="nama" type="text" name= "nama_perusahaan" value="<?php echo $result->nama_perusahaan; ?>" required>
                                  <label for="nama">Nama Perusahaan</label>
                              </div>
                          </div>
                          <div class="row">
                              <div class="input-field col s12">
                                  <input id="alamat" type="text" name= "alamat" value="<?php echo $result->alamat; ?>" required>
                                  <label for="alamat">Alamat Perusahaan</label>
                              </div>
                          </div>
                          <div class="row">
                              <div class="input-field col s12 m6 l6">
                                  <input id="nomor" type="number" min="1" name = "no_telp" value="<?php echo $result->no_telp; ?>" required>
                                  <label for="nomor">Nomor Telepon</label>
                              </div>
                              <div class="input-field col s12 m6 l6">
                                  <input id="pj" type="text" name = "penanggung_jawab" value="<?php echo $result->penanggung_jawab; ?>" required>
                                  <label for="pj">Nama Penanggung Jawab</label>
                              </div>
                          </div>
                          <div class="row">
                              <div class="input-field col s12">
                                  <input id="npwp" type="number" min="1" name= "npwp" value="<?php echo $result->npwp; ?>" required>
                                  <label for="npwp">NPWP</label>
                              </div>
                          </div>
                          <div class="row">
                              <div class="input-field col s6">
                                  <input id="bidang_pekerjaan" type="text" name= "bidang_pekerjaan" value="<?php echo $result->bidang_pekerjaan; ?>" required>
                                  <label for="bidang_pekerjaan">Bidang Pekerjaan</label>
                              </div>
                                <div class="input-field col s6">
                                    <select name="kategori" required>
                                        <option value="<?php echo $result->kategori; ?>" selected><?php echo $result->nama_kategori; ?></option>
                                        <?php foreach ($kategori as $a) { ?>
                                          <option value="<?php echo $a->id_kategori; ?>"><?php echo $a->kategori; ?></option>
                                        <?php } ?>
                                    </select>
                                    <label for="kategori">Pilih Kategori</label>
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
            </div>
        </div>
    </div>
