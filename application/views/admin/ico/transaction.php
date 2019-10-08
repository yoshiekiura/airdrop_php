<?php $this->load->view('admin/layout/header'); ?>

<!-- Datatables-->
<link rel="stylesheet" href="<?=base_url()?>asset/vendor/datatables.net-bs4/css/dataTables.bootstrap4.css">
<link rel="stylesheet" href="<?=base_url()?>asset/vendor/datatables.net-keytable-bs/css/keyTable.bootstrap.css">
<link rel="stylesheet" href="<?=base_url()?>asset/vendor/datatables.net-responsive-bs/css/responsive.bootstrap.css">
<!-- bootstrap datepicker -->	
<link rel="stylesheet" href="<?=base_url()?>assets/vendor_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">

<style>
    .form-control{
        padding-left: 3px;
        min-width: 100px
    }
</style>

<!-- Page content-->
<div class="content-wrapper">
	<div class="content-heading">
		<div>ICO
			<small>ICO Transactions</small>
		</div>
	</div>
    
	<!-- START row-->
	<div class="row">
		<div class="col-md-12">
			<!-- START card-->
			<div class="card card-default">
				<div class="card-header">ICO Transactions
                     <button id="refresh_btn" class="btn btn-lg btn-primary pull-right" onclick="reloadTable()">
                        <i class="fa fa-refresh"></i>
                    </button>
                </div>
				<div class="card-body">
                    <input type="text" id="filter_username" placeholder="search by username">
					<div class="table-responsive">
						<table class="table table-striped" id="Ajax_DataTable">
                            <thead>
								<tr>
									<th colspan="1"></th>
									<th colspan="3">User Info</th>
									<th colspan="3">Order Info</th>
									<th colspan="3">Guarantee Info</th>
									<th colspan="5">Payment Info</th>
									<th colspan="2">Receive_Info</th>
									<th colspan="3">Payout Info</th>
									<th colspan="3">Actions</th>
								</tr>
								<tr>
									<th>No</th>

                                    <th>User Name</th>
									<th>Email</th>
									<th>KYC Status</th>

									<th>Amount</th>
									<th>Price(€)</th>
									<th>TimeStamp</th>

                                    <th>Yes/No</th>
									<th>Date</th>
                                    <th>Price(€)</th>

									<th>Method</th>
									<th>Currency</th>
                                    <th>Amount</th>
                                    <th>Details</th>
                                    <th>Status</th>
                                    
                                    <th>Currency</th>
                                    <th>Amount</th>

                                    <th>Status</th>
                                    <th>Tx_Hash</th>
                                    <th>TimeStamp</th>

                                    <th>Payment Status</th>
                                    <th>Payout Status</th>
                                    <th>Update</th>
                                    <th>Payout</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- END row-->
</div>


<!-- Datatables-->
<script src="<?=base_url()?>asset/vendor/datatables.net/js/jquery.dataTables.js"></script>
<script src="<?=base_url()?>asset/vendor/datatables.net-bs4/js/dataTables.bootstrap4.js"></script>
<script src="<?=base_url()?>asset/vendor/datatables.net-buttons/js/dataTables.buttons.js"></script>
<script src="<?=base_url()?>asset/vendor/datatables.net-buttons-bs/js/buttons.bootstrap.js"></script>
<script src="<?=base_url()?>asset/vendor/datatables.net-buttons/js/buttons.colVis.js"></script>
<script src="<?=base_url()?>asset/vendor/datatables.net-buttons/js/buttons.flash.js"></script>
<script src="<?=base_url()?>asset/vendor/datatables.net-buttons/js/buttons.html5.js"></script>
<script src="<?=base_url()?>asset/vendor/datatables.net-buttons/js/buttons.print.js"></script>
<script src="<?=base_url()?>asset/vendor/datatables.net-keytable/js/dataTables.keyTable.js"></script>
<script src="<?=base_url()?>asset/vendor/datatables.net-responsive/js/dataTables.responsive.js"></script>
<script src="<?=base_url()?>asset/vendor/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
<!-- bootstrap datepicker -->
<script src="<?=base_url()?>assets/vendor_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.19/pagination/input.js"></script>


<?php $this->load->view('admin/airdrop/modal'); ?>



