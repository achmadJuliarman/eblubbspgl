<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Twitter -->
    <meta name="twitter:site" content="@themepixels">
    <meta name="twitter:creator" content="@themepixels">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Azia">
    <meta name="twitter:description" content="Responsive Bootstrap 4 Dashboard Template">
    <meta name="twitter:image" content="http://themepixels.me/azia/img/azia-social.png">

    <!-- Facebook -->
    <meta property="og:url" content="http://themepixels.me/azia">
    <meta property="og:title" content="Azia">
    <meta property="og:description" content="Responsive Bootstrap 4 Dashboard Template">

    <meta property="og:image" content="http://themepixels.me/azia/img/azia-social.png">
    <meta property="og:image:secure_url" content="http://themepixels.me/azia/img/azia-social.png">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">

    <!-- Meta -->
    <meta name="description" content="Responsive Bootstrap 4 Dashboard Template">
    <meta name="author" content="ThemePixels">

    <title>PIMPINAN</title>
    <!-- datepicker -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript">
      var jq_1_12_4 = $.noConflict(true);
    </script>

    <!-- vendor css -->
    <link href="<?php echo base_url(); ?>assets/lib/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/lib/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/lib/typicons.font/typicons.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/lib/fullcalendar/fullcalendar.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/lib/select2/css/select2.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/lib/spectrum-colorpicker/spectrum.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/lib/ion-rangeslider/css/ion.rangeSlider.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/lib/ion-rangeslider/css/ion.rangeSlider.skinFlat.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/lib/amazeui-datetimepicker/css/amazeui.datetimepicker.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/lib/jquery-simple-datetimepicker/jquery.simple-dtpicker.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/lib/pickerjs/picker.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/lib/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/lib/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/lib/typicons.font/typicons.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/lib/datatables.net-dt/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/lib/datatables.net-responsive-dt/css/responsive.dataTables.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/lib/select2/css/select2.min.css" rel="stylesheet">

    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <!-- azia CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/azia.css">

  </head>

  <body class="az-body">

    <div class="az-header">
      <div class="container">
        <div class="az-header-left">
          <a href="" class="az-logo"><img src="<?php echo base_url();?>assets/Tekmira.PNG" height="60" width="220"></a>
          <a href="" id="azMenuShow" class="az-header-menu-icon d-lg-none"><span></span></a>
          <a href=""><i class="typcn "></i>&nbsp | &nbsp  PROGRAM </a>
        </div><!-- az-header-left -->
        <div class="az-header-menu">
          <div class="az-header-menu-header">
            <a href="index.html" class="az-logo"><span></span> TEKMIRA</a>
            <a href="" class="close">&times;</a>
          </div><!-- az-header-menu-header -->



          <ul class="nav">
            <li class="nav-item">
              <a href="<?php echo base_url(); ?>home/pimpinan_pendapatan"><i class="fas fa-home"></i> Pendapatan</a>
            </li>
            <!-- <li class="nav-item">
              <a href="<?php echo base_url(); ?>home/pimpinan_pendapatan"><i class="far fa-envelope"></i> Pendapatan</a>
            </li> -->
          </ul>

        </div><!-- az-header-menu -->
        <div class="az-header-right">


          <div class="dropdown az-profile-menu">
            <a href="" class="far fa-user"></a>
            <div class="dropdown-menu">
              <div class="az-dropdown-header d-sm-none">
                <a href="" class="az-header-arrow"><i class="icon ion-md-arrow-back"></i></a>
              </div>
              <div class="az-header-profile">
                <div class="az-img-user">
                  <img src="https://via.placeholder.com/500" alt="">
                </div><!-- az-img-user -->
                <h6>PROGRAM</h6>
                <!-- <span>Premium Member</span> -->
              </div><!-- az-header-profile -->

              <a href="<?=base_url()."home/index" ?>" class="dropdown-item"><i class="typcn typcn-power-outline"></i> Sign Out</a>
            </div><!-- dropdown-menu -->
          </div>



        </div><!-- az-header-right -->
      </div><!-- container -->
    </div><!-- az-header -->
