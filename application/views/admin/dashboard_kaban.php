<?php
//$lemigas_total_target = 0;$lemigas_total_kontrak = 0;$lemigas_total_ro = 0;$lemigas_total_invoice=0;$lemigas_total_realisasi=0;
// foreach ($target_lemigas as $value) { $lemigas_total_target = $lemigas_total_target + $value->jumlah; }
// foreach ($kontrak_lemigas as $value) { $lemigas_total_kontrak = $lemigas_total_kontrak + $value->jumlah; }
// foreach ($ro_lemigas as $value) { $lemigas_total_ro = $lemigas_total_ro + $value->jumlah; }
// foreach ($termin_lemigas as $value) { $lemigas_total_invoice = $lemigas_total_invoice + $value->jumlah; }
// foreach ($realisasi_lemigas as $value) { $lemigas_total_realisasi = $lemigas_total_realisasi + $value->jumlah; }
$pengeluaran = $pengeluaran->jumlah + $pengeluaran_rkakl->jumlah;
foreach ($rekap_lemigas as $value)
{
  $lemigas_total_target = $value->target_rp;
  $lemigas_total_kontrak = $value->kontrak_nilai_rp + $value->kontrak_luncuran_nilai_rp;
  $lemigas_total_invoice = $value->inv_terbit_nilai_rp;
  $lemigas_total_realisasi = $value->penerimaan_nilai_rp;
  $lemigas_total_ro = $value->slip_nilai_rp;
  $lemigas_total_piutang = $value->inv_piutang_nilai_rp;
}
// foreach ($termin_lemigas as $value)
// {
//   if ($value->status == 2 || $value->status == 3)
//   {
//     $lemigas_total_invoice = $lemigas_total_invoice + $value->termin_nilai;
//   }
// }
// foreach ($termin_lemigas as $value)
// {
//   if ($value->status == 3)
//   {
//     $lemigas_total_realisasi = $lemigas_total_realisasi + $value->termin_nilai;
//   }
// }
?>
<?php $total_target = 0;$total_terkontrak=0;$total_invoice=0;$total_realisasi=0;$total_pengeluaran=0;$total_hasil_realisasi=0;$total_piutang=0;?>
<?php foreach ($satker as $a) {
  $terkontrak = $this->db->query("SELECT SUM(t.jumlah) AS jumlah FROM termin AS t INNER JOIN kontrak AS k ON t.id_kontrak = k.id_kontrak INNER JOIN perusahaan AS p ON k.id_perusahaan = p.id_perusahaan WHERE (k.id_satker = $a->id_satker AND YEAR(t.tgl_termin) = $pilih_tahun) OR (k.id_satker = $a->id_satker AND YEAR(t.tgl_pembayaran) = $pilih_tahun) OR (k.id_satker = $a->id_satker AND t.status_pembayaran = 0)")->row();
  $piutang = $this->db->query("SELECT SUM(t.jumlah) AS jumlah FROM termin AS t INNER JOIN kontrak AS k ON t.id_kontrak = k.id_kontrak INNER JOIN perusahaan AS p ON k.id_perusahaan = p.id_perusahaan WHERE k.id_satker = $a->id_satker AND YEAR(t.tgl_invoice) = $pilih_tahun AND t.status_cetak_invoice=1 AND t.status_pembayaran=0")->row();
  $hasil_realisasi = $this->db->query("SELECT SUM(t.jumlah_realisasi) AS jumlah FROM termin AS t INNER JOIN kontrak AS k ON t.id_kontrak = k.id_kontrak WHERE k.id_satker = $a->id_satker AND YEAR(t.tgl_pembayaran) < $pilih_tahun AND t.status_pembayaran=1")->row();
  $total_terkontrak=$total_terkontrak + $terkontrak->jumlah;
  $total_piutang=$total_piutang + $piutang->jumlah;
  $total_hasil_realisasi=$total_hasil_realisasi + $hasil_realisasi->jumlah;
}?>
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Sales Summery -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col l3 m8 s12">
            <div class="card danger-gradient card-hover">
                <div class="card-content">
                    <div class="d-flex no-block align-items-center">
                        <div>
                            <h4 class="white-text m-b-5"><?php echo "Rp. ".number_format($target->jumlah+$lemigas_total_target,0,'','.' ); ?></h4>
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
                            <h4 class="white-text m-b-5"><?php echo "Rp. ".number_format($total_terkontrak + $lemigas_total_kontrak ,0,'','.' ); ?></h4>
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
                            <h4 class="white-text m-b-5"><?php echo "Rp. ".number_format($invoice->jumlah + $lemigas_total_invoice,0,'','.' ); ?></h4>
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
                            <h4 class="white-text m-b-5"><?php echo "Rp. ".number_format($realisasi->jumlah + $lemigas_total_realisasi,0,'','.' ); ?></h4>
                            <h6 class="white-text op-5">REALISASI PENERIMAAN</h6>
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
                            <h4 class="white-text m-b-5"><?php echo "Rp. ".number_format($pengeluaran + $lemigas_total_ro,0,'','.' ); ?></h4>
                            <h6 class="white-text op-5 light-blue-text">PENGELUARAN</h6>
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
                            <h4 class="white-text m-b-5"><?php echo "Rp. ".number_format(($realisasi->jumlah + $lemigas_total_realisasi) - ($pengeluaran + $lemigas_total_ro),0,'','.' ); ?></h4>
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
                            <h4 class="white-text m-b-5"><?php echo "Rp. ".number_format($total_piutang + $lemigas_total_piutang,0,'','.' ); ?></h4>
                            <h6 class="white-text op-5 text-darken-2">PIUTANG</h6>
                        </div>
                        <div class="ml-auto">
                            <span class="white-text display-6"><i class="material-icons">equalizer</i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- <div class="col l3 m8 s12">
            <div class="card warning-gradient card-hover">
                <div class="card-content">
                    <div class="d-flex no-block align-items-center">
                        <div>
                            <h4 class="white-text m-b-5"><?php echo "Rp. ".number_format($terkontrak->jumlah-$pengeluaran->jumlah,0,'','.' ); ?></h4>
                            <h6 class="white-text op-5">PIUTANG</h6>
                        </div>
                        <div class="ml-auto">
                          <span class="white-text display-6"><i class="material-icons">equalizer</i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
    <!-- ============================================================== -->
    <!-- Sales Summery -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col s12 l12">
            <div class="card">
                <div class="card-content">

                    <!-- Sales Summery -->
                    <div class="p-t-20">
                        <div class="row">
                            <div class="col s12">
                                <div id="containerkaban" style="height: 450px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="col s12 l4">
            <div class="card card-hover">
                <div class="card-content">
                    <div class="d-flex align-items-center">
                        <div class="m-r-20">
                            <h1 class=""><i class="ti-light-bulb"></i></h1></div>
                        <div>
                            <h3 class="card-title">Sales Analytics</h3>
                            <h6 class="card-subtitle">March  2017</h6> </div>
                    </div>
                    <div class="row d-flex align-items-center">
                        <div class="col s6">
                            <h3 class="font-light m-t-10"><sup><small><i class="ti-arrow-up"></i></small></sup>35487</h3>
                        </div>
                        <div class="col s6 right-align">
                            <div class="p-t-10 p-b-10">
                                <div class="spark-count" style="height:65px"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-hover">
                <div class="card-content">
                    <div class="d-flex align-items-center">
                        <div class="m-r-20">
                            <h1 class=""><i class="ti-pie-chart"></i></h1></div>
                        <div>
                            <h3 class="card-title">Bandwidth usage</h3>
                            <h6 class="card-subtitle">March  2017</h6>
                        </div>
                    </div>
                    <div class="row d-flex align-items-center">
                        <div class="col s6">
                            <h3 class="font-light m-t-10">50 GB</h3>
                        </div>
                        <div class="col s6 p-t-10 p-b-20 right-align">
                            <div class="p-t-10 p-b-10 m-r-20">
                                <div class="spark-count2" style="height:65px"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    </div>

    <!-- ============================================================== -->
    <!-- Sales -->
    <!-- ============================================================== -->

    <!-- ============================================================== -->
    <!-- product sales anf active users -->
    <!-- ============================================================== -->
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
                          <?php echo form_open_multipart('kaban');?>
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
                        <!-- <table class="">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Rumah Layanan</th>
                                    <th>Target</th>
                                    <th>Terkontrak</th>
                                    <th>Invoice</th>
                                    <th>Realisasi</th>
                                    <th>Pengeluaran</th>
                                    <th>Surplus</th>
                                    <th>Piutang</th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php $no=1; $tahun = DATE('Y'); foreach ($pelaksana_layanan as $a) { ?>
                                <?php $terkontrak = $this->db->query("SELECT SUM(nilai_kontrak) AS jumlah FROM kontrak WHERE id_rumah_layanan = $a->id_rumah_layanan AND YEAR(tgl_mulai) = $tahun")->row(); ?>
                                <?php $invoice = $this->db->query("SELECT SUM(t.jumlah) AS jumlah FROM termin AS t INNER JOIN kontrak AS k ON t.id_kontrak = k.id_kontrak WHERE k.id_rumah_layanan = $a->id_rumah_layanan AND YEAR(tgl_termin) = $tahun")->row(); ?>
                                <?php $realisasi = $this->db->query("SELECT SUM(t.jumlah) AS jumlah FROM termin AS t INNER JOIN kontrak AS k ON t.id_kontrak = k.id_kontrak WHERE k.id_rumah_layanan = $a->id_rumah_layanan AND YEAR(tgl_termin) = $tahun AND t.status_pembayaran = 1")->row(); ?>
                                <?php $pengeluaran = $this->db->query("SELECT SUM(p.jumlah_realisasi) AS jumlah FROM pengajuan AS p INNER JOIN rencana_operasional AS ro ON p.id_ro = ro.id_ro INNER JOIN kontrak AS k ON ro.id_kontrak = k.id_kontrak WHERE k.id_rumah_layanan = $a->id_rumah_layanan AND p.status_realisasi = 1")->row(); ?>
                                <tr>
                                    <td>
                                        <?php echo $no; ?>
                                    </td>
                                    <td class="blue-grey-text text-darken-4 font-medium"><?php echo $a->nama; ?></td>
                                    <td class="blue-grey-text text-darken-4 font-medium">?</td>
                                    <td class="blue-grey-text text-darken-4 font-medium"><?php if ($terkontrak->jumlah == NULL) { echo "-"; } else { echo $terkontrak->jumlah; }?></td>
                                    <td class="blue-grey-text text-darken-4 font-medium"><?php if ($invoice->jumlah == NULL) { echo "-"; } else { echo $invoice->jumlah; }?></td>
                                    <td class="orange-text text-darken-4 font-medium"><?php if ($realisasi->jumlah == NULL) { echo "-"; } else { echo $realisasi->jumlah; }?></td>
                                    <td class="blue-grey-text  text-darken-4 font-medium"><?php if ($pengeluaran->jumlah == NULL) { echo "-"; } else { echo $pengeluaran->jumlah; }?></td>
                                    <td class="green-text"><?php echo $surplus = $realisasi->jumlah - $pengeluaran->jumlah; ?></td>
                                    <td class="blue-grey-text  text-darken-4 font-medium"><?php echo $piutang = $terkontrak->jumlah - $invoice->jumlah; ?></td>
                                </tr>
                              <?php $no=$no+1; } ?>
                            </tbody>
                        </table> -->
                        <table class="">
                            <thead>
                                <tr>
                                    <th style="text-align:center">No</th>
                                    <th style="text-align:center">Satker</th>
                                    <th style="text-align:center">Target</th>
                                    <th style="text-align:center">Terkontrak</th>
                                    <th style="text-align:center">Invoice</th>
                                    <th style="text-align:center">Realisasi Penerimaan</th>
                                    <th style="text-align:center">Realisasi Biaya</th>
                                    <th style="text-align:center">Surplus</th>
                                    <th style="text-align:center">Piutang</th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php $total_target = 0;$total_terkontrak=0;$total_invoice=0;$total_realisasi=0;$total_pengeluaran=0;$total_hasil_realisasi=0;$total_piutang=0;?>
                              <?php $no=1; $tahun = DATE('Y'); foreach ($satker as $a) { ?>
                                <?php $target = $this->db->query("SELECT SUM(t.jumlah) AS jumlah FROM target AS t INNER JOIN rumah_layanan AS rl ON t.id_rumah_layanan=rl.id_rumah_layanan WHERE rl.id_satker = $a->id_satker AND t.tahun = $pilih_tahun")->row(); ?>
                                
				<?php //$terkontrak = $this->db->query("SELECT SUM(nilai_kontrak) AS jumlah FROM kontrak WHERE id_satker = $a->id_satker AND YEAR(tgl_akhir) = $pilih_tahun")->row(); ?>							
                                <?php $terkontrak = $this->db->query("SELECT SUM(t.jumlah) AS jumlah FROM termin AS t INNER JOIN kontrak AS k ON t.id_kontrak = k.id_kontrak INNER JOIN perusahaan AS p ON k.id_perusahaan = p.id_perusahaan WHERE (k.id_satker = $a->id_satker AND YEAR(t.tgl_termin) = $pilih_tahun) OR (k.id_satker = $a->id_satker AND YEAR(t.tgl_pembayaran) = $pilih_tahun) OR (k.id_satker = $a->id_satker AND t.status_pembayaran = 0)")->row(); ?>
                                <?php $invoice = $this->db->query("SELECT SUM(t.jumlah) AS jumlah FROM termin AS t INNER JOIN kontrak AS k ON t.id_kontrak = k.id_kontrak INNER JOIN perusahaan AS p ON k.id_perusahaan = p.id_perusahaan WHERE k.id_satker = $a->id_satker AND YEAR(t.tgl_invoice) = $pilih_tahun AND t.status_cetak_invoice=1")->row(); ?>
                                <?php $piutang = $this->db->query("SELECT SUM(t.jumlah) AS jumlah FROM termin AS t INNER JOIN kontrak AS k ON t.id_kontrak = k.id_kontrak INNER JOIN perusahaan AS p ON k.id_perusahaan = p.id_perusahaan WHERE k.id_satker = $a->id_satker AND YEAR(t.tgl_invoice) = $pilih_tahun AND t.status_cetak_invoice=1 AND t.status_pembayaran=0")->row(); ?>
                                <?php $realisasi = $this->db->query("SELECT SUM(t.jumlah_realisasi) AS jumlah FROM termin AS t INNER JOIN kontrak AS k ON t.id_kontrak = k.id_kontrak WHERE k.id_satker = $a->id_satker AND YEAR(t.tgl_pembayaran) = $pilih_tahun AND t.status_pembayaran = 1")->row(); ?>
                                <?php $hasil_realisasi = $this->db->query("SELECT SUM(t.jumlah_realisasi) AS jumlah FROM termin AS t INNER JOIN kontrak AS k ON t.id_kontrak = k.id_kontrak WHERE k.id_satker = $a->id_satker AND YEAR(t.tgl_pembayaran) < $pilih_tahun AND t.status_pembayaran=1")->row();?>
                                <?php $pengeluaran_satker = $this->db->query("SELECT SUM(p.jumlah_realisasi) AS jumlah FROM pengajuan AS p INNER JOIN rencana_operasional AS ro ON p.id_ro = ro.id_ro INNER JOIN kontrak AS k ON ro.id_kontrak = k.id_kontrak WHERE k.id_satker = $a->id_satker AND p.status_realisasi = 1 AND YEAR(p.tgl_pengajuan)=$pilih_tahun")->row(); ?>
                                <?php $pengeluaran_satker_rkakl = $this->db->query("SELECT SUM(p.jumlah_realisasi) AS jumlah FROM pengajuan_rkakl AS p INNER JOIN detail_rkakl AS dr ON p.id_detail_rkakl = dr.id INNER JOIN rkakl AS r ON dr.id_rkakl = r.id_rkakl INNER JOIN rumah_layanan AS rl ON r.id_layanan = rl.id_rumah_layanan WHERE rl.id_satker = $a->id_satker AND p.status_realisasi = 1 AND YEAR(p.tgl_pengajuan) = $pilih_tahun")->row(); ?>
                                <tr>
                                    <td style="text-align:center">
                                        <?php echo $no; ?>
                                    </td>
                                    <td class="blue-grey-text text-darken-4 font-medium" ><?php echo $a->nama_satker; ?></td>
                                    <td class="blue-grey-text text-darken-4 font-medium" style="text-align:right"><?php echo number_format($target->jumlah,0,'','.' ); ?></td>
                                    <td class="blue-grey-text text-darken-4 font-medium" style="text-align:right"><a href="<?php echo base_url(); ?>kaban/detail_kontrak/<?php echo $a->id_satker; ?>/<?php echo $pilih_tahun;?>"><?php if ($terkontrak->jumlah == NULL) { echo "-"; } else { echo number_format($terkontrak->jumlah,0,'','.' ); }?></a></td>
                                    <td class="blue-grey-text text-darken-4 font-medium" style="text-align:right"><a href="<?php echo base_url(); ?>kaban/detail_invoice/<?php echo $a->id_satker; ?>/<?php echo $pilih_tahun;?>"><?php if ($invoice->jumlah == NULL) { echo "-"; } else { echo number_format($invoice->jumlah,0,'','.' ); }?></a></td>
                                    <td class="orange-text text-darken-4 font-medium" style="text-align:right"><a href="<?php echo base_url(); ?>kaban/detail_realisasi/<?php echo $a->id_satker; ?>/<?php echo $pilih_tahun;?>"><?php if ($realisasi->jumlah == NULL) { echo "-"; } else { echo number_format($realisasi->jumlah,0,'','.' ); }?></a></td>
                                    <td class="blue-grey-text  text-darken-4 font-medium" style="text-align:right"><a href="<?php echo base_url(); ?>kaban/detail_pengeluaran/<?php echo $a->id_satker; ?>/<?php echo $pilih_tahun;?>"><?php if ($pengeluaran_satker->jumlah + $pengeluaran_satker_rkakl->jumlah == NULL) { echo "-"; } else { echo number_format($pengeluaran_satker->jumlah + $pengeluaran_satker_rkakl->jumlah,0,'','.' ); }?></a></td>
                                    <td class="green-text" style="text-align:right"><?php $surplus = $realisasi->jumlah - $pengeluaran_satker->jumlah - $pengeluaran_satker_rkakl->jumlah; echo number_format($surplus,0,'','.' ); ?></td>
                                    <td class="blue-grey-text  text-darken-4 font-medium" style="text-align:right"><?php if ($piutang->jumlah == NULL) { echo "-"; } else { echo number_format($piutang->jumlah,0,'','.' ); }?></td>
                                </tr>
                              <?php
                              $total_target = $total_target + $target->jumlah;
                              $total_terkontrak=$total_terkontrak + $terkontrak->jumlah;
                              $total_invoice=$total_invoice + $invoice->jumlah;
                              $total_piutang=$total_piutang + $piutang->jumlah;
                              $total_realisasi=$total_realisasi + $realisasi->jumlah;
                              $total_hasil_realisasi=$total_hasil_realisasi + $hasil_realisasi->jumlah;
                              $total_pengeluaran=$total_pengeluaran + $pengeluaran_satker->jumlah + $pengeluaran_satker_rkakl->jumlah;
                              $no=$no+1; }
                              ?>
                              <tr>
                                  <td>
                                      <?php echo $no; ?>
                                  </td>
                                  <td class="blue-grey-text text-darken-4 font-medium">LEMIGAS</td>
                                  <td class="blue-grey-text text-darken-4 font-medium" style="text-align:right"><?php if ($lemigas_total_target == NULL) { echo "-"; } else { echo number_format($lemigas_total_target,0,'','.' ); }?></td>
                                  <td class="blue-grey-text text-darken-4 font-medium" style="text-align:right"><a href="<?php echo base_url(); ?>kaban/detail_lemigas_kontrak/<?php echo $pilih_tahun;?>"><?php if ($lemigas_total_kontrak == NULL) { echo "-"; } else { echo number_format($lemigas_total_kontrak,0,'','.' ); }?></a></td>
                                  <td class="blue-grey-text text-darken-4 font-medium" style="text-align:right"><a href="<?php echo base_url(); ?>kaban/detail_lemigas_invoice/<?php echo $pilih_tahun;?>"><?php if ($lemigas_total_invoice == NULL) { echo "-"; } else { echo number_format($lemigas_total_invoice,0,'','.' ); }?></a></td>
                                  <td class="orange-text text-darken-4 font-medium" style="text-align:right"><a href="<?php echo base_url(); ?>kaban/detail_lemigas_realisasi/<?php echo $pilih_tahun;?>"><?php if ($lemigas_total_realisasi == NULL) { echo "-"; } else { echo number_format($lemigas_total_realisasi,0,'','.' ); }?></a></td>
                                  <td class="blue-grey-text  text-darken-4 font-medium" style="text-align:right"><a href="<?php echo base_url(); ?>kaban/detail_lemigas_pengeluaran/<?php echo $pilih_tahun;?>"><?php if ($lemigas_total_ro == NULL) { echo "-"; } else { echo number_format($lemigas_total_ro,0,'','.' ); }?></a></td>
                                  <td class="green-text" style="text-align:right"><?php $surplus = $lemigas_total_realisasi-$lemigas_total_ro; if ($surplus == NULL) { echo "-"; } else { echo number_format($surplus,0,'','.' ); }?></td>
                                  <!-- <td class="blue-grey-text  text-darken-4 font-medium" style="text-align:right"><?php $piutang = ($lemigas_total_invoice + $lemigas_total_realisasi)-$lemigas_total_realisasi; if ($piutang == NULL) { echo "-"; } else { echo number_format($piutang,0,'','.' ); }?></td> -->
                                  <td class="blue-grey-text  text-darken-4 font-medium" style="text-align:right"><?php if ($lemigas_total_piutang == NULL) { echo "-"; } else { echo number_format($lemigas_total_piutang,0,'','.' ); }?></td>
                              </tr>
                              <tr>
                                  <td colspan="2">
                                      TOTAL
                                  </td>
                                  <td class="blue-grey-text text-darken-4 font-medium" style="text-align:right"><?php if ($total_target + $lemigas_total_target == NULL) { echo "-"; } else { echo number_format($total_target+ $lemigas_total_target ,0,'','.' ); }?></td>
                                  <td class="blue-grey-text text-darken-4 font-medium" style="text-align:right"><?php if ($total_terkontrak + $lemigas_total_kontrak == NULL) { echo "-"; } else { echo number_format($total_terkontrak + $lemigas_total_kontrak,0,'','.' ); }?></td>
                                  <td class="blue-grey-text text-darken-4 font-medium" style="text-align:right"><?php if ($total_invoice + $lemigas_total_invoice == NULL) { echo "-"; } else { echo number_format($total_invoice + $lemigas_total_invoice,0,'','.' ); }?></td>
                                  <td class="orange-text text-darken-4 font-medium" style="text-align:right"><?php if ($total_realisasi + $lemigas_total_realisasi == NULL) { echo "-"; } else { echo number_format($total_realisasi + $lemigas_total_realisasi,0,'','.' ); }?></td>
                                  <td class="blue-grey-text  text-darken-4 font-medium" style="text-align:right"><?php if ($total_pengeluaran + $lemigas_total_ro == NULL) { echo "-"; } else { echo number_format($total_pengeluaran + $lemigas_total_ro,0,'','.' ); }?></td>
                                  <td class="green-text" style="text-align:right"><?php $surplus = ($total_realisasi + + $lemigas_total_realisasi ) - ($total_pengeluaran  + $lemigas_total_ro); echo number_format($surplus,0,'','.' ); ?></td>
                                  <!-- <td class="blue-grey-text  text-darken-4 font-medium" style="text-align:right"><?php $piutang = ($total_invoice + $lemigas_total_invoice + $lemigas_total_realisasi) - ($total_realisasi + $lemigas_total_realisasi); echo number_format($piutang,0,'','.' );?></td> -->
                                  <td class="blue-grey-text  text-darken-4 font-medium" style="text-align:right"><?php $piutang = $total_piutang + $lemigas_total_piutang; echo number_format($piutang,0,'','.' );?></td>
                              </tr>
                            </tbody>
                        </table>
                        <table id="datatablekaban" hidden>
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Realisasi Penerimaan</th>
                                        <th>Pengeluaran</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php foreach ($satker as $a) { ?>
                                    <?php $realisasi = $this->db->query("SELECT SUM(t.jumlah) AS jumlah FROM termin AS t INNER JOIN kontrak AS k ON t.id_kontrak = k.id_kontrak WHERE k.id_satker = $a->id_satker AND YEAR(tgl_pembayaran) = $pilih_tahun AND t.status_pembayaran = 1")->row(); ?>
                                    <?php $pengeluaran_satker = $this->db->query("SELECT SUM(p.jumlah_realisasi) AS jumlah FROM pengajuan AS p INNER JOIN rencana_operasional AS ro ON p.id_ro = ro.id_ro INNER JOIN kontrak AS k ON ro.id_kontrak = k.id_kontrak WHERE k.id_satker = $a->id_satker AND p.status_realisasi = 1 AND YEAR(p.tgl_pengajuan)=$pilih_tahun")->row(); ?>
                                    <?php $pengeluaran_satker_rkakl = $this->db->query("SELECT SUM(p.jumlah_realisasi) AS jumlah FROM pengajuan_rkakl AS p INNER JOIN detail_rkakl AS dr ON p.id_detail_rkakl = dr.id INNER JOIN rkakl AS r ON dr.id_rkakl = r.id_rkakl INNER JOIN rumah_layanan AS rl ON r.id_layanan = rl.id_rumah_layanan WHERE rl.id_satker = $a->id_satker AND p.status_realisasi = 1 AND YEAR(p.tgl_pengajuan) = $pilih_tahun")->row(); ?>
                                    <tr>
                                        <th><?php echo $a->nama_satker;?></th>
                                        <td><?php echo $realisasi->jumlah;?></td>
                                        <td><?php echo $pengeluaran_satker->jumlah + $pengeluaran_satker_rkakl->jumlah;?></td>
                                    </tr>
                                  <?php } ?>
                                  <tr>
                                      <th>Lemigas</th>
                                      <td><?php echo $lemigas_total_realisasi;?></td>
                                      <td><?php echo $lemigas_total_ro;?></td>
                                  </tr>
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
