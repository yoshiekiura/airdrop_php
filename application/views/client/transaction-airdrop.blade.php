@extends("client.layout.master")

@push("custom_css")
@endpush

@section("menu-airdrop", "menu-open")
@section("airdrop-transaction", "active")
@section("dropdown-airdrop", "display: block")

@section("content")
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
        Transaction
        <small> - Airdrop Transaction History</small>
	</h1>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="breadcrumb-item"><a href="#">Airdrop</a></li>
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
						<table id="Ajax_DataTable" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
							<thead>
								<tr>
                                    <th>No</th>
                                    <th>Amount</th>
                                    <th>Transaction Hash</th>
                                    <th>Received At</th>
								</tr>
                            </thead>
                            <tbody>
                            </tbody>
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
@endsection

@push('plugin_js')
	<!-- DataTables -->
	<script src="{{base_url()}}assets/vendor_components/datatables.net/js/jquery.dataTables.min.js"></script>
	<script src="{{base_url()}}assets/vendor_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

	<!-- This is data table -->
    <script src="{{base_url()}}assets/vendor_plugins/DataTables-1.10.15/media/js/jquery.dataTables.min.js"></script>
@endpush

@push('custom_js')
<script>
    var ajax_datatable;
    (function(window, document, $, undefined) {
        $(function() {
            ajax_datatable = $("#Ajax_DataTable").dataTable({
                "searching": false,
                "processing": true,
                "serverSide": true,
                "ajax": "<?=base_url()?>client/transaction/getTransactionData",
                "columns": [
                    { "data": "no" },
                    { "data": "amount" },
                    { "data": "transaction_id" },
                    { "data": "created_at" },
                ]
            });
        });
    })(window, document, window.jQuery);
</script>
@endpush
