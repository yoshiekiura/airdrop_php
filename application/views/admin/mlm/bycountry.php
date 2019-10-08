<?php $this->load->view('admin/layout/header'); ?>

<!-- Datatables-->
<link rel="stylesheet" href="<?=base_url()?>asset/vendor/datatables.net-bs4/css/dataTables.bootstrap4.css">
<link rel="stylesheet" href="<?=base_url()?>asset/vendor/datatables.net-keytable-bs/css/keyTable.bootstrap.css">
<link rel="stylesheet" href="<?=base_url()?>asset/vendor/datatables.net-responsive-bs/css/responsive.bootstrap.css">

<!-- country selector -->
<link rel="stylesheet" href="<?=base_url()?>assets/vendor_components/country-select-js-master/build/css/countrySelect.min.css">

<!-- Page content-->
<div class="content-wrapper">
    <div class="content-heading">
        <div>MLM Report by Country
            <small>User list by country.</small>
        </div>
    </div>
    <!-- START row-->
    <div class="row">
        <div class="col-md-12">
            <!-- START card-->
            <div class="card card-default">
                <div class="card-header">User List</div>
                <div class="card-body">
                    <label for="filter_country">Search By Supported Country: </label>
                    <input name="country" id="country" readonly>
                    <div class="row">
                        <div class="col-md-6">
                            <h3>Number of customers: <span id="sigmaPeople">---</span> </h3>
                        </div>
                        <div class="col-md-6">
                            <h3>Total Commission: <span id="sigmaCommission">---</span></h3>
                        </div>
                    </div>
                    <!-- <input type="text" id="filter_username" placeholder="search by username"> -->
                    <div class="table-responsive">
                        <table class="table table-striped" id="Main_Table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Referrer</th>
                                    <th>People Referreed</th>
                                    <th>Commission Earned</th>
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
<!-- country selector -->
<script src="<?=base_url()?>assets/vendor_components/country-select-js-master/build/js/countrySelect.min.js"></script>


<script>
var ajax_datatable;
var csrf_token_name = "<?=$this->security->get_csrf_token_name()?>";
var csrf_token_value = "<?=$this->security->get_csrf_hash()?>";
var supported = <?=$supported?>;

function getCurSelCountry(){
    const selectedCountryData = $("#country").countrySelect("getSelectedCountryData");
    return selectedCountryData.iso2;
}

function fetchCountryStatus(){
    $.getJSON("<?=base_url()?>admin/MLM/getStatusByCountry?country_code=" + getCurSelCountry(), function(data){
        console.log(data);
        $("#sigmaPeople").text(data.sigmaPeople);
        $("#sigmaCommission").text(Number(data.sigmaCommission).toFixed(5));
    });
}

(function(window, document, $, undefined) {
    $(function() {
        
        $('#country').change( function() {
            ajax_datatable.api().ajax.reload();
            fetchCountryStatus();
        } );

        $("#country").countrySelect({
            onlyCountries: supported
        });

        fetchCountryStatus();

        ajax_datatable = $("#Main_Table").dataTable({
            "processing": true,
            "serverSide": true,
	        "pagingType": "input",
            "ordering": false,
            "ajax": {
                "url" : "<?=base_url()?>admin/MLM/getReportByCountry/",
                "type" : "get",
                "data": function(d) {
                    d.filter_country = getCurSelCountry();
                }
            },
            "language": {
                "searchPlaceholder": 'Search by email',
            },
            "columns": [
                { "data": "no" },
                { "data": "username" },
                { "data": "email" },
                { "data": "referrer" },
                { "data": "total_people" },
                { "data": "total_commission" },
            ]
        });

    });
})(window, document, window.jQuery);

// function changeStatus(id) {
//     var sendParams = {};
//     sendParams[csrf_token_name] = csrf_token_value;
//     $.post("<?=base_url()?>admin/user/changeStatus/" + id,
//         sendParams,
//         function(data) {
//             ajax_datatable.fnClearTable();
//             data = JSON.parse(data);
//             csrf_token_name = data.csrf_token_name;
//             csrf_token_value = data.csrf_token_value;
//         }
//     );
// }
</script>