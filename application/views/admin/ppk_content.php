<div class="container-fluid">
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <h4 class="card-title">Daftar Pengajuan</h4>
                    <h6 class="card-subtitle">You have <?php echo $jumlah+$jumlah_rkakl; ?> Pengajuan</h6>
                    <table id="demo-foo-addrow2" class="table table-bordered table-hover toggle-circle" data-page-size="10">
                      <thead>
                        <tr>
                          <center>
                          <th width="5%" data-sort-ignore="true"><center>No.</center></th>
                          <th width="40%">Nama Kegiatan</th>
                          <th width="15%">Tgl Pengajuan</th>
                          <th width="15%">Jumlah</th>
                          <th width="10%">Status</th>
                          <th width="20%" data-sort-ignore="true"><center>Action</center></th>
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
                      <div class="m-t-40">
                          <div class="d-flex">
                              <div class="mr-auto">
                                  <div class="form-group">

                                  </div>
                              </div>
                              <div class="ml-auto">
                                  <div class="form-group">
                                      <input id="demo-input-search2" type="text" placeholder="Search" autocomplete="off">
                                  </div>
                              </div>
                          </div>
                      </div>
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
                            <td>
                              <?php if ($a->status_pengajuan == 0) { echo "Menunggu Approval PPK";  } elseif ($a->status_pengajuan == 1) { echo "Approved PPK";  } else { echo "Ditolak PPK";  } ?>
                            </td>
                            <td>
                              <center>
                                <a href="<?php echo base_url();?>ppk/detail_kontrak/<?php echo $a->id_kontrak;?>" class="btn btn-small blue btn-outline tooltipped" data-position="top" data-delay="50" data-tooltip="Preview"><i class="fas fa-eye"></i></a>
                              <?php if ($a->status_pengajuan == 0 ) { ?>
                                <a href="<?php echo base_url();?>ppk/approve/<?php echo $a->id_pengajuan;?>/1" class="btn btn-small green btn-outline tooltipped" data-position="top" data-delay="50" data-tooltip="Approve" onclick="javascript: return confirm('Yakin akan memverifikasi data ?')"><i class="fas fa-check"></i></a>
                                <a href="#modaltolak<?php echo $a->id_pengajuan;?>" class="btn btn-small red btn-outline tooltipped modal-trigger" data-position="top" data-delay="50" data-tooltip="Tolak"><i class="fas fa-times"></i></a>
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
                              <h5><span class="label label-table label-warning"><?= $a->keterangan_rkakl ?></span></h5>
                              <?= $a->keterangan ?>
                            </td>
                            <td><?php echo $this->format_tanggal->jin_date_str($a->tgl_pengajuan); ?></td>
                            <td><?php echo "Rp.".number_format($a->jumlah).",-"; ?></td>
                            <td>
                              <?php if ($a->status_pengajuan == 0) { echo "Menunggu Approval PPK";  } elseif ($a->status_pengajuan == 1) { echo "Approved PPK";  } else { echo "Ditolak PPK";  } ?>
                            </td>
                            <td>
                              <center>
                                <a href="<?php echo base_url();?>ppk/detail_rkakl/<?php echo $a->id_rkakl;?>" class="btn btn-small blue btn-outline tooltipped" data-position="top" data-delay="50" data-tooltip="Detail RKAKL"><i class="fas fa-eye"></i></a>
                                <!-- <a href="<?php echo base_url();?>ppk/detail_kontrak/<?php echo $a->id_kontrak;?>" class="btn btn-small blue btn-outline tooltipped" data-position="top" data-delay="50" data-tooltip="Preview"><i class="fas fa-eye"></i></a> -->
                              <?php if ($a->status_pengajuan == 0 ) { ?>
                                <a href="<?php echo base_url();?>ppk/approve_rkakl/<?php echo $a->id_pengajuan;?>/1" class="btn btn-small green btn-outline tooltipped" data-position="top" data-delay="50" data-tooltip="Approval" onclick="javascript: return confirm('Yakin akan memverifikasi data ?')"><i class="fas fa-check"></i></a>
                                <a href="#modaltolakrkakl<?php echo $a->id_pengajuan;?>" class="btn btn-small red btn-outline tooltipped modal-trigger" data-position="top" data-delay="50" data-tooltip="Tolak"><i class="fas fa-times"></i></a>
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
        </div>
    </div>
</div>
<?php foreach ($result as $a) { ?>
  <div id="modaltolak<?php echo $a->id_pengajuan; ?>" class="modal">
    <?php echo form_open_multipart('ppk/tolak');?>
      <div class="modal-content">
        <div class="row">
            <div class="input-field col s12">
                <input id="id_pengajuan" type="text" name="id_pengajuan" value="<?php echo $a->id_pengajuan; ?>" hidden>
                <input id="keterangan_tolak" type="text" name="keterangan_tolak" maxlength="255" required></input>
                <label for="keterangan_tolak">Alasan Penolakan</label>
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
<?php } ?>
<?php foreach ($result_rkakl as $a) { ?>
  <div id="modaltolakrkakl<?php echo $a->id_pengajuan; ?>" class="modal">
    <?php echo form_open_multipart('ppk/tolakrkakl');?>
      <div class="modal-content">
        <div class="row">
            <div class="input-field col s12">
                <input id="id_pengajuan" type="text" name="id_pengajuan" value="<?php echo $a->id_pengajuan; ?>" hidden>
                <input id="keterangan_tolak" type="text" name="keterangan_tolak" maxlength="255" required></input>
                <label for="keterangan_tolak">Keterangan</label>
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
<?php } ?>
