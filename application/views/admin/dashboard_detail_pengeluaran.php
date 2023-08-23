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
                      <table id="demo-foo-addrow2" class="table table-bordered table-hover toggle-circle" data-page-size="20">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul Kontrak / Kode Akun</th>
                                    <th>Tanggal Realisasi</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php $no=1; foreach ($result as $a) { ?>
                                <tr>
                                    <td>
                                        <?php echo $no; ?>
                                    </td>
                                    <td class="blue-grey-text text-darken-4 font-medium"><b><?php echo $a->nama_kontrak; ?></b><br><?php echo $a->kode." - ".$a->nama_akun; ?><br>Keterangan : <?php echo $a->keterangan; ?></td>
                                    <td class="blue-grey-text text-darken-4 font-medium"><?php echo $this->format_tanggal->jin_date_str($a->tgl_realisasi); ?></td>
                                    <td class="blue-grey-text text-darken-4 font-medium"><?php echo "Rp. ".number_format($a->jumlah_realisasi,0,'','.' ).",-"; ?></td>
                                </tr>
                              <?php
                              $no=$no+1; }
                              ?>
                              <?php foreach($result_rkakl AS $a) { ?>
                                <tr>
                                    <td>
                                        <?php echo $no; ?>
                                    </td>
                                    <td class="blue-grey-text text-darken-4 font-medium"><b><?php echo $a->keterangan_rkakl; ?></b><br><?php echo $a->kode_akun." - ".$a->nama_akun; ?><br>Keterangan : <?php echo $a->keterangan; ?></td>
                                    <td class="blue-grey-text text-darken-4 font-medium"><?php echo $this->format_tanggal->jin_date_str($a->tgl_realisasi); ?></td>
                                    <td class="blue-grey-text text-darken-4 font-medium"><?php echo "Rp. ".number_format($a->jumlah_realisasi,0,'','.' ).",-"; ?></td>
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
