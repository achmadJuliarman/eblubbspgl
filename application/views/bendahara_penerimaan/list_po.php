<div id="main">
      <div class="row">
        <div class="col s12">
            <div class="container">
                <div class="section section-data-tables">
                  <div class="card">
                      <div class="card-content">
                          <!-- <h4 class="card-title">Daftar Kontrak</h4> -->
                          <a href="<?php echo base_url();?>bendahara_penerimaan/input_po/<?php echo $kategori;?>" class="btn mb-1 waves-effect waves-light gradient-45deg-light-blue-cyan mr-1">Tambah Data<i class="material-icons left">add_circle</i></a>
                          <a href="<?php echo base_url();?>bendahara_penerimaan/cetak_rekap_po/<?php echo $kategori;?>" target="_blank" class="btn mb-1 waves-effect waves-light green mr-1">Print Rekap PO<i class="material-icons left">print</i></a>
                          <br>
                          <div class="row">
                              <div class="col s12">
                                <table id="example" class="display table table-bordered" cellspacing="0" width="100%">
                                      <thead>
                                          <tr>
                                            <th width="5%" style="text-align:center;">No.</th>
                                            <th  style="text-align:center;">Judul PO</th>
                                            <th  style="text-align:center;">Tgl Realisasi</th>
                                            <th  style="text-align:center;">Realisasi</th>
                                            <th  style="text-align:center;">Action</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                        <?php $no=1; foreach($result AS $a) { ?>
                                          <tr>
                                            <td style="text-align:center;"><?php echo $no; ?></td>
                                            <td>
                                              <?php echo $a->nama_perusahaan; ?><br>
                                              <span class="badge gradient-45deg-light-blue-cyan" style="font-size: 11px;"><?php echo $a->no_invoice; ?></span>&nbsp;<span class="badge orange" style="font-size: 11px;"><?php echo "Rp.".number_format($a->nilai_kontrak).",-"; ?></span>&nbsp;<span class="badge red" style="font-size: 11px;"><?php echo $this->format_tanggal->jin_date_str($a->tanggal); ?></span>
                                              <br>
                                            </td>
                                            <!-- <td><?php echo $a->keterangan; ?></span></td> -->
                                            <td style="text-align:center;"><?php echo $this->format_tanggal->jin_date_str($a->tgl_pembayaran); ?></td>
                                            <td style="text-align:center;"><?php echo "Rp.".number_format($a->jumlah_realisasi).",-"; ?></span></td>
                                            <td style="text-align:center;">
                                              <a href="<?php echo base_url();?>bendahara_penerimaan/detail_kontrak/<?php echo $a->id_kontrak;?>" class="btn-floating blue tooltipped" data-position="top" data-tooltip="Preview"><i class="material-icons right">remove_red_eye</i></a>
                                              <?php if($a->status_realisasi == 0) { ?>
                                                <!-- <a href="<?php echo base_url();?>bendahara_penerimaan/preview_po/<?php echo $kategori;?>/<?php echo $a->id_kontrak;?>" class="btn btn-small blue btn-outline tooltipped" data-position="top" data-delay="50" data-tooltip="Preview"><i class="fas fa-eye"></i></a> -->
                                                <a href="<?php echo base_url();?>bendahara_penerimaan/edit_po/<?php echo $a->id_termin;?>/<?php echo $a->id_kontrak;?>/<?php echo $kategori;?>" class="btn-floating orange mb-1 waves-effect waves-light tooltipped" data-position="top" data-tooltip="Edit PO"><i class="material-icons dp48">edit</i></a>
                                                <a href="<?php echo base_url();?>bendahara_penerimaan/hapus_po/<?php echo $a->id_termin;?>/<?php echo $a->id_kontrak;?>/<?php echo $kategori;?>" class="btn-floating red mb-1 waves-effect waves-light tooltipped" data-position="top" data-tooltip="Hapus PO" onclick="javascript: return confirm('Yakin akan menghapus PO ?')"><i class="material-icons dp48">delete</i></a>
                                                <?php if ($a->status_cetak_invoice == 0) { ?>
                                                  <a href="<?php echo base_url();?>bendahara_penerimaan/cetak_invoice_po/<?php echo $a->id_termin;?>/<?php echo $kategori;?>" class="btn-floating red mb-1 waves-effect waves-light tooltipped" data-position="top" data-tooltip="Buat Invoice" onclick="javascript: return confirm('Yakin akan mencetak invoice ?')"><i class="material-icons dp48">print</i></a>
                                                <?php } else { ?>
                                                  <a href="<?php echo base_url();?>bendahara_penerimaan/preview_cetak_invoice_po/<?php echo $a->id_termin;?>/<?php echo $kategori;?>" class="btn-floating red mb-1 waves-effect waves-light tooltipped" data-position="top" data-tooltip="Cetak Invoice" target="_blank"><i class="material-icons dp48">print</i></a>
                                                <?php } if($a->status_cetak_invoice == 1 && $a->status_pembayaran == 0) { ?>
                                                  <a href="#modalrealisasi<?php echo $a->id_termin;?>" class="btn-floating blue mb-1 waves-effect waves-light tooltipped modal-trigger" data-position="top" data-tooltip="Input Pembayaran"><i class="material-icons dp48">info</i></a>
                                                <?php } ?>
                                              <?php if($a->status_pembayaran == 1 && $a->status_cetak_kwitansi == NULL) { ?>
                                                  <a href="#modalrealisasi<?php echo $a->id_termin;?>" class="btn-floating green mb-1 waves-effect waves-light tooltipped modal-trigger" data-position="top" data-tooltip="Input Pembayaran"><i class="material-icons dp48">info</i></a>
                                                  <a href="<?php echo base_url();?>bendahara_penerimaan/cetak_kwitansi_po/<?php echo $a->id_termin;?>/<?php echo $kategori;?>" class="btn-floating red mb-1 waves-effect waves-light tooltipped" data-position="top" data-tooltip="Buat Kuitansi" onclick="javascript: return confirm('Yakin akan mencetak kuitansi ?')"><i class="material-icons dp48">print</i></a>
                                                <?php } ?>
                                              <?php if($a->status_pembayaran == 1 && $a->status_cetak_kwitansi == 1) { ?>
                                                  <a href="#modalrealisasi<?php echo $a->id_termin;?>" class="btn-floating green mb-1 waves-effect waves-light tooltipped modal-trigger" data-position="top" data-tooltip="Input Pembayaran"><i class="material-icons dp48">info</i></a>
                                                  <a href="<?php echo base_url();?>bendahara_penerimaan/preview_cetak_kwitansi_po/<?php echo $a->id_termin;?>/<?php echo $kategori;?>" class="btn-floating green mb-1 waves-effect waves-light tooltipped" data-position="top" data-tooltip="Print Kuitansi" target="_blank"><i class="material-icons dp48">print</i></a>
                                                  <a href="<?php echo base_url();?>bendahara_penerimaan/pindah_operasional/<?php echo $a->id_termin;?>/<?php echo $kategori; ?>" class="btn-floating blue mb-1 waves-effect waves-light tooltipped" data-position="top" data-tooltip="Pindah Operasional" onclick="javascript: return confirm('Yakin pindah operasional ?')"><i class="material-icons dp48">forward</i></a>
                                              <?php } ?>
                                            <?php } elseif($a->tgl_operasional =! NULL) { ?>
                                                  <!-- <a href="<?php echo base_url();?>bendahara_penerimaan/preview_po/<?php echo $kategori;?>/<?php echo $a->id_kontrak;?>" class="btn-floating blue mb-1 waves-effect waves-light tooltipped" data-position="top" data-delay="50" data-tooltip="Preview"><i class="material-icons dp48">preview</i></a> -->
                                                  <a href="#" class="btn-floating green mb-1 waves-effect waves-light tooltipped" data-position="top" data-tooltip="Realisasi"><i class="material-icons dp48">check</i></a>
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
            <?php foreach ($result as $a) { ?>
              <div id="modalrealisasi<?php echo $a->id_termin; ?>" class="modal">
                  <div class="modal-content">
                      <h4>Data Pembayaran</h4>
                      <p>
                        Nomor PO : <b><?php echo $a->no_invoice; ?></b><br>
                        Tanggal PO : <b><?php echo $this->format_tanggal->jin_date_str($a->tanggal); ?></b><br>
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
                          <div class="row">
                              <!-- <div class="input-field col s4">
                                <input id="no_lab" type="text" name = "no_lab" required>
                                <label for="no_lab">Nomor Lab</label>
                              </div> -->
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
