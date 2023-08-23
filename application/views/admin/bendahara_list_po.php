<div class="container-fluid">
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <h4 class="card-title">Daftar PO</h4>
                    <h6 class="card-subtitle">You have <?php echo count($result); ?> PO</h6>
                    <table id="demo-foo-addrow2" class="table table-bordered table-hover toggle-circle" data-page-size="10">
                      <thead>
                        <tr>
                          <th width="5%" data-sort-ignore="true"><center>No.</center></th>
                          <th width="15%">Tanggal</th>
                          <th width="50%">Customer/Keterangan</th>
                          <th width="10%" data-sort-ignore="true"><center>Jumlah</center></th>
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
                      <div class="m-t-40">
                          <div class="d-flex">
                              <div class="mr-auto">
                                  <div class="form-group">
                                    <a href="<?php echo base_url();?>bendahara/input_po/<?php echo $kategori;?>" class="btn btn-medium"><i class="icon wb-plus" aria-hidden="true"></i> <i class="far fa-file-alt"></i> Tambah Data PO</a>
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
                              <td><b><?php echo $a->no_po; ?></b><br/><?php echo $a->tanggal; ?></td>
                              <td><b><?php echo $a->nama_po; ?></b><br/><?php echo $a->keterangan; ?></td>
                              <td><center><?php echo "Rp.".number_format($a->nilai_po).",-"; ?></center></td>
                              <?php if ($a->status == 0) { ?>
                                <td>
                                  <center>
                                    <a href="<?php echo  base_url()."home/bendahara_pindah/".$a->id_po; ?>" class="btn btn-small red btn-outline tooltipped" data-position="top" data-delay="50" data-tooltip="Pindah Operasional" onclick="javascript: return confirm('Yakin memindahkan ke dana Operasional?')">Operasional</a>
                                    <a href="<?php echo  base_url()."home/bendahara_cetak_invoice/".$a->id_po; ?>" class="btn btn-small orange btn-outline tooltipped" data-position="top" data-delay="50" data-tooltip="Cetak Invoice" target="_blank">Invoice</a>
                                  </center>
                                </td>
                              <?php } else { ?>
                                <td><center><a href="<?php echo  base_url()."home/bendahara_cetak_kwitansi/".$a->id_po; ?>" class="btn btn-small green btn-outline tooltipped" data-position="top" data-delay="50" data-tooltip="Cetak Kwitansi" target="_blank">Kwitansi</a></center></td>
                              <?php } ?>
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
