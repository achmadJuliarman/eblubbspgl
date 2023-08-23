<div id="main">
      <div class="row">
        <div class="col s12">
            <div class="container">
                <div class="section section-data-tables">

                  <div class="card-content">
                    <div class="row">
                      <div class="col s12">
                          <div class="card-panel gradient-45deg-light-blue-cyan" style="color: rgba(255, 255, 255, 0.901961);">
                            <span style="color: rgba(255, 255, 255, 0.901961);font-size:20px;"><center>INBOX PROGRESS</center></span>
                          </div>
                      </div>
                    </div>
                  </div>
                  <div class="card">
                      <div class="card-content">
                          <!-- <h4 class="card-title">Daftar Kontrak</h4> -->
                          <div class="row">
                              <div class="col s12">
                                  <table id="page-length-option" class="display" width="100%">
                                      <thead>
                                          <tr>
                                            <th style="text-align:center;" width="5%">No.</th>
                                            <th style="text-align:center;">Keterangan</th>
                                            <th style="text-align:center;">Tanggal</th>
                                            <th style="text-align:center;">Action</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                        <?php $no=1; foreach($result_progress AS $a) { ?>
                                          <tr>
                                            <td style="text-align:center;"><?php echo $no; ?></td>
                                            <td style="font-size: 12px;">
                                              <span style="font-size: 10px;" class="badge gradient-45deg-light-blue-cyan"><?php echo $a->kode; ?></span>
                                              <br>
                                              <?php echo $a->nama_kegiatan; ?>
                                            </td>
                                            <td style="text-align:center;font-size: 12px;"><?php echo $this->format_tanggal->jin_date_str($a->tgl_mulai)." s/d ".$this->format_tanggal->jin_date_str($a->tgl_akhir); ?></td>
                                            <td>
                                              <?php if ($a->status_kegiatan == 1) { ?>
                                              <a href="<?php echo base_url();?>program/konfirmasi_progress/<?php echo $a->id_kegiatan;?>" class="btn-floating orange tooltipped" data-position="top" data-tooltip="Konfirmasi" onclick="javascript: return confirm('Yakin akan mengkonfirmasi data ?')"><i class="material-icons dp48">check</i></a>
                                              <?php } else { ?>
                                                <span class="badge green" style="font-size: 12px;">Approved</span>
                                              <?php } ?>
                                            </td>
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
