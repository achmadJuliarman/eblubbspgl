<div class="container-fluid">
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                  <div class="grey lighten-5 p-15 d-flex no-block">
                      <a href="<?php echo base_url();?>inbox" class='m-l-5 tooltipped' href='#' data-tooltip="back to inbox" data-position="top"><i class="material-icons font-20">arrow_back</i></a>
                  </div>
                  <div class="email-body">
                      <div class="p-15 b-t">
                          <h5 class="m-b-0">Pengirim : <b><?php echo $kendala->nama; ?></b> (<?php echo $kendala->username; ?>)</h5>
                          <h5 class="m-b-0">Kendala : <b><?php echo $kendala->keterangan; ?></b></h5>
                      </div>
                      <div class="divider"></div>
                      <br>
                      <ul class="collapsible expandable b-0 m-t-0">
                          <br>
                          <?php foreach($result AS $a) {?>
                          <li>
                              <div class="collapsible-header">
                                  <div class="d-flex no-block align-items-center">
                                      <div class="">
                                          <h5 class="m-b-0 font-16 font-medium"><?php echo $a->pengirim; ?><small> ( <?php echo $a->tanggal; ?> )</small></h5><span>to <?php echo $a->penerima; ?></span>
                                      </div>
                                  </div>
                              </div>
                              <div class="collapsible-body">
                                <b><?php echo $a->detail_keterangan; ?></b>
                                <br>
                                <?php if ($a->solusi == "") { ?>
                                    Tanggapan : Belum ada tanggapan
                                    <?php echo form_open_multipart('inbox/tambah_solusi');?>
                                          <div class="row">
                                              <div class="input-field col s6">
                                                <input id="id_kendala" type="text" name="id_kendala" value="<?php echo $a->id_kendala; ?>" hidden>
                                                <input id="id_detail_kendala" type="text" name="id_detail_kendala" value="<?php echo $a->id_detail_kendala; ?>" hidden>
                                              </div>
                                          </div>
                                          <div class="row">
                                              <div class="input-field col s12">
                                                <label for="message5">Keterangan</label>
                                                  <textarea id="mymce" name="solusi"></textarea>
                                              </div>
                                          </div>
                                        <div class="row">
                                            <div class="input-field col s12">
                                                <button class="btn cyan waves-effect waves-light left" type="submit" name="action">Simpan</button>
                                            </div>
                                        </div>
                                    </form>
                                <?php } else { ?>
                                    <span>Tanggapan : <?php echo $a->solusi;?></span>
                                <?php } ?>
                              </div>
                          </li>
                          <?php } ?>
                      </ul>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
