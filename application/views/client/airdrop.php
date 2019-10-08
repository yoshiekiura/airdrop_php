<?php $this->load->view('client/layout/header'); ?>


<!-- Page content-->
<div class="content-wrapper">
    <div class="content-heading">
        <div>Dashboard
            <small>Review your information</small>
        </div>
	</div>
	<div class="background">
		<!-- START row-->
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<h3 class="mt-0">You're ranked #<?=$rank + 1?> with <label class="m-0 text-primary"><?=$totalScore?> CSRs</label></h3>
						<p class="text-muted">Complete the actions, get more CSRs, and WIN rewards.</p>
						<div class="progress progress-xs mb-3">
							<div class="progress-bar" role="progressbar" style="width: <?=100 - ($rank / ($total) * 100)?>%;">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- START row-->
		<div class="row">
			<div class="col-md-6">
				<div class="row">
					<div class="col-md-12">
						<!-- START card-->
						<div class="card">
							<div class="card-header refer">Guide to win CSR</div>
							<div class="card-body">
								<h4 class="card-title">1. Share your social network IDs in the <a href="/profile">Profile</a> page.</h4>
								<h4 class="card-title">2. Complete various tasks in the <a href="/campaign">Campaign</a> page.</h4>
								<h4 class="card-title">3. Submit the details.</h4>
								<h4 class="card-title">4. You will receive reward after we review your submission.</h4>
							</div>
						</div>
						<!-- END card-->
					</div>
					<div class="col-md-12">
						<!-- START card-->
						<div class="card">
							<div class="card-header refer">Refer others (<label class="m-0">+20</label>)</div>
							<div class="card-body">
								<h5 class="card-title">Share your special URL to track referrals.</h5>
								<div class="form-group">
									<div class="input-group mb-4">
										<input class="form-control input-class" type="text" placeholder="Referral URL" aria-label="Referral URL" aria-describedby="basic-addon2" value="<?=base_url()."ref/".$user_id?>" readonly>
										<div class="input-group-append">
											<button class="btn page-link btn-copy" type="button">
												<span class="mr-2" aria-hidden="true">
													<em class="icon-link"></em>
												</span>
												Copy Link
											</button>
										</div>
									</div>
									<div class="row">
										<div class="btn-group ml-auto mr-auto">
											<a href="https://twitter.com">
											<button class="mb-1 btn btn-lg special" type="button">
												<em class="icon-social-twitter"></em>
											</button></a>
											<a href="https://facebook.com/">
											<button class="mb-1 btn btn-lg special" type="button">
												<em class="icon-social-facebook"></em>
											</button></a>
											<a href="https://youtube.com">
											<button class="mb-1 btn btn-lg special" type="button">
												<em class="icon-social-youtube"></em>
											</button></a>
											<a href="https://linkedin.com/">
											<button class="mb-1 btn btn-lg special" type="button">
												<em class="icon-social-linkedin"></em>
											</button></a>
											<a href="https://www.pinterest.com/">
											<button class="mb-1 btn btn-lg special" type="button">
												<em class="icon-social-pinterest"></em>
											</button></a>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- END card-->
					</div>
					<div class="col-md-12">
						<!-- START card-->
						<div class="card">
							<div class="card-header">Airdrop ends in</div>
							<div class="card-body">
								<div id="counter" class="counter flex text-center">
									<div class="counter-wrapper">
										<div class="counter-block">30</div>
										<span class="counter-tag">DAYS</span>
									</div>
									<div class="counter-wrapper">
										<div class="counter-block">--</div>
										<span class="counter-tag">HOURS</span>
									</div>
									<div class="counter-wrapper">
										<div class="counter-block">--</div>
										<span class="counter-tag">MINUTES</span>
									</div>
									<div class="counter-wrapper">
										<div class="counter-block">--</div>
										<span class="counter-tag">SECONDS</span>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-12">
						<!-- START card-->
						<div class="card">
							<div class="card-header">Remaining CSR</div>
							<div class="card-body text-center">
								<h1>
									<?=$this->ConfigModal->getValueWithKey("remaining_token_count")?>
								</h1>
							</div>
						</div>
					</div>


				</div>
			</div>
			<div class="col-md-6">
				<!-- START card-->
				<div class="card">
					<div class="card-header">Ranking</div>
					<div class="card-body">
						<div class="list-group">
						<?php
							foreach($list as $k => $item) { 
								$list [$k]->rank = $tempRank + $k + 1;
								if ($k != 0 && $list [$k]->total_score == $list [$k - 1]->total_score) {
									$list [$k]->rank = $list [$k - 1]->rank;
								}
								?>
							<div class="list-group-item list-group-item-action border-0 <?=$item->user_id == $user_id ? "bg-gray" : "" ?>">
								<div class="media">
									<img class="align-self-center mr-3 rounded-circle thumb48" src="<?=base_url()?>asset/uploads/<?=$item->avatar?>" alt="Image">
									
									<div class="mt-auto mb-auto">
										<h4 class="mb-0">#<?=$list [$k]->rank?></h4>
									</div>
									<div class="media-body text-truncate mt-auto mb-auto ml-2">
										<h4 class="mb-0"><strong><?=$item->username?></strong></h4>
									</div>
									<div class="mt-auto mb-auto">
										<strong><?=$item->total_score?> CSRs</strong>
									</div>
								</div>
							</div>
							<?php }?>
						</div>
					</div>
				</div>
				<!-- END card-->
			</div>
		</div>
		<!-- END row-->
	</div>
</div>


<?php $this->load->view('client/layout/footer'); ?>

<script src="<?=base_url();?>asset/js/jquery.countdown.min.js"></script>
<script>
(function(window, document, $, undefined) {
    $(function() {
        $(".btn-copy").click(function() {
            const el = document.createElement('textarea');
            el.value = "<?=base_url()."ref/".$user_id?>";
            document.body.appendChild(el);
            el.select();
            document.execCommand('copy');
            document.body.removeChild(el);
        });
        $('#counter').countdown('2018/10/15', function(event) {
            $(this).html(event.strftime('<div class="counter-wrapper"><div class="counter-block">%D</div><span class="counter-tag">DAYS</span></div><div class="counter-wrapper"><div class="counter-block">%H</div><span class="counter-tag">HOURS</span></div><div class="counter-wrapper"><div class="counter-block">%M</div><span class="counter-tag">MINUTES</span></div><div class="counter-wrapper"><div class="counter-block">%S</div><span class="counter-tag">SECONDS</span></div>'));
        });
    });
})(window, document, window.jQuery);
</script>
