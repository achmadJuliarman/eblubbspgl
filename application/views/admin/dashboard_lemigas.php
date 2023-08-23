<?php
$total_target = 0;$total_terkontrak=0;$total_invoice=0;$total_realisasi=0;$total_pengeluaran=0;$total_piutang=0;
foreach ($rekap_lemigas as $a)
{
  $total_target = $total_target + $a->target_rp;
  $total_terkontrak=$total_terkontrak + $a->kontrak_nilai_rp + $a->kontrak_luncuran_nilai_rp;
  $total_invoice=$total_invoice + $a->inv_terbit_nilai_rp;
  $total_piutang=$total_piutang + $a->inv_piutang_nilai_rp;
  $total_realisasi=$total_realisasi + $a->penerimaan_nilai_rp;
  $total_pengeluaran=$total_pengeluaran + $a->slip_nilai_rp;
}
?>
<div class="container-fluid">

    <div class="row">
        <div class="col l3 m8 s12">
            <div class="card danger-gradient card-hover">
                <div class="card-content">
                    <div class="d-flex no-block align-items-center">
                        <div>
                            <h4 class="white-text m-b-5"><?php echo "Rp. ".number_format($total_target,0,'','.' ); ?></h4>
                            <h6 class="white-text op-5 light-blue-text">TARGET PENDAPATAN</h6>
                        </div>
                        <div class="ml-auto">
                          <span class="white-text display-6"><i class="material-icons">equalizer</i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col l3 m8 s12">
            <div class="card info-gradient card-hover">
                <div class="card-content">
                    <div class="d-flex no-block align-items-center">
                        <div>
                            <h4 class="white-text m-b-5"><?php echo "Rp. ".number_format($total_terkontrak ,0,'','.' ); ?></h4>
                            <h6 class="white-text op-5">TERKONTRAK</h6>
                        </div>
                        <div class="ml-auto">
                          <span class="white-text display-6"><i class="material-icons">equalizer</i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col l3 m8 s12">
            <div class="card success-gradient card-hover">
                <div class="card-content">
                    <div class="d-flex no-block align-items-center">
                        <div>
                            <h4 class="white-text m-b-5"><?php echo "Rp. ".number_format($total_invoice,0,'','.' ); ?></h4>
                            <h6 class="white-text op-5 text-darken-2">INVOICE</h6>
                        </div>
                        <div class="ml-auto">
                            <span class="white-text display-6"><i class="material-icons">equalizer</i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col l3 m8 s12">
            <div class="card warning-gradient card-hover">
                <div class="card-content">
                    <div class="d-flex no-block align-items-center">
                        <div>
                            <h4 class="white-text m-b-5"><?php echo "Rp. ".number_format($total_realisasi,0,'','.' ); ?></h4>
                            <h6 class="white-text op-5">REALISASI PENDAPATAN</h6>
                        </div>
                        <div class="ml-auto">
                          <span class="white-text display-6"><i class="material-icons">equalizer</i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col l4 m8 s16">
            <div class="card danger-gradient card-hover">
                <div class="card-content">
                    <div class="d-flex no-block align-items-center">
                        <div>
                            <h4 class="white-text m-b-5"><?php echo "Rp. ".number_format($total_pengeluaran,0,'','.' ); ?></h4>
                            <h6 class="white-text op-5 light-blue-text">REALISASI BIAYA</h6>
                        </div>
                        <div class="ml-auto">
                          <span class="white-text display-6"><i class="material-icons">equalizer</i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col l4 m8 s16">
            <div class="card info-gradient card-hover">
                <div class="card-content">
                    <div class="d-flex no-block align-items-center">
                        <div>
                            <h4 class="white-text m-b-5"><?php echo "Rp. ".number_format($total_realisasi - $total_pengeluaran,0,'','.' ); ?></h4>
                            <h6 class="white-text op-5">SURPLUS</h6>
                        </div>
                        <div class="ml-auto">
                          <span class="white-text display-6"><i class="material-icons">equalizer</i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col l4 m8 s16">
            <div class="card success-gradient card-hover">
                <div class="card-content">
                    <div class="d-flex no-block align-items-center">
                        <div>
                            <h4 class="white-text m-b-5"><?php echo "Rp. ".number_format($total_piutang,0,'','.' ); ?></h4>
                            <h6 class="white-text op-5 text-darken-2">PIUTANG</h6>
                        </div>
                        <div class="ml-auto">
                            <span class="white-text display-6"><i class="material-icons">equalizer</i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Sales Summery -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col s12 l12">
            <div class="card">
                <div class="card-content">
                    <div class="p-t-20">
                        <div class="row">
                            <div class="col s12">
                                <div id="containerlemigas" style="height: 450px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <div class="d-flex align-items-center">
                        <div>
                            <h5 class="card-title">Detail Informasi</h5>
                            <h6 class="card-subtitle">Pengelolaan Keuangan BLU (dalam rupiah)</h6>
                        </div>
                        <div class="ml-auto">
                          <?php echo form_open_multipart('pimpinan_lemigas');?>
                            <div class="input-field dl support-select">
                                <select name="tahun">
                                    <?php $tahun = DATE("Y"); ?>
                                    <option value="" selected>Pilih Tahun</option>
                                    <option value="<?php echo $tahun; ?>"><?php echo $tahun; ?></option>
                                    <option value="<?php echo $tahun-1; ?>"><?php echo $tahun-1; ?></option>
                                    <option value="<?php echo $tahun-2; ?>"><?php echo $tahun-2; ?></option>
                                </select>
                            </div>
                            <button class="btn btn-small green btn-outline" type="submit" name="action"><i class="fas fa-search"></i> Pilih</button>
                          </form>
                        </div>
                    </div>
                    <div class="table-responsive m-b-20">
                        <table class="">
                            <thead>
                                <tr>
                                    <th style="text-align:center">No</th>
                                    <th style="text-align:center">Satker</th>
                                    <th style="text-align:center">Target</th>
                                    <th style="text-align:center">Terkontrak</th>
                                    <th style="text-align:center">Invoice</th>
                                    <th style="text-align:center">Realisasi Pendapatan</th>
                                    <th style="text-align:center">Realisasi Biaya</th>
                                    <th style="text-align:center">Surplus</th>
                                    <th style="text-align:center">Piutang</th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php $total_target = 0;$total_terkontrak=0;$total_invoice=0;$total_realisasi=0;$total_pengeluaran=0;$total_piutang=0;?>
                              <?php $no=1; $tahun = DATE('Y'); foreach ($rekap_lemigas as $a) { ?>
                                <tr>
                                    <td style="text-align:center">
                                        <?php echo $no; ?>
                                    </td>
                                    <td class="blue-grey-text text-darken-4 font-medium" ><?php echo $a->unit_nama; ?></td>
                                    <td class="blue-grey-text text-darken-4 font-medium" style="text-align:right"><?php echo number_format($a->target_rp,0,'','.' ); ?></td>
                                    <td class="blue-grey-text text-darken-4 font-medium" style="text-align:right"><?php if ($a->kontrak_nilai_rp + $a->kontrak_luncuran_nilai_rp == NULL) { echo "-"; } else { echo number_format($a->kontrak_nilai_rp + $a->kontrak_luncuran_nilai_rp,0,'','.' ); }?></td>
                                    <td class="blue-grey-text text-darken-4 font-medium" style="text-align:right"><?php if ($a->inv_terbit_nilai_rp == NULL) { echo "-"; } else { echo number_format($a->inv_terbit_nilai_rp,0,'','.' ); }?></td>
                                    <td class="orange-text text-darken-4 font-medium" style="text-align:right"><?php if ($a->penerimaan_nilai_rp == NULL) { echo "-"; } else { echo number_format($a->penerimaan_nilai_rp,0,'','.' ); }?></td>
                                    <td class="blue-grey-text  text-darken-4 font-medium" style="text-align:right"><?php if ($a->slip_nilai_rp == NULL) { echo "-"; } else { echo number_format($a->slip_nilai_rp,0,'','.' ); }?></a></td>
                                    <td class="green-text" style="text-align:right"><?php $surplus = $a->penerimaan_nilai_rp - $a->slip_nilai_rp; echo number_format($surplus,0,'','.' ); ?></td>
                                    <td class="blue-grey-text  text-darken-4 font-medium" style="text-align:right"><?php if ($a->inv_piutang_nilai_rp == NULL) { echo "-"; } else { echo number_format($a->inv_piutang_nilai_rp,0,'','.' ); }?></td>
                                </tr>
                              <?php
                              $total_target = $total_target + $a->target_rp;
                              $total_terkontrak=$total_terkontrak + $a->kontrak_nilai_rp + $a->kontrak_luncuran_nilai_rp;
                              $total_invoice=$total_invoice + $a->inv_terbit_nilai_rp;
                              $total_piutang=$total_piutang + $a->inv_piutang_nilai_rp;
                              $total_realisasi=$total_realisasi + $a->penerimaan_nilai_rp;
                              $total_pengeluaran=$total_pengeluaran + $a->slip_nilai_rp;
                              $no=$no+1; }
                              ?>
                              <tr>
                                  <td colspan="2">
                                      TOTAL
                                  </td>
                                  <td class="blue-grey-text text-darken-4 font-medium" style="text-align:right"><?php if ($total_target  == NULL) { echo "-"; } else { echo number_format($total_target ,0,'','.' ); }?></td>
                                  <td class="blue-grey-text text-darken-4 font-medium" style="text-align:right"><?php if ($total_terkontrak  == NULL) { echo "-"; } else { echo number_format(($total_terkontrak) ,0,'','.' ); }?></td>
                                  <td class="blue-grey-text text-darken-4 font-medium" style="text-align:right"><?php if ($total_invoice  == NULL) { echo "-"; } else { echo number_format($total_invoice ,0,'','.' ); }?></td>
                                  <td class="orange-text text-darken-4 font-medium" style="text-align:right"><?php if ($total_realisasi  == NULL) { echo "-"; } else { echo number_format($total_realisasi ,0,'','.' ); }?></td>
                                  <td class="blue-grey-text  text-darken-4 font-medium" style="text-align:right"><?php if ($total_pengeluaran  == NULL) { echo "-"; } else { echo number_format($total_pengeluaran ,0,'','.' ); }?></td>
                                  <td class="green-text" style="text-align:right"><?php $surplus = $total_realisasi - $total_pengeluaran; echo number_format($surplus,0,'','.' ); ?></td>
                                  <td class="blue-grey-text  text-darken-4 font-medium" style="text-align:right"><?php $piutang = $total_piutang; echo number_format($piutang,0,'','.' );?></td>
                              </tr>
                            </tbody>
                        </table>
                        <table id="datatablelemigas" hidden>
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Realisasi</th>
                                        <th>Pengeluaran</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php foreach ($rekap_lemigas as $a) { ?>
                                    <tr>
                                        <th><?php echo $a->unit_nama;?></th>
                                        <td><?php echo $a->penerimaan_nilai_rp;?></td>
                                        <td><?php echo $a->slip_nilai_rp;?></td>
                                    </tr>
                                  <?php } ?>
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Recent comment and chats -->
    <!-- ============================================================== -->

</div>
