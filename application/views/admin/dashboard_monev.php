<div class="container-fluid">
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <div class="d-flex align-items-center">
                        <div>
                            <h5 class="card-title">Detail Informasi</h5>
                            <h6 class="card-subtitle">Pengelolaan Keuangan BLU</h6>
                        </div>
                    </div>
                    <div class="table-responsive m-b-20">
                        <table class="">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Menu</th>
                                    <th><center>Tekmira</center></th>
                                    <th><center>P3GL</center></th>
                                    <th><center>P3TEK</center></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1.</td>
                                    <td>Menu Target</td>
                                    <?php $tahun = DATE("Y");?>
                                    <td class="blue-grey-text text-darken-4 font-medium"><center><?php $result=$this->db->query("SELECT COUNT(*) AS jumlah FROM target AS t INNER JOIN rumah_layanan AS rl ON t.id_rumah_layanan = rl.id_rumah_layanan WHERE rl.id_satker=1 AND t.tahun=$tahun")->row();echo $result->jumlah;?></center></td>
                                    <td class="blue-grey-text text-darken-4 font-medium"><center><?php $result=$this->db->query("SELECT COUNT(*) AS jumlah FROM target AS t INNER JOIN rumah_layanan AS rl ON t.id_rumah_layanan = rl.id_rumah_layanan WHERE rl.id_satker=2 AND t.tahun=$tahun")->row();echo $result->jumlah;?></center></td>
                                    <td class="blue-grey-text text-darken-4 font-medium"><center><?php $result=$this->db->query("SELECT COUNT(*) AS jumlah FROM target AS t INNER JOIN rumah_layanan AS rl ON t.id_rumah_layanan = rl.id_rumah_layanan WHERE rl.id_satker=3 AND t.tahun=$tahun")->row();echo $result->jumlah;?></center></td>
                                </tr>
                                <tr>
                                    <td>2.</td>
                                    <td>Menu Pelaksana Layanan</td>
                                    <td class="blue-grey-text text-darken-4 font-medium"><center><?php $result=$this->db->query("SELECT COUNT(*) AS jumlah FROM rumah_layanan WHERE id_satker=1")->row();echo $result->jumlah;?></center></td>
                                    <td class="blue-grey-text text-darken-4 font-medium"><center><?php $result=$this->db->query("SELECT COUNT(*) AS jumlah FROM rumah_layanan WHERE id_satker=2")->row();echo $result->jumlah;?></center></td>
                                    <td class="blue-grey-text text-darken-4 font-medium"><center><?php $result=$this->db->query("SELECT COUNT(*) AS jumlah FROM rumah_layanan WHERE id_satker=3")->row();echo $result->jumlah;?></center></td>
                                </tr>
                                <tr>
                                    <td>3.</td>
                                    <td>Menu Jenis Layanan</td>
                                    <td class="blue-grey-text text-darken-4 font-medium"><center><?php $result=$this->db->query("SELECT COUNT(*) AS jumlah FROM jenis_layanan WHERE id_satker=1")->row();echo $result->jumlah;?></center></td>
                                    <td class="blue-grey-text text-darken-4 font-medium"><center><?php $result=$this->db->query("SELECT COUNT(*) AS jumlah FROM jenis_layanan WHERE id_satker=2")->row();echo $result->jumlah;?></center></td>
                                    <td class="blue-grey-text text-darken-4 font-medium"><center><?php $result=$this->db->query("SELECT COUNT(*) AS jumlah FROM jenis_layanan WHERE id_satker=3")->row();echo $result->jumlah;?></center></td>
                                </tr>
                                <tr>
                                    <td>4.</td>
                                    <td>Menu Detail Jenis Layanan</td>
                                    <td class="blue-grey-text text-darken-4 font-medium"><center><?php $result=$this->db->query("SELECT COUNT(dl.id_detail) AS jumlah FROM detail_layanan AS dl INNER JOIN jenis_layanan AS jl ON dl.id_layanan = jl.id_jenis_layanan WHERE jl.id_satker=1")->row();echo $result->jumlah;?></center></td>
                                    <td class="blue-grey-text text-darken-4 font-medium"><center><?php $result=$this->db->query("SELECT COUNT(dl.id_detail) AS jumlah FROM detail_layanan AS dl INNER JOIN jenis_layanan AS jl ON dl.id_layanan = jl.id_jenis_layanan WHERE jl.id_satker=2")->row();echo $result->jumlah;?></center></td>
                                    <td class="blue-grey-text text-darken-4 font-medium"><center><?php $result=$this->db->query("SELECT COUNT(dl.id_detail) AS jumlah FROM detail_layanan AS dl INNER JOIN jenis_layanan AS jl ON dl.id_layanan = jl.id_jenis_layanan WHERE jl.id_satker=3")->row();echo $result->jumlah;?></center></td>
                                </tr>
                                <tr>
                                    <td>5.</td>
                                    <td>Menu Pegawai</td>
                                    <td class="blue-grey-text text-darken-4 font-medium"><center><?php $result=$this->db->query("SELECT COUNT(*) AS jumlah FROM pegawai2 WHERE id_satker=1")->row();echo $result->jumlah;?></center></td>
                                    <td class="blue-grey-text text-darken-4 font-medium"><center><?php $result=$this->db->query("SELECT COUNT(*) AS jumlah FROM pegawai2 WHERE id_satker=2")->row();echo $result->jumlah;?></center></td>
                                    <td class="blue-grey-text text-darken-4 font-medium"><center><?php $result=$this->db->query("SELECT COUNT(*) AS jumlah FROM pegawai2 WHERE id_satker=3")->row();echo $result->jumlah;?></center></td>
                                </tr>
                                <tr>
                                    <td>5.</td>
                                    <td>Menu User</td>
                                    <td class="blue-grey-text text-darken-4 font-medium"><center><?php $result=$this->db->query("SELECT COUNT(u.id_user) AS jumlah FROM user AS u INNER JOIN pegawai2 AS p ON u.id_pegawai=p.id WHERE p.id_satker=1")->row();echo $result->jumlah;?></center></td>
                                    <td class="blue-grey-text text-darken-4 font-medium"><center><?php $result=$this->db->query("SELECT COUNT(u.id_user) AS jumlah FROM user AS u INNER JOIN pegawai2 AS p ON u.id_pegawai=p.id WHERE p.id_satker=2")->row();echo $result->jumlah;?></center></td>
                                    <td class="blue-grey-text text-darken-4 font-medium"><center><?php $result=$this->db->query("SELECT COUNT(u.id_user) AS jumlah FROM user AS u INNER JOIN pegawai2 AS p ON u.id_pegawai=p.id WHERE p.id_satker=3")->row();echo $result->jumlah;?></center></td>
                                </tr>
                                <tr>
                                    <td>6.</td>
                                    <td>Menu Kontrak</td>
                                    <td class="blue-grey-text text-darken-4 font-medium"><center><?php $result=$this->db->query("SELECT COUNT(*) AS jumlah FROM kontrak WHERE id_satker=1 AND status='K'")->row();echo $result->jumlah;?></center></td>
                                    <td class="blue-grey-text text-darken-4 font-medium"><center><?php $result=$this->db->query("SELECT COUNT(*) AS jumlah FROM kontrak WHERE id_satker=2 AND status='K'")->row();echo $result->jumlah;?></center></td>
                                    <td class="blue-grey-text text-darken-4 font-medium"><center><?php $result=$this->db->query("SELECT COUNT(*) AS jumlah FROM kontrak WHERE id_satker=3 AND status='K'")->row();echo $result->jumlah;?></center></td>
                                </tr>
                                <tr>
                                    <td>7.</td>
                                    <td>Termin Kontrak</td>
                                    <td class="blue-grey-text text-darken-4 font-medium"><center><?php $result=$this->db->query("SELECT COUNT(t.id_termin) AS jumlah FROM termin AS t INNER JOIN kontrak AS k ON t.id_kontrak = k.id_kontrak WHERE k.id_satker=1 AND k.status='K'")->row();echo $result->jumlah;?></center></td>
                                    <td class="blue-grey-text text-darken-4 font-medium"><center><?php $result=$this->db->query("SELECT COUNT(t.id_termin) AS jumlah FROM termin AS t INNER JOIN kontrak AS k ON t.id_kontrak = k.id_kontrak WHERE k.id_satker=2 AND k.status='K'")->row();echo $result->jumlah;?></center></td>
                                    <td class="blue-grey-text text-darken-4 font-medium"><center><?php $result=$this->db->query("SELECT COUNT(t.id_termin) AS jumlah FROM termin AS t INNER JOIN kontrak AS k ON t.id_kontrak = k.id_kontrak WHERE k.id_satker=3 AND k.status='K'")->row();echo $result->jumlah;?></center></td>
                                </tr>
                                <tr>
                                    <td>8.</td>
                                    <td>Anggota Tim</td>
                                    <td class="blue-grey-text text-darken-4 font-medium"><center><?php $result=$this->db->query("SELECT COUNT(*) AS jumlah FROM personil AS p INNER JOIN kontrak AS k ON p.id_kontrak = k.id_kontrak WHERE k.id_satker=1 AND k.status='K'")->row();echo $result->jumlah;?></center></td>
                                    <td class="blue-grey-text text-darken-4 font-medium"><center><?php $result=$this->db->query("SELECT COUNT(*) AS jumlah FROM personil AS p INNER JOIN kontrak AS k ON p.id_kontrak = k.id_kontrak WHERE k.id_satker=2 AND k.status='K'")->row();echo $result->jumlah;?></center></td>
                                    <td class="blue-grey-text text-darken-4 font-medium"><center><?php $result=$this->db->query("SELECT COUNT(*) AS jumlah FROM personil AS p INNER JOIN kontrak AS k ON p.id_kontrak = k.id_kontrak WHERE k.id_satker=3 AND k.status='K'")->row();echo $result->jumlah;?></center></td>
                                </tr>
                                <tr>
                                    <td>9.</td>
                                    <td>Timeline</td>
                                    <td class="blue-grey-text text-darken-4 font-medium"><center><?php $result=$this->db->query("SELECT COUNT(*) AS jumlah FROM kegiatan AS keg INNER JOIN kontrak AS k ON keg.id_kontrak = k.id_kontrak WHERE k.id_satker=1 AND k.status='K'")->row();echo $result->jumlah;?></center></td>
                                    <td class="blue-grey-text text-darken-4 font-medium"><center><?php $result=$this->db->query("SELECT COUNT(*) AS jumlah FROM kegiatan AS keg INNER JOIN kontrak AS k ON keg.id_kontrak = k.id_kontrak WHERE k.id_satker=2 AND k.status='K'")->row();echo $result->jumlah;?></center></td>
                                    <td class="blue-grey-text text-darken-4 font-medium"><center><?php $result=$this->db->query("SELECT COUNT(*) AS jumlah FROM kegiatan AS keg INNER JOIN kontrak AS k ON keg.id_kontrak = k.id_kontrak WHERE k.id_satker=3 AND k.status='K'")->row();echo $result->jumlah;?></center></td>
                                </tr>
                                <tr>
                                    <td>10.</td>
                                    <td>Rencana Operasional</td>
                                    <td class="blue-grey-text text-darken-4 font-medium"><center><?php $result=$this->db->query("SELECT COUNT(*) AS jumlah FROM rencana_operasional AS ro INNER JOIN kontrak AS k ON ro.id_kontrak = k.id_kontrak WHERE k.id_satker=1 AND k.status='K'")->row();echo $result->jumlah;?></center></td>
                                    <td class="blue-grey-text text-darken-4 font-medium"><center><?php $result=$this->db->query("SELECT COUNT(*) AS jumlah FROM rencana_operasional AS ro INNER JOIN kontrak AS k ON ro.id_kontrak = k.id_kontrak WHERE k.id_satker=2 AND k.status='K'")->row();echo $result->jumlah;?></center></td>
                                    <td class="blue-grey-text text-darken-4 font-medium"><center><?php $result=$this->db->query("SELECT COUNT(*) AS jumlah FROM rencana_operasional AS ro INNER JOIN kontrak AS k ON ro.id_kontrak = k.id_kontrak WHERE k.id_satker=3 AND k.status='K'")->row();echo $result->jumlah;?></center></td>
                                </tr>
                                <tr>
                                    <td>11.</td>
                                    <td>Pengajuan Biaya Rencana Operasional</td>
                                    <td class="blue-grey-text text-darken-4 font-medium"><center><?php $result=$this->db->query("SELECT COUNT(*) AS jumlah FROM pengajuan AS p INNER JOIN rencana_operasional AS ro ON p.id_ro = ro.id_ro INNER JOIN kontrak AS k ON ro.id_kontrak = k.id_kontrak WHERE k.id_satker=1")->row();echo $result->jumlah;?></center></td>
                                    <td class="blue-grey-text text-darken-4 font-medium"><center><?php $result=$this->db->query("SELECT COUNT(*) AS jumlah FROM pengajuan AS p INNER JOIN rencana_operasional AS ro ON p.id_ro = ro.id_ro INNER JOIN kontrak AS k ON ro.id_kontrak = k.id_kontrak WHERE k.id_satker=2")->row();echo $result->jumlah;?></center></td>
                                    <td class="blue-grey-text text-darken-4 font-medium"><center><?php $result=$this->db->query("SELECT COUNT(*) AS jumlah FROM pengajuan AS p INNER JOIN rencana_operasional AS ro ON p.id_ro = ro.id_ro INNER JOIN kontrak AS k ON ro.id_kontrak = k.id_kontrak WHERE k.id_satker=3")->row();echo $result->jumlah;?></center></td>
                                </tr>
                                <tr>
                                    <td>12.</td>
                                    <td>Penerbitan Invoice</td>
                                    <td class="blue-grey-text text-darken-4 font-medium"><center><?php $result=$this->db->query("SELECT COUNT(t.id_termin) AS jumlah FROM termin AS t INNER JOIN kontrak AS k ON t.id_kontrak = k.id_kontrak WHERE k.id_satker=1 AND t.status_cetak_invoice=1 AND k.status='K'")->row();echo $result->jumlah;?></center></td>
                                    <td class="blue-grey-text text-darken-4 font-medium"><center><?php $result=$this->db->query("SELECT COUNT(t.id_termin) AS jumlah FROM termin AS t INNER JOIN kontrak AS k ON t.id_kontrak = k.id_kontrak WHERE k.id_satker=2 AND t.status_cetak_invoice=1 AND k.status='K'")->row();echo $result->jumlah;?></center></td>
                                    <td class="blue-grey-text text-darken-4 font-medium"><center><?php $result=$this->db->query("SELECT COUNT(t.id_termin) AS jumlah FROM termin AS t INNER JOIN kontrak AS k ON t.id_kontrak = k.id_kontrak WHERE k.id_satker=3 AND t.status_cetak_invoice=1 AND k.status='K'")->row();echo $result->jumlah;?></center></td>
                                </tr>
                                <tr>
                                    <td>13.</td>
                                    <td>Penerbitan Kwitansi</td>
                                    <td class="blue-grey-text text-darken-4 font-medium"><center><?php $result=$this->db->query("SELECT COUNT(t.id_termin) AS jumlah FROM termin AS t INNER JOIN kontrak AS k ON t.id_kontrak = k.id_kontrak WHERE k.id_satker=1 AND t.status_cetak_kwitansi=1 AND k.status='K'")->row();echo $result->jumlah;?></center></td>
                                    <td class="blue-grey-text text-darken-4 font-medium"><center><?php $result=$this->db->query("SELECT COUNT(t.id_termin) AS jumlah FROM termin AS t INNER JOIN kontrak AS k ON t.id_kontrak = k.id_kontrak WHERE k.id_satker=2 AND t.status_cetak_kwitansi=1 AND k.status='K'")->row();echo $result->jumlah;?></center></td>
                                    <td class="blue-grey-text text-darken-4 font-medium"><center><?php $result=$this->db->query("SELECT COUNT(t.id_termin) AS jumlah FROM termin AS t INNER JOIN kontrak AS k ON t.id_kontrak = k.id_kontrak WHERE k.id_satker=3 AND t.status_cetak_kwitansi=1 AND k.status='K'")->row();echo $result->jumlah;?></center></td>
                                </tr>
                                <tr>
                                    <td>14.</td>
                                    <td>Data RKAKL</td>
                                    <td class="blue-grey-text text-darken-4 font-medium"><center><?php $result=$this->db->query("SELECT COUNT(*) AS jumlah FROM rkakl AS r INNER JOIN rumah_layanan AS rl ON r.id_layanan = rl.id_rumah_layanan WHERE rl.id_satker=1")->row();echo $result->jumlah;?></center></td>
                                    <td class="blue-grey-text text-darken-4 font-medium"><center><?php $result=$this->db->query("SELECT COUNT(*) AS jumlah FROM rkakl AS r INNER JOIN rumah_layanan AS rl ON r.id_layanan = rl.id_rumah_layanan WHERE rl.id_satker=2")->row();echo $result->jumlah;?></center></td>
                                    <td class="blue-grey-text text-darken-4 font-medium"><center><?php $result=$this->db->query("SELECT COUNT(*) AS jumlah FROM rkakl AS r INNER JOIN rumah_layanan AS rl ON r.id_layanan = rl.id_rumah_layanan WHERE rl.id_satker=3")->row();echo $result->jumlah;?></center></td>
                                </tr>
                                <tr>
                                    <td>15.</td>
                                    <td>Data PO</td>
                                    <td class="blue-grey-text text-darken-4 font-medium"><center><?php $result=$this->db->query("SELECT COUNT(*) AS jumlah FROM kontrak WHERE id_satker=1 AND status='PO'")->row();echo $result->jumlah;?></center></td>
                                    <td class="blue-grey-text text-darken-4 font-medium"><center><?php $result=$this->db->query("SELECT COUNT(*) AS jumlah FROM kontrak WHERE id_satker=2 AND status='PO'")->row();echo $result->jumlah;?></center></td>
                                    <td class="blue-grey-text text-darken-4 font-medium"><center><?php $result=$this->db->query("SELECT COUNT(*) AS jumlah FROM kontrak WHERE id_satker=3 AND status='PO'")->row();echo $result->jumlah;?></center></td>
                                </tr>
                                <tr>
                                    <td>16.</td>
                                    <td>Data Invoice PO</td>
                                    <td class="blue-grey-text text-darken-4 font-medium"><center><?php $result=$this->db->query("SELECT COUNT(t.id_termin) AS jumlah FROM termin AS t INNER JOIN kontrak AS k ON t.id_kontrak = k.id_kontrak WHERE k.id_satker=1 AND t.status_cetak_invoice=1 AND k.status='PO'")->row();echo $result->jumlah;?></center></td>
                                    <td class="blue-grey-text text-darken-4 font-medium"><center><?php $result=$this->db->query("SELECT COUNT(t.id_termin) AS jumlah FROM termin AS t INNER JOIN kontrak AS k ON t.id_kontrak = k.id_kontrak WHERE k.id_satker=2 AND t.status_cetak_invoice=1 AND k.status='PO'")->row();echo $result->jumlah;?></center></td>
                                    <td class="blue-grey-text text-darken-4 font-medium"><center><?php $result=$this->db->query("SELECT COUNT(t.id_termin) AS jumlah FROM termin AS t INNER JOIN kontrak AS k ON t.id_kontrak = k.id_kontrak WHERE k.id_satker=3 AND t.status_cetak_invoice=1 AND k.status='PO'")->row();echo $result->jumlah;?></center></td>
                                </tr>
                                <tr>
                                    <td>17.</td>
                                    <td>Data Kwitansi PO</td>
                                    <td class="blue-grey-text text-darken-4 font-medium"><center><?php $result=$this->db->query("SELECT COUNT(t.id_termin) AS jumlah FROM termin AS t INNER JOIN kontrak AS k ON t.id_kontrak = k.id_kontrak WHERE k.id_satker=1 AND t.status_cetak_kwitansi=1 AND k.status='PO'")->row();echo $result->jumlah;?></center></td>
                                    <td class="blue-grey-text text-darken-4 font-medium"><center><?php $result=$this->db->query("SELECT COUNT(t.id_termin) AS jumlah FROM termin AS t INNER JOIN kontrak AS k ON t.id_kontrak = k.id_kontrak WHERE k.id_satker=2 AND t.status_cetak_kwitansi=1 AND k.status='PO'")->row();echo $result->jumlah;?></center></td>
                                    <td class="blue-grey-text text-darken-4 font-medium"><center><?php $result=$this->db->query("SELECT COUNT(t.id_termin) AS jumlah FROM termin AS t INNER JOIN kontrak AS k ON t.id_kontrak = k.id_kontrak WHERE k.id_satker=3 AND t.status_cetak_kwitansi=1 AND k.status='PO'")->row();echo $result->jumlah;?></center></td>
                                </tr>
                                <tr>
                                    <td>18.</td>
                                    <td>Data Realisasi Kontrak</td>
                                    <td class="blue-grey-text text-darken-4 font-medium"><center><?php $result=$this->db->query("SELECT COUNT(t.id_termin) AS jumlah FROM termin AS t INNER JOIN kontrak AS k ON t.id_kontrak = k.id_kontrak WHERE k.id_satker=1 AND t.status_realisasi=1 AND k.status='K'")->row();echo $result->jumlah;?></center></td>
                                    <td class="blue-grey-text text-darken-4 font-medium"><center><?php $result=$this->db->query("SELECT COUNT(t.id_termin) AS jumlah FROM termin AS t INNER JOIN kontrak AS k ON t.id_kontrak = k.id_kontrak WHERE k.id_satker=2 AND t.status_realisasi=1 AND k.status='K'")->row();echo $result->jumlah;?></center></td>
                                    <td class="blue-grey-text text-darken-4 font-medium"><center><?php $result=$this->db->query("SELECT COUNT(t.id_termin) AS jumlah FROM termin AS t INNER JOIN kontrak AS k ON t.id_kontrak = k.id_kontrak WHERE k.id_satker=3 AND t.status_realisasi=1 AND k.status='K'")->row();echo $result->jumlah;?></center></td>
                                </tr>
                                <tr>
                                    <td>19.</td>
                                    <td>Data Realisasi PO</td>
                                    <td class="blue-grey-text text-darken-4 font-medium"><center><?php $result=$this->db->query("SELECT COUNT(t.id_termin) AS jumlah FROM termin AS t INNER JOIN kontrak AS k ON t.id_kontrak = k.id_kontrak WHERE k.id_satker=1 AND t.status_realisasi=1 AND k.status='PO'")->row();echo $result->jumlah;?></center></td>
                                    <td class="blue-grey-text text-darken-4 font-medium"><center><?php $result=$this->db->query("SELECT COUNT(t.id_termin) AS jumlah FROM termin AS t INNER JOIN kontrak AS k ON t.id_kontrak = k.id_kontrak WHERE k.id_satker=2 AND t.status_realisasi=1 AND k.status='PO'")->row();echo $result->jumlah;?></center></td>
                                    <td class="blue-grey-text text-darken-4 font-medium"><center><?php $result=$this->db->query("SELECT COUNT(t.id_termin) AS jumlah FROM termin AS t INNER JOIN kontrak AS k ON t.id_kontrak = k.id_kontrak WHERE k.id_satker=3 AND t.status_realisasi=1 AND k.status='PO'")->row();echo $result->jumlah;?></center></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Recent comment and chats -->
    <!-- ============================================================== -->

</div>
