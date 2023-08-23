<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url(); ?>favicon.ico">
    <title>MONIKA - BLU BALITBANG ESDM</title>
    <link href="<?php echo base_url(); ?>assets/new/dist/css/style.css" rel="stylesheet">
    <!-- This page CSS -->
    <link href="<?php echo base_url(); ?>assets/new/dist/css/pages/data-table.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/new/libs/footable/css/footable.core.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/new/dist/css/pages/footable-page.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/new/extra-libs/prism/prism.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/new/dist/css/pages/email.css" rel="stylesheet">
    <!-- <link href="<?php echo base_url(); ?>assets/new/dist/css/pages/dashboard1.css" rel="stylesheet"> -->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<div id="password" class="modal">
    <div class="modal-content">
        <h4>GANTI PASSWORD</h4>
          <?php echo form_open_multipart('login/update_password');?>
          <?php $id = $this->session->userdata('admin_id'); ?>
          <?php $id_satker = $this->session->userdata('admin_id_satker'); ?>
            <div class="row">
                <div class="input-field col s12">
                  <input id="id_user" type="text" name="id_user" value="<?php echo $id; ?>" hidden>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                  <input id="a9" type="password" name="password" required>
                  <label for="a9">Password Lama</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                  <input id="a9" type="password" name="new_password" required>
                  <label for="a9">Password Baru</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                  <input id="a9" type="password" name="confirm_password" required>
                  <label for="a9">Konfirmasi Password Baru</label>
                </div>
            </div>
          <div class="row">
              <div class="input-field col s12">
                  <button class="btn cyan waves-effect waves-light left" type="submit" name="action">Simpan</button>
              </div>
          </div>
        </form>
      </div>
