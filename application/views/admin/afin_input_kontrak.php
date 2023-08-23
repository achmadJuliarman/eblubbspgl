    <div class="container-fluid">
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                      <h5 class="card-title activator">Tambah Data Kontrak</h5>
                      <?php echo form_open_multipart('afin/tambah_kontrak');?>
                          <div class="row">
                              <div class="input-field col s12">
                                  <input id="judul_kontrak" type="text" name= "nama_kontrak" required>
                                  <label for="judul_kontrak">Judul Kontrak</label>
                              </div>
                          </div>
                            <div class="row">
                                <div class="input-field col s12 m6 l6">
                                    <input id="nomor_kontrak" type="text" name = "no_kontrak" required>
                                    <label for="no_kontrak">Nomor Kontrak</label>
                                </div>
                                <div class="input-field col s12 m6 l6">
                                    <input id="a8" type="date" name = "tgl_ttd" required>
                                    <label for="ttd_kontrak">Tanggal Tanda Tangan Kontrak</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12 m6 l6">
                                    <select name="rumah_layanan" required>
                                        <option value="" disabled selected>Pelaksana Layanan</option>
                                        <?php foreach ($rumah_layanan as $a) { ?>
                                          <option value="<?php echo $a->id_rumah_layanan; ?>"><?php echo $a->kode." - ".$a->nama; ?></option>
                                        <?php } ?>
                                    </select>
                                    <label>Pilih Pelaksana Layanan</label>
                                </div>
                                <div class="input-field col s12 m6 l6">
                                  <select name="jasa" required>
                                      <option value="" disabled selected>Jenis Layanan</option>
                                      <?php foreach ($detail_layanan as $a) { ?>
                                        <option value="<?php echo $a->id_detail; ?>"><?php echo $a->kode_layanan." - ".$a->nama_layanan; ?></option>
                                      <?php } ?>
                                  </select>
                                  <label>Pilih Jenis Layanan</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12 m6 l6">
                                  <input type="text" id="autocomplete-input" class="autocomplete" name="nama_perusahaan" required>
                                  <label for="autocomplete-input">Nama Client</label>
                                    <!-- <select name="perusahaan" required>
                                        <option value="" disabled selected>Perusahaan/Client</option>
                                        <?php foreach ($perusahaan as $a) { ?>
                                          <option value="<?php echo $a->id_perusahaan; ?>"><?php echo $a->nama_perusahaan; ?></option>
                                        <?php } ?>
                                    </select>
                                    <label>Pilih Perusahaan/Client</label> -->
                                </div>
                                <div class="input-field col s12 m6 l6">
                                  <select class="select2" name="pic" required>
                                      <option value="" disabled selected>Pilih PIC</option>
                                      <?php foreach ($pegawai as $a) { ?>
                                        <option value="<?php echo $a->id; ?>"><?php echo $a->nip." - ".$a->nama; ?></option>
                                      <?php } ?>
                                  </select>
                                  <!-- <select class="browser-default">
                                      <option value="" disabled selected>Choose your option</option>
                                      <?php foreach ($pegawai as $a) { ?>
                                        <option value="<?php echo $a->id; ?>"><?php echo $a->nip." - ".$a->nama; ?></option>
                                      <?php } ?>
                                  </select> -->
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12 m6 l6">
                                    <input id="a9" type="date" name = "tgl_mulai" required>
                                    <label for="a9">Tanggal Mulai Kontrak</label>
                                </div>
                                <div class="input-field col s12 m6 l6">
                                    <input id="a10" type="date" name = "tgl_akhir" required>
                                    <label for="a10">Tanggal Selesai Kontrak</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12 m3">
                                    <input id="a6" type="number" name="termin" maxlength="20" min="1" required>
                                    <label for="a9">Jumlah Termin</label>
                                </div>
                                <!-- <div class="input-field col s12 m2">
                                    <input id="a6" type="number" name="max_operasional" maxlength="3" value="70" required>
                                    <label for="a9">Max. Opersional</label>
                                </div> -->
                                <div class="input-field col s12 m9">
                                  <input id="status" type="text" name="status" value="K" hidden>
                                  <input id="a6" type="number" name="nilai_kontrak" maxlength="20" min="1" required>
                                  <label for="a10">Nilai Kontrak (dalam Rupiah)</label>
                                </div>
                                <!-- <div class="input-field col s12 m3">
                                  <select name="status">
                                      <option value="" disabled selected>Status Kontrak</option>
                                      <option value="K">Kontrak</option>
                                      <option value="PO">PO</option>
                                  </select>
                                  <label for="a10">Status</label> -->
                                </div>
                          <div class="row">
                              <div class="input-field col s12">
                                <label for="message5">Ruang Lingkup</label>
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
