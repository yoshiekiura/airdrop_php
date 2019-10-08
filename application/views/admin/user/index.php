<?php $this->load->view('admin/layout/header'); ?>

<!-- Datatables-->
<link rel="stylesheet" href="<?=base_url()?>asset/vendor/datatables.net-bs4/css/dataTables.bootstrap4.css">
<link rel="stylesheet" href="<?=base_url()?>asset/vendor/datatables.net-keytable-bs/css/keyTable.bootstrap.css">
<link rel="stylesheet" href="<?=base_url()?>asset/vendor/datatables.net-responsive-bs/css/responsive.bootstrap.css">


<!-- Page content-->
<div class="content-wrapper">
    <div class="content-heading">
        <div>User Management
            <small>Manage users information.</small>
        </div>
    </div>
    <!-- START row-->
    <div class="row">
        <div class="col-md-12">
            <!-- START card-->
            <div class="card card-default">
                <div class="card-header">User List</div>
                <div class="card-body">
                    <label for="filter_kyc_status">Search By KYC Status: </label>
                    <select name="filter_kyc_status" id="filter_kyc_status">
                        <option value="">Any</option>
                        <option value="0">Not Passed</option>
                        <option value="1">Pending</option>
                        <option value="2">Passed</option>
                    </select>
                    <input type="text" id="filter_username" placeholder="search by username">
                    <div class="table-responsive">
                        <table class="table table-striped" id="Main_Table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>ETH Address</th>
                                    <th>User Type</th>
                                    <th>Status</th>
                                    <th>KYC Status</th>
                                    <th>Qualification</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- END card-->
        </div>
    </div>
    <!-- END row-->
</div>


<?php $this->load->view('admin/layout/footer'); ?>

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
            "ordering": false,
            "ajax": {
                "url" : "<?=base_url()?>admin/user/getUserList",
                "type" : "get",
                "data": function(d) {
                    d.filter_kyc_status = $('#filter_kyc_status').val();
                    d.filter_username = $('#filter_username').val();
                }
            },
            "language": {
                "searchPlaceholder": 'Search by email',
            },
            "columns": [
                { "data": "no" },
                { "data": "username" },
                { "data": "email" },
                { "data": "eth_address" },
                { "data": "usertype" },
                { "data": "status" },
                { "data": "kyc_status" },
                { "data": "qualification" },
                { "data": "actions" },
            ]
        });

        $('#Main_Table').on( 'draw.dt', function () {
            $(".btn-changeStatus").unbind("click");
            
            $(".btn-changeStatus").bind("click", function() {
                changeStatus($(this).attr("data-id"));
                return false;
            });
        });

        $('#filter_kyc_status').change( function() {
            ajax_datatable.api().ajax.reload();
        } );
        $('#filter_username').change( function() {
            ajax_datatable.api().ajax.reload();
        } );
    });
})(window, document, window.jQuery);

function changeStatus(id) {
    var sendParams = {};
    sendParams[csrf_token_name] = csrf_token_value;
    $.post("<?=base_url()?>admin/user/changeStatus/" + id,
        sendParams,
        function(data) {
            ajax_datatable.fnClearTable();
            data = JSON.parse(data);
            csrf_token_name = data.csrf_token_name;
            csrf_token_value = data.csrf_token_value;
        }
    );
}
</script>