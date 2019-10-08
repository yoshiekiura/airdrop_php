<?php $this->load->view('admin/layout/header'); ?>

<!-- Datatables-->
<link rel="stylesheet" href="<?=base_url()?>asset/vendor/datatables.net-bs4/css/dataTables.bootstrap4.css">
<link rel="stylesheet" href="<?=base_url()?>asset/vendor/datatables.net-keytable-bs/css/keyTable.bootstrap.css">
<link rel="stylesheet" href="<?=base_url()?>asset/vendor/datatables.net-responsive-bs/css/responsive.bootstrap.css">


<!-- Page content-->
<div class="content-wrapper">
    <div class="content-heading">
        <div>Airdrop
            <small>Airdrop submits</small>
        </div>
    </div>
    <!-- START row-->
    <div class="row">
        <div class="col-md-12">
            <!-- START card-->
            <div class="card card-default">
                <div class="card-header">Airdrop submits</div>
                    <div class="card-body">
                        <input type="text" id="filter_username" placeholder="search by username">
                        <input type="text" id="filter_email" placeholder="search by email">
                        <div class="table-responsive">
                            <table class="table table-striped" id="Main_Table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Actions</th>
					                    <th>Description</th>
                                        <th>Reward</th>
					                    <th>Reviewed</th>
                                        <th>Status</th>
                                        <th>Created At</th>
					                    <th>Note from client</th>
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
<script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.19/pagination/input.js"></script>
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


<?php $this->load->view('admin/airdrop/modal'); ?>


<script>
var ajax_datatable;
var csrf_token_name = "<?=$this->security->get_csrf_token_name()?>";
var csrf_token_value = "<?=$this->security->get_csrf_hash()?>";

(function(window, document, $, undefined) {
    $(function() {
        ajax_datatable = $("#Main_Table").dataTable({
            "processing": true,
            "serverSide": true,
	        "pagingType": "input",
            "language": {
                "searchPlaceholder": 'Search by campaign id',
            },
            "ajax": {
                "url" : "<?=base_url()?>admin/airdrop/getData",
                "type" : "get",
                "data": function(d) {
                    d.filter_username = $('#filter_username').val();
                    d.filter_email = $('#filter_email').val();
                }
            },
            "columns": [
                { "data": "no" },
                { "data": "username" },
                { "data": "email" },
		        { "data": "actions" },
                { "data": "description" },
                { "data": "score" },
        		{ "data": "reviewed" },
                { "data": "status" },
                { "data": "created_at" },
		        { "data": "note" },
            ]
        });

        $('#Main_Table').on( 'draw.dt', function () {
            $(".btn-reject").unbind("click");
            $(".btn-approve").unbind("click");

            $(".btn-reject").bind("click", function() {
                showModal(-1, $(this).attr("data-id"));
                return false;
            });
            $(".btn-approve").bind("click", function() {
                showModal(1, $(this).attr("data-id"));
                return false;
            });
        });

        $('#filter_username').change( function() {
            ajax_datatable.api().ajax.reload();
        } );

	    $('#filter_email').change( function() {
            ajax_datatable.api().ajax.reload();
        } );

        $(".modal-button").bind("click", function(e) {
            var id = $("#airdropModal").attr("data-id");

            var sendParams={
                status: $("#airdropModal").attr("data-status"),
                score: $(".modal-score").val(),
                message: $(".modal-message").val()
            };
            sendParams[csrf_token_name] = csrf_token_value;

            $.post("<?=base_url()?>admin/airdrop/changeSubmitStatus/" + id,
                sendParams,
                function(data) {
                    data = JSON.parse(data);
                    if (data.result != 1) {
                        alert("You can't approve the submit. Max count reached.");
                    }else{
                        $('#airdropModal').modal('hide');
                        ajax_datatable.api().ajax.reload(null, false);    
                    }
                    csrf_token_name = data.csrf_token_name;
                    csrf_token_value = data.csrf_token_value;
                }
            );
        });

        $('#filter_username').click(function(){
            ajax_datatable.api().ajax.reload(null, false);
        });

        $(".checkbox-inline").click(function(){
            var x = "0";
            var id = $("#id").val();
            if ($(".checkbox-inline").is(":checked"))
                x = "1";
            
            var sendParams={
                rv: $(".checkbox-inline").is(":checked") ? "1" : "0",
            };
            sendParams[csrf_token_name] = csrf_token_value;
            $.post("<?=base_url()?>admin/airdrop/setReviewed/" + id,
                sendParams,
                function(data){
                    alert("Submit has been correctly marked as Reviewed.");
                    $('#airdropModal').modal('hide');
                    ajax_datatable.api().ajax.reload(null, false);
                    csrf_token_name = data.csrf_token_name;
                    csrf_token_value = data.csrf_token_value;
                });
        });
    });
})(window, document, window.jQuery);
</script>

<?php $this->load->view('admin/layout/footer'); ?>

