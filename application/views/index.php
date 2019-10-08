
<?php

	$p = "-1";

	if (isset($_GET['t'])){
		$p = $_GET['t'];
	}
	if (isset($_POST['t'])){
		$p = $_POST['t'];
	}

	if ($p <> "-1"){
?>

<?php require_once 'header.php'; ?>


<style>
	.mivideo{
		max-height:344px;
		max-width:640px;"
	}

	@media (max-width: 600px){
		.mivideo{
			max-height:177px;
			max-width:320px;	
		}
	}
</style>

<button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fa fa-angle-up"></i>

</button>

<div id="home" class="home flex">
		<div id="particles-js" class="particles-container particles-js"></div>
		<div class="home-text animated fadeInUp d125">
		<?= $t['tagline'] ?>

            <div class="partners wow fadeInUp d025">
                <div class="partners-images">
                	<!--
                	<img src="imgs/stats.jpg" id="btnstats">
                	<div id="flagstats" style="display:none">
                		<a href="https://info.flagcounter.com/myJq"><img src="https://s11.flagcounter.com/count2/myJq/bg_5BB07E/txt_000000/border_CCCCCC/columns_8/maxflags_20/viewers_0/labels_0/pageviews_1/flags_0/percent_1/" alt="Flag Counter" border="0"></a>
                	</div>
                	-->
                <!--
                    <a href="https://trustwalletapp.com/"><img src="assets/truewallet.png"></a>
                    <a href="https://www.geotrust.com/"><img src="assets/geotrust.gif"></a>
                    <a href="https://www.digicert.com/"><img src="assets/digicert.jpeg"></a>
                -->
                </div>
            </div>
		</div>
		
		<div class="ico animated fadeInUp">
			<span class="ico-title"><?= $t['chrono_icostart'] ?></span>
			<div id="counter" class="counter flex">
				<div class="counter-wrapper">
					<div id="counter_d" class="counter-block">--</div>
					<span class="counter-tag"><?= $t['days_lab'] ?></span>
				</div>
				<div class="counter-wrapper">
					<div id="counter_h" class="counter-block">--</div>
					<span class="counter-tag"><?= $t['hours'] ?></span>
				</div>
				<div class="counter-wrapper">
					<div id="counter_m" class="counter-block">--</div>
					<span  class="counter-tag"><?= $t['minutes'] ?></span>
				</div>
				<div class="counter-wrapper">
					<div id="counter_s" class="counter-block">--</div>
					<span class="counter-tag"><?= $t['seconds'] ?></span>
				</div>
			</div>
			<div class="ico-text flex">
				<div class="ico-text-block left"></div>
<!--				<div class="ico-text-block">1 ETH = 50 SOCIALREMIT<br>BTC = 250 SOCIALREMIT</div>-->
				<div class="ico-text-block right"><?= $t['3 million'] ?></div>
			</div>
			<div class="ico-bar">
				<div class="ico-bar-tokens flex column"></div>
			</div>
			<div class="ico-bar-text flex">
				<span><?= $t['softcap'] ?></span>
				<span><?= $t['hardcap'] ?></span>
			</div>
			<ul class="ico-buttons">
                <ul class="btn-counter">
                <li><a href="/login"><div class="ico-buy"><?= $t['buynow_button'] ?></div></a></li>
                    <li><a href="http://www.socialremit.com/contact.php"><div class="ico-whitepaper" style="width: 100%;"><?= $t['big_investors'] ?></div></a></li>
                </ul>
                <ul class="btn-counter">
				<li><a href="whitepaper.php"><div class="ico-whitepaper">WHITEPAPER</div></a></li>
				<li><a href="https://www.socialremit.com/register"><div class="ico-buy" style="width: 100%;"><?= $t['join_the_project']?></div></a></li>
                </ul>
				<li></li>
				<li><div><?= $t['weaccept'] ?></div></li>
				<li class="ico-image"><img src="assets/bitcoin.png">
				<img src="assets/ethereum.png">
				<img src="assets/litecoin.png">
				<img src="assets/neo.png">
				<img src="assets/ripple.png">
				<img src="assets/dogecoin.png">
				<img src="assets/visa.svg">
				<img src="assets/mastercard.png">
				</li>
				<li><span><?= $t['chrono_acceptedcurrencies_1'] ?></span>
				<span><br><?= $t['chrono_acceptedcurrencies_2'] ?></span></li>
			</ul>

		</div>
	</div>
	
	<div class="partners wow fadeInUp d025" style="background-color:#000;padding-bottom:50px;margin-bottom:0px;">
		<span style="color:#ffffff;"><?= $t['soon'] ?></span>
		<div class="partners-images">

			<a href="#">
				<img border="0" src="assets/latoken_black.png" style="width:100px;height:auto"/>
			</a>
			<a href="#">
				<img border="0" src="assets/bitexlive.png" style="width:200px;height:auto"/>
			</a>
			<a href="#">
				<img border="0" src="assets/idex.png" style="width:150px;height:auto"/>
			</a>
			<a href="#">
				<img border="0" src="assets/iqfinex.png" style="width:150px;height:auto"/>
			</a>
			<a href="#">
				<img border="0" src="assets/coinfloor.png" style="width:150px;height:auto"/>
			</a>
			<a href="#">
				<img border="0" src="assets/coinexchange.png" style="width:300px;height:auto"/>
			</a>
        </div>
    </div>

	<div class="partners wow fadeInUp d025" style="background-color:#000;">
		<span style="color:#ffffff;"><?= $t['as seen on'] ?></span>
				<div class="partners-images">

                    <a href="https://icobench.com/ico/socialremit" target="_blank" rel="nofollow" title="SocialRemiton ICO bench"><img border="0" src="https://icobench.com/rated/socialremit?shape=square&size=m" width="200px" height="200px" alt="SocialRemit ICO rating"/></a>

                    <span id="icoholder-widget-big-black-22492"></span>
                    <script type="application/javascript" async="async" 
                    	src="https://icoholder.com/en/widget/big-black/22492.js?width=150" width="200px" height="200px">
                    </script>

                    <!--
                    <span id="icoholder-widget-big-black-listed-22492"></span>
                    <script type="application/javascript" async="async" 
                    	src="https://icoholder.com/en/widget/big-black-listed/22492.js?width=150" width="200px" height="200px">
                    </script>
                    -->

                    <a href="https://www.trackico.io/ico/socialremit/" target="_blank" title="SocialRemit on TrackICO">
                        <img border="0" src="https://www.trackico.io/widget/square/socialremit/400.png" width="400px" height="400px" alt="SocialRemit TrackICO rating">
                    </a>

                    <a href="https://icomarks.com/ico/socialremit" target="_blank" rel="nofollow" title="SocialRemit"><img border="0" src="https://icomarks.com/widget/s/socialremit/horizontal.svg" width="400px" height="125px" alt="SocialRemit ICO rating"/></a>

                    <!--<a href="https://findico.io/ico/socialremit" target="_blank" title="SocialRemit on FindICO"> <img border="0" src="https://findico.io/widget/square/socialremit/146.png" width="146px" height="auto" alt="SocialRemit FindICO rating"></a>-->
                </div>
    </div>

<div id="about" class="about white-title">

		<span><?= $t['sec_about_heading'] ?></span>

		<div class="flex about-section">
            <div class="about-text-section">
                <div class="about-img">
                    <div class="img-content">
                        <img src="assets/about_img.svg" class="wow fadeInUp d075">
                    </div>
                </div>
			<table class="about-table">
				<tr>
<!--					<td colspan="2" class="about-sr wow fadeInUp d020">--><?//= $t['sec_about_about'] ?><!--</td>-->
                </tr>

                <tr>
                    <td colspan="2" class="about-hq wow fadeInUp d050">
                        <?= $t['sec_about_desc_4'] ?>
                    </td>

                </tr>

				<tr>
					<td class="about-text wow fadeInUp d030">
						<?= $t['sec_about_desc_1'] ?>					</td>
					<td class="about-text wow fadeInUp d040">
						<?= $t['sec_about_desc_2'] ?>						<br>
						<br>
                    </td>
				</tr>
                <tr>
                    <td colspan="2" class="about-hq wow fadeInUp d050">
                        <?= $t['sec_about_desc_3'] ?>
                    </td>

                </tr>

			</table>

        </div>
            <div class="video-about">
            <div class="video-box" >
                <iframe id="vplayer" class="embed-responsive-item mivideo"  src="https://www.youtube.com/embed/<?= $t['youvidid'] ?>?autoplay=0&controls=0&disablekb=1
		&fs=0&iv_load_policy=3&loop=1&modestbranding=1&playsinline=1&rel=0&showinfo=0&enablejsapi=1
		&origin=http%3A%2F%2Fsocialremit.com&widgetid=1" frameborder="0"></iframe>
            </div>
            </div>
		</div>
	</div>
	<div id="choose" class="choose black-title">
		<span class="wow fadeInUp d001"><?= $t['sec_choose_heading'] ?></span>
		<div class="choose-content flex">
			<div class="choose-section flex column">
				<div class="choose-header flex column wow fadeInUp d020">
					<img src="assets/why_risks.svg" alt="<?= $t['sec_choose_risks_heading'] ?>">
					<span class="choose-tag"><?= $t['sec_choose_risks_heading'] ?></span>
				</div>
				<span>
				<?= $t['sec_choose_risks_desc'] ?>
				</span>
			</div>
			<div class="choose-section flex column">
				<div class="choose-header flex column wow fadeInUp d030">
					<img src="assets/why_tokens.svg" alt="<?= $t['sec_choose_tokens_heading'] ?>">
					<span class="choose-tag"><?= $t['sec_choose_tokens_heading'] ?></span>
				</div>
				<span>
				<?= $t['sec_choose_tokens_desc'] ?>
				</span>
			</div>
			<div class="choose-section flex column">
				<div class="choose-header flex column wow fadeInUp d040">
					<img src="assets/why_tokens_socialremit.svg" alt="<?= $t['sec_choose_tokenssrt_heading'] ?>">
					<span class="choose-tag"><?= $t['sec_choose_tokenssrt_heading'] ?></span>
				</div>
				<span>
					<?= $t['sec_choose_tokenssrt_desc'] ?>
				</span>
			</div>
			<div class="choose-section flex column">
				<div class="choose-header flex column wow fadeInUp d050">
					<img src="assets/why_liquidity.svg" alt="<?= $t['sec_choose_ead_heading'] ?>">
					<span class="choose-tag"><?= $t['sec_choose_ead_heading'] ?></span>
				</div>
				<span>
					<?= $t['sec_choose_ead_desc'] ?>
				</span>
			</div>
		</div>
	</div>
	<div id="okaymoney" class="flex column white-title wow fadeInUp d020">
		<span><?= $t['sec_okaymoney_heading'] ?></span>
		<div class="okaymoney-text flex column">
			<span class="okaymoney-subtitle"><?= $t['sec_okaymoney_okaymoney'] ?></span>
			<span>
				<?= $t['sec_okaymoney_okaymoney_desc'] ?>
			</span>
		</div>
		<div class="okaymoney-content flex">
			<table>
				<tr>
					<td>
                        <span class="image-align"><img src="assets/okaymoney_wallet.svg"></span>
                        <span class="image-align"><?= $t['sec_okaymoney_challenge'] ?></span>
					</td>
					<td>
                        <span class="image-align"><img src="assets/okaymoney_touch.svg"></span>
                        <span class="image-align"><?= $t['sec_okaymoney_reliable'] ?>	</span>				</td>
				</tr>
				<tr>
					<td>
                        <span class="image-align"><img src="assets/okaymoney_send.svg"></span>
                        <span class="image-align"><?= $t['sec_okaymoney_sending'] ?></span>					</td>
					<td>
                        <span class="image-align"><img src="assets/okaymoney_money.svg"></span>
                        <span class="image-align"><?= $t['sec_okaymoney_banks'] ?></span>					</td>
				</tr>
			</table>
			<img src="assets/socialremit_workfile_okay.png" class="okaymoney-img wow">
		</div>
	</div>
	<div id="stockwise" class="stockwise flex column black-title">
		<span class="wow fadeInUp d001"><?= $t['sec_s1w_heading'] ?></span>
		<div class="stockwise-text flex column">
			<span class="stockwise-subtitle wow fadeInUp d020"><?= $t['sec_s1w_s1w'] ?></span>
			<?= $t['sec_s1w_desc'] ?>
		</div>
		<div class="stockwise-content flex">
			<table>
				<tr>
					<td>
                        <span class="image-align"><img src="assets/stockwise_house.svg"></span>
                        <span class="image-align"><?= $t['sec_s1w_goal'] ?>	</span>				</td>
					<td>
                        <span class="image-align"><img src="assets/stockwise_box.svg"></span>
                        <span class="image-align"><?= $t['sec_s1w_acquisition'] ?></span>					</td>
				</tr>
				<tr>
					<td>
                        <span class="image-align"><img src="assets/stockwise_hands.svg"></span>
                        <span class="image-align"><?= $t['sec_s1w_advantage'] ?></span>					</td>
					<td>
                        <span class="image-align"><img src="assets/stockwise_persons.svg"></span>
                        <span class="image-align"><?= $t['sec_s1w_benefit'] ?></span>					</td>
				</tr>
			</table>
			<img src="assets/stockwise_phone.svg" class="stockwise-img wow fadeInUp d030">
		</div>
	</div>
	<div id="how" class="flex column white-title">
		<span class="wow fadeInUp d001"><?= $t['sec_how_heading'] ?></span>
		<div class="how-icons flex">
<!--			<img class="wow fadeInUp d020" src="assets/how_left_arrow.svg">-->
			<img class="wow fadeInUp d030" src="assets/how_icons.svg">
<!--			<img class="wow fadeInUp d040" src="assets/how_right_arrow.svg">-->
		</div>
		<div class="how-text flex column wow fadeInUp d075">
			<span class="how-subtitle"><?= $t['sec_how_how'] ?></span>
			<span>
				<?= $t['sec_how_desc'] ?>	
			</span>
		</div>
	</div>
	<div id="token" class="token flex column black-title">
		<span class="wow fadeInUp d010"><?= $t['sec_distribution_heading'] ?></span>
		<div class="token-content flex">
			<ul class="flex">
				<li class="wow fadeInUp d020"><span><?= $t['sec_distribution_gensale'] ?></span>
					<br>
					<?= $t['sec_distribution_gensale_desc'] ?>
				</li>
				<li class="wow fadeInUp d030"><span><?= $t['sec_distribution_team5'] ?></span>
                    <br>
                    <?= $t['sec_distribution_team5_desc'] ?>
                </li>
				<li class="wow fadeInUp d050">
					<span><?= $t['sec_distribution_advisor5'] ?></span>
					<br>
					<?= $t['sec_distribution_advisor5_desc'] ?>
				</li>
                <li class="wow fadeInUp d050">
					<span><?= $t['sec_distribution_gensale2'] ?></span>
					<br>
					<?= $t['sec_distribution_gensale2_desc'] ?>
				</li>
				<li class="wow fadeInUp d065">
					<span><?= $t['sec_distribution_advisor1666'] ?></span>
                    <br>
				 	<?= $t['sec_distribution_advisor1666_desc'] ?>
				</li>
				<li class="wow fadeInUp d075">
					<span><?= $t['sec_distribution_other'] ?></span>
                    <br>
                    <?= $t['sec_distribution_other_desc'] ?>
				</li>
			</ul>
			<div class="token-imgs column">
				<img class="wow fadeInUp d080" src="assets/token_chart_1.svg">
				<img class="wow fadeInUp d090" src="assets/token_chart_2.svg">
			</div>
		</div>
	<div class="flex left-align" style="font-size: 1.2rem;font-weight: 700;padding:0 28%;justify-content:space-around;
      ;width:100%; text-align: left;"><?= $t['sec_distribution_bottom_text'] ?></div>
	</div>
	</div>

	<div id="wallet" class="white-title">
		<span class="wow fadeInUp d001"><?= $t['sec_icowallet_heading'] ?></span>
		<div class="wallet-content flex">
			<table>
				<tr>
					<td class="wow fadeInUp d020">
                        <span class="image-align-wallet"><img src="assets/wallet_wallet.svg"></span>

                        <span class="wallet-subtitle"><?= $t['sec_icowallet_manage'] ?></span>

                        <span class="image-align"><?= $t['sec_icowallet_manage_desc'] ?></span>
					</td>
					<td class="wow fadeInUp d030">
                        <span class="image-align-wallet"><img src="assets/wallet_world.svg"></span>

                        <span class="wallet-subtitle"><?= $t['sec_icowallet_global'] ?></span>

                        <span class="image-align"><?= $t['sec_icowallet_global_desc'] ?></span></td>
					</td>
				</tr>
				<tr>
					<td class="wow fadeInUp d065">
                        <span class="image-align-wallet"><img src="assets/wallet_medal.svg"></span>

                        <span class="wallet-subtitle"><?= $t['sec_icowallet_rewards'] ?></span>

                        <span class="image-align"><?= $t['sec_icowallet_rewards_desc'] ?></span>
					</td>
					<td class="wow fadeInUp d040">
                        <span class="image-align-wallet"><img src="assets/wallet_friend.svg"></span>

                        <span class="wallet-subtitle"><?= $t['sec_icowallet_friends'] ?></span>

                        <span class="image-align"><span class="image-align"><?= $t['sec_icowallet_friends_desc'] ?></span>
						</td>
				</tr>
			</table>
			<div class="wallet_phone">
			<img src="assets/wallet_phone.svg" class="wallet-img">
		</div>
		</div>
	</div>
	<div id="team" class="team flex column bg black-title">
		<span class="wow fadeInUp d001"><?= $t['sec_team_heading'] ?></span>
		<span class="team-subtitle wow fadeInUp d020">
			<?= $t['sec_team_tagline'] ?>
		</span>

		<img src="assets/team_img.svg" id="you-team" style="width:20%;margin:3% auto">
		<span class="team-text wow fadeInUp d001">
			<?= $t['sec_team_heading'] ?>
		</span>
		<div style="margin: 0 auto" class="team-content flex team-content-1">
			<div class="team-mate wow fadeInUp d020">
				<img src="assets/team_1.png" alt="Leonardo Reyes">
				<span class="name">Leonardo Reyes</span>

				<span class="job"><?= $t['job_founder'] ?></span>
				<span class="flag-icon flag-icon-gb"></span>
			</div>
			<div class="team-mate wow fadeInUp d030">
				<img src="assets/team_2.png" alt="Esteban Campmany Meca">
				<span class="name">Esteban Campmany Meca</span>

				<span class="job"><?= $t['job_taxlegal'] ?></span>
				<span class="flag-icon flag-icon-es"></span>
			</div>
			<div class="team-mate wow fadeInUp d040">
				<img src="assets/team_3.png" alt="Miguel MuÃ±oz Garcia">
				<span class="name">Miguel MuÃ±oz Garcia</span>

				<span class="job"><?= $t['job_commmarketing'] ?></span>
				<span class="flag-icon flag-icon-es"></span>
			</div>
			<div class="team-mate wow fadeInUp d050">
				<img src="assets/team_4.png" alt="Rahim Shaker">
				<span class="name">Rahim Shaker</span>

				<span class="job"><?= $t['job_salesexpert'] ?></span>
				<span class="flag-icon flag-icon-se"></span>

			</div>
			<div class="team-mate wow fadeInUp d065">
				<img src="assets/team_5.png" alt="David Martin Zamora">
				<span class="name">David Martin Zamora</span>

				<span class="job"><?= $t['job_construction'] ?></span>
				<span class="flag-icon flag-icon-gb"></span>
			</div>
			<div class="team-mate wow fadeInUp d075">
				<img src="assets/team_6.png" alt="Sammy El-shafi">
				<span class="name">Sammy El-shafi</span>

				<span class="job"><?= $t['job_realestate'] ?></span>
				<span class="flag-icon flag-icon-gb"></span>
			</div>
		</div>
		<div style="margin: 0 auto" class="team-content flex team-content-2">

			<div class="team-mate wow fadeInUp d030">
				<img src="assets/willson.png" alt="Wilson Mendoza">
				<span class="name">Willson Mendoza</span>

				<span class="job"><?= $t['job_socialnet'] ?></span>
				<span class="flag-icon flag-icon-ve"></span>
			</div>
			<div class="team-mate wow fadeInUp d050">
				<img src="assets/grigory.png" alt="Grigory Wazin">
				<span class="name">Grigory Wazin</span>

				<span class="job"><?= $t['job_blockchain'] ?></span>
				<span class="flag-icon flag-icon-ru"></span>
			</div>
			</div>
	                <span class="team-text wow fadeInUp d020">
			<?= $t['sec_team_collaborating'] ?>
		</span>
		<div style="margin: 0 auto" class="team-content flex team-content-3">
			<div class="team-mate wow fadeInUp d065">
				<img src="assets/uneekin.png" alt="Uneekin">
				<span class="name">Uneekin</span>

				<span class="job"><?= $t['job_videographics'] ?></span>
				<span class="flag-icon flag-icon-pk"></span>
			</div>
			<div class="team-mate wow fadeInUp d065">
				<img src="assets/pymesit.png" alt="Vicente Garcia Rodriguez">
				<span class="name">Vicente Garcia Rodriguez of Pymesit</span>

				<span class="job"><?= $t['job_securityservers'] ?></span>
				<span class="flag-icon flag-icon-mx"></span>
			</div>
			<div class="team-mate wow fadeInUp d065">
				<img src="assets/team_7.png" alt="Livio Perissin">
				<span class="name">Livio Perissin</span>

				<span class="job"><?= $t['job_graphicdesigner'] ?></span>
				<span class="flag-icon flag-icon-ar"></span>
			</div>
			<div class="team-mate wow fadeInUp d065">
				<img src="assets/hiperon.png" alt="Hiperion">
				<span class="name">Hiperion Studios</span>

				<span class="job"><?= $t['job_latinmarketing'] ?></span>
				<span class="flag-icon flag-icon-ve"></span>
			</div>
			<div class="team-mate wow fadeInUp d040">
				<img src="assets/team_placeholder.png" alt="Adriana Lopez">
				<span class="name">Adriana Lopez</span>

				<span class="job"><?= $t['job_graphicdesigner'] ?></span>
				<span class="flag-icon flag-icon-ve"></span>
			</div>

			<div class="team-mate wow fadeInUp d040">
				<img src="assets/sonia.png" alt="Sonia Grebenisan">
				<span class="name">Sonia Grebenisan</span>

				<span class="job"><?= $t['job_marketingstrategy'] ?></span>
				<span class="flag-icon flag-icon-ca"></span>
			</div>
			<div class="team-mate wow fadeInUp d065">
				<img src="assets/benni.png" alt="Benni">
				<span class="name">Benni Translation Services</span>

				<span class="job"><?= $t['job_translations'] ?></span>
				<span class="flag-icon flag-icon-gb"></span>
			</div>

		</div>
	</div>
	<div id="faq" class="flex column white-title">
		<span><?= $t['sec_faq_heading'] ?></span>
<!--		<span class="faq-subtitle wow fadeInUp d001">--><?//= $t['sec_faq_tagline'] ?><!--</span>-->
		<div class="faq-content flex">
			<div class="faq-column flex column">
				<div class="faq-section wow fadeInUp d020">
				<input type="checkbox" id="faq-1">
<div class="static">
	<label for="faq-1"><?= $t['sec_faq_icocrypto_heading'] ?></label>
</div>
<p><?= $t['sec_faq_icocrypto_desc'] ?></p>
				</div>
				<div class="faq-section wow fadeInUp d030">
					<input type="checkbox" id="faq-2">
<div class="static"><label for="faq-2"><?= $t['sec_faq_validcryptos_heading'] ?></label></div>
<p><?= $t['sec_faq_validcryptos_desc'] ?></p>
				</div>
			</div>
			<div class="faq-column flex column">
				<div class="faq-section wow fadeInUp d050">

					<input type="checkbox" id="faq-3">
<div class="static"><label for="faq-3"><?= $t['sec_faq_participateico_heading'] ?></label></div>
<p><?= $t['sec_faq_participateico_desc'] ?></p>
				</div>

				<div class="faq-section wow fadeInUp d065">
					<input type="checkbox" id="faq-4">
					<div class="static"><label for="faq-4"><?= $t['sec_faq_benefitico_heading'] ?></label></div>
<p><?= $t['sec_faq_benefitico_desc'] ?></p>
				</div>
			</div>
		</div>
	</div>
	<div id="contact" class="contact flex column white-title">
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

	<script>
	$("#btnstats").click(function(){
		var display =  $("#flagstats").css("display");
	    if(display!="none")
		{
	    	$("#flagstats").attr("style", "display:none");
		}else{
			$("#flagstats").attr("style", "display:show");
		}
	});
	</script>
<?php require_once 'footer.php'; ?>

<?php
}else{
	require_once 'index_gp.php';
}
?>
