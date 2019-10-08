<?php $__env->startPush("custom_css"); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection("menu-ico", "menu-open"); ?>
<?php $__env->startSection("ico-transaction", "active"); ?>
<?php $__env->startSection("dropdown-ico", "display: block"); ?>

<?php $__env->startSection("content"); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Transaction
		<small> - ICO Transaction History</small>
	</h1>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="breadcrumb-item"><a href="#">ICO</a></li>
		<li class="breadcrumb-item active">Transaction</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-12">
			<div class="box">
				<div class="box-body">
					<div class="table-responsive">
						<table id="Ajax_DataTable" class="text-center table table-bordered table-hover display nowrap margin-top-10 w-p100">
							<thead>
								<tr>
									<th colspan="1"></th>
									<th colspan="3">Order</th>
									<th colspan="2">Guarantee</th>
									<th colspan="5">Payment</th>
									<th colspan="3">Receive</th>
								</tr>
								<tr>
									<th>No</th>
									<th>Token</th>
									<th>Amount</th>
									<th>Price</th>

									<th>Date</th>
									<th>Price</th>

									<th>Method</th>
									<th>Currency</th>
									<th>Amount</th>
									<th>Detail</th>
									<th>Status</th>

									<th>Hash</th>
									<th>Status</th>
									<th>Date/Time</th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
				<!-- /.box-body -->
			</div>
			<!-- /.box -->
		</div>
		<!-- /.col -->
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
	(function (window, document, $, undefined) {
		$(function () {
			ajax_datatable = $("#Ajax_DataTable").dataTable({
				"searching": false,
				"processing": true,
				"serverSide": true,
				"ajax": "<?=base_url()?>client/ICO/getICOTransactionData",
				"columns": [
                    {"data": "no"},
                    {"data": "token"},
                    {"data": "payout_amount"},
                    {"data": "price_amount"},

                    {"data": "guarantee_date"},
                    {"data": "guarantee_price"},

                    {"data": "payment_method"},
                    {"data": "pay_currency"},
                    {"data": "pay_amount"},
                    {"data": "payment_details"},
                    {"data": "status"},

                    {"data": "payout_hash"},
                    {"data": "payout_status"},
                    {"data": "payout_at"},
				]
			});
		});
	})(window, document, window.jQuery);

</script>

<?php echo message_box_new('error'); ?>

<?php echo message_box_new('success'); ?>

<?php $__env->stopPush(); ?>

<?php echo $__env->make("client.layout.master", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>