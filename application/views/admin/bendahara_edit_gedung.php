    <div class="container-fluid">
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                      <h5 class="card-title activator">Tambah Data PO Gedung</h5>
                      <?php echo form_open_multipart('bendahara_penerimaan/simpan_edit_po');?>
                      <div class="row">
                          <div class="input-field col s12 m6">
                              <input id="kategori" type="text" name="kategori" value="<?php echo $kategori; ?>" hidden>
                              <input id="kategori" type="text" name="id_kontrak" value="<?php echo $hasil->id_kontrak; ?>" hidden>
                              <input id="kategori" type="text" name="id_termin" value="<?php echo $hasil->id_termin; ?>" hidden>
                              <input id="nomor_kontrak" type="text" name="no_invoice" value="<?php echo $hasil->no_invoice; ?>" required>
                              <label for="no_kontrak">Nomor PO</label>
                          </div>
                          <div class="input-field col s12 m6 l6">
                              <input id="a8" type="date" name = "tgl_termin" value="<?php echo $hasil->tgl_termin; ?>" required>
                              <label for="ttd_kontrak">Tanggal PO</label>
                          </div>

                      </div>
                          <div class="row">
                              <div class="input-field col s12 m6">
                                <input type="text" id="autocomplete-input" class="autocomplete" name="nama_perusahaan" value="<?php echo $hasil->nama_perusahaan; ?>" required>
                                <label for="autocomplete-input">Nama Client</label>
                              </div>
                              <div class="input-field col s12 m6 l6">
                                  <input id="tgl_acara" type="date" name = "tgl_acara" value="<?php echo $hasil->tgl_acara; ?>" required>
                                  <label for="tgl_acara">Tanggal acara</label>
                              </div>
                          </div>
                            <div class="row">
                              <div class="input-field col s12 m3">
                                <select name="kategori_kesdm" required>
                                  <?php if($hasil->kategori_kesdm == 1) { ?>
                                    <option value="<?php echo $hasil->kategori_kesdm;?>">KESDM</option>
                                    <option value="2">Non KESDM</option>
                                  <?php } else { ?>
                                    <option value="<?php echo $hasil->kategori_kesdm;?>">Non KESDM</option>
                                    <option value="1">KESDM</option>
                                  <?php } ?>
                                </select>
                                <label>Pilih Kategori</label>
                              </div>
                              <div class="input-field col s12 m3">
                                <select name="id_jasa" required>
                                    <option value="<?php echo $hasil->id_jasa; ?>" selected><?php echo $hasil->nama_layanan;?></option>
                                    <?php $jasa = $this->db->query("SELECT * FROM detail_layanan WHERE id_kategori = $kategori AND id_satker = $hasil->id_satker AND id_detail <> $hasil->id_jasa")->result(); ?>
                                    <?php foreach ($jasa as $a) { ?>
                                      <option value="<?php echo $a->id_detail; ?>"><?php echo $a->nama_layanan; ?></option>
                                    <?php } ?>
                                </select>
                                <label>Pilih Gedung</label>
                              </div>
                              <div class="input-field col s12 m3">
                                <select name="waktu_acara" required>
                                    <?php if($hasil->waktu_acara == 1) { ?>
                                      <option value="<?php echo $hasil->waktu_acara;?>">Siang</option>
                                      <option value="2">Malam</option>
                                    <?php } else { ?>
                                      <option value="<?php echo $hasil->waktu_acara;?>">Malam</option>
                                      <option value="1">Siang</option>
                                    <?php } ?>
                                </select>
                                <label>Pilih Waktu Acara</label>
                              </div>
                                <div class="input-field col s12 m3">
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
