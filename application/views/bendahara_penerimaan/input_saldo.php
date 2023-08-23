<?php
$kode_pengelolaan = $datpil->kode_pengelolaan;
$kode_operasional = $datpil->kode_operasional;
$kode_dana_kelola = $datpil->kode_dana_kelola;
$rek_pengelolaan = $datpil->rek_pengelolaan;
$saldo_pengelolaan = $datpil->saldo_pengelolaan;
$rek_operasional = $datpil->rek_operasional;
$saldo_operasional = $datpil->saldo_operasional;
$rek_dana_kelola = $datpil->rek_dana_kelola;
$saldo_dana_kelola = $datpil->saldo_dana_kelola;
$rek_deposito = $datpil->rek_deposito;
$saldo_deposito = $datpil->saldo_deposito;
?>

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
                    <center>FORM UPDATE Data Saldo</center>
                  </span>
                </div>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-content">
              <?php echo form_open_multipart('bendahara_penerimaan/input_saldo'); ?>
              <div class="row">
                <div class="input-field col s12 m6">
                  <input id="a6" type="text" name="kode_pengelolaan" value="<?php echo $kode_pengelolaan; ?>" hidden>
                  <input id="a6" type="number" name="rek_pengelolaan" value="<?php echo $rek_pengelolaan; ?>" hidden>
                  <input id="a6" type="number" name="saldo_pengelolaan" value="<?php echo $saldo_pengelolaan; ?>" required>
                  <label for="a10">Saldo Rekening Pengelolaan Kas BLU</label>
                </div>
                <div class="input-field col s12 m6">
                  <input id="a6" type="text" name="kode_operasional" value="<?php echo $kode_operasional; ?>" hidden>
                  <input id="a6" type="number" name="rek_operasional" value="<?php echo $rek_operasional; ?>" hidden>
                  <input id="a6" type="number" name="saldo_operasional" value="<?php echo $saldo_operasional; ?>" required>
                  <label for="a10">Saldo Rekening Operasional BLU</label>
                </div>
                <div class="input-field col s12 m6">
                  <input id="a6" type="text" name="kode_dana_kelola" value="<?php echo $kode_dana_kelola; ?>" hidden>
                  <input id="a6" type="number" name="rek_dana_kelola" value="<?php echo $rek_dana_kelola; ?>" hidden>
                  <input id="a6" type="number" name="saldo_dana_kelola" value="<?php echo $saldo_dana_kelola; ?>" required>
                  <label for="a10">Saldo Rekening Dana Kelolaan BLU</label>
                </div>
                <div class="input-field col s12 m6">
                  <input id="a6" type="text" name="kode_deposito" value="<?php echo $kode_deposito; ?>" hidden>
                  <input id="a6" type="number" name="rek_deposito" value="<?php echo $rek_deposito; ?>" hidden>
                  <input id="a6" type="number" name="saldo_deposito" value="<?php echo $saldo_deposito; ?>" required>
                  <label for="a10">Saldo Rekening Deposito</label>
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

          <div class="card">
            <div class="card-content">
              <div class="row">
                <div class="col s12">
                  <div class="card-panel gradient-45deg-light-blue-cyan" style="color: rgba(255, 255, 255, 0.901961);">
                    <span style="color: rgba(255, 255, 255, 0.901961);font-size:20px;">
                      <center>Saldo Rekening – Operasional</center>
                    </span>
                  </div>
                  <div class="container">
                    <div class="section section-data-tables">
                      <div class="card">
                        <div class="card-content">
                          <!-- <h4 class="card-title">Daftar Kontrak</h4> -->
                          <a href="#modaloperasional" class="btn btn-success btn-with-icon btn-block rounded-5 modal-trigger"><i class="far fa-file-alt"></i> Tambah Rekening</a>
                          <div class="row">
                            <div class="col s12">
                              <table id="example" class="display table table-bordered" cellspacing="0" width="100%">
                                <!-- <table id="page-length-option" class="responsive-table" width="100%"> -->
                                <thead>
                                  <tr>
                                    <th style="text-align:center;">Nomor Rekening</th>
                                    <th style="text-align:center;">Saldo Akhir</th>
                                    <th style="text-align:center;">Bank</th>
                                    <th style="text-align:center;">Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                  setlocale(LC_MONETARY, "in_ID");
                                  foreach ($operasional as $ops) { ?>
                                    <tr>
                                      <td style="text-align:center;"><?php echo $ops->no_rekening; ?></td>
                                      <td style="text-align:center;">Rp<?php echo number_format($ops->saldo_akhir, 0); ?></td>
                                      <td style="text-align:center;"><?php echo $ops->nama_bank ?></td>
                                      <td style="text-align:center;"><a href="#modaleditops<?php echo $ops->id_operasional; ?>" class="btn btn-small blue btn-outline tooltipped modal-trigger" data-position="top" data-delay="50" data-tooltip="Update Saldo"><i class="far fa-file-alt">Edit</i></a>
                                        <a href="<?php echo base_url(); ?>bendahara_penerimaan/delete_operasional/<?php echo $ops->id_operasional; ?>" class="btn btn-small red btn-outline tooltipped" data-position="top" data-delay="50" data-tooltip="Hapus Deposito" onclick="javascript: return confirm('Yakin akan menghapus data ?')"><i class="fas fa-trash">Hapus</i></a>
                                      </td>

                                    </tr>
                                  <?php
                                  } ?>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-content">
              <div class="row">
                <div class="col s12">
                  <div class="card-panel gradient-45deg-light-blue-cyan" style="color: rgba(255, 255, 255, 0.901961);">
                    <span style="color: rgba(255, 255, 255, 0.901961);font-size:20px;">
                      <center>Saldo Rekening – Pengelolaan Kas</center>
                    </span>
                  </div>
                  <div class="container">
                    <div class="section section-data-tables">
                      <div class="card">
                        <div class="card-content">
                          <!-- <h4 class="card-title">Daftar Kontrak</h4> -->
                          <a href="#modaldeposito" class="btn btn-success btn-with-icon btn-block rounded-5 modal-trigger"><i class="far fa-file-alt"></i> Tambah Bilyet</a>
                          <div class="row">
                            <div class="col s12">
                              <table id="example" class="display table table-bordered" cellspacing="0" width="100%">
                                <!-- <table id="page-length-option" class="responsive-table" width="100%"> -->
                                <thead>
                                  <tr>
                                    <th style="text-align:center;">No Bilyet</th>
                                    <th style="text-align:center;">Nilai Deposito</th>
                                    <th style="text-align:center;">Nilai Bunga (Rp)</th>
                                    <th style="text-align:center;">Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                  setlocale(LC_MONETARY, "in_ID");
                                  foreach ($deposito as $a) { ?>
                                    <tr>
                                      <td style="text-align:center;"><?php echo $a->no_bilyet; ?></td>
                                      <td style="text-align:center;">Rp<?php echo number_format($a->nilai_deposito, 0); ?></td>
                                      <td style="text-align:center;">Rp<?php echo number_format($a->nilai_bunga, 0); ?></td>
                                      <td style="text-align:center;"><a href="#modaledit<?php echo $a->id_deposito; ?>" class="btn btn-small blue btn-outline tooltipped modal-trigger" data-position="top" data-delay="50" data-tooltip="Update Saldo"><i class="far fa-file-alt">Edit</i></a>
                                        <a href="<?php echo base_url(); ?>bendahara_penerimaan/delete_deposito/<?php echo $a->id_deposito; ?>" class="btn btn-small red btn-outline tooltipped" data-position="top" data-delay="50" data-tooltip="Hapus Deposito" onclick="javascript: return confirm('Yakin akan menghapus data ?')"><i class="fas fa-trash">Hapus</i></a>
                                      </td>

                                    </tr>
                                  <?php
                                  } ?>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div id="modaloperasional" class="modal">
  <?php echo form_open_multipart('bendahara_penerimaan/input_operasional'); ?>
  <div class="modal-content">
    <h4>Input Rekening</h4>
    <div class="row">
      <div class="input-field col s12">
        <input id="a6" type="text" name="no_rekening">
        <label for="a9">Nomor Rekening</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s12">
        <input id="a6" type="number" name="saldo_akhir">
        <label for="a9">Saldo Akhir</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s12">
        <select name="kdbank">
        <option value="" disabled selected>Bank</option>
            <?php foreach ($bank as $b) { ?>
              <option value="<?php echo $b->kdbank; ?>"><?php echo $b->nama_bank ?></option>
            <?php } ?>
        </select>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s12">
        <button class="btn cyan waves-effect waves-light left" type="submit" name="action">Simpan</button>
      </div>
    </div>
  </div>
  </form>
