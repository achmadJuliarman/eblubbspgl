    <div class="container-fluid">
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <h4 class="card-title">Detail Kontrak</h4>
                        <h6 class="card-subtitle"><?php echo $result->nama_kontrak; ?></h6>
                        <table>
                            <tbody>
                                <tr>
                                    <td>
                                      <b>Nilai Kontrak</b><br/>
                                      <?php echo "Rp. ".number_format($result->nilai_kontrak,0,'','.' ).",-"; ?>
                                    </td>
                                    <!-- <td><span>Nilai Kontrak : <br><?= "Rp. ".number_format() ?></span></td> -->
                                </tr>
                                <tr>
                                  <td>
                                    <b>Pelaksana Layanan</b><br/>
                                    <?php echo $result->rumah_layanan; ?>
                                  </td>
                                </tr>
                                <tr>
                                  <td>
                                    <b>Pejabat Teknis</b><br/>
                                    <?php echo $result->pejabat_teknis; ?>
                                  </td>
                                </tr>
                                <tr>
                                  <td>
                                    <b>Jenis Layanan</b><br/>
                                    <?php echo $result->nama_layanan; ?>
                                  </td>
                                </tr>
                                <tr>
                                  <td>
                                    <b>PIC</b><br/>
                                    <?php echo $result->pic; ?>
                                  </td>
                                </tr>
                                <tr>
                                  <td>
                                    <b>Tanggal Tanda Tangan</b><br/>
                                    <?php echo $result->tgl_ttd; ?>
                                  </td>
                                </tr>
                                <tr>
                                  <td>
                                    <b>Tanggal Pelaksanaan</b><br/>
                                    <?php echo $result->tgl_mulai." s/d ".$result->tgl_akhir; ?>
                                  </td>
                                </tr>
                                <tr>
                                  <td>
                                    <b>Keterangan</b><br/>
                                    <?php echo $result->keterangan; ?>
                                  </td>
                                </tr>
                                <tr>
                                  <td>
                                    <b>File Kontrak</b><br/>
                                    <?php $kategori = $this->session->userdata('admin_kategori'); if($result->file != NULL) { ?>
                                      <a class="btn btn-success waves-effect waves-light m-b-5" href="<?php echo base_url();?>uploads/kontrak/<?php echo $result->file;?>" target="_blank"><?php echo $result->file;?></a>
                                  <?php } elseif($result->file == NULL && $kategori==1) { ?>
                                    <?php echo form_open_multipart('afin/upload');?>
                                      <input type="text" class="form-control" name="id_kontrak" hidden value="<?php echo $result->id_kontrak;?>">
                                      <div class="file-field input-field">
                                          <div class="btn blue darken-1">
                                              <span>Upload File Kontrak</span>
                                              <input type="file" name="file">
                                          </div>
                                          <div class="file-path-wrapper">
                                              <input class="file-path validate" type="text">
                                          </div>
                                      </div>
                                      <button type="submit" class="btn btn-success">Simpan</button>
                                      </form>
                                    <?php } ?>
                                  </td>
                                </tr>
                            </tbody>
                        </table>
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
                          <?php $ro = $this->db->query("SELECT ro.id_ro,ro.id_kontrak,ro.keterangan,SUM(ro.biaya) AS pagu,a.kode,a.nama_akun FROM rencana_operasional AS ro INNER JOIN akun AS a ON ro.akun = a.id_akun WHERE ro.id_kontrak = $result->id_kontrak GROUP BY ro.akun")->result(); ?>
                          <?php $jumlah_ro = $this->db->query("SELECT ro.id_ro,ro.id_kontrak,ro.keterangan,SUM(ro.biaya) AS pengajuan,SUM(ro.realisasi) AS realisasi,a.kode,a.nama_akun,SUM(ro.biaya) AS jumlah FROM rencana_operasional AS ro INNER JOIN akun AS a ON ro.akun = a.id_akun WHERE ro.id_kontrak = $result->id_kontrak GROUP BY ro.akun")->num_rows(); ?>
                          <tbody>
                            <?php if ($jumlah_ro == 0) { ?>
                              <tr>
                                <td colspan="3">Belum ada Rencana Operasional</td>
                              </tr>
                            <?php } else { ?>
                            <?php $total=0;$total_p=0;$total_r=0;$total_s=0; foreach ($ro as $a) { ?>
                              <?php $pengajuan = $this->db->query("SELECT SUM(jumlah) AS pengajuan,SUM(jumlah_realisasi) AS realisasi FROM pengajuan WHERE id_ro = $a->id_ro")->row(); ?>
                              <tr>
                                <td><?php echo $a->kode." ".$a->nama_akun;?></td>
                                <td><?php echo "Rp. ".number_format($a->pagu,0,'','.' ).",-"; ?></td>
                                <td><?php echo "Rp. ".number_format($pengajuan->pengajuan,0,'','.' ).",-"; ?></td>
                                <td><?php echo "Rp. ".number_format($pengajuan->realisasi,0,'','.' ).",-"; ?></td>
                                <?php $saldo = $a->pagu - $pengajuan->realisasi;?>
                                <td><?php echo "Rp. ".number_format($saldo,0,'','.' ).",-"; ?></td>
                              </tr>
                              <?php $total=$total+$a->pagu;$total_p=$total_p+$pengajuan->pengajuan;$total_r=$total_r+$pengajuan->realisasi;$total_s=$total_s+$saldo; } ?>
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
                                  <?php $persen = $total/$result->nilai_kontrak*100; ?>
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
                                  *Biaya Operasional sebesar : <span class="label label-table <?php echo $label; ?>"><?= 'Rp. '.number_format($total).',-'." ( ".round($persen,2)." %) ";?> </span>&nbsp; dari nilai Kontrak : <span class="label label-table <?php echo $label; ?>"> <?= 'Rp. '.number_format($result->nilai_kontrak).',-';?> </span>
                                </td>
                              </tr>
                            <?php } ?>
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
