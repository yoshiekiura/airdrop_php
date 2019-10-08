<div class="box">
	<div class="box-header with-border">
		<h3 class="box-title">Refer Others</h3>
        @if(!$userdata->mlm_flag)
		<span class="pull-right badge badge-pill badge-success">+10 CSR</span>
        @endif
	</div>
	<div class="box-body">
        <p>Share your special URL to track referrals.</p>
        <!-- <p>You will receive <span class="badge badge-pill badge-success">+100 CSR</span> each for upto 3 referrals in this month.</p> -->

		<div class="input-group margin">
			<input type="text" class="form-control" value="https://www.socialremit.com/ref/{{$userdata->user_id}}" disabled>
			<div class="input-group-btn">
				<button type="button" class="btn btn-warning" id="copy-btn" onclick="onCopyBtn()">Copy</button>
			</div>
			<!-- /btn-group -->
		</div>
		<!-- /input-group -->
	</div>
	<!-- /.box-body -->

	<div class="box-footer with-border margin-bottom-20">
		<div class="text-center">
			<a href="https://facebook.com" target="_blank" class="btn btn-social-icon btn-circle btn-facebook"><i class="fa fa-facebook"></i></a>
			<a href="https://twitter.com" target="_blank" class="btn btn-social-icon btn-circle btn-twitter"><i class="fa fa-twitter"></i></a>
			<a href="https://linkedin.com" target="_blank" class="btn btn-social-icon btn-circle btn-linkedin"><i class="fa fa-linkedin"></i></a>
			<a href="https://instagram.com" target="_blank" class="btn btn-social-icon btn-circle btn-instagram"><i class="fa fa-instagram"></i></a>
			<a href="https://plus.google.com" target="_blank" class="btn btn-social-icon btn-circle btn-google"><i class="fa fa-google-plus"></i></a>
			<a href="https://pinterest.com" target="_blank" class="btn btn-social-icon btn-circle btn-pinterest"><i class="fa fa-pinterest"></i></a>
			<a href="https://youtube.com" target="_blank" class="btn btn-social-icon btn-circle btn-youtube"><i class="fa fa-youtube"></i></a>
		</div>
	</div>

    <script>
        function onCopyBtn() {
            const el = document.createElement('textarea');
            el.value = '{{base_url()."ref/".$userdata->user_id}}';
            document.body.appendChild(el);
            el.select();
            document.execCommand('copy');
            document.body.removeChild(el);

            $.toast({
                heading: 'URL Copied!',
                position: 'bottom-right',
                loaderBg: '#ff6849',
                icon: 'success',
                hideAfter: 2000,
                stack: 6
            });
        }
    </script>
</div>
<!-- /.box -->
