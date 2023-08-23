<div class="container-fluid">
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <div class="d-flex align-items-center">
                        <div>
                            <h5 class="card-title">Detail Informasi</h5>
                            <h6 class="card-subtitle">Data Invoice</h6>
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
                                    <th>Nilai Termin</th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php $no=1; foreach ($result as $a) { ?>
                                <tr>
                                    <td>
                                        <?php echo $no; ?>
                                    </td>
                                    <td class="blue-grey-text text-darken-4 font-medium">
                                      <?php if ($a->status == "K") { ?>
                                        <?php $tanggal=strtotime($a->tgl_invoice); $tanggal_hari_ini=strtotime("now"); $hari = ($tanggal_hari_ini - $tanggal) / (60 * 60 * 24); ?>
                                        <?php if ($a->status_pembayaran == 0) { ?>
                                          <?php if ($hari >= 30) { ?>
                                            <a href="<?php echo base_url();?>pimpinan/info_detail_kontrak/<?php echo $a->id_kontrak;?>">
                                              <b><?php echo $a->nama_kontrak; ?></b> Termin ke <?php echo $a->termin;?>
                                              <?php if($a->jumlah_penagihan > 0) { ?>
                                                <?php $status_penagihan = $this->db->query("SELECT * FROM penagihan WHERE id_termin = $a->id_termin AND keterangan = $a->jumlah_penagihan")->row();?>
                                                <?php $tanggal_telat=strtotime($status_penagihan->tgl_termin); $tanggal_hari_ini=strtotime("now"); $hari_penagihan = ($tanggal_hari_ini - $tanggal_telat) / (60 * 60 * 24); ?>
                                                <?php if($a->jumlah_penagihan = 4) { ?>
                                                  <span class="label label-table label-warning">Piutang Macet</span>
                                                <?php } else { ?>
                                                  <span class="orange-text text-darken-4 font-medium"> (Terlambat <?php echo ceil($hari_penagihan)." Hari";?>) - Penagihan ke <?php echo $a->jumlah_penagihan;?></span>
                                                <?php } ?>
                                              <?php } else { ?>
                                                <span class="orange-text text-darken-4 font-medium"> (Terlambat <?php echo ceil($hari)." Hari";?>)</span>
                                              <?php } ?>
                                            </a>
                                          <?php } else { ?>
                                            <a href="<?php echo base_url();?>pimpinan/info_detail_kontrak/<?php echo $a->id_kontrak;?>"><b><?php echo $a->nama_kontrak; ?></b> Termin ke <?php echo $a->termin;?></a>
                                          <?php } ?>
                                        <?php } else { ?>
                                          <a href="<?php echo base_url();?>pimpinan/info_detail_kontrak/<?php echo $a->id_kontrak;?>"><b><?php echo $a->nama_kontrak; ?></b> Termin ke <?php echo $a->termin;?><span class="green-text text-darken-4 font-medium"> (Lunas)</span></a>
                                        <?php } ?>
                                      <?php } else { ?>
                                        <a href="<?php echo base_url();?>pimpinan/info_detail_kontrak/<?php echo $a->id_kontrak;?>"><b>Purchase Order</b></a>
                                      <?php } ?>
                                        <br><?php echo $a->nama_perusahaan; ?>
                                    </td>
                                    <td class="blue-grey-text text-darken-4 font-medium"><?php echo $this->format_tanggal->jin_date_str($a->tgl_mulai)." s/d ".$this->format_tanggal->jin_date_str($a->tgl_akhir); ?></td>
                                    <td class="blue-grey-text text-darken-4 font-medium"><?php echo "Rp. ".number_format($a->jumlah,0,'','.' ).",-"; ?></td>
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
