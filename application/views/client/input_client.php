<div id="main">
      <div class="row">
        <div class="col s12">
            <div class="container">
                <div class="section section-data-tables">
                  <div class="card-content">
                    <div class="row">
                      <div class="col s12">
                          <div class="card-panel gradient-45deg-light-blue-cyan" style="color: rgba(255, 255, 255, 0.901961);">
                            <span style="color: rgba(255, 255, 255, 0.901961);font-size:20px;"><center>FORM Tambah Data CLIENT</center></span>
                          </div>
                      </div>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-content">
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
                              <div class="input-field col s12 m6 l4">
                                  <input id="nomor" type="number" name = "no_telp"  min="1" required>
                                  <label for="nomor">Nomor Telepon</label>
                              </div>
                              <div class="input-field col s12 m6 l4">
                                  <input id="pj" type="text" name = "penanggung_jawab" required>
                                  <label for="pj">Nama Penanggung Jawab</label>
                              </div>
                              <div class="input-field col s12 m6 l4">
                                  <input id="npwp" type="number" name= "npwp" min="1" required>
                                  <label for="npwp">NPWP / NIK</label>
                              </div>
                          </div>
                          <div class="row">
                            <div class="input-field col s6">
                                <input id="bidang_pekerjaan" type="text" name= "bidang_pekerjaan" required>
                                <label for="bidang_pekerjaan">Bidang Pekerjaan</label>
                            </div>
                              <div class="input-field col s6">
                                  <select class="error validate" name="kategori" required>
                                      <option value="" selected>Pilih Kategori</option>
                                      <?php foreach ($kategori as $a) { ?>
                                        <option value="<?php echo $a->id_kategori; ?>"><?php echo $a->kategori; ?></option>
                                      <?php } ?>
                                  </select>
                                  <label for="kategori">Pilih Kategori</label>
                              </div>
                          </div>
                          <div class="row">
                              <div class="input-field col s12">
                                <button class="btn cyan waves-effect waves-light left" type="submit" name="action" onclick="javascript: return confirm('Yakin akan menyimpan data?')"><i class="material-icons left">send</i>Simpan</button>
                              </div>
                          </div>
                      </form>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
