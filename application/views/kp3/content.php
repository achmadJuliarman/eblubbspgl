<div id="main">
      <div class="row">
        <div class="col s12">
            <div class="container">
                <div class="section section-data-tables">
                  <div id="card-stats" class="pt-0">
                    <div class="row">
                      <div class="col s12 m6 l4">
                          <div class="card animate fadeRight">
                              <div class="card-content gradient-45deg-light-blue-cyan lighten-1 white-text">
                                  <p class="card-stats-title">TARGET PENDAPATAN</p>
                                  <h4 class="card-stats-number white-text"><?php echo "Rp. ".number_format($target->jumlah,0,'','.' ).",-"; ?></h4>
                              </div>
                          </div>
                      </div>
                      <div class="col s12 m6 l4">
                          <div class="card animate fadeRight">
                              <div class="card-content gradient-45deg-light-blue-cyan lighten-1 white-text">
                                  <p class="card-stats-title">REALISASI PENDAPATAN</p>
                                  <h4 class="card-stats-number white-text"><?php echo "Rp. ".number_format($realisasi->jumlah,0,'','.' ).",-"; ?></h4>
                              </div>
                          </div>
                      </div>
                      <div class="col s12 m6 l4">
                          <div class="card animate fadeRight">
                              <div class="card-content gradient-45deg-light-blue-cyan lighten-1 white-text">
                                  <p class="card-stats-title">TERKONTRAK</p>
                                  <h4 class="card-stats-number white-text"><?php echo "Rp. ".number_format($terkontrak->jumlah,0,'','.' ).",-"; ?></h4>
                              </div>
                          </div>
                      </div>
                      <div class="col s12 m6 l6">
                          <div class="card animate fadeRight">
                              <div class="card-content gradient-45deg-light-blue-cyan lighten-1 white-text">
                                  <p class="card-stats-title">INVOICE</p>
                                  <h4 class="card-stats-number white-text"><?php echo "Rp. ".number_format($invoice->jumlah,0,'','.' ).",-"; ?></h4>
                              </div>
                          </div>
                      </div>
                      <div class="col s12 m6 l6">
                          <div class="card animate fadeRight">
                              <div class="card-content gradient-45deg-light-blue-cyan lighten-1 white-text">
                                  <p class="card-stats-title">REALISASI BELANJA</p>
                                  <h4 class="card-stats-number white-text"><?php echo "Rp. ".number_format($pengeluaran->jumlah,0,'','.' ).",-"; ?></h4>
                              </div>
                          </div>
                      </div>

                    </div>
                  </div>
                  <!-- <div class="card-content">
                    <div class="row">
                      <div class="col s12">
                          <div class="card-panel gradient-45deg-light-blue-cyan" style="color: rgba(255, 255, 255, 0.901961);">
                            <span style="color: rgba(255, 255, 255, 0.901961);font-size:20px;"><center>Daftar Kontrak</center></span>
                          </div>
                      </div>
                    </div>
                  </div> -->


                  <div class="card">
                      <div class="card-content">
                          <!-- <h4 class="card-title">Daftar Kontrak</h4> -->
                          <div class="row">
                              <div class="col s12">
                                <table id="example" class="display table table-bordered" cellspacing="0" width="100%">
                                  <!-- <table id="page-length-option" class="display" width="100%"> -->
                                      <thead>
                                          <tr>
                                            <th style="text-align:center;" width="5%">No.</th>
                                            <th style="text-align:center;">Judul kontrak</th>
                                            <!-- <th style="text-align:center;">Tanggal Kontrak</th> -->
                                            <th style="text-align:center;">Action</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                        <?php $no=1; foreach($result AS $a) { ?>
                                          <tr>
                                            <td style="text-align:center;"><?php echo $no; ?></td>
                                            <td>
                                              <b><?php echo $a->nama_kontrak; ?></b>
                                              <br/>
                                              <span style="font-size: 10px;" class="badge gradient-45deg-light-blue-cyan"><?php echo $a->nama; ?></span>
                                              <br>
                                              <?php echo $a->no_kontrak; ?></strong> (Tanggal : <?php echo $a->tgl_ttd; ?>)
                                              <br/>
                                              <span style="font-size: 11px;" class="badge green"><?php echo $a->nama_perusahaan; ?></span>&nbsp;<span style="font-size: 10px;" class="badge red"><?php echo "Rp.".number_format($a->nilai_kontrak).",-"; ?></span>
                                              <br>
                                              <span style="font-size: 11px;" class="badge orange"><?php echo $this->format_tanggal->jin_date_str($a->tgl_mulai); ?> s/d <?php echo $this->format_tanggal->jin_date_str($a->tgl_akhir); ?></span>
                                            </td>
                                            <td>
                                              <a href="<?php echo base_url();?>pejabat_teknis/setting_kontrak/<?php echo $a->id_kontrak;?>" class="btn mb-1 waves-effect waves-light gradient-45deg-light-blue-cyan mr-1">Setting Kontrak<i class="material-icons left">settings</i></a>
                                            </td>
                                            <!-- <td style="text-align:center;"><?php echo $this->format_tanggal->jin_date_str($a->tgl_mulai); ?> s/d <?php echo $this->format_tanggal->jin_date_str($a->tgl_akhir); ?></td> -->
                                            <!-- <td style="text-align:center;">
                                              <a href="<?php echo base_url();?>program/setting_kontrak/<?php echo $a->id_kontrak;?>" class="btn-floating blue mb-1 waves-effect waves-light tooltipped" data-position="top" data-tooltip="Setting Kontrak"><i class="material-icons dp48">settings</i></a>
                                              <a href="<?php echo base_url();?>program/setting_kontrak/<?php echo $a->id_kontrak;?>" class="btn-floating blue mb-1 waves-effect waves-light"><i class="material-icons dp48">settings</i></a>
                                            </td> -->
                                          </tr>
                                        <?php $no=$no+1; } ?>
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
