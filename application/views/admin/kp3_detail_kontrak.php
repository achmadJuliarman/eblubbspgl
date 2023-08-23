<div class="container-fluid">
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <h4 class="card-title">DETAIL KONTRAK</h4>
                    <small>Judul Kontrak </small>
                    <h6><?php echo $result->nama_kontrak;?></h6>
                    <small>Pelaksana Layanan </small>
                    <h6><?php echo $result->rumah_layanan;?></h6>
                    <small>Pejabat Teknis </small>
                    <h6><?php echo $result->pejabat_teknis;?></h6>
                    <small>Nilai Kontrak</small>
                    <h6><?php echo "Rp. ".number_format($result->nilai_kontrak,0,'','.' ).",-"; ?></h6>
                    <small>Tanggal Pelaksanaan</small>
                    <h6><?php echo $result->tgl_mulai." s/d ".$result->tgl_akhir;?></h6>
                    <small>Jumlah Termin</small>
                    <h6><?php echo $result->termin;?></h6>
                </div>
            </div>
            <div class="card">
                <div class="card-content">
                    <!-- <h6 class="card-subtitle">You have <?php echo $jumlah; ?> Contract</h6> -->
                    <ul class="collapsible expandable collapsible-dark">
                        <li>
                            <div class="collapsible-header">Termin</div>
                            <?php $jumlah_termin = $this->db->query("SELECT COUNT(*) as jumlah FROM termin WHERE id_kontrak =$result->id_kontrak")->row();?>
                            <div class="collapsible-body">
                              <table class="table table-striped table-dashboard-two mg-b-0">
                                <thead>
                                  <tr>
                                    <th class="wd-lg-25p">Termin</th>
                                    <th class="wd-lg-25p">Tanggal</th>
                                    <th class="wd-lg-25p">Jumlah</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php if($jumlah_termin->jumlah == 0 ) {?>
                                    <tr>
                                      <td colspan="2">Belum ada data</td>
                                    </tr>
                                  <?php } else { ?>
                                    <?php foreach ($result_termin as $a) { ?>
                                      <tr>
                                        <td><?php echo $a->termin; ?></td>
                                        <td><?php echo $a->tgl_termin; ?></td>
                                        <td><?php echo "Rp. ".number_format($a->jumlah,0,'','.' ).",-"; ?></td>
                                      </tr>
                                    <?php } ?>
                                  <?php } ?>
                              </tbody>
                              </table>
                            </div>
                        </li>
                        <li>
                            <div class="collapsible-header">Anggota Tim</div>
                            <div class="collapsible-body">
                              <?php $anggota = $this->db->query("SELECT * FROM personil AS per INNER JOIN pegawai2 AS p ON per.id_pegawai = p.id WHERE per.id_kontrak = $result->id_kontrak ORDER BY p.nama")->result(); ?>
                              <table class="table table-striped table-dashboard-one mg-b-0">
                                <thead>
                                <tr>
                                  <th>NAMA</th>
                                  <td></td>
                                </tr>
                              </thead>
                              <tbody>
                                <?php foreach ($anggota as $a) { ?>
                                  <tr>
                                    <td><?php echo $a->nip." - ".$a->nama; ?></td>
                                    <td></td>
                                  </tr>
                                <?php } ?>
                              </tbody>
                              </table>
                              <br>
                              <center>
                              <?php if ($result->file_sk != "") { ?>
                                <a href="<?php echo base_url();?>uploads/sk_tim/<?php echo $result->file_sk;?>" target="_blank" class="btn green btn-with-icon rounded-5 modal-trigger"><i class="far fa-file-alt"></i> View File SK TIM</a>
                              <?php } else { ?>
                                <a href="#" target="_blank" class="btn red btn-with-icon rounded-5 modal-trigger"><i class="far fa-file-alt"></i> Belum ada File SK TIM</a>
                              <?php } ?>
                              </cener>
                            </div>
                        </li>
                        <li>
                            <div class="collapsible-header">Timeline</div>
                            <?php $jumlah_timeline = $this->db->query("SELECT COUNT(*) as jumlah FROM kegiatan WHERE id_kontrak =$result->id_kontrak")->row();?>
                            <div class="collapsible-body">
                              <table class="table table-striped table-dashboard-two mg-b-0">
                                <thead>
                                  <tr>
                                    <th class="wd-lg-25p">Nama Kegiatan</th>
                                    <th class="wd-lg-25p">Tanggal Pelaksanaan</th>
                                    <th class="wd-lg-25p"></th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php if($jumlah_timeline->jumlah == 0 ) {?>
                                    <tr>
                                      <td colspan="2">Belum ada data</td>
                                    </tr>
                                  <?php } else { ?>
                                    <?php foreach ($result_timeline as $a) { ?>
                                      <tr>
                                        <td><span class="label label-table label-warning">Termin <?php echo $a->termin_id;?></span>&nbsp;<?php echo $a->nama_kegiatan; ?> </td>
                                        <td><?php echo $a->tgl_mulai." s/d ".$a->tgl_akhir; ?></td>
                                        <td>
                                          <?php if ($a->status_kegiatan == 0) { ?>
                                            <a href="#modalupdatekegiatan<?php echo $a->id_kegiatan; ?>" class="btn btn-small green btn-outline tooltipped modal-trigger" data-position="top" data-delay="50" data-tooltip="Update Kegiatan"><i class="fas fa-check-circle"></i></a>
                                            <a href="#modalupdatekendala<?php echo $a->id_kegiatan; ?>" class="btn btn-small red btn-outline tooltipped modal-trigger" data-position="top" data-delay="50" data-tooltip="Input Kendala"><i class="fas fa-exclamation-circle"></i></a>
                                          <?php } elseif ($a->status_kegiatan==1) { ?>
                                            <span class="label label-table label-warning">Menunggu Approval Bidang Program</span>
                                          <?php } elseif ($a->status_kegiatan==2) { ?>
                                            <span class="label label-table label-warning">Menunggu Tindak Lanjut Kendala</span>
                                          <?php } elseif ($a->status_kegiatan==3) { ?>
                                            <span class="label label-success">Kendala telah ditindaklanjuti</span>
                                            <a href="#modalupdatekegiatan<?php echo $a->id_kegiatan; ?>" class="btn btn-small green btn-outline tooltipped modal-trigger" data-position="top" data-delay="50" data-tooltip="Update Kegiatan"><i class="fas fa-check-circle"></i></a>
                                            <a href="#modalupdatekendala<?php echo $a->id_kegiatan; ?>" class="btn btn-small red btn-outline tooltipped modal-trigger" data-position="top" data-delay="50" data-tooltip="Input Kendala"><i class="fas fa-exclamation-circle"></i></a>
                                          <?php } elseif ($a->status_kegiatan==4) { ?>
                                            <span class="label label-success">Pengajuan termin pembayaran</span>
                                          <?php } ?>
                                        </td>
                                      </tr>
                                    <?php } ?>
                                  <?php } ?>
                              </tbody>
                              </table>
                            </div>
                            <?php foreach ($result_timeline as $a) { ?>
                            <div id="modalupdatekegiatan<?php echo $a->id_kegiatan;?>" class="modal">
                              <?php echo form_open_multipart('pejabat_teknis/update_kegiatan');?>
                                <div class="modal-content">
                                    <h4>Update Data Kegiatan</h4>
                                        <div class="row">
                                            <div class="input-field col s12">
                                                <input id="id_kontrak" type="text" name="id_kontrak" value="<?php echo $result->id_kontrak; ?>" hidden>
                                                <input id="id_kegiatan" type="text" name="id_kegiatan" value="<?php echo $a->id_kegiatan; ?>" hidden>
                                                <input id="a7" type="text" name="keterangan" maxlength="100" required>
                                                <label for="a9">Keterangan</label>
                                            </div>
                                        </div>
                                        <div class="file-field input-field">
                                            <div class="btn blue darken-1">
                                                <span>Upload File Pendukung</span>
                                                <input type="file" name="file">
                                            </div>
                                            <div class="file-path-wrapper">
                                                <input class="file-path validate" type="text">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col s12">
                                                <button class="btn cyan waves-effect waves-light left" type="submit" name="action">Simpan</button>
                                            </div>
                                        </div>
                                  </div>
                              </form>
                            </div>
                            <?php } ?>
                            <?php foreach ($result_timeline as $a) { ?>
                            <div id="modalupdatekendala<?php echo $a->id_kegiatan;?>" class="modal">
                              <?php echo form_open_multipart('pejabat_teknis/update_kendala');?>
                                <div class="modal-content">
                                    <h4>Update Data Kegiatan</h4>
                                        <div class="row">
                                            <div class="input-field col s12">
                                                <input id="id_kontrak" type="text" name="id_kontrak" value="<?php echo $result->id_kontrak; ?>" hidden>
                                                <input id="id_kegiatan" type="text" name="id_kegiatan" value="<?php echo $a->id_kegiatan; ?>" hidden>
                                                <input id="a7" type="text" name="keterangan" maxlength="1000" required>
                                                <label for="a9">Keterangan</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col s12">
                                                <button class="btn cyan waves-effect waves-light left" type="submit" name="action">Simpan</button>
                                            </div>
                                        </div>
                                  </div>
                              </form>
                            </div>
                            <?php } ?>
                        </li>
                        <li>
                            <div class="collapsible-header">Rencana Operasional</div>
                            <div class="collapsible-body">
                              <table class="table table-striped table-dashboard-two mg-b-0" width="100%">
                                <thead>
                                  <tr>
                                    <th width="30%">Kode Akun</th>
                                    <th width="15%">Pagu</th>
                                    <th width="15%">Pengajuan</th>
                                    <th width="15%">Realisasi</th>
                                    <th width="15%">Saldo</th>
                                    <th width="10%">Keterangan</th>
                                  </tr>
                                </thead>
                                <?php $ro = $this->db->query("SELECT ro.id_ro,ro.id_kontrak,ro.keterangan,SUM(ro.biaya) AS pagu,a.kode,a.nama_akun FROM rencana_operasional AS ro INNER JOIN akun AS a ON ro.akun = a.id_akun WHERE ro.id_kontrak = $result->id_kontrak GROUP BY ro.akun")->result(); ?>
                                <?php $jumlah_ro = $this->db->query("SELECT ro.id_ro,ro.id_kontrak,ro.keterangan,SUM(ro.biaya) AS pengajuan,SUM(ro.realisasi) AS realisasi,a.kode,a.nama_akun,SUM(ro.biaya) AS jumlah FROM rencana_operasional AS ro INNER JOIN akun AS a ON ro.akun = a.id_akun WHERE ro.id_kontrak = $result->id_kontrak GROUP BY ro.akun")->num_rows(); ?>
                                <tbody>
                                  <?php if ($jumlah_ro == 0) { ?>
                                    <tr>
                                      <td colspan="4">Belum ada Rencana Operasional</td>
                                    </tr>
                                  <?php } else { ?>
                                  <?php $total=0;$total_p=0;$total_r=0;$total_s=0; foreach ($ro as $a) { ?>
                                    <?php $pengajuan = $this->db->query("SELECT SUM(p.jumlah) AS pengajuan,SUM(p.jumlah_realisasi) AS realisasi FROM pengajuan AS p INNER JOIN rencana_operasional AS ro ON p.id_ro = ro.id_ro INNER JOIN kontrak AS k ON ro.id_kontrak = k.id_kontrak INNER JOIN akun AS a ON ro.akun = a.id_akun WHERE ro.id_kontrak = $a->id_kontrak AND a.kode = '$a->kode' AND p.status_pengajuan < 2")->row(); ?>
                                    <tr>
                                      <td><?php echo $a->kode." ".$a->nama_akun;?></td>
                                      <td><?php echo "Rp. ".number_format($a->pagu,0,'','.' ).",-"; ?></td>
                                      <td><?php echo "Rp. ".number_format($pengajuan->pengajuan,0,'','.' ).",-"; ?></td>
                                      <td><?php echo "Rp. ".number_format($pengajuan->realisasi,0,'','.' ).",-"; ?></td>
                                      <?php $saldo = $a->pagu - $pengajuan->realisasi;?>
                                      <td><?php echo "Rp. ".number_format($saldo,0,'','.' ).",-"; ?></td>
                                      <td></td>
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
                                      <th></th>
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
                                        <?php if($result->status_ro == 0) { ?>
                                          <span class="label label-table label-danger"><?php echo "Belum di Approve"; ?></strong></span>
                                      <?php } elseif($result->status_ro == 1) { ?>
                                        <span class="label label-table label-warning"><?php echo "Pengajuan ditolak"; ?></strong></span>
                                      <?php } elseif($result->status_ro == 2) { ?>
                                        <span class="label label-table label-success"><?php echo "Approved"; ?></strong></span>
                                      <?php } ?>
                                        *Biaya Operasional sebesar : <span class="label label-table <?php echo $label; ?>"><?= 'Rp. '.number_format($total).',-'." ( ".round($persen,2)." %) ";?> </span>&nbsp; dari nilai Kontrak : <span class="label label-table <?php echo $label; ?>"> <?= 'Rp. '.number_format($result->nilai_kontrak).',-';?> </span>
                                        <br>
                                      </td>
                                    </tr>
                                  <?php } ?>
                              </tbody>
                              </table>
                            </div>
                        </li>
                        <li>
                            <div class="collapsible-header">Pengajuan Biaya Operasional</div>

                            <div class="collapsible-body">
                              <table>
                                <thead>
                                  <tr>
				                            <th>No. Urut</th>
                                    <th>Kode Akun</th>
                                    <th>Nama Kegiatan</th>
                                    <th>Tanggal Pengajuan</th>
                                    <th>Jumlah</th>
                                    <th width="15%">Status</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php if($jumlah_pengajuan == 0) { ?>
                                    <tr>
                                      <td colspan="3">Belum ada pengajuan</td>
                                    </tr>
                                  <?php } else { ?>
                                  <?php $total=0;foreach ($result_pengajuan as $a) { ?>
                                    <tr>
				                              <td><?php echo $a->no_urut; ?></td>
                                      <td><?php echo $a->kode."<br>".$a->nama_akun; ?></td>
                                      <td><?php echo $a->nama_kegiatan; ?> <br> Keterangan : <i><?php echo $a->keterangan_pengajuan; ?></i> </td>
                                      <td><?php echo $a->tgl_pengajuan; ?></td>
                                      <td><?php echo "Rp. ".number_format($a->jumlah,0,'','.' ).",-"; ?></td>
                                      <td>
                                        <?php if ($a->status_realisasi == 0 ) { ?>
                                        <?php if($a->status_pengajuan == 0 ) { ?>
                                          <!-- <a href="#editpengajuan<?php echo $a->id_pengajuan; ?>" class="btn btn-small green btn-outline tooltipped modal-trigger" data-position="top" data-delay="50" data-tooltip="Edit Pengajuan"><i class="far fa-file-alt"></i></a> -->
                                          <a href="<?php echo base_url();?>pejabat_teknis/hapus_pengajuan/<?php echo $result->id_kontrak; ?>/<?php echo $a->id_pengajuan;?>" class="btn btn-small red btn-outline tooltipped" data-position="top" data-delay="50" data-tooltip="Hapus Pengajuan" onclick="javascript: return confirm('Yakin akan menghapus data ?')"><i class="fas fa-trash"></i></a>
                                        <?php } elseif ($a->status_pengajuan == 1) { ?>
                                          <span class="label label-table label-warning"> Approved <span>
                                        <?php } elseif ($a->status_pengajuan == 2) { ?>
                                          <span class="label label-table label-danger"> Ditolak (<?php echo $a->keterangan_tolak; ?>) </span>
                                        <?php } } elseif ($a->status_realisasi == 1) { ?>
                                          <!-- <span class="label label-table label-success"> <?php echo "Rp. ".number_format($a->jumlah_realisasi,0,'','.' ).",-"; ?> </span> -->
                                          <span class="label label-table label-success"> Realisasi </span> <br>
                                          <span class="label label-table label-info"> <?php echo "Rp. ".number_format($a->jumlah_realisasi,0,'','.' ).",-"; ?> </span>
                                        <?php } ?>
                                      </td>
                                    </tr>
                                  <?php $total=$total+$a->jumlah;} } ?>
                                </tbody>
                              </table>
                              <br>
                              <?php $kategori = $this->session->userdata('admin_kategori'); ?>
                              <?php if ($kategori == 3) { ?>
                                <center>
                                <?php if($result->status_ro == 0) { ?>
                                  <h4><span class="label label-table label-danger"><?php echo "RO Belum di Approve"; ?></strong></span></h4>
                              <?php } elseif($result->status_ro == 1) { ?>
                                <h4><span class="label label-table label-warning"><?php echo "Pengajuan RO ditolak"; ?></strong></span></h4>
                              <?php } elseif($result->status_ro == 2) { ?>
                                <a href="#modalpengajuan" class="btn btn-success btn-with-icon btn-block rounded-5 modal-trigger"><i class="far fa-file-alt"></i> Tambah Pengajuan Operasional</a>
                              <?php } ?>
                              </center>
                              <?php } ?>
                              <div id="modalpengajuan" class="modal">
                                <?php echo form_open_multipart('pejabat_teknis/input_pengajuan');?>
                                  <div class="modal-content">
                                      <h4>Data Pengajuan Operasional</h4>
					                                 <div class="row">
                                              <div class="input-field col s12">
                                                  <!-- <input id="a6" type="text" name="no_urut" hidden value="<?php echo $no_urut; ?>"> -->
                                                  <input id="a6" type="text" disabled value="OTOMATIS">
                                                  <label for="a9">No Urut</label>
                                              </div>
                                          </div>
                                          <div class="row">
                                              <div class="input-field col s12">
                                                <input id="termin" type="text" name="id_kontrak" value="<?php echo $result->id_kontrak; ?>" hidden>
                                                  <select name="id_ro" required>
                                                      <option value="" disabled selected>Pilih Rencana Operasional</option>
                                                      <?php foreach ($result_ro as $a) { ?>
                                                        <?php $total = $this->db->query("SELECT SUM(jumlah) AS total FROM pengajuan WHERE id_ro = $a->id_ro")->row();?>
                                                        <?php $saldo = $a->biaya - $total->total;?>
                                                        <option value="<?php echo $a->id_ro; ?>"><?php echo $a->nama_kegiatan." ( ".$a->kode." - ".$a->nama_akun." ) Pagu : "."Rp. ".number_format($a->biaya,0,'','.' ).",-"." saldo : "."Rp. ".number_format($saldo,0,'','.' ).",-"; ?></option>
                                                        <!-- <option value="<?php echo $a->id_ro; ?>"><?php echo $a->kode."  ".$a->nama_akun." - ".$a->nama_kegiatan; ?></option> -->
                                                      <?php } ?>
                                                  </select>
                                              </div>
                                            </div>
                                          <div class="row">
                                              <div class="input-field col s12">
                                                  <input id="a6" type="number" name="jumlah" maxlength="20" min="1" required>
                                                  <label for="a9">Jumlah</label>
                                              </div>
                                          </div>
                                          <div class="row">
                                              <div class="input-field col s12">
                                                  <input id="a7" type="text" name="keterangan" maxlength="100" required>
                                                  <label for="a9">Keterangan</label>
                                              </div>
                                          </div>
                                          <div class="row">
                                              <div class="input-field col s12">
                                                  <button class="btn cyan waves-effect waves-light left" type="submit" name="action">Simpan</button>
                                              </div>
                                          </div>
                                    </div>
                                </form>
                              </div>
                            </div>
                        </li>
                        <li>
                            <div class="collapsible-header">Adendum</div>
                            <div class="collapsible-body">
                              Riwayat Adendum :
                              <?php $adendum = $this->db->query("SELECT * FROM adendum WHERE id_kontrak = $result->id_kontrak")->result(); ?>
                              <ul>
                                <?php foreach($adendum AS $a) { ?>
                                  <li><?php echo "( ".$a->tgl_adendum." ) -- ".$a->keterangan_adendum;?></li>
                                <?php } ?>
                              </ul>
                            </div>
                        </li>
                        <li>
                            <div class="collapsible-header">Dokumen</div>
                            <div class="collapsible-body">
                              <?php $history = $this->db->query("SELECT h.file,h.tanggal,p.nama FROM history_dokumen AS h INNER JOIN user AS u ON h.id_user = u.id_user INNER JOIN pegawai2 AS p ON u.id_pegawai = p.id WHERE h.id_kontrak = $result->id_kontrak")->result(); ?>
                              <ul>
                                <?php foreach($history AS $a) { ?>
                                  <li><?php echo "( ".$a->tanggal." ) -- File kontrak diunggah oleh: ".$a->nama.". Nama File :";?><a href="<?php echo base_url();?>uploads/kontrak/<?php echo $a->file;?>" target="_blank"><?php echo $a->file;?></a></li>
                                <?php } ?>
                              </ul>
                            </div>
                        </li>
                        <li>
                            <div class="collapsible-header">History</div>
                            <div class="collapsible-body">
                              History Kontrak :
                              <?php $start = $this->db->query("SELECT k.created_time,p.nama FROM kontrak AS k INNER JOIN user AS u ON k.created_by = u.id_user INNER JOIN pegawai2 AS p ON u.id_pegawai = p.id WHERE k.id_kontrak = $result->id_kontrak")->row(); ?>
                              <ul>
                                  <li><?php echo "( ".$start->created_time." ) -- Kontrak dibuat oleh ".$start->nama;?></li>
                              </ul>
                              <?php $history = $this->db->query("SELECT h.keterangan,h.tanggal,p.nama FROM history AS h INNER JOIN user AS u ON h.id_user = u.id_user INNER JOIN pegawai2 AS p ON u.id_pegawai = p.id WHERE h.id_kontrak = $result->id_kontrak")->result(); ?>
                              <ul>
                                <?php foreach($history AS $a) { ?>
                                  <li><?php echo "( ".$a->tanggal." ) -- ".$a->keterangan." ".$a->nama;?></li>
                                <?php } ?>
                              </ul>
                            </div>
                        </li>
		   </ul>
                </div>
            </div>
        </div>
    </div>
</div>
