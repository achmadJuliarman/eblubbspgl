<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SURAT PENAGIHAN</title>
<style type="text/css">
/* style sheet for "A4" printing */
								 @media print and (width: 21cm) and (height: 29.7cm) {
											@page {
												 margin: 3cm;
											}
								 }
								 /* style sheet for "letter" printing */
								 @media print and (width: 8.5in) and (height: 11in) {
										 @page {
												 margin: 1in;
										 }
								 }
								 /* A4 Landscape*/
								 @page {
										 size: A4 potrait;
										 margin: 5%;
								 }
/* Table */
		table {
			margin: auto;
			font-family: "Lucida Sans Unicode", "Lucida Grande", "Segoe Ui";
			font-size: 12px;
			border-color: 1px solid #e1edff;
		}
		.demo-table {
			border-collapse: collapse;
			font-size: 13px;
		}
		.demo-table th,
		.demo-table td {
			border-bottom: 1px solid #e1edff;
			border-left: 1px solid #e1edff;
			padding: 7px 17px;
		}
		.demo-table th,
		.demo-table td:last-child {
			border-right: 1px solid #e1edff;
		}
		.demo-table td:first-child {
			border-top: 1px solid #e1edff;
		}
		.demo-table td:last-child{
			border-bottom: 0;
		}
		caption {
			caption-side: top;
			margin-bottom: 10px;
		}
		/* Table Header */
		.demo-table thead th {
			background-color: #508abb;
			color: #FFFFFF;
			border-color: #6ea1cc !important;
			text-transform: uppercase;
		}
		/* Table Body */
		.demo-table tbody td {
			color: #353535;
		}
		.demo-table tbody tr:nth-child(odd) td {
			background-color: #f4fbff;
		}
		.demo-table tbody tr:hover th,
		.demo-table tbody tr:hover td {
			background-color: #ffffa2;
			border-color: #ffff0f;
			transition: all .2s;
		}
		#nomor {
			font-size:20px;
		}
</style>
<!-- <script>
window.print();
</script> -->
</head>
<body>
<table width="100%" border="0">
  <tr>
    <td width="5%" rowspan="3" style="font-size:9px;font-weight: bold;text-align:center;line-height: -10px;"><img src="<?php echo base_url();?>assets/esdm.png" width="60" height="50" align="middle"/><br/></td>
		<td width="73%" style="font-size:12px;text-align:center;line-height: 18px;">
    	  <p style="font-size:12px;text-align:left;line-height: 18px;margin:1px;">
					<b>
          &nbsp;KEMENTERIAN ENERGI DAN SUMBER DAYA MINERAL REPUBLIK INDONESIA <br>
          &nbsp;BADAN LITBANG ENERGI DAN SUMBER DAYA MINERAL <br>
          &nbsp;<?php echo $satker->nama_satker;?>
				</b>
				</p>
    <td width="8%" style="font-size:28px;text-align:center;line-height: 25px;">&nbsp;</td>
  </tr>
</table>
<br>
<br>
<table width="100%" border="0">
	<tr>
		<td width="15%">Nomor</td>
		<td width="5%">:</td>
		<td>NOMOR</td>
	</tr>
	<tr>
		<td width="15%">Sifat</td>
		<td width="5%">:</td>
		<td>Segera</td>
	</tr>
	<tr>
		<td width="15%">Lampiran</td>
		<td width="5%">:</td>
		<td>LAMPIRAN</td>
	</tr>
	<tr>
		<td width="15%">Perihal</td>
		<td width="5%">:</td>
		<td>Tagihan Piutan ke-</td>
	</tr>
</table>
<br><br>
<table width="100%" border="0">
	<tr>
		<td>
			Kepada <br>
			PT .. <br>
			Alamat
		</td>
	</tr>
</table>
<br><br>

<table width="100%" border="0">
  <tr>
    <td style="font-size:12px;">
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Bersama surat ini kami beritahukan bahwa sesuai dengan catatan pada pembukuan kami per tanggal …………………, PT………………………….. masih memiliki kewajiban yang belum dibayarkan atas invoice sebagai berikut:
		</td>
	</tr>
</table>
<table width="100%" border="0">
  <tr>
    <td style="font-size:14px;text-align:center;">
			<b>KARTU PIUTANG <br> PT...... </b>
		</td>
	</tr>
</table>
<br>
<table width="100%" rules="all" border="1">
  <thead style="font-size:12px;font-weight: bold;text-align:center">
    <th width="5%" height="44">No</th>
    <th width="50%">Invoice</th>
    <th width="15%">Terbit</th>
    <th width="15%">Jumlah</th>
    <th width="15%">Tanggal Jatuh Tempo Pembayaran</th>
  </thead>
  <tbody>
    <tr style="font-size:12px;">
      <td width="5%" height="44" style="text-align:center">1</td>
			<td width="50%"  style="padding-left:10px;padding-right:5px;">Pembayaran Termin ke - <?php echo $result->termin;?> (<?php echo $result->termin_keterangan;?>)</td>
      <td width="15%" style="text-align:center">1</td>
      <td width="15%"  style="text-align:center"><?= "Rp.".number_format($result->jumlah).",-" ?></td>
      <td width="15%"  style="text-align:center"><?= "Rp.".number_format($result->jumlah).",-" ?></td>
    </tr>
    <tr style="font-size:12px;">
      <td height="30" style="text-align:center" colspan="4"><b>TOTAL&nbsp;&nbsp;&nbsp;</b></td>
      <td style="text-align:center"><b><?= "Rp.".number_format($result->jumlah).",-" ?></b></td>
    </tr>
  </tbody>
</table>
<table width="100%" border="0">
  <tr>
  <td style="font-size:12px; text-align:left;margin:0;"><br />
		Terbilang : <strong>  <?php echo ucfirst($terbilang)." rupiah"; ?></strong>
  </td>
  </tr>
</table>

<table width="100%" border="0">
  <tr>
    <td style="font-size:12px;">
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sampai saat ini kami belum menerima pembayaran dari PT………………….., Kami harap agar Saudara segera melakukan pelunasan hutang invoice yang dimaksud.<br><br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Untuk konfirmasi Saudara dapat menghubungi A.R kami : <br><br>
		</td>
	</tr>
</table>

<table width="100%" border="0">
  <tr>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td style="font-size:12px;">
			1.	Sdr……………………………. Telp ………………………….. <br>
			2.	Sdr……………………………. Telp ………………………….. <br>
			e-mail : ……………………………………………………….. <br> <br>
		</td>
	</tr>
</table>

<table width="100%" border="0">
  <tr>
    <td style="font-size:12px;">
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tanggapan dan penjelasan Saudara paling lambat dapat kami terima kembali 7 (tujuh) hari setelah diterimanya surat ini. <br><br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Atas perhatian dan kerjasama yang baik Kami ucapkan terima kasih.
		</td>
	</tr>
</table>

<br />

<table width="100%" border="0">
  <tr>
    <td width="45%" style="font-size:12px;">&nbsp;</td>
    <td width="20%" style="font-size:12px;text-align:left"><br />Bandung, <?php echo DATE("d-m-Y"); ?><br />
Kepala<br />
<br><br><br><br><br>
Endang Sobari, S.E.<br />
NIP. 19641123 198903 1 001
	</td>
  <td width = "5%"></td>
  </tr>
</table>
</body>
</html>
