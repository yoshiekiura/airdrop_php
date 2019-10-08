    </div>
    <!-- /.wrapper -->

    <!-- jQuery 3 -->
    <script src="<?php echo e(base_url()); ?>assets/vendor_components/jquery/dist/jquery.min.js"></script>

    <!-- popper -->
    <script src="<?php echo e(base_url()); ?>assets/vendor_components/popper/dist/popper.min.js"></script>

    <!-- Bootstrap 4.0-->
    <script src="<?php echo e(base_url()); ?>assets/vendor_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- SlimScroll -->
    <script src="<?php echo e(base_url()); ?>assets/vendor_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>

    <!-- FastClick -->
    <script src="<?php echo e(base_url()); ?>assets/vendor_components/fastclick/lib/fastclick.js"></script>

    <!-- toast -->
	<script src="<?php echo e(base_url()); ?>assets/vendor_components/jquery-toast-plugin-master/src/jquery.toast.js"></script>

    <?php echo $__env->yieldPushContent('plugin_js'); ?>

    <!-- Crypto_Admin App -->
    <script src="<?php echo e(base_url()); ?>assets/js/template.js"></script>

    <!-- Crypto_Admin for demo purposes -->
    <script src="<?php echo e(base_url()); ?>assets/js/demo.js"></script>

    <?php echo $__env->yieldPushContent('custom_js'); ?>

</body>

</html>
