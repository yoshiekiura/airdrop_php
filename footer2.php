<div class="links flex">
		<div class="footer-menu footer-column" style="text-align: center">
			<img class="wow d020" src="assets/sub_logo.png" alt="Logo">
        </div>
		<div class="footer-column" style="width:75%;">
			<span style="font-size:1.2rem"><b><?php echo $t['news_note']?></b></span>
		</div>
		
</div>
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
	<script src="countdown.js?ver=<?php echo rand(1000,9999) ?>"></script>

</body>
</html>


