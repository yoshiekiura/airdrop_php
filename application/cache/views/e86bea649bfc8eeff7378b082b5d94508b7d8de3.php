<?php $__env->startPush("custom_css"); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection("menu-airdrop", "menu-open"); ?>
<?php $__env->startSection("referral", "active"); ?>
<?php $__env->startSection("dropdown-airdrop", "display: block"); ?>

<?php $__env->startSection("content"); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Referral
	</h1>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="breadcrumb-item"><a href="#">Airdrop</a></li>
		<li class="breadcrumb-item active">Referral</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-7">

			<div class="box">

				<div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                                <h3>Total People Referred: <?=$totalPeopleCount?></h3>
                        </div>
                        <div class="col-md-6">
                            <h3>Total Commission Earned: <?=$totalCommission?></h3>
                        </div>
                    </div>
					<div class="table-responsive">
						<table id="Ajax_DataTable" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
							<thead>
								<tr>
                                    <th>No</th>
                                    <th>Level</th>
                                    <th>Username</th>
                                    <th>Reward Amount</th>
                                    <th>Commission</th>
								</tr>
                            </thead>
                            <tbody>
                                <?php foreach($showData as $index => $child){ ?>
                                    <tr>
                                        <td><?=$child['no']?></td>
                                        <td><?=$child['level']?></td>
                                        <td><?=$child['username']?></td>
                                        <td><?=$child['reward']?></td>
                                        <td><?=$child['commission']?></td>
                                    </tr>
                                <?php }?>
                                
                            </tbody>
						</table>
					</div>
				</div>
				<!-- /.box-body -->
			</div>
			<!-- /.box -->
		</div>
        <!-- /.col -->
        
        <div class="col-md-5 col-12">
            <?php echo $__env->make('client.components.referral_link_box', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <!-- /.box -->
        </div>
	</div>
	<!-- /.row -->
</section>
<!-- /.content -->
<?php $__env->stopSection(); ?>

<?php $__env->startPush('plugin_js'); ?>
	<!-- DataTables -->
	<script src="<?php echo e(base_url()); ?>assets/vendor_components/datatables.net/js/jquery.dataTables.min.js"></script>
	<script src="<?php echo e(base_url()); ?>assets/vendor_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

	<!-- This is data table -->
    <script src="<?php echo e(base_url()); ?>assets/vendor_plugins/DataTables-1.10.15/media/js/jquery.dataTables.min.js"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('custom_js'); ?>
<script>
    var ajax_datatable;
    (function(window, document, $, undefined) {
        $(function() {
            
            
        });
    })(window, document, window.jQuery);
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make("client.layout.master", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>