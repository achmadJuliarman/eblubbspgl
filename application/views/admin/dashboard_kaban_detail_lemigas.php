<div class="container-fluid">
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <div class="d-flex align-items-center">
                        <div>
                            <h5 class="card-title">Detail Informasi</h5>
                            <h6 class="card-subtitle">Pengelolaan Keuangan BLU</h6>
                        </div>
                    </div>
                    <div class="table-responsive m-b-20">
                      <div class="form-group">
                          <input id="demo-input-search2" type="text" placeholder="Pencarian Data" autocomplete="off">
                      </div>
                      <table id="demo-foo-addrow2" class="table table-bordered table-hover toggle-circle" data-page-size="20">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul Kontrak / Nama Pelanggan</th>
                                    <th>Tanggal Pelaksanaan</th>
                                    <th>Nilai Kontrak</th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php $no=1; foreach ($kontrak_lemigas as $a) { ?>
                                <tr>
                                    <td>
                                        <?php echo $no; ?>
                                    </td>
                                    <td class="blue-grey-text text-darken-4 font-medium"><b><?php echo $a->kontrak_nama; ?></b><br><?php echo $a->cust_nama; ?></td>
                                    <td class="blue-grey-text text-darken-4 font-medium"><?php echo $this->format_tanggal->jin_date_str($a->kontrak_tanggal)." s/d ".$this->format_tanggal->jin_date_str($a->kontrak_tanggal_duedate); ?></td>
                                    <td class="blue-grey-text text-darken-4 font-medium"><?php echo "Rp. ".number_format($a->kontrak_nilai_rp,0,'','.' ).",-"; ?></td>
                                </tr>
                              <?php
                              $no=$no+1; }
                              ?>
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
</div>