</div>
<body>
    <div class="main-wrapper" id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader">
            <div class="loader">
                <div class="loader__figure"></div>
                <p class="loader__label">MONIKA ESDM</p>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <header class="topbar">
            <!-- ============================================================== -->
            <!-- Navbar scss in header.scss -->
            <!-- ============================================================== -->
            <nav>
                <div class="nav-wrapper">
                    <!-- ============================================================== -->
                    <!-- Logo you can find that scss in header.scss -->
                    <!-- ============================================================== -->
                    <a href="javascript:void(0)" class="brand-logo">
                    <!--   <h1 class="logo-wrapper"><a class="brand-logo darken-1" href="<?php echo base_url();?>"><img class="hide-on-med-and-down " src="<?php echo base_url();?>assets/new_design/images/logo/logo-bbspgl-final.png" alt="BLU BBSPGL" /><img class="show-on-medium-and-down hide-on-med-and-up" src="<?php echo base_url();?>assets/new_design/images/logo/logo-bbspgl-final.png" alt="materialize logo" /><span class="logo-text hide-on-med-and-down">eBLU BBSPGL</span></a><a class="navbar-toggler" href="#"><i class="material-icons">radio_button_checked</i></a></h1>--> <span class="icon">
                            <!-- <img class="light-logo" src="<?php echo base_url()?>assets/new/images/logo-light-icon.png">
                            <img class="dark-logo" src="<?php echo base_url()?>assets/new/images/logo-icon.png"> -->
                        <img class="light-logo" width="150" height="56" src="<?php echo base_url()?>assets/new_design/images/logo/logo-bbspgl-final.png">
			</span>
                        <span class="text">
                           <!-- <img class="light-logo" src="<?php echo base_url()?>assets/new/images/logo-light-text.png"> -->
                            <img class="dark-logo" src="<?php echo base_url()?>assets/new/images/logo-text.png">
                        </span>
                    </a>
                    <!-- ============================================================== -->
                    <!-- Logo you can find that scss in header.scss -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Left topbar icon scss in header.scss -->
                    <!-- ============================================================== -->
                    <ul class="left">
                        <li class="hide-on-med-and-down">
                            <a href="javascript: void(0);" class="nav-toggle">
                                <span class="bars bar1"></span>
                                <span class="bars bar2"></span>
                                <span class="bars bar3"></span>
                            </a>
                        </li>
                        <li class="hide-on-large-only">
                            <a href="javascript: void(0);" class="sidebar-toggle">
                                <span class="bars bar1"></span>
                                <span class="bars bar2"></span>
                                <span class="bars bar3"></span>
                            </a>
                        </li>
                        <!-- ============================================================== -->
                        <!-- Notification icon scss in header.scss -->
                        <!-- ============================================================== -->

                        <!-- ============================================================== -->
                        <!-- Comment topbar icon scss in header.scss -->
                        <!-- ============================================================== -->

                    </ul>
                    <!-- ============================================================== -->
                    <!-- Left topbar icon scss in header.scss -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Right topbar icon scss in header.scss -->
                    <!-- ============================================================== -->
                    <ul class="right">

                        <!-- ============================================================== -->
                        <!-- Profile icon scss in header.scss -->
                        <!-- ============================================================== -->
                        <li><a class="dropdown-trigger" href="javascript: void(0);" data-target="user_dropdown"><img src="<?php echo base_url(); ?>assets/new/images/users/2.jpg" alt="user" class="circle profile-pic"></a>
                            <ul id="user_dropdown" class="mailbox dropdown-content dropdown-user">
                                <li>
                                    <div class="dw-user-box">
                                        <div class="u-img"><img src="<?php echo base_url(); ?>assets/new/images/users/2.jpg" alt="user"></div>
                                        <div class="u-text">
                                            <h4><?php echo $this->session->userdata('admin_nama'); ?></h4>
                                              <?php echo $this->session->userdata('admin_nama_satker'); ?><br/>
                                              <!-- <?php echo $this->session->userdata('admin_key_satker'); ?><br/>
                                              <?php echo $this->session->userdata('admin_satker'); ?><br/> -->
                                        </div>
                                    </div>
                                </li>
                                <li role="separator" class="divider"></li>
                                <li><a href="#password" class="modal-trigger"><i class="material-icons">account_circle</i> Ganti Password</a></li>
                                <li><a href="<?php echo base_url(); ?>login/logout"><i class="material-icons">power_settings_new</i> Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                    <!-- ============================================================== -->
                    <!-- Right topbar icon scss in header.scss -->
                    <!-- ============================================================== -->
                </div>
            </nav>
            <!-- ============================================================== -->
            <!-- Navbar scss in header.scss -->
            <!-- ============================================================== -->
        </header>
        <!-- ============================================================== -->
        <!-- Sidebar scss in sidebar.scss -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">
            <ul id="slide-out" class="sidenav">
                <li>
                    <ul class="collapsible p-t-30">
                      <?php $kategori=  $this->session->userdata('admin_kategori'); ?>
                      <?php $is_kontrak=  $this->session->userdata('admin_is_kontrak'); ?>
                        <?php if ($kategori == 1) { ?>
                         <li>
                            <a href="<?php echo base_url(); ?>perusahaan" class="collapsible-header"><i class="material-icons">domain</i><span class="hide-menu">Master Client</span></a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>afin" class="collapsible-header"><i class="material-icons">assignment</i><span class="hide-menu">Kontrak</span></a>
                        </li>
                        <?php } ?>
                        <?php if ($kategori == 2) { ?>
                          <!-- <li class="small-cap"><span class="hide-menu">SETTING</span></li>
                          <li>
                              <a href="javascript: void(0);" class="collapsible-header has-arrow"><i class="material-icons">settings</i><span class="hide-menu"> Master Data</span></a>
                              <div class="collapsible-body">
                                  <ul>
                                      <li><a href="<?php echo base_url(); ?>program/target"><i class="material-icons">adjust</i><span class="hide-menu">Target</span></a></li>
                                      <li><a href="<?php echo base_url(); ?>program/rumah_layanan"><i class="material-icons">adjust</i><span class="hide-menu">Pelaksana Layanan</span></a></li>
                                      <li><a href="<?php echo base_url(); ?>program/jenis_layanan"><i class="material-icons">adjust</i><span class="hide-menu">Jenis Layanan</span></a></li>
                                      <li><a href="<?php echo base_url(); ?>program/kode_penerimaan"><i class="material-icons">adjust</i><span class="hide-menu">Kode Penerimaan</span></a></li>
                                      <li><a href="<?php echo base_url(); ?>program/kode_akun"><i class="material-icons">adjust</i><span class="hide-menu">Kode Akun</span></a></li>
                                      <li><a href="<?php echo base_url(); ?>program/pegawai"><i class="material-icons">adjust</i><span class="hide-menu">Pegawai</span></a></li>
                                      <li><a href="<?php echo base_url(); ?>program/jabatan"><i class="material-icons">adjust</i><span class="hide-menu">Jabatan</span></a></li>
                                      <li><a href="<?php echo base_url(); ?>program/user"><i class="material-icons">adjust</i><span class="hide-menu">User</span></a></li>
                                  </ul>
                              </div>
                          </li> -->
                          <li class="small-cap"><span class="hide-menu">TRANSAKSI</span></li>
                        <li>
                              <a href="<?php echo base_url(); ?>program" class="collapsible-header"><i class="material-icons">assignment</i><span class="hide-menu">Kontrak</span></a>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="collapsible-header has-arrow"><i class="material-icons">equalizer</i><span class="hide-menu"> Purchase Order </span></a>
                            <div class="collapsible-body">
                                <ul>
                                    <li><a href="<?php echo base_url(); ?>program/rekap_po"><i class="material-icons">printer</i><span class="hide-menu">Rekap PO</span></a></li>
                                </ul>
                            </div>
                        </li>
                        <?php } ?>
                        <?php if ($kategori == 999) { ?>
                          <li class="small-cap"><span class="hide-menu">SETTING</span></li>
                          <li>
                              <a href="javascript: void(0);" class="collapsible-header has-arrow"><i class="material-icons">settings</i><span class="hide-menu"> Master Data</span></a>
                              <div class="collapsible-body">
                                  <ul>
                                      <li><a href="<?php echo base_url(); ?>admin/target"><i class="material-icons">adjust</i><span class="hide-menu">Target</span></a></li>
                                      <li><a href="<?php echo base_url(); ?>admin/rumah_layanan"><i class="material-icons">adjust</i><span class="hide-menu">Pelaksana Layanan</span></a></li>
                                      <li><a href="<?php echo base_url(); ?>admin/jenis_layanan"><i class="material-icons">adjust</i><span class="hide-menu">Jenis Layanan</span></a></li>
                                      <li><a href="<?php echo base_url(); ?>admin/kode_penerimaan"><i class="material-icons">adjust</i><span class="hide-menu">Kode Penerimaan</span></a></li>
                                      <li><a href="<?php echo base_url(); ?>admin/kode_akun"><i class="material-icons">adjust</i><span class="hide-menu">Kode Akun</span></a></li>
                                      <li><a href="<?php echo base_url(); ?>admin/pegawai"><i class="material-icons">adjust</i><span class="hide-menu">Pegawai</span></a></li>
                                      <li><a href="<?php echo base_url(); ?>admin/jabatan"><i class="material-icons">adjust</i><span class="hide-menu">Jabatan</span></a></li>
                                      <li><a href="<?php echo base_url(); ?>admin/user"><i class="material-icons">adjust</i><span class="hide-menu">User</span></a></li>
                                  </ul>
                              </div>
                          </li>
                          <li>
                                <a href="<?php echo base_url(); ?>admin" class="collapsible-header"><i class="material-icons">assignment</i><span class="hide-menu">Log History</span></a>
                          </li>
                        <?php } ?>
                        <?php if ($kategori == 3 && $is_kontrak == 1) { ?>
                        <li>
                              <a href="<?php echo base_url(); ?>pejabat_teknis" class="collapsible-header"><i class="material-icons">assignment</i><span class="hide-menu">Kontrak</span></a>
                        </li>
                        <?php } ?>
                        <?php if ($kategori == 3 && $is_kontrak == 0) { ?>
                          <li>
                                <a href="<?php echo base_url(); ?>pejabat_teknis" class="collapsible-header"><i class="material-icons">assignment</i><span class="hide-menu">Rencana Operasional</span></a>
                          </li>
                          <li>
                                <a href="<?php echo base_url(); ?>pejabat_teknis/list_pengajuan" class="collapsible-header"><i class="material-icons">assignment</i><span class="hide-menu">Pengajuan</span></a>
                          </li>
                        <?php } ?>
                        <?php if ($kategori == 9) { ?>
                          <li>
                                <a href="<?php echo base_url(); ?>tata_usaha" class="collapsible-header"><i class="material-icons">assignment</i><span class="hide-menu">Rencana Operasional</span></a>
                          </li>
                          <li>
                                <a href="<?php echo base_url(); ?>tata_usaha/list_pengajuan" class="collapsible-header"><i class="material-icons">assignment</i><span class="hide-menu">Pengajuan</span></a>
                          </li>
                        <?php } ?>
                        <?php if ($kategori == 7) { ?>
                        <li>
                              <a href="<?php echo base_url(); ?>ppk" class="collapsible-header"><i class="material-icons">assignment</i><span class="hide-menu">Pengajuan</span></a>
                        </li>
                        <?php } ?>
                        <?php if ($kategori == 8) { ?>
                        <li>
                              <a href="<?php echo base_url(); ?>pejabat_keuangan" class="collapsible-header"><i class="material-icons">assignment</i><span class="hide-menu">Rencana Operasional</span></a>
                        </li>
                        <?php } ?>
                        <?php if ($kategori == 4) { ?>
                          <li>
                                <a href="<?php echo base_url(); ?>bendahara_pengeluaran" class="collapsible-header"><i class="material-icons">assignment</i><span class="hide-menu">Pengajuan Operasional</span></a>
                          </li>
                        <?php } ?>
                        <?php if ($kategori == 5) { ?>
                          <li>
                             <a href="<?php echo base_url(); ?>perusahaan" class="collapsible-header"><i class="material-icons">domain</i><span class="hide-menu">Master Client</span></a>
                         </li>
                          <li>
                              <a href="javascript: void(0);" class="collapsible-header has-arrow"><i class="material-icons">equalizer</i><span class="hide-menu"> Purchase Order </span></a>
                              <div class="collapsible-body">
                                  <ul>
                                      <li><a href="<?php echo base_url(); ?>bendahara_penerimaan/list_kategori"><i class="material-icons">adjust</i><span class="hide-menu">Tambah Data PO</span></a></li>
                                      <li><a href="<?php echo base_url(); ?>bendahara_penerimaan/list_po/1"><i class="material-icons">adjust</i><span class="hide-menu">Rekap PO Lab Pengujian</span></a></li>
                                      <li><a href="<?php echo base_url(); ?>bendahara_penerimaan/list_po/2"><i class="material-icons">adjust</i><span class="hide-menu">Rekap PO Gedung</span></a></li>
                                      <li><a href="<?php echo base_url(); ?>bendahara_penerimaan/list_po/3"><i class="material-icons">adjust</i><span class="hide-menu">Rekap PO Wisma</span></a></li>
				      <li><a href="<?php echo base_url(); ?>bendahara_penerimaan/list_po/4"><i class="material-icons">adjust</i><span class="hide-menu">Rekap PO Lainnya</span></a></li>
                                      <li><a href="<?php echo base_url(); ?>bendahara_penerimaan/list_ba_po"><i class="material-icons">adjust</i><span class="hide-menu">Rekap Berita Acara</span></a></li>
                                  </ul>
                              </div>
                          </li>
                          <li>
                                <?php $terlambat = $this->db->query("SELECT id_termin, DATEDIFF(CURRENT_DATE(), tgl_termin) AS selisih FROM termin INNER JOIN kontrak ON termin.id_kontrak = kontrak.id_kontrak WHERE status_cetak_invoice = 1 AND status_pembayaran=0 AND DATEDIFF(CURRENT_DATE(), tgl_termin) > 30 AND kontrak.status='K' AND kontrak.id_satker=$id_satker")->num_rows();?>
                                <a href="<?php echo base_url(); ?>bendahara_penerimaan" class="collapsible-header"><i class="material-icons">assignment</i><span class="hide-menu">Termin Pembayaran &nbsp;<span class="label label-table label-warning"><?php echo $terlambat;?></span></span></a>
                          </li>
                        <!-- <li>
                            <a href="javascript: void(0);" class="collapsible-header has-arrow"><i class="material-icons">library_books</i><span class="hide-menu"> Purchase Order </span></a>
                            <div class="collapsible-body">
                                <ul>
                                    <li><a href="<?php echo base_url(); ?>bendahara/list_po"><i class="material-icons">assignment</i><span class="hide-menu">List PO</span></a></li>
                                    <li><a href="<?php echo base_url(); ?>bendahara/rekap_po"><i class="material-icons">equalizer</i><span class="hide-menu">Rekap PO</span></a></li>
                                    <li><a href="<?php echo base_url(); ?>bendahara/list_ba_po"><i class="material-icons">printer</i><span class="hide-menu">Berita Acara PO</span></a></li>
                                </ul>
                            </div>
                        </li> -->
                      <?php } ?>
                      <!-- <li>
                            <a href="<?php echo base_url(); ?>inbox" class="collapsible-header"><i class="material-icons">inbox</i><span class="hide-menu">Inbox</span></a>
                      </li> -->
                      <?php if ($kategori != 999) { ?>
                      <li class="small-cap"><span class="hide-menu">INBOX</span></li>
                      <li>
                          <a href="javascript: void(0);" class="collapsible-header has-arrow"><i class="material-icons">inbox</i><span class="hide-menu"> Inbox</span></a>
                          <div class="collapsible-body">
                              <ul>
                                  <?php if ($kategori == 2) { ?>
                                  <li><a href="<?php echo base_url(); ?>inbox/inbox_progress"><i class="material-icons">adjust</i><span class="hide-menu">Progress</span></a></li>
                                  <?php } ?>
                                  <li><a href="<?php echo base_url(); ?>inbox"><i class="material-icons">adjust</i><span class="hide-menu">Kendala</span></a></li>
                              </ul>
                          </div>
                      </li>
                      <?php } ?>
                        <!-- <li>
                            <a class="collapsible-header has-arrow"><i class="material-icons">clear_all</i><span class="hide-menu">Multi Levels</span></a>
                            <div class="collapsible-body">
                                <ul class="collapsible" data-collapsible="accordion">
                                    <li>
                                        <a href="javascript:void(0)">
                                            <i class="material-icons">grade</i>
                                            <span class="hide-menu">Second level</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="collapsible-header has-arrow">
                                            <i class="material-icons">looks_two</i>
                                            <span class="nav-text">Second level child</span>
                                        </a>
                                        <div class="collapsible-body">
                                            <ul class="collapsible" data-collapsible="accordion">
                                                <li>
                                                    <a href="javascript:void(0)">
                                                        <i class="material-icons">grade</i>
                                                        <span class="hide-menu">Third level</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="collapsible-header has-arrow">
                                                        <i class="material-icons">looks_3</i>
                                                        <span class="hide-menu">Third level child</span>
                                                    </a>
                                                    <div class="collapsible-body">
                                                        <ul class="collapsible" data-collapsible="accordion">
                                                            <li>
                                                                <a href="javascript:void(0)">
                                                                    <i class="material-icons">grade</i>
                                                                    <span class="hide-menu">Forth level</span>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0)">
                                                                    <i class="material-icons">grade</i>
                                                                    <span class="hide-menu">Forth level</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li> -->
                    </ul>
                </li>
            </ul>
        </aside>
        <!-- ============================================================== -->
        <!-- Sidebar scss in sidebar.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper scss in scafholding.scss -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Title and breadcrumb -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid scss in scafholding.scss -->
            <!-- ============================================================== -->

            <!-- ============================================================== -->
            <!-- Container fluid scss in scafholding.scss -->
            <!-- ============================================================== -->
