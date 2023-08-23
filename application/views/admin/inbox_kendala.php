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
                          <th width="50%">Keterangan</th>
                          <th width="15%">Pengirim</th>
                          <th width="15%">Tanggal</th>
                          <th width="20%" data-sort-ignore="true"><center>Status</center></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $no=1; foreach($result_kendala AS $a) { ?>
                          <tr>
                            <td><center><?php echo $no; ?></center></td>
                            <td>
                              <a href="<?php echo base_url();?>inbox/detail_inbox/<?php echo $a->id_kendala; ?>"><span class="label label-danger m-r-10">Kendala</span> <span class="blue-grey-text text-darken-4"><?php echo $a->nama_kegiatan; ?>-</span> <?php echo $a->keterangan; ?></a>
                            </td>
                            <td><?php echo $a->kode; ?></td>
                            <td><?php echo $this->format_tanggal->jin_date_str($a->tanggal); ?></td>
                            <td>
                              <center><h6>
                                <?php if ($a->status == 0 || $a->status == 2) { ?>
                                  <span class="label label-danger m-r-10">Belum ditindaklanjuti</span>
                                <?php } elseif ($a->status == 1) { ?>
                                  <span class="label label-warning m-r-10">Menunggu tindak lanjut</span>
                                <?php } elseif ($a->status == 3) { ?>
                                  <span class="label label-success m-r-10">Closed</span>
                                <?php } ?>
                              </h6></center>
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
