<div class="container-fluid">
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <h4 class="card-title">Daftar PO</h4>
                    <h6 class="card-subtitle">You have <?php echo $jumlah; ?> PO</h6>
                    <table id="demo-foo-addrow2" class="table table-bordered table-hover toggle-circle" data-page-size="10">
                      <thead>
                        <tr>
                          <th width="5%" data-sort-ignore="true"><center>No.</center></th>
                          <th width="30%">Nomor PO / Judul PO</th>
                          <!-- <th width="10%">Keterangan</th> -->
                          <th width="15%">Tgl Realisasi</th>
                          <th width="15%">Realisasi</th>
                          <th width="40%" data-sort-ignore="true"><center>Action</center></th>
                        </tr>
                      </thead>
                      <div class="m-t-40">
                          <div class="d-flex">
                              <div class="mr-auto">
                                  <div class="form-group">
                                      <a href="<?php echo base_url();?>bendahara_penerimaan/input_po/<?php echo $kategori;?>" class="btn btn-medium"><i class="icon wb-plus" aria-hidden="true"></i> <i class="far fa-file-alt"></i> Tambah Data PO</a>
                                      <a href="<?php echo base_url();?>bendahara_penerimaan/cetak_rekap_po/<?php echo $kategori;?>" target="_blank" class="btn btn-medium green"><i class="icon wb-plus" aria-hidden="true"></i> <i class="fas fa-print"></i> Print Rekap PO</a>
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
                              <?php echo $a->nama_perusahaan; ?><br>
                              <span class="label label-table label-warning"><?php echo $a->no_invoice; ?></span>&nbsp;<span class="label label-table label-danger"><?php echo "Rp.".number_format($a->nilai_kontrak).",-"; ?></span>&nbsp;<span class="label label-table label-info"><?php echo $this->format_tanggal->jin_date_str($a->tanggal); ?></span>
                              <br>
                            </td>
                            <!-- <td><?php echo $a->keterangan; ?></span></td> -->
                            <td><?php echo $this->format_tanggal->jin_date_str($a->tgl_pembayaran); ?></td>
                            <td><?php echo "Rp.".number_format($a->jumlah_realisasi).",-"; ?></span></td>
                            <td>
                              <center>
                              <?php if($a->status_realisasi == 0) { ?>
                                <a href="<?php echo base_url();?>bendahara_penerimaan/preview_po/<?php echo $kategori;?>/<?php echo $a->id_kontrak;?>" class="btn btn-small blue btn-outline tooltipped" data-position="top" data-delay="50" data-tooltip="Preview"><i class="fas fa-eye"></i></a>
                                <a href="<?php echo base_url();?>bendahara_penerimaan/edit_po/<?php echo $a->id_termin;?>/<?php echo $a->id_kontrak;?>/<?php echo $kategori;?>" class="btn btn-small orange btn-outline tooltipped" data-position="top" data-delay="50" data-tooltip="Edit PO"><i class="fas fa-edit"></i></a>
                                <a href="<?php echo base_url();?>bendahara_penerimaan/hapus_po/<?php echo $a->id_termin;?>/<?php echo $a->id_kontrak;?>/<?php echo $kategori;?>" class="btn btn-small red btn-outline tooltipped" data-position="top" data-delay="50" data-tooltip="Hapus PO" onclick="javascript: return confirm('Yakin akan menghapus PO ?')"><i class="fas fa-trash"></i></a>
                                <?php if ($a->status_cetak_invoice == 0) { ?>
                                  <a href="<?php echo base_url();?>bendahara_penerimaan/cetak_invoice_po/<?php echo $a->id_termin;?>/<?php echo $kategori;?>" class="btn btn-small red btn-outline tooltipped" data-position="top" data-delay="50" data-tooltip="Create Invoice" onclick="javascript: return confirm('Yakin akan mencetak invoice ?')"><i class="fas fa-print"></i></a>
                                <?php } else { ?>
                                  <a href="<?php echo base_url();?>bendahara_penerimaan/preview_cetak_invoice_po/<?php echo $a->id_termin;?>/<?php echo $kategori;?>" class="btn btn-small green btn-outline tooltipped" data-position="top" data-delay="50" data-tooltip="Print Invoice" target="_blank"><i class="fas fa-print"></i></a>
                                <?php } if($a->status_cetak_invoice == 1 && $a->status_pembayaran == 0) { ?>
                                  <a href="#modalrealisasi<?php echo $a->id_termin;?>" class="btn btn-small red btn-outline tooltipped modal-trigger" data-position="top" data-delay="50" data-tooltip="Input Pembayaran"><i class="fas fa-check-circle"></i></a>
                                <?php } ?>
                              <?php if($a->status_pembayaran == 1 && $a->status_cetak_kwitansi == NULL) { ?>
                                  <a href="#modalrealisasi<?php echo $a->id_termin;?>" class="btn btn-small green btn-outline tooltipped modal-trigger" data-position="top" data-delay="50" data-tooltip="Input Pembayaran"><i class="fas fa-check-circle"></i></a>
                                  <a href="<?php echo base_url();?>bendahara_penerimaan/cetak_kwitansi_po/<?php echo $a->id_termin;?>/<?php echo $kategori;?>" class="btn btn-small red btn-outline tooltipped" data-position="top" data-delay="50" data-tooltip="Create Kwitansi" onclick="javascript: return confirm('Yakin akan mencetak kwitansi ?')"><i class="fas fa-print"></i></a>
                                <?php } ?>
                              <?php if($a->status_pembayaran == 1 && $a->status_cetak_kwitansi == 1) { ?>
                                  <a href="#modalrealisasi<?php echo $a->id_termin;?>" class="btn btn-small green btn-outline tooltipped modal-trigger" data-position="top" data-delay="50" data-tooltip="Input Pembayaran"><i class="fas fa-check-circle"></i></a>
                                  <a href="<?php echo base_url();?>bendahara_penerimaan/preview_cetak_kwitansi_po/<?php echo $a->id_termin;?>/<?php echo $kategori;?>" class="btn btn-small green btn-outline tooltipped" data-position="top" data-delay="50" data-tooltip="Print Kwitansi" target="_blank"><i class="fas fa-print"></i></a>
                                  <a href="<?php echo base_url();?>bendahara_penerimaan/pindah_operasional/<?php echo $a->id_termin;?>/<?php echo $kategori; ?>" class="btn btn-small green btn-outline tooltipped" data-position="top" data-delay="50" data-tooltip="Pindah Operasional" onclick="javascript: return confirm('Yakin pindah operasional ?')"><i class="fas fa-exchange-alt"></i></a>
                              <?php } ?>
                            <?php } else { ?>
                                  <a href="<?php echo base_url();?>bendahara_penerimaan/preview_po/<?php echo $kategori;?>/<?php echo $a->id_kontrak;?>" class="btn btn-small blue btn-outline tooltipped" data-position="top" data-delay="50" data-tooltip="Preview"><i class="fas fa-eye"></i></a>
                                  <a href="#" class="btn btn-small green btn-outline"><i class="fas fa-check-circle"></i> Realisasi</a>
                            <?php } ?>
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
            <?php foreach ($result as $a) { ?>
              <div id="modalrealisasi<?php echo $a->id_termin; ?>" class="modal">
                  <div class="modal-content">
                      <h4>Data Pembayaran</h4>
                      <p>
                        Nomor PO : <b><?php echo $a->no_invoice; ?></b><br>
                        Tanggal PO : <b><?php echo $this->format_tanggal->jin_date_str($a->tgl_akhir); ?></b><br>
                        Client : <b><?php echo $a->nama_perusahaan; ?></b><br>
                        Jumlah : <b><?php echo "Rp.".number_format($a->nilai_kontrak).",-"; ?></b>
                      </p>
                        <?php echo form_open_multipart('bendahara_penerimaan/input_realisasi_po');?>
                          <div class="row">
                              <div class="input-field col s12">
                                <input id="id_kontrak" type="text" name ="id_kontrak" value="<?php echo $a->id_kontrak; ?>" hidden>
                                <input id="id_termin" type="text" name ="id_termin" value="<?php echo $a->id_termin; ?>" hidden>
                                <input id="kategori" type="text" name ="kategori" value="<?php echo $kategori; ?>" hidden>
                                  <select name="id_penerimaan" required>
                                      <option value="" disabled selected>Pilih Akun Penerimaan</option>
                                      <?php foreach ($result_penerimaan as $a) { ?>
                                        <option value="<?php echo $a->id_akun; ?>"><?php echo $a->kode." - ".$a->nama_akun; ?></option>
                                      <?php } ?>
                                  </select>
                              </div>
                          </div>
                          <div class="row">
                              <div class="input-field col s12">
                                <input id="a9" type="date" name = "tgl_pembayaran" required>
                                <label for="a9">Tanggal Pembayaran</label>
                              </div>
                          </div>
                          <?php if ($kategori == 1) { ?>
                          <!--<div class="row">
                              <div class="input-field col s4">
                                <input id="no_lab" type="text" name = "no_lab" required>
                                <label for="no_lab">Nomor Lab</label>
                              </div>-->
                              <div class="input-field col s4">
                                <input id="no_sertifikat" type="text" name = "no_sertifikat" required>
                                <label for="no_sertifikat">Nomor Sertifikat</label>
                              </div>
                              <div class="input-field col s4">
                                <input id="tgl_sertifikat" type="date" name = "tgl_sertifikat" required>
                                <label for="tgl_sertifikat">Tanggal Sertifikat</label>
                              </div>
                          </div>
                          <?php } ?>
                          <div class="row">
                              <div class="input-field col s12">
                                <input id="jumlah_realisasi" type="number" name = "jumlah_realisasi" min="1" required>
                                <label for="jumlah_realisasi">Jumlah Realisasi</label>
                              </div>
                          </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <button class="btn cyan waves-effect waves-light left" type="submit" name="action" onclick="javascript: return confirm('Yakin akan menyimpan data ?')">Simpan</button>
                            </div>
                        </div>
                      </form>
                    </div>
              </div>
            <?php } ?>
        </div>
    </div>
</div>
