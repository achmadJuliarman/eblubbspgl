    <div class="container-fluid">
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                      <h5 class="card-title activator">Tambah Data PO Lainnya</h5>
                      <?php echo form_open_multipart('bendahara_penerimaan/simpan_edit_po');?>
                      <div class="row">
                          <div class="input-field col s12 m4">
                            <select name="id_jasa" required>
                                <option value="<?php echo $hasil->id_jasa; ?>" selected><?php echo $hasil->nama_layanan;?></option>
                              <?php $jasa = $this->db->query("SELECT * FROM detail_layanan WHERE id_kategori = $kategori AND id_satker = $hasil->id_satker AND id_detail <> $hasil->id_jasa")->result(); ?>
                              <?php foreach ($jasa as $a) { ?>
                                <option value="<?php echo $a->id_detail; ?>"><?php echo $a->nama_layanan; ?></option>
                              <?php } ?>
                            </select>
                            <label>Pilih Layanan</label>
                          </div>
                          <div class="input-field col s12 m4">
                              <input id="kategori" type="text" name="kategori" value="<?php echo $kategori; ?>" hidden>
                              <input id="kategori" type="text" name="id_kontrak" value="<?php echo $hasil->id_kontrak; ?>" hidden>
                              <input id="kategori" type="text" name="id_termin" value="<?php echo $hasil->id_termin; ?>" hidden>
                              <input id="nomor_kontrak" type="text" name="no_invoice" value="<?php echo $hasil->no_invoice; ?>" required>
                              <label for="no_kontrak">Nomor PO</label>
                          </div>
                          <div class="input-field col s12 m4">
                              <input id="a8" type="date" name = "tgl_termin" required value="<?php echo $hasil->tgl_termin; ?>">
                              <label for="ttd_kontrak">Tanggal PO</label>
                          </div>
                      </div>
                          <div class="row">
                              <div class="input-field col s12 m8">
                                <input type="text" id="autocomplete-input" class="autocomplete" name="nama_perusahaan" value="<?php echo $hasil->nama_perusahaan; ?>" required>
                                <label for="autocomplete-input">Nama Client</label>
                              </div>
                              <div class="input-field col s12 m4">
                                  <input id="a9" type="number" name="nilai_kontrak" maxlength="20" value="<?php echo $hasil->nilai_kontrak; ?>" min="1" required>
                                  <label for="a9">Biaya</label>
                              </div>
                          </div>
                            <div class="row">
                                <div class="input-field col s12">
                                  <label for="message5">Keterangan</label>
                                    <textarea id="mymce" name="keterangan"><?php echo $hasil->keterangan_termin; ?></textarea>
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
