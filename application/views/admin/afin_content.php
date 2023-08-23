 <div class="container-fluid">
  <div class="row">
    <a href="<?php echo base_url(); ?>afin">
      <div class="col l4 m8 s12">
          <div class="card success-gradient card-hover">
            <div class="card-content">
                <div class="d-flex no-block align-items-center">
                    <div>
                        <h4 class="white-text m-b-5"><?php echo $jumlah_kontrak; ?></h4>
                        <h6 class="white-text op-5">JUMLAH KONTRAK</h6>
                    </div>
                    <div class="ml-auto">
                      <span class="white-text display-6"><i class="material-icons">equalizer</i></span>
                    </div>
                </div>
            </div>
          </div>
      </div>
    </a>
    <a href="<?php echo base_url(); ?>afin/adendum">
      <div class="col l4 m8 s12">
          <div class="card success-gradient card-hover">
            <div class="card-content">
                <div class="d-flex no-block align-items-center">
                    <div>
                        <h4 class="white-text m-b-5"><?php echo $adendum; ?></h4>
                        <h6 class="white-text op-5 text-darken-2">KONTRAK ADENDUM</h6>
                    </div>
                    <div class="ml-auto">
                        <span class="white-text display-6"><i class="material-icons">equalizer</i></span>
                    </div>
                </div>
            </div>
          </div>
      </div>
    </a>
    <a href="<?php echo base_url(); ?>afin/expired">
      <div class="col l4 m8 s12">
          <div class="card warning-gradient card-hover">
              <div class="card-content">
                  <div class="d-flex no-block align-items-center">
                      <div>
                          <h4 class="white-text m-b-5"><?php echo $expired; ?></h4>
                          <h6 class="white-text op-5">KONTRAK YANG BERAKHIR BULAN INI</h6>
                      </div>
                      <div class="ml-auto">
                        <span class="white-text display-6"><i class="material-icons">equalizer</i></span>
                      </div>
                  </div>
              </div>
          </div>
      </div>
    </a>
  </div>
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <h4 class="card-title">Daftar Kontrak</h4>
                    <h6 class="card-subtitle">You have <?php echo $jumlah; ?> Contract</h6>
                    <table id="demo-foo-addrow2" class="table table-bordered table-hover toggle-circle" data-page-size="10">
                      <thead>
                        <tr>
                          <th width="5%" data-sort-ignore="true"><center>No.</center></th>
                          <th width="35%">Judul kontrak</th>
                          <th width="15%">KP3</th>
                          <th width="15%">Tanggal Mulai</th>
                          <th width="15%">Tanggal Selesai</th>
                          <th width="20%" data-sort-ignore="true"><center>Action</center></th>
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
                            <td><?php echo $a->nama; ?></td>
                            <td><?php echo $this->format_tanggal->jin_date_str($a->tgl_mulai); ?></td>
                            <td><?php echo $this->format_tanggal->jin_date_str($a->tgl_akhir); ?></td>
                            <!-- <td><?php echo "Rp.".number_format($a->nilai_kontrak).",-"; ?></td> -->
                            <td>
                              <center>
                                <?php if ($kategori == 2 || $kategori == 3) { ?>
                                <a href="<?php echo base_url();?>program/setting_kontrak/<?php echo $a->id_kontrak;?>" class="btn btn-small cyan btn-outline tooltipped" data-position="top" data-delay="50" data-tooltip="Setting Kontrak"><i class="fas fa-cog"></i></a>
                              <?php } else { ?>
                                <a href="<?php echo base_url();?>afin/adendum_kontrak/<?php echo $a->id_kontrak;?>" class="btn btn-small blue btn-outline tooltipped" data-position="top" data-delay="50" data-tooltip="Adendum Kontrak"><i class="far fa-file-alt"></i></a>
                                <a href="<?php echo base_url();?>afin/pilih_kontrak/<?php echo $a->id_kontrak;?>" class="btn btn-small green btn-outline tooltipped" data-position="top" data-delay="50" data-tooltip="Edit Kontrak"><i class="far fa-edit"></i></a>
                                <?php $cek_kegiatan = $this->db->query("SELECT * FROM kegiatan WHERE id_kontrak = $a->id_kontrak;")->num_rows(); ?>
                                <?php $cek_ro = $this->db->query("SELECT * FROM rencana_operasional WHERE id_kontrak = $a->id_kontrak;")->num_rows(); ?>
                                <?php if($cek_kegiatan == 0 && $cek_ro == 0) { ?>
                                <a href="<?php echo base_url();?>afin/hapus_kontrak/<?php echo $a->id_kontrak;?>" class="btn btn-small red btn-outline tooltipped" data-position="top" data-delay="50" data-tooltip="Hapus Kontrak" onclick="javascript: return confirm('Yakin akan menghapus data ?')"><i class="fas fa-trash"></i></a>
                              <?php } } ?>
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
