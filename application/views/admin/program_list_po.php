<div class="container-fluid">
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <h4 class="card-title">Daftar PO</h4>
                    <h6 class="card-subtitle">You have <?php echo $jumlah; ?> PO</h6>
                    <div class="form-group">
                        <input id="demo-input-search2" type="text" placeholder="Search" autocomplete="off">
                    </div>
                    <table id="demo-foo-addrow2" class="table table-bordered table-hover toggle-circle" data-page-size="10">
                      <thead>
                        <tr>
                          <th width="5%" data-sort-ignore="true"><center>No.</center></th>
                          <th width="70%">Nomor PO / Judul PO</th>
                          <th width="25%">Tanggal</th>
                        </tr>
                      </thead>

                      <tbody>
                        <?php $no=1; foreach($result AS $a) { ?>
                          <tr>
                            <td><center><?php echo $no; ?></center></td>
                            <td>
                              <?php echo $a->nama_perusahaan; ?><br>
                              <span class="label label-table label-warning"><?php echo $a->no_invoice; ?></span>&nbsp;<span class="label label-table label-danger"><?php echo "Rp.".number_format($a->nilai_kontrak).",-"; ?></span>
                              <br>
                              <span class="label label-table label-success"><?php echo $a->jenis." - ".$a->nama_layanan; ?></span>
                              <br>
                              <?php echo "Keterangan : ".$a->keterangan; ?>
                            </td>
                            <td><?php echo $this->format_tanggal->jin_date_str($a->tanggal); ?></td>
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