</div>

<?php foreach ($operasional as $ops) { ?>
  <div id="modaleditops<?php echo $ops->id_operasional; ?>" class="modal">
    <?php echo form_open_multipart('bendahara_penerimaan/edit_operasional'); ?>
    <div class="modal-content">
      <h4>Update Rekening Operasional</h4>
      <div class="row">
        <div class="input-field col s12">
          <input id="a6" type="text" name="no_rekening" value="<?php echo $ops->no_rekening; ?>">
          <label for="a9">Nomor Rekening</label>
        </div>
      </div>
      <div class="row">
        <input id="a6" type="hidden" name="id_operasional" value="<?php echo $ops->id_operasional; ?>">
        <div class="input-field col s12">
          <input id="a6" type="number" name="saldo_akhir" value="<?php echo $ops->saldo_akhir; ?>">
          <label for="a9">Saldo Akhir</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <select name="kdbank">
          <option value="<?php echo $ops->kdbank ?>" selected><?php echo $ops->nama_bank ?></option>
              <?php foreach ($bank as $b) { ?>
                <option value="<?php echo $b->kdbank; ?>"><?php echo $b->nama_bank ?></option>
              <?php } ?>
          </select>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <button class="btn cyan waves-effect waves-light left" type="submit" name="action">Simpan</button>
        </div>
      </div>
    </div>
    </form>
  </div>
<?php
} ?>

