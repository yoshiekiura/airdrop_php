<div class="links flex">
		<div class="footer-menu footer-column" style="text-align: center">
			<img class="wow d020" src="assets/sub_logo.png" alt="Logo">

		<div style="padding-top: 15px;">
			<ul class="wow d030">
				<a href="/#token"><li><?= $t['sec_footer_tokensales'] ?></li></a>
				<a href="/#choose"><li><?= $t['sec_footer_choose'] ?></li></a>
                <a href="/#faq"><li><?= $t['sec_footer_faqs'] ?></li></a>
            </ul>

			<ul class="wow d040">
				<a href="/#team"><li><?= $t['sec_footer_team'] ?></li></a>
				<a href="/#about"><li><?= $t['sec_footer_about'] ?></li></a>
			</ul>
		</div>
        </div>
		<div class="footer-column">
			<ul class="wow d050">
				<span style="font-size:1.2rem"><b>SocialRemit UK</b></span>
				<li class="footer-address"><i class="fa fa-map-marker" aria-hidden="true"></i> 6 Bevis Marks, EC3A 7BA,
                    City of London, United Kingdom</li>
				<li><a style="color:#ffffff" href="tel:+442032877216"><i class="fa fa-phone"></i> +44 2032 877 216</a></li>
				<li><a style="color:#ffffff" href="tel:+442076812541">Fax: +442076812541</a></li>
			</ul>
		</div>
		<div class="footer-column">
			<ul class="wow d050">
				<span style="font-size:1.2rem"><b>SocialRemit USA</b></span>
				<li class="footer-address"><i class="fa fa-map-marker" aria-hidden="true"></i> 3000 El Camino Real, Building 4, Suite 200,
                    Palo Alto, California 94306</li>
				<li><a style="color:#ffffff" href="tel:(650) 452-6180"><i class="fa fa-phone"></i> (650) 452-6180</a></li>
				<li><a style="color:#ffffff" href="tel:+16506440184">Fax: +16506440184</a></li>
			</ul>
		</div>
		<div class="mail-footer">
			<a style="color:#ffffff;margin: 0 auto;" href="mailto:info@socialremit.com">
				<i class="fa fa-envelope"></i> info@socialremit.com
			</a>
			<div style="display: block">
				<img src="imgs/sello1.png" style="width:150px;height:auto;">
			</div>
			<div style="display: block">
				<img src="imgs/sello2.png" style="width:150px;height:auto;">
			</div>
			
        </div>
        
</div>
<div class="other-links">
    <a href="<?php echo $d['legal'] ?>" target="_blank"><?=$t['sec_footer_legal_warning']?></a>
    <a href="<?php echo $d['priva'] ?>" target="_blank"><?=$t['sec_footer_privacy_policy']?></a>
    <a href="<?php echo $d['cookies'] ?>" target="_blank"><?=$t['sec_footer_cookies_policy']?></a>
    <a href="<?php echo $d['conds'] ?>" target="_blank"><?=$t['sec_footer_terms_of_service']?></a>
</div>
    <!--	<table style="background-color: #1a1c1c;" width="100%" border="0" cellpadding="2" cellspacing="0" title="Click to Verify - This site chose GeoTrust SSL for secure e-commerce and confidential communications.">-->
<!--<tr>-->
<!--<td width="135" align="center" valign="top"><script type="text/javascript" src="https://seal.geotrust.com/getgeotrustsslseal?host_name=www.socialremit.com&amp;size=S&amp;lang=en"></script><br />-->
<!--<a href="http://www.geotrust.com/ssl/" target="_blank"  style="color:#000000; text-decoration:none; font:bold 7px verdana,sans-serif; letter-spacing:.5px; text-align:center; margin:0px; padding:0px;"></a></td>-->
<!--</tr>-->
<!--</table>-->
	<footer>
		<span>Copyright &copy; 2019, SocialRemit Blockchain Networks LTD Company Number 11204680,</span>
		<span><br>SocialRemit Blockchain Networks LLC</span>
	</footer>
	<script src="<?=base_url();?>asset/js/jquery-3.3.1.min.js"></script>
	<script src="<?=base_url();?>asset/js/particles.min.js"></script>
	<script src="<?=base_url();?>asset/js/jquery.countdown.min.js"></script>
	<script src="<?=base_url();?>asset/js/owl.min.js"></script>
	<script src="<?=base_url();?>asset/js/wow.min.js"></script>
	<script>
              new WOW().init();
var tag=document.createElement("script");tag.src="https://www.youtube.com/player_api";var player,firstScriptTag=document.getElementsByTagName("script")[0];function onYouTubePlayerAPIReady(){player=new YT.Player("vplayer",{playerVars:{autoplay:0,controls:0,disablekb:1,fs:1,iv_load_policy:3,loop:0,modestbranding:1,playsinline:1,rel:0,showinfo:0,enablejsapi:1,origin:"https%3A%2F%2Fsocialremit.com",widgetid:1},videoId:"<?= $t['youvidid'] ?>"})}firstScriptTag.parentNode.insertBefore(tag,firstScriptTag),$(window).scroll(function(){$("iframe").each(function(){$(window).scrollTop()>$(this).offset().top-400&&$(window).scrollTop()<$(this).offset().top+400?player.playVideo():pauseVideo(player)})});var pauseVideo=function(e){var o;return null==e&&(e=void 0),0===(o=e.getVolume())?(e.pauseVideo(),e.unMute(),e.setVolume(100)):(e.setVolume(o-5),setTimeout(function(){return pauseVideo(e)},100))};
	</script>
	<!-- Global site tag(gtag.js)-Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-120909715-1"></script><script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments)}
gtag('js',new Date());gtag('config','UA-120909715-1');</script><!-- Quantcast Tag --><script type="text/javascript">var _qevents=_qevents||[];(function(){var elem=document.createElement('script');elem.src=(document.location.protocol=="https:"?"https://secure":"http://edge")+".quantserve.com/quant.js";elem.async=!0;elem.type="text/javascript";var scpt=document.getElementsByTagName('script')[0];scpt.parentNode.insertBefore(elem,scpt)})();_qevents.push({qacct:"p-71fc_pcb1wgMY"});</script><noscript><div style="display:none;"><img src="//pixel.quantserve.com/pixel/p-71fc_pcb1wgMY.gif" border="0" height="1" width="1" alt="Quantcast"/></div></noscript><!-- End Quantcast tag -->
	<script src="scroll.js"></script>
	<script src="p.js"></script>
	<script src="countdowna.js?ver=<?php echo rand(1000,9999) ?>"></script>
<!--Start of Tawk.to Script-->
	<script type="text/javascript">
		var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
		(function(){
			var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
			s1.async=true;
			s1.src='https://embed.tawk.to/5bc950acb9993f2ada14c714/default';
			s1.charset='UTF-8';
			s1.setAttribute('crossorigin','*');
			s0.parentNode.insertBefore(s1,s0);
		})();
	</script>
<!--End of Tawk.to Script-->

</body>
</html>