<script src="<?php echo base_url(); ?>assets/highchart/highcharts.js"></script>
<script src="<?php echo base_url(); ?>assets/highchart/modules/data.js"></script>
<script src="<?php echo base_url(); ?>assets/highchart/modules/exporting.js"></script>
<script src="<?php echo base_url(); ?>assets/highchart/modules/accessibility.js"></script>
<div class="az-content az-content-mail">
      <div class="container">
        <div class="az-content-body az-content-body-mail">
<figure class="highcharts-figure">
    <div id="grafik"></div>
    <br>
    <table id="table" hidden="TRUE">
        <thead>
            <tr>
                <th width="25%" style="text-align:center">Jenis Layanan</th>
                <th width="15%" style="text-align:center">Pagu</th>
                <th width="15%" style="text-align:center">Terkontrak</th>
                <th width="15%" style="text-align:center">Pendapatan</th>
                <th width="15%" style="text-align:center">Realisai</th>
                <th width="15%" style="text-align:center">Saldo</th>
            </tr>
        </thead>
        <tbody>
            <?php $total_pagu=0;$total_kontrak=0;$total_pendapatan=0;$total_realisasi=0;$total_saldo=0;?>
            <?php foreach ($rba as $a) { ?>
              <tr>
               <!-- <th><a href="<?php echo base_url();?>home/pimpinan_detail/<?php echo $a->id_rba;?>"><?php echo $a->rba;?></a></th>
                --><td style="text-align:center"><?php echo $a->jumlah/1000000;?></td>
                <?php $kontrak = $this->db->query("SELECT SUM(nilai_kontrak) AS total_kontrak FROM kontrak WHERE id_rba = $a->id_rba")->row(); ?>
                <td style="text-align:center"><?php echo $kontrak->total_kontrak/1000000;?></td>
                <?php $pendapatan = $this->db->query("SELECT SUM(ro.biaya) AS total_pendapatan FROM kontrak AS k
                                                    INNER JOIN rencana_operasional AS ro ON ro.id_kontrak = k.id_kontrak
                                                    INNER JOIN pengajuan AS p ON p.id_ro = ro.id_ro
                                                    WHERE k.id_rba = $a->id_rba")->row(); ?>
                <td style="text-align:center"><?php $sub_pendapatan = $kontrak->total_kontrak-$pendapatan->total_pendapatan; echo $sub_pendapatan/1000000;?></td>
                <?php $realisasi = $this->db->query("SELECT SUM(p.jum_real) AS total_realisasi FROM kontrak AS k
                                                    INNER JOIN rencana_operasional AS ro ON ro.id_kontrak = k.id_kontrak
                                                    INNER JOIN pengajuan AS p ON p.id_ro = ro.id_ro
                                                    WHERE k.id_rba = $a->id_rba")->row(); ?>
                <td style="text-align:center"><?php echo $realisasi->total_realisasi/1000000;?></td>
                <td style="text-align:center"><?php $sub_saldo = $sub_pendapatan-$realisasi->total_realisasi; echo $sub_saldo/1000000;?></td>
              </tr>
            <?php } ?>
        </tbody>
    </table>
    <table class="table" width="100%">
            <th width="25%" style="text-align:center">Jenis Layanan</th>
            <th width="15%" style="text-align:center">Pagu</th>
            <th width="15%" style="text-align:center">Terkontrak</th>
            <th width="15%" style="text-align:center">Pendapatan</th>
            <th width="15%" style="text-align:center">Realisai</th>
            <th width="15%" style="text-align:center">Saldo</th>
            <?php $total_pagu=0;$total_kontrak=0;$total_pendapatan=0;$total_realisasi=0;$total_saldo=0;?>
            <?php foreach ($rba as $a) { ?>
              <tr>
                <td><a href="<?php echo base_url();?>home/pimpinan_detail/<?php echo $a->id_rba;?>"><?php echo $a->rba;?></a></td>
                <td style="text-align:center"><?php echo "Rp. ".number_format($a->jumlah,0,',','.');?></td>
                <?php $kontrak = $this->db->query("SELECT SUM(nilai_kontrak) AS total_kontrak FROM kontrak WHERE id_rba = $a->id_rba")->row(); ?>
                <td style="text-align:center"><?php echo "Rp. ".number_format($kontrak->total_kontrak,0,',','.');?></td>
                <?php $pendapatan = $this->db->query("SELECT SUM(ro.biaya) AS total_pendapatan FROM kontrak AS k
                                                    INNER JOIN rencana_operasional AS ro ON ro.id_kontrak = k.id_kontrak
                                                    INNER JOIN pengajuan AS p ON p.id_ro = ro.id_ro
                                                    WHERE k.id_rba = $a->id_rba")->row(); ?>
                <td style="text-align:center"><?php $sub_pendapatan = $kontrak->total_kontrak-$pendapatan->total_pendapatan; echo "Rp. ".number_format($sub_pendapatan,0,',','.');?></td>
                <?php $realisasi = $this->db->query("SELECT SUM(p.jum_real) AS total_realisasi FROM kontrak AS k
                                                    INNER JOIN rencana_operasional AS ro ON ro.id_kontrak = k.id_kontrak
                                                    INNER JOIN pengajuan AS p ON p.id_ro = ro.id_ro
                                                    WHERE k.id_rba = $a->id_rba")->row(); ?>
                <td style="text-align:center"><?php echo "Rp. ".number_format($realisasi->total_realisasi,0,',','.');?></td>
                <td style="text-align:center"><?php $sub_saldo = $sub_pendapatan-$realisasi->total_realisasi; echo "Rp. ".number_format($sub_saldo,0,',','.');?></td>
              </tr>
              <?php
                  $total_pagu=$total_pagu + $a->jumlah;
                  $total_kontrak=$total_kontrak+$kontrak->total_kontrak;
                  $total_pendapatan=$total_pendapatan+$sub_pendapatan;
                  $total_realisasi=$total_realisasi+$realisasi->total_realisasi;
                  $total_saldo=$total_saldo+$sub_saldo;
              ?>
            <?php } ?>
            <tr>
              <td  width="25%" style="text-align:center"><b>TOTAL</b></td>
              <td  width="15%" style="text-align:center"><b><?php echo "Rp. ".number_format($total_pagu,0,',','.');?></b></td>
              <td  width="15%" style="text-align:center"><b><?php echo "Rp. ".number_format($total_kontrak,0,',','.');?></b></td>
              <td  width="15%" style="text-align:center"><b><?php echo "Rp. ".number_format($total_pendapatan,0,',','.');?></b></td>
              <td  width="15%" style="text-align:center"><b><?php echo "Rp. ".number_format($total_realisasi,0,',','.');?></b></td>
              <td  width="15%" style="text-align:center"><b><?php echo "Rp. ".number_format($total_saldo,0,',','.');?></b></td>
            </tr>
          </table>
</figure>
</div><!-- az-content-body -->
      </div><!-- container -->
    </div><!-- az-content -->


		<script type="text/javascript">
Highcharts.chart('grafik', {
    data: {
        table: 'table'
    },
    chart: {
        type: 'column'
    },
    title: {
        text: 'Data KONTRAK 2020'
    },
    yAxis: {
        allowDecimals: true,
        min: 0,
        title: {
            text: 'Rupiah',
            align: 'high'
        },
        labels: {
            overflow: 'justify'
        }
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0,
            
        }
    },
    tooltip: {
        pointFormat: '{series.name}: <b>Rp. {point.y:.2f} *Juta Rupiah</b><br/>'
    }
});
		</script>
	</body>
</html>
