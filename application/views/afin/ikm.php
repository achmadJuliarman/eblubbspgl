<div id="main">
  <div class="row">
    <div class="col s12">
      <div class="container">
        <div class="section section-data-tables">
          <div class="card">
            <div class="card-content">
              <!-- <h4 class="card-title">Daftar Kontrak</h4> -->
              <a href="#modalikm" class="btn btn-success btn-with-icon btn-block rounded-5 modal-trigger"><i class="far fa-file-alt"></i> Tambah IKM</a>
              <div class="row">
                <div class="col s12">
                  <table id="example" class="display table table-bordered" cellspacing="0" width="100%">
                    <!-- <table id="page-length-option" class="responsive-table" width="100%"> -->
                    <thead>
                      <tr>
                        <th style="text-align:center;">Tanggal Awal</th>
                        <th style="text-align:center;" data-sort-ignore="true">Tanggal Akhir</th>
                        <th style="text-align:center;">Nilai IKM (%)</th>
                        <th style="text-align:center;">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      foreach ($last_ikm as $a) { ?>
                        <tr>
                          <td style="text-align:center;">
                            <?php echo $a->tanggal_awal; ?>
                          </td>
                          <td style="text-align:center;"><?php echo $a->tanggal_akhir; ?></td>
                          <td style="text-align:center;"><?php echo $a->nilai_ikm; ?></td>
                          <td>
                            <center><a href="<?php echo base_url(); ?>afin/delete_ikm/<?php echo $a->id_ikm; ?>" class="btn btn-small red btn-outline tooltipped" data-position="top" data-delay="50" data-tooltip="Hapus IKM" onclick="javascript: return confirm('Yakin akan menghapus data ?')"><i class="material-icons dp48">delete</i></a></center>
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

<div id="modalikm" class="modal">
  <?php echo form_open_multipart('afin/input_ikm'); ?>
  <div class="modal-content">
    <h4>Input IKM</h4>
    <div class="row">
      <div class="input-field col s12">
        <input id="a6" type="date" name="tanggal_awal">
        <label for="a9">Tanggal Awal</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s12">
        <input id="a6" type="date" name="tanggal_akhir">
        <label for="a9">Tanggal Akhir</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s12">
        <input id="a6" type="number" name="nilai_ikm" maxlength="20">
        <label for="a9">Nilai IKM (%)</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s12">
        <button class="btn cyan waves-effect waves-light left" type="submit" name="action">Simpan</button>
      </div>
    </div>
  </div>
</div>
</form>