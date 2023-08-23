<div class="container-fluid">
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                  <div class="d-flex align-items-center">
                      <div>
                          <h4>Mailbox <i class="ti-menu ti-close right show-left-panel hide-on-med-and-up"></i></h4>
                          <span>Here is the list of mail</span>
                      </div>
                      <div class="ml-auto">
                          <div class="input-field m-b-0">
                            <input id="demo-input-search2" type="text" placeholder="Search" autocomplete="off">
                          </div>
                      </div>
                  </div>
                    <table id="demo-foo-addrow2" class="table table-bordered table-hover toggle-circle" data-page-size="7">
                      <thead>
                        <tr>
                          <th width="5%" data-sort-ignore="true"><center>No.</center></th>
                          <th width="40%">Keterangan</th>
                          <th width="25%">Tanggal</th>
                          <th width="10%" data-sort-ignore="true"><center>Action</center></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $no=1; foreach($result_progress AS $a) { ?>
                          <tr>
                            <td><center><?php echo $no; ?></center></td>
                            <td>
                              <span class="blue-grey-text text-darken-4"><?php echo $a->nama_kegiatan; ?> - <?php echo $a->kode; ?></span>
                            </td>
                            <td><?php echo $this->format_tanggal->jin_date_str($a->tgl_mulai)." s/d ".$this->format_tanggal->jin_date_str($a->tgl_akhir); ?></td>
                            <td><center>
                            <?php if ($a->status_kegiatan == 1) { ?>
                            <a href="<?php echo base_url();?>program/konfirmasi_progress/<?php echo $a->id_kegiatan;?>" class="btn btn-small red btn-outline tooltipped" data-position="top" data-delay="50" data-tooltip="Konfirmasi" onclick="javascript: return confirm('Yakin akan Konfirmasi data ?')"><i class="fas fa-check"></i></a>
                            <?php } else { ?>
                              <span class="label label-success">Approved</span>
                            <?php } ?>
                            </center></td>
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
