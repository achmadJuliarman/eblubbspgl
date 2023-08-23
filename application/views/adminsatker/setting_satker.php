<div id="main">
      <div class="row">
        <div class="col s12">
            <div class="container">
                <div class="section section-data-tables">
                  <div class="card-content">
                    <div class="row">
                      <div class="col s12">
                          <div class="card-panel gradient-45deg-light-blue-cyan" style="color: rgba(255, 255, 255, 0.901961);">
                            <span style="color: rgba(255, 255, 255, 0.901961);font-size:20px;"><center>FORM Setting Data Satker</center></span>
                          </div>
                      </div>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-content">
                      <?php echo form_open_multipart('admin/simpan_setting_satker');?>
                      <div class="row">
                          <div class="input-field col s12 m12 l12">
                              <input id="id_satker" type="text" name="id_satker" value="<?php echo $result->id_satker; ?>" hidden>
                              <input id="nama_satker" type="text" name="nama_satker" value="<?php echo $result->nama_satker; ?>" required>
                              <label for="no_kontrak">Nama Satker</label>
                          </div>
                      </div>
                      <div class="row">
                          <div class="input-field col s12 m6 l6">
                              <input id="satker" type="number" name="satker" value="<?php echo $result->satker; ?>" required>
                              <label for="no_kontrak">Kode Satker</label>
                          </div>
                          <div class="input-field col s12 m6 l6">
                              <input id="key" type="text" name="key" value="<?php echo $result->key; ?>" required>
                              <label for="ttd_kontrak">Kode Key</label>
                          </div>
                      </div>
                          <div class="row">
                            <div class="input-field col s12 m12 l12">
                              <label for="no_kontrak">Keterangan PIC</label><br>
                            </div>
                          </div>
                          <div class="row">
                            <div class="input-field col s12 m12 l12">
                              <textarea id="basic-example" name="pic"><?php echo $result->pic; ?></textarea>
                            </div>
                          </div>
                          <div class="row">
                              <div class="input-field col s12 m6 l6">
                                  <input id="satker" type="text" name="nama_ttd" value="<?php echo $result->nama_ttd; ?>" required>
                                  <label for="no_kontrak">Nama Penandatangan</label>
                              </div>
                              <div class="input-field col s12 m6 l6">
                                  <input id="key" type="text" name="nip_ttd" value="<?php echo $result->nip_ttd; ?>" required>
                                  <label for="ttd_kontrak">NIP Penandatangan</label>
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
