<div class="container-fluid">
  <div class="row">
      <div class="col l6 m16 s12">
          <div class="card danger-gradient card-hover">
              <div class="card-content">
                  <div class="d-flex no-block align-items-center">
                      <div>
                          <h4 class="white-text m-b-5"><?php echo "Rp. ".number_format($target->jumlah,0,'','.' ).",-"; ?></h4>
                          <h6 class="white-text op-5 light-blue-text">TARGET PENDAPATAN</h6>
                      </div>
                      <div class="ml-auto">
                        <span class="white-text display-6"><i class="material-icons">equalizer</i></span>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="col l6 m16 s12">
          <div class="card info-gradient card-hover">
            <div class="card-content">
                <div class="d-flex no-block align-items-center">
                    <div>
                        <h4 class="white-text m-b-5"><?php echo "Rp. ".number_format($realisasi->jumlah,0,'','.' ).",-"; ?></h4>
                        <h6 class="white-text op-5 text-darken-2">REALISASI</h6>
                    </div>
                    <div class="ml-auto">
                        <span class="white-text display-6"><i class="material-icons">equalizer</i></span>
                    </div>
                </div>
            </div>
          </div>
      </div>
      <div class="col l4 m8 s12">
          <div class="card success-gradient card-hover">
            <div class="card-content">
                <div class="d-flex no-block align-items-center">
                    <div>
                        <h4 class="white-text m-b-5"><?php echo "Rp. ".number_format($terkontrak->jumlah,0,'','.' ).",-"; ?></h4>
                        <h6 class="white-text op-5">TERKONTRAK</h6>
                    </div>
                    <div class="ml-auto">
                      <span class="white-text display-6"><i class="material-icons">equalizer</i></span>
                    </div>
                </div>
            </div>
          </div>
      </div>
      <div class="col l4 m8 s12">
          <div class="card success-gradient card-hover">
            <div class="card-content">
                <div class="d-flex no-block align-items-center">
                    <div>
                        <h4 class="white-text m-b-5"><?php echo "Rp. ".number_format($invoice->jumlah,0,'','.' ).",-"; ?></h4>
                        <h6 class="white-text op-5 text-darken-2">INVOICE</h6>
                    </div>
                    <div class="ml-auto">
                        <span class="white-text display-6"><i class="material-icons">equalizer</i></span>
                    </div>
                </div>
            </div>
          </div>
      </div>
      <div class="col l4 m8 s12">
          <div class="card warning-gradient card-hover">
              <div class="card-content">
                  <div class="d-flex no-block align-items-center">
                      <div>
                          <h4 class="white-text m-b-5"><?php echo "Rp. ".number_format($pengeluaran->jumlah,0,'','.' ).",-"; ?></h4>
                          <h6 class="white-text op-5">PENGELUARAN</h6>
                      </div>
                      <div class="ml-auto">
                        <span class="white-text display-6"><i class="material-icons">equalizer</i></span>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <h4 class="card-title">Daftar Kontrak</h4>
                    <h6 class="card-subtitle">You have <?php echo $jumlah; ?> Contract</h6>
                    <div class="ml-auto">
                        <div class="form-group">
                            <input id="demo-input-search2" type="text" placeholder="Search" autocomplete="off">
                        </div>
                    </div>
                    <table id="demo-foo-addrow2" class="table table-bordered table-hover toggle-circle" data-page-size="10">
                      <thead>
                        <tr>
                          <th width="5%" data-sort-ignore="true"><center>No.</center></th>
                          <th width="50%">Judul kontrak</th>
                          <th width="15%">Tanggal Mulai</th>
                          <th width="15%">Tanggal Selesai</th>
                          <th width="20%" data-sort-ignore="true"><center>Action</center></th>
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
                      <?php $kategori = $this->session->userdata('admin_kategori'); ?>

                      <tbody>
                        <?php $no=1; foreach($result AS $a) { ?>
                          <tr>
                            <td><center><?php echo $no; ?></center></td>
                            <td>
                              <a href="<?php echo base_url();?>pejabat_teknis/detail_kontrak/<?php echo $a->id_kontrak;?>"><?= $a->nama_kontrak ?></a>
                              <br/>
                              <span class="label label-table label-warning"><?php echo $a->no_kontrak; ?></strong> (Tanggal : <?php echo $a->tgl_ttd; ?>)</span>
                              <br/>
                              <span class="label label-table label-success"><?php echo $a->nama_perusahaan; ?></span>&nbsp;<span class="label label-table label-danger"><?php echo "Rp.".number_format($a->nilai_kontrak).",-"; ?></span>
                            </td>
                            <td><?php echo $a->tgl_mulai; ?></td>
                            <td><?php echo $a->tgl_akhir; ?></td>
                            <!-- <td><?php echo "Rp.".number_format($a->nilai_kontrak).",-"; ?></td> -->
                            <td>
                              <center>
                                <?php if ($kategori == 2 || $kategori == 3) { ?>
                                <a href="<?php echo base_url();?>pejabat_teknis/setting_kontrak/<?php echo $a->id_kontrak;?>" class="btn btn-small cyan btn-outline tooltipped" data-position="top" data-delay="50" data-tooltip="Setting Kontrak"><i class="fas fa-cog"></i></a>
                              <?php } else { ?>
                                <a href="<?php echo base_url();?>afin/pilih_kontrak/<?php echo $a->id_kontrak;?>" class="btn btn-small green btn-outline tooltipped" data-position="top" data-delay="50" data-tooltip="Edit Kontrak"><i class="far fa-file-alt"></i></a>
                                <a href="<?php echo base_url();?>afin/hapus_kontrak/<?php echo $a->id_kontrak;?>" class="btn btn-small red btn-outline tooltipped" data-position="top" data-delay="50" data-tooltip="Hapus Kontrak" onclick="javascript: return confirm('Yakin akan menghapus data ?')"><i class="fas fa-trash"></i></a>
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
