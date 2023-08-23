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

<div id="main">
      <div class="row">
        <div class="col s12">
            <div class="container">
                <div class="section section-data-tables">
                  <div class="card">
                      <div class="card-content">
                          <h4 class="card-title">Rekap Berita Acara</h4>
                          <br>
                          <div class="row">
                              <div class="col s12">
                                  <table id="page-length-option" class="display" width="100%">
																		<thead>
																			<tr>
																				<th style="text-align:center;">No.</th>
																				<th style="text-align:center;">Tanggal</th>
																				<th style="text-align:center;">Jumlah</th>
																				<th style="text-align:center;">Action</th>
																			</tr>
																		</thead>
																		<tbody>
																			<?php $no=1; foreach ($result as $a) { ?>
																					<tr>
																						<td style="text-align:center;"><?php echo $no; ?></td>
																						<td style="text-align:center;"><b><?php echo $this->format_tanggal->jin_date_str($a->tgl_operasional); ?></b></td>
																						<td style="text-align:center;"><?php echo $a->jumlah; ?></td>
																						<td style="text-align:center;">
																									<a href="<?php echo base_url()."bendahara_penerimaan/cetak_berita_acara/".$a->tgl_operasional; ?>" target="_blank" class="btn-floating red mb-1 waves-effect waves-light tooltipped" data-position="top" data-tooltip="Cetak Berita Acara" onclick="javascript: return confirm('Yakin akan mencetak berita acara ?')"><i class="material-icons dp48">print</i></a>
																						</td>
																					</tr>
																		<?php $no=$no+1;} ?>
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
