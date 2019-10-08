<!DOCTYPE html>
<html lang="en">

<head>
<script>
var geotargetlyblock1536603564300 = document.createElement('script');
geotargetlyblock1536603564300.setAttribute('type','text/javascript');
geotargetlyblock1536603564300.async = 1;
geotargetlyblock1536603564300.setAttribute('src', '//geotargetly-1a441.appspot.com/geoblock?id=-LM3hPU4K4JO4TjRm6SM');
document.getElementsByTagName('head')[0].appendChild(geotargetlyblock1536603564300);
</script>

   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
   <meta name="description" content="Bootstrap Admin App + jQuery">
   <meta name="keywords" content="app, responsive, jquery, bootstrap, dashboard, admin">
   <title>SocialRemit - Admin</title>
   <link rel="shortcut icon" href="<?=base_url()?>asset/img/logo-single.png" type="image/png">
   <!-- =============== VENDOR STYLES ===============-->
   <!-- FONT AWESOME-->
   <link rel="stylesheet" href="<?=base_url()?>asset/vendor/font-awesome/css/font-awesome.css">
   <!-- SIMPLE LINE ICONS-->
   <link rel="stylesheet" href="<?=base_url()?>asset/vendor/simple-line-icons/css/simple-line-icons.css">
   <!-- ANIMATE.CSS-->
   <link rel="stylesheet" href="<?=base_url()?>asset/vendor/animate.css/animate.css">
   <!-- WHIRL (spinners)-->
   <link rel="stylesheet" href="<?=base_url()?>asset/vendor/whirl/dist/whirl.css">
   <!-- =============== PAGE VENDOR STYLES ===============-->
   <!-- =============== BOOTSTRAP STYLES ===============-->
   <link rel="stylesheet" href="<?=base_url()?>asset/css/bootstrap.css" id="bscss">
   <!-- =============== APP STYLES ===============-->
   <link rel="stylesheet" href="<?=base_url()?>asset/css/app.css" id="maincss">
   <link rel="stylesheet" href="<?=base_url()?>asset/css/custom1.css" id="customcss1">
   <link rel="stylesheet" href="<?=base_url()?>asset/css/custom2.css" id="customcss2">
   <link rel="stylesheet" href="<?=base_url()?>asset/css/theme-g.css">

   
   <!-- =============== VENDOR SCRIPTS ===============-->
   <!-- MODERNIZR-->
   <script src="<?=base_url()?>asset/vendor/modernizr/modernizr.custom.js"></script>
   <!-- JQUERY-->
   <script src="<?=base_url()?>asset/vendor/jquery/dist/jquery.js"></script>
   <!-- BOOTSTRAP-->
   <script src="<?=base_url()?>asset/vendor/popper.js/dist/umd/popper.js"></script>
   <script src="<?=base_url()?>asset/vendor/bootstrap/dist/js/bootstrap.js"></script>
   <!-- STORAGE API-->
   <script src="<?=base_url()?>asset/vendor/js-storage/js.storage.js"></script>
   <!-- JQUERY EASING-->
   <script src="<?=base_url()?>asset/vendor/jquery.easing/jquery.easing.js"></script>
   <!-- ANIMO-->
   <script src="<?=base_url()?>asset/vendor/animo/animo.js"></script>
   <!-- SCREENFULL-->
   <script src="<?=base_url()?>asset/vendor/screenfull/dist/screenfull.js"></script>
   <!-- LOCALIZE-->
   <script src="<?=base_url()?>asset/vendor/jquery-localize/dist/jquery.localize.js"></script>
   <!-- =============== PAGE VENDOR SCRIPTS ===============-->
   
</head>

