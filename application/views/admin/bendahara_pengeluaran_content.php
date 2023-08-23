<div class="container-fluid">
    <div class="row">
        <div class="col s12">
          <div class="card">
              <div class="card-content">
                  <h4 class="card-title">Daftar Pengajuan</h4>
                  <h6 class="card-subtitle">You have <?php echo $jumlah+$jumlah_rkakl; ?> Pengajuan</h6>
                  <div class="ml-auto">
                      <div class="form-group">
                          <input id="demo-input-search2" type="text" placeholder="Pencarian Data" autocomplete="off">
                      </div>
                  </div>
                  <table id="demo-foo-addrow2" class="table table-bordered table-hover toggle-circle" data-page-size="20">
                    <thead>
                      <tr>
                        <center>
                        <th width="5%" data-sort-ignore="true"><center>No.</center></th>
                        <th width="50%">Nama Kegiatan</th>
                        <th width="10%">Tgl Pengajuan</th>
                        <th width="10%">Pengajuan</th>
                        <th width="10%">Realisasi</th>
                        <th width="10%">Status</th>
                        <th width="10%" data-sort-ignore="true"><center>Action</center></th>
                      </center>
                      </tr>
                        <!-- <tr>
                            <th data-sort-initial="true" data-toggle="true">First Name</th>
                            <th>Last Name</th>
                            <th data-hide="phone, tablet">Job Title</th>
                            <th data-hide="phone, tablet">DOB</th>
                            <th data-hide="phone, tablet">Status</th>
                            <th data-sort-ignore="true" class="min-width">Delete</th>
                        </tr> -->
                    </thead>
                    <tbody>
                      <?php $no=1; foreach($result AS $a) { ?>
                        <tr>
                          <td><center><?php echo $no; ?></center></td>
                          <td>
			    <span class="label label-table label-info"><?php echo $a->no_urut; ?></span>
                            <br/>
                            <span class="label label-table label-danger"><?php echo $a->kode." - ".$a->nama_akun; ?></span>
                            <br/>
                            <h5><span class="label label-table label-success"><?= $a->nama_kegiatan ?></span></h5>
                            <?= $a->keterangan ?>
                          </td>
                          <td><?php echo $this->format_tanggal->jin_date_str($a->tgl_pengajuan); ?></td>
                          <td><?php echo "Rp.".number_format($a->jumlah).",-"; ?></td>
                          <td><?php echo "Rp.".number_format($a->jumlah_realisasi).",-"; ?></td>
                          <td>
                            <?php if ($a->status_pengajuan == 0) { echo "Menunggu Approval PPK";  } elseif ($a->status_pengajuan == 1) { echo "Approved PPK";  } else { echo "Ditolak PPK";  } ?>
                          </td>
                          <td>
                            <center>
                              <a href="<?php echo base_url();?>bendahara_pengeluaran/detail_kontrak/<?php echo $a->id_kontrak;?>" class="btn btn-small blue btn-outline tooltipped" data-position="top" data-delay="50" data-tooltip="Preview"><i class="fas fa-eye"></i></a>
                            <?php if ($a->status_realisasi == 0 ) { ?>
                              <a href="#modalrealisasi<?php echo $a->id_pengajuan;?>" class="btn btn-small red btn-outline tooltipped modal-trigger" data-position="top" data-delay="50" data-tooltip="Input Realisasi"><i class="fas fa-check-circle"></i></a>
                            <?php } else { ?>
                              <a href="#modalrealisasi<?php echo $a->id_pengajuan;?>" class="btn btn-small green btn-outline tooltipped modal-trigger" data-position="top" data-delay="50" data-tooltip="Realisasi : <?php echo $this->format_tanggal->jin_date_str($a->tgl_realisasi); ?>"><i class="fas fa-check-circle"></i></a>
                            <?php } ?>
                          </center>
                          </td>
                        </tr>
                      <?php $no=$no+1; } ?>
                      <?php foreach($result_rkakl AS $a) { ?>
                        <tr>
                          <td><center><?php echo $no; ?></center></td>
                          <td>
			    <span class="label label-table label-info"><?php echo $a->no_urut; ?></span>
                            <br/>
                            <span class="label label-table label-danger"><?php echo $a->kode_akun." - ".$a->nama_akun; ?></span>
                            <br/>
                            <h5><span class="label label-table label-success"><?= $a->keterangan_rkakl ?></span></h5>
                            <?= $a->keterangan ?>
                          </td>
                          <td><?php echo $this->format_tanggal->jin_date_str($a->tgl_pengajuan); ?></td>
                          <td><?php echo "Rp.".number_format($a->jumlah).",-"; ?></td>
                          <td><?php echo "Rp.".number_format($a->jumlah_realisasi).",-"; ?></td>
                          <td>
                            <?php if ($a->status_pengajuan == 0) { echo "Menunggu Approval PPK";  } elseif ($a->status_pengajuan == 1) { echo "Approved PPK";  } else { echo "Ditolak PPK";  } ?>
                          </td>
                          <td>
                            <center>
                              <a href="<?php echo base_url();?>bendahara_pengeluaran/detail_kontrak/<?php echo $a->id_rkakl;?>" class="btn btn-small blue btn-outline tooltipped" data-position="top" data-delay="50" data-tooltip="Preview"><i class="fas fa-eye"></i></a>
                            <?php if ($a->status_realisasi == 0 ) { ?>
                              <a href="#modalrealisasirkakl<?php echo $a->id_pengajuan;?>" class="btn btn-small red btn-outline tooltipped modal-trigger" data-position="top" data-delay="50" data-tooltip="Input Realisasi"><i class="fas fa-check-circle"></i></a>
                            <?php } else { ?>
                              <a href="#modalrealisasirkakl<?php echo $a->id_pengajuan;?>" class="btn btn-small green btn-outline tooltipped modal-trigger" data-position="top" data-delay="50" data-tooltip="Realisasi : <?php echo $this->format_tanggal->jin_date_str($a->tgl_realisasi); ?>"><i class="fas fa-check-circle"></i></a>
                            <?php } ?>
                          </center>
                          </td>
                        </tr>
                      <?php $no=$no+1; } ?>
                    </tbody>
                      <tfoot>
                          <tr>
                              <td colspan="6">
                                  <div class="text-right">
                                      <ul class="pagination">
                                      </ul>
                                  </div>
                              </td>
                          </tr>
                      </tfoot>
                  </table>
              </div>
          </div>
            <?php foreach ($result as $a) { ?>
              <div id="modalrealisasi<?php echo $a->id_pengajuan; ?>" class="modal">
                  <div class="modal-content">
                      <h4>Input Realiasi</h4>
                        <?php echo form_open_multipart('bendahara_pengeluaran/input_realisasi');?>
                          <div class="row">
                              <div class="input-field col s12">
                                <?php $jumlah = "Rp.".number_format($a->jumlah).",-"; ?>
                                <input id="id_termin" type="text" name="id_pengajuan" value="<?php echo $a->id_pengajuan; ?>" hidden>
                                <h5>
                                  Tanggal Pengajuan : <?php echo $this->format_tanggal->jin_date_str($a->tgl_pengajuan); ?><br>
                                  Jumlah Pengajuan : <?php echo $jumlah; ?>
                                </h5>
                              </div>
                          </div>
                          <div class="row">
                              <div class="input-field col s12">
                                <input id="a9" type="date" name = "tgl_realisasi" required>
                                <label for="a9">Tanggal Realisasi</label>
                              </div>
                          </div>
                          <div class="row">
                              <div class="input-field col s12">
                                <input id="a1" type="number" name ="jumlah_realisasi" min="1" required>
                                <label for="a9">Jumlah Realisasi</label>
                              </div>
                          </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <button class="btn cyan waves-effect waves-light left" type="submit" name="action" onclick="javascript: return confirm('Yakin akan menyimpan data?')">Simpan</button>
                            </div>
                        </div>
                      </form>
                    </div>
              </div>
            <?php } ?>
            <?php foreach ($result_rkakl as $a) { ?>
              <div id="modalrealisasirkakl<?php echo $a->id_pengajuan; ?>" class="modal">
                  <div class="modal-content">
                      <h4>Input Realiasi</h4>
                        <?php echo form_open_multipart('bendahara_pengeluaran/input_realisasi_rkakl');?>
                          <div class="row">
                            <div class="input-field col s12">
                              <?php $jumlah = "Rp.".number_format($a->jumlah).",-"; ?>
                              <input id="id_termin" type="text" name="id_pengajuan" value="<?php echo $a->id_pengajuan; ?>" hidden>
                              <h5>
                                Tanggal Pengajuan : <?php echo $this->format_tanggal->jin_date_str($a->tgl_pengajuan); ?><br>
                                Jumlah Pengajuan : <?php echo $jumlah; ?>
                              </h5>
                            </div>
                          </div>
                          <div class="row">
                              <div class="input-field col s12">
                                <input id="a9" type="date" name = "tgl_realisasi" required>
                                <label for="a9">Tanggal Realisasi</label>
                              </div>
                          </div>
                          <div class="row">
                              <div class="input-field col s12">
                                <input id="a1" type="number" name ="jumlah_realisasi" min="1" required>
                                <label for="a9">Jumlah Realisasi</label>
                              </div>
                          </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <button class="btn cyan waves-effect waves-light left" type="submit" name="action" onclick="javascript: return confirm('Yakin akan menyimpan data?')">Simpan</button>
                            </div>
                        </div>
                      </form>
                    </div>
              </div>
            <?php } ?>
        </div>
    </div>
</div>
