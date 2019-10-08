<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
	<!-- sidebar -->
	<section class="sidebar">
		<!-- Sidebar user panel -->
		<div class="user-panel">
			<div class="ulogo">
				<a href="<?php echo e(base_url()); ?>">
					<!-- logo for regular state and mobile devices -->
					<img src="<?php echo e(base_url()); ?>asset/img/logo.png" alt="logo" class="dark-logo">
					<!-- <span><b>Social</b>Remit</span> -->
				</a>
			</div>
			<div class="image">
				<img src="<?php echo e(base_url()); ?>asset/uploads/<?php echo e($userdata->avatar); ?>" class="rounded-circle" alt="User Image">
			</div>
			<div class="info">
				<?php if($is_accredited_investor == -1): ?>
    				<p><a href="<?php echo e(base_url()); ?>profile" class="btn btn-round btn-warning text-white">Investor type pending</a></p>
                <?php endif; ?>
				<?php if($is_accredited_investor == 0): ?>
    				<p><a href="<?php echo e(base_url()); ?>profile" class="btn btn-round btn-info text-white">Normal Investor</a></p>
                <?php endif; ?>
                <?php if($is_accredited_investor == 1): ?>
    				<p><a href="<?php echo e(base_url()); ?>profile" class="btn btn-round btn-success text-white">Accredited Investor</a></p>
                <?php endif; ?>
				<p>Welcome, <?php echo e(empty($userdata->first_name) ? $userdata->username : $userdata->first_name.' '.$userdata->second_name); ?>!</p>
				<p><?php echo e($userdata->country); ?></p>
                <?php if($userdata->kyc_status == 0): ?>
				    <p><a href="<?php echo e(base_url()); ?>profile" class="btn btn-round btn-danger text-white">KYC not passed</a></p>
                <?php endif; ?>
                <?php if($userdata->kyc_status == 1): ?>
    				<p><a href="<?php echo e(base_url()); ?>profile" class="btn btn-round btn-info text-white">KYC pending</a></p>
                <?php endif; ?>
                <?php if($userdata->kyc_status == 2): ?>
    				<p><a href="<?php echo e(base_url()); ?>profile" class="btn btn-round btn-success text-white">KYC passed</a></p>
                <?php endif; ?>
				<a href="<?php echo e(base_url()); ?>settings" class="link" data-toggle="tooltip" title="" data-original-title="Settings"><i class="ion ion-gear-b"></i></a>
				<a href="<?php echo e(base_url()); ?>profile" class="link" data-toggle="tooltip" title="" data-original-title="Profile"><i class="mdi mdi-face"></i></a>
				<a href="<?php echo e(base_url()); ?>logout" class="link" data-toggle="tooltip" title="" data-original-title="Logout"><i class="ion ion-power"></i></a>
			</div>
		</div>
		<!-- sidebar menu -->
		<ul class="sidebar-menu" data-widget="tree">
			<li class="nav-devider"></li>
			<!-- <li class="header nav-small-cap">GENERAL</li> -->

			<li <?php echo $__env->yieldContent("sidebar_dashboard"); ?>>
				<a href="<?php echo e(base_url()); ?>dashboard">
					<i class="fa fa-dashboard"></i> <span>Dashboard</span>
				</a>
			</li>

			<li class="treeview <?php echo $__env->yieldContent('menu-ico'); ?>">
				<a href="#">
					<i class="icon-compass"></i>
					<span>Initial Coin Offering</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-right pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu" style="<?php echo $__env->yieldContent('dropdown-ico'); ?>">
					<li class="<?php echo $__env->yieldContent('ico-purchase'); ?>"><a href="<?php echo e(base_url()); ?>ico-purchase">Purchase</a></li>
					<li class="<?php echo $__env->yieldContent('ico-transaction'); ?>"><a href="<?php echo e(base_url()); ?>ico-transaction">Transaction</a></li>
				</ul>
			</li>

			<li class="treeview <?php echo $__env->yieldContent('menu-airdrop'); ?>">
				<a href="#">
					<i class="mdi mdi-trophy"></i>
					<span>Airdrop</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-right pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu" style="<?php echo $__env->yieldContent('dropdown-airdrop'); ?>">
                    <li class="<?php echo $__env->yieldContent('airdrop-status'); ?>"><a href="<?php echo e(base_url()); ?>airdrop-status">Status</a></li>
                <?php if(!$userdata->mlm_flag): ?>
                    <!--<li class="<?php echo $__env->yieldContent('airdrop-campaign'); ?>"><a href="<?php echo e(base_url()); ?>airdrop-campaign">Campaign</a></li>
                    <li class="<?php echo $__env->yieldContent('airdrop-submission'); ?>"><a href="<?php echo e(base_url()); ?>airdrop-submission">Submission</a></li>-->
                <?php endif; ?>
					<li class="<?php echo $__env->yieldContent('referral'); ?>"><a href="<?php echo e(base_url()); ?>referral">Referral</a></li>
					<li class="<?php echo $__env->yieldContent('airdrop-transaction'); ?>"><a href="<?php echo e(base_url()); ?>airdrop-transaction">Transaction</a></li>
				</ul>
            </li>
            
            <li class="<?php echo $__env->yieldContent('sidebar_profile'); ?>">
				<a href="<?php echo e(base_url()); ?>profile">
					<i class="mdi mdi-face"></i> <span>Profile</span>
				</a>
			</li>

			<li class="<?php echo $__env->yieldContent('settings'); ?>">
				<a href="<?php echo e(base_url()); ?>settings">
					<i class="ion ion-settings"></i> <span>Settings</span>
				</a>
			</li>

			<!-- <li class="nav-devider"></li>
        <li class="header nav-small-cap">PERSONAL</li> -->
            <li class="nav-devider"></li>

		</ul>
	</section>
</aside>
