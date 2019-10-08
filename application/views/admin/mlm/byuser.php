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
        <div>MLM Report of <?=$user->username?>
            <small>Status and list of referred people.</small>
        </div>
    </div>
    <!-- START row-->
    <div class="row">
        <div class="col-md-12">
            <!-- START card-->
            <div class="card card-default">
                <div class="card-header">Report</div>
                <div class="card-body">
                    <!-- <input type="text" id="filter_username" placeholder="search by username"> -->
                    <div class="row">
                        <div class="col-md-6">
                            <h3>Full Name: <?=$user->first_name.' '.$user->second_name?></h3>
                        </div>
                        <div class="col-md-6" style="display: inline-flex">
                            <h3>Country: </h3>
                            <input type="text" class="form-control" id="country" placeholder="Not Specified" readonly disabled>
                        </div>
                        <div class="col-md-6">
                            <h3>Total People Referred: <?=$totalPeopleCount?></h3>
                        </div>
                        <div class="col-md-6">
                            <h3>Total Commission Earned: <?=$totalCommission?></h3>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped" id="Main_Table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Level</th>
                                    <th>Username</th>
                                    <th>email</th>
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
                                        <td><?=$child['email']?></td>
                                        <td><?=$child['reward']?></td>
                                        <td><?=$child['commission']?></td>
                                    </tr>
                                <?php }?>
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

(function(window, document, $, undefined) {
    $(function() {
        $("#country").countrySelect();
        $("#country").countrySelect('selectCountry', '<?=$user->country_code?>');
    });
})(window, document, window.jQuery);

</script>