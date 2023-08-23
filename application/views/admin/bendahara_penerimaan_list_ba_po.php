<?php
function tgl_indo($tanggal){
	$bulan = array (
		1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);
	$pecahkan = explode('-', $tanggal);
	return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}

function hari_ini(){
	$hari = date ("D");
	switch($hari){
		case 'Sun':
			$hari_ini = "Minggu";
		break;
		case 'Mon':
			$hari_ini = "Senin";
		break;
		case 'Tue':
			$hari_ini = "Selasa";
		break;
		case 'Wed':
			$hari_ini = "Rabu";
		break;
		case 'Thu':
			$hari_ini = "Kamis";
		break;
		case 'Fri':
			$hari_ini = "Jumat";
		break;
		case 'Sat':
			$hari_ini = "Sabtu";
		break;
		default:
			$hari_ini = "Tidak di ketahui";
		break;
	}
	return "<b>" . $hari_ini . "</b>";
}
?>
<div class="container-fluid">
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <h4 class="card-title">Daftar Berita Acara</h4>
                    <h6 class="card-subtitle">You have <?php echo count($result); ?> Berita Acara</h6>
										<div class="form-group">
												<input id="demo-input-search2" type="text" placeholder="Search" autocomplete="off">
										</div>
                    <table id="demo-foo-addrow2" class="table table-bordered table-hover toggle-circle" data-page-size="10">
                      <thead>
                        <tr>
                          <th width="5%" data-sort-ignore="true"><center>No.</center></th>
                          <th width="15%">Tanggal</th>
                          <th width="10%" data-sort-ignore="true"><center>Jumlah</center></th>
                          <th width="20%" data-sort-ignore="true"><center>Action</center></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $no=1; foreach ($result as $a) { ?>
                            <tr>
                              <td><center><?= $no ?></center></td>
                              <td><b><?php echo $this->format_tanggal->jin_date_str($a->tgl_operasional); ?></b></td>
                              <td><center><?= $a->jumlah ?></center></td>
                              <td>
                                  <center>
																		<a href="<?=  base_url()."bendahara_penerimaan/cetak_berita_acara/".$a->tgl_operasional ?>" target="_blank" class="btn btn-small orange btn-outline tooltipped" data-position="top" data-delay="50" data-tooltip="Cetak Berita Acara" onclick="javascript: return confirm('Yakin akan mencetak Berita Acara ?')"><i class="fas fa-print"></i> Cetak Berita Acara</a>
																	</center>
                              </td>
                            </tr>
                      <?php $no=$no+1;} ?>

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
