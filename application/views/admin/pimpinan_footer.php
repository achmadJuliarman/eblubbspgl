<footer class="center-align m-b-30">&copy; 2020 Balitbang ESDM | BLU PROMISES</footer>
</div>
<!-- ============================================================== -->
<!-- Page wrapper scss in scafholding.scss -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Right Sidebar -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Right Sidebar -->
<!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- All Required js -->
<!-- ============================================================== -->
<script src="<?php echo base_url(); ?>assets/new/libs/jquery/dist/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/new/dist/js/materialize.min.js"></script>
<script src="<?php echo base_url(); ?>assets/new/libs/perfect-scrollbar/dist/js/perfect-scrollbar.jquery.min.js"></script>
<!-- ============================================================== -->
<!-- Apps -->
<!-- ============================================================== -->
<script src="<?php echo base_url(); ?>assets/new/dist/js/app.js"></script>
<script src="<?php echo base_url(); ?>assets/new/dist/js/app.init.horizontal-fullwidth.js"></script>
<script src="<?php echo base_url(); ?>assets/new/dist/js/app-style-switcher.js"></script>
<!-- ============================================================== -->
<!-- Custom js -->
<!-- ============================================================== -->
<script src="<?php echo base_url(); ?>assets/new/dist/js/custom.min.js"></script>
<!-- ============================================================== -->
<!-- This page plugin js -->
<!-- ============================================================== -->
<script src="<?php echo base_url(); ?>assets/new/libs/chartist/dist/chartist.min.js"></script>
<script src="<?php echo base_url(); ?>assets/new/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
<script src="<?php echo base_url(); ?>assets/new/extra-libs/sparkline/sparkline.js"></script>
<script src="<?php echo base_url(); ?>assets/new/dist/js/pages/dashboards/dashboard1.js"></script>

<!-- Footable -->
<script src="<?php echo base_url();?>assets/new/extra-libs/DataTables/datatables.min.js"></script>
<script src="<?php echo base_url();?>assets/new/dist/js/pages/datatable/datatable-basic.init.js"></script>
<script src="<?php echo base_url();?>assets/new/libs/footable/dist/footable.all.min.js"></script>
<script src="<?php echo base_url();?>assets/new/dist/js/pages/footable/footable-init.js"></script>
<script src="<?php echo base_url();?>assets/new/extra-libs/prism/prism.js"></script>
<script src="<?php echo base_url();?>assets/new/dist/js/pages/forms/jquery.validate.min.js"></script>
<script src="<?php echo base_url();?>assets/new/libs/tinymce/tinymce.min.js"></script>

<script src="<?php echo base_url(); ?>assets/grafik/code/highcharts.js"></script>
<script src="<?php echo base_url(); ?>assets/grafik/code/modules/data.js"></script>
<script src="<?php echo base_url(); ?>assets/grafik/code/modules/exporting.js"></script>
<script src="<?php echo base_url(); ?>assets/grafik/code/modules/accessibility.js"></script>
<script type="text/javascript">
<?php $satker=$this->session->userdata('admin_satker'); $nama_satker=$this->session->userdata('admin_nama_satker'); $tahun = DATE("Y");?>
Highcharts.setOptions({
        lang: {
            thousandsSep: ','
        }
    });

Highcharts.chart('container', {
data: {
table: 'datatable'
},
chart: {
type: 'column'
},
title: {
text: 'PENGELOLAAN KEUANGAN BLU <?php echo $nama_satker; ?> Tahun <?php echo $pilih_tahun; ?>'
},
yAxis: {
allowDecimals: false,
title: {
    text: 'Rupiah'
}
},
tooltip: {
        pointFormat: "Rp. {point.y:,.0f}"
    }});
</script>
<script type="text/javascript">
Highcharts.setOptions({
        lang: {
            thousandsSep: ','
        }
    });
Highcharts.chart('containerkaban', {
data: {
table: 'datatablekaban'
},
chart: {
type: 'column'
},
title: {
text: 'PENGELOLAAN KEUANGAN BLU BALITBANG ESDM Tahun <?php echo $pilih_tahun; ?>'
},
yAxis: {
allowDecimals: false,
title: {
    text: 'Rupiah'
}
},
tooltip: {
        pointFormat: "Rp. {point.y:,.0f}"
    }});
</script>
<script type="text/javascript">
Highcharts.setOptions({
        lang: {
            thousandsSep: ','
        }
    });
    Highcharts.chart('container_piutang', {
    data: {
    table: 'datatable_piutang'
    },
    chart: {
    type: 'pie'
    },
    title: {
    text: 'RINCIAN PIUTANG <?php echo $nama_satker; ?> Tahun <?php echo $tahun; ?>'
    },
    yAxis: {
    allowDecimals: false,
    title: {
        text: 'Rupiah'
    }
    },
    tooltip: {
            pointFormat: "Rp. {point.y:,.0f}"
        }});

</script>
<script type="text/javascript">
Highcharts.setOptions({
        lang: {
            thousandsSep: ','
        }
    });
Highcharts.chart('containerlemigas', {
data: {
table: 'datatablelemigas'
},
chart: {
type: 'column'
},
title: {
text: 'PENGELOLAAN KEUANGAN BLU LEMIGAS Tahun <?php echo $pilih_tahun; ?>'
},
yAxis: {
allowDecimals: false,
title: {
    text: 'Rupiah'
}
},
tooltip: {
        pointFormat: "Rp. {point.y:,.0f}"
    }});
</script>
</body>

</html>
