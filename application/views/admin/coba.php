<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url(); ?>favicon.ico">
    <title>MONIKA - BLU TEKMIRA</title>
    <link href="<?php echo base_url(); ?>assets/new/dist/css/style.css" rel="stylesheet">
    <!-- This page CSS -->
    <link href="<?php echo base_url(); ?>assets/new/dist/css/pages/data-table.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/new/libs/footable/css/footable.core.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/new/dist/css/pages/footable-page.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/new/extra-libs/prism/prism.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/new/dist/css/pages/email.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <!-- <link href="<?php echo base_url(); ?>assets/new/dist/css/pages/dashboard1.css" rel="stylesheet"> -->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

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
                        <span class="icon">
                            <img class="light-logo" src="<?php echo base_url()?>assets/new/images/logo-light-icon.png">
                            <img class="dark-logo" src="<?php echo base_url()?>assets/new/images/logo-icon.png">
                        </span>
                        <span class="text">
                            <img class="light-logo" src="<?php echo base_url()?>assets/new/images/logo-light-text.png">
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
                                              <?php echo $this->session->userdata('admin_satker'); ?><br/>
                                        </div>
                                    </div>
                                </li>
                                <li role="separator" class="divider"></li>
                                <li><a href="#"><i class="material-icons">account_circle</i> My Profile</a></li>
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
                          <li class="small-cap"><span class="hide-menu">SETTING</span></li>
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
                          </li>
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
                                      <li><a href="<?php echo base_url(); ?>bendahara_penerimaan/list_ba_po"><i class="material-icons">adjust</i><span class="hide-menu">Rekap Berita Acara</span></a></li>
                                  </ul>
                              </div>
                          </li>
                          <li>
                                <a href="<?php echo base_url(); ?>bendahara_penerimaan" class="collapsible-header"><i class="material-icons">assignment</i><span class="hide-menu">Termin Pembayaran</span></a>
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


            <div class="container-fluid">
                <div class="row">
                    <div class="col s12">
                        <div class="card">
                            <div class="card-content">
                              <h5 class="card-title activator">Tambah Data PO Gedung</h5>
                              <?php echo form_open_multipart('coba/submit');?>
                              <div class="row">
                                  <div class="col s12">
                                      <div class="row">
                                          <div class="input-field col s12">
                                              <i class="material-icons prefix">textsms</i>
                                              <input type="text" id="autocomplete-input" class="autocomplete" name="nama_perusahaan">
                                              <label for="autocomplete-input">Autocomplete</label>
                                          </div>
                                      </div>
                                      <div class="row">
                                          <div class="input-field col s12">
                                              <button class="btn cyan waves-effect waves-light left" type="submit" name="action">Simpan</button>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>




            <footer class="center-align m-b-30">&copy; 2020 Balitbang | BLU PROMISES</footer>
            </div>
            <!-- ============================================================== -->
            <!-- Page wrapper scss in scafholding.scss -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Right Sidebar -->
            <!-- ============================================================== -->
            <a href="#" data-target="right-slide-out" class="sidenav-trigger right-side-toggle btn-floating btn-large waves-effect waves-light red"><i class="material-icons">settings</i></a>
            <aside class="right-sidebar">
            <!-- Right Sidebar -->
            <ul id="right-slide-out" class="sidenav right-sidenav p-t-10">
                <li>
                    <div class="row">
                        <div class="col s12">
                            <!-- Tabs -->
                            <ul class="tabs">
                                <li class="tab col s4"><a href="#settings" class="active"><span class="material-icons">build</span></a></li>
                                <!-- <li class="tab col s4"><a href="#chat"><span class="material-icons">chat_bubble</span></a></li> -->
                                <!-- <li class="tab col s4"><a href="#activity"><span class="material-icons">local_activity</span></a></li> -->
                            </ul>
                            <!-- Tabs -->
                        </div>
                        <!-- Setting -->
                        <div id="settings" class="col s12">
                            <div class="m-t-10 p-10 b-b">
                                <h6 class="font-medium">Layout Settings</h6>
                                <ul class="m-t-15">
                                    <li class="m-b-10">
                                        <label>
                                            <input type="checkbox" name="theme-view" id="theme-view" />
                                            <span>Dark Theme</span>
                                        </label>
                                    </li>
                                    <li class="m-b-10">
                                        <label>
                                            <input type="checkbox" class="nav-toggle" name="collapssidebar" id="collapssidebar" />
                                            <span>Collapse Sidebar</span>
                                        </label>
                                    </li>
                                    <li class="m-b-10">
                                        <label>
                                            <input type="checkbox" name="sidebar-position" id="sidebar-position" />
                                            <span>Fixed Sidebar</span>
                                        </label>
                                    </li>
                                    <li class="m-b-10">
                                        <label>
                                            <input type="checkbox" name="header-position" id="header-position" />
                                            <span>Fixed Header</span>
                                        </label>
                                    </li>
                                    <li class="m-b-10">
                                        <label>
                                            <input type="checkbox" name="boxed-layout" id="boxed-layout" />
                                            <span>Boxed Layout</span>
                                        </label>
                                    </li>
                                </ul>
                            </div>
                            <div class="p-10 b-b">
                                <!-- Logo BG -->
                                <h6 class="font-medium">Logo Backgrounds</h6>
                                <ul class="m-t-15 theme-color">
                                    <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-logobg="skin1"></a></li>
                                    <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-logobg="skin2"></a></li>
                                    <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-logobg="skin3"></a></li>
                                    <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-logobg="skin4"></a></li>
                                    <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-logobg="skin5"></a></li>
                                    <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-logobg="skin6"></a></li>
                                </ul>
                                <!-- Logo BG -->
                            </div>
                            <div class="p-10 b-b">
                                <!-- Navbar BG -->
                                <h6 class="font-medium">Navbar Backgrounds</h6>
                                <ul class="m-t-15 theme-color">
                                    <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-navbarbg="skin1"></a></li>
                                    <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-navbarbg="skin2"></a></li>
                                    <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-navbarbg="skin3"></a></li>
                                    <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-navbarbg="skin4"></a></li>
                                    <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-navbarbg="skin5"></a></li>
                                    <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-navbarbg="skin6"></a></li>
                                </ul>
                                <!-- Navbar BG -->
                            </div>
                            <div class="p-10 b-b">
                                <!-- Logo BG -->
                                <h6 class="font-medium">Sidebar Backgrounds</h6>
                                <ul class="m-t-15 theme-color">
                                    <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-sidebarbg="skin1"></a></li>
                                    <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-sidebarbg="skin2"></a></li>
                                    <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-sidebarbg="skin3"></a></li>
                                    <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-sidebarbg="skin4"></a></li>
                                    <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-sidebarbg="skin5"></a></li>
                                    <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-sidebarbg="skin6"></a></li>
                                </ul>
                                <!-- Logo BG -->
                            </div>
                        </div>

                    </div>
                </li>
            </ul>
            </aside>
            <!-- ============================================================== -->
            <!-- Right Sidebar -->
            <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- All Required js -->
            <!-- ============================================================== -->
            <script src="<?php echo base_url()?>assets/new/libs/jquery/dist/jquery.min.js"></script>
            <script src="<?php echo base_url();?>assets/new/dist/js/materialize.min.js"></script>
            <script src="<?php echo base_url()?>assets/new/libs/perfect-scrollbar/dist/js/perfect-scrollbar.jquery.min.js"></script>
            <!-- ============================================================== -->
            <!-- Apps -->
            <!-- ============================================================== -->
            <script src="<?php echo base_url();?>assets/new/dist/js/app.js"></script>
            <script src="<?php echo base_url();?>assets/new/dist/js/app.init.js"></script>
            <script src="<?php echo base_url();?>assets/new/dist/js/app-style-switcher.js"></script>
            <!-- ============================================================== -->
            <!-- Custom js -->
            <!-- ============================================================== -->
            <script src="<?php echo base_url();?>assets/new/dist/js/custom.min.js"></script>
            <script src="<?php echo base_url();?>assets/new/dist/js/pages/inbox/email.js"></script>
            <!-- ============================================================== -->
            <!-- This page plugin js -->
            <!-- ============================================================== -->
            <!-- Footable -->
            <script src="<?php echo base_url();?>assets/new/extra-libs/Datatables/datatables.min.js"></script>
            <script src="<?php echo base_url();?>assets/new/dist/js/pages/datatable/datatable-basic.init.js"></script>
            <script src="<?php echo base_url();?>assets/new/libs/footable/dist/footable.all.min.js"></script>
            <script src="<?php echo base_url();?>assets/new/dist/js/pages/footable/footable-init.js"></script>
            <!-- <script src="<?php echo base_url();?>assets/new/extra-libs/prism/prism.js"></script> -->
            <script src="<?php echo base_url();?>assets/new/dist/js/pages/forms/jquery.validate.min.js"></script>
            <script src="<?php echo base_url();?>assets/new/libs/tinymce/tinymce.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

            <script>
            $(document).ready(function() {
                if ($("#mymce").length > 0) {
                    tinymce.init({
                        selector: "textarea#mymce",
                        theme: "modern",
                        height: 300,
                        plugins: [
                            "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                            "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                            "save table contextmenu directionality emoticons template paste textcolor"
                        ],
                        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",

                    });
                }
            });
            </script>
            <script>
            $(function() {
                $("#formValidate").validate({
                    rules: {
                        uname: {
                            required: true,
                            minlength: 5
                        },
                        cemail: {
                            required: true,
                            email: true
                        },
                        pwd: {
                            required: true,
                            minlength: 5
                        },
                        ccomment: {
                            required: true,
                            minlength: 15
                        }
                    },
                    //For custom messages
                    messages: {
                        uname: {
                            required: "Enter a username",
                            minlength: "Enter at least 5 characters"
                        }
                    },
                    errorElement: 'div',
                    errorPlacement: function(error, element) {
                        var placement = $(element).data('error');
                        if (placement) {
                            $(placement).append(error)
                        } else {
                            error.insertAfter(element);
                        }
                    },
                    invalidHandler: function(e, validator) {
                        var errors = validator.numberOfInvalids();
                        if (errors) {
                            $('.error-alert-bar').show();
                        }
                    },
                    submitHandler: function() {
                        $('.error-alert-bar').hide();
                        $('.success-alert-bar').show().delay(5000).fadeOut();
                    }
                });
            });

            $(document).ready(function() {
                $('.select2').select2();
            });
            </script>

            <script type="text/javascript">


