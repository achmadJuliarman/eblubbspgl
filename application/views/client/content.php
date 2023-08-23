<div id="main">
      <div class="row">
        <div class="col s12">
            <div class="container">
                <div class="section section-data-tables">
                  <div class="card">
                      <div class="card-content">
                          <h4 class="card-title">Daftar Client</h4>
                          <a href="<?php echo base_url();?>perusahaan/add_perusahaan" class="btn mb-1 waves-effect waves-light gradient-45deg-light-blue-cyan mr-1">Tambah Data<i class="material-icons left">add_circle</i></a>
                          <div class="row">
                              <div class="col s12">
                                <table id="example" class="display table table-bordered" cellspacing="0" width="100%">
                                      <thead>
                                          <tr>
                                            <th width="5%" style="text-align:center;">No.</th>
                                            <th width="30%" style="text-align:center;">Nama Perusahaan</th>
                                            <th width="40%" style="text-align:center;">Alamat Perusahaan</th>
                                            <th width="15%"style="text-align:center;">Penanggung Jawab</th>
                                            <th width="10%" style="text-align:center;">Action</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                        <?php $no=1; foreach($result AS $a) { ?>
                                          <tr>
                                            <td style="text-align:center;"><?= $no ?></td>
                                            <td>
                                              <b><?php echo $a->nama_perusahaan; ?></b><br>
                                              <?php echo "NPWP : ".$a->npwp; ?><br>
                                              <span class="badge green" style="font-size: 11px;">No. Telpon : <?php echo $a->no_telp; ?></span><br>
                                            </td>
                                            <td><?php echo $a->alamat; ?></td>
                                            <td><?php echo $a->penanggung_jawab; ?></td>
                                            <td style="text-align:center;">
                                              <a href="<?php echo base_url();?>perusahaan/pilih_perusahaan/<?php echo $a->id_perusahaan;?>" class="btn-floating green mb-1 waves-effect waves-light tooltipped" data-position="top" data-tooltip="Edit"><i class="material-icons dp48">edit</i></a>
                                              <?php $cek_client = $this->db->query("SELECT * FROM kontrak WHERE id_perusahaan = $a->id_perusahaan;")->num_rows(); ?>
                                              <?php if($cek_client == 0) { ?>
                                              <a href="<?php echo base_url();?>perusahaan/hapus_perusahaan/<?php echo $a->id_perusahaan;?>" class="btn-floating red mb-1 waves-effect waves-light tooltipped" onclick="javascript: return confirm('Yakin akan menghapus data ?')" data-position="top" data-tooltip="Hapus"><i class="material-icons dp48">delete</i></a>
                                              <?php } ?>
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
