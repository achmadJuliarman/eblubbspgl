<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Materialize is a Material Design Admin Template,It's modern, responsive and based on Material Design by Google.">
    <meta name="keywords" content="materialize, admin template, dashboard template, flat admin template, responsive admin template, eCommerce dashboard, analytic dashboard">
    <meta name="author" content="ThemeSelect">
    <title>eBLU - BBSPGL</title>
    <link rel="apple-touch-icon" href="<?php echo base_url();?>assets/new_design/images/favicon/apple-touch-icon-152x152.png">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url();?>assets/new_design/images/favicon/favicon-32x32.png">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- BEGIN: VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/new_design/vendors/vendors.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/new_design/vendors/select2/select2.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/new_design/vendors/select2/select2-materialize.css" type="text/css">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css"> -->


    <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/new_design/vendors/data-tables/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/new_design/vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/new_design/vendors/data-tables/css/select.dataTables.min.css"> -->
    <!-- END: VENDOR CSS-->
    <!-- BEGIN: Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/new_design/css/themes/vertical-gradient-menu-template/materialize.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/new_design/css/themes/vertical-gradient-menu-template/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/new_design/css/pages/form-select2.css">
    <!-- END: Page Level CSS-->
    ?

    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/new_design/vendors/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/new_design/vendors/flag-icon/css/flag-icon.min.css">
    <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/new_design/vendors/quill/katex.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/new_design/vendors/quill/monokai-sublime.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/new_design/vendors/quill/quill.snow.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/new_design/vendors/quill/quill.bubble.css"> -->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/new_design/css/custom/custom.css">
    <!-- END: Custom CSS-->
</head>
<!-- END: Head-->

