<div id="main">
      <div class="row">
        <div class="col s12">
            <div class="container">
                <div class="section section-data-tables">
                  <div class="card-content">
                    <div class="row">
                      <div class="col s12">
                          <div class="card-panel gradient-45deg-light-blue-cyan" style="color: rgba(255, 255, 255, 0.901961);">
                            <span style="color: rgba(255, 255, 255, 0.901961);font-size:20px;"><center>DETAIL KONTRAK</center></span>
                          </div>
                      </div>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-content">
                        <small>Judul Kontrak </small>
                        <h6><b><?php echo $result->nama_kontrak;?></b></h6>
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
                  <div class="card-content">
                      <ul class="collapsible collapsible-accordion">
                          <li>
                              <div class="collapsible-header">Termin</div>
                              <?php $jumlah_termin = $this->db->query("SELECT COUNT(*) as jumlah FROM termin WHERE id_kontrak =$result->id_kontrak")->row();?>
                              <div class="collapsible-body">
                                <table class="table table-striped table-dashboard-two mg-b-0">
                                  <thead>
                                    <tr>
                                      <th style="text-align:center;" class="wd-lg-25p">Termin</th>
                                      <th style="text-align:center;" class="wd-lg-25p">Tanggal</th>
                                      <th style="text-align:center;" class="wd-lg-25p">Jumlah</th>
                                    </tr>
                                  </thead>
                                  <tbody>

                                    <?php if($jumlah_termin->jumlah == 0 ) { ?>
                                      <tr>
                                        <td style="text-align:center;" colspan="2">Belum ada data</td>
                                      </tr>
                                    <?php } else { ?>
                                      <?php foreach ($result_termin as $a) { ?>
                                        <tr>
                                          <td style="text-align:center;"><?php echo $a->termin; ?></td>
                                          <td style="text-align:center;"><?php echo $this->format_tanggal->jin_date_str($a->tgl_termin); ?></td>
                                          <?php $cek_termin = $this->db->query("SELECT COUNT(*) AS jumlah FROM kegiatan WHERE status=4 AND termin=$a->id_termin AND id_kontrak = $result->id_kontrak")->row(); ?>
                                          <?php $cek_jumlah_termin = $this->db->query("SELECT COUNT(*) AS jumlah FROM kegiatan WHERE termin=$a->id_termin AND id_kontrak = $result->id_kontrak")->row(); ?>
                                          <td style="text-align:center;">
                                            <?php echo "Rp. ".number_format($a->jumlah,0,'','.' ).",-"; ?>&nbsp;
                                              <?php if($a->status_termin == 0) { ?>
                                                <span class="badge red" style="font-size: 12px;">Belum ada Pengajuan Termin Pembayaran</span>
                                              <?php } elseif($a->status_termin == 1) { ?>
                                                <span class="badge green" style="font-size: 12px;">Pengajuan Termin Pembayaran telah diajukan</span>
                                              <?php } ?>
                                          </td>
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
                                    <td>NAMA</td>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php foreach ($anggota as $a) { ?>
                                    <tr>
                                      <td><?php echo $a->nip." - ".$a->nama; ?></td>
                                    </tr>
                                  <?php } ?>
                                </tbody>
                                </table>
                                <br>
                                <center>
                                  <a href="#modalsk" class="btn-floating red modal-trigger tooltipped" data-position="top" data-tooltip="Upload SK TIM"><i class="material-icons dp48">publish</i></a>
                                <?php if ($result->file_sk != "") { ?>
                                  <a href="<?php echo base_url();?>uploads/sk_tim/<?php echo $result->file_sk;?>" target="_blank" class="btn-floating blue modal-trigger tooltipped" data-position="top" data-tooltip="View SK TIM"><i class="material-icons dp48">picture_as_pdf</i></a>
                                <?php } ?>
                                </center>
                                <div id="modalsk" class="modal">
                                  <?php echo form_open_multipart('program/upload_sk');?>
                                  <div class="modal-content">
                                      <h4>Upload SK Tim</h4>
                                          <div class="row">
                                              <div class="input-field col s12">
                                                <input type="text" class="form-control" name="id_kontrak" hidden value="<?php echo $result->id_kontrak;?>">
                                                <div class="file-field input-field">
                                                    <div class="btn blue darken-1">
                                                        <span>Upload SK</span>
                                                        <input type="file" name="file">
                                                    </div>
                                                    <div class="file-path-wrapper">
                                                        <input class="file-path validate" type="text">
                                                    </div>
                                                </div>
                                                <p>File .pdf maksimal 20Mb</p>
                                              </div>
                                            </div>
                                          <div class="row">
                                              <div class="input-field col s12">
                                                  <button class="btn cyan waves-effect waves-light left" type="submit" name="action" onclick="javascript: return confirm('Yakin akan mengupload data ?')">Simpan</button>
                                              </div>
                                          </div>
                                    </div>
                                    </form>
                                </div>
                              </div>
                          </li>
                          <li>
                              <div class="collapsible-header">Timeline</div>
                              <?php $jumlah_timeline = $this->db->query("SELECT COUNT(*) as jumlah FROM kegiatan WHERE id_kontrak =$result->id_kontrak")->row();?>
                              <div class="collapsible-body">
                                <table class="table table-striped table-dashboard-two mg-b-0">
                                  <thead>
                                    <tr>
                                      <th width="10%" class="wd-lg-25p">Termin</th>
                                      <th class="wd-lg-25p">Nama Kegiatan</th>
                                      <th width="25%" class="wd-lg-25p"></th>
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
                                          <td>
                                            <span class="badge orange" style="font-size: 12px;">Termin <?php echo $a->termin;?></span>
                                          </td>
                                          <td>
                                            <?php echo $a->nama_kegiatan; ?> <br>
                                            <span class="badge cyan" style="font-size: 12px;"><?php echo $this->format_tanggal->jin_date_str($a->tgl_mulai)." s/d ".$this->format_tanggal->jin_date_str($a->tgl_akhir); ?></span>
                                          </td>
                                          <td>
                                            <?php if ($a->status_kegiatan == 0) { ?>
                                              <a href="#modalupdatekegiatan<?php echo $a->id_kegiatan; ?>" class="btn btn-floating green btn-outline tooltipped modal-trigger" data-position="top" data-delay="50" data-tooltip="Update Kegiatan"><i class="material-icons dp48">assignment</i></a>
                                              <a href="#modalupdatekendala<?php echo $a->id_kegiatan; ?>" class="btn btn-floating red btn-outline tooltipped modal-trigger" data-position="top" data-delay="50" data-tooltip="Input Kendala"><i class="material-icons dp48">announcement</i></a>
                                            <?php } elseif ($a->status_kegiatan==1) { ?>
                                              <span class="badge orange" style="font-size: 12px;">Menunggu Approval Bidang Program</span>
                                            <?php } elseif ($a->status_kegiatan==2) { ?>
                                              <span class="badge orange" style="font-size: 12px;">Menunggu Tindak Lanjut Kendala</span>
                                            <?php } elseif ($a->status_kegiatan==3) { ?>
                                              <span class="badge green" style="font-size: 12px;">Kendala telah ditindaklanjuti</span>
                                              <a href="#modalupdatekegiatan<?php echo $a->id_kegiatan; ?>" class="btn btn-small green btn-outline tooltipped modal-trigger" data-position="top" data-delay="50" data-tooltip="Update Kegiatan"><i class="fas fa-check-circle"></i></a>
                                              <a href="#modalupdatekendala<?php echo $a->id_kegiatan; ?>" class="btn btn-small red btn-outline tooltipped modal-trigger" data-position="top" data-delay="50" data-tooltip="Input Kendala"><i class="fas fa-exclamation-circle"></i></a>
                                            <?php } elseif ($a->status_kegiatan==4) { ?>
                                              <span class="badge green" style="font-size: 12px;">Pengajuan termin pembayaran</span>
                                            <?php } ?>
                                          </td>
                                        </tr>
                                      <?php } ?>
                                    <?php } ?>
                                </tbody>
                                </table>
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
                              </div>
                          </li>
                          <li>
                              <div class="collapsible-header">Rencana Operasional</div>
                              <div class="collapsible-body">
                                <!-- <a href="#modalmax" class="btn red btn-with-icon rounded-5 modal-trigger"> Setting Max. Biaya Operasional</a> -->
                                <table class="table table-striped table-dashboard-two mg-b-0" width="100%">
                                  <thead>
                                    <tr>
                                      <th width="30%">Kode Akun</th>
                                      <th width="15%">Pagu</th>
                                      <th width="15%">Pengajuan</th>
                                      <th width="15%">Realisasi</th>
                                      <th width="15%">Saldo</th>
                                      <th width="10%"></th>
                                    </tr>
                                  </thead>
                                  <?php $ro = $this->db->query("SELECT ro.id_ro,ro.id_kontrak,ro.keterangan,SUM(ro.biaya) AS pagu,a.kode,a.nama_akun,ro.akun FROM rencana_operasional AS ro INNER JOIN akun AS a ON ro.akun = a.id_akun WHERE ro.id_kontrak = $result->id_kontrak GROUP BY ro.akun")->result(); ?>
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
                                        <td>
                                          <span class="badge gradient-45deg-light-blue-cyan"><?php echo $a->kode;?></span><br>
                                          <?php echo $a->nama_akun;?>
                                        </td>
                                        <td><?php echo "Rp. ".number_format($a->pagu,0,'','.' ).",-"; ?></td>
                                        <td><?php echo "Rp. ".number_format($pengajuan->pengajuan,0,'','.' ).",-"; ?></td>
                                        <td><?php echo "Rp. ".number_format($pengajuan->realisasi,0,'','.' ).",-"; ?></td>
                                        <?php $saldo = $a->pagu - $pengajuan->realisasi;?>
                                        <td><?php echo "Rp. ".number_format($saldo,0,'','.' ).",-"; ?></td>
                                        <td><a href="<?php echo base_url();?>pejabat_teknis/detail_ro/<?php echo $a->id_kontrak."/".$a->akun;?>" class="btn-floating gradient-45deg-light-blue-cyan tooltipped modal-trigger" data-position="top" data-tooltip="Detail"><i class="material-icons dp48">announcement</i></a></td>
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
                                        <th></th>
                                      </tr>
                                      <tr>
                                        <td colspan="5">
                                          <?php $persen = $total/$result->nilai_kontrak*100; ?>
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
                                          *Biaya Operasional sebesar : <span class="badge <?php echo $label; ?>"><?= 'Rp. '.number_format($total).',-'." ( ".round($persen,2)." %) ";?> </span>&nbsp; dari nilai Kontrak : <span class="badge <?php echo $label; ?>"> <?= 'Rp. '.number_format($result->nilai_kontrak).',-';?> </span><br/>
                                          *Max. Biaya Operasional sebesar <span class="badge red"><?php echo $result->max_operasional;?> %</span>
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
                                      <th>Kode Akun</th>
                                      <th>Nama Kegiatan</th>
                                      <th>Tanggal Pengajuan</th>
                                      <th>Jumlah</th>
                                      <th>Status</th>
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
                                        <td>
                                          <span class="badge gradient-45deg-light-blue-cyan"><?php echo $a->kode;?></span><br>
                                          <?php echo $a->nama_akun;?>
                                        </td>
                                        <td>
                                          <b><?php echo $a->no_urut; ?></b><br>
                                          <?php echo $a->nama_kegiatan; ?><br>
                                          <?php echo "<b>Keterangan : </b>".$a->keterangan_pengajuan; ?><br>
                                          File : <a href="<?php echo base_url();?>uploads/pengajuan/<?php echo $a->file;?>" target="_blank"><?php echo $a->file;?></a>
                                        </td>
                                        <td><?php echo $a->tgl_pengajuan; ?></td>
                                        <td><?php echo "Rp. ".number_format($a->jumlah,0,'','.' ).",-"; ?></td>
                                        <td>
                                          <?php if ($a->status_pengajuan == 0) { ?>
                                            <a href="#modalpengajuanedit<?php echo $a->id_pengajuan; ?>" class="btn-floating blue tooltipped modal-trigger" data-position="top" data-tooltip="Edit"><i class="material-icons dp48">edit</i></a>
                                            <a href="<?php echo base_url();?>pejabat_teknis/hapus_pengajuan/<?php echo $result->id_kontrak; ?>/<?php echo $a->id_pengajuan; ?>" class="btn-floating red tooltipped modal-trigger" data-position="top" data-tooltip="Hapus" onclick="javascript: return confirm('Yakin akan menghapus data ?')"><i class="material-icons dp48">delete</i></a>
                                          <?php } elseif ($a->status_pengajuan == 1)
                                                  {
                                                    if ($a->status_realisasi == 1)
                                                    {
                                                      echo "<span class='badge green'>Realisasi</span></br>"."Rp. ".number_format($a->jumlah_realisasi,0,'','.' ).",-";
                                                    }
                                                    else
                                                    {
                                                      echo "<span class='badge orange'>Approved</span></span>";
                                                    }
                                                  }
                                                  else { echo "<span class='badge red'>Ditolak PPK</span></span>";  }
                                          ?>
                                        </td>
                                      </tr>
                                    <?php $total=$total+$a->jumlah;} } ?>
                                    <!-- <tr>
                                      <td> TOTAL</td>
                                      <td colspan="3"><?php echo "Rp. ".number_format($total,0,'','.' ).",-"; ?></td>
                                    </tr> -->
                                  </tbody>
                                </table>
                                <br>
                                <?php $kategori = $this->session->userdata('admin_kategori'); ?>
                                  <?php if ($kategori == 3) { ?>
                                    <center>
                                    <?php if($result->status_ro == 0) { ?>
                                      <a href="#" class="btn orange btn-with-icon btn-block">RO Belum di Approve</a>
                                    <?php } elseif($result->status_ro == 1) { ?>
                                      <a href="#" class="btn red btn-with-icon btn-block">Pengajuan RO ditolak</a>
                                    <?php } elseif($result->status_ro == 2) { ?>
                                      <a href="#modalpengajuan" class="btn gradient-45deg-light-blue-cyan btn-with-icon btn-block rounded-5 modal-trigger"><i class="far fa-file-alt"></i> Tambah Pengajuan Operasional</a>
                                    <?php } ?>
                                    </center>
                                <?php } ?>
                                <div id="modalpengajuan" class="modal">
                                  <?php echo form_open_multipart('pejabat_teknis/input_pengajuan');?>
                                    <div class="modal-content">
                                        <h4>Data Pengajuan Operasional</h4>
                                            <div class="row">
                                                <div class="input-field col s12">
                                                  <input id="termin" type="text" name="id_kontrak" value="<?php echo $result->id_kontrak; ?>" hidden>
                                                    <select name="id_ro">
                                                        <option value="" disabled selected>Pilih Rencana Operasional</option>
                                                        <?php foreach ($result_ro as $a) { ?>
                                                          <option value="<?php echo $a->id_ro; ?>"><?php echo $a->kode."  ".$a->nama_akun." - ".$a->nama_kegiatan; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                              </div>
                                            <div class="row">
                                                <div class="input-field col s12">
                                                    <input id="a6" type="number" name="jumlah" maxlength="20" required>
                                                    <label for="a9">Jumlah</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="input-field col s12">
                                                    <input id="a7" type="text" name="keterangan" required>
                                                    <label for="a9">Keterangan</label>
                                                </div>
                                            </div>
                                            File Pendukung
                                            <div class="row">
                                                <div class="input-field col s12">
                                                    <input id="a9" type="file" name="file" required>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="input-field col s12">
                                                    <button class="btn cyan waves-effect waves-light left" type="submit" name="action" onclick="javascript: return confirm('Yakin akan menyimpan data ?')">Simpan</button>
                                                </div>
                                            </div>
                                      </div>
                                  </form>
                                </div>
                                <?php foreach ($result_pengajuan as $a) { ?>
                                <?php $hasil = $this->db->query("SELECT *,p.keterangan AS keterangan_pengajuan FROM pengajuan AS p INNER JOIN rencana_operasional AS ro ON p.id_ro = ro.id_ro INNER JOIN akun AS a ON ro.akun = a.id_akun INNER JOIN kegiatan AS k ON ro.id_kegiatan = k.id_kegiatan WHERE p.id_pengajuan = $a->id_pengajuan")->row(); ?>
                                <div id="modalpengajuanedit<?php echo $a->id_pengajuan;?>" class="modal">
                                  <?php echo form_open_multipart('pejabat_teknis/edit_pengajuan');?>
                                    <div class="modal-content">
                                        <h4>Data Pengajuan Operasional</h4>
                                            <div class="row">
                                                <div class="input-field col s12">
                                                  <input id="id_pengajuan" type="text" name="id_pengajuan" value="<?php echo $hasil->id_pengajuan; ?>" hidden>
                                                  <input id="id_kontrak" type="text" name="id_kontrak" value="<?php echo $result->id_kontrak; ?>" hidden>
                                                    <select name="id_ro">
                                                        <option value="<?php echo $hasil->id_ro; ?>" selected><?php echo $hasil->kode."  ".$hasil->nama_akun." - ".$hasil->nama_kegiatan; ?></option>
                                                        <?php $result_ro_not = $this->db->query("SELECT * FROM rencana_operasional INNER JOIN akun ON rencana_operasional.akun = akun.id_akun INNER JOIN kegiatan ON rencana_operasional.id_kegiatan = kegiatan.id_kegiatan WHERE rencana_operasional.id_kontrak = $result->id_kontrak AND rencana_operasional.akun <> $hasil->id_akun")->result(); ?>
                                                        <?php foreach ($result_ro_not as $a) { ?>
                                                          <option value="<?php echo $a->id_ro; ?>"><?php echo $a->kode."  ".$a->nama_akun." - ".$a->nama_kegiatan; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                              </div>
                                            <div class="row">
                                                <div class="input-field col s12">
                                                    <input id="a6" type="number" name="jumlah" maxlength="20" value="<?php echo $hasil->jumlah; ?>" required>
                                                    <label for="a9">Jumlah</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="input-field col s12">
                                                    <input id="a7" type="text" name="keterangan" maxlength="100" value="<?php echo $hasil->keterangan_pengajuan; ?>" required>
                                                    <label for="a9">Keterangan</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="input-field col s12">
                                                    <button class="btn cyan waves-effect waves-light left" type="submit" name="action" onclick="javascript: return confirm('Yakin akan menyimpan data ?')">Simpan</button>
                                                </div>
                                            </div>
                                      </div>
                                  </form>
                                </div>
                              <?php } ?>
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
</div>
