<div id="main">
      <div class="row">
        <div class="col s12">
            <div class="container">
                <div class="section section-data-tables">
                  <div id="card-stats" class="pt-0">
                      <div class="row">
                          <a href="<?php echo base_url(); ?>afin">
                          <div class="col s12 m6 l4">
                              <div class="card animate fadeLeft">
                                  <div class="card-content cyan white-text">
                                      <p class="card-stats-title">JUMLAH KONTRAK</p>
                                      <h4 class="card-stats-number white-text"><?php echo $jumlah_kontrak; ?></h4>
                                  </div>
                              </div>
                          </div>
                          </a>
                          <a href="<?php echo base_url(); ?>afin/adendum">
                          <div class="col s12 m6 l4">
                              <div class="card animate fadeLeft">
                                  <div class="card-content red accent-2 white-text">
                                      <p class="card-stats-title">JUMLAH KONTRAK ADENDUM</p>
                                      <h4 class="card-stats-number white-text"><?php echo $adendum; ?></h4>
                                  </div>
                              </div>
                          </div>
                          </a>
                          <a href="#">
                          <div class="col s12 m6 l4">
                              <div class="card animate fadeRight">
                                  <div class="card-content orange lighten-1 white-text">
                                      <p class="card-stats-title">KONTRAK BERAKHIR BULAN INI</p>
                                      <?php $jumlah = 0; foreach($result AS $a) { ?>
                                      <?php if($a->selisih < 0 && $a->selisih > -31) { $jumlah = $jumlah+1; } } ?>
                                      <h4 class="card-stats-number white-text"><?php echo $jumlah; ?></h4>
                                  </div>
                              </div>
                          </div>
                          </a>
                      </div>
                  </div>
                  <!-- <div class="card-content">
                    <div class="row">
                      <div class="col s12">
                          <div class="card-panel gradient-45deg-light-blue-cyan" style="color: rgba(255, 255, 255, 0.901961);">
                            <span style="color: rgba(255, 255, 255, 0.901961);font-size:20px;"><center>Daftar Kontrak</center></span>
                          </div>
                      </div>
                    </div>
                  </div> -->
                  <div class="card">
                      <div class="card-content">
                          <!-- <h4 class="card-title">Daftar Kontrak</h4> -->
                          <a href="<?php echo base_url();?>afin/add_kontrak" class="btn mb-1 waves-effect waves-light gradient-45deg-light-blue-cyan mr-1">Tambah Data<i class="material-icons left">add_circle</i></a>
                          <a href="<?php echo base_url();?>afin/export" class="btn mb-1 waves-effect waves-light red mr-1">Export Kontrak<i class="material-icons left">cloud_download</i></a>
                          <div class="row">
                              <div class="col s12">
                                <table id="example" class="display table table-bordered" cellspacing="0" width="100%">
                                  <!-- <table id="page-length-option" class="responsive-table" width="100%"> -->
                                      <thead>
                                          <tr>
                                            <th style="text-align:center;" width="5%">No.</th>
                                            <th style="text-align:center;" width="50%">Judul kontrak</th>
                                            <th style="text-align:center;" width="10%">Tanggal Mulai</th>
                                            <th style="text-align:center;" width="10%">Tanggal Selesai</th>
                                            <th style="text-align:center;" width="15%">Action</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                        <?php $no=1; foreach($result AS $a) { ?>
                                          <tr>
                                            <td><center><?php echo $no; ?></center></td>
                                            <td style="font-size: 12px;">
                                              <?php if ($a->selisih < 0 && $a->selisih > -31) { ?>
                                                <span class="badge gradient-45deg-purple-deep-orange" style="font-size: 11px;">Berakhir H<?php echo ceil($a->selisih);?></span>
                                              <?php } ?>
                                              <b><a href="<?php echo base_url();?>afin/detail_kontrak/<?php echo $a->id_kontrak;?>"><?= $a->nama_kontrak ?></a></b>
                                              <br/>
                                              <span class="badge gradient-45deg-light-blue-cyan" style="font-size: 12px;"><?php echo $a->nama; ?></span>
                                              <br>
                                              <?php echo $a->no_kontrak; ?></strong> (Tanggal : <?php echo $a->tgl_ttd; ?>)
                                              <br/>
                                              <span class="badge orange" style="font-size: 12px;">PIC : <?php echo $a->nama_pic; ?></span>&nbsp;<span class="badge green" style="font-size: 12px;"><?php echo $a->nama_perusahaan; ?></span>&nbsp;<span class="badge red"><?php echo "Rp.".number_format($a->nilai_kontrak).",-"; ?></span>
                                            </td>
                                            <td style="text-align:center;"><?php echo $a->tgl_mulai; ?></td>
                                            <td style="text-align:center;"><?php echo $a->tgl_akhir; ?></td>
                                            <td style="text-align:center;">
                                                <?php if ($kategori == 2 || $kategori == 3) { ?>
                                                <a href="<?php echo base_url();?>program/setting_kontrak/<?php echo $a->id_kontrak;?>" class="btn-floating blue mb-1 waves-effect waves-light"><i class="material-icons dp48">settings</i></a>
                                              <?php } else { ?>
                                                <a href="<?php echo base_url();?>afin/adendum_kontrak/<?php echo $a->id_kontrak;?>" class="btn-floating blue mb-1 waves-effect waves-light tooltipped" data-position="top" data-tooltip="Adendum"><i class="material-icons dp48">settings</i></a>
                                                <a href="<?php echo base_url();?>afin/pilih_kontrak/<?php echo $a->id_kontrak;?>" class="btn-floating green mb-1 waves-effect waves-light tooltipped" data-position="top" data-tooltip="Edit"><i class="material-icons dp48">edit</i></a>
                                                <?php $cek_kegiatan = $this->db->query("SELECT * FROM kegiatan WHERE id_kontrak = $a->id_kontrak;")->num_rows(); ?>
                                                <?php $cek_ro = $this->db->query("SELECT * FROM rencana_operasional WHERE id_kontrak = $a->id_kontrak;")->num_rows(); ?>
                                                <?php if($cek_kegiatan == 0 && $cek_ro == 0) { ?>
                                                  <a href="<?php echo base_url();?>afin/hapus_kontrak/<?php echo $a->id_kontrak;?>" class="btn-floating red mb-1 waves-effect waves-light tooltipped" onclick="javascript: return confirm('Yakin akan menghapus data ?')" data-position="top" data-tooltip="Hapus"><i class="material-icons dp48">delete</i></a>
                                              <?php } } ?>
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