<?php $id = $this->session->userdata('admin_id'); ?>
<?php $id_satker = $this->session->userdata('admin_id_satker'); ?>
<?php $kategori=  $this->session->userdata('admin_kategori'); ?>
<?php $is_kontrak=  $this->session->userdata('admin_is_kontrak'); ?>
<body class="vertical-layout page-header-light vertical-menu-collapsible vertical-gradient-menu preload-transitions 2-columns   " data-open="click" data-menu="vertical-gradient-menu" data-col="2-columns">

    <!-- BEGIN: Header-->
    <header class="page-topbar" id="header">
        <div class="navbar navbar-fixed">
            <nav class="navbar-main navbar-color nav-collapsible sideNav-lock navbar-light">
                <div class="nav-wrapper">

                    <ul class="navbar-list right">
                        <li class="hide-on-med-and-down"><a class="waves-effect waves-block waves-light toggle-fullscreen" href="javascript:void(0);"><i class="material-icons">settings_overscan</i></a></li>
                        <!-- <li><a class="waves-effect waves-block waves-light notification-button" href="javascript:void(0);" data-target="notifications-dropdown"><i class="material-icons">notifications_none<small class="notification-badge">5</small></i></a></li> -->
                        <li><a href="<?php echo base_url(); ?>login/logout" class="waves-effect waves-block waves-light" onclick="javascript: return confirm('Yakin akan keluar dari aplikasi ?')"><i class="material-icons">keyboard_tab</i></a></li>
                    </ul>
                    <!-- translation-button-->

                    <!-- notifications-dropdown-->
                    <!-- <ul class="dropdown-content" id="notifications-dropdown">
                        <li>
                            <h6>NOTIFICATIONS<span class="new badge">5</span></h6>
                        </li>
                        <li class="divider"></li>
                        <li><a class="black-text" href="#!"><span class="material-icons icon-bg-circle cyan small">add_shopping_cart</span> A new order has been placed!</a>
                            <time class="media-meta grey-text darken-2" datetime="2015-06-12T20:50:48+08:00">2 hours ago</time>
                        </li>
                        <li><a class="black-text" href="#!"><span class="material-icons icon-bg-circle red small">stars</span> Completed the task</a>
                            <time class="media-meta grey-text darken-2" datetime="2015-06-12T20:50:48+08:00">3 days ago</time>
                        </li>
                        <li><a class="black-text" href="#!"><span class="material-icons icon-bg-circle teal small">settings</span> Settings updated</a>
                            <time class="media-meta grey-text darken-2" datetime="2015-06-12T20:50:48+08:00">4 days ago</time>
                        </li>
                        <li><a class="black-text" href="#!"><span class="material-icons icon-bg-circle deep-orange small">today</span> Director meeting started</a>
                            <time class="media-meta grey-text darken-2" datetime="2015-06-12T20:50:48+08:00">6 days ago</time>
                        </li>
                        <li><a class="black-text" href="#!"><span class="material-icons icon-bg-circle amber small">trending_up</span> Generate monthly report</a>
                            <time class="media-meta grey-text darken-2" datetime="2015-06-12T20:50:48+08:00">1 week ago</time>
                        </li>
                    </ul> -->
                    <!-- profile-dropdown-->
                    <!-- <a class="grey-text text-darken-1" href="user-login.html"><i class="material-icons">keyboard_tab</i> Logout</a> -->

                </div>

            </nav>
        </div>
    </header>
    <!-- END: Header-->

    <!-- BEGIN: SideNav-->

    <aside class="sidenav-main nav-expanded nav-lock nav-collapsible sidenav-dark gradient-45deg-deep-purple-blue sidenav-gradient sidenav-active-rounded">
        <div class="brand-sidebar">
            <h1 class="logo-wrapper"><a class="brand-logo darken-1" href="<?php echo base_url();?>"><img class="hide-on-med-and-down " src="<?php echo base_url();?>assets/new_design/images/logo/logo-bbspgl-final.png" alt="BLU BBSPGL" /><img class="show-on-medium-and-down hide-on-med-and-up" src="<?php echo base_url();?>assets/new_design/images/logo/logo-bbspgl-final.png" alt="materialize logo" /><span class="logo-text hide-on-med-and-down">eBLU BBSPGL</span></a><a class="navbar-toggler" href="#"><i class="material-icons">radio_button_checked</i></a></h1>
        </div>
        <ul class="sidenav sidenav-collapsible leftside-navigation collapsible sidenav-fixed menu-shadow" id="slide-out" data-menu="menu-navigation" data-collapsible="menu-accordion">
            <?php if ($kategori == 1) { ?>
            <li class="navigation-header"><a class="navigation-header-text">MENU AFIN</a><i class="navigation-header-icon material-icons">more_horiz</i></li>
            <li class="bold"><a class="waves-effect waves-cyan " href="<?php echo base_url(); ?>perusahaan"><i class="material-icons">face</i><span class="menu-title" data-i18n="User">Master Client</span></a></li>
            <li class="bold"><a class="waves-effect waves-cyan " href="<?php echo base_url(); ?>afin"><i class="material-icons">assignment</i><span class="menu-title" data-i18n="User">Kontrak</span></a></li>
            <li class="bold"><a class="waves-effect waves-cyan " href="<?php echo base_url(); ?>afin/ikm"><i class="material-icons">supervisor_account</i><span class="menu-title" data-i18n="User">IKM</span></a></li>
            <?php } ?>

            <?php if ($kategori == 999) { ?>
              <li class="navigation-header"><a class="navigation-header-text">MENU ADMIN SATKER</a><i class="navigation-header-icon material-icons">more_horiz</i></li>
              <li class="bold"><a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)"><i class="material-icons">settings</i><span class="menu-title" data-i18n="User">Setting</span></a>
                  <div class="collapsible-body">
                      <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                        <li><a href="<?php echo base_url(); ?>admin/target"><i class="material-icons">adjust</i><span class="hide-menu">Target</span></a></li>
                        <li><a href="<?php echo base_url(); ?>admin/rumah_layanan"><i class="material-icons">adjust</i><span class="hide-menu">Pelaksana Layanan</span></a></li>
                        <li><a href="<?php echo base_url(); ?>admin/jenis_layanan"><i class="material-icons">adjust</i><span class="hide-menu">Jenis Layanan</span></a></li>
                        <li><a href="<?php echo base_url(); ?>admin/kode_penerimaan"><i class="material-icons">adjust</i><span class="hide-menu">Kode Penerimaan</span></a></li>
                        <li><a href="<?php echo base_url(); ?>admin/kode_akun"><i class="material-icons">adjust</i><span class="hide-menu">Kode Akun</span></a></li>
                        <li><a href="<?php echo base_url(); ?>admin/pegawai"><i class="material-icons">adjust</i><span class="hide-menu">Pegawai</span></a></li>
                        <li><a href="<?php echo base_url(); ?>admin/jabatan"><i class="material-icons">adjust</i><span class="hide-menu">Jabatan</span></a></li>
                        <li><a href="<?php echo base_url(); ?>admin/user"><i class="material-icons">adjust</i><span class="hide-menu">User</span></a></li>
                        <li><a href="<?php echo base_url(); ?>admin/setting_satker"><i class="material-icons">adjust</i><span class="hide-menu">Setting Satker</span></a></li>
                      </ul>
                  </div>
              </li>
              <li class="bold"><a class="waves-effect waves-cyan " href="<?php echo base_url(); ?>admin"><i class="material-icons">assignment</i><span class="menu-title" data-i18n="User">Kontrak</span></a></li>
              
              <li class="bold"><a class="waves-effect waves-cyan " href="<?php echo base_url(); ?>admin/bios"><i class="material-icons">sync</i><span class="menu-title" data-i18n="User">Bios</span></a></li><?php } ?>


            <?php if ($kategori == 2) { ?>
            <li class="navigation-header"><a class="navigation-header-text">MENU PROGRAM</a><i class="navigation-header-icon material-icons">more_horiz</i></li>
            <li class="bold"><a class="waves-effect waves-cyan " href="<?php echo base_url(); ?>program"><i class="material-icons">assignment</i><span class="menu-title" data-i18n="User">Kontrak</span></a></li>
            <li class="bold"><a class="waves-effect waves-cyan " href="<?php echo base_url(); ?>program/rekomendasi"><i class="material-icons">verified_user</i><span class="menu-title" data-i18n="User">Rekomendasi Teknis</span></a></li>
            <?php } ?>
            <!-- <li class="bold"><a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)"><i class="material-icons">face</i><span class="menu-title" data-i18n="User">User</span><span class="badge badge pill purple float-right mr-10">3</span></a>
                <div class="collapsible-body">
                    <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                        <li><a href="page-users-list.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="List">List</span></a>
                        </li>
                        <li><a href="page-users-view.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="View">View</span></a>
                        </li>
                        <li><a href="page-users-edit.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Edit">Edit</span></a>
                        </li>
                    </ul>
                </div>
            </li> -->

            <?php if ($kategori == 8) { ?>
              <li class="navigation-header"><a class="navigation-header-text">MENU PEJABAT KEUANGAN</a><i class="navigation-header-icon material-icons">more_horiz</i></li>
              <li class="bold"><a class="waves-effect waves-cyan " href="<?php echo base_url(); ?>pejabat_keuangan"><i class="material-icons">assignment</i><span class="menu-title" data-i18n="User">Rencana Operasional</span></a></li>
            <?php } ?>

            <?php if ($kategori == 3 && $is_kontrak == 1) { ?>
              <li class="navigation-header"><a class="navigation-header-text">MENU PEJABAT TEKNIS</a><i class="navigation-header-icon material-icons">more_horiz</i></li>
              <li class="bold"><a class="waves-effect waves-cyan " href="<?php echo base_url(); ?>pejabat_teknis"><i class="material-icons">assignment</i><span class="menu-title" data-i18n="User">Kontrak</span></a></li>
            <?php } ?>

            <?php if ($kategori == 3 && $is_kontrak == 0) { ?>
              <li class="navigation-header"><a class="navigation-header-text">MENU PEJABAT TEKNIS</a><i class="navigation-header-icon material-icons">more_horiz</i></li>
              <li class="bold"><a class="waves-effect waves-cyan " href="<?php echo base_url(); ?>pejabat_teknis"><i class="material-icons">assignment</i><span class="menu-title" data-i18n="User">Rencana Operasional</span></a></li>
              <li class="bold"><a class="waves-effect waves-cyan " href="<?php echo base_url(); ?>pejabat_teknis/list_pengajuan"><i class="material-icons">assignment</i><span class="menu-title" data-i18n="User">Pengajuan</span></a></li>
            <?php } ?>

            <?php if ($kategori == 7) { ?>
              <li class="navigation-header"><a class="navigation-header-text">MENU PPK</a><i class="navigation-header-icon material-icons">more_horiz</i></li>
              <li class="bold"><a class="waves-effect waves-cyan " href="<?php echo base_url(); ?>ppk"><i class="material-icons">assignment</i><span class="menu-title" data-i18n="User">Pengajuan</span></a></li>
              <li class="bold"><a class="waves-effect waves-cyan " href="<?php echo base_url(); ?>ppk/rkakl"><i class="material-icons">assignment</i><span class="menu-title" data-i18n="User">Pengajuan RKAKL</span></a></li>
            <?php } ?>

            <?php if ($kategori == 4) { ?>
              <li class="navigation-header"><a class="navigation-header-text">BENDAHARA PENGELUARAN</a><i class="navigation-header-icon material-icons">more_horiz</i></li>
              <li class="bold"><a class="waves-effect waves-cyan " href="<?php echo base_url(); ?>bendahara_pengeluaran/saldo"><i class="material-icons">info</i><span class="menu-title" data-i18n="User">Saldo Rekening</span></a></li>
              <li class="bold"><a class="waves-effect waves-cyan " href="<?php echo base_url(); ?>bendahara_pengeluaran"><i class="material-icons">assignment</i><span class="menu-title" data-i18n="User">Pengajuan</span></a></li>
              <li class="bold"><a class="waves-effect waves-cyan " href="<?php echo base_url(); ?>bendahara_pengeluaran/rkakl"><i class="material-icons">assignment</i><span class="menu-title" data-i18n="User">Pengajuan RKAKL</span></a></li>
            <?php } ?>

            <?php if ($kategori == 9) { ?>
              <li class="navigation-header"><a class="navigation-header-text">MENU PPK</a><i class="navigation-header-icon material-icons">more_horiz</i></li>
              <li><a href="<?php echo base_url(); ?>tata_usaha"><i class="material-icons">assignment</i><span class="hide-menu">Rencana Operasional</span></a></li>
              <li><a href="<?php echo base_url(); ?>tata_usaha/list_pengajuan"><i class="material-icons">assignment</i><span class="hide-menu">Pengajuan</span></a></li>
            <?php } ?>

            <?php if ($kategori == 5) { ?>
              <li class="navigation-header"><a class="navigation-header-text">BENDAHARA PENERIMAAN</a><i class="navigation-header-icon material-icons">more_horiz</i></li>
              <li class="bold"><a class="waves-effect waves-cyan " href="<?php echo base_url(); ?>bendahara_penerimaan/saldo"><i class="material-icons">info</i><span class="menu-title" data-i18n="User">Saldo Rekening</span></a></li>
              <li class="bold"><a class="waves-effect waves-cyan " href="<?php echo base_url(); ?>perusahaan"><i class="material-icons">face</i><span class="menu-title" data-i18n="User">Master Client</span></a></li>
              <?php $terlambat = $this->db->query("SELECT id_termin, DATEDIFF(CURRENT_DATE(), tgl_termin) AS selisih FROM termin INNER JOIN kontrak ON termin.id_kontrak = kontrak.id_kontrak WHERE status_cetak_invoice = 1 AND status_pembayaran=0 AND DATEDIFF(CURRENT_DATE(), tgl_termin) > 30 AND kontrak.status='K' AND kontrak.id_satker=$id_satker")->num_rows();?>
              <li class="bold"><a class="waves-effect waves-cyan " href="<?php echo base_url(); ?>bendahara_penerimaan"><i class="material-icons">description</i><span class="menu-title" data-i18n="Mail">Termin</span><span class="badge new pill pink accent-2 float-right mr-2"><?php echo $terlambat;?></span></a></li>
              <!-- <li class="bold"><a class="waves-effect waves-cyan " href="<?php echo base_url(); ?>bendahara_penerimaan/list_kategori"><i class="material-icons">equalizer</i><span class="menu-title" data-i18n="User">Purchase Order</span></a> -->
              <li class="bold"><a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)"><i class="material-icons">equalizer</i><span class="menu-title" data-i18n="User">Purchase Order</span></a>
                  <div class="collapsible-body">
                      <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                          <li><a href="<?php echo base_url(); ?>bendahara_penerimaan/list_po/1"><i class="material-icons">radio_button_unchecked</i><span data-i18n="View">Lab Pengujian</span></a></li>
                          <li><a href="<?php echo base_url(); ?>bendahara_penerimaan/list_po/2"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Edit">Gedung</span></a></li>
                          <li><a href="<?php echo base_url(); ?>bendahara_penerimaan/list_po/3"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Edit">Wisma</span></a></li>
                          <li><a href="<?php echo base_url(); ?>bendahara_penerimaan/list_po/4"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Edit">Lainnya</span></a></li>
                          <li><a href="<?php echo base_url(); ?>bendahara_penerimaan/list_ba_po"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Edit">Berita Acara</span></a></li>
                      </ul>
                  </div>
              </li>
          <?php } ?>

          <?php if ($kategori != 999) { ?>
          <li>
            <li class="bold"><a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)"><i class="material-icons">inbox</i><span class="menu-title" data-i18n="User">Inbox</span></a>
              <div class="collapsible-body">
                  <ul>
                      <?php if ($kategori == 2) { ?>
                      <li><a href="<?php echo base_url(); ?>inbox/inbox_progress"><i class="material-icons">adjust</i><span class="hide-menu">Progress</span></a></li>
                      <?php } ?>
                      <li><a href="#"><i class="material-icons">adjust</i><span class="hide-menu">Kendala</span></a></li>
                  </ul>
              </div>
          </li>
          <?php } ?>

          </ul>
        <div class="navigation-background"></div><a class="sidenav-trigger btn-sidenav-toggle btn-floating btn-medium waves-effect waves-light hide-on-large-only" href="#" data-target="slide-out"><i class="material-icons">menu</i></a>
    </aside>
