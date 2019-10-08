<?php $this->load->view('admin/layout/header'); ?>

<!-- Datatables-->
<link rel="stylesheet" href="<?=base_url()?>asset/vendor/datatables.net-bs4/css/dataTables.bootstrap4.css">
<link rel="stylesheet" href="<?=base_url()?>asset/vendor/datatables.net-keytable-bs/css/keyTable.bootstrap.css">
<link rel="stylesheet" href="<?=base_url()?>asset/vendor/datatables.net-responsive-bs/css/responsive.bootstrap.css">


<!-- Page content-->
<div class="content-wrapper">
    <div class="content-heading">
        <div>Login Failures
            <small>History of failed login attempts</small>
        </div>
    </div>
    <!-- START row-->
    <div class="row">
        <div class="col-md-12">
            <!-- START card-->
            <div class="card card-default">
                <div class="card-header">Login Failures</div>
                    <div class="card-body">
                        <table class="table table-striped" id="Ajax_DataTables">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Email</th>
                                    <th>Attempt Time</th>
                                    <th>Banned Until</th>
                                    <th>IP Address</th>
                                    <th>Browser</th>
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
<script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.19/pagination/input.js"></script>

<script>
var ajax_datatable;
(function(window, document, $, undefined) {
    $(function() {
        ajax_datatable = $("#Ajax_DataTables").dataTable({
            "processing": true,
            "serverSide": true,
	        "pagingType": "input",
            // "ordering": false,
            "ajax": {
                "url" : "<?=base_url()?>admin/LoginFailure/getFailureData",
                "type" : "get",
            },
            "language": {
                "searchPlaceholder": 'Search by Email/IP',
            },
            "columns": [
                { "data": "no" },
                { "data": "email" },
                { "data": "attempt_time" },
                { "data": "until_time" },
                { "data": "ip" },
                { "data": "useragent" },
            ]
        });
    });
})(window, document, window.jQuery);
</script>

<?php $this->load->view('admin/layout/footer'); ?>
