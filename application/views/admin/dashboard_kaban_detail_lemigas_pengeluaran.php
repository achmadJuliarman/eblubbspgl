<div class="container-fluid">
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <div class="d-flex align-items-center">
                        <div>
                            <h5 class="card-title">Detail Informasi</h5>
                            <h6 class="card-subtitle">Pengeluaran Keuangan BLU</h6>
                        </div>
                    </div>
                    <div class="table-responsive m-b-20">
                      <div class="form-group">
                          <input id="demo-input-search2" type="text" placeholder="Pencarian Data" autocomplete="off">
                      </div>
                      <table id="demo-foo-addrow2" class="table table-bordered table-hover toggle-circle" data-page-size="20" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Keterangan</th>
                                    <th>Tanggal Realisasi</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php $no=1; foreach ($ro_lemigas as $a) { ?>

                                <tr>
                                    <td width="5%">
                                        <?php echo $no; ?>
                                    </td>
                                    <td width="65%" class="blue-grey-text text-darken-4 font-medium">
                                      <?php echo $a->kontrak_nama;?><br>
                                      <b><?php echo $a->unit_nama; ?></b><br>
                                      <?php echo $a->mak_kode." - ".$a->mak_nama; ?><br>
                                      Keterangan : <?php echo $a->keterangan; ?>
                                    </td>
                                    <td width="15%"><?php echo $this->format_tanggal->jin_date_str($a->tanggal); ?></td>
                                    <td width="15%"><?php echo "Rp. ".number_format($a->nilai,0,'','.' ).",-"; ?></td>
                                </tr>
                              <?php
                              $no=$no+1; }
                              ?>
                            </tbody>
                            <!-- <tfoot>
                                <tr>
                                    <td colspan="5">
                                        <div class="text-right">
                                            <ul class="pagination">
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            </tfoot> -->
                        </table>
                        <br><br>
                        <div class="text-right">
                            <ul class="pagination">
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
