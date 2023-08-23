    <div class="container-fluid">
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <h4 class="card-title">Detail PO Lab. Pengujian</h4>
                        <h6 class="card-subtitle"><?php echo $result->nama_kontrak; ?></h6>
                        <table>
                            <tbody>
                                <tr>
                                    <td>
                                      <b>Nilai PO</b><br/>
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
                                    <?php echo $result->jenis." - ".$result->nama_layanan; ?>
                                  </td>
                                </tr>
                                <tr>
                                  <td>
                                    <b>Nama Pelanggan</b><br/>
                                    <?php echo $result->nama_perusahaan; ?>
                                  </td>
                                </tr>
                                <tr>
                                  <td>
                                    <b>Tanggal PO</b><br/>
                                    <?php echo $this->format_tanggal->jin_date_str($result->tanggal); ?>
                                  </td>
                                </tr>
                                <tr>
                                  <td>
                                    <b>Nomor Laboratorium</b><br/>
                                    <?php echo $result->no_lab; ?>
                                  </td>
                                </tr>
                                <tr>
                                  <td>
                                    <b>Jumlah Sample</b><br/>
                                    <?php echo $result->jumlah_sample; ?>
                                  </td>
                                </tr>
                                <tr>
                                  <td>
                                    <b>Nomor Sertifikat</b><br/>
                                    <?php echo $result->no_sertifikat; ?>
                                  </td>
                                </tr>
                                <tr>
                                  <td>
                                    <b>Tanggal Sertifikat</b><br/>
                                    <?php echo $this->format_tanggal->jin_date_str($result->tgl_sertifikat); ?>
                                  </td>
                                </tr>
                                <tr>
                                  <td>
                                    <b>Nomor Invoice</b><br/>
                                    <?php echo $result->no_invoice; ?>
                                  </td>
                                </tr>
                                <tr>
                                  <td>
                                    <b>Tanggal Invoice</b><br/>
                                    <?php echo $this->format_tanggal->jin_date_str($result->tgl_termin); ?>
                                  </td>
                                </tr>
                                <tr>
                                  <td>
                                    <b>Nomor Kwitansi</b><br/>
                                    <?php echo $result->no_kwitansi; ?>
                                  </td>
                                </tr>
                                <tr>
                                  <td>
                                    <b>Keterangan</b><br/>
                                    <?php echo $result->keterangan; ?>
                                  </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
