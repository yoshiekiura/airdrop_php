<?php $this->load->view('client/layout/header'); ?>

<!-- Datatables-->
<link rel="stylesheet" href="<?=base_url()?>asset/vendor/datatables.net-bs4/css/dataTables.bootstrap4.css">
<link rel="stylesheet" href="<?=base_url()?>asset/vendor/datatables.net-keytable-bs/css/keyTable.bootstrap.css">
<link rel="stylesheet" href="<?=base_url()?>asset/vendor/datatables.net-responsive-bs/css/responsive.bootstrap.css">
<!-- Spinkit-->
<link rel="stylesheet" href="<?=base_url()?>asset/vendor/spinkit/css/spinkit.css">
<style>
.sk-three-bounce .sk-child {
    background-color: rgba(255, 255, 255, 0.9) !important;
}
</style>

<!-- Page content-->
<div class="content-wrapper">
    <div class="content-heading">
        <div>Submissions
            <small>Submission history</small>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <!-- START card-->
            <div class="card bg-success-dark border-0">
                <div class="row align-items-center mx-0">
                    <div class="col-2 text-center">
                        <div class="sk-three-bounce">
                           <div class="sk-child" id="sk-bounce1"></div>
                           <div class="sk-child" id="sk-bounce2"></div>
                           <div class="sk-child" id="sk-bounce3"></div>
                        </div>
                        
                    </div>
                    <div class="col-10 py-4 bg-success rounded-right">
                        <div class="h1 m-0 text-center text-bold">Thanks for supporting us!</div>
                        <div class="text-md text-center m-0">
                            <p>We are now receiving thousands of submissions every hour.</p>
                            <p>Therefore, your submissions may take some days to be reviewed.</p>
                            <p>We are sending tokens INSTANTLY after review, unlike other platforms.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- START row-->
    <div class="row">
        <div class="col-md-12">
            <!-- START card-->
            <div class="card card-default">
                <div class="card-header">Status of your submissions</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="Ajax_DataTables">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Description</th>
                                        <th>Note</th>
                                        <th>Reward</th>
                                        <th>Message From Admin</th>
                                        <th>Status</th>
                                        <th>Created At</th>
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


<?php $this->load->view('client/layout/footer'); ?>

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


<script>
var ajax_datatable;
(function(window, document, $, undefined) {
    $(function() {
        ajax_datatable = $("#Ajax_DataTables").dataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "<?=base_url()?>client/submits/getData",
            "columns": [
                { "data": "no" },
                { "data": "description" },
				{ "data": "note" },
				{ "data": "score" },
				{ "data": "message" },
                { "data": "status" },
                { "data": "created_at" },
            ]
        });
    });
})(window, document, window.jQuery);
</script>
