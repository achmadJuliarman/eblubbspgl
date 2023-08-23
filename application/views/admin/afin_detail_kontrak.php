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
                                      <?php } ?>
                                      <?php if($kategori == 1) { ?>
                                        <a href="#modaltambah" class="btn red btn-with-icon modal-trigger"><i class="far fa-file-alt"></i> Upload File</a>
                                      <?php } ?>
                                  </td>
                                </tr>
                                <tr>
                                  <td>
                                    Riwayat Adendum :
                                    <?php $adendum = $this->db->query("SELECT * FROM adendum WHERE id_kontrak = $result->id_kontrak")->result(); ?>
                                    <?php foreach($adendum AS $a) { ?>
                                      <li><?php echo $a->tgl_adendum." -- ".$a->keterangan_adendum;?></li><br>
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

    <div id="modaltambah" class="modal">
        <div class="modal-content">
            <h4>Upload File Kontrak</h4>
            <?php echo form_open_multipart('afin/upload');?>
              <input type="text" class="form-control" name="id_kontrak" hidden value="<?php echo $result->id_kontrak;?>">
              <div class="file-field input-field">
                  <div class="btn blue darken-1">
                      <span>Upload File Kontrak</span>
                      <input type="file" name="file">
                  </div>
                  <div class="file-path-wrapper">
                      <input class="file-path validate" type="text">
                      <p>File .pdf maksimal 20Mb</p>
                  </div>
              </div>
              <button type="submit" class="btn btn-success">Simpan</button>
              </form>
          </div>
    </div>
