<?php echo $__env->make('client/layout/head', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('client/layout/header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('client/layout/sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <?php echo $__env->yieldContent('content'); ?>
</div>

<?php echo $__env->make('client/layout/footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('client/layout/foot', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
