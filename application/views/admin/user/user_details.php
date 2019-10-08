<?php $this->load->view('admin/layout/header'); ?>

<!-- Datatables-->
<link rel="stylesheet" href="<?=base_url()?>asset/vendor/datatables.net-bs4/css/dataTables.bootstrap4.css">
<link rel="stylesheet" href="<?=base_url()?>asset/vendor/datatables.net-keytable-bs/css/keyTable.bootstrap.css">
<link rel="stylesheet" href="<?=base_url()?>asset/vendor/datatables.net-responsive-bs/css/responsive.bootstrap.css">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
<style>
.proof{
    width:100%
}
</style>
<!-- Page content-->
<div class="content-wrapper">
    <div class="content-heading">
        <div>User
            <small>User Information</small>
        </div>
    </div>
    <!-- START row-->
    <div class="row">
        <div class="col-md-12">
            <!-- START card-->
            <div class="card card-default">
                <div class="card-header">User Information</div>
                <div class="card-body">
                    <div class="row">
                        <!-- ICO data -->
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="text-bold col-4 col-form-label text-right">Avatar</label>
                                <div class="image col-8">
                                    <img src="<?=base_url()?>asset/uploads/<?=$user->avatar?>" alt="User Image">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="text-bold col-4 col-form-label text-right">Full Name</label>
                                <div class="col-8">
                                    <label class="col-form-label"><?=$user->first_name . " " . $user->second_name?></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="text-bold col-4 col-form-label text-right">Gender</label>
                                <div class="col-8">
                                    <label class="col-form-label"><?=$user->gender?></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="text-bold col-4 col-form-label text-right">Date of Birth</label>
                                <div class="col-8">
                                    <label class="col-form-label"><?=$user->birth?></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="text-bold col-4 col-form-label text-right">Phone</label>
                                <div class="col-8">
                                    <label class="col-form-label"><?=$user->phone?></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="text-bold col-4 col-form-label text-right">Country</label>
                                <div class="col-8">
                                    <label class="col-form-label"><?=$user->country?></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="text-bold col-4 col-form-label text-right">Address</label>
                                <div class="col-8">
                                    <label class="col-form-label"><?=$user->address?></label>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row">
                                <label class="text-bold col-4 col-form-label text-right">Total Airdrop Reward(CSR)</label>
                                <div class="col-8">
                                    <label class="col-form-label"><?=$user->total_score + $user->sent_score?></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="text-bold col-4 col-form-label text-right">Sent in August</label>
                                <div class="col-8">
                                    <label class="col-form-label"><?=$user->sent_score?></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="text-bold col-4 col-form-label text-right">Newly Sent</label>
                                <div class="col-8">
                                    <label class="col-form-label"><?=$user->later_score?></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="text-bold col-4 col-form-label text-right">Pending</label>
                                <div class="col-8">
                                    <label class="col-form-label"><?=$user->total_score - $user->later_score?></label>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row">
                                <label class="text-bold col-4 col-form-label text-right">Purchased ICO token(SREUR)</label>
                                <div class="col-8">
                                    <label class="col-form-label"><?=$user->total_ico_token?></label>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-horizontal">
                                <div class="form-group row">
                                    <label class="text-bold col-4 col-form-label text-right">User Name</label>
                                    <div class="col-8">
                                        <label class="col-form-label"><?=$user->username?></label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="text-bold col-4 col-form-label text-right">Email</label>
                                    <div class="col-8">
                                        <label class="col-form-label"><?=$user->email?></label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="text-bold col-4 col-form-label text-right">ETH Address</label>
                                    <div class="col-8">
                                        <label class="col-form-label">
                                            <a href="https://etherscan.io/address/<?=$user->eth_address?>" target="_blank"><?=$user->eth_address?></a></label>
                                    </div>
                                    <div class="col-4">
                                    </div>
                                    <div class="col-8">
                                        <input type="text" id="new_wallet" class="form-control" value="<?=$user->eth_address?>"></input>
                                        <input type="hidden" name="user_id" value="<?=$user->user_id?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="text-bold col-4 col-form-label text-right">Qualification</label>
                                    <div class="col-8">
                                        <div id="rateYo"></div>
                                        <input type="hidden" id="new_qualification" value="<?=$user->qualification?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <button type="submit" id="btn_update_data" class="btn btn-primary mx-auto">Update</button>
                                </div>
                                
                                <!-- <div class="form-group row">
                                    <label class="text-bold col-4 col-form-label text-right">Status</label>
                                    <div class="col-8">
                                        <label class="col-form-label"><?=$status [$user->activated]?></label>
                                    </div>
                                </div> -->
                                <hr>
                                <?php
                                foreach(C_TABS as $tabId => $tabName) { ?>
                                <div class="form-group row">
                                    <label class="text-bold col-4 col-form-label text-right"><?=$tabName?> account</label>
                                    <div class="col-8">
                                        <label class="col-form-label"><?=isset($user->social_accounts [$tabName]) ? $user->social_accounts [$tabName] : ""?></label>
                                    </div>
                                </div>
                                <?php }?>
                                <hr>
                                
                                <!-- <div class="form-group row">
                                    <div class="col-md-10">
                                        <a href="<?=base_url()?>admin/user"><button class="btn btn-info">Back to List</button></a>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>

                    <!-- KYC Control -->
                    <h1 class="text-center text-lg">KYC Documents</h1>

                    <div class="row">

                        <div class="col-md-4">
                            <h3><strong>Proof of Identity</strong></h3>
                            <p><?=$user->identity_proof_type?></p>
                            <?php if(!empty($user->identity_proof)) { ?>
                                <a href="<?=base_url().'asset/uploads/individual/'.$user->identity_proof?>"  target="_blank">
                                    <?php if(strpos($user->identity_proof, '.pdf') !== false) { ?>
                                        <img class="proof" src="<?=base_url().'asset/img/pdf_icon.png'?>"
                                        alt="<?=$user->identity_proof_type?>">
                                    <?php } else {?>
                                        <img class="proof" src="<?=base_url().'asset/uploads/individual/'.$user->identity_proof?>"
                                        alt="<?=$user->identity_proof_type?>" >
                                    <?php } ?>
                                </a>
                            <?php } ?>
                        </div>
                        <div class="col-md-4">
                            <h3><strong>Proof of Address</strong></h3>
                            <p><?=$user->address_proof_type?></p>
                            <?php if(!empty($user->address_proof)) { ?>
                                <a href="<?=base_url().'asset/uploads/individual/'.$user->address_proof?>"  target="_blank">
                                    <?php if(strpos($user->address_proof, '.pdf') !== false) { ?>
                                        <img class="proof" src="<?=base_url().'asset/img/pdf_icon.png'?>"
                                        alt="<?=$user->address_proof_type?>">
                                    <?php } else {?>
                                        <img class="proof" src="<?=base_url().'asset/uploads/individual/'.$user->address_proof?>"
                                        alt="<?=$user->address_proof_type?>" >
                                    <?php } ?>
                                </a>
                            <?php } ?>
                        </div>
                        <div class="col-md-4">
                            <h3><strong>Selfie</strong></h3>
                            <p>Photo</p>
                            <?php if(!empty($user->selfie_proof)) { ?>
                                <a href="<?=base_url().'asset/uploads/individual/'.$user->selfie_proof?>"  target="_blank">
                                    <?php if(strpos($user->selfie_proof, '.pdf') !== false) { ?>
                                        <img class="proof" src="<?=base_url().'asset/img/pdf_icon.png'?>"
                                        alt="Selfie">
                                    <?php } else {?>
                                        <img class="proof" src="<?=base_url().'asset/uploads/individual/'.$user->selfie_proof?>"
                                        alt="Selfie" >
                                    <?php } ?>
                                </a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="text-center">
                        <div class="btn-group">
                            <button id="kyc_btn_reject"  class="btn btn-pill-left  btn-<?=$user->kyc_status == 0 ? '' : 'outline-'?>danger btn-lg" type="button">Reject</button>
                            <button id="kyc_btn_pending" class="btn btn-square     btn-<?=$user->kyc_status == 1 ? '' : 'outline-'?>primary btn-lg" type="button">Pending</button>
                            <button id="kyc_btn_approve" class="btn btn-pill-right btn-<?=$user->kyc_status == 2 ? '' : 'outline-'?>success btn-lg" type="button">Approve</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- END row-->
</div>

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
<script>

var csrf_token_name = "<?=$this->security->get_csrf_token_name()?>";
var csrf_token_value = "<?=$this->security->get_csrf_hash()?>";

function isAddress(address) {
    if (!/^(0x)?[0-9a-f]{40}$/i.test(address)) {
        // check if it has the basic requirements of an address
        return false;
    } else if (/^(0x)?[0-9a-f]{40}$/.test(address) || /^(0x)?[0-9A-F]{40}$/.test(address)) {
        // If it's all small caps or all all caps, return true
        return true;
    } else {
        //return false;
        // Otherwise check each case
        // return isChecksumAddress(address);
        return   true;
    }
}


function updateUserData(){
    
    // $.post(
    //     "<?=base_url()?>admin/user/changeKYCStatus",
    //     sendParams, 
    //     function(data){
    //         location.reload();
    //     }
    // );
}

function changeKYCStatus(decision){
    var sendParams={user_id: <?=$user->user_id?>, decision: decision};
    sendParams[csrf_token_name] = csrf_token_value;
    $.post(
        "<?=base_url()?>admin/user/changeKYCStatus",
        sendParams, 
        function(data){
            location.reload();
        }
    );
}

$(document).ready(function(){
    $("#kyc_btn_reject").on('click', function(){
        changeKYCStatus(0);
    });
    $("#kyc_btn_pending").on('click', function(){
        changeKYCStatus(1);
    });
    $("#kyc_btn_approve").on('click', function(){
        changeKYCStatus(2);
    });

    $('#btn_update_data').click(function(event){
        event.preventDefault();
        let newAddress = $('#new_wallet').val();
        if(!isAddress(newAddress)){
            alert('Please enter valid Ethereum ERC20 compatible address.');
            return false;
        }

        var sendParams={user_id: <?=$user->user_id?>,
                        new_wallet: $('#new_wallet').val(),
                        new_qualification: $("#new_qualification").val(),};
        sendParams[csrf_token_name] = csrf_token_value;

        $.post(
            "<?=base_url()?>admin/user/updateUserData",
            sendParams,
            function(data){
                var response = JSON.parse(data);
                if(response.success == true){
                    alert('success');
                }else{
                    alert(response.errormsg);
                }
                location.reload();
            }
        );
    });

    $("#rateYo").rateYo({
        rating: <?=$user->qualification?>,
        fullStar: true,
        numStars: 10,
        maxValue: 10
    }).on("rateyo.set", function (e, data) {
        $("#new_qualification").val(data.rating);
    });
});
</script>

<?php $this->load->view('admin/layout/footer'); ?>