<body>
   <div class="wrapper">
      <!-- top navbar-->
      <header class="topnavbar-wrapper">
         <!-- START Top Navbar-->
         <nav class="navbar topnavbar">
            <!-- START navbar header-->
            <div class="navbar-header">
               <a class="navbar-brand" href="#/">
                  <div class="brand-logo">
                     <img class="img-fluid" src="<?=base_url()?>asset/img/logo-white.png" alt="App Logo">
                  </div>
                  <div class="brand-logo-collapsed">
                     <img class="img-fluid" src="<?=base_url()?>asset/img/logo-single.png" alt="App Logo">
                  </div>
               </a>
            </div>
            <!-- END navbar header-->
            <!-- START Left navbar-->
            <ul class="navbar-nav mr-auto flex-row">
               <li class="nav-item">
                  <!-- Button used to collapse the left sidebar. Only visible on tablet and desktops-->
                  <a class="nav-link d-none d-md-block d-lg-block d-xl-block" href="#" data-trigger-resize="" data-toggle-state="aside-collapsed">
                     <em class="fa fa-navicon"></em>
                  </a>
                  <!-- Button to show/hide the sidebar on mobile. Visible on mobile only.-->
                  <a class="nav-link sidebar-toggle d-md-none" href="#" data-toggle-state="aside-toggled" data-no-persist="true">
                     <em class="fa fa-navicon"></em>
                  </a>
               </li>
               <!-- START User avatar toggle-->
               <li class="nav-item d-none d-md-block">
                  <!-- Button used to collapse the left sidebar. Only visible on tablet and desktops-->
                  <a class="nav-link" id="user-block-toggle" href="#user-block" data-toggle="collapse">
                     <em class="icon-user"></em>
                  </a>
               </li>
               <!-- END User avatar toggle-->
            </ul>
            <!-- END Left navbar-->
            <!-- START Right Navbar-->
            <ul class="navbar-nav flex-row">
               <!-- Fullscreen (only desktops)-->
               <li class="nav-item d-none d-md-block">
                  <a class="nav-link" href="#" data-toggle-fullscreen="">
                     <em class="fa fa-expand"></em>
                  </a>
               </li>
               <!-- START Offsidebar button-->
               <li class="nav-item">
                  <a class="nav-link" href="#" data-toggle-state="offsidebar-open" data-no-persist="true">
                     <em class="icon-notebook"></em>
                  </a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="<?=base_url()?>admin/login/logout">
                     <em class="icon-logout"></em>
                  </a>
               </li>
               
               <!-- END Offsidebar menu-->
            </ul>
            <!-- END Right Navbar-->
            <!-- START Search form-->
            <form class="navbar-form" role="search" action="search.html">
               <div class="form-group">
                  <input class="form-control" type="text" placeholder="Type and hit enter ...">
                  <div class="fa fa-times navbar-form-close" data-search-dismiss=""></div>
               </div>
               <button class="d-none" type="submit">Submit</button>
            </form>
            <!-- END Search form-->
         </nav>
         <!-- END Top Navbar-->
      </header>
      <!-- sidebar-->
      <aside class="aside-container">
         <!-- START Sidebar (left)-->
         <div class="aside-inner">
            <nav class="sidebar" data-sidebar-anyclick-close="">
               <!-- START sidebar nav-->
               <ul class="sidebar-nav">
                  <!-- START user info-->
                  <li class="has-user-block">
                     <div class="collapse" id="user-block">
                        <div class="item user-block">
                           <!-- User picture-->
                           <div class="user-block-picture">
                              <div class="user-block-status">
                              </div>
                           </div>
                           <!-- Name and Job-->
                           <div class="user-block-info">
                              <span class="user-block-name">Hello!</span>
                              <span class="user-block-role"><?=$this->session->userdata("admin")->username?></span>
                           </div>
                        </div>
                     </div>
                  </li>
                  <!-- END user info-->
                  <!-- Iterates over all sidebar items-->
                  <li class="nav-heading ">
                     <span data-localize="sidebar.heading.HEADER">Airdrop</span>
                  </li>
                  <?php if(hasPermissionInArray(['sys_admin', 'validation_team', 'customer_manager'], $this->userData)){ ?>
                  <li class=" ">
                     <a href="<?=base_url()?>admin/airdrop/index" title="Airdrop Submits">
                        <em class="icon-grid"></em>
                        <span data-localize="sidebar.nav.SUBMITS">Submits</span>
                     </a>
                  </li>
                  <?php } ?>

                  <?php if(hasPermissionInArray(['sys_admin', 'economic_team', 'customer_manager'], $this->userData)){ ?>
                  <li class=" ">
                     <a href="<?=base_url()?>admin/airdrop/payment" title="Airdrop Payment">
                        <em class="fa fa-money"></em>
                        <span data-localize="sidebar.nav.PAYMENT">Payment</span>
                     </a>
                  </li>
                  <?php } ?>

                  <?php if(hasPermissionInArray(['sys_admin', 'economic_team', 'customer_manager'], $this->userData)){ ?>
                  <li class=" ">
                     <a href="<?=base_url()?>admin/airdrop/transaction" title="Airdrop Transaction">
                        <em class="fa fa-bank"></em>
                        <span data-localize="sidebar.nav.TRANSACTION">Airdrop Transaction</span>
                     </a>
				  </li>
                  <?php } ?>

                  <li class="nav-heading ">
                     <span data-localize="sidebar.heading.HEADER">ICO</span>
                  </li>
                  <?php if(hasPermissionInArray(['sys_admin', 'economic_team', 'customer_manager'], $this->userData)){ ?>
                  <li class=" ">
                     <a href="<?=base_url()?>admin/ICO/transaction_page" title="ICO Transaction">
                        <em class="fa fa-bank"></em>
                        <span data-localize="sidebar.nav.TRANSACTION">ICO Transaction</span>
                     </a>
				  </li>
                  <?php } ?>

                  <?php if(hasPermissionInArray(['sys_admin', 'validation_team', 'customer_manager'], $this->userData)){ ?>
                  <li class="nav-heading ">
                     <span data-localize="sidebar.heading.HEADER">Multi Level Marketing</span>
                  </li>

                  <li class=" ">
                     <a href="<?=base_url()?>admin/MLM/getReportByCountryPage" title="MLM">
                        <em class="fa fa-bank"></em>
                        <span data-localize="sidebar.nav.TRANSACTION">MLM Report</span>
                     </a>
				  </li>
                  <?php } ?>
                  
                  <?php if(hasPermissionInArray(['sys_admin', 'validation_team', 'customer_manager'], $this->userData)){  ?>

                  <li class="nav-heading ">
                     <span data-localize="sidebar.heading.HEADER">User Management</span>
                  </li>
                  <li class=" ">
                     <a href="<?=base_url()?>admin/user/customers" title="Customer Management">
                        <em class="icon-people"></em>
                        <span data-localize="sidebar.nav.USERMANAGEMENT">Customers</span>
                     </a>
                  </li>
                  <?php } ?>
                  
                  <?php if(hasPermissionInArray(['sys_admin'], $this->userData)){  ?>
                    <li class=" ">
                      <a href="<?=base_url()?>admin/LoginFailure/index" title="Login Failures">
                        <em class="icon-people"></em>
                        <span data-localize="sidebar.nav.USERMANAGEMENT">Login Failures</span>
                      </a>
                    </li>
                  <?php } ?>

                  <?php if(hasPermissionInArray(['sys_admin'], $this->userData)){  ?>
                  <li class="nav-heading ">
                     <span data-localize="sidebar.heading.HEADER">Settings</span>
                  </li>
                  <li class=" ">
                     <a href="<?=base_url()?>admin/airdrop/settings_page" title="Settings">
					 	<em class="fa fa-gear"></em>
                        <span data-localize="sidebar.nav.SETTINGS">Settings</span>
                     </a>
                  </li>
                  <?php } ?>

                  <?php if(hasPermissionInArray(['sys_admin'], $this->userData)){  ?>
                  <li class=" ">
                     <a href="<?=base_url()?>admin/user/admins" title="Admins Management">
                        <em class="icon-people"></em>
                        <span data-localize="sidebar.nav.USERMANAGEMENT">Administrators</span>
                     </a>
				  </li>
                  <?php } ?>
                  
                  <?php if(hasPermissionInArray(['sys_admin'], $this->userData)){  ?>
				  <li class=" ">
                     <a href="<?=base_url()?>admin/user/profile" title="Change Password">
					 	<em class="icon-screen-desktop"></em>
                        <span data-localize="sidebar.nav.USERPROFILE">Change Password</span>
                     </a>
                  </li>
                  <?php } ?>
               </ul>
               <!-- END sidebar nav-->
            </nav>
         </div>
         <!-- END Sidebar (left)-->
      </aside>
      <!-- offsidebar-->
      <aside class="offsidebar d-none">
         <!-- START Off Sidebar (right)-->
        <h3 class="text-center text-thin mt-4">Settings</h3>
        <div class="p-2">
            <h4 class="text-muted text-thin">Themes</h4>
            <div class="row row-flush mb-2">
                <div class="col mb-2">
                    <div class="setting-color">
                        <label data-load-css="<?=base_url()?>asset/css/theme-a.css">
                        <input type="radio" name="setting-theme" checked="checked">
                        <span class="icon-check"></span>
                        <span class="split">
                            <span class="color bg-info"></span>
                            <span class="color bg-info-light"></span>
                        </span>
                        <span class="color bg-white"></span>
                        </label>
                    </div>
                </div>
                <div class="col mb-2">
                    <div class="setting-color">
                        <label data-load-css="<?=base_url()?>asset/css/theme-b.css">
                        <input type="radio" name="setting-theme">
                        <span class="icon-check"></span>
                        <span class="split">
                            <span class="color bg-green"></span>
                            <span class="color bg-green-light"></span>
                        </span>
                        <span class="color bg-white"></span>
                        </label>
                    </div>
                </div>
                <div class="col mb-2">
                    <div class="setting-color">
                        <label data-load-css="<?=base_url()?>asset/css/theme-c.css">
                        <input type="radio" name="setting-theme">
                        <span class="icon-check"></span>
                        <span class="split">
                            <span class="color bg-purple"></span>
                            <span class="color bg-purple-light"></span>
                        </span>
                        <span class="color bg-white"></span>
                        </label>
                    </div>
                </div>
                <div class="col mb-2">
                    <div class="setting-color">
                        <label data-load-css="<?=base_url()?>asset/css/theme-d.css">
                        <input type="radio" name="setting-theme">
                        <span class="icon-check"></span>
                        <span class="split">
                            <span class="color bg-danger"></span>
                            <span class="color bg-danger-light"></span>
                        </span>
                        <span class="color bg-white"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="row row-flush mb-2">
                <div class="col mb-2">
                    <div class="setting-color">
                        <label data-load-css="<?=base_url()?>asset/css/theme-e.css">
                        <input type="radio" name="setting-theme">
                        <span class="icon-check"></span>
                        <span class="split">
                            <span class="color bg-info-dark"></span>
                            <span class="color bg-info"></span>
                        </span>
                        <span class="color bg-gray-dark"></span>
                        </label>
                    </div>
                </div>
                <div class="col mb-2">
                    <div class="setting-color">
                        <label data-load-css="<?=base_url()?>asset/css/theme-f.css">
                        <input type="radio" name="setting-theme">
                        <span class="icon-check"></span>
                        <span class="split">
                            <span class="color bg-green-dark"></span>
                            <span class="color bg-green"></span>
                        </span>
                        <span class="color bg-gray-dark"></span>
                        </label>
                    </div>
                </div>
                <div class="col mb-2">
                    <div class="setting-color">
                        <label data-load-css="<?=base_url()?>asset/css/theme-g.css">
                        <input type="radio" name="setting-theme">
                        <span class="icon-check"></span>
                        <span class="split">
                            <span class="color bg-purple-dark"></span>
                            <span class="color bg-purple"></span>
                        </span>
                        <span class="color bg-gray-dark"></span>
                        </label>
                    </div>
                </div>
                <div class="col mb-2">
                    <div class="setting-color">
                        <label data-load-css="<?=base_url()?>asset/css/theme-h.css">
                        <input type="radio" name="setting-theme">
                        <span class="icon-check"></span>
                        <span class="split">
                            <span class="color bg-danger-dark"></span>
                            <span class="color bg-danger"></span>
                        </span>
                        <span class="color bg-gray-dark"></span>
                        </label>
                    </div>
                </div>
            </div>
            </div>
            <div class="p-2">
            <h4 class="text-muted text-thin">Layout</h4>
            <div class="clearfix">
                <p class="float-left">Fixed</p>
                <div class="float-right">
                    <label class="switch">
                        <input id="chk-fixed" type="checkbox" data-toggle-state="layout-fixed">
                        <span></span>
                    </label>
                </div>
            </div>
            <div class="clearfix">
                <p class="float-left">Boxed</p>
                <div class="float-right">
                    <label class="switch">
                        <input id="chk-boxed" type="checkbox" data-toggle-state="layout-boxed">
                        <span></span>
                    </label>
                </div>
            </div>
            <div class="clearfix">
                <p class="float-left">RTL</p>
                <div class="float-right">
                    <label class="switch">
                        <input id="chk-rtl" type="checkbox">
                        <span></span>
                    </label>
                </div>
            </div>
            </div>
            <div class="p-2">
            <h4 class="text-muted text-thin">Aside</h4>
            <div class="clearfix">
                <p class="float-left">Collapsed</p>
                <div class="float-right">
                    <label class="switch">
                        <input id="chk-collapsed" type="checkbox" data-toggle-state="aside-collapsed">
                        <span></span>
                    </label>
                </div>
            </div>
            <div class="clearfix">
                <p class="float-left">Collapsed Text</p>
                <div class="float-right">
                    <label class="switch">
                        <input id="chk-collapsed-text" type="checkbox" data-toggle-state="aside-collapsed-text">
                        <span></span>
                    </label>
                </div>
            </div>
            <div class="clearfix">
                <p class="float-left">Float</p>
                <div class="float-right">
                    <label class="switch">
                        <input id="chk-float" type="checkbox" data-toggle-state="aside-float">
                        <span></span>
                    </label>
                </div>
            </div>
            <div class="clearfix">
                <p class="float-left">Hover</p>
                <div class="float-right">
                    <label class="switch">
                        <input id="chk-hover" type="checkbox" data-toggle-state="aside-hover">
                        <span></span>
                    </label>
                </div>
            </div>
            <div class="clearfix">
                <p class="float-left">Show Scrollbar</p>
                <div class="float-right">
                    <label class="switch">
                        <input id="chk-scroll" type="checkbox" data-toggle-state="show-scrollbar" data-target=".sidebar">
                        <span></span>
                    </label>
                </div>
            </div>
        </div>
         <!-- END Off Sidebar (right)-->
      </aside>
      <!-- Main section-->
      <section class="section-container">
