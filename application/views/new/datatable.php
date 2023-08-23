<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url()?>assets/new/images/favicon.png">
    <title>Materialart Admin Template</title>
    <link href="<?php echo base_url();?>assets/new/dist/css/style.css" rel="stylesheet">
    <!-- This page CSS -->
    <link href="<?php echo base_url()?>assets/new/libs/footable/css/footable.core.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/new/dist/css/pages/footable-page.css" rel="stylesheet">
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
                <p class="loader__label">Material Admin</p>
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
                        <li><a class="dropdown-trigger" href="javascript: void(0);" data-target="noti_dropdown"><i class="material-icons">notifications</i></a>
                            <ul id="noti_dropdown" class="mailbox dropdown-content">
                                <li>
                                    <div class="drop-title">Notifications</div>
                                </li>
                                <li>
                                    <div class="message-center">
                                        <!-- Message -->
                                        <a href="#">
                                                <span class="btn-floating btn-large red"><i class="material-icons">link</i></span>
                                                <span class="mail-contnet">
                                                    <h5>Launch Admin</h5>
                                                    <span class="mail-desc">Just see the my new admin!</span> <span class="time">9:30 AM</span>
                                                </span>
                                            </a>
                                        <!-- Message -->
                                        <a href="#">
                                                <span class="btn-floating btn-large blue"><i class="material-icons">date_range</i></span>
                                                <span class="mail-contnet">
                                                    <h5>Event today</h5>
                                                    <span class="mail-desc">Just a reminder that you have event</span>
                                                    <span class="time">9:10 AM</span>
                                                </span>
                                            </a>
                                        <!-- Message -->
                                        <a href="#">
                                                <span class="btn-floating btn-large cyan"><i class="material-icons">settings</i></span>
                                                <span class="mail-contnet">
                                                    <h5>Settings</h5>
                                                    <span class="mail-desc">You can customize this template as you want</span>
                                                    <span class="time">9:08 AM</span>
                                                </span>
                                            </a>
                                        <!-- Message -->
                                        <a href="#">
                                                <span class="btn-floating btn-large green"><i class="material-icons">face</i></span>
                                                <span class="mail-contnet">
                                                    <h5>Lily Jordan</h5>
                                                    <span class="mail-desc">Just see the my admin!</span>
                                                    <span class="time">9:02 AM</span>
                                                </span>
                                            </a>
                                    </div>
                                </li>
                                <li>
                                    <a class="center-align" href="javascript:void(0);"> <strong>Check all notifications</strong> </a>
                                </li>
                            </ul>
                        </li>
                        <!-- ============================================================== -->
                        <!-- Comment topbar icon scss in header.scss -->
                        <!-- ============================================================== -->
                        <li><a class="dropdown-trigger" href="javascript: void(0);" data-target="msg_dropdown"><i class="material-icons">comment</i></a>
                            <ul id="msg_dropdown" class="mailbox dropdown-content">
                                <li>
                                    <div class="drop-title">You have 4 new messages</div>
                                </li>
                                <li>
                                    <div class="message-center">
                                        <!-- Message -->
                                        <a href="#">
                                                <span class="user-img">
                                                    <img src="<?php echo base_url()?>assets/new/images/users/1.jpg" alt="user" class="circle">
                                                    <span class="profile-status online pull-right"></span>
                                                </span>
                                                <span class="mail-contnet">
                                                    <h5>Chris Evans</h5>
                                                    <span class="mail-desc">Just see the my admin!</span>
                                                    <span class="time">9:30 AM</span>
                                                </span>
                                            </a>
                                        <!-- Message -->
                                        <a href="#">
                                                <span class="user-img">
                                                    <img src="<?php echo base_url()?>assets/new/images/users/2.jpg" alt="user" class="circle">
                                                    <span class="profile-status busy pull-right"></span>
                                                </span>
                                                <span class="mail-contnet">
                                                    <h5>Ray Hudson</h5>
                                                    <span class="mail-desc">I've sung a song! See you at</span>
                                                    <span class="time">9:10 AM</span>
                                                </span>
                                            </a>
                                        <!-- Message -->
                                        <a href="#">
                                                <span class="user-img">
                                                    <img src="<?php echo base_url()?>assets/new/images/users/3.jpg" alt="user" class="circle">
                                                    <span class="profile-status away pull-right"></span>
                                                </span>
                                                <span class="mail-contnet">
                                                    <h5>Lb James</h5>
                                                    <span class="mail-desc">I am a singer!</span>
                                                    <span class="time">9:08 AM</span>
                                                </span>
                                            </a>
                                        <!-- Message -->
                                        <a href="#">
                                                <span class="user-img">
                                                    <img src="<?php echo base_url()?>assets/new/images/users/4.jpg" alt="user" class="circle">
                                                    <span class="profile-status offline pull-right"></span>
                                                </span>
                                                <span class="mail-contnet">
                                                    <h5>Don Andres</h5>
                                                    <span class="mail-desc">Just see the my admin!</span>
                                                    <span class="time">9:02 AM</span>
                                                </span>
                                            </a>
                                    </div>
                                </li>
                                <li>
                                    <a class="center-align" href="javascript:void(0);"> <strong>See all e-Mails</strong> </a>
                                </li>
                            </ul>
                        </li>
                        <li class="search-box">
                            <a href="javascript: void(0);"><i class="material-icons">search</i></a>
                            <form class="app-search">
                                <input type="text" class="form-control" placeholder="Search &amp; enter"> <a class="srh-btn"><i class="ti-close"></i></a>
                            </form>
                        </li>
                    </ul>
                    <!-- ============================================================== -->
                    <!-- Left topbar icon scss in header.scss -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Right topbar icon scss in header.scss -->
                    <!-- ============================================================== -->
                    <ul class="right">
                        <li class="lang-dropdown"><a class="dropdown-trigger" href="javascript: void(0);" data-target="lang_dropdown"><i class="flag-icon flag-icon-in"></i></a>
                            <ul id="lang_dropdown" class="dropdown-content">
                                <li>
                                    <a href="#!" class="grey-text text-darken-1">
                                        <i class="flag-icon flag-icon-us"></i> English</a>
                                </li>
                                <li>
                                    <a href="#!" class="grey-text text-darken-1">
                                        <i class="flag-icon flag-icon-fr"></i> French</a>
                                </li>
                                <li>
                                    <a href="#!" class="grey-text text-darken-1">
                                        <i class="flag-icon flag-icon-es"></i> Spanish</a>
                                </li>
                                <li>
                                    <a href="#!" class="grey-text text-darken-1">
                                        <i class="flag-icon flag-icon-de"></i> German</a>
                                </li>
                            </ul>
                        </li>
                        <!-- ============================================================== -->
                        <!-- Profile icon scss in header.scss -->
                        <!-- ============================================================== -->
                        <li><a class="dropdown-trigger" href="javascript: void(0);" data-target="user_dropdown"><img src="<?php echo base_url()?>assets/new/images/users/2.jpg" alt="user" class="circle profile-pic"></a>
                            <ul id="user_dropdown" class="mailbox dropdown-content dropdown-user">
                                <li>
                                    <div class="dw-user-box">
                                        <div class="u-img"><img src="<?php echo base_url()?>assets/new/images/users/2.jpg" alt="user"></div>
                                        <div class="u-text">
                                            <h4>Steve Harvey</h4>
                                            <p>steve@gmail.com</p>
                                            <a class="waves-effect waves-light btn-small red white-text">View Profile</a>
                                        </div>
                                    </div>
                                </li>
                                <li role="separator" class="divider"></li>
                                <li><a href="#"><i class="material-icons">account_circle</i> My Profile</a></li>
                                <li><a href="#"><i class="material-icons">account_balance_wallet</i> My Balance</a></li>
                                <li><a href="#"><i class="material-icons">inbox</i> Inbox</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="#"><i class="material-icons">settings</i> Account Setting</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="#"><i class="material-icons">power_settings_new</i> Logout</a></li>
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
                    <ul class="collapsible">
                        <li class="small-cap"><span class="hide-menu">PERSONAL</span></li>
                        <li>
                            <a href="javascript: void(0);" class="collapsible-header has-arrow"><i class="material-icons">dashboard</i><span class="hide-menu"> Dashboard</span></a>
                            <div class="collapsible-body">
                                <ul>
                                    <li><a href="index.html"><i class="material-icons">adjust</i><span class="hide-menu">Dashboard-1</span></a></li>
                                    <li><a href="index2.html"><i class="material-icons">adjust</i><span class="hide-menu">Dashboard-2</span></a></li>
                                    <li><a href="index3.html"><i class="material-icons">adjust</i><span class="hide-menu">Dashboard-3</span></a></li>
                                    <li><a href="index4.html"><i class="material-icons">adjust</i><span class="hide-menu">Dashboard-4</span></a></li>
                                </ul>
                            </div>
                        </li>
                         <li>
                            <a href="javascript: void(0);" class="collapsible-header has-arrow"><i class="material-icons">equalizer</i><span class="hide-menu"> Sidebar Types </span></a>
                            <div class="collapsible-body">
                                <ul>
                                    <li><a href="sidebar-type-minisidebar.html"><i class="material-icons">photo_size_select_small</i><span class="hide-menu">Minisidebar</span></a></li>
                                    <li><a href="sidebar-type-iconbar.html"><i class="material-icons">picture_in_picture</i><span class="hide-menu">Icon Sidebar</span></a></li>
                                    <li><a href="sidebar-type-overlay.html"><i class="material-icons">low_priority</i><span class="hide-menu">Overlay Sidebar</span></a></li>
                                    <li><a href="sidebar-type-fullsidebar.html"><i class="material-icons">present_to_all</i><span class="hide-menu">Full Sidebar</span></a></li>
                                    <li><a href="sidebar-type-horizontalsidebar.html"><i class="material-icons">power_input</i><span class="hide-menu">Horizontal Sidebar</span></a></li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="collapsible-header has-arrow"><i class="material-icons">library_books</i><span class="hide-menu"> Page Layouts </span></a>
                            <div class="collapsible-body">
                                <ul>
                                    <li><a href="layout-inner-fixed-left-sidebar.html"><i class="material-icons">format_align_left</i><span class="hide-menu">Inner Fixed Left Sidebar</span></a></li>
                                    <li><a href="layout-inner-fixed-right-sidebar.html"><i class="material-icons">format_align_right</i><span class="hide-menu">Inner Fixed Right Sidebar</span></a></li>
                                    <li><a href="layout-inner-left-sidebar.html"><i class="material-icons">format_indent_increase</i><span class="hide-menu">Inner Left Sidebar</span></a></li>
                                    <li><a href="layout-inner-right-sidebar.html"><i class="material-icons">format_indent_decrease</i><span class="hide-menu">Inner Right Sidebar</span></a></li>
                                    <li><a href="page-layout-fixed-header.html"><i class="material-icons">line_weight</i><span class="hide-menu">Fixed Header</span></a></li>
                                    <li><a href="page-layout-fixed-sidebar.html"><i class="material-icons">line_weight</i><span class="hide-menu">Fixed Sidebar</span></a></li>
                                    <li><a href="page-layout-fixed-header-sidebar.html"><i class="material-icons">format_align_center</i><span class="hide-menu">Fixed Header & Sidebar</span></a></li>
                                    <li><a href="page-layout-boxed-layout.html"><i class="material-icons">format_line_spacing</i><span class="hide-menu">Boxed Layout</span></a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="small-cap"><span class="hide-menu">Apps</span></li>
                        <li>
                            <a href="javascript: void(0);" class="collapsible-header has-arrow"><i class="material-icons">move_to_inbox</i><span class="hide-menu"> Inbox</span></a>
                            <div class="collapsible-body">
                                <ul>
                                    <li><a href="inbox-email.html"><i class="material-icons">email</i><span class="hide-menu">Email</span></a></li>
                                    <li><a href="inbox-email-detail.html"><i class="material-icons">markunread_mailbox</i><span class="hide-menu">Email Detail</span></a></li>
                                    <li><a href="inbox-compose.html"><i class="material-icons">contact_mail</i><span class="hide-menu">Email Compose</span></a></li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="collapsible-header has-arrow"><i class="material-icons">bookmark_border</i><span class="hide-menu"> Ticket</span></a>
                            <div class="collapsible-body">
                                <ul>
                                    <li><a href="ticket-list.html"><i class="material-icons">collections_bookmark</i><span class="hide-menu">Ticket List</span></a></li>
                                    <li><a href="ticket-detail.html"><i class="material-icons">bookmark</i><span class="hide-menu">Ticket Detail</span></a></li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="collapsible-header has-arrow"><i class="material-icons">donut_small</i><span class="hide-menu"> Extra</span></a>
                            <div class="collapsible-body">
                                <ul>
                                    <li><a href="app-chats.html"><i class="material-icons">chat</i><span class="hide-menu">Chat Apps</span></a></li>
                                    <li><a href="app-taskboard.html"><i class="material-icons">dvr</i><span class="hide-menu">Taskboard</span></a></li>
                                    <li><a href="app-contact.html"><i class="material-icons">dialer_sip</i><span class="hide-menu">Contact</span></a></li>
                                    <li><a href="app-contact2.html"><i class="material-icons">contacts</i><span class="hide-menu">Contact Grid</span></a></li>
                                    <li><a href="app-contact-detail.html"><i class="material-icons">contact_phone</i><span class="hide-menu">Contact Detail</span></a></li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a href="app-calendar.html" class="collapsible-header"><i class="material-icons">perm_contact_calendar</i><span class="hide-menu"> Calendar </span></a>
                        </li>
                        <li class="small-cap"><span class="hide-menu">UI</span></li>
                        <li>
                            <a href="javascript: void(0);" class="collapsible-header has-arrow"><i class="material-icons">widgets</i><span class="hide-menu"> UI Elements </span></a>
                            <div class="collapsible-body">
                                <ul>
                                    <li><a href="ui-badge.html"><i class="material-icons">crop_3_2</i><span class="hide-menu">Badges</span></a></li>
                                    <li><a href="ui-button.html"><i class="material-icons">hdr_strong</i><span class="hide-menu">Buttons</span></a></li>
                                    <li><a href="ui-breadcrumbs.html"><i class="material-icons">drag_handle</i><span class="hide-menu">Breadcrumbs</span></a></li>
                                    <li><a href="ui-collections.html"><i class="material-icons">nfc</i><span class="hide-menu">Collections</span></a></li>
                                    <li><a href="ui-floating-action-button.html"><i class="material-icons">panorama_horizontal</i><span class="hide-menu">Floating Action Button</span></a></li>
                                    <li><a href="ui-footer.html"><i class="material-icons">video_label</i><span class="hide-menu">Footer</span></a></li>
                                    <li><a href="ui-navbar.html"><i class="material-icons">view_compact</i><span class="hide-menu">Navbar</span></a></li>
                                    <li><a href="ui-pagination.html"><i class="material-icons">swap_horiz</i><span class="hide-menu">Pagination</span></a></li>
                                    <li><a href="ui-preloader.html"><i class="material-icons">sync</i><span class="hide-menu">Preloader</span></a></li>
                                    <li><a href="ui-sweetalert.html"><i class="material-icons">filter_vintage</i><span class="hide-menu">Sweetalert</span></a></li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="collapsible-header has-arrow"><i class="material-icons">credit_card</i><span class="hide-menu"> Cards </span></a>
                            <div class="collapsible-body">
                                <ul>
                                    <li><a href="ui-cards.html"><i class="material-icons">layers</i><span class="hide-menu">Basic Cards</span></a></li>
                                    <li><a href="ui-card-customs.html"><i class="material-icons">card_membership</i><span class="hide-menu">Custom Cards</span></a></li>
                                    <li><a href="ui-card-draggable.html"><i class="material-icons">card_giftcard</i><span class="hide-menu">Draggable Cards</span></a></li>
                                    <li><a href="ui-card-weather.html"><i class="material-icons">grain</i><span class="hide-menu">Weather Cards</span></a></li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="collapsible-header has-arrow"><i class="material-icons">compare</i><span class="hide-menu"> Components </span></a>
                            <div class="collapsible-body">
                                <ul>
                                    <li><a href="component-noui-slider.html"><i class="material-icons">compare_arrows</i><span class="hide-menu">Noui Silder</span></a></li>
                                    <li><a href="component-toastr.html"><i class="material-icons">cast</i><span class="hide-menu">Toastr</span></a></li>
                                    <li><a href="component-rating.html"><i class="material-icons">star_half</i><span class="hide-menu">Rating</span></a></li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="collapsible-header has-arrow"><i class="material-icons">dns</i><span class="hide-menu"> Advanced UI </span></a>
                            <div class="collapsible-body">
                                <ul>
                                    <li><a href="advanced-ui-carousel.html"><i class="material-icons">view_carousel</i><span class="hide-menu">Carousel</span></a></li>
                                    <li><a href="advanced-ui-collapsible.html"><i class="material-icons">view_day</i><span class="hide-menu">Collapsible</span></a></li>
                                    <li><a href="advanced-ui-dropdown.html"><i class="material-icons">vertical_align_bottom</i><span class="hide-menu">Dropdown</span></a></li>
                                    <li><a href="advanced-ui-feature-discovery.html"><i class="material-icons">videogame_asset</i><span class="hide-menu">Feature Discovery</span></a></li>
                                    <li><a href="advanced-ui-media.html"><i class="material-icons">video_library</i><span class="hide-menu">Media</span></a></li>
                                    <li><a href="advanced-ui-modal.html"><i class="material-icons">vignette</i><span class="hide-menu">Modals</span></a></li>
                                    <li><a href="advanced-ui-parallax.html"><i class="material-icons">view_day</i><span class="hide-menu">Parallax</span></a></li>
                                    <li><a href="advanced-ui-pushpin.html"><i class="material-icons">wrap_text</i><span class="hide-menu">Pushpin</span></a></li>
                                    <li><a href="advanced-ui-scrollspy.html"><i class="material-icons">theaters</i><span class="hide-menu">Scrollspy</span></a></li>
                                    <li><a href="advanced-ui-sidenav.html"><i class="material-icons">web</i><span class="hide-menu">Sidenav</span></a></li>
                                    <li><a href="advanced-ui-tabs.html"><i class="material-icons">short_text</i><span class="hide-menu">Tabs</span></a></li>
                                    <li><a href="advanced-ui-toasts.html"><i class="material-icons">tab_unselected</i><span class="hide-menu">Toast</span></a></li>
                                    <li><a href="advanced-ui-tooltips.html"><i class="material-icons">spa</i><span class="hide-menu">Tooltips</span></a></li>
                                    <li><a href="advanced-ui-waves.html"><i class="material-icons">polymer</i><span class="hide-menu">Waves</span></a></li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="collapsible-header has-arrow"><i class="material-icons">brightness_7</i><span class="hide-menu"> CSS </span></a>
                            <div class="collapsible-body">
                                <ul>
                                    <li><a href="ui-color.html"><i class="material-icons">looks</i><span class="hide-menu">Color</span></a></li>
                                    <li><a href="ui-grid.html"><i class="material-icons">view_module</i><span class="hide-menu">Grid</span></a></li>
                                    <li><a href="ui-helper.html"><i class="material-icons">live_help</i><span class="hide-menu">Helpers</span></a></li>
                                    <li><a href="ui-media-css.html"><i class="material-icons">live_tv</i><span class="hide-menu">Media</span></a></li>
                                    <li><a href="ui-pulse.html"><i class="material-icons">linear_scale</i><span class="hide-menu">Pulse</span></a></li>
                                    <li><a href="ui-sass.html"><i class="material-icons">group_work</i><span class="hide-menu">Sass</span></a></li>
                                    <li><a href="ui-shadow.html"><i class="material-icons">graphic_eq</i><span class="hide-menu">Shadow</span></a></li>
                                    <li><a href="ui-transitions.html"><i class="material-icons">gesture</i><span class="hide-menu">Transitions</span></a></li>
                                    <li><a href="ui-typography.html"><i class="material-icons">format_shapes</i><span class="hide-menu">Typography</span></a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="small-cap"><span class="hide-menu">FORMS</span></li>
                        <li>
                            <a href="javascript: void(0);" class="collapsible-header has-arrow"><i class="material-icons">receipt</i><span class="hide-menu"> Form Elements </span></a>
                            <div class="collapsible-body">
                                <ul>
                                    <li><a href="form-autocomplete.html"><i class="material-icons">format_indent_increase</i><span class="hide-menu">Autocomplete</span></a></li>
                                    <li><a href="form-checkboxes.html"><i class="material-icons">check_circle</i><span class="hide-menu">Checkboxes</span></a></li>
                                    <li><a href="form-chips.html"><i class="material-icons">collections_bookmark</i><span class="hide-menu">Chips</span></a></li>
                                    <li><a href="form-pickers.html"><i class="material-icons">colorize</i><span class="hide-menu">Pickers</span></a></li>
                                    <li><a href="form-radio-buttons.html"><i class="material-icons">album</i><span class="hide-menu">Radio Buttons</span></a></li>
                                    <li><a href="form-range.html"><i class="material-icons">compare</i><span class="hide-menu">Range</span></a></li>
                                    <li><a href="form-select.html"><i class="material-icons">check_box</i><span class="hide-menu">Select</span></a></li>
                                    <li><a href="form-switch.html"><i class="material-icons">confirmation_number</i><span class="hide-menu">Switch</span></a></li>
                                    <li><a href="form-text-inputs.html"><i class="material-icons">flash_auto</i><span class="hide-menu">Text Input</span></a></li>
                                    <li><a href="form-inputs.html"><i class="material-icons">call_to_action</i><span class="hide-menu">Form Inputs</span></a></li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="collapsible-header has-arrow"><i class="material-icons">content_copy</i><span class="hide-menu"> Form Pages </span></a>
                            <div class="collapsible-body">
                                <ul>
                                    <li><a href="form-masks.html"><i class="material-icons">filter_none</i><span class="hide-menu">Form Mask & Typehead</span></a></li>
                                    <li><a href="form-layouts.html"><i class="material-icons">filter_b_and_w</i><span class="hide-menu">Form Layout</span></a></li>
                                    <li><a href="form-input-grid.html"><i class="material-icons">border_inner</i><span class="hide-menu">Form Input Grid</span></a></li>
                                    <li><a href="form-hidden-label.html"><i class="material-icons">border_style</i><span class="hide-menu">Form Hidden Label</span></a></li>
                                    <li><a href="form-horizontal.html"><i class="material-icons">art_track</i><span class="hide-menu">Form Horizontal</span></a></li>
                                    <li><a href="form-bordered.html"><i class="material-icons">filter_frames</i><span class="hide-menu">Form with Border</span></a></li>
                                    <li><a href="form-row-separator.html"><i class="material-icons">chrome_reader_mode</i><span class="hide-menu">Form Row Separator</span></a></li>
                                    <li><a href="form-row-striped.html"><i class="material-icons">assignment</i><span class="hide-menu">Form Row Striped</span></a></li>
                                    <li><a href="form-label-striped.html"><i class="material-icons">border_horizontal</i><span class="hide-menu">Form Label Striped</span></a></li>
                                    <li><a href="form-repeater.html"><i class="material-icons">photo_filter</i><span class="hide-menu">Form Repeater</span></a></li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a href="form-validation.html" class="collapsible-header"><i class="material-icons">assignment_late</i><span class="hide-menu"> Form Validation </span></a>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="collapsible-header has-arrow"><i class="material-icons">center_focus_weak</i><span class="hide-menu"> Form Pickers </span></a>
                            <div class="collapsible-body">
                                <ul>
                                    <li><a href="form-picker-colorpicker.html"><i class="material-icons">brightness_4</i><span class="hide-menu">Form Colorpicker</span></a></li>
                                    <li><a href="form-picker-datetimepicker.html"><i class="material-icons">perm_contact_calendar</i><span class="hide-menu">Form Datetimepicker</span></a></li>
                                    <li><a href="form-picker-material-datepicker.html"><i class="material-icons">brightness_high</i><span class="hide-menu">Form Material Datepicker</span></a></li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="collapsible-header has-arrow"><i class="material-icons">input</i><span class="hide-menu"> Form Editors </span></a>
                            <div class="collapsible-body">
                                <ul>
                                    <li><a href="form-editor-ckeditor.html"><i class="material-icons">memory</i><span class="hide-menu">Form Ckeditor</span></a></li>
                                    <li><a href="form-editor-tinymce.html"><i class="material-icons">brightness_4</i><span class="hide-menu">Form Tinymce</span></a></li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a href="form-wizard.html" class="collapsible-header"><i class="material-icons">developer_board</i><span class="hide-menu"> Form Wizard </span></a>
                        </li>
                        <li class="small-cap"><span class="hide-menu">Tables</span></li>
                        <li>
                            <a href="table-basic.html" class="collapsible-header"><i class="material-icons">apps</i><span class="hide-menu"> Basic Table </span></a>
                        </li>
                        <li>
                            <a href="table-editable.html" class="collapsible-header"><i class="material-icons">graphic_eq</i><span class="hide-menu"> Editable Table </span></a>
                        </li>
                        <li>
                            <a href="table-jsgrid.html" class="collapsible-header"><i class="material-icons">grain</i><span class="hide-menu"> Jsgrid Table </span></a>
                        </li>
                        <li>
                            <a href="table-footable.html" class="collapsible-header"><i class="material-icons">gamepad</i><span class="hide-menu"> Footable Table </span></a>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="collapsible-header has-arrow"><i class="material-icons">blur_linear</i><span class="hide-menu"> Datatables</span></a>
                            <div class="collapsible-body">
                                <ul>
                                    <li><a href="table-datatable-basic.html"><i class="material-icons">border_vertical</i><span class="hide-menu"> Basic Initialisation</span></a></li>
                                    <li><a href="table-datatable-api.html"><i class="material-icons">border_outer</i><span class="hide-menu"> API</span></a></li>
                                    <li><a href="table-datatable-advanced.html"><i class="material-icons">border_style</i><span class="hide-menu"> Advanced Initialisation</span></a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="small-cap"><span class="hide-menu">Charts</span></li>
                        <li>
                            <a href="javascript: void(0);" class="collapsible-header has-arrow"><i class="material-icons">pie_chart</i><span class="hide-menu"> Charts</span></a>
                            <div class="collapsible-body">
                                <ul>
                                    <li><a href="chart-chartist.html"><i class="material-icons">blur_on</i><span class="hide-menu"> Chartist Chart</span></a></li>
                                    <li><a href="chart-chartjs.html"><i class="material-icons">ac_unit</i><span class="hide-menu"> Chartjs Chart</span></a></li>
                                    <li><a href="chart-extra-chart.html"><i class="material-icons">explicit</i><span class="hide-menu"> Extra Chart</span></a></li>
                                    <li><a href="chart-flot.html"><i class="material-icons">insert_chart</i><span class="hide-menu"> Flot Chart</span></a></li>
                                    <li><a href="chart-knob.html"><i class="material-icons">device_hub</i><span class="hide-menu"> Knob Chart</span></a></li>
                                    <li><a href="chart-morris.html"><i class="material-icons">filter_tilt_shift</i><span class="hide-menu"> Morris Chart</span></a></li>
                                    <li><a href="chart-peity.html"><i class="material-icons">explore</i><span class="hide-menu"> Peity Chart</span></a></li>
                                    <li><a href="chart-sparkline.html"><i class="material-icons">flare</i><span class="hide-menu"> Sparkline Chart</span></a></li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="collapsible-header has-arrow"><i class="material-icons">insert_chart</i><span class="hide-menu">C3 Charts</span></a>
                            <div class="collapsible-body">
                                <ul>
                                    <li><a href="chart-c3-axis.html"><i class="material-icons">pie_chart_outlined</i><span class="hide-menu"> Axis Chart</span></a></li>
                                    <li><a href="chart-c3-bar.html"><i class="material-icons">show_chart</i><span class="hide-menu"> Bar Chart</span></a></li>
                                    <li><a href="chart-c3-data.html"><i class="material-icons">bubble_chart</i><span class="hide-menu"> Data Chart</span></a></li>
                                    <li><a href="chart-c3-line.html"><i class="material-icons">line_style</i><span class="hide-menu"> Line Chart</span></a></li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="collapsible-header has-arrow"><i class="material-icons">multiline_chart</i><span class="hide-menu">Echarts</span></a>
                            <div class="collapsible-body">
                                <ul>
                                    <li><a href="chart-echart-basic.html"><i class="material-icons">trending_up</i><span class="hide-menu"> Basic Chart</span></a></li>
                                    <li><a href="chart-echart-bar.html"><i class="material-icons">signal_cellular_4_bar</i><span class="hide-menu"> Bar Chart</span></a></li>
                                    <li><a href="chart-echart-pie-doughnut.html"><i class="material-icons">my_location</i><span class="hide-menu"> Pie & Doughnut Chart</span></a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="small-cap"><span class="hide-menu">Authentication</span></li>
                        <li>
                            <a href="javascript: void(0);" class="collapsible-header has-arrow"><i class="material-icons">account_circle</i><span class="hide-menu"> Authentication</span></a>
                            <div class="collapsible-body">
                                <ul>
                                    <li><a href="authentication-login1.html"><i class="material-icons">account_circle</i><span class="hide-menu"> Login 1</span></a></li>
                                    <li><a href="authentication-login2.html"><i class="material-icons">account_circle</i><span class="hide-menu"> Login 2</span></a></li>
                                    <li><a href="authentication-register1.html"><i class="material-icons">person_add</i><span class="hide-menu"> Register 1</span></a></li>
                                    <li><a href="authentication-register2.html"><i class="material-icons">person_add</i><span class="hide-menu"> Register 2</span></a></li>
                                    <li><a href="authentication-lockscreen.html"><i class="material-icons">lock_outline</i><span class="hide-menu"> Lockscreen</span></a></li>
                                    <li><a href="authentication-recover-password.html"><i class="material-icons">lock_open</i><span class="hide-menu"> Recover Password</span></a></li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="collapsible-header has-arrow"><i class="material-icons">group</i><span class="hide-menu"> Users</span></a>
                            <div class="collapsible-body">
                                <ul>
                                    <li><a href="ui-user-card.html"><i class="material-icons">assignment_ind</i><span class="hide-menu"> User Card</span></a></li>
                                    <li><a href="ui-user-contacts.html"><i class="material-icons">assignment_turned_in</i><span class="hide-menu"> User Contact</span></a></li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="collapsible-header has-arrow"><i class="material-icons">assignment</i><span class="hide-menu"> Invoice</span></a>
                            <div class="collapsible-body">
                                <ul>
                                    <li><a href="page-invoice.html"><i class="material-icons">featured_video</i><span class="hide-menu"> Invoice Layout</span></a></li>
                                    <li><a href="page-invoice-list.html"><i class="material-icons">featured_play_list</i><span class="hide-menu"> Invoice List</span></a></li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="collapsible-header has-arrow"><i class="material-icons">map</i><span class="hide-menu"> Map</span></a>
                            <div class="collapsible-body">
                                <ul>
                                    <li><a href="map-google.html"><i class="material-icons">add_location</i><span class="hide-menu"> Google Map</span></a></li>
                                    <li><a href="map-vector.html"><i class="material-icons">location_searching</i><span class="hide-menu"> Vector Map</span></a></li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="collapsible-header has-arrow"><i class="material-icons">explore</i><span class="hide-menu"> Timeline</span></a>
                            <div class="collapsible-body">
                                <ul>
                                    <li><a href="timeline-center.html"><i class="material-icons">import_export</i><span class="hide-menu"> Center Timeline</span></a></li>
                                    <li><a href="timeline-horizontal.html"><i class="material-icons">compare_arrows</i><span class="hide-menu"> Horizontal Timeline</span></a></li>
                                    <li><a href="timeline-left.html"><i class="material-icons">hdr_weak</i><span class="hide-menu"> Left Timeline</span></a></li>
                                    <li><a href="timeline-right.html"><i class="material-icons">hdr_strong</i><span class="hide-menu"> Right Timeline</span></a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="small-cap"><span class="hide-menu">Extra</span></li>
                        <li>
                            <a href="javascript: void(0);" class="collapsible-header has-arrow"><i class="material-icons">shopping_cart</i><span class="hide-menu"> Ecommerce Pages </span></a>
                            <div class="collapsible-body">
                                <ul>
                                    <li><a href="eco-products.html"><i class="material-icons">add_to_photos</i><span class="hide-menu">Products</span></a></li>
                                    <li><a href="eco-products-cart.html"><i class="material-icons">chrome_reader_mode</i><span class="hide-menu">Product Carts</span></a></li>
                                    <li><a href="eco-products-edit.html"><i class="material-icons">add_shopping_cart</i><span class="hide-menu">Product Edit</span></a></li>
                                    <li><a href="eco-products-detail.html"><i class="material-icons">assignment</i><span class="hide-menu">Product Details</span></a></li>
                                    <li><a href="eco-products-orders.html"><i class="material-icons">airplay</i><span class="hide-menu">Product Order</span></a></li>
                                    <li><a href="eco-products-checkout.html"><i class="material-icons">assignment_turned_in</i><span class="hide-menu">Product Checkout</span></a></li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="collapsible-header has-arrow"><i class="material-icons">center_focus_strong</i><span class="hide-menu"> Sample Pages </span></a>
                            <div class="collapsible-body">
                                <ul>
                                    <li><a href="starter-page.html"><i class="material-icons">crop_free</i><span class="hide-menu">Starter Page</span></a></li>
                                    <li><a href="page-animation.html"><i class="material-icons">crop_original</i><span class="hide-menu">Animation</span></a></li>
                                    <li><a href="page-faq.html"><i class="material-icons">device_hub</i><span class="hide-menu">FAQ</span></a></li>
                                    <li><a href="page-gallery.html"><i class="material-icons">developer_board</i><span class="hide-menu">Gallery</span></a></li>
                                    <li><a href="page-inner-right-sidebar.html"><i class="material-icons">view_column</i><span class="hide-menu">Inner Right Sidebar</span></a></li>
                                    <li><a href="page-inner-sidebar.html"><i class="material-icons">view_array</i><span class="hide-menu">Inner Sidebar</span></a></li>
                                    <li><a href="page-lightbox.html"><i class="material-icons">wb_iridescent</i><span class="hide-menu">Lightbox</span></a></li>
                                    <li><a href="page-pricing.html"><i class="material-icons">monetization_on</i><span class="hide-menu">Pricing</span></a></li>
                                    <li><a href="page-profile.html"><i class="material-icons">person_pin</i><span class="hide-menu">Profile</span></a></li>
                                    <li><a href="page-scroll.html"><i class="material-icons">swap_vert</i><span class="hide-menu">Scroll</span></a></li>
                                    <li><a href="page-search-result.html"><i class="material-icons">youtube_searched_for</i><span class="hide-menu">Search Result</span></a></li>
                                    <li><a href="page-maintenance.html"><i class="material-icons">settings</i><span class="hide-menu">Page Maintenance</span></a></li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="collapsible-header has-arrow"><i class="material-icons">face</i><span class="hide-menu"> Icons </span></a>
                            <div class="collapsible-body">
                                <ul>
                                    <li><a href="icon-material.html"><i class="material-icons">insert_emoticon</i><span class="hide-menu">Material Icons</span></a></li>
                                    <li><a href="icon-fontawesome.html"><i class="material-icons">child_care</i><span class="hide-menu">Fontawesome Icons</span></a></li>
                                    <li><a href="icon-themify.html"><i class="material-icons">bubble_chart</i><span class="hide-menu">Themify Icons</span></a></li>
                                    <li><a href="icon-weather.html"><i class="material-icons">filter_drama</i><span class="hide-menu">Weather Icons</span></a></li>
                                    <li><a href="icon-simple.html"><i class="material-icons">broken_image</i><span class="hide-menu">Simple Line Icons</span></a></li>
                                    <li><a href="icon-flag.html"><i class="material-icons">assistant_photo</i><span class="hide-menu">Flag Icons</span></a></li>
                                    <li><a href="icon-cryptocurrency.html"><i class="material-icons">euro_symbol</i><span class="hide-menu">Cryptocurrency Icons</span></a></li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="collapsible-header has-arrow"><i class="material-icons">email</i><span class="hide-menu"> Email Templates </span></a>
                            <div class="collapsible-body">
                                <ul>
                                    <li><a href="email-templete-alert.html"><i class="material-icons">report_problem</i><span class="hide-menu">Alert</span></a></li>
                                    <li><a href="email-templete-basic.html"><i class="material-icons">rounded_corner</i><span class="hide-menu">Basic</span></a></li>
                                    <li><a href="email-templete-billing.html"><i class="material-icons">settings_overscan</i><span class="hide-menu">Billing</span></a></li>
                                    <li><a href="email-templete-password-reset.html"><i class="material-icons">slow_motion_video</i><span class="hide-menu">password Reset</span></a></li>
                                </ul>
                            </div>
                        </li>
                        <li>
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
                        </li>
                        <li class="small-cap"><span class="hide-menu">Error</span></li>
                        <li>
                            <a href="javascript: void(0);" class="collapsible-header has-arrow"><i class="material-icons">backspace</i><span class="hide-menu"> Error Pages </span></a>
                            <div class="collapsible-body">
                                <ul>
                                    <li><a href="error-400.html"><i class="material-icons">info</i><span class="hide-menu">Error 400</span></a></li>
                                    <li><a href="error-403.html"><i class="material-icons">help_outline</i><span class="hide-menu">Error 403</span></a></li>
                                    <li><a href="error-404.html"><i class="material-icons">all_inclusive</i><span class="hide-menu">Error 404</span></a></li>
                                    <li><a href="error-500.html"><i class="material-icons">live_help</i><span class="hide-menu">Error 500</span></a></li>
                                    <li><a href="error-503.html"><i class="material-icons">info_outline</i><span class="hide-menu">Error 503</span></a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="small-cap"><span class="hide-menu">Single Link</span></li>
                        <li>
                            <a href="../../docs/documentation.html" class="collapsible-header"><i class="material-icons">content_paste</i><span class="hide-menu"> Documentation </span></a>
                        </li>
                        <li>
                            <a href="logout.html" class="collapsible-header"><i class="material-icons">directions</i><span class="hide-menu"> Log Out </span></a>
                        </li>
                        <li>
                            <a href="faqs.html" class="collapsible-header"><i class="material-icons">people_outline</i><span class="hide-menu"> FAQs </span></a>
                        </li>
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
            <div class="page-titles">
                <div class="d-flex align-items-center">
                    <h5 class="font-medium m-b-0">Footable</h5>
                    <div class="custom-breadcrumb ml-auto">
                        <a href="#!" class="breadcrumb">Home</a>
                        <a href="#!" class="breadcrumb">Footable</a>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- Container fluid scss in scafholding.scss -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col s12">
                        <div class="card">
                            <div class="card-content">
                                <h4 class="card-title">Contact Employee list</h4>
                                <h6 class="card-subtitle"></h6>
                                <div class="table-responsive">
                                    <table id="demo-foo-addrow" class="table m-t-10 highlight contact-list" data-page-size="10">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Role</th>
                                                <th>Age</th>
                                                <th>Joining date</th>
                                                <th>Salery</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>
                                                    <div class="chip">
                                                        <img src="<?php echo base_url()?>assets/new/images/users/5.jpg" alt="Contact Person"> Jane Doe
                                                    </div>
                                                </td>
                                                <td>Jane@gmail.com</td>
                                                <td>+123 456 789</td>
                                                <td><span class="label label-danger">Designer</span> </td>
                                                <td>23</td>
                                                <td>12-10-2014</td>
                                                <td>$1200</td>
                                                <td>
                                                    <button type="button" class="btn btn-small delete-row-btn"><i class="ti-close" aria-hidden="true"></i></button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>
                                                    <div class="chip">
                                                        <img src="<?php echo base_url()?>assets/new/images/users/7.jpg" alt="Contact Person"> Jack Nicolas
                                                    </div>
                                                </td>
                                                <td>Jack@gmail.com</td>
                                                <td>+234 456 789</td>
                                                <td><span class="label label-info">Developer</span> </td>
                                                <td>26</td>
                                                <td>10-09-2014</td>
                                                <td>$1800</td>
                                                <td>
                                                    <button type="button" class="btn btn-small btn-outline delete-row-btn"><i class="ti-close" aria-hidden="true"></i></button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>
                                                    <div class="chip">
                                                        <img src="<?php echo base_url()?>assets/new/images/users/1.jpg" alt="Contact Person"> Jane Garcia
                                                    </div>
                                                </td>
                                                <td>Jane@gmail.com</td>
                                                <td>+345 456 789</td>
                                                <td><span class="label label-success">Accountant</span></td>
                                                <td>28</td>
                                                <td>1-10-2013</td>
                                                <td>$2200</td>
                                                <td>
                                                    <button type="button" class="btn btn-small btn-outline delete-row-btn"><i class="ti-close" aria-hidden="true"></i></button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>
                                                    <div class="chip">
                                                        <img src="<?php echo base_url()?>assets/new/images/users/4.jpg" alt="Contact Person"> Jane Foster
                                                    </div>
                                                </td>
                                                <td>Jane@gmail.com</td>
                                                <td>+456 456 789</td>
                                                <td><span class="label label-inverse">HR</span></td>
                                                <td>25</td>
                                                <td>2-10-2017</td>
                                                <td>$200</td>
                                                <td>
                                                    <button type="button" class="btn btn-small btn-outline delete-row-btn"><i class="ti-close" aria-hidden="true"></i></button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>5</td>
                                                <td>
                                                    <div class="chip">
                                                        <img src="<?php echo base_url()?>assets/new/images/users/6.jpg" alt="Contact Person"> Jolly Brown
                                                    </div>
                                                </td>
                                                <td>Jolly@gmail.com</td>
                                                <td>+567 456 789</td>
                                                <td><span class="label label-danger">Manager</span></td>
                                                <td>23</td>
                                                <td>10-9-2015</td>
                                                <td>$1200</td>
                                                <td>
                                                    <button type="button" class="btn btn-small btn-outline delete-row-btn"><i class="ti-close" aria-hidden="true"></i></button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>6</td>
                                                <td>
                                                    <div class="chip">
                                                        <img src="<?php echo base_url()?>assets/new/images/users/8.jpg" alt="Contact Person"> Jon Doe
                                                    </div>
                                                </td>
                                                <td>Jon@gmail.com</td>
                                                <td>+678 456 789</td>
                                                <td><span class="label label-warning">Chairman</span></td>
                                                <td>29</td>
                                                <td>10-5-2013</td>
                                                <td>$1500</td>
                                                <td>
                                                    <button type="button" class="btn btn-small btn-outline delete-row-btn"><i class="ti-close" aria-hidden="true"></i></button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>7</td>
                                                <td>
                                                    <div class="chip">
                                                        <img src="<?php echo base_url()?>assets/new/images/users/1.jpg" alt="Contact Person"> Marry Jane
                                                    </div>
                                                </td>
                                                <td>Marry@gmail.com</td>
                                                <td>+123 456 789</td>
                                                <td><span class="label label-danger">Designer</span></td>
                                                <td>35</td>
                                                <td>05-10-2012</td>
                                                <td>$3200</td>
                                                <td>
                                                    <button type="button" class="btn btn-small btn-outline delete-row-btn"><i class="ti-close" aria-hidden="true"></i></button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>8</td>
                                                <td>
                                                    <div class="chip">
                                                        <img src="<?php echo base_url()?>assets/new/images/users/2.jpg" alt="Contact Person"> Rylie Stone
                                                    </div>
                                                </td>
                                                <td>Rylie@gmail.com</td>
                                                <td>+234 456 789</td>
                                                <td><span class="label label-info">Developer</span></td>
                                                <td>27</td>
                                                <td>11-10-2014</td>
                                                <td>$1800</td>
                                                <td>
                                                    <button type="button" class="btn btn-small btn-outline delete-row-btn"><i class="ti-close" aria-hidden="true"></i></button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>9</td>
                                                <td>
                                                    <div class="chip">
                                                        <img src="<?php echo base_url()?>assets/new/images/users/3.jpg" alt="Contact Person"> Jane Doe
                                                    </div>
                                                </td>
                                                <td>Jane@gmail.com</td>
                                                <td>+345 456 789</td>
                                                <td><span class="label label-success">Accountant</span></td>
                                                <td>18</td>
                                                <td>12-5-2017</td>
                                                <td>$100</td>
                                                <td>
                                                    <button type="button" class="btn btn-small btn-outline delete-row-btn"><i class="ti-close" aria-hidden="true"></i></button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>10</td>
                                                <td>
                                                    <div class="chip">
                                                        <img src="<?php echo base_url()?>assets/new/images/users/4.jpg" alt="Contact Person"> Jon Jonas
                                                    </div>
                                                </td>
                                                <td>Jon@gmail.com</td>
                                                <td>+456 456 789</td>
                                                <td><span class="label label-inverse">HR</span></td>
                                                <td>36</td>
                                                <td>18-5-2009</td>
                                                <td>$4200</td>
                                                <td>
                                                    <button type="button" class="btn btn-small btn-outline delete-row-btn"><i class="ti-close" aria-hidden="true"></i></button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>11</td>
                                                <td>
                                                    <div class="chip">
                                                        <img src="<?php echo base_url()?>assets/new/images/users/5.jpg" alt="Contact Person"> Ray Hudson
                                                    </div>
                                                </td>
                                                <td>Ray@gmail.com</td>
                                                <td>+567 456 789</td>
                                                <td><span class="label label-danger">Manager</span></td>
                                                <td>43</td>
                                                <td>12-10-2010</td>
                                                <td>$5200</td>
                                                <td>
                                                    <button type="button" class="btn btn-small btn-outline delete-row-btn"><i class="ti-close" aria-hidden="true"></i></button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>12</td>
                                                <td>
                                                    <div class="chip">
                                                        <img src="<?php echo base_url()?>assets/new/images/users/6.jpg" alt="Contact Person"> Steve Rogers
                                                    </div>
                                                </td>
                                                <td>Steve@gmail.com</td>
                                                <td>+123 456 789</td>
                                                <td><span class="label label-danger">Designer</span> </td>
                                                <td>23</td>
                                                <td>12-10-2014</td>
                                                <td>$1200</td>
                                                <td>
                                                    <button type="button" class="btn btn-small btn-outline delete-row-btn"><i class="ti-close" aria-hidden="true"></i></button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>13</td>
                                                <td>
                                                    <div class="chip">
                                                        <img src="<?php echo base_url()?>assets/new/images/users/7.jpg" alt="Contact Person"> Steve Harvey
                                                    </div>
                                                </td>
                                                <td>Steve@gmail.com</td>
                                                <td>+234 456 789</td>
                                                <td><span class="label label-info">Developer</span> </td>
                                                <td>26</td>
                                                <td>10-09-2014</td>
                                                <td>$1800</td>
                                                <td>
                                                    <button type="button" class="btn btn-small btn-outline delete-row-btn"><i class="ti-close" aria-hidden="true"></i></button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>14</td>
                                                <td>
                                                    <div class="chip">
                                                        <img src="<?php echo base_url()?>assets/new/images/users/8.jpg" alt="Contact Person"> Don Andres
                                                    </div>
                                                </td>
                                                <td>Don@gmail.com</td>
                                                <td>+345 456 789</td>
                                                <td><span class="label label-success">Accountant</span></td>
                                                <td>28</td>
                                                <td>1-10-2013</td>
                                                <td>$2200</td>
                                                <td>
                                                    <button type="button" class="btn btn-small btn-outline delete-row-btn"><i class="ti-close" aria-hidden="true"></i></button>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="2">
                                                    <a href="#add-contact" class="waves-effect waves-light btn modal-trigger">Add New Contact</a>
                                                </td>
                                                <div id="add-contact" class="modal">
                                                    <div class="modal-content">
                                                        <from>
                                                            <div class="row">
                                                                <div class="input-field col s12">
                                                                    <input id="name" type="text">
                                                                    <label for="name">Name</label>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="input-field col s12">
                                                                    <input id="email" type="email">
                                                                    <label for="email">Email</label>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="input-field col s12">
                                                                    <input id="phone" type="text">
                                                                    <label for="phone">Phone</label>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="input-field col s12">
                                                                    <input id="designation" type="text">
                                                                    <label for="designation">Designation</label>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="input-field col s12">
                                                                    <input id="age" type="text">
                                                                    <label for="age">Age</label>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="input-field col s12">
                                                                    <input id="date" type="text" class="datepicker">
                                                                    <label for="date">Date</label>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="input-field col s12">
                                                                    <input id="salary" type="text">
                                                                    <label for="salary">Salary</label>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="file-field input-field col s12">
                                                                    <div class="btn">
                                                                        <span>File</span>
                                                                        <input type="file">
                                                                    </div>
                                                                    <div class="file-path-wrapper">
                                                                        <input class="file-path validate" type="text">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </from>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a href="#!" class="btn modal-action modal-close waves-effect waves-light cyan">Save</a>
                                                        <a href="#!" class="btn modal-action modal-close waves-effect waves-light grey darken-4">Cancel</a>
                                                    </div>
                                                </div>
                                                <td colspan="7">
                                                    <div class="text-right">
                                                        <ul class="pagination"> </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- Column -->
                        <div class="card">
                            <div class="card-content">
                                <h4 class="card-title">Row Toggler</h4>
                                <h6 class="card-subtitle">Create your table with Toggle Footable</h6>
                                <table id="demo-foo-row-toggler" class="table toggle-circle table-hover">
                                    <thead>
                                        <tr>
                                            <th data-toggle="true"> First Name </th>
                                            <th> Last Name </th>
                                            <th data-hide="phone"> Job Title </th>
                                            <th data-hide="all"> DOB </th>
                                            <th data-hide="all"> Status </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Isidra</td>
                                            <td>Boudreaux</td>
                                            <td>Traffic Court Referee</td>
                                            <td>22 Jun 1972</td>
                                            <td><span class="label label-table label-success">Active</span></td>
                                        </tr>
                                        <tr>
                                            <td>Shona</td>
                                            <td>Woldt</td>
                                            <td>Airline Transport Pilot</td>
                                            <td>3 Oct 1981</td>
                                            <td><span class="label label-table label-inverse">Disabled</span></td>
                                        </tr>
                                        <tr>
                                            <td>Granville</td>
                                            <td>Leonardo</td>
                                            <td>Business Services Sales Representative</td>
                                            <td>19 Apr 1969</td>
                                            <td><span class="label label-table label-danger">Suspended</span></td>
                                        </tr>
                                        <tr>
                                            <td>Easer</td>
                                            <td>Dragoo</td>
                                            <td>Drywall Stripper</td>
                                            <td>13 Dec 1977</td>
                                            <td><span class="label label-table label-success">Active</span></td>
                                        </tr>
                                        <tr>
                                            <td>Maple</td>
                                            <td>Halladay</td>
                                            <td>Aviation Tactical Readiness Officer</td>
                                            <td>30 Dec 1991</td>
                                            <td><span class="label label-table label-danger">Suspended</span></td>
                                        </tr>
                                        <tr>
                                            <td>Maxine</td>
                                            <td><a href="javascript:void(0)">Woldt</a></td>
                                            <td><a href="javascript:void(0)">Business Services Sales Representative</a></td>
                                            <td>17 Oct 1987</td>
                                            <td><span class="label label-table label-inverse">Disabled</span></td>
                                        </tr>
                                        <tr>
                                            <td>Lorraine</td>
                                            <td>Mcgaughy</td>
                                            <td>Hemodialysis Technician</td>
                                            <td>11 Nov 1983</td>
                                            <td><span class="label label-table label-inverse">Disabled</span></td>
                                        </tr>
                                        <tr>
                                            <td>Lizzee</td>
                                            <td><a href="javascript:void(0)">Goodlow</a></td>
                                            <td>Technical Services Librarian</td>
                                            <td>1 Nov 1961</td>
                                            <td><span class="label label-table label-danger">Suspended</span></td>
                                        </tr>
                                        <tr>
                                            <td>Judi</td>
                                            <td>Badgett</td>
                                            <td>Electrical Lineworker</td>
                                            <td>23 Jun 1981</td>
                                            <td><span class="label label-table label-success">Active</span></td>
                                        </tr>
                                        <tr>
                                            <td>Lauri</td>
                                            <td>Hyland</td>
                                            <td>Blackjack Supervisor</td>
                                            <td>15 Nov 1985</td>
                                            <td><span class="label label-table label-danger">Suspended</span></td>
                                        </tr>
                                        <tr>
                                            <td>Isidra</td>
                                            <td>Boudreaux</td>
                                            <td>Traffic Court Referee</td>
                                            <td>22 Jun 1972</td>
                                            <td><span class="label label-table label-success">Active</span></td>
                                        </tr>
                                        <tr>
                                            <td>Shona</td>
                                            <td>Woldt</td>
                                            <td>Airline Transport Pilot</td>
                                            <td>3 Oct 1981</td>
                                            <td><span class="label label-table label-inverse">Disabled</span></td>
                                        </tr>
                                        <tr>
                                            <td>Granville</td>
                                            <td>Leonardo</td>
                                            <td>Business Services Sales Representative</td>
                                            <td>19 Apr 1969</td>
                                            <td><span class="label label-table label-danger">Suspended</span></td>
                                        </tr>
                                        <tr>
                                            <td>Easer</td>
                                            <td>Dragoo</td>
                                            <td>Drywall Stripper</td>
                                            <td>13 Dec 1977</td>
                                            <td><span class="label label-table label-success">Active</span></td>
                                        </tr>
                                        <tr>
                                            <td>Maple</td>
                                            <td>Halladay</td>
                                            <td>Aviation Tactical Readiness Officer</td>
                                            <td>30 Dec 1991</td>
                                            <td><span class="label label-table label-danger">Suspended</span></td>
                                        </tr>
                                        <tr>
                                            <td>Maxine</td>
                                            <td><a href="javascript:void(0)">Woldt</a></td>
                                            <td><a href="javascript:void(0)">Business Services Sales Representative</a></td>
                                            <td>17 Oct 1987</td>
                                            <td><span class="label label-table label-inverse">Disabled</span></td>
                                        </tr>
                                        <tr>
                                            <td>Lorraine</td>
                                            <td>Mcgaughy</td>
                                            <td>Hemodialysis Technician</td>
                                            <td>11 Nov 1983</td>
                                            <td><span class="label label-table label-inverse">Disabled</span></td>
                                        </tr>
                                        <tr>
                                            <td>Lizzee</td>
                                            <td><a href="javascript:void(0)">Goodlow</a></td>
                                            <td>Technical Services Librarian</td>
                                            <td>1 Nov 1961</td>
                                            <td><span class="label label-table label-danger">Suspended</span></td>
                                        </tr>
                                        <tr>
                                            <td>Judi</td>
                                            <td>Badgett</td>
                                            <td>Electrical Lineworker</td>
                                            <td>23 Jun 1981</td>
                                            <td><span class="label label-table label-success">Active</span></td>
                                        </tr>
                                        <tr>
                                            <td>Lauri</td>
                                            <td>Hyland</td>
                                            <td>Blackjack Supervisor</td>
                                            <td>15 Nov 1985</td>
                                            <td><span class="label label-table label-danger">Suspended</span></td>
                                        </tr>
                                        <tr>
                                            <td>Isidra</td>
                                            <td>Boudreaux</td>
                                            <td>Traffic Court Referee</td>
                                            <td>22 Jun 1972</td>
                                            <td><span class="label label-table label-success">Active</span></td>
                                        </tr>
                                        <tr>
                                            <td>Shona</td>
                                            <td>Woldt</td>
                                            <td>Airline Transport Pilot</td>
                                            <td>3 Oct 1981</td>
                                            <td><span class="label label-table label-inverse">Disabled</span></td>
                                        </tr>
                                        <tr>
                                            <td>Granville</td>
                                            <td>Leonardo</td>
                                            <td>Business Services Sales Representative</td>
                                            <td>19 Apr 1969</td>
                                            <td><span class="label label-table label-danger">Suspended</span></td>
                                        </tr>
                                        <tr>
                                            <td>Easer</td>
                                            <td>Dragoo</td>
                                            <td>Drywall Stripper</td>
                                            <td>13 Dec 1977</td>
                                            <td><span class="label label-table label-success">Active</span></td>
                                        </tr>
                                        <tr>
                                            <td>Maple</td>
                                            <td>Halladay</td>
                                            <td>Aviation Tactical Readiness Officer</td>
                                            <td>30 Dec 1991</td>
                                            <td><span class="label label-table label-danger">Suspended</span></td>
                                        </tr>
                                        <tr>
                                            <td>Maxine</td>
                                            <td><a href="javascript:void(0)">Woldt</a></td>
                                            <td><a href="javascript:void(0)">Business Services Sales Representative</a></td>
                                            <td>17 Oct 1987</td>
                                            <td><span class="label label-table label-inverse">Disabled</span></td>
                                        </tr>
                                        <tr>
                                            <td>Lorraine</td>
                                            <td>Mcgaughy</td>
                                            <td>Hemodialysis Technician</td>
                                            <td>11 Nov 1983</td>
                                            <td><span class="label label-table label-inverse">Disabled</span></td>
                                        </tr>
                                        <tr>
                                            <td>Lizzee</td>
                                            <td><a href="javascript:void(0)">Goodlow</a></td>
                                            <td>Technical Services Librarian</td>
                                            <td>1 Nov 1961</td>
                                            <td><span class="label label-table label-danger">Suspended</span></td>
                                        </tr>
                                        <tr>
                                            <td>Judi</td>
                                            <td>Badgett</td>
                                            <td>Electrical Lineworker</td>
                                            <td>23 Jun 1981</td>
                                            <td><span class="label label-table label-success">Active</span></td>
                                        </tr>
                                        <tr>
                                            <td>Lauri</td>
                                            <td>Hyland</td>
                                            <td>Blackjack Supervisor</td>
                                            <td>15 Nov 1985</td>
                                            <td><span class="label label-table label-danger">Suspended</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- Column -->
                        <div class="card">
                            <div class="card-content">
                                <h4 class="card-title">Accordion Footable</h4>
                                <h6 class="card-subtitle">Create your table with Accordion Footable</h6>
                                <table id="demo-foo-accordion" class="table m-b-0 toggle-arrow-tiny">
                                    <thead>
                                        <tr>
                                            <th data-toggle="true"> First Name </th>
                                            <th> Last Name </th>
                                            <th data-hide="phone"> Job Title </th>
                                            <th data-hide="all"> DOB </th>
                                            <th data-hide="all"> Status </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Isidra</td>
                                            <td>Boudreaux</td>
                                            <td>Traffic Court Referee</td>
                                            <td>22 Jun 1972</td>
                                            <td><span class="label label-table label-success">Active</span></td>
                                        </tr>
                                        <tr>
                                            <td>Shona</td>
                                            <td>Woldt</td>
                                            <td>Airline Transport Pilot</td>
                                            <td>3 Oct 1981</td>
                                            <td><span class="label label-table label-inverse">Disabled</span></td>
                                        </tr>
                                        <tr>
                                            <td>Granville</td>
                                            <td>Leonardo</td>
                                            <td>Business Services Sales Representative</td>
                                            <td>19 Apr 1969</td>
                                            <td><span class="label label-table label-danger">Suspended</span></td>
                                        </tr>
                                        <tr>
                                            <td>Easer</td>
                                            <td>Dragoo</td>
                                            <td>Drywall Stripper</td>
                                            <td>13 Dec 1977</td>
                                            <td><span class="label label-table label-success">Active</span></td>
                                        </tr>
                                        <tr>
                                            <td>Maple</td>
                                            <td>Halladay</td>
                                            <td>Aviation Tactical Readiness Officer</td>
                                            <td>30 Dec 1991</td>
                                            <td><span class="label label-table label-danger">Suspended</span></td>
                                        </tr>
                                        <tr>
                                            <td>Maxine</td>
                                            <td><a href="javascript:void(0)">Woldt</a></td>
                                            <td><a href="javascript:void(0)">Business Services Sales Representative</a></td>
                                            <td>17 Oct 1987</td>
                                            <td><span class="label label-table label-inverse">Disabled</span></td>
                                        </tr>
                                        <tr>
                                            <td>Lorraine</td>
                                            <td>Mcgaughy</td>
                                            <td>Hemodialysis Technician</td>
                                            <td>11 Nov 1983</td>
                                            <td><span class="label label-table label-inverse">Disabled</span></td>
                                        </tr>
                                        <tr>
                                            <td>Lizzee</td>
                                            <td><a href="javascript:void(0)">Goodlow</a></td>
                                            <td>Technical Services Librarian</td>
                                            <td>1 Nov 1961</td>
                                            <td><span class="label label-table label-danger">Suspended</span></td>
                                        </tr>
                                        <tr>
                                            <td>Judi</td>
                                            <td>Badgett</td>
                                            <td>Electrical Lineworker</td>
                                            <td>23 Jun 1981</td>
                                            <td><span class="label label-table label-success">Active</span></td>
                                        </tr>
                                        <tr>
                                            <td>Lauri</td>
                                            <td>Hyland</td>
                                            <td>Blackjack Supervisor</td>
                                            <td>15 Nov 1985</td>
                                            <td><span class="label label-table label-danger">Suspended</span></td>
                                        </tr>
                                        <tr>
                                            <td>Isidra</td>
                                            <td>Boudreaux</td>
                                            <td>Traffic Court Referee</td>
                                            <td>22 Jun 1972</td>
                                            <td><span class="label label-table label-success">Active</span></td>
                                        </tr>
                                        <tr>
                                            <td>Shona</td>
                                            <td>Woldt</td>
                                            <td>Airline Transport Pilot</td>
                                            <td>3 Oct 1981</td>
                                            <td><span class="label label-table label-inverse">Disabled</span></td>
                                        </tr>
                                        <tr>
                                            <td>Granville</td>
                                            <td>Leonardo</td>
                                            <td>Business Services Sales Representative</td>
                                            <td>19 Apr 1969</td>
                                            <td><span class="label label-table label-danger">Suspended</span></td>
                                        </tr>
                                        <tr>
                                            <td>Easer</td>
                                            <td>Dragoo</td>
                                            <td>Drywall Stripper</td>
                                            <td>13 Dec 1977</td>
                                            <td><span class="label label-table label-success">Active</span></td>
                                        </tr>
                                        <tr>
                                            <td>Maple</td>
                                            <td>Halladay</td>
                                            <td>Aviation Tactical Readiness Officer</td>
                                            <td>30 Dec 1991</td>
                                            <td><span class="label label-table label-danger">Suspended</span></td>
                                        </tr>
                                        <tr>
                                            <td>Maxine</td>
                                            <td><a href="javascript:void(0)">Woldt</a></td>
                                            <td><a href="javascript:void(0)">Business Services Sales Representative</a></td>
                                            <td>17 Oct 1987</td>
                                            <td><span class="label label-table label-inverse">Disabled</span></td>
                                        </tr>
                                        <tr>
                                            <td>Lorraine</td>
                                            <td>Mcgaughy</td>
                                            <td>Hemodialysis Technician</td>
                                            <td>11 Nov 1983</td>
                                            <td><span class="label label-table label-inverse">Disabled</span></td>
                                        </tr>
                                        <tr>
                                            <td>Lizzee</td>
                                            <td><a href="javascript:void(0)">Goodlow</a></td>
                                            <td>Technical Services Librarian</td>
                                            <td>1 Nov 1961</td>
                                            <td><span class="label label-table label-danger">Suspended</span></td>
                                        </tr>
                                        <tr>
                                            <td>Judi</td>
                                            <td>Badgett</td>
                                            <td>Electrical Lineworker</td>
                                            <td>23 Jun 1981</td>
                                            <td><span class="label label-table label-success">Active</span></td>
                                        </tr>
                                        <tr>
                                            <td>Lauri</td>
                                            <td>Hyland</td>
                                            <td>Blackjack Supervisor</td>
                                            <td>15 Nov 1985</td>
                                            <td><span class="label label-table label-danger">Suspended</span></td>
                                        </tr>
                                        <tr>
                                            <td>Isidra</td>
                                            <td>Boudreaux</td>
                                            <td>Traffic Court Referee</td>
                                            <td>22 Jun 1972</td>
                                            <td><span class="label label-table label-success">Active</span></td>
                                        </tr>
                                        <tr>
                                            <td>Shona</td>
                                            <td>Woldt</td>
                                            <td>Airline Transport Pilot</td>
                                            <td>3 Oct 1981</td>
                                            <td><span class="label label-table label-inverse">Disabled</span></td>
                                        </tr>
                                        <tr>
                                            <td>Granville</td>
                                            <td>Leonardo</td>
                                            <td>Business Services Sales Representative</td>
                                            <td>19 Apr 1969</td>
                                            <td><span class="label label-table label-danger">Suspended</span></td>
                                        </tr>
                                        <tr>
                                            <td>Easer</td>
                                            <td>Dragoo</td>
                                            <td>Drywall Stripper</td>
                                            <td>13 Dec 1977</td>
                                            <td><span class="label label-table label-success">Active</span></td>
                                        </tr>
                                        <tr>
                                            <td>Maple</td>
                                            <td>Halladay</td>
                                            <td>Aviation Tactical Readiness Officer</td>
                                            <td>30 Dec 1991</td>
                                            <td><span class="label label-table label-danger">Suspended</span></td>
                                        </tr>
                                        <tr>
                                            <td>Maxine</td>
                                            <td><a href="javascript:void(0)">Woldt</a></td>
                                            <td><a href="javascript:void(0)">Business Services Sales Representative</a></td>
                                            <td>17 Oct 1987</td>
                                            <td><span class="label label-table label-inverse">Disabled</span></td>
                                        </tr>
                                        <tr>
                                            <td>Lorraine</td>
                                            <td>Mcgaughy</td>
                                            <td>Hemodialysis Technician</td>
                                            <td>11 Nov 1983</td>
                                            <td><span class="label label-table label-inverse">Disabled</span></td>
                                        </tr>
                                        <tr>
                                            <td>Lizzee</td>
                                            <td><a href="javascript:void(0)">Goodlow</a></td>
                                            <td>Technical Services Librarian</td>
                                            <td>1 Nov 1961</td>
                                            <td><span class="label label-table label-danger">Suspended</span></td>
                                        </tr>
                                        <tr>
                                            <td>Judi</td>
                                            <td>Badgett</td>
                                            <td>Electrical Lineworker</td>
                                            <td>23 Jun 1981</td>
                                            <td><span class="label label-table label-success">Active</span></td>
                                        </tr>
                                        <tr>
                                            <td>Lauri</td>
                                            <td>Hyland</td>
                                            <td>Blackjack Supervisor</td>
                                            <td>15 Nov 1985</td>
                                            <td><span class="label label-table label-danger">Suspended</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- Column -->
                        <div class="card">
                            <div class="card-content">
                                <h4 class="card-title">Pagination Footable</h4>
                                <h6 class="card-subtitle">Create your table with Paginated Footable</h6>
                                <div class="row">
                                    <div class="col s12 l6">
                                        Show &nbsp;
                                        <div class="input-field inline">
                                            <select id="demo-show-entries">
                                                <option value="5">5</option>
                                                <option value="10">10</option>
                                                <option value="15">15</option>
                                                <option value="20">20</option>
                                            </select>
                                        </div>
                                        &nbsp; entries
                                    </div>
                                </div>
                                <table id="demo-foo-pagination" class="table m-b-0 toggle-arrow-tiny" data-page-size="5">
                                    <thead>
                                        <tr>
                                            <th data-toggle="true"> First Name </th>
                                            <th> Last Name </th>
                                            <th data-hide="phone"> Job Title </th>
                                            <th data-hide="all"> DOB </th>
                                            <th data-hide="all"> Status </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Isidra</td>
                                            <td>Boudreaux</td>
                                            <td>Traffic Court Referee</td>
                                            <td>22 Jun 1972</td>
                                            <td><span class="label label-table label-success">Active</span></td>
                                        </tr>
                                        <tr>
                                            <td>Shona</td>
                                            <td>Woldt</td>
                                            <td>Airline Transport Pilot</td>
                                            <td>3 Oct 1981</td>
                                            <td><span class="label label-table label-inverse">Disabled</span></td>
                                        </tr>
                                        <tr>
                                            <td>Granville</td>
                                            <td>Leonardo</td>
                                            <td>Business Services Sales Representative</td>
                                            <td>19 Apr 1969</td>
                                            <td><span class="label label-table label-danger">Suspended</span></td>
                                        </tr>
                                        <tr>
                                            <td>Easer</td>
                                            <td>Dragoo</td>
                                            <td>Drywall Stripper</td>
                                            <td>13 Dec 1977</td>
                                            <td><span class="label label-table label-success">Active</span></td>
                                        </tr>
                                        <tr>
                                            <td>Maple</td>
                                            <td>Halladay</td>
                                            <td>Aviation Tactical Readiness Officer</td>
                                            <td>30 Dec 1991</td>
                                            <td><span class="label label-table label-danger">Suspended</span></td>
                                        </tr>
                                        <tr>
                                            <td>Maxine</td>
                                            <td><a href="javascript:void(0)">Woldt</a></td>
                                            <td><a href="javascript:void(0)">Business Services Sales Representative</a></td>
                                            <td>17 Oct 1987</td>
                                            <td><span class="label label-table label-inverse">Disabled</span></td>
                                        </tr>
                                        <tr>
                                            <td>Lorraine</td>
                                            <td>Mcgaughy</td>
                                            <td>Hemodialysis Technician</td>
                                            <td>11 Nov 1983</td>
                                            <td><span class="label label-table label-inverse">Disabled</span></td>
                                        </tr>
                                        <tr>
                                            <td>Lizzee</td>
                                            <td><a href="javascript:void(0)">Goodlow</a></td>
                                            <td>Technical Services Librarian</td>
                                            <td>1 Nov 1961</td>
                                            <td><span class="label label-table label-danger">Suspended</span></td>
                                        </tr>
                                        <tr>
                                            <td>Judi</td>
                                            <td>Badgett</td>
                                            <td>Electrical Lineworker</td>
                                            <td>23 Jun 1981</td>
                                            <td><span class="label label-table label-success">Active</span></td>
                                        </tr>
                                        <tr>
                                            <td>Lauri</td>
                                            <td>Hyland</td>
                                            <td>Blackjack Supervisor</td>
                                            <td>15 Nov 1985</td>
                                            <td><span class="label label-table label-danger">Suspended</span></td>
                                        </tr>
                                        <tr>
                                            <td>Isidra</td>
                                            <td>Boudreaux</td>
                                            <td>Traffic Court Referee</td>
                                            <td>22 Jun 1972</td>
                                            <td><span class="label label-table label-success">Active</span></td>
                                        </tr>
                                        <tr>
                                            <td>Shona</td>
                                            <td>Woldt</td>
                                            <td>Airline Transport Pilot</td>
                                            <td>3 Oct 1981</td>
                                            <td><span class="label label-table label-inverse">Disabled</span></td>
                                        </tr>
                                        <tr>
                                            <td>Granville</td>
                                            <td>Leonardo</td>
                                            <td>Business Services Sales Representative</td>
                                            <td>19 Apr 1969</td>
                                            <td><span class="label label-table label-danger">Suspended</span></td>
                                        </tr>
                                        <tr>
                                            <td>Easer</td>
                                            <td>Dragoo</td>
                                            <td>Drywall Stripper</td>
                                            <td>13 Dec 1977</td>
                                            <td><span class="label label-table label-success">Active</span></td>
                                        </tr>
                                        <tr>
                                            <td>Maple</td>
                                            <td>Halladay</td>
                                            <td>Aviation Tactical Readiness Officer</td>
                                            <td>30 Dec 1991</td>
                                            <td><span class="label label-table label-danger">Suspended</span></td>
                                        </tr>
                                        <tr>
                                            <td>Maxine</td>
                                            <td><a href="javascript:void(0)">Woldt</a></td>
                                            <td><a href="javascript:void(0)">Business Services Sales Representative</a></td>
                                            <td>17 Oct 1987</td>
                                            <td><span class="label label-table label-inverse">Disabled</span></td>
                                        </tr>
                                        <tr>
                                            <td>Lorraine</td>
                                            <td>Mcgaughy</td>
                                            <td>Hemodialysis Technician</td>
                                            <td>11 Nov 1983</td>
                                            <td><span class="label label-table label-inverse">Disabled</span></td>
                                        </tr>
                                        <tr>
                                            <td>Lizzee</td>
                                            <td><a href="javascript:void(0)">Goodlow</a></td>
                                            <td>Technical Services Librarian</td>
                                            <td>1 Nov 1961</td>
                                            <td><span class="label label-table label-danger">Suspended</span></td>
                                        </tr>
                                        <tr>
                                            <td>Judi</td>
                                            <td>Badgett</td>
                                            <td>Electrical Lineworker</td>
                                            <td>23 Jun 1981</td>
                                            <td><span class="label label-table label-success">Active</span></td>
                                        </tr>
                                        <tr>
                                            <td>Lauri</td>
                                            <td>Hyland</td>
                                            <td>Blackjack Supervisor</td>
                                            <td>15 Nov 1985</td>
                                            <td><span class="label label-table label-danger">Suspended</span></td>
                                        </tr>
                                        <tr>
                                            <td>Isidra</td>
                                            <td>Boudreaux</td>
                                            <td>Traffic Court Referee</td>
                                            <td>22 Jun 1972</td>
                                            <td><span class="label label-table label-success">Active</span></td>
                                        </tr>
                                        <tr>
                                            <td>Shona</td>
                                            <td>Woldt</td>
                                            <td>Airline Transport Pilot</td>
                                            <td>3 Oct 1981</td>
                                            <td><span class="label label-table label-inverse">Disabled</span></td>
                                        </tr>
                                        <tr>
                                            <td>Granville</td>
                                            <td>Leonardo</td>
                                            <td>Business Services Sales Representative</td>
                                            <td>19 Apr 1969</td>
                                            <td><span class="label label-table label-danger">Suspended</span></td>
                                        </tr>
                                        <tr>
                                            <td>Easer</td>
                                            <td>Dragoo</td>
                                            <td>Drywall Stripper</td>
                                            <td>13 Dec 1977</td>
                                            <td><span class="label label-table label-success">Active</span></td>
                                        </tr>
                                        <tr>
                                            <td>Maple</td>
                                            <td>Halladay</td>
                                            <td>Aviation Tactical Readiness Officer</td>
                                            <td>30 Dec 1991</td>
                                            <td><span class="label label-table label-danger">Suspended</span></td>
                                        </tr>
                                        <tr>
                                            <td>Maxine</td>
                                            <td><a href="javascript:void(0)">Woldt</a></td>
                                            <td><a href="javascript:void(0)">Business Services Sales Representative</a></td>
                                            <td>17 Oct 1987</td>
                                            <td><span class="label label-table label-inverse">Disabled</span></td>
                                        </tr>
                                        <tr>
                                            <td>Lorraine</td>
                                            <td>Mcgaughy</td>
                                            <td>Hemodialysis Technician</td>
                                            <td>11 Nov 1983</td>
                                            <td><span class="label label-table label-inverse">Disabled</span></td>
                                        </tr>
                                        <tr>
                                            <td>Lizzee</td>
                                            <td><a href="javascript:void(0)">Goodlow</a></td>
                                            <td>Technical Services Librarian</td>
                                            <td>1 Nov 1961</td>
                                            <td><span class="label label-table label-danger">Suspended</span></td>
                                        </tr>
                                        <tr>
                                            <td>Judi</td>
                                            <td>Badgett</td>
                                            <td>Electrical Lineworker</td>
                                            <td>23 Jun 1981</td>
                                            <td><span class="label label-table label-success">Active</span></td>
                                        </tr>
                                        <tr>
                                            <td>Lauri</td>
                                            <td>Hyland</td>
                                            <td>Blackjack Supervisor</td>
                                            <td>15 Nov 1985</td>
                                            <td><span class="label label-table label-danger">Suspended</span></td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="5">
                                                <div class="text-right">
                                                    <ul class="pagination pagination-split m-t-30"> </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <!-- Column -->
                        <div class="card">
                            <div class="card-content">
                                <h4 class="card-title">Add & Remove Rows</h4>
                                <h6 class="card-subtitle">You can add or remove rows with Footable</h6>
                                <table id="demo-foo-addrow2" class="table table-bordered table-hover toggle-circle" data-page-size="7">
                                    <thead>
                                        <tr>
                                            <th data-sort-initial="true" data-toggle="true">First Name</th>
                                            <th>Last Name</th>
                                            <th data-hide="phone, tablet">Job Title</th>
                                            <th data-hide="phone, tablet">DOB</th>
                                            <th data-hide="phone, tablet">Status</th>
                                            <th data-sort-ignore="true" class="min-width">Delete</th>
                                        </tr>
                                    </thead>
                                    <div class="m-t-40">
                                        <div class="d-flex">
                                            <div class="mr-auto">
                                                <div class="form-group">
                                                    <button id="demo-btn-addrow" class="btn btn-small"><i class="icon wb-plus" aria-hidden="true"></i>Add New Row
                                                    </button>
                                                    <small>New row will be added in last page.</small> </div>
                                            </div>
                                            <div class="ml-auto">
                                                <div class="form-group">
                                                    <input id="demo-input-search2" type="text" placeholder="Search" autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <tbody>
                                        <tr>
                                            <td>Shona</td>
                                            <td>Woldt</td>
                                            <td>Airline Transport Pilot</td>
                                            <td>3 Oct 2017</td>
                                            <td><span class="label label-table label-success">Active</span> </td>
                                            <td>
                                                <button type="button" class="btn btn-small btn-outline delete-row-btn"><i class="ti-close" aria-hidden="true"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Lizzee</td>
                                            <td>Goodlow</td>
                                            <td>Technical Services Librarian</td>
                                            <td>1 Nov 2014</td>
                                            <td><span class="label label-table label-danger">Suspended</span> </td>
                                            <td>
                                                <button type="button" class="btn btn-small btn-outline delete-row-btn"><i class="ti-close" aria-hidden="true"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Isidra</td>
                                            <td>Boudreaux</td>
                                            <td>Traffic Court Referee</td>
                                            <td>22 Jun 2014</td>
                                            <td><span class="label label-table label-success">Active</span> </td>
                                            <td>
                                                <button type="button" class="btn btn-small btn-outline delete-row-btn"><i class="ti-close" aria-hidden="true"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Doris</td>
                                            <td>Michael</td>
                                            <td>Business Services Sales Representative</td>
                                            <td>19 Apr 2013</td>
                                            <td><span class="label label-table label-danger">Suspended</span> </td>
                                            <td>
                                                <button type="button" class="btn btn-small btn-outline delete-row-btn"><i class="ti-close" aria-hidden="true"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Lauri</td>
                                            <td>Hyland</td>
                                            <td>Blackjack Supervisor</td>
                                            <td>15 Nov 2014</td>
                                            <td><span class="label label-table label-danger">Suspended</span> </td>
                                            <td>
                                                <button type="button" class="btn btn-small btn-outline delete-row-btn"><i class="ti-close" aria-hidden="true"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Maple</td>
                                            <td>Halladay</td>
                                            <td>Aviation Tactical Readiness Officer</td>
                                            <td>30 Dec 2017</td>
                                            <td><span class="label label-table label-danger">Suspended</span> </td>
                                            <td>
                                                <button type="button" class="btn btn-small btn-outline delete-row-btn"><i class="ti-close" aria-hidden="true"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Lorraine</td>
                                            <td>Mcgaughy</td>
                                            <td>Hemodialysis Technician</td>
                                            <td>11 Nov 2014</td>
                                            <td><span class="label label-table label-success">Active</span> </td>
                                            <td>
                                                <button type="button" class="btn btn-small btn-outline delete-row-btn"><i class="ti-close" aria-hidden="true"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Judi</td>
                                            <td>Badgett</td>
                                            <td>Electrical Lineworker</td>
                                            <td>23 Jun 2013</td>
                                            <td><span class="label label-table label-success">Active</span> </td>
                                            <td>
                                                <button type="button" class="btn btn-small btn-outline delete-row-btn"><i class="ti-close" aria-hidden="true"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Granville</td>
                                            <td>Leonardo</td>
                                            <td>Business Services Sales Representative</td>
                                            <td>19 Apr 2013</td>
                                            <td><span class="label label-table label-danger">Suspended</span> </td>
                                            <td>
                                                <button type="button" class="btn btn-small btn-outline delete-row-btn"><i class="ti-close" aria-hidden="true"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Lauri</td>
                                            <td>Hyland</td>
                                            <td>Blackjack Supervisor</td>
                                            <td>15 Nov 2014</td>
                                            <td><span class="label label-table label-danger">Suspended</span> </td>
                                            <td>
                                                <button type="button" class="btn btn-small btn-outline delete-row-btn"><i class="ti-close" aria-hidden="true"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Maple</td>
                                            <td>Halladay</td>
                                            <td>Aviation Tactical Readiness Officer</td>
                                            <td>30 Dec 2017</td>
                                            <td><span class="label label-table label-danger">Suspended</span> </td>
                                            <td>
                                                <button type="button" class="btn btn-small btn-outline delete-row-btn"><i class="ti-close" aria-hidden="true"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Lorraine</td>
                                            <td>Mcgaughy</td>
                                            <td>Hemodialysis Technician</td>
                                            <td>11 Nov 2014</td>
                                            <td><span class="label label-table label-success">Active</span> </td>
                                            <td>
                                                <button type="button" class="btn btn-small btn-outline delete-row-btn"><i class="ti-close" aria-hidden="true"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Judi</td>
                                            <td>Badgett</td>
                                            <td>Electrical Lineworker</td>
                                            <td>23 Jun 2013</td>
                                            <td><span class="label label-table label-success">Active</span> </td>
                                            <td>
                                                <button type="button" class="btn btn-small btn-outline delete-row-btn"><i class="ti-close" aria-hidden="true"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Granville</td>
                                            <td>Leonardo</td>
                                            <td>Business Services Sales Representative</td>
                                            <td>19 Apr 2013</td>
                                            <td><span class="label label-table label-danger">Suspended</span> </td>
                                            <td>
                                                <button type="button" class="btn btn-small btn-outline delete-row-btn"><i class="ti-close" aria-hidden="true"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Lauri</td>
                                            <td>Hyland</td>
                                            <td>Blackjack Supervisor</td>
                                            <td>15 Nov 2014</td>
                                            <td><span class="label label-table label-danger">Suspended</span> </td>
                                            <td>
                                                <button type="button" class="btn btn-small btn-outline delete-row-btn"><i class="ti-close" aria-hidden="true"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Easer</td>
                                            <td>Dragoo</td>
                                            <td>Drywall Stripper</td>
                                            <td>13 Dec 2014</td>
                                            <td><span class="label label-table label-success">Active</span> </td>
                                            <td>
                                                <button type="button" class="btn btn-small btn-outline delete-row-btn"><i class="ti-close" aria-hidden="true"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Maple</td>
                                            <td>Halladay</td>
                                            <td>Aviation Tactical Readiness Officer</td>
                                            <td>30 Dec 2017</td>
                                            <td><span class="label label-table label-danger">Suspended</span> </td>
                                            <td>
                                                <button type="button" class="btn btn-small btn-outline delete-row-btn"><i class="ti-close" aria-hidden="true"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Maria</td>
                                            <td>Tangeli</td>
                                            <td>Drywall Stripper</td>
                                            <td>21 May 2014</td>
                                            <td><span class="label label-table label-success">Active</span> </td>
                                            <td>
                                                <button type="button" class="btn btn-small btn-outline delete-row-btn"><i class="ti-close" aria-hidden="true"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Maple</td>
                                            <td>Halladay</td>
                                            <td>Aviation Tactical Readiness Officer</td>
                                            <td>30 Dec 2017</td>
                                            <td><span class="label label-table label-danger">Suspended</span> </td>
                                            <td>
                                                <button type="button" class="btn btn-small btn-outline delete-row-btn"><i class="ti-close" aria-hidden="true"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Easer</td>
                                            <td>Dragoo</td>
                                            <td>Drywall Stripper</td>
                                            <td>13 Dec 2014</td>
                                            <td><span class="label label-table label-success">Active</span> </td>
                                            <td>
                                                <button type="button" class="btn btn-small btn-outline delete-row-btn"><i class="ti-close" aria-hidden="true"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Maple</td>
                                            <td>Halladay</td>
                                            <td>Aviation Tactical Readiness Officer</td>
                                            <td>30 Dec 2017</td>
                                            <td><span class="label label-table label-danger">Suspended</span> </td>
                                            <td>
                                                <button type="button" class="btn btn-small btn-outline delete-row-btn"><i class="ti-close" aria-hidden="true"></i></button>
                                            </td>
                                        </tr>
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
            <!-- ============================================================== -->
            <!-- Container fluid scss in scafholding.scss -->
            <!-- ============================================================== -->
            <footer class="center-align m-b-30">All Rights Reserved by Materialart. Designed and Developed by <a href="https://wrappixel.com">WrapPixel</a>.</footer>
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
                                <li class="tab col s4"><a href="#chat"><span class="material-icons">chat_bubble</span></a></li>
                                <li class="tab col s4"><a href="#activity"><span class="material-icons">local_activity</span></a></li>
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
                        <!-- chat -->
                        <div id="chat" class="col s12">
                            <ul class="mailbox m-t-20">
                                <li>
                                    <div class="message-center">
                                        <!-- Message -->
                                        <a href="#" class="user-info" id='chat_user_1' data-user-id='1'>
                                            <span class="user-img">
                                                <img src="<?php echo base_url()?>assets/new/images/users/1.jpg" alt="user" class="circle">
                                                <span class="profile-status online pull-right" data-status="online"></span>
                                            </span>
                                            <span class="mail-contnet">
                                                <h5>Chris Evans</h5>
                                                <span class="mail-desc">Just see the my admin!</span>
                                                <span class="time">9:30 AM</span>
                                            </span>
                                        </a>
                                        <!-- Message -->
                                        <a href="#" class="user-info" id='chat_user_2' data-user-id='2'>
                                            <span class="user-img">
                                                <img src="<?php echo base_url()?>assets/new/images/users/2.jpg" alt="user" class="circle">
                                                <span class="profile-status busy pull-right" data-status="busy"></span>
                                            </span>
                                            <span class="mail-contnet">
                                                <h5>Ray Hudson</h5>
                                                <span class="mail-desc">I've sung a song! See you at</span>
                                                <span class="time">9:10 AM</span>
                                            </span>
                                        </a>
                                        <!-- Message -->
                                        <a href="#" class="user-info" id='chat_user_3' data-user-id='3'>
                                            <span class="user-img">
                                                <img src="<?php echo base_url()?>assets/new/images/users/3.jpg" alt="user" class="circle">
                                                <span class="profile-status away pull-right" data-status="away"></span>
                                            </span>
                                            <span class="mail-contnet">
                                                <h5>Lb James</h5>
                                                <span class="mail-desc">I am a singer!</span>
                                                <span class="time">9:08 AM</span>
                                            </span>
                                        </a>
                                        <!-- Message -->
                                        <a href="#" class="user-info" id='chat_user_4' data-user-id='4'>
                                            <span class="user-img">
                                                <img src="<?php echo base_url()?>assets/new/images/users/4.jpg" alt="user" class="circle">
                                                <span class="profile-status offline pull-right" data-status="offline"></span>
                                            </span>
                                            <span class="mail-contnet">
                                                <h5>Don Andres</h5>
                                                <span class="mail-desc">Just see the my admin!</span>
                                                <span class="time">9:02 AM</span>
                                            </span>
                                        </a>
                                        <!-- Message -->
                                        <a href="#" class="user-info" id='chat_user_5' data-user-id='5'>
                                            <span class="user-img">
                                                <img src="<?php echo base_url()?>assets/new/images/users/1.jpg" alt="user" class="circle">
                                                <span class="profile-status online pull-right" data-status="online"></span>
                                            </span>
                                            <span class="mail-contnet">
                                                <h5>Chris Evans</h5>
                                                <span class="mail-desc">Just see the my admin!</span>
                                                <span class="time">9:30 AM</span>
                                            </span>
                                        </a>
                                        <!-- Message -->
                                        <a href="#" class="user-info" id='chat_user_6' data-user-id='6'>
                                            <span class="user-img">
                                                <img src="<?php echo base_url()?>assets/new/images/users/2.jpg" alt="user" class="circle">
                                                <span class="profile-status busy pull-right" data-status="busy"></span>
                                            </span>
                                            <span class="mail-contnet">
                                                <h5>Ray Hudson</h5>
                                                <span class="mail-desc">I've sung a song! See you at</span>
                                                <span class="time">9:10 AM</span>
                                            </span>
                                        </a>
                                        <!-- Message -->
                                        <a href="#" class="user-info" id='chat_user_7' data-user-id='7'>
                                            <span class="user-img">
                                                <img src="<?php echo base_url()?>assets/new/images/users/3.jpg" alt="user" class="circle">
                                                <span class="profile-status away pull-right" data-status="away"></span>
                                            </span>
                                            <span class="mail-contnet">
                                                <h5>Lb James</h5>
                                                <span class="mail-desc">I am a singer!</span>
                                                <span class="time">9:08 AM</span>
                                            </span>
                                        </a>
                                        <!-- Message -->
                                        <a href="#" class="user-info" id='chat_user_8' data-user-id='8'>
                                            <span class="user-img">
                                                <img src="<?php echo base_url()?>assets/new/images/users/4.jpg" alt="user" class="circle">
                                                <span class="profile-status offline pull-right" data-status="offline"></span>
                                            </span>
                                            <span class="mail-contnet">
                                                <h5>Don Andres</h5>
                                                <span class="mail-desc">Just see the my admin!</span>
                                                <span class="time">9:02 AM</span>
                                            </span>
                                        </a>
                                        <!-- Message -->
                                        <a href="#" class="user-info" id='chat_user_9' data-user-id='9'>
                                            <span class="user-img">
                                                <img src="<?php echo base_url()?>assets/new/images/users/1.jpg" alt="user" class="circle">
                                                <span class="profile-status online pull-right" data-status="online"></span>
                                            </span>
                                            <span class="mail-contnet">
                                                <h5>Chris Evans</h5>
                                                <span class="mail-desc">Just see the my admin!</span>
                                                <span class="time">9:30 AM</span>
                                            </span>
                                        </a>
                                        <!-- Message -->
                                        <a href="#" class="user-info" id='chat_user_10' data-user-id='10'>
                                            <span class="user-img">
                                                <img src="<?php echo base_url()?>assets/new/images/users/2.jpg" alt="user" class="circle">
                                                <span class="profile-status busy pull-right" data-status="busy"></span>
                                            </span>
                                            <span class="mail-contnet">
                                                <h5>Ray Hudson</h5>
                                                <span class="mail-desc">I've sung a song! See you at</span>
                                                <span class="time">9:10 AM</span>
                                            </span>
                                        </a>
                                        <!-- Message -->
                                        <a href="#" class="user-info" id='chat_user_11' data-user-id='11'>
                                            <span class="user-img">
                                                <img src="<?php echo base_url()?>assets/new/images/users/3.jpg" alt="user" class="circle">
                                                <span class="profile-status away pull-right" data-status="away"></span>
                                            </span>
                                            <span class="mail-contnet">
                                                <h5>Lb James</h5>
                                                <span class="mail-desc">I am a singer!</span>
                                                <span class="time">9:08 AM</span>
                                            </span>
                                        </a>
                                        <!-- Message -->
                                        <a href="#" class="user-info" id='chat_user_12' data-user-id='12'>
                                            <span class="user-img">
                                                <img src="<?php echo base_url()?>assets/new/images/users/4.jpg" alt="user" class="circle">
                                                <span class="profile-status offline pull-right" data-status="offline"></span>
                                            </span>
                                            <span class="mail-contnet">
                                                <h5>Don Andres</h5>
                                                <span class="mail-desc">Just see the my admin!</span>
                                                <span class="time">9:02 AM</span>
                                            </span>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <!-- Activity -->
                        <div id="activity" class="col s12">
                            <div class="m-t-10 p-10">
                                <h6 class="font-medium">Activity Timeline</h6>
                                <div class="steamline">
                                    <div class="sl-item">
                                        <div class="sl-left green"> <i class="ti-user"></i></div>
                                        <div class="sl-right">
                                            <div class="font-medium">Meeting today <span class="sl-date"> 5pm</span></div>
                                            <div class="desc">you can write anything </div>
                                        </div>
                                    </div>
                                    <div class="sl-item">
                                        <div class="sl-left blue"><i class="fa fa-image"></i></div>
                                        <div class="sl-right">
                                            <div class="font-medium">Send documents to Clark</div>
                                            <div class="desc">Lorem Ipsum is simply </div>
                                        </div>
                                    </div>
                                    <div class="sl-item">
                                        <div class="sl-left"> <img class="circle" alt="user" src="<?php echo base_url()?>assets/new/images/users/2.jpg"> </div>
                                        <div class="sl-right">
                                            <div class="font-medium">Go to the Doctor <span class="sl-date">5 minutes ago</span></div>
                                            <div class="desc">Contrary to popular belief</div>
                                        </div>
                                    </div>
                                    <div class="sl-item">
                                        <div class="sl-left"> <img class="circle" alt="user" src="<?php echo base_url()?>assets/new/images/users/1.jpg"> </div>
                                        <div class="sl-right">
                                            <div><a href="javascript:void(0)">Stephen</a> <span class="sl-date">5 minutes ago</span></div>
                                            <div class="desc">Approve meeting with tiger</div>
                                        </div>
                                    </div>
                                    <div class="sl-item">
                                        <div class="sl-left teal"> <i class="ti-user"></i></div>
                                        <div class="sl-right">
                                            <div class="font-medium">Meeting today <span class="sl-date"> 5pm</span></div>
                                            <div class="desc">you can write anything </div>
                                        </div>
                                    </div>
                                    <div class="sl-item">
                                        <div class="sl-left purple"><i class="fa fa-image"></i></div>
                                        <div class="sl-right">
                                            <div class="font-medium">Send documents to Clark</div>
                                            <div class="desc">Lorem Ipsum is simply </div>
                                        </div>
                                    </div>
                                    <div class="sl-item">
                                        <div class="sl-left"> <img class="circle" alt="user" src="<?php echo base_url()?>assets/new/images/users/4.jpg"> </div>
                                        <div class="sl-right">
                                            <div class="font-medium">Go to the Doctor <span class="sl-date">5 minutes ago</span></div>
                                            <div class="desc">Contrary to popular belief</div>
                                        </div>
                                    </div>
                                    <div class="sl-item">
                                        <div class="sl-left"> <img class="circle" alt="user" src="<?php echo base_url()?>assets/new/images/users/6.jpg"> </div>
                                        <div class="sl-right">
                                            <div><a href="javascript:void(0)">Stephen</a> <span class="sl-date">5 minutes ago</span></div>
                                            <div class="desc">Approve meeting with tiger</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </aside>
        <div class="chat-windows"></div>
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
    <script src="<?php echo base_url();?>assets/new/dist/js/app.init.dark.js"></script>
    <script src="<?php echo base_url();?>assets/new/dist/js/app-style-switcher.js"></script>
    <!-- ============================================================== -->
    <!-- Custom js -->
    <!-- ============================================================== -->
    <script src="<?php echo base_url();?>assets/new/dist/js/custom.min.js"></script>
    <!-- ============================================================== -->
    <!-- This page plugin js -->
    <!-- ============================================================== -->
    <!-- Footable -->
    <script src="<?php echo base_url()?>assets/new/libs/footable/dist/footable.all.min.js"></script>
    <script src="<?php echo base_url();?>assets/new/dist/js/pages/footable/footable-init.js"></script>

</body>

</html>
