    <div class="container-fluid">
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                      <h5 class="card-title activator">Tambah Data Pelanggan</h5>
                      <?php echo form_open_multipart('perusahaan/tambah_perusahaan');?>
                          <div class="row">
                              <div class="input-field col s12">
                                  <input id="nama" type="text" name= "nama_perusahaan" required>
                                  <label for="nama">Nama Pelanggan</label>
                              </div>
                          </div>
                          <div class="row">
                              <div class="input-field col s12">
                                  <input id="alamat" type="text" name= "alamat" required>
                                  <label for="alamat">Alamat Pelanggan</label>
                              </div>
                          </div>
                          <div class="row">
                              <div class="input-field col s12 m6 l6">
                                  <input id="nomor" type="number" name = "no_telp"  min="1" required>
                                  <label for="nomor">Nomor Telepon</label>
                              </div>
                              <div class="input-field col s12 m6 l6">
                                  <input id="pj" type="text" name = "penanggung_jawab" required>
                                  <label for="pj">Nama Penanggung Jawab</label>
                              </div>
                          </div>
                          <div class="row">
                              <div class="input-field col s12">
                                  <input id="npwp" type="number" name= "npwp" min="1" required>
                                  <label for="npwp">NPWP</label>
                              </div>
                          </div>
                          <div class="row">
                            <div class="input-field col s6">
                                <input id="bidang_pekerjaan" type="text" name= "bidang_pekerjaan" required>
                                <label for="bidang_pekerjaan">Bidang Pekerjaan</label>
                            </div>
                              <div class="input-field col s6">
                                  <select name="kategori" required>
                                      <option value="" disabled selected>Pilih Kategori</option>
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
