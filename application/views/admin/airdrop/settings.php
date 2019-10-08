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
        <div>Settings
        </div>
    </div>
    <!-- START row-->
    <div class="row">
        <div class="col-md-6">
			<!-- START card-->
			<div class="card card-default">
				<div class="card-header profile_content">ICO Settings</div>
				<div class="card-body">
                    
                    <?php echo form_open(base_url().'admin/airdrop/settings'); ?>
						<div class="form-group">
							<label class="text-muted" for="price">Token Price</label>
							<div class="input-group with-focus">
								<input  step="any" value="<?=$price?>" name="price" class="form-control border-right-0" id="price" type="number" placeholder="ICO token price" autocomplete="off" required>
								<div class="input-group-append">
								<span class="input-group-text text-muted bg-transparent border-left-0">$</span>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="text-muted" for="discount">Discount Rate</label>
							<div class="input-group with-focus">
								<input  step="any" value="<?=$discount?>" name="discount" class="form-control border-right-0" id="discount" type="number" placeholder="ICO Discount Rate" autocomplete="off" required>
								<div class="input-group-append">
								<span class="input-group-text text-muted bg-transparent border-left-0">/</span>
								</div>
							</div>
						</div>
						<div class="row">
							<button class="offset-md-5 btn btn-oval btn-primary" type="submit">Update</button>
						</div>
					</form>
				</div>
			</div>
			<!-- END card-->
        </div>
        
    </div>
    <!-- START row-->
    <div class="row">
        <div class="col-md-6">
			<!-- START card-->
			<div class="card card-default">
				<div class="card-header profile_content">Supported Countries for MLM</div>
				<div class="card-body">
                    
                    <?php echo form_open(base_url().'admin/MLM/addCountry'); ?>
						<div class="form-group">
							<label class="text-muted" for="price">Add New Country: </label>
                            <input type="text" class="form-control" name="new_country" id="new_country" readonly required>
                            <input type="hidden" name="new_country_code" id="new_country_code" required>
						</div>
						<div class="form-group">
							<label class="text-muted" for="discount">Supported Countries: </label>
                            <select id="supported" size="10" style="width: 100%">
                            </select>
						</div>
						<div class="row">
							<button id="btn_add_country" class="offset-md-5 btn btn-oval btn-primary" type="submit">Add</button>
						</div>
					</form>
				</div>
			</div>
			<!-- END card-->
        </div>

        <div class="col-md-6">
			<!-- START card-->
			<div class="card card-default">
				<div class="card-header profile_content">MLM Commission Rate of each Level </div>
				<div class="card-body">
                    <?php echo form_open(base_url().'admin/MLM/updateLevelCommissions'); ?>
                        <?php for($i = 0; $i < $treeHeight; $i++) {
                            $nameField = "level_commissions[$i]"?>
                            <div class="form-group">
                                <label class="text-muted" for="<?=$nameField?>">Level <?=$i + 1?>: </label>
                                <div class="input-group with-focus">
                                    <input step="any" value="<?=empty($levelCommissions[$i]) ? 0 : $levelCommissions[$i]?>" name="<?=$nameField?>" class="form-control border-right-0" id="<?=$nameField?>" type="number" autocomplete="off" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text text-muted bg-transparent border-left-0">%</span>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
						<div class="row">
							<button id="btn_add_country" class="offset-md-5 btn btn-oval btn-primary" type="submit">Save</button>
						</div>
					</form>
				</div>
			</div>
			<!-- END card-->
        </div>
    </div>
    <!-- END row-->
</div>

<!-- country selector -->
<script src="<?=base_url()?>assets/vendor_components/country-select-js-master/build/js/countrySelect.min.js"></script>

<?php $this->load->view('admin/layout/footer'); ?>

<script>
var supported = <?=$supported?>;
(function(window, document, $, undefined) {
    $(function() {
        $("#new_country").countrySelect({
            excludeCountries: supported
        });

        $("#btn_add_country").click(function(e){
            const selectedCountryData = $("#new_country").countrySelect("getSelectedCountryData");
            $("#new_country_code").val(selectedCountryData.iso2);
        });

        var countryData = $.fn.countrySelect.getCountryData();
        var i, j;
        for(i = 0; i < supported.length; i++){
            for(j = 0; j < countryData.length; j++){
                if(countryData[j].iso2 === supported[i]){
                    $('#supported').append(`<option>${countryData[j].name}</option>`)
                    break;
                }
            }
        }

    });
})(window, document, window.jQuery);
</script>