<div class="container-fluid">
  <div class="row">
    <div class="col s12">
      <div class="card">
        <div class="card-content">
          <div class="d-flex align-items-center">
            <div>
              <h4 class="card-title">DETAIL KONTRAK</h4>
              <small>Judul Kontrak </small>
              <h6><?php echo $result->nama_kontrak; ?></h6>
              <small>Pelaksana Layanan </small>
              <h6><?php echo $result->rumah_layanan; ?></h6>
              <small>Pejabat Teknis </small>
              <h6><?php echo $result->pejabat_teknis; ?></h6>
              <small>Nilai Kontrak</small>
              <h6><?php echo "Rp. " . number_format($result->nilai_kontrak, 0, '', '.') . ",-"; ?></h6>
              <small>Tanggal Pelaksanaan</small>
              <h6><?php echo $result->tgl_mulai . " s/d " . $result->tgl_akhir; ?></h6>
              <small>Jumlah Termin</small>
              <h6><?php echo $result->termin; ?></h6>
            </div>
          </div>
          <div class="table-responsive m-b-20">

            <table class="table table-bordered table-hover toggle-circle">
              <thead>
                <tr>
                  <th>Keterangan</th>
                  <th>Tanggal</th>
                  <th>Nilai Kontrak</th>
                  <th>Invoice</th>
                  <th>Realisasi Pendapatan</th>
                  <th>Realisasi Belanja</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($result_termin as $a) { ?>
                  <tr>
                    <?php $keterangan = $this->db->query("SELECT * FROM penagihan WHERE id_termin=$a->id_termin ORDER BY keterangan DESC LIMIT 1")->row(); ?>
                    <td>
                      Termin ke-<?php echo $a->termin; ?> <br>
                      <?php if ($a->jumlah_penagihan > 0) { ?>
                        <?php if ($a->jumlah_penagihan = 4) { ?>


                        <?php } else { ?>
                          <span class="label label-table label-warning">Surat Penagihan ke-<?php echo $keterangan->keterangan . " (" . $keterangan->tgl_termin . ")"; ?></span>
                        <?php } ?>
                      <?php } ?>
                    </td>
                    <td><?php echo $this->format_tanggal->jin_date_str($a->tgl_termin); ?></td>
                    <td><?php echo "Rp. " . number_format($a->jumlah, 0, '', '.') . ",-"; ?></td>
                    <td>
                      <?php if ($a->tgl_invoice != '0000-00-00') { ?> <span class="label label-table label-info"> <?php echo $a->tgl_invoice; ?> </span> <?php } ?><br>
                      <?php if ($a->status_cetak_invoice == 1 && $a->status_realisasi == 0) {
                        echo "Rp. " . number_format($a->jumlah, 0, '', '.') . ",-";
                      } else {
                        echo "-";
                      } ?>
                    </td>
                    <td>
                      <?php if ($a->tgl_pembayaran != '0000-00-00') { ?> <span class="label label-table label-success"> <?php echo $a->tgl_pembayaran; ?> </span> <?php } ?> <br>
                      <?php if ($a->status_cetak_invoice == 1 && $a->status_realisasi == 1) {
                        echo "Rp. " . number_format($a->jumlah, 0, '', '.') . ",-";
                      } else {
                        echo "-";
                      } ?></td>
                    <td>-</td>
                  </tr>
                <?php } ?>
                <?php foreach ($result_pengajuan as $a) { ?>
                  <tr>
                    <td>
                      <?php echo $a->kode . " " . $a->nama_akun; ?><br>
                      <?php echo $a->keterangan; ?>
                    </td>
                    <td><?php echo $this->format_tanggal->jin_date_str($a->tgl_pengajuan); ?></td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td><?php echo "Rp. " . number_format($a->jumlah, 0, '', '.') . ",-"; ?></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>