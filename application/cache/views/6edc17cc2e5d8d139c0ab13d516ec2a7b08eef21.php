<?php $__env->startPush("custom_css"); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection("menu-airdrop", "menu-open"); ?>
<?php $__env->startSection("airdrop-campaign", "active"); ?>
<?php $__env->startSection("dropdown-airdrop", "display: block"); ?>

<?php $__env->startSection("content"); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Campaigns
	</h1>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="breadcrumb-item"><a href="#">Airdrop</a></li>
		<li class="breadcrumb-item active">Campaign</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">

	<!-- tabs -->

	<div class="row">
		<div class="col-12">
			<div class="box box-default">
				<!-- <div class="box-header with-border">
              <h3 class="box-title">Default Tab</h3>
              <h6 class="box-subtitle">Use default tab with class <code>nav-tabs &amp; tabcontent-border </code></h6>
            </div> -->
				<!-- /.box-header -->
				<div class="box-body">
					<!-- Nav tabs -->
					<ul class="nav nav-tabs" role="tablist">
                        <?php
                            $tabIcons = [
                                "mdi mdi-telegram", "fa fa-fw fa-twitter", "fa fa-fw fa-facebook", "mdi mdi-reddit",
                                "fa fa-fw fa-linkedin", "fa fa-fw fa-btc", "fa fa-fw fa-medium", "mdi mdi-plus-circle-outline"];
                            for($tabId = 0 ; $tabId < count($campaign_tabs) ; $tabId++){
                                $tabName = $campaign_tabs[$tabId]; ?>
                                <li class="nav-item">
                                    <a class="nav-link <?php echo e($tabId == 0 ? 'active' : ''); ?>" data-toggle="tab" href="#<?php echo e($tabName); ?>" role="tab">
                                        <span class="hidden-sm-up"><i class="<?php echo e($tabIcons[$tabId]); ?>"></i></span>
                                        <span class="hidden-xs-down"><?php echo e($tabId == count($campaign_tabs) - 1 ? "Writing Articles" : $tabName); ?></span>
                                    </a>
                                </li>
                       <?php }?>
					</ul>
					<!-- Tab panes -->
					<div class="tab-content">
                    <?php
                        
                        for($tabId = 0 ; $tabId < count($campaign_tabs) ; $tabId++) {
                            $tabName = $campaign_tabs [$tabId];

                            $errList = array(
                                "",
                                "Done.",
                                "First, Set your $tabName ID in Profile page.",
                                "Set Eth address in profile."
                            );

                    ?>

						<div class="tab-pane <?php echo e($tabId == 0 ? 'active' : ''); ?>" id="<?php echo e($tabName); ?>" role="tabpanel">
							<div class="pad">
								<div class="row">
                                    <?php
                                    for($campId = 0 ; $campId < count($campaign_data) ; $campId++){
                                        $cell = $campaign_data [$campId];
                                        if ($cell ["tab_id"] != $tabId) continue;

                                        $errCode = 0;
                                        if ($campStatus ["count_".$campId] >= $cell ["count"])
                                            $errCode = 1;
                                        else if (!isset($userdata->social_accounts[$tabName])
                                            || $userdata->social_accounts[$tabName] == "")
                                            $errCode = 2;
                                        else if ($userdata->eth_address == "")
                                            $errCode = 3;
                                    ?>
									<!--Join Telegram-->
									<div class="col-md-6 col-12">
										<div class="box pull-up">
											<div class="box-header with-border">
												<h4 class="box-title"><?php echo e($cell['text']); ?></h4>
												<span class="pull-right badge badge-pill badge-success">+<?php echo e($cell ["score"]); ?> CSR</span>
                                            </div>
                                            
                                            <?php echo form_open(base_url().'client/campaign/submit_campaign'); ?>
                                                
                                                <input name="campaign_id" type="hidden" value="<?=$campId?>">

                                                <div class="ribbon-wrapper">
                                                    <div class="ribbon bg-primary" data-toggle="tooltip" title="" data-original-title="<?php echo e(getCampaignCountDesc($cell['count'], $cell['canRepeat'])); ?>">
                                                        <span> <?php echo e($cell ["count"] - $campStatus ["count_".$campId]); ?> </span>
                                                    </div>
                                                    <?php if($errCode && $tabId < count($campaign_tabs) - 1): ?>
                                                    <div class="ribbon ribbon-right ribbon-bookmark <?php echo e($errCode == 1 ? 'bg-success' : 'bg-danger'); ?> ">
                                                        <?php echo e($errList [$errCode]); ?>

                                                    </div>
                                                    <?php endif; ?>
                                                    <div class="ribbon-content">
                                                        <div class="form-group">
                                                            <h5><?php echo e(strpos($cell['text'], 'profile picture') !== false ? 'Download Link' : 'Link'); ?></h5>
                                                            <?php
                                                                $len = strlen($cell['url']);
															    if(!$len){
                                                                    if($errCode==2) $errCode = 0;
                                                            ?>
    														<input type='text' name="url" class="form-control" rows="4" placeholder="Link to your work." required/>
                                                            <?php } else { ?>
                                                            <code>
                                                                <a target="_blank" href="<?php echo e(base_url()); ?>asset/img/SocialRemit_Logo.png" target="_blank" <?php if (strpos($cell['text'], 'profile picture') !== false) echo 'download';?>>
                                                                    <?php echo e($cell['url']); ?>

                                                                </a>
                                                            </code>
                                                            <?php }?>
                                                            
                                                            <!-- <div class="form-control-feedback"><small>Add <code>minlength="6"</code> attribute for minimum number of characters to accept.</small></div> -->
                                                        </div>

                                                        <?php if ($cell['comment']) { ?>
                                                        <div class="form-group">
                                                            <h5>Comments <span class="text-danger">*</span></h5>
                                                            <div class="controls">
                                                                <textarea name="note" id="inputNotes" class="form-control" rows="4" placeholder="<?php echo e($cell['placeholder']); ?>"required></textarea>
                                                            </div>
                                                        </div>
                                                        <?php }?>

                                                    </div>
                                                </div>
                                                <div class="box-footer text-center">
                                                    <div class="row">
														<?php if($cell['url'] != "" && strpos($cell['text'], 'profile picture') == false) {?>
                                                            <div class="col-6 mx-auto">
                                                                <a class="btn btn-block btn-info" href="<?php echo e($cell['url']); ?>" target="_blank">
                                                                <?php echo e($cell['btntext']); ?>

                                                                </a>
                                                                <!-- <button type="submit" class="btn btn-block btn-info">Join Us</button> -->
                                                            </div>
														<?php } ?>
                                                        <div class="col-6 mx-auto">
                                                            <button type="submit" class="btn btn-block btn-success" <?php echo e($errCode == 0 ? "" : "disabled"); ?>>Submit</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
										</div>
									</div>
                                    <!--Join Telegram End-->
                                    <?php } ?>
								</div>
							</div>
                        </div>
                    <?php 
                        }
                    ?>
						<!-- <div class="tab-pane pad" id="twitter" role="tabpanel">2</div>
						<div class="tab-pane pad" id="facebook" role="tabpanel">3</div> -->
					</div>
				</div>
				<!-- /.box-body -->
			</div>
			<!-- /.box -->
		</div>
		<!-- /.col -->

	</div>
	<!-- /.row -->
	<!-- END tabs -->

</section>
<!-- /.content -->
<?php $__env->stopSection(); ?>

<?php $__env->startPush('plugin_js'); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('custom_js'); ?>

<?php $__env->stopPush(); ?>

<?php echo $__env->make("client.layout.master", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>