<div id="modaldeposito" class="modal">
  <?php echo form_open_multipart('bendahara_penerimaan/input_deposito'); ?>
  <div class="modal-content">
    <h4>Input Deposito</h4>
    <div class="row">
      <div class="input-field col s12">
        <input id="a6" type="number" name="no_bilyet">
        <label for="a9">Nomor Bilyet</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s12">
        <input id="a6" type="number" name="nilai_deposito">
        <label for="a9">Nilai Deposito</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s12">
        <input id="a6" type="number" name="nilai_bunga">
        <label for="a9">Nilai Bunga (Rp)</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s12">
        <button class="btn cyan waves-effect waves-light left" type="submit" name="action">Simpan</button>
      </div>
    </div>
  </div>
  </form>
</div>

<?php foreach ($deposito as $a) { ?>
  <div id="modaledit<?php echo $a->id_deposito; ?>" class="modal">
    <?php echo form_open_multipart('bendahara_penerimaan/edit_deposito'); ?>
    <div class="modal-content">
      <h4>Update Deposito</h4>
      <div class="row">
        <div class="input-field col s12">
          <input id="a6" type="text" name="no_bilyet" value="<?php echo $a->no_bilyet; ?>">
          <label for="a9">Nomor Bilyet</label>
        </div>
      </div>
      <div class="row">
        <input id="a6" type="hidden" name="id_deposito" value="<?php echo $a->id_deposito; ?>">
        <div class="input-field col s12">
          <input id="a6" type="number" name="nilai_deposito" value="<?php echo $a->nilai_deposito; ?>">
          <label for="a9">Nilai Deposito</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input id="a6" type="number" name="nilai_bunga" value="<?php echo $a->nilai_bunga; ?>">
          <label for="a9">Nilai Bunga (Rp)</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <button class="btn cyan waves-effect waves-light left" type="submit" name="action">Simpan</button>
        </div>
      </div>
    </div>
    </form>
  </div>
<?php
} ?>
