<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
	<!-- sidebar -->
	<section class="sidebar">
		<!-- Sidebar user panel -->
		<div class="user-panel">
			<div class="ulogo">
				<a href="{{base_url()}}">
					<!-- logo for regular state and mobile devices -->
					<img src="{{base_url()}}asset/img/logo.png" alt="logo" class="dark-logo">
					<!-- <span><b>Social</b>Remit</span> -->
				</a>
			</div>
			<div class="image">
				<img src="{{base_url()}}asset/uploads/{{$userdata->avatar}}" class="rounded-circle" alt="User Image">
			</div>
			<div class="info">
				@if($is_accredited_investor == -1)
    				<p><a href="{{base_url()}}profile" class="btn btn-round btn-warning text-white">Investor type pending</a></p>
                @endif
				@if($is_accredited_investor == 0)
    				<p><a href="{{base_url()}}profile" class="btn btn-round btn-info text-white">Normal Investor</a></p>
                @endif
                @if($is_accredited_investor == 1)
    				<p><a href="{{base_url()}}profile" class="btn btn-round btn-success text-white">Accredited Investor</a></p>
                @endif
				<p>Welcome, {{empty($userdata->first_name) ? $userdata->username : $userdata->first_name.' '.$userdata->second_name}}!</p>
				<p>{{$userdata->country}}</p>
                @if($userdata->kyc_status == 0)
				    <p><a href="{{base_url()}}profile" class="btn btn-round btn-danger text-white">KYC not passed</a></p>
                @endif
                @if($userdata->kyc_status == 1)
    				<p><a href="{{base_url()}}profile" class="btn btn-round btn-info text-white">KYC pending</a></p>
                @endif
                @if($userdata->kyc_status == 2)
    				<p><a href="{{base_url()}}profile" class="btn btn-round btn-success text-white">KYC passed</a></p>
                @endif
				<a href="{{base_url()}}settings" class="link" data-toggle="tooltip" title="" data-original-title="Settings"><i class="ion ion-gear-b"></i></a>
				<a href="{{base_url()}}profile" class="link" data-toggle="tooltip" title="" data-original-title="Profile"><i class="mdi mdi-face"></i></a>
				<a href="{{base_url()}}logout" class="link" data-toggle="tooltip" title="" data-original-title="Logout"><i class="ion ion-power"></i></a>
			</div>
		</div>
		<!-- sidebar menu -->
		<ul class="sidebar-menu" data-widget="tree">
			<li class="nav-devider"></li>
			<!-- <li class="header nav-small-cap">GENERAL</li> -->

			<li @yield("sidebar_dashboard")>
				<a href="{{base_url()}}dashboard">
					<i class="fa fa-dashboard"></i> <span>Dashboard</span>
				</a>
			</li>

			<li class="treeview @yield('menu-ico')">
				<a href="#">
					<i class="icon-compass"></i>
					<span>Initial Coin Offering</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-right pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu" style="@yield('dropdown-ico')">
					<li class="@yield('ico-purchase')"><a href="{{base_url()}}ico-purchase">Purchase</a></li>
					<li class="@yield('ico-transaction')"><a href="{{base_url()}}ico-transaction">Transaction</a></li>
				</ul>
			</li>

			<li class="treeview @yield('menu-airdrop')">
				<a href="#">
					<i class="mdi mdi-trophy"></i>
					<span>Airdrop</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-right pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu" style="@yield('dropdown-airdrop')">
                    <li class="@yield('airdrop-status')"><a href="{{base_url()}}airdrop-status">Status</a></li>
                @if(!$userdata->mlm_flag)
                    <!--<li class="@yield('airdrop-campaign')"><a href="{{base_url()}}airdrop-campaign">Campaign</a></li>
                    <li class="@yield('airdrop-submission')"><a href="{{base_url()}}airdrop-submission">Submission</a></li>-->
                @endif
					<li class="@yield('referral')"><a href="{{base_url()}}referral">Referral</a></li>
					<li class="@yield('airdrop-transaction')"><a href="{{base_url()}}airdrop-transaction">Transaction</a></li>
				</ul>
            </li>
            
            <li class="@yield('sidebar_profile')">
				<a href="{{base_url()}}profile">
					<i class="mdi mdi-face"></i> <span>Profile</span>
				</a>
			</li>

			<li class="@yield('settings')">
				<a href="{{base_url()}}settings">
					<i class="ion ion-settings"></i> <span>Settings</span>
				</a>
			</li>

			<!-- <li class="nav-devider"></li>
        <li class="header nav-small-cap">PERSONAL</li> -->
            <li class="nav-devider"></li>

		</ul>
	</section>
</aside>
