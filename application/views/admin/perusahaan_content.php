                <div class="container-fluid">
                    <div class="row">
                        <div class="col s12">
                            <div class="card">
                                <div class="card-content">
                                    <h4 class="card-title">Daftar Client</h4>
                                    <h6 class="card-subtitle">You have <?php echo $jumlah; ?> Client</h6>
                                    <table id="demo-foo-addrow2" class="table table-bordered table-hover toggle-circle" data-page-size="10">
                                      <thead>
                                          <tr>
                                            <th width="5%" data-sort-ignore="true"><center>No.</center></th>
                                            <th width="50%">Nama Perusahaan</th>
                                            <th width="25%" data-sort-ignore="true"><center>Penanggung Jawab</center></th>
                                            <th width="20%" data-sort-ignore="true"><center>Action</center></th>
                                          </tr>
                                      </thead>
                                      <div class="m-t-40">
                                          <div class="d-flex">
                                              <div class="mr-auto">
                                                  <div class="form-group">
                                                    <a href="<?php echo base_url();?>perusahaan/add_perusahaan" class="btn btn-medium"><i class="icon wb-plus" aria-hidden="true"></i> <i class="far fa-file-alt"></i> Tambah Data Client</a>
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
                                            <td><center><?= $no ?></center></td>
                                            <td>
                                              <b><?php echo $a->nama_perusahaan; ?></b><br/>
                                              <?php echo $a->alamat; ?><br/>
                                              <?php echo "NPWP : ".$a->npwp; ?><br/>
                                              <?php echo $a->no_telp; ?><br/>
                                            </td>
                                            <td>
                                              <center><?php echo $a->penanggung_jawab; ?></center>
                                            </td>
                                            <td>
                                              <center>
                                              <a href="<?php echo base_url();?>perusahaan/pilih_perusahaan/<?php echo $a->id_perusahaan;?>" class="btn btn-small green btn-outline tooltipped" data-position="top" data-delay="50" data-tooltip="Edit Perusahaaan"><i class="far fa-file-alt"></i></a>
                                              <a href="<?php echo base_url();?>perusahaan/hapus_perusahaan/<?php echo $a->id_perusahaan;?>" class="btn btn-small red btn-outline tooltipped" data-position="top" data-delay="50" data-tooltip="Hapus Perusahaan" onclick="javascript: return confirm('Yakin akan menghapus data ?')"><i class="fas fa-trash"></i></a>
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
