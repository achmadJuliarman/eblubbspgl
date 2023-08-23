<div id="main">
      <div class="row">
        <div class="col s12">
            <div class="container">
                <div class="section section-data-tables">
                  <div class="card-content">
                    <div class="row">
                      <div class="col s12">
                          <div class="card-panel gradient-45deg-light-blue-cyan" style="color: rgba(255, 255, 255, 0.901961);">
                            <span style="color: rgba(255, 255, 255, 0.901961);font-size:20px;"><center>DETAIL KONTRAK</center></span>
                          </div>
                      </div>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-content">
                        <small>Judul Kontrak </small>
                        <h6><b><?php echo $result->nama_kontrak;?></b></h6>
                        <small>Pelaksana Layanan </small>
                        <h6><?php echo $result->rumah_layanan;?></h6>
                        <small>Pejabat Teknis </small>
                        <h6><?php echo $result->pejabat_teknis;?></h6>
                        <small>Nilai Kontrak</small>
                        <h6><?php echo "Rp. ".number_format($result->nilai_kontrak,0,'','.' ).",-"; ?></h6>
                        <small>Tanggal Pelaksanaan</small>
                        <h6><?php echo $result->tgl_mulai." s/d ".$result->tgl_akhir;?></h6>
                        <small>Jumlah Termin</small>
                        <h6><?php echo $result->termin;?></h6>
                    </div>
                  </div>
                  <div class="card-content">
                      <ul class="collapsible collapsible-accordion">
                          <li>
                              <div class="collapsible-header">Termin</div>
                              <?php $jumlah_termin = $this->db->query("SELECT COUNT(*) as jumlah FROM termin WHERE id_kontrak =$result->id_kontrak")->row();?>
                              <div class="collapsible-body">
                                <table class="table table-striped table-dashboard-two mg-b-0">
                                  <thead>
                                    <tr>
                                      <th style="text-align:center;" class="wd-lg-25p">Termin</th>
                                      <th style="text-align:center;" class="wd-lg-25p">Tanggal</th>
                                      <th style="text-align:center;" class="wd-lg-25p">Jumlah</th>
                                      <th></th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php if($jumlah_termin->jumlah < $result->termin) { ?>
                                      <a href="#modaltermin" class="btn gradient-45deg-light-blue-cyan mr-1 btn-with-icon btn-block rounded-5 modal-trigger"><i class="far fa-file-alt"></i> Tambah Termin</a>
                                    <?php } ?>
                                    <?php if($jumlah_termin->jumlah == 0 ) { ?>
                                      <tr>
                                        <td style="text-align:center;" colspan="2">Belum ada data</td>
                                      </tr>
                                    <?php } else { ?>
                                      <?php foreach ($result_termin as $a) { ?>
                                        <tr>
                                          <td style="text-align:center;"><?php echo $a->termin; ?></td>
                                          <td style="text-align:center;"><?php echo $this->format_tanggal->jin_date_str($a->tgl_termin); ?></td>
                                          <td style="text-align:center;"><?php echo "Rp. ".number_format($a->jumlah,0,'','.' ).",-"; ?></td>
                                          <?php $cek_termin = $this->db->query("SELECT COUNT(*) AS jumlah FROM kegiatan WHERE status=4 AND termin=$a->id_termin AND id_kontrak = $result->id_kontrak")->row(); ?>
                                          <?php $cek_jumlah_termin = $this->db->query("SELECT COUNT(*) AS jumlah FROM kegiatan WHERE termin=$a->id_termin AND id_kontrak = $result->id_kontrak")->row(); ?>
                                          <td>
                                            <?php if ($cek_termin->jumlah != $cek_jumlah_termin->jumlah) { ?>
                                              <a href="#modalterminedit<?php echo $a->termin; ?>" class="btn-floating gradient-45deg-light-blue-cyan tooltipped modal-trigger" data-position="top" data-tooltip="Edit Termin"><i class="material-icons dp48">edit</i></a>
                                            <?php } elseif($cek_termin->jumlah == $cek_jumlah_termin->jumlah && $cek_termin->jumlah > 0) { ?>
                                              <?php if($a->status_termin == 0) { ?>
                                                <a href="<?php echo base_url(); ?>program/pengajuan_pembayaran/<?php echo $a->id_kontrak; ?>/<?php echo $a->id_termin; ?>" class="btn gradient-45deg-light-blue-cyan green btn-with-icon btn-block rounded-5"><i class="fas fa-paper-plane"></i> Pengajuan Termin Pembayaran</a>
                                              <?php } elseif($a->status_termin == 1) { ?>
                                                <span class="badge green" style="font-size: 12px;">Pengajuan Termin Pembayaran telah diajukan</span>
                                                <!-- <a href="#" class="btn gradient-45deg-light-blue-cyan green btn-with-icon btn-block rounded-5"><i class="fas fa-exclamation-circle"></i> Pengajuan Termin Pembayaran telah diajukan</a> -->
                                                <a href="#modalterminedit<?php echo $a->termin; ?>" class="btn-floating gradient-45deg-light-blue-cyan tooltipped modal-trigger" data-position="top" data-tooltip="Edit Termin"><i class="material-icons dp48">edit</i></a>
                                              <?php } ?>
                                            <?php } else { ?>
                                                <a href="#modalterminedit<?php echo $a->termin; ?>" class="btn-floating gradient-45deg-light-blue-cyan tooltipped modal-trigger" data-position="top" data-tooltip="Edit Termin"><i class="material-icons dp48">edit</i></a>
                                                <a href="<?php echo base_url(); ?>program/hapus_termin/<?php echo $a->id_kontrak; ?>/<?php echo $a->id_termin; ?>" class="btn-floating red tooltipped" data-position="top" data-tooltip="Hapus Termin" onclick="javascript: return confirm('Yakin akan menghapus data ?')"><i class="material-icons dp48">delete</i></a>
                                                <a href="#" class="btn red btn-with-icon rounded-5">Belum ada timeline</a>
                                            <?php } ?>
                                          </td>
                                        </tr>
                                      <?php } ?>
                                    <?php } ?>
                                </tbody>
                                </table>
                                <?php foreach ($result_termin as $a) { ?>
                                <div id="modalterminedit<?php echo $a->termin; ?>" class="modal">
                                  <div class="modal-content">
                                      <h4>Data Termin <?php echo $a->termin; ?></h4>
                                      <small>Tanggal Pelaksanaan</small>
                                      <h6><?php echo $this->format_tanggal->jin_date_str($result->tgl_mulai); ?> s/d <?php echo $this->format_tanggal->jin_date_str($result->tgl_akhir); ?></h6>
                                      <small>Nilai Kontrak</small>
                                      <h6><?php echo "Rp. ".number_format($result->nilai_kontrak,0,'','.' ).",-"; ?></h6>
                                      <small>Jumlah Termin</small>
                                      <h6><?php echo $result->termin;?></h6>
                                      <br>
                                        <?php echo form_open_multipart('program/edit_termin');?>
                                          <div class="row">
                                              <div class="input-field col s12 m6 l6">
                                                <input id="judul_kontrak" type="text" name= "id_kontrak" value="<?php echo $result->id_kontrak; ?>" hidden>
                                                  <input id="id_termin" type="text" name= "id_termin" value="<?php echo $a->id_termin; ?>" hidden>
                                                  <input id="a9" type="date" name = "tgl_termin" value="<?php echo $a->tgl_termin; ?>" required>
                                                  <label for="a9">Tanggal Termin <?php echo $a->termin; ?></label>
                                              </div>
                                              <div class="input-field col s12 l6">
                                                  <input id="a6" type="number" name="jumlah" value="<?php echo $a->jumlah; ?>" maxlength="20" min="1" required>
                                                  <label for="a9">Jumlah Termin <?php echo $a->termin; ?></label>
                                              </div>
                                          </div>
                                        <div class="row">
                                            <div class="input-field col s12">
                                                <button class="btn cyan waves-effect waves-light left" type="submit" name="action" onclick="javascript: return confirm('Yakin akan mengubah data termin ?')">Simpan</button>
                                            </div>
                                        </div>
                                      </form>
                                    </div>
                                </div>
                                <?php } ?>
                                <div id="modaltermin" class="modal">
                                    <div class="modal-content">
                                        <h4>Data Termin</h4>
                                        <small>Tanggal Pelaksanaan</small>
                                        <h6><?php echo $this->format_tanggal->jin_date_str($result->tgl_mulai); ?> s/d <?php echo $this->format_tanggal->jin_date_str($result->tgl_akhir); ?></h6>
                                        <small>Nilai Kontrak</small>
                                        <h6><?php echo "Rp. ".number_format($result->nilai_kontrak,0,'','.' ).",-"; ?></h6>
                                        <small>Jumlah Termin</small>
                                        <h6><?php echo $result->termin;?></h6>
                                        <br>
                                        <?php if ($result->termin > 0) { ?>
                                          <?php echo form_open_multipart('program/input_termin');?>
                                          <?php for ($i=$jumlah_termin->jumlah + 1; $i < $result->termin + 1; $i++) { ?>
                                            <div class="row">
                                                <div class="input-field col s12 m6 l6">
                                                    <input id="judul_kontrak" type="text" name= "id_kontrak" value="<?php echo $result->id_kontrak; ?>" hidden>
                                                    <input id="termin" type="text" name= "termin[]" value="<?php echo $i; ?>" hidden>
                                                    <input id="a9" type="date" name = "tgl_termin[]" required>
                                                    <label for="a9">Tanggal Termin <?php echo $i; ?></label>
                                                </div>
                                                <div class="input-field col s12 l6">
                                                    <input id="a6" type="number" name="jumlah[]" min="1" maxlength="20" required>
                                                    <label for="a9">Jumlah Termin <?php echo $i; ?></label>
                                                </div>
                                            </div>
                                          <?php } ?>
                                          <div class="row">
                                              <div class="input-field col s12">
                                                  <button class="btn cyan waves-effect waves-light left" type="submit" name="action" onclick="javascript: return confirm('Yakin akan menyimpan data termin ?')">Simpan</button>
                                              </div>
                                          </div>
                                        </form>
                                        <?php } ?>
                                      </div>
                                </div>
                              </div>
                          </li>
                          <li>
                              <div class="collapsible-header">Anggota Tim</div>
                              <div class="collapsible-body">
                                <div class="row">
                                  <?php echo form_open_multipart('program/input_anggota');?>
                                    <div class="input-field col s12 m12">
                                      <input id="id_kontrak" type="text" name="id_kontrak" value="<?php echo $result->id_kontrak; ?>" hidden>
                                      <small>Pilih Data Pegawai</small>
                                        <select class="select2 browser-default" name="id_pegawai" multiple required>
                                            <!-- <option value="" selected disabled>Pilih Data Pegawai</option> -->
                                            <?php foreach ($result_pegawai as $a) { ?>
                                              <option value="<?php echo $a->id; ?>"><?php echo $a->nama; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="input-field col s12">
                                        <button class="btn cyan waves-effect btn-block" type="submit" name="action" onclick="javascript: return confirm('Yakin akan menyimpan data anggota tim ?')">Simpan</button>
                                    </div>
                                  </div>
                                </form>
                                <div class="row">
                                      <!-- <select name="id_pegawai">
                                        <?php foreach ($result_pegawai as $a) { ?>
                                          <option value="<?php echo $a->id; ?>"><?php echo $a->nama; ?></option>
                                        <?php } ?>
                                      </select> -->
                                      <!-- <a href="#modalanggota" class="btn gradient-45deg-light-blue-cyan btn-with-icon btn-block rounded-5 modal-trigger"><i class="fas fa-plus"></i> Tambah Anggota</a> -->
                                  </div>
                                <?php $anggota = $this->db->query("SELECT * FROM personil AS per INNER JOIN pegawai2 AS p ON per.id_pegawai = p.id WHERE per.id_kontrak = $result->id_kontrak ORDER BY p.nama")->result(); ?>
                                <table class="table table-striped table-dashboard-one mg-b-0">
                                  <thead>
                                  <tr>
                                    <td>NAMA</td>
                                    <td></td>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php foreach ($anggota as $a) { ?>
                                    <tr>
                                      <td><?php echo $a->nip." - ".$a->nama; ?></td>
                                      <td><a href="<?php echo base_url();?>program/hapus_anggota/<?php echo $result->id_kontrak;?>/<?php echo $a->id_personil; ?>" class="btn-floating red tooltipped" data-position="top" data-tooltip="Hapus Anggota Tim" onclick="javascript: return confirm('Yakin akan menghapus data ?')"><i class="material-icons dp48">delete</i></a></td>
                                    </tr>
                                  <?php } ?>
                                </tbody>
                                </table>
                                <br>
                                <center>
                                  <a href="#modalsk" class="btn-floating red modal-trigger tooltipped" data-position="top" data-tooltip="Upload SK TIM"><i class="material-icons dp48">publish</i></a>
                                <?php if ($result->file_sk != "") { ?>
                                  <a href="<?php echo base_url();?>uploads/sk_tim/<?php echo $result->file_sk;?>" target="_blank" class="btn-floating blue modal-trigger tooltipped" data-position="top" data-tooltip="View SK TIM"><i class="material-icons dp48">picture_as_pdf</i></a>
                                <?php } ?>
                                </center>
                                <div id="modalsk" class="modal">
                                  <?php echo form_open_multipart('program/upload_sk');?>
                                  <div class="modal-content">
                                      <h4>Upload SK Tim</h4>
                                          <div class="row">
                                              <div class="input-field col s12">
                                                <input type="text" class="form-control" name="id_kontrak" hidden value="<?php echo $result->id_kontrak;?>">
                                                <div class="file-field input-field">
                                                    <div class="btn blue darken-1">
                                                        <span>Upload SK</span>
                                                        <input type="file" name="file">
                                                    </div>
                                                    <div class="file-path-wrapper">
                                                        <input class="file-path validate" type="text">
                                                    </div>
                                                </div>
                                                <p>File .pdf maksimal 20Mb</p>
                                              </div>
                                            </div>
                                          <div class="row">
                                              <div class="input-field col s12">
                                                  <button class="btn cyan waves-effect waves-light left" type="submit" name="action" onclick="javascript: return confirm('Yakin akan mengupload data ?')">Simpan</button>
                                              </div>
                                          </div>
                                    </div>
                                    </form>
                                </div>
                              </div>
                          </li>
                          <li>
                              <div class="collapsible-header">Timeline</div>
                              <?php $jumlah_timeline = $this->db->query("SELECT COUNT(*) as jumlah FROM kegiatan WHERE id_kontrak =$result->id_kontrak")->row();?>
                              <div class="collapsible-body">
                                <table class="table table-striped table-dashboard-two mg-b-0">
                                  <thead>
                                    <tr>
                                      <th style="text-align:center;" class="wd-lg-25p">Nama Kegiatan</th>
                                      <th style="text-align:center;" class="wd-lg-25p">Tanggal Pelaksanaan</th>
                                      <th width="25%" class="wd-lg-25p"></th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php if($jumlah_timeline->jumlah == 0 ) {?>
                                      <tr>
                                        <td style="text-align:center;" colspan="2">Belum ada data</td>
                                      </tr>
                                    <?php } else { ?>
                                      <?php foreach ($result_timeline as $a) { ?>
                                        <tr>
                                          <td>
                                            <span class="badge orange" style="font-size: 12px;">Termin <?php echo $a->termin;?></span>
                                          </td>
                                          <td>
                                            <?php echo $a->nama_kegiatan; ?> <br>
                                            <span class="badge cyan" style="font-size: 12px;"><?php echo $this->format_tanggal->jin_date_str($a->tgl_mulai)." s/d ".$this->format_tanggal->jin_date_str($a->tgl_akhir); ?></span>
                                          </td>
                                          <?php if ($a->status == 0) { ?>
                                            <td>
                                              <center>
                                              <a href="#modaltimelineedit<?php echo $a->id_kegiatan;?>" class="btn-floating gradient-45deg-light-blue-cyan tooltipped modal-trigger" data-position="top" data-tooltip="Edit Timeline"><i class="material-icons dp48">edit</i></a>
                                              <?php $cek = $this->db->query("SELECT * FROM rencana_operasional WHERE id_kegiatan=$a->id_kegiatan")->num_rows();?>
                                              <?php if($cek == 0) { ?>
                                                <a href="<?php echo base_url();?>program/hapus_timeline/<?php echo $result->id_kontrak;?>/<?php echo $a->id_kegiatan; ?>" class="btn-floating red tooltipped" data-position="top" data-tooltip="Hapus Timeline" onclick="javascript: return confirm('Yakin akan menghapus data ?')"><i class="material-icons dp48">delete</i></a>
                                              <?php } ?>
                                            </center>
                                            </td>
                                          <?php } elseif ($a->status == 1) {?>
                                            <td>
                                              <center>
                                                <span class="badge orange" style="font-size: 12px;">Menunggu Approval</span>
                                              </center>
                                            </td>
                                          <?php } elseif ($a->status == 2) {?>
                                            <td>
                                              <center>
                                                <h5>
                                                  <span class="badge red" style="font-size: 12px;">Menunggu Tindak Lanjut Kendala</span>
                                                </h5>
                                              </center>
                                            </td>
                                          <?php } elseif ($a->status == 4) {?>
                                            <td>
                                              <center>
                                                <h5>
                                                  <span class="badge green" style="font-size: 12px;">Approved</span>
                                                </h5>
                                              </center>
                                            </td>
                                          <?php } ?>
                                        </tr>
                                      <?php } ?>
                                    <?php } ?>
                                </tbody>
                                </table>
                                <a href="#modaltimeline" class="btn gradient-45deg-light-blue-cyan btn-with-icon btn-block rounded-5 modal-trigger"><i class="far fa-file-alt"></i> Tambah Timeline</a>
                                <?php foreach ($result_timeline as $a) { ?>
                                <div id="modaltimelineedit<?php echo $a->id_kegiatan; ?>" class="modal">
                                    <div class="modal-content">
                                        <h4>Data Timeline</h4>
                                          <?php echo form_open_multipart('program/edit_timeline');?>
                                            <div class="row">
                                                <div class="input-field col s12">
                                                    <input id="id_termin" type="text" name="id_termin" value="<?php echo $a->termin_id; ?>" hidden>
                                                    <input id="termin" type="text" name="id_kontrak" value="<?php echo $result->id_kontrak; ?>" hidden>
                                                    <input id="termin" type="text" name="id_kegiatan" value="<?php echo $a->id_kegiatan; ?>" hidden>
                                                    <select name="termin">
                                                        <option value="<?php echo $a->termin_id; ?>" selected><?php echo "Termin - ".$a->termin." Tanggal : ".$a->tgl_termin; ?></option>
                                                        <?php foreach ($result_termin as $b) { ?>
                                                          <option value="<?php echo $b->id_termin; ?>"><?php echo "Termin - ".$b->termin." Tanggal : ".$a->tgl_termin; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="input-field col s12">
                                                    <input id="nama_kegiatan" type="text" name="nama_kegiatan" value="<?php echo $a->nama_kegiatan;?>" required>
                                                    <label for="nama_kegiatan">Nama Kegiatan</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="input-field col s12 m6 l6">
                                                    <input id="a9" type="date" name = "tgl_mulai" required value="<?php echo $a->tgl_mulai;?>">
                                                    <label for="a9">Tanggal Mulai</label>
                                                </div>
                                                <div class="input-field col s12 l6">
                                                    <input id="a6" type="date" name="tgl_akhir" required value="<?php echo $a->tgl_akhir;?>">
                                                    <label for="a9">Tanggal Akhir</label>
                                                </div>
                                            </div>
                                          <div class="row">
                                              <div class="input-field col s12">
                                                  <button class="btn cyan waves-effect waves-light left" type="submit" name="action" onclick="javascript: return confirm('Yakin akan menyimpan data ?')">Simpan</button>
                                              </div>
                                          </div>
                                        </form>
                                      </div>
                                </div>
                                <?php } ?>
                                <div id="modaltimeline" class="modal">
                                    <div class="modal-content">
                                        <h4>Data Timeline</h4>
                                          <?php echo form_open_multipart('program/input_timeline');?>
                                            <div class="row">
                                                <div class="input-field col s12">
                                                    <input id="termin" type="text" name="id_kontrak" value="<?php echo $result->id_kontrak; ?>" hidden>
                                                    <select name="termin">
                                                        <option value="" disabled selected>Pilih Termin</option>
                                                        <?php foreach ($result_termin as $a) { ?>
                                                          <option value="<?php echo $a->id_termin; ?>"><?php echo "Termin - ".$a->termin." Tanggal : ".$a->tgl_termin; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="input-field col s12">
                                                    <input id="nama_kegiatan" type="text" name="nama_kegiatan" required>
                                                    <label for="nama_kegiatan">Nama Kegiatan</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="input-field col s12 m6 l6">
                                                    <input id="a9" type="date" name = "tgl_mulai" required>
                                                    <label for="a9">Tanggal Mulai</label>
                                                </div>
                                                <div class="input-field col s12 l6">
                                                    <input id="a6" type="date" name="tgl_akhir" required>
                                                    <label for="a9">Tanggal Akhir</label>
                                                </div>
                                            </div>
                                          <div class="row">
                                              <div class="input-field col s12">
                                                  <button class="btn cyan waves-effect waves-light left" type="submit" name="action" onclick="javascript: return confirm('Yakin akan mengubah data ?')">Simpan</button>
                                              </div>
                                          </div>
                                        </form>
                                      </div>
                                </div>
                              </div>
                          </li>
                          <li>
                              <div class="collapsible-header">Rencana Operasional</div>
                              <div class="collapsible-body">
                                <a href="#modalmax" class="btn red btn-with-icon rounded-5 modal-trigger"> Setting Max. Biaya Operasional</a>
                                <table class="table table-striped table-dashboard-two mg-b-0" width="100%">
                                  <thead>
                                    <tr>
                                      <th width="30%">Kode Akun</th>
                                      <th width="15%">Pagu</th>
                                      <th width="15%">Pengajuan</th>
                                      <th width="15%">Realisasi</th>
                                      <th width="15%">Saldo</th>
                                      <th width="10%"></th>
                                    </tr>
                                  </thead>
                                  <?php $ro = $this->db->query("SELECT ro.id_ro,ro.id_kontrak,ro.keterangan,SUM(ro.biaya) AS pagu,a.kode,a.nama_akun,ro.akun FROM rencana_operasional AS ro INNER JOIN akun AS a ON ro.akun = a.id_akun WHERE ro.id_kontrak = $result->id_kontrak GROUP BY ro.akun")->result(); ?>
                                  <?php $jumlah_ro = $this->db->query("SELECT ro.id_ro,ro.id_kontrak,ro.keterangan,SUM(ro.biaya) AS pengajuan,SUM(ro.realisasi) AS realisasi,a.kode,a.nama_akun,SUM(ro.biaya) AS jumlah FROM rencana_operasional AS ro INNER JOIN akun AS a ON ro.akun = a.id_akun WHERE ro.id_kontrak = $result->id_kontrak GROUP BY ro.akun")->num_rows(); ?>
                                  <tbody>
                                    <?php if ($jumlah_ro == 0) { ?>
                                      <tr>
                                        <td colspan="4">Belum ada Rencana Operasional</td>
                                      </tr>
                                    <?php } else { ?>
                                    <?php $total=0;$total_p=0;$total_r=0;$total_s=0; foreach ($ro as $a) { ?>
                                      <?php $pengajuan = $this->db->query("SELECT SUM(p.jumlah) AS pengajuan,SUM(p.jumlah_realisasi) AS realisasi FROM pengajuan AS p INNER JOIN rencana_operasional AS ro ON p.id_ro = ro.id_ro INNER JOIN kontrak AS k ON ro.id_kontrak = k.id_kontrak INNER JOIN akun AS a ON ro.akun = a.id_akun WHERE ro.id_kontrak = $a->id_kontrak AND a.kode = '$a->kode' AND p.status_pengajuan < 2")->row(); ?>
                                      <tr>
                                        <td><?php echo $a->kode." ".$a->nama_akun;?></td>
                                        <td><?php echo "Rp. ".number_format($a->pagu,0,'','.' ).",-"; ?></td>
                                        <td><?php echo "Rp. ".number_format($pengajuan->pengajuan,0,'','.' ).",-"; ?></td>
                                        <td><?php echo "Rp. ".number_format($pengajuan->realisasi,0,'','.' ).",-"; ?></td>
                                        <?php $saldo = $a->pagu - $pengajuan->realisasi;?>
                                        <td><?php echo "Rp. ".number_format($saldo,0,'','.' ).",-"; ?></td>
                                        <td><a href="<?php echo base_url();?>program/detail_ro/<?php echo $a->id_kontrak."/".$a->akun;?>" class="btn-floating gradient-45deg-light-blue-cyan tooltipped modal-trigger" data-position="top" data-tooltip="Detail"><i class="material-icons dp48">info</i></a></td>
                                      </tr>
                                      <?php $total=$total+$a->pagu;$total_p=$total_p+$pengajuan->pengajuan;$total_r=$total_r+$pengajuan->realisasi;$total_s=$total_s+$saldo; } ?>
                                      <tr>
                                        <th>
                                          <strong>TOTAL</strong>
                                        </th>
                                        <th class="tx-medium"><strong><?= 'Rp. '.number_format($total).',-' ?></strong></th>
                                        <th class="tx-medium tx-danger"><strong><?= 'Rp. '.number_format($total_p).',-' ?></strong></th>
                                        <th class="tx-medium tx-success"><strong><?= 'Rp. '.number_format($total_r).',-' ?></strong></th>
                                        <th class="tx-medium tx-warning"><strong><?= 'Rp. '.number_format($total_s).',-' ?></strong></th>
                                        <th></th>
                                        <th></th>
                                      </tr>
                                      <tr>
                                        <td colspan="5">
                                          <?php $persen = $total/$result->nilai_kontrak*100; ?>
                                          <?php
                                          if ($persen < 30)
                                          {
                                            $label = "label-info";
                                          }
                                          elseif ($persen >= 30 && $persen <= 50)
                                          {
                                            $label = "label-success";
                                          }
                                          elseif ($persen > 50 && $persen <= 70)
                                          {
                                            $label = "label-warning";
                                          }
                                          elseif ($persen > 70)
                                          {
                                            $label = "label-danger";
                                          }
                                          ?>
                                          *Biaya Operasional sebesar : <span class="label label-table <?php echo $label; ?>"><?= 'Rp. '.number_format($total).',-'." ( ".round($persen,2)." %) ";?> </span>&nbsp; dari nilai Kontrak : <span class="label label-table <?php echo $label; ?>"> <?= 'Rp. '.number_format($result->nilai_kontrak).',-';?> </span><br/>
                                          *Max. Biaya Operasional sebesar <span class="label label-table label-danger"><?php echo $result->max_operasional;?> %</span>
                                        </td>
                                      </tr>
                                    <?php } ?>
                                </tbody>
                                </table>
                                <a href="#modalro" class="btn gradient-45deg-light-blue-cyan btn-with-icon btn-block rounded-5 modal-trigger"><i class="far fa-file-alt"></i> Tambah Biaya Operasional</a>
                                <div id="modalro" class="modal">
                                  <?php echo form_open_multipart('program/input_ro');?>
                                    <div class="modal-content">
                                        <h4>Data Rencana Operasional</h4>
                                            <div class="row">
                                                <div class="input-field col s12">
                                                  <input id="id_kontrak" type="text" name= "id_kontrak" value="<?php echo $result->id_kontrak; ?>" hidden>
                                                    <select name="id_kegiatan" required>
                                                        <option value="" disabled selected>Pilih Nama Kegiatan</option>
                                                        <?php foreach ($result_timeline as $a) { ?>
                                                          <option value="<?php echo $a->id_kegiatan; ?>"><?php echo $a->nama_kegiatan; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                              </div>
                                              <div class="row">
                                                <div class="input-field col s12">
                                                  <?php $akun = $this->db->query("SELECT * FROM akun")->result(); ?>
                                                  <select name="akun" required>
                                                      <option value="" disabled selected>Kode Akun</option>
                                                      <?php foreach ($akun as $a) { ?>
                                                        <option value="<?php echo $a->id_akun; ?>"><?php echo $a->kode." - ".$a->nama_akun; ?></option>
                                                      <?php } ?>
                                                  </select>
                                                  <label>Pilih Kode Akun</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="input-field col s12">
                                                    <input id="a6" type="number" name="biaya" maxlength="20" min="1" required>
                                                    <label for="a9">Jumlah</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="input-field col s12">
                                                    <button class="btn cyan waves-effect waves-light left" type="submit" name="action" onclick="javascript: return confirm('Yakin akan menyimpan data ?')">Simpan</button>
                                                </div>
                                            </div>
                                      </div>
                                  </form>
                                </div>
                                <div id="modalmax" class="modal">
                                  <?php echo form_open_multipart('program/setting_ro');?>
                                    <div class="modal-content">
                                        <h4>Rencana Operasional</h4>
                                            <div class="row">
                                                <div class="input-field col s4">
                                                  <input id="id_kontrak" type="text" name= "id_kontrak" value="<?php echo $result->id_kontrak; ?>" hidden>
                                                  <input id="a9" type="number" name="max_operasional" value="<?php echo $result->max_operasional; ?>" maxlength="3" min="1" max="100" required>
                                                  <label for="a9">Max. Biaya Operasional (%)</label>
                                                </div>
                                              </div>
                                            <div class="row">
                                                <div class="input-field col s12">
                                                    <button class="btn cyan waves-effect waves-light left" type="submit" name="action" onclick="javascript: return confirm('Yakin akan menyimpan data ?')">Simpan</button>
                                                </div>
                                            </div>
                                      </div>
                                  </form>
                                </div>
                              </div>
                          </li>
                          <li>
                              <div class="collapsible-header">Pengajuan Biaya Operasional</div>
                              <div class="collapsible-body">
                                <table>
                                  <thead>
                                    <tr>
                                      <th>Kode Akun</th>
                                      <th>Nama Kegiatan</th>
                                      <th>Tanggal Pengajuan</th>
                                      <th>Jumlah</th>
                                      <th>Status</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php if($jumlah_pengajuan == 0) { ?>
                                      <tr>
                                        <td colspan="3">Belum ada pengajuan</td>
                                      </tr>
                                    <?php } else { ?>
                                    <?php $total=0;foreach ($result_pengajuan as $a) { ?>
                                      <tr>
                                        <td>
                                          <span class="badge gradient-45deg-light-blue-cyan"><?php echo $a->kode;?></span><br>
                                          <?php echo $a->nama_akun;?>
                                        </td>
                                        <td>
                                          <b><?php echo $a->no_urut; ?></b><br>
                                          <?php echo $a->nama_kegiatan; ?><br>
                                          <?php echo "<b>Keterangan : </b>".$a->keterangan; ?>
                                        </td>
                                        <td><?php echo $a->tgl_pengajuan; ?></td>
                                        <td><?php echo "Rp. ".number_format($a->jumlah,0,'','.' ).",-"; ?></td>
                                        <td>
                                          <?php if ($a->status_pengajuan == 0) { echo "Menunggu Approval PPK";  } elseif ($a->status_pengajuan == 1) { echo "Approved PPK";  } else { echo "Ditolak PPK";  } ?>
                                        </td>
                                      </tr>
                                    <?php $total=$total+$a->jumlah;} } ?>
                                    <!-- <tr>
                                      <td> TOTAL</td>
                                      <td colspan="3"><?php echo "Rp. ".number_format($total,0,'','.' ).",-"; ?></td>
                                    </tr> -->
                                  </tbody>
                                </table>
                                <?php $kategori = $this->session->userdata('admin_kategori'); ?>
                                <?php if ($kategori == 3) { ?>
                                <a href="#modalpengajuan" class="btn gradient-45deg-light-blue-cyan btn-with-icon btn-block rounded-5 modal-trigger"><i class="far fa-file-alt"></i> Tambah Pengajuan Operasional</a>
                                <?php } ?>
                                <div id="modalpengajuan" class="modal">
                                  <?php echo form_open_multipart('program/input_pengajuan');?>
                                    <div class="modal-content">
                                        <h4>Data Pengajuan Operasional</h4>
                                            <div class="row">
                                                <div class="input-field col s12">
                                                  <input id="termin" type="text" name="id_kontrak" value="<?php echo $result->id_kontrak; ?>" hidden>
                                                    <select name="id_ro">
                                                        <option value="" disabled selected>Pilih Rencana Operasional</option>
                                                        <?php foreach ($result_ro as $a) { ?>
                                                          <option value="<?php echo $a->id_ro; ?>"><?php echo $a->kode."  ".$a->nama_akun." - ".$a->nama_kegiatan; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                              </div>
                                            <div class="row">
                                                <div class="input-field col s12">
                                                    <input id="a6" type="number" name="jumlah" maxlength="20">
                                                    <label for="a9">Jumlah</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="input-field col s12">
                                                    <input id="a7" type="text" name="keterangan" maxlength="100">
                                                    <label for="a9">Keterangan</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="input-field col s12">
                                                    <button class="btn cyan waves-effect waves-light left" type="submit" name="action" onclick="javascript: return confirm('Yakin akan menyimpan data ?')">Simpan</button>
                                                </div>
                                            </div>
                                      </div>
                                  </form>
                                </div>
                              </div>
                          </li>
                          <li>
                              <div class="collapsible-header">Adendum</div>
                              <div class="collapsible-body">
                                Riwayat Adendum :
                                <?php $adendum = $this->db->query("SELECT * FROM adendum WHERE id_kontrak = $result->id_kontrak")->result(); ?>
                                <ul>
                                  <?php foreach($adendum AS $a) { ?>
                                    <li><?php echo "( ".$a->tgl_adendum." ) -- ".$a->keterangan_adendum;?></li>
                                  <?php } ?>
                                </ul>
                              </div>
                          </li>
                          <li>
                              <div class="collapsible-header">Dokumen</div>
                              <div class="collapsible-body">
                                <?php $history = $this->db->query("SELECT h.file,h.tanggal,p.nama FROM history_dokumen AS h INNER JOIN user AS u ON h.id_user = u.id_user INNER JOIN pegawai2 AS p ON u.id_pegawai = p.id WHERE h.id_kontrak = $result->id_kontrak")->result(); ?>
                                <ul>
                                  <?php foreach($history AS $a) { ?>
                                    <li><?php echo "( ".$a->tanggal." ) -- File kontrak diunggah oleh: ".$a->nama.". Nama File :";?><a href="<?php echo base_url();?>uploads/kontrak/<?php echo $a->file;?>" target="_blank"><?php echo $a->file;?></a></li>
                                  <?php } ?>
                                </ul>
                              </div>
                          </li>
                          <li>
                              <div class="collapsible-header">History</div>
                              <div class="collapsible-body">
                                History Kontrak :
                                <?php $start = $this->db->query("SELECT k.created_time,p.nama FROM kontrak AS k INNER JOIN user AS u ON k.created_by = u.id_user INNER JOIN pegawai2 AS p ON u.id_pegawai = p.id WHERE k.id_kontrak = $result->id_kontrak")->row(); ?>
                                <ul>
                                    <li><?php echo "( ".$start->created_time." ) -- Kontrak dibuat oleh ".$start->nama;?></li>
                                </ul>
                                <?php $history = $this->db->query("SELECT h.keterangan,h.tanggal,p.nama FROM history AS h INNER JOIN user AS u ON h.id_user = u.id_user INNER JOIN pegawai2 AS p ON u.id_pegawai = p.id WHERE h.id_kontrak = $result->id_kontrak")->result(); ?>
                                <ul>
                                  <?php foreach($history AS $a) { ?>
                                    <li><?php echo "( ".$a->tanggal." ) -- ".$a->keterangan." ".$a->nama;?></li>
                                  <?php } ?>
                                </ul>
                              </div>
                          </li>
                      </ul>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
