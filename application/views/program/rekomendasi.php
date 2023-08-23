<div id="main">
  <div class="row">
    <div class="col s12">
      <div class="container">
        <div class="section section-data-tables">
          <div class="card">
            <div class="card-content">
              <!-- <h4 class="card-title">Daftar Kontrak</h4> -->
              <a href="#modalrekomendasi" class="btn btn-success btn-with-icon btn-block rounded-5 modal-trigger"><i class="far fa-file-alt"></i> Tambah Rekomendasi</a>
              <div class="row">
                <div class="col s12">
                  <table id="example" class="display table table-bordered" cellspacing="0" width="100%">
                    <!-- <table id="page-length-option" class="responsive-table" width="100%"> -->
                    <thead>
                      <tr>
                        <th style="text-align:center;">Jumlah Rekomendasi</th>
                        <th style="text-align:center;" data-sort-ignore="true">Tahun</th>
                        <!--<th style="text-align:center;">Action</th>-->
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      foreach ($rekomendasi as $a) { ?>
                        <tr>
                          <td style="text-align:center;"><?php echo $a->jumlah_rekomendasi; ?></td>
                          <td style="text-align:center;"><?php echo $a->tahun_rekomendasi; ?></td>
                          <!--<td>
                            <center><a href="<?php echo base_url(); ?>program/rekomendasi/<?php echo $a->id_rekomendasi; ?>" class="btn btn-small red btn-outline tooltipped" data-position="top" data-delay="50" data-tooltip="Hapus IKM" onclick="javascript: return confirm('Yakin akan menghapus data ?')"><i class="material-icons dp48">delete</i></a></center>
                          </td>-->
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

<div id="modalrekomendasi" class="modal">
  <?php echo form_open_multipart('program/input_rekomendasi'); ?>
  <div class="modal-content">
    <h4>Input Rekomendasi</h4>
    <div class="row">
      <div class="input-field col s12">
        <input id="a6" type="number" name="jumlah_rekomendasi">
        <label for="a9">Jumlah Rekomendasi</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s12">
        <input id="a6" type="number" name="tahun_rekomendasi" min="1900" max="2099" step="1" placeholder="2000">
        <label for="a9">Tahun Rekomendasi</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s12">
        <button class="btn cyan waves-effect waves-light left" type="submit" name="action">Simpan</button>
      </div>
    </div>
  </div>
  </form>