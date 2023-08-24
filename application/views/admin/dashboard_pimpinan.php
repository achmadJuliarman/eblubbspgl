<?php $total_pengeluaran = $result_pengeluaran->jumlah + $result_pengeluaran_rkakl->jumlah; ?>
<?php $total_target = 0;$total_terkontrak=0;$total_invoice=0;$total_realisasi=0;$total_pengeluaran=0;$total_hasil_realisasi=0;$total_piutang=0;?>
<?php
  foreach ($pelaksana_layanan as $a)
  {
    $target = $this->db->query("SELECT SUM(jumlah) AS jumlah FROM target WHERE id_rumah_layanan = $a->id_rumah_layanan AND tahun = $pilih_tahun")->row();

    $terkontrak = $this->db->query("SELECT SUM(t.jumlah) AS jumlah FROM termin AS t INNER JOIN kontrak AS k ON t.id_kontrak = k.id_kontrak 
        INNER JOIN perusahaan AS p ON k.id_perusahaan = p.id_perusahaan 
        WHERE (k.id_rumah_layanan = $a->id_rumah_layanan AND YEAR(t.tgl_termin) = $pilih_tahun) OR 
        (k.id_rumah_layanan = $a->id_rumah_layanan AND YEAR(t.tgl_pembayaran) > 0 AND YEAR(t.tgl_pembayaran) < $pilih_tahun AND 
        t.status_pembayaran = 0)")->row();

    $invoice = $this->db->query("SELECT SUM(t.jumlah) AS jumlah FROM termin AS t INNER JOIN kontrak AS k ON 
        t.id_kontrak = k.id_kontrak INNER JOIN perusahaan AS p ON k.id_perusahaan = p.id_perusahaan 
        WHERE k.id_rumah_layanan = $a->id_rumah_layanan AND YEAR(t.tgl_invoice) = $pilih_tahun AND t.status_cetak_invoice=1")->row();

    $realisasi = $this->db->query("SELECT SUM(t.jumlah_realisasi) AS jumlah FROM termin AS t 
        INNER JOIN kontrak AS k ON t.id_kontrak = k.id_kontrak 
        WHERE k.id_rumah_layanan = $a->id_rumah_layanan AND YEAR(t.tgl_pembayaran) = $pilih_tahun AND t.status_pembayaran=1")->row();

    $piutang = $this->db->query("SELECT SUM(t.jumlah) AS jumlah FROM termin AS t 
        INNER JOIN kontrak AS k ON t.id_kontrak = k.id_kontrak INNER JOIN perusahaan AS p ON k.id_perusahaan = p.id_perusahaan 
        WHERE k.id_rumah_layanan = $a->id_rumah_layanan AND YEAR(t.tgl_invoice) <= $pilih_tahun AND t.status_cetak_invoice=1 AND t.status_pembayaran=0")->row();

    $pengeluaran = $this->db->query("SELECT SUM(p.jumlah_realisasi) AS jumlah FROM pengajuan AS p 
        INNER JOIN rencana_operasional AS ro ON p.id_ro = ro.id_ro INNER JOIN kontrak AS k ON ro.id_kontrak = k.id_kontrak 
        WHERE k.id_rumah_layanan = $a->id_rumah_layanan AND p.status_realisasi = 1 AND YEAR(p.tgl_pengajuan) = $pilih_tahun")->row();

    $pengeluaran_rkakl = $this->db->query("SELECT SUM(p.jumlah_realisasi) AS jumlah FROM pengajuan_rkakl AS p 
        INNER JOIN detail_rkakl AS dr ON p.id_detail_rkakl = dr.id INNER JOIN rkakl AS r ON dr.id_rkakl = r.id_rkakl 
        INNER JOIN rumah_layanan AS rl ON r.id_layanan = rl.id_rumah_layanan 
        WHERE r.id_layanan = $a->id_rumah_layanan AND p.status_realisasi = 1 AND YEAR(p.tgl_realisasi) = $pilih_tahun")->row();

    $sub_pengeluaran = $pengeluaran->jumlah + $pengeluaran_rkakl->jumlah;

    $targetArr[$a->id_rumah_layanan] = $target->jumlah;
    $terkontrakArr[$a->id_rumah_layanan] = $terkontrak->jumlah;
    $realisasiArr[$a->id_rumah_layanan] = $realisasi->jumlah;
    $invoiceArr[$a->id_rumah_layanan] = $invoice->jumlah;
    $piutangArr[$a->id_rumah_layanan] = $piutang->jumlah;
    $sub_pengeluaranArr[$a->id_rumah_layanan] = $sub_pengeluaran;


    $total_target = $total_target + $target->jumlah;
    $total_terkontrak = $total_terkontrak + $terkontrak->jumlah;
    $total_invoice = $total_invoice + $invoice->jumlah;
    $total_piutang = $total_piutang + $piutang->jumlah;
    $total_realisasi = $total_realisasi + $realisasi->jumlah;
    $total_pengeluaran = $total_pengeluaran + $sub_pengeluaran;
    $surplus = $total_realisasi - $total_pengeluaran;
  }

?>

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
                            <h4 class="white-text m-b-5"><?php echo "Rp. ".number_format($total_target,0,'','.' ).",-"; ?></h4>
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
                            <h4 class="white-text m-b-5"><?php echo "Rp. ".number_format($total_terkontrak,0,'','.' ).",-"; ?></h4>
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
                            <h4 class="white-text m-b-5"><?php echo "Rp. ".number_format($total_invoice,0,'','.' ).",-"; ?></h4>
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
                            <h4 class="white-text m-b-5"><?php echo "Rp. ".number_format($total_realisasi,0,'','.' ).",-"; ?></h4>
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
                            <h4 class="white-text m-b-5"><?php echo "Rp. ".number_format($total_pengeluaran,0,'','.' ).",-"; ?></h4>
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
                            <h4 class="white-text m-b-5"><?php echo "Rp. ".number_format($surplus,0,'','.' ).",-"; ?></h4>
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
                  <a href="<?php echo base_url(); ?>pimpinan/detail_piutang_grafik">
                    <div class="d-flex no-block align-items-center">
                        <div>
                            <h4 class="white-text m-b-5"><?php echo "Rp. ".number_format($total_piutang,0,'','.' ).",-"; ?></h4>
                            <h6 class="white-text op-5 text-darken-2">PIUTANG</h6>
                        </div>
                        <div class="ml-auto">
                            <span class="white-text display-6"><i class="material-icons">equalizer</i></span>
                        </div>
                    </div>
                  </a>
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

                    <!-- Sales Summery -->
                    <div class="p-t-20">
                        <div class="row">
                            <div class="col s12">
                              <div id="container" style="height: 450px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                            <h6 class="card-subtitle">Pengelolaan Keuangan BLU</h6>
                        </div>
                        <div class="ml-auto">
                          <?php echo form_open_multipart('pimpinan');?>
                            <div class="input-field dl support-select">
                                <select name="tahun">
                                    <?php $tahun = DATE("Y"); ?>
                                    <option value="" selected>Pilih Tahun</option>
                                    <option value="<?php echo $tahun; ?>"><?php echo $tahun; ?></option>
                                    <option value="<?php echo $tahun-1; ?>"><?php echo $tahun-1; ?></option>
                                    <option value="<?php echo $tahun-2; ?>"><?php echo $tahun-2; ?></option>
                                    <option value="<?php echo $tahun-3; ?>"><?php echo $tahun-3; ?></option>
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
                                    <th>No</th>
                                    <th>Rumah Layanan</th>
                                    <th>Target</th>
                                    <th>Terkontrak</th>
                                    <th>Invoice</th>
                                    <th>Realisasi Pendapatan</th>
                                    <th>Realisasi Belanja</th>
                                    <th>Surplus</th>
                                    <th>Piutang</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                $tahun = DATE('Y');
                                foreach ($pelaksana_layanan as $a) { ?>
                                    <tr>
                                        <td>
                                            <?php echo $no; ?>
                                        </td>
                                        <td class="blue-grey-text text-darken-4 font-medium">
                                            <?php echo $a->nama; ?>
                                        </td>
                                        <td class="blue-grey-text text-darken-4 font-medium">
                                            <?php if ($targetArr[$a->id_rumah_layanan] == NULL) {
                                                echo "-";
                                            } else {
                                                echo "Rp. " . number_format($targetArr[$a->id_rumah_layanan], 0, '', '.') . ",-";
                                            } ?>
                                        </td>
                                        <td class="blue-grey-text text-darken-4 font-medium">
                                            <a href="<?php echo base_url(); ?>pimpinan/detail_kontrak/<?php echo $a->id_rumah_layanan; ?>/<?php echo $pilih_tahun; ?>">
                                                <?php if ($terkontrakArr[$a->id_rumah_layanan] == NULL) {
                                                    echo "-";
                                                } else {
                                                    echo "Rp. " . number_format($terkontrakArr[$a->id_rumah_layanan], 0, '', '.') . ",-";
                                                } ?>
                                            </a>
                                        </td>
                                        <td class="blue-grey-text text-darken-4 font-medium">
                                            <a href="<?php echo base_url(); ?>pimpinan/detail_invoice/<?php echo $a->id_rumah_layanan; ?>/<?php echo $pilih_tahun; ?>">
                                                <?php if ($invoiceArr[$a->id_rumah_layanan] == NULL) {
                                                    echo "-";
                                                } else {
                                                    echo "Rp. " . number_format($invoiceArr[$a->id_rumah_layanan], 0, '', '.') . ",-";
                                                } ?>
                                            </a>
                                        </td>
                                        <td class="orange-text text-darken-4 font-medium">
                                            <a href="<?php echo base_url(); ?>pimpinan/detail_realisasi/<?php echo $a->id_rumah_layanan; ?>/<?php echo $pilih_tahun; ?>">
                                                <?php if ($realisasiArr[$a->id_rumah_layanan] == NULL) {
                                                    echo "-";
                                                } else {
                                                    echo "Rp. " . number_format($realisasiArr[$a->id_rumah_layanan], 0, '', '.') . ",-";
                                                } ?>
                                            </a>
                                        </td>
                                        <td class="blue-grey-text  text-darken-4 font-medium">
                                            <a href="<?php echo base_url(); ?>pimpinan/detail_pengeluaran/<?php echo $a->id_rumah_layanan; ?>/<?php echo $pilih_tahun; ?>">
                                                <?php if ($sub_pengeluaranArr[$a->id_rumah_layanan] == NULL) {
                                                    echo "-";
                                                } else {
                                                    echo "Rp. " . number_format($sub_pengeluaranArr[$a->id_rumah_layanan], 0, '', '.') . ",-";
                                                } ?>
                                            </a>
                                        </td>
                                        <td class="green-text">
                                            <?php $surplus = $realisasiArr[$a->id_rumah_layanan] - $sub_pengeluaranArr[$a->id_rumah_layanan];
                                            echo "Rp. " . number_format($surplus, 0, '', '.') . ",-"; ?>
                                        </td>
                                        <td class="blue-grey-text  text-darken-4 font-medium">
                                            <a href="<?php echo base_url(); ?>pimpinan/detail_piutang/<?php echo $a->id_rumah_layanan; ?>/<?php echo $pilih_tahun; ?>">
                                                <?php echo "Rp. " . number_format($piutangArr[$a->id_rumah_layanan], 0, '', '.') . ",-"; ?>
                                            </a>
                                        </td>
                                    </tr>
                                <?php
                                    $no = $no + 1;
                                }
                                ?>
                                <tr>
                                    <td colspan="2">
                                        TOTAL
                                    </td>
                                    <td class="blue-grey-text text-darken-4 font-medium">
                                        <?php echo "Rp. " . number_format($total_target, 0, '', '.') . ",-"; ?>
                                    </td>
                                    <td class="blue-grey-text text-darken-4 font-medium">
                                        <?php if ($total_terkontrak == NULL) {
                                            echo "-";
                                        } else {
                                            echo "Rp. " . number_format($total_terkontrak, 0, '', '.') . ",-";
                                        } ?>
                                    </td>
                                    <td class="blue-grey-text text-darken-4 font-medium">
                                        <?php if ($total_invoice == NULL) {
                                            echo "-";
                                        } else {
                                            echo "Rp. " . number_format($total_invoice, 0, '', '.') . ",-";
                                        } ?>
                                    </td>
                                    <td class="orange-text text-darken-4 font-medium">
                                        <?php if ($total_realisasi == NULL) {
                                            echo "-";
                                        } else {
                                            echo "Rp. " . number_format($total_realisasi, 0, '', '.') . ",-";
                                        } ?>
                                    </td>
                                    <td class="blue-grey-text  text-darken-4 font-medium">
                                        <?php if ($total_pengeluaran == NULL) {
                                            echo "-";
                                        } else {
                                            echo "Rp. " . number_format($total_pengeluaran, 0, '', '.') . ",-";
                                        } ?>
                                    </td>
                                    <td class="green-text">
                                        <?php $surplus = $total_realisasi - $total_pengeluaran;
                                        echo "Rp. " . number_format($surplus, 0, '', '.') . ",-"; ?>
                                    </td>
                                    <td class="blue-grey-text  text-darken-4 font-medium">
                                        <?php echo "Rp. " . number_format($total_piutang, 0, '', '.') . ",-"; ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table id="datatable" hidden>
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Target blu</th>
                                        <th>Pendapatan</th>
                                        <th>Pengeluaran</th>
                                        <th>Saldo Blu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php foreach ($pelaksana_layanan as $a) { ?>
                                    <?php $target = $this->db->query("SELECT SUM(jumlah) AS jumlah FROM target WHERE id_rumah_layanan = $a->id_rumah_layanan AND tahun = $pilih_tahun")->row();?>
                                    <?php $realisasi = $this->db->query("SELECT SUM(t.jumlah_realisasi) AS jumlah FROM termin AS t INNER JOIN kontrak AS k ON t.id_kontrak = k.id_kontrak WHERE k.id_rumah_layanan = $a->id_rumah_layanan AND YEAR(t.tgl_pembayaran) = $pilih_tahun AND t.status_pembayaran=1")->row();?>
                                    <?php $pengeluaran = $this->db->query("SELECT SUM(p.jumlah_realisasi) AS jumlah FROM pengajuan AS p INNER JOIN rencana_operasional AS ro ON p.id_ro = ro.id_ro INNER JOIN kontrak AS k ON ro.id_kontrak = k.id_kontrak WHERE k.id_rumah_layanan = $a->id_rumah_layanan AND p.status_realisasi = 1 AND YEAR(p.tgl_pengajuan) = $pilih_tahun")->row(); ?>
                                    <?php $pengeluaran_rkakl = $this->db->query("SELECT SUM(p.jumlah_realisasi) AS jumlah FROM pengajuan_rkakl AS p INNER JOIN detail_rkakl AS dr ON p.id_detail_rkakl = dr.id INNER JOIN rkakl AS r ON dr.id_rkakl = r.id_rkakl INNER JOIN rumah_layanan AS rl ON r.id_layanan = rl.id_rumah_layanan WHERE r.id_layanan = '$a->id_rumah_layanan' AND p.status_realisasi = 1 AND YEAR(p.tgl_pengajuan) = $pilih_tahun")->row(); ?>
                                    <tr>
                                        <th><?php echo $a->nama;?></th>
                                        <td><?php echo $target->jumlah;?></td>
                                        <td><?php echo $realisasi->jumlah;?></td>
                                        <td><?php echo $pengeluaran->jumlah;?></td>
                                        <td><?php echo  $surplus = $total_realisasi - $total_pengeluaran;?></td>
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
