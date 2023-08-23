<div id="main">
      <div class="row">
        <div class="col s12">
            <div class="container">
                <div class="section section-data-tables">
                  <div class="card">
                      <div class="card-content">
                          <!-- <h4 class="card-title">Daftar Kontrak</h4> -->
                          <div class="row">
                              <div class="col s12">
                                <table id="example" class="display table table-bordered" cellspacing="0" width="100%">
                                      <thead>
                                          <tr>
                                            <th style="text-align:center;" width="5%">No.</th>
                                            <th style="text-align:center;" width="40%">Judul kontrak</th>
                                            <th style="text-align:center;" width="10%">Tgl Mulai</th>
                                            <th style="text-align:center;" width="10%">Tgl Selesai</th>
                                            <th style="text-align:center;" width="15%">Status</th>
                                            <th style="text-align:center;" width="10%">Action</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                        <?php $no=1; foreach($result AS $a) { ?>
                                          <tr>
                                            <td style="text-align:center;"><?php echo $no; ?></td>
                                            <td>
                                              <b><?= $a->nama_kontrak ?></b><br/>
                                              <span class="badge gradient-45deg-light-blue-cyan" style="font-size: 11px;"><?php echo $a->no_kontrak; ?></strong> (Tanggal : <?php echo $a->tgl_ttd; ?>)</span> <br>
                                              <span class="badge orange" style="font-size: 11px;"><?php echo $a->nama_perusahaan; ?></span>
                                              <span class="badge red" style="font-size: 11px;"><?php echo "Rp.".number_format($a->nilai_kontrak).",-"; ?></span>
                                            </td>
                                            <td><?php echo $a->tgl_mulai; ?></td>
                                            <td><?php echo $a->tgl_akhir; ?></td>
                                            <td style="font-size: 11px;text-align:center;">
                                            <?php if($a->status_ro == 0) { ?>
                                              <span class="badge red" style="font-size: 11px;"><?php echo "Belum di Approve"; ?></strong></span>
                                            <?php } elseif($a->status_ro == 1) { ?>
                                              <span class="badge orange" style="font-size: 11px;"><?php echo "Pengajuan ditolak"; ?></strong></span>
                                            <?php } elseif($a->status_ro == 2) { ?>
                                              <span class="badge green" style="font-size: 11px;"><?php echo "Approved"; ?></strong></span>
                                            <?php } ?>
                                            </td>
                                            <td style="font-size: 12px;text-align:center;">
                                              <a href="#modalro<?php echo $a->id_kontrak; ?>" class="btn-floating blue tooltipped modal-trigger" data-position="top" data-tooltip="Preview"><i class="material-icons right">remove_red_eye</i></a>
                                            </td>
                                          </tr>
                                        <?php $no=$no+1; } ?>
                                      </tbody>
                                  </table>
                              </div>
                          </div>
                      </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php foreach ($result as $b) { ?>
<div id="modalro<?php echo $b->id_kontrak; ?>" class="modal">
  <div class="modal-content">
    <h4>Data Rencana Termin Pembayaran</h4>
    <div class="row">
      <table class="table table-striped table-dashboard-two mg-b-0" width="100%">
        <thead>
          <tr>
            <th>Termin</th>
            <th>Rencana Pembayaran</th>
            <th>Jumlah</th>
          </tr>
        </thead>
        <?php $termin = $this->db->query("SELECT * FROM termin WHERE id_kontrak = $b->id_kontrak")->result(); ?>
        <?php $jumlah_termin = $this->db->query("SELECT * FROM termin WHERE id_kontrak = $b->id_kontrak")->num_rows(); ?>
        <tbody>
          <?php if ($jumlah_termin == 0) { ?>
            <tr>
              <td colspan="3">Belum ada Termin Pembayaran</td>
            </tr>
          <?php } else { ?>
          <?php foreach ($termin as $t) { ?>
            <tr>
              <td>Termin <?php echo $t->termin;?></td>
              <td><?php echo $t->tgl_termin;?></td>
              <td><?php echo "Rp. ".number_format($t->jumlah,0,'','.' ).",-"; ?></td>
            </tr>
          <?php } } ?>
      </tbody>
      </table>
      </div>
      <br>
      <h4>Data Rencana Operasional</h4>
          <div class="row">
            <table class="table table-striped table-dashboard-two mg-b-0" width="100%">
              <thead>
                <tr>
                  <th width="30%">Kode Akun</th>
                  <th width="15%">Pagu</th>
                  <th width="15%">Pengajuan</th>
                  <th width="15%">Realisasi</th>
                  <th width="15%">Saldo</th>
                </tr>
              </thead>
              <?php $ro = $this->db->query("SELECT ro.id_ro,ro.id_kontrak,ro.keterangan,SUM(ro.biaya) AS pagu,a.kode,a.nama_akun FROM rencana_operasional AS ro INNER JOIN akun AS a ON ro.akun = a.id_akun WHERE ro.id_kontrak = $b->id_kontrak GROUP BY ro.akun")->result(); ?>
              <?php $jumlah_ro = $this->db->query("SELECT ro.id_ro,ro.id_kontrak,ro.keterangan,SUM(ro.biaya) AS pengajuan,SUM(ro.realisasi) AS realisasi,a.kode,a.nama_akun,SUM(ro.biaya) AS jumlah FROM rencana_operasional AS ro INNER JOIN akun AS a ON ro.akun = a.id_akun WHERE ro.id_kontrak = $b->id_kontrak GROUP BY ro.akun")->num_rows(); ?>
              <tbody>
                <?php if ($jumlah_ro == 0) { ?>
                  <tr>
                    <td colspan="5">Belum ada Rencana Operasional</td>
                  </tr>
                <?php } else { ?>
                <?php $total=0;$total_p=0;$total_r=0;$total_s=0; foreach ($ro as $c) { ?>
                  <?php $pengajuan = $this->db->query("SELECT SUM(jumlah) AS pengajuan,SUM(jumlah_realisasi) AS realisasi FROM pengajuan WHERE id_ro = $c->id_ro")->row(); ?>
                  <tr>
                    <td><?php echo $c->kode." ".$c->nama_akun;?></td>
                    <td><?php echo "Rp. ".number_format($c->pagu,0,'','.' ).",-"; ?></td>
                    <td><?php echo "Rp. ".number_format($pengajuan->pengajuan,0,'','.' ).",-"; ?></td>
                    <td><?php echo "Rp. ".number_format($pengajuan->realisasi,0,'','.' ).",-"; ?></td>
                    <?php $saldo = $c->pagu - $pengajuan->realisasi;?>
                    <td><?php echo "Rp. ".number_format($saldo,0,'','.' ).",-"; ?></td>
                  </tr>
                  <?php $total=$total+$c->pagu;$total_p=$total_p+$pengajuan->pengajuan;$total_r=$total_r+$pengajuan->realisasi;$total_s=$total_s+$saldo; } ?>
                  <tr>
                    <th>
                      <strong>TOTAL</strong>
                    </th>
                    <th class="tx-medium"><strong><?= 'Rp. '.number_format($total).',-' ?></strong></th>
                    <th class="tx-medium tx-danger"><strong><?= 'Rp. '.number_format($total_p).',-' ?></strong></th>
                    <th class="tx-medium tx-success"><strong><?= 'Rp. '.number_format($total_r).',-' ?></strong></th>
                    <th class="tx-medium tx-warning"><strong><?= 'Rp. '.number_format($total_s).',-' ?></strong></th>
                  </tr>
                  <tr>
                    <td colspan="5">
                      <?php $persen = $total/$b->nilai_kontrak*100; ?>
                      <?php
                      if ($persen < 30)
                      {
                        $label = "blue";
                      }
                      elseif ($persen >= 30 && $persen <= 50)
                      {
                        $label = "green";
                      }
                      elseif ($persen > 50 && $persen <= 70)
                      {
                        $label = "orange";
                      }
                      elseif ($persen > 70)
                      {
                        $label = "red";
                      }
                      ?>
                      *Biaya Operasional sebesar : <span class="badge <?php echo $label; ?>"><?= 'Rp. '.number_format($total).',-'." ( ".round($persen,2)." %) ";?> </span>&nbsp; dari nilai Kontrak : <span class="badge <?php echo $label; ?>"> <?= 'Rp. '.number_format($b->nilai_kontrak).',-';?> </span>
                    </td>
                  </tr>
                  <?php if ($b->status_ro == 0) { ?>
                  <tr>
                    <td colspan="5">
                      <a href="<?php echo base_url();?>pejabat_keuangan/approve/<?php echo $b->id_kontrak;?>/2" class="btn green btn-outline" onclick="javascript: return confirm('Yakin akan approve data ?')"><i class="fas fa-check"></i> Approve</a>
                      <a href="<?php echo base_url();?>pejabat_keuangan/approve/<?php echo $b->id_kontrak;?>/1" class="btn red btn-outline" onclick="javascript: return confirm('Yakin akan menolak data ?')"><i class="fas fa-times-circle"></i> Tolak</a>
                    </td>
                  </tr>
                <?php } ?>
                <?php } ?>
            </tbody>
            </table>
          </div>
          <br>
          <h4>Data Pengajuan Operasional</h4>
          <div class="row">
            <table class="table table-striped table-dashboard-two mg-b-0" width="100%">
              <thead>
                <tr>
                  <th>Kode Akun</th>
                  <th>Nama Kegiatan</th>
                  <th>Tanggal Pengajuan</th>
                  <th>Jumlah</th>
                  <th>Status</th>
                </tr>
              </thead>
              <?php
              $result_pengajuan = $this->db->query("SELECT *,pengajuan.keterangan AS keterangan_pengajuan FROM pengajuan INNER JOIN rencana_operasional ON pengajuan.id_ro = rencana_operasional.id_ro INNER JOIN akun ON rencana_operasional.akun = akun.id_akun INNER JOIN kegiatan ON rencana_operasional.id_kegiatan = kegiatan.id_kegiatan WHERE rencana_operasional.id_kontrak = $b->id_kontrak ORDER BY pengajuan.tgl_pengajuan")->result();
          		$jumlah_pengajuan = $this->db->query("SELECT * FROM pengajuan INNER JOIN rencana_operasional ON pengajuan.id_ro = rencana_operasional.id_ro INNER JOIN akun ON rencana_operasional.akun = akun.id_akun INNER JOIN kegiatan ON rencana_operasional.id_kegiatan = kegiatan.id_kegiatan WHERE rencana_operasional.id_kontrak = $b->id_kontrak")->num_rows();
              ?>
              <tbody>
                <?php if($jumlah_pengajuan == 0) { ?>
                  <tr>
                    <td colspan="5">Belum ada pengajuan</td>
                  </tr>
                <?php } else { ?>
                <?php $total=0;foreach ($result_pengajuan as $a) { ?>
                  <tr>
                    <td>
                      <span class="badge gradient-45deg-light-blue-cyan"><?php echo $a->kode;?></span><br>
                      <?php echo $a->nama_akun;?>
                    </td>
                    <td>
                      <b><?php echo $a->no_urut; ?></b><br>
                      <?php echo $a->nama_kegiatan; ?><br>
                      <?php echo "<b>Keterangan : </b>".$a->keterangan_pengajuan; ?>
                    </td>
                    <td><?php echo $a->tgl_pengajuan; ?></td>
                    <td><?php echo "Rp. ".number_format($a->jumlah,0,'','.' ).",-"; ?></td>
                    <td>
                    <?php  
                                if ($a->status_realisasi == 1)
                                {
                                  echo "<span class='badge green'>Realisasi</span></br>"."Rp. ".number_format($a->jumlah_realisasi,0,'','.' ).",-";
                                }
                                else
                                {
                                  echo "<span class='badge orange'>Approved</span></span>";
                                }

                      ?>
                    </td>
                  </tr>
                <?php $total=$total+$a->jumlah;} } ?>
              </tbody>
            </table>
            </div>
    </div>
</div>
<?php } ?>