<script>
    var csrf_token_name = "<?=$this->security->get_csrf_token_name()?>";
    var csrf_token_value = "<?=$this->security->get_csrf_hash()?>";

    var token_price = <?=$token_price?>;
    var discount_rate = <?=$discount_rate?>;

    function payout(id) {
        var sendParams={id: id};
        sendParams[csrf_token_name] = csrf_token_value;
        $.post("<?=base_url()?>admin/ICO/payout",
            sendParams,
            function (data) {
                data = JSON.parse(data);
                console.log('payout result: ' + data);
                if (data.success == 1) {
                    reloadTable()
                }else{
                    alert('failed');
                }
                csrf_token_name = data.csrf_token_name;
                csrf_token_value = data.csrf_token_value;
            }
        ).fail(function() {
            alert( "Failed!  Refresh and try again!" );
        });
    };

    function onChangePrice(id){
        var price = $("#field_price_amount_" + id).val();
        $("#field_payout_amount_" + id).val((price / discount_rate).toFixed( 6 ));
    }

    function onUpdateTransaction(payment_method, id) {
        var sendParams={
            id: id,
            'guarantee_date' : $('#field_guarantee_date_' + id).val(),
            'guarantee_price' : $('#field_guarantee_price_' + id).val(),
            'receive_currency' : $('#field_receive_currency_' + id).val(),
            'receive_amount' : $('#field_receive_amount_' + id).val(),
            'price_currency' : $('#field_price_currency_' + id).val(),
            'price_amount' : $('#field_price_amount_' + id).val(),
            'payout_amount' : $('#field_payout_amount_' + id).val(),
            'payout_hash' : $('#field_payout_hash_' + id).val(),
            'payout_at' : $('#field_payout_at_' + id).val(),

            'status' : $('#field_change_status_' + id).val(),
            'payout_status' : $('#field_change_payout_status_' + id).val(),
        };
        sendParams[csrf_token_name] = csrf_token_value;
        $.post("<?=base_url()?>admin/ICO/updateTransaction",
            sendParams,
            function (data) {
                data = JSON.parse(data);
                console.log('save result: ' + data);
                if (data.success == 1) {
                    reloadTable();
                }else{
                    alert('failed');
                }
                csrf_token_name = data.csrf_token_name;
                csrf_token_value = data.csrf_token_value;
            },
        ).fail(function() {
            alert( "Not updated!  Refresh and try again!" );
        });
    };

    function reloadTable(){
        ajax_datatable.api().ajax.reload(null, false);
    }

	var ajax_datatable;
	(function (window, document, $, undefined) {
		$(function () {
			ajax_datatable = $("#Ajax_DataTable").dataTable({
				"processing": true,
				"serverSide": true,
	            "pagingType": "input",
            "ordering": false,
				"language": {
					"searchPlaceholder": 'Search by email',
				},
                "ajax": {
                    "url" : "<?=base_url()?>admin/ICO/getICOTransactionData",
                    "type" : "get",
                    "data": function(d) {
                        d.filter_username = $('#filter_username').val();
                    }
                },
				"columns": [
                    {"data": "no"},
                //- user info
                    {'data': 'field_username'},
                    {'data': 'field_email'},
                    {'data': 'field_kyc_status'},
                //- order info
                    {'data': 'field_payout_amount'},
                    {'data': 'field_price_amount'},
                    {'data': 'field_created_at'},
                //- guarantee info
                    {'data': 'field_guarantee_flag'},
                    {'data': 'field_guarantee_date'},
                    {'data': 'field_guarantee_price'},
                //- payment
                    {'data': 'field_payment_method'},
                    {'data': 'field_payment_currency'},
                    {'data': 'field_payment_amount'},
                    {'data': 'field_payment_details'},
                    {'data': 'field_payment_status'},
                //- receive
                    {'data': 'field_receive_currency'},
                    {'data': 'field_receive_amount'},
                //- payout
                    {'data': 'field_payout_status'},
                    {'data': 'field_payout_hash'},
                    {'data': 'field_payout_at'},
                //- action
                    {'data': 'field_change_status_action'},
                    {'data': 'field_change_payout_status_action'},
                    {'data': 'field_save_action'},
                    {'data': 'field_payout_action'},
                ],
                "drawCallback": function( settings ) {
                    $('.datepicker').datepicker({
                        autoclose: true
                    });
                },
			});

            $('#filter_username').change( function() {
                ajax_datatable.api().ajax.reload();
            } );
		});
	})(window, document, window.jQuery);

</script>

<?php $this->load->view('admin/layout/footer'); ?>