//             $(document).ready(function() {
//   //Autocomplete
//   $(function() {
//     $.ajax({
//       type: 'GET',
//       url: 'http://localhost/monikadev/api/getclient',
//       success: function(response) {
//         var dataArray = response;
//         var dataCountry = {};
//         for (var i = 0; i < dataArray.length; i++) {
//           //console.log(data[i].name);
//           dataCountry[dataArray[i].nama] = null; //countryArray[i].flag or null
//         }
//         $('input.autocomplete').autocomplete({
//           data: dataCountry,
//           //limit: 5, // The max amount of results that can be shown at once. Default: Infinity.
//         });
//       }
//     });
//   });
// });


$(document).ready(function() {
  //Autocomplete
  $(function() {
    $.ajax({
      type: 'GET',
      url: 'https://api-monika.tekmira.esdm.go.id/index.php/client',
      success: function(response) {
        var countryArray = response;
        var dataCountry = {};
        for (var i = 0; i < countryArray.length; i++) {
          //console.log(countryArray[i].name);
          dataCountry[countryArray[i].nama_perusahaan] = null; //countryArray[i].flag or null
        }
        $('input.autocomplete').autocomplete({
          data: dataCountry,
          limit: 5, // The max amount of results that can be shown at once. Default: Infinity.
        });
      }
    });
  });
});

            </script>

            </body>

            </html>
