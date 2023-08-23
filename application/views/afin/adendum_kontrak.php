<div id="main">
      <div class="row">
        <div class="col s12">
            <div class="container">
                <div class="section section-data-tables">
                  <div class="card-content">
                    <div class="row">
                      <div class="col s12">
                          <div class="card-panel gradient-45deg-light-blue-cyan" style="color: rgba(255, 255, 255, 0.901961);">
                            <span style="color: rgba(255, 255, 255, 0.901961);font-size:20px;"><center>FORM Adendum Kontrak</center></span>
                          </div>
                      </div>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-content">
                      <?php echo form_open_multipart('afin/simpan_adendum_kontrak');?>
                          <div class="row">
                              <div class="input-field col s12">
                                  <input id="id_kontrak" type="text" name= "id_kontrak" value="<?php echo $result->id_kontrak; ?>" hidden>
                                  <input id="judul_kontrak" type="text" name= "nama_kontrak" value="<?php echo $result->nama_kontrak; ?>" disabled>
                                  <label for="judul_kontrak">Judul Kontrak</label>
                              </div>
                          </div>
                          <div class="row">
                              <div class="input-field col s12 m6 l6">
                                  <input id="nomor_kontrak" type="text" name = "no_kontrak"value="<?php echo $result->no_kontrak; ?>" required>
                                  <label for="no_kontrak">Nomor Kontrak</label>
                              </div>
                              <div class="input-field col s12 m6 l6">
                                  <input id="a8" type="date" name = "tgl_ttd" value="<?php echo $result->tgl_ttd; ?>" required>
                                  <label for="ttd_kontrak">Tanggal Tanda Tangan Kontrak</label>
                              </div>
                          </div>
                          <div class="row">
                              <div class="input-field col s12 m4">
                                  <input id="a9" type="date" name = "tgl_mulai" value="<?php echo $result->tgl_mulai; ?>" required>
                                  <label for="a9">Tanggal Mulai Kontrak</label>
                              </div>
                              <div class="input-field col s12 m4">
                                  <input id="a10" type="date" name = "tgl_akhir" value="<?php echo $result->tgl_akhir; ?>" required>
                                  <label for="a10">Tanggal Selesai Kontrak</label>
                              </div>
                              <div class="input-field col s12 m4">
                                <input id="a6" type="number" name="nilai_kontrak" maxlength="20" value="<?php echo $result->nilai_kontrak; ?>" min="1" required>
                                  <label for="a10">Nilai Kontrak (dalam Rupiah)</label>
                              </div>
                          </div>
                          <div class="row">
                              <div class="input-field col s12">
                                <label for="message5">Ruang Lingkup</label>
                                <textarea id="textarea2" class="materialize-textarea" style="height: 75px;" name="keterangan"><?php echo $result->keterangan; ?></textarea>
                              </div>
                          </div>
                          <div class="row">
                              <div class="input-field col s12">
                                <label for="keterangan_adendum">Keterangan Adendum</label>
                                <input id="keterangan_adendum" type="text" name= "keterangan_adendum" required>
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
