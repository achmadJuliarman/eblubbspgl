    <div class="container-fluid">
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                      <h5 class="card-title activator">Tambah Data Lab</h5>
                      <?php echo form_open_multipart('bendahara_penerimaan/tambah_po');?>
                      <div class="row">
                          <div class="input-field col s12 m6 l6">
                              <input id="nomor_kontrak" type="text" name="no_invoice" required>
                              <label for="no_kontrak">Nomor PO</label>
                          </div>
                          <div class="input-field col s12 m6 l6">
                              <input id="a8" type="date" name = "tgl_termin" required>
                              <label for="ttd_kontrak">Tanggal PO</label>
                          </div>
                      </div>
                          <!-- <div class="row">
                              <div class="input-field col s12">
                                  <input id="judul_kontrak" type="text" name= "nama_kontrak" required>
                                  <label for="judul_kontrak">Nama PO</label>
                              </div>
                          </div> -->
                            <div class="row">
                                <div class="input-field col s12 m6">
                                  <input id="kategori" type="text" name="kategori" value="<?php echo $kategori; ?>" hidden>

                                    <input type="text" id="autocomplete-input" class="autocomplete" name="nama_perusahaan" required>
                                    <label for="autocomplete-input">Nama Client</label>
                                </div>
                                <div class="input-field col s12 m6">
                                  <select name="id_jasa" required>
                                      <option value="" disabled selected>Pilih Lab Pengujian</option>
                                      <?php foreach ($result as $a) { ?>
                                        <option value="<?php echo $a->id_detail; ?>"><?php echo $a->nama_layanan; ?></option>
                                      <?php } ?>
                                  </select>
                                  <label>Pilih Lab Pengujian</label>
                                </div>
                            </div>
                            <div class="row">
                              <div class="input-field col s12 m4">
                                <input id="a6" type="text" name="no_lab" required>
                                  <label for="a10">Nomor Lab</label>
                              </div>
                              <div class="input-field col s12 m4">
                                <input id="a6" type="number" name="jumlah_sample" maxlength="20" min="1" required>
                                  <label for="a10">Jumlah Sample</label>
                              </div>
                                <div class="input-field col s12 m4">
                                    <input id="a6" type="number" name="nilai_kontrak" maxlength="20" min="1" required>
                                    <label for="a9">Biaya</label>
                                </div>
                            </div>
                          <div class="row">
                              <div class="input-field col s12">
                                <label for="message5">Keterangan</label>
                                  <textarea id="mymce" name="keterangan"></textarea>
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
