<header class="main-header">
	<!-- Logo -->
	<a href="<?php echo e(base_url()); ?>index" class="logo">
		<!-- mini logo for sidebar mini 50x50 pixels -->
		<!-- <b class="logo-mini">
		  <span class="light-logo"><img src="../images/new/logo-single.png" alt="logo"></span>
		  <span class="dark-logo"><img src="../images/new/logo-single.png" alt="logo"></span>
	  </b> -->
		<!-- logo for regular state and mobile devices -->
		<span class="logo-lg">
			<img src="<?php echo e(base_url()); ?>asset/img/logo-white.png" alt="logo" class="light-logo">
			<img src="<?php echo e(base_url()); ?>asset/img/logo.png" alt="logo" class="dark-logo">
		</span>
	</a>
	<!-- Header Navbar -->
	<nav class="navbar navbar-static-top">
		<!-- Sidebar toggle button-->
		<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
			<span class="sr-only">Toggle navigation</span>
		</a>

        <h4 class="text-white text-lg" id="header_date_section">
            <span>PRE-STO: <strong>Started</strong></span> |
            <span>STO START: <strong>04/15/2019</strong></span> | 
            <span>STO FINAL: <strong>05/31/2019</strong></span> | 
            <span>Final Date of Airdrop: <strong>05/06/2019</strong></span>
        </h4>
		<div class="navbar-custom-menu">
			<ul class="nav navbar-nav">
				<!-- User Account -->
				<li class="dropdown user user-menu">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-cog fa-spin"></i>
					</a>
					<ul class="dropdown-menu scale-up">
						<!-- User image -->
						<li class="user-header">
							<img src="<?php echo e(base_url()); ?>asset/uploads/<?php echo e($userdata->avatar); ?>" class="float-left rounded-circle" alt="User Image">

							<p>
                            <?php echo e(empty($userdata->first_name) ? $userdata->username : $userdata->first_name.' '.$userdata->second_name); ?>

								<small class="mb-5"><?php echo e($userdata->email); ?></small>
								<a href="<?php echo e(base_url()); ?>ico-purchase" class="btn btn-danger btn-sm btn-rounded">Buy Tokens</a>
							</p>
						</li> 
						<!-- Menu Body -->
						<li class="user-body">
							<div class="row no-gutters">
								<div class="col-12 text-left">
									<a href="<?php echo e(base_url()); ?>profile"><i class="mdi mdi-face"></i> My Profile</a>
								</div>
								<div class="col-12 text-left">
									<a href="<?php echo e(base_url()); ?>settings"><i class="ion ion-settings"></i> Account Settings</a>
								</div>
								<div class="col-12 text-left">
									<a href="<?php echo e(base_url()); ?>logout"><i class="fa fa-power-off"></i> Logout</a>
								</div>
							</div>
							<!-- /.row -->
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</nav>
</header>
