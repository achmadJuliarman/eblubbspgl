<div class="container-fluid">
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <h4 class="card-title">Daftar Kontrak</h4>
                    <h6 class="card-subtitle">You have <?php echo $jumlah; ?> Contract</h6>
                    <table id="demo-foo-addrow2" class="table table-bordered table-hover toggle-circle" data-page-size="7">
                      <thead>
                        <tr>
                          <th width="5%" data-sort-ignore="true"><center>No.</center></th>
                          <th width="50%">Judul kontrak</th>
                          <th width="15%">Tanggal Mulai</th>
                          <th width="15%">Tanggal Selesai</th>
                          <th width="10%" data-sort-ignore="true"><center>Status</center></th>
                          <th width="10%" data-sort-ignore="true"><center>Action</center></th>
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
                                    <?php $kategori = $this->session->userdata('admin_kategori'); if ($kategori == 1) { ?>
                                      <a href="<?php echo base_url();?>afin/add_kontrak" class="btn btn-medium"><i class="icon wb-plus" aria-hidden="true"></i> <i class="far fa-file-alt"></i> Tambah Data Kontrak</a>
                                    <?php } ?>
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
                            <td>
                              <a href="<?php echo base_url();?>afin/detail_kontrak/<?php echo $a->id_kontrak;?>"><?= $a->nama_kontrak ?></a>
                              <br/>
                              <span class="label label-table label-warning"><?php echo $a->no_kontrak; ?></strong> (Tanggal : <?php echo $a->tgl_ttd; ?>)</span>
                              <br/>
                              <span class="label label-table label-success"><?php echo $a->nama_perusahaan; ?></span>&nbsp;<span class="label label-table label-danger"><?php echo "Rp.".number_format($a->nilai_kontrak).",-"; ?></span>
                            </td>
                            <td><?php echo $this->format_tanggal->jin_date_str($a->tgl_mulai); ?></td>
                            <td><?php echo $this->format_tanggal->jin_date_str($a->tgl_akhir); ?></td>
                            <!-- <td><?php echo "Rp.".number_format($a->nilai_kontrak).",-"; ?></td> -->
                            <td>
                              <center>
                                <?php if($a->status_ro == 0) { ?>
                                  <span class="label label-table label-danger"><?php echo "Belum di Approve"; ?></strong></span>
                              <?php } elseif($a->status_ro == 1) { ?>
                                <span class="label label-table label-warning"><?php echo "Pengajuan ditolak"; ?></strong></span>
                              <?php } elseif($a->status_ro == 2) { ?>
                                <span class="label label-table label-success"><?php echo "Approved"; ?></strong></span>
                              <?php } ?>
                              </center>
                            </td>
                            <td>
                              <center>
                                <a href="#modalro<?php echo $a->id_kontrak; ?>" class="btn btn-success btn-with-icon btn-block rounded-5 modal-trigger tooltipped" data-position="top" data-delay="50" data-tooltip="Lihat Detail RO"><i class="fas fa-eye"></i> Detail RO</a>
                              </center>
                            </td>
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
                        $label = "label-info";
                      }
                      elseif ($persen >= 30 && $persen <= 50)
                      {
                        $label = "label-success";
                      }
                      elseif ($persen > 50 && $persen <= 70)
                      {
                        $label = "label-warning";
                      }
                      elseif ($persen > 70)
                      {
                        $label = "label-danger";
                      }
                      ?>
                      *Biaya Operasional sebesar : <span class="label label-table <?php echo $label; ?>"><?= 'Rp. '.number_format($total).',-'." ( ".round($persen,2)." %) ";?> </span>&nbsp; dari nilai Kontrak : <span class="label label-table <?php echo $label; ?>"> <?= 'Rp. '.number_format($b->nilai_kontrak).',-';?> </span>
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
    </div>
</div>
<?php } ?>
