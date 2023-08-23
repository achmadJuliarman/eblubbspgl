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
                                <!-- <tr>
                                  <td>
                                    <b>PIC</b><br/>
                                    <?php echo $result->pic; ?>
                                  </td>
                                </tr> -->
                                <tr>
                                  <td>
                                    <b>Tanggal Tanda Tangan</b><br/>
                                    <?php echo $result->tgl_ttd; ?>
                                  </td>
                                </tr>
                                <!-- <tr>
                                  <td>
                                    <b>Tanggal Pelaksanaan</b><br/>
                                    <?php echo $result->tgl_mulai." s/d ".$result->tgl_akhir; ?>
                                  </td>
                                </tr> -->
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
                                      <a class="btn btn-success waves-effect waves-light m-b-5" href="<?php echo base_url();?>/uploads/<?php echo $result->file;?>" target="_blank"><?php echo $result->file;?></a>
                                    <?php } elseif($result->file == NULL) { ?>
                                      Belum ada
                                    <?php } ?>
                                  </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
