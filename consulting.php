<?php require_once 'header2.php'; ?>

<button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fa fa-angle-up"></i>

</button>

	<div id="cons" class="about white-title" style="margin-top: 50px;font-size: 40px;">
		<span><?= $t['consult_title'] ?></span>
		<div class="flex about-section">
			<div class="about-text-section">
				<table class="about-table">
					<tr>
						<td colspan="2" class="about-sr wow fadeInUp d020" style="font-size:28px;"><?php echo $t['consult_txt_1'] ?></td>
	                </tr>
					<tr>
						<td class="about-text wow fadeInUp d030">
							<ul>
								<li><?= $t['consult_svc_1'] ?></li>
								<li><?= $t['consult_svc_2'] ?></li>
								<li><?= $t['consult_svc_3'] ?></li>
								<li><?= $t['consult_svc_4'] ?></li>
								<li><?= $t['consult_svc_5'] ?></li>
								<li><?= $t['consult_svc_6'] ?></li>
							</ul>
						</td>
						<td class="about-text wow fadeInUp d040">
							<ul>
								<li><?= $t['consult_svc_7'] ?></li>
								<li><?= $t['consult_svc_8'] ?></li>
								<li><?= $t['consult_svc_9'] ?></li>
								<li><?= $t['consult_svc_10'] ?></li>
								<li><?= $t['consult_svc_11'] ?></li>
								<li><?= $t['consult_svc_12'] ?></li>
							</ul>
	            		</td>
					</tr>
				</table>
			</div>
	        <div class="video-about">
	            <div class="video-box" style="border:none;box-shadow: none">
	                <!--<img src="imgs/ico_1.jpg">-->
	                <img src="imgs/bitcoin.png" class="wow fadeInUp d075" style="max-height: 300px; max-width: auto;">
	            </div>
			</div>
		</div>
	</div>

	<div id="dev" class="stockwise flex column black-title" style="font-size: 40px;">
		<span class="wow fadeInUp d001"><?= $t['dev'] ?></span>
		<div class="stockwise-text flex column">
			<span class="stockwise-subtitle wow fadeInUp d020" style="font-size:28px;"><?= $t['dev_tit'] ?></span>
		</div>
		<div class="stockwise-content flex" style="text-align: left;">
			<ul>
				<span class="choose-tag"><li><?php echo $t['dev_l1']?></li></span>
				<span class="choose-tag"><li><?php echo $t['dev_l2']?></li></span>
				<span class="choose-tag"><li><?php echo $t['dev_l3']?></li></span>
				<span class="choose-tag"><li><?php echo $t['dev_l4']?></li></span>
				<span class="choose-tag"><li><?php echo $t['dev_l5']?></li></span>
				<span class="choose-tag"><li><?php echo $t['dev_l6']?></li></span>
				<span class="choose-tag"><li><?php echo $t['dev_l7']?></li></span>
				<span class="choose-tag"><li><?php echo $t['dev_l8']?></li></span>

			</ul>
			<img src="imgs/dev.png" class="stockwise-img wow fadeInUp d030" style="max-height: 300px; max-width: auto;">
		</div>
	</div>

	<div id="mkt" class="about white-title" style="margin-top: 50px; font-size: 40px;">
		<span><?= $t['mkt'] ?></span>
		<div class="flex about-section">
			<div class="about-text-section">
				<table class="about-table">
					<tr>
						<td class="about-text wow fadeInUp d030">
							<p><?php echo $t['mkt_title_1']?></p>
							<ul>
								<li><?= $t['mkt_txt_1'] ?></li>
								<li><?= $t['mkt_txt_2'] ?></li>
								<li><?= $t['mkt_txt_3'] ?></li>
								<li><?= $t['mkt_txt_4'] ?></li>
							</ul>
						</td>
						<td class="about-text wow fadeInUp d040">
							<p><?php echo $t['mkt_title_2']?></p>
							<ul>
								<li><?= $t['mkt_txt_5'] ?></li>
								<li><?= $t['mkt_txt_6'] ?></li>
								<li><?= $t['mkt_txt_7'] ?></li>
								<li><?= $t['mkt_txt_8'] ?></li>
							</ul>
	            		</td>
					</tr>
				</table>
			</div>
	        <div class="video-about">
	            <div class="video-box" style="border:none;box-shadow: none">
	                <!--<img src="imgs/ico_1.jpg">-->
	                <img src="imgs/mkt.png" class="wow fadeInUp d075" style="max-height: 300px; max-width: auto;">
	            </div>
			</div>
		</div>
	</div>

	<div id="comm" class="stockwise flex column black-title" style="font-size: 40px;">
		<span class="wow fadeInUp d001"><?= $t['comm_title'] ?></span>
		<div class="stockwise-text flex column">
			<span class="stockwise-subtitle wow fadeInUp d020" style="font-size:28px;"><?= $t['comm_title_2'] ?></span>
		</div>
		<div class="stockwise-content flex" style="text-align: left;">
			<ul>
				<span class="choose-tag"><li><?php echo $t['comm_rp_1']?></li></span>
				<span class="choose-tag"><li><?php echo $t['comm_rp_2']?></li></span>
				<span class="choose-tag"><li><?php echo $t['comm_rp_3']?></li></span>
				<span class="choose-tag"><li><?php echo $t['comm_rp_4']?></li></span>
				<span class="choose-tag"><li><?php echo $t['comm_rp_5']?></li></span>
				<span class="choose-tag"><li><?php echo $t['comm_rp_6']?></li></span>
			</ul>
			<img src="imgs/pr.png" class="stockwise-img wow fadeInUp d030" style="max-height: 300px; max-width: auto;">
		</div>
		<div class="stockwise-text flex column">
			<span class="stockwise-subtitle wow fadeInUp d020" style="font-size:28px;"><?= $t['comm_ev_t_1'] ?></span>
		</div>
		<div class="stockwise-content flex" style="text-align: left;">
			<ul>
				<span class="choose-tag"><li><?php echo $t['comm_ev_1']?></li></span>
				<span class="choose-tag"><li><?php echo $t['comm_ev_2']?></li></span>
				<span class="choose-tag"><li><?php echo $t['comm_ev_3']?></li></span>
				<span class="choose-tag"><li><?php echo $t['comm_ev_4']?></li></span>
			</ul>
		</div>
	</div>
	
	<div id="contact" class="contact flex column white-title" styel="font-size: 40px;">
		<div class="contact-telegram flex wow fadeInUp d020">
			<img src="assets/contact_telegram.svg" alt="Telegram">
			<a href="https://t.me/SocialRemit"><span><?= $t['sec_social_telegram'] ?></span></a>
		</div>
		<div id="#subscribe" class="flex social-bar wow fadeInUp d001">
		<div>
					<span><?= $t['sec_follow_us'] ?><br></span>
					<span style="font-size:16px;display: inline-flex;line-height: 2;"><?= $t['sec_follow_us_desc'] ?></span>
					<ul class="social-bar-list">
					<li><a style="color:#3b5998" href="https://www.facebook.com/SocialRemit-Blockchain-Networks-LTD-225736334625445/"><i class="fa fa-facebook"></i></a></li>
					<li><a href="https://twitter.com/Socialremit_uk"><em class="fa fa-twitter"></em></a></li>
					<li><a style="color:#0077B5" href="https://www.linkedin.com/company/SocialRemit/"><em class="fa fa-linkedin"></em></a></li>
					<li><a style="color:#ff4500" href="https://www.reddit.com/user/socialremit/posts/"><em class="fa fa-reddit"></em></a></li>
					<li><a style="color:#FF9900" href="https://bitcointalk.org/index.php?topic=4471416"><em class="fa fa-bitcoin"></em></a></li>
					<li><a style="color:#00ab6c" href="https://medium.com/@SocialRemit"><em class="fa fa-medium"></em></a></li>
					</ul>
			</div>

		</div>
	</div>
<?php require_once 'footer.php'; ?>

