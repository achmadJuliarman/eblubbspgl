<div id="main">
  <div class="row">
    <div class="col s12">
      <div class="container">
        <div class="section section-data-tables">
          <div class="card-content">
            <div class="row">
              <div class="col s12">
                <div class="card-panel gradient-45deg-light-blue-cyan" style="color: rgba(255, 255, 255, 0.901961);">
                  <span style="color: rgba(255, 255, 255, 0.901961);font-size:20px;">
                    <center>FORM Tambah Data PO Lainnya</center>
                  </span>
                </div>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-content">
              <?php echo form_open_multipart('bendahara_penerimaan/tambah_po'); ?>
              <div class="row">
                <div class="input-field col s12 m4">
                  <select name="id_jasa" required>
                    <option value="" disabled selected>Pilih Layanan</option>
                    <?php foreach ($result as $a) { ?>
                      <option value="<?php echo $a->id_detail; ?>"><?php echo $a->nama_layanan; ?></option>
                    <?php } ?>
                  </select>
                  <label>Pilih Layanan</label>
                </div>
                <div class="input-field col s12 m4">
                  <input id="kategori" type="text" name="kategori" value="<?php echo $kategori; ?>" hidden>
                  <input id="nomor_kontrak" type="text" name="no_invoice" required>
                  <label for="no_kontrak">Nomor PO</label>
                </div>
                <div class="input-field col s12 m4">
                  <input id="a8" type="date" name="tgl_termin" required>
                  <label for="ttd_kontrak">Tanggal PO</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12 m8">
                  <select class="select2 browser-default" name="nama_perusahaan" required>
                    <option value="" disabled selected>Pilih Client</option>
                    <?php foreach ($result_client_all as $a) { ?>
                      <option value="<?php echo $a->nama_perusahaan; ?>"><?php echo $a->nama_perusahaan; ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="input-field col s12 m4">
                  <input id="a9" type="number" name="nilai_kontrak" maxlength="20" min="1" required>
                  <label for="a9">Biaya</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12">
                  <label for="message5">Keterangan</label>
                  <br><br>
                  <textarea id="textarea2" class="materialize-textarea" style="height: 75px;" name="keterangan"></textarea>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12">
                  <button class="btn cyan waves-effect waves-light left" type="submit" name="action"><i class="material-icons left">send</i>Simpan</button>
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