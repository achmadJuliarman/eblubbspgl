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
    <title>Form Editor | Materialize - Material Design Admin Template</title>
    <link rel="apple-touch-icon" href="<?php echo base_url();?>assets/new_design/images/favicon/apple-touch-icon-152x152.png">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url();?>assets/new_design/images/favicon/favicon-32x32.png">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- BEGIN: VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/new_design/vendors/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/new_design/vendors/flag-icon/css/flag-icon.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/new_design/vendors/quill/katex.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/new_design/vendors/quill/monokai-sublime.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/new_design/vendors/quill/quill.snow.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/new_design/vendors/quill/quill.bubble.css">
    <!-- END: VENDOR CSS-->
    <!-- BEGIN: Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/new_design/css/themes/vertical-gradient-menu-template/materialize.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/new_design/css/themes/vertical-gradient-menu-template/style.css">
    <!-- END: Page Level CSS-->
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
            <h1 class="logo-wrapper"><a class="brand-logo darken-1" href="index.html"><img class="hide-on-med-and-down " src="<?php echo base_url();?>assets/new_design/images/logo/materialize-logo.png" alt="materialize logo" /><img class="show-on-medium-and-down hide-on-med-and-up" src="<?php echo base_url();?>assets/new_design/images/logo/materialize-logo-color.png" alt="materialize logo" /><span class="logo-text hide-on-med-and-down">MONIKA</span></a><a class="navbar-toggler" href="#"><i class="material-icons">radio_button_checked</i></a></h1>
        </div>
        <ul class="sidenav sidenav-collapsible leftside-navigation collapsible sidenav-fixed menu-shadow" id="slide-out" data-menu="menu-navigation" data-collapsible="menu-accordion">
            <?php if ($kategori == 1) { ?>
            <li class="navigation-header"><a class="navigation-header-text">MENU AFIN</a><i class="navigation-header-icon material-icons">more_horiz</i></li>
            <li class="bold"><a class="waves-effect waves-cyan " href="<?php echo base_url(); ?>perusahaan"><i class="material-icons">face</i><span class="menu-title" data-i18n="User">Master Client</span></a></li>
            <li class="bold"><a class="waves-effect waves-cyan " href="<?php echo base_url(); ?>afin"><i class="material-icons">assignment</i><span class="menu-title" data-i18n="User">Kontrak</span></a></li>
            <?php } ?>

            <?php if ($kategori == 2) { ?>
            <li class="navigation-header"><a class="navigation-header-text">MENU PROGRAM</a><i class="navigation-header-icon material-icons">more_horiz</i></li>
            <li class="bold"><a class="waves-effect waves-cyan " href="<?php echo base_url(); ?>program"><i class="material-icons">assignment</i><span class="menu-title" data-i18n="User">Kontrak</span></a></li>
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

            <?php if ($kategori == 3 && $is_kontrak == 1) { ?>
              <li class="navigation-header"><a class="navigation-header-text">MENU PEJABAT TEKNIS</a><i class="navigation-header-icon material-icons">more_horiz</i></li>
              <li class="bold"><a class="waves-effect waves-cyan " href="<?php echo base_url(); ?>pejabat_teknis"><i class="material-icons">assignment</i><span class="menu-title" data-i18n="User">Kontrak</span></a></li>
            <?php } ?>

            <?php if ($kategori == 7) { ?>
              <li class="navigation-header"><a class="navigation-header-text">MENU PPK</a><i class="navigation-header-icon material-icons">more_horiz</i></li>
              <li class="bold"><a class="waves-effect waves-cyan " href="<?php echo base_url(); ?>ppk"><i class="material-icons">assignment</i><span class="menu-title" data-i18n="User">Pengajuan</span></a></li>
            <?php } ?>

            <?php if ($kategori == 5) { ?>
              <li class="navigation-header"><a class="navigation-header-text">BENDAHARA PENERIMAAN</a><i class="navigation-header-icon material-icons">more_horiz</i></li>
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
          </ul>
        <div class="navigation-background"></div><a class="sidenav-trigger btn-sidenav-toggle btn-floating btn-medium waves-effect waves-light hide-on-large-only" href="#" data-target="slide-out"><i class="material-icons">menu</i></a>
    </aside>

    <!-- END: SideNav-->

    <!-- BEGIN: Page Main-->
    <div id="main">
      <div class="row">
        <div class="col s12">
            <div class="container">
                <div class="section section-data-tables">
                  <div class="card-content">
                    <div class="row">
                      <div class="col s12">
                          <div class="card-panel gradient-45deg-light-blue-cyan" style="color: rgba(255, 255, 255, 0.901961);">
                            <span style="color: rgba(255, 255, 255, 0.901961);font-size:20px;"><center>FORM Setting Data Satker</center></span>
                          </div>
                      </div>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-content">
                      <?php echo form_open_multipart('admin/setting_satker');?>
                          <div class="row">
                              <div class="input-field col s12">
                                  <input id="judul_kontrak" type="text" name= "nama_kontrak" required>
                                  <label for="judul_kontrak">Judul Kontrak</label>
                              </div>
                          </div>
                            <div class="row">
                                <div class="input-field col s12 m6 l6">
                                    <input id="nomor_kontrak" type="text" name = "no_kontrak" required>
                                    <label for="no_kontrak">Nomor Kontrak</label>
                                </div>
                                <div class="input-field col s12 m6 l6">
                                    <input id="a8" type="date" name = "tgl_ttd" required>
                                    <label for="ttd_kontrak">Tanggal Tanda Tangan Kontrak</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12 m6 l6">
                                    <select name="rumah_layanan" required>
                                        <option value="" disabled selected>Pelaksana Layanan</option>
                                        <?php foreach ($rumah_layanan as $a) { ?>
                                          <option value="<?php echo $a->id_rumah_layanan; ?>"><?php echo $a->kode." - ".$a->nama; ?></option>
                                        <?php } ?>
                                    </select>
                                    <label>Pilih Pelaksana Layanan</label>
                                </div>
                                <div class="input-field col s12 m6 l6">
                                  <select name="jasa" required>
                                      <option value="" disabled selected>Jenis Layanan</option>
                                      <?php foreach ($detail_layanan as $a) { ?>
                                        <option value="<?php echo $a->id_detail; ?>"><?php echo $a->kode_layanan." - ".$a->nama_layanan; ?></option>
                                      <?php } ?>
                                  </select>
                                  <label>Pilih Jenis Layanan</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12 m6 l6">
                                    <select class="select2 browser-default" name="nama_perusahaan" required>
                                        <option value="" disabled selected>Pilih Client</option>
                                        <?php foreach ($perusahaan as $a) { ?>
                                          <option value="<?php echo $a->nama_perusahaan; ?>"><?php echo $a->nama_perusahaan; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="input-field col s12 m6 l6">
                                  <select class="select2 browser-default" name="pic" required>
                                      <option value="" disabled selected>Pilih PIC</option>
                                      <?php foreach ($pegawai as $a) { ?>
                                        <option value="<?php echo $a->id; ?>"><?php echo $a->nip." - ".$a->nama; ?></option>
                                      <?php } ?>
                                  </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12 m3 l3">
                                    <input id="a9" type="date" name = "tgl_mulai" required>
                                    <label for="a9">Tanggal Mulai Kontrak</label>
                                </div>
                                <div class="input-field col s12 m3 l3">
                                    <input id="a10" type="date" name = "tgl_akhir" required>
                                    <label for="a10">Tanggal Selesai Kontrak</label>
                                </div>
                                <div class="input-field col s12 m3 l3">
                                    <input id="a6" type="number" name="termin" maxlength="20" min="1" required>
                                    <label for="a9">Jumlah Termin</label>
                                </div>
                                <div class="input-field col s12 m3 l3">
                                  <input id="status" type="text" name="status" value="K" hidden>
                                  <input id="a6" type="number" name="nilai_kontrak" maxlength="20" min="1" required>
                                  <label for="a10">Nilai Kontrak (dalam Rupiah)</label>
                                </div>
                            </div>
                          <div class="row">
                              <div class="input-field col s12">
                                <label for="message5">Ruang Lingkup</label>
                                <textarea id="textarea2" class="materialize-textarea" style="height: 75px;" name="keterangan"></textarea>
                              </div>
                          </div>



                          <div class="row">
                              <div class="input-field col s12">
                                  <button class="btn cyan waves-effect waves-light left" type="submit" name="action" onclick="javascript: return confirm('Yakin akan menyimpan data?')"><i class="material-icons left">send</i>Simpan</button>
                              </div>
                          </div>
                      </form>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
      <section class="full-editor">
          <div class="row">
              <div class="col s12">
                  <div class="card">
                      <div class="card-content">
                          <h4 class="card-title">Full Editor</h4>
                          <p class="mb-1">
                              By default all formats are enabled and allowed to exist within a Quill editor and can be configured with
                              the <code class="language-markup">formats</code> option. This is separate from adding a control in the
                              <code class="language-markup">Toolbar</code>. For
                              example, you can configure Quill to allow bolded content to be pasted into an editor that has no bold
                              button in the toolbar.
                          </p>
                          <div class="row">
                              <div class="col s12">
                                  <div id="full-wrapper">
                                      <div id="full-container">
                                          <div class="editor">
                                              <h1 class="ql-align-center">Quill Rich Text Editor</h1>
                                              <p><br></p>
                                              <p>Quill is a free, <a href="https://github.com/quilljs/quill/">open source</a> WYSIWYG editor
                                                  built for the modern web. With its <a href="http://quilljs.com/docs/modules/">modular
                                                      architecture</a> and expressive <a href="http://quilljs.com/docs/api/">API</a>, it is
                                                  completely customizable to fit any need.</p>
                                              <p><br></p>
                                              <iframe class="ql-video ql-align-center" src="https://www.youtube.com/embed/QHH3iSeDBLo?showinfo=0" width="560" height="238"></iframe>
                                              <p><br></p>
                                              <p><br></p>
                                              <h2 class="ql-align-center">Getting Started is Easy</h2>
                                              <p><br></p>
                                              <pre>
// &lt;link href="https://cdn.quilljs.com/1.0.5/quill.snow.css" rel="stylesheet"&gt;
// &lt;script src="https://cdn.quilljs.com/1.0.5/quill.min.js" type="text/javascript"&gt;&lt;/script&gt;
var quill = new Quill('#editor', {
modules: {
toolbar: '#toolbar'
},
theme: 'snow'
});
// Open your browser's developer console to try out the API!
    </pre>
                                              <p><br></p>
                                              <p><br></p>
                                              <p class="ql-align-center"><strong>Built with</strong></p>
                                              <p class="ql-align-center"><span class="ql-formula" data-value="x^2 + (y - \sqrt[3]{x^2})^2 = 1"></span></p>
                                              <p><br></p>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </section>

    </div>
    <!-- END: Page Main-->

    <!-- BEGIN: Footer-->

    <footer class="page-footer footer footer-static footer-light navbar-border navbar-shadow">
        <div class="footer-copyright">
            <div class="container"><span>&copy; 2020 <a href="http://themeforest.net/user/pixinvent/portfolio?ref=pixinvent" target="_blank">PIXINVENT</a> All rights reserved.</span><span class="right hide-on-small-only">Design and Developed by <a href="https://pixinvent.com/">PIXINVENT</a></span></div>
        </div>
    </footer>

    <!-- END: Footer-->
    <!-- BEGIN VENDOR JS-->
    <script src="<?php echo base_url();?>assets/new_design/js/vendors.min.js"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="<?php echo base_url();?>assets/new_design/vendors/quill/katex.min.js"></script>
    <script src="<?php echo base_url();?>assets/new_design/vendors/quill/highlight.min.js"></script>
    <script src="<?php echo base_url();?>assets/new_design/vendors/quill/quill.min.js"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN THEME  JS-->
    <script src="<?php echo base_url();?>assets/new_design/js/plugins.js"></script>
    <script src="<?php echo base_url();?>assets/new_design/js/search.js"></script>
    <script src="<?php echo base_url();?>assets/new_design/js/custom/custom-script.js"></script>
    <!-- END THEME  JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="<?php echo base_url();?>assets/new_design/js/scripts/form-editor.js"></script>
    <!-- END PAGE LEVEL JS-->
</body>

</html>
