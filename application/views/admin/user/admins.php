<?php $this->load->view('admin/layout/header'); ?>

<!-- Datatables-->
<link rel="stylesheet" href="<?= base_url() ?>asset/vendor/datatables.net-bs4/css/dataTables.bootstrap4.css">
<link rel="stylesheet" href="<?= base_url() ?>asset/vendor/datatables.net-keytable-bs/css/keyTable.bootstrap.css">
<link rel="stylesheet" href="<?= base_url() ?>asset/vendor/datatables.net-responsive-bs/css/responsive.bootstrap.css">


<!-- Page content-->
<div class="content-wrapper">
    <div class="content-heading">
        <div>Administrators Management
            <small>Manage information of administrators.</small>
        </div>
    </div>
    <!-- START row-->
    <div class="row">
        <div class="col-md-12">
            <!-- START card-->
            <div class="card card-default">
                <div class="card-header">Administrator List</div>
                <div class="card-body">
                    <div class="pull-right">
                        <label for="filter_by_role">Search By Roles: </label>
                        <select name="filter_by_role" id="filter_by_role">
                            <option value="">Any</option>
                            <?php
                                foreach( ADMIN_ROLE_NAMES as $index => $value ){
                                    echo "<option value='$index'>$value</option>";
                                }
                            ?>
                        </select>
                    </div>

                    <button class="btn btn-success" id="btn_create_new"><i class='fa fa-plus'></i> Create New</button>
                    
                    <div class="table-responsive">
                        <table class="table table-striped" id="Main_Table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Comment</th>
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

<div id="adminInfoModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalTitle">Edit Admin Info</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </div>

            <div class="modal-body">
                <form class="form" id="adminInfoForm">
                    <input type="hidden" name="id" id="id_field" value="">
                    <div class="form-group">
                        <label for="email_field">Email</label>
                        <input class="form-control" id="email_field" name="email" type="email" readonly = "true"/>
                    </div>
                    <div class="form-group">
                        <input class="" id="flag_change_password" name="flag_change_password" type="checkbox"/>
                        <label for="flag_change_password">Change Password</label> <br>
                        <div id="password_fields">
                            <label for="new_password">New Password</label>
                            <input class="form-control" id="new_password" name="new_password" type="password" autocomplete="nope"/>
                            <label for="confirm_password">Confirm Password</label>
                            <input class="form-control" id ="confirm_password" name="confirm_password" type="password" autocomplete="nope"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <p>Enable/Ban this Admin</p>
                        <input type="radio" name="status" id="status_active" value="1">
                        <label for="status_active">Active</label> <br>
                        <input type="radio" name="status" id="status_banned" value="0">
                        <label for="status_banned">Banned</label>
                    </div>
                    <div class="form-group">
                        <p>Change Role of this Admin</p>
                        <?php
                            foreach( ADMIN_ROLES as $index => $value ){
                                echo "<input type='radio' name='role' id='role_$value' value='$value'>";
                                echo "<label for='role_$value'> ".ADMIN_ROLE_NAMES[$value]."</label> <br>";
                            }
                        ?>
                    </div>
                    <div class="form-group">
                        <label for="note_field">Comment</label>
                        <textarea class="form-control" id="comment_field" name="comment" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button class="btn btn-primary modal-button" type="button" id="dialog_okay_btn">OK</button>
            </div>
        </div>
    </div>
</div>


<!-- Datatables-->
<script src="<?= base_url() ?>asset/vendor/datatables.net/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.19/pagination/input.js"></script>
<script src="<?= base_url() ?>asset/vendor/datatables.net-bs4/js/dataTables.bootstrap4.js"></script>
<script src="<?= base_url() ?>asset/vendor/datatables.net-buttons/js/dataTables.buttons.js"></script>
<script src="<?= base_url() ?>asset/vendor/datatables.net-buttons-bs/js/buttons.bootstrap.js"></script>
<script src="<?= base_url() ?>asset/vendor/datatables.net-buttons/js/buttons.colVis.js"></script>
<script src="<?= base_url() ?>asset/vendor/datatables.net-buttons/js/buttons.flash.js"></script>
<script src="<?= base_url() ?>asset/vendor/datatables.net-buttons/js/buttons.html5.js"></script>
<script src="<?= base_url() ?>asset/vendor/datatables.net-buttons/js/buttons.print.js"></script>
<script src="<?= base_url() ?>asset/vendor/datatables.net-keytable/js/dataTables.keyTable.js"></script>
<script src="<?= base_url() ?>asset/vendor/datatables.net-responsive/js/dataTables.responsive.js"></script>
<script src="<?= base_url() ?>asset/vendor/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>

<script>
    var ajax_datatable;
    var csrf_token_name = "<?= $this->security->get_csrf_token_name() ?>";
    var csrf_token_value = "<?= $this->security->get_csrf_hash() ?>";

    var sel_id, sel_role, sel_status, sel_email;

    function clearFormContent(){
        $('#new_password').val("");
        $('#confirm_password').val("");
        $('#email_field').val("");
        $('#comment_field').val("");
        $("#dialog_okay_btn").unbind('click');
        enableOkayButton();
    }

    function makeEditModal(){
        clearFormContent();
        $("#flag_change_password").attr('disabled', false);
        $("#modalTitle").text("Edit Admin Info");
        $("#email_field").attr("readonly", true);
        $("#dialog_okay_btn").text("Save Changes");
        $("#dialog_okay_btn").click(saveChanges);
    }

    function makeAddModal(){
        clearFormContent();
        if(!$("#flag_change_password").attr('checked')){
            $("#flag_change_password").click();
            $("#flag_change_password").attr('disabled', true);
        }

        $("#modalTitle").text("Create New Admin");
        $("#email_field").attr("readonly", false);
        $("#dialog_okay_btn").text("Create");
        $("#dialog_okay_btn").click(createAdmin);
    }

    function disableOkayButton(){
        $("#dialog_okay_btn").prop("disabled",true);
    }

    function enableOkayButton(){
        $("#dialog_okay_btn").prop("disabled",false);
    }

    function showModal(){
        $("#adminInfoModal").modal();
    }

    function hideModal(){
        $("#adminInfoModal").modal('hide');
    }

    //form to json helper
    function objectifyForm(formArray) {//serialize data function
        var returnArray = {};
        for (var i = 0; i < formArray.length; i++){
            returnArray[formArray[i]['name']] = formArray[i]['value'];
        }
        return returnArray;
    }

    function validateEmail(email) {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    }

    //helper
    function reloadTable(){
        ajax_datatable.api().ajax.reload(null, false);
    }


    function saveChanges() {
        var formValues = $("#adminInfoForm").serializeArray();
        formValues = objectifyForm(formValues);
        console.log(formValues);

        //validation
        if(formValues.flag_change_password === "on"){
            if(formValues.new_password.length > 0){
                if(formValues.new_password != formValues.confirm_password){
                    alert("Passwords are mismatching");
                    return;
                }
            }
            else {alert("Enter valid password"); return;}
        }

        disableOkayButton();

        formValues[csrf_token_name] = csrf_token_value;
        $.post("<?=base_url()?>admin/User/updateAdmin",
            formValues,
            function (data) {
                data = JSON.parse(data);
                console.log('save result: ' + data);
                csrf_token_name = data.csrf_token_name;
                csrf_token_value = data.csrf_token_value;
                if (data.success) {
                    reloadTable();
                    hideModal();
                }else{
                    alert('Failed!  Refresh and try again!');
                }
                enableOkayButton();
            },
        ).fail(function() {
            alert( "Not updated!  Refresh and try again!" );
            enableOkayButton();
        });
    }

    function createAdmin() {
        var formValues = $("#adminInfoForm").serializeArray();
        formValues = objectifyForm(formValues);
        console.log(formValues);

        //validation
        if(formValues.new_password.length > 0){
            if(formValues.new_password != formValues.confirm_password){
                alert("Passwords are mismatching");
                return;
            }
        }
        else {alert("Enter valid password"); return;}

        if( !validateEmail(formValues.email) ||
            isNaN(formValues.status) ||
            isNaN(formValues.role)){
                alert("Input is not valid");
                return;
        }

        disableOkayButton();

        formValues[csrf_token_name] = csrf_token_value;
        $.post("<?=base_url()?>admin/User/createAdmin",
            formValues,
            function (data) {
                data = JSON.parse(data);
                console.log('save result: ' + data);
                csrf_token_name = data.csrf_token_name;
                csrf_token_value = data.csrf_token_value;
                if (data.success) {
                    reloadTable();
                    hideModal();
                }else{
                    alert('Failed!  Refresh and try again!');
                }
                enableOkayButton();
            },
        ).fail(function() {
            alert( "Not created!  Refresh and try again!" );
            enableOkayButton();
        });
    }

    (function(window, document, $, undefined) {
        $(function() {
            ajax_datatable = $("#Main_Table").dataTable({
                "processing": true,
                "serverSide": true,
                "ordering": false,

                "paging": false,
                "info": false,

                "ajax": {
                    "url": "<?= base_url() ?>admin/user/getAdminList",
                    "type": "get",
                    "data": function(d) {
                        d.filter_by_role = $('#filter_by_role').val();
                    }
                },
                "language": {
                    "searchPlaceholder": 'Search by email',
                },
                "columns": [{
                        "data": "no"
                    },
                    {
                        "data": "email"
                    },
                    {
                        "data": "role"
                    },
                    {
                        "data": "status"
                    },
                    {
                        "data": "comment"
                    },
                    {
                        "data": "actions"
                    },
                ]
            });

            $('#Main_Table').on('draw.dt', function() {
                $(".btn-edit").unbind("click");

                $(".btn-edit").bind("click", function() {
                    makeEditModal();
                    showModal();

                    sel_id = $(this).attr('data-id');
                    sel_role = $(this).attr('data-role');
                    sel_status = $(this).attr('data-status');
                    sel_email = $(this).attr('data-email');
                    sel_comment = $("#data_comment_" + sel_id).text();

                    $("#id_field").val(sel_id);
                    $("#email_field").val(sel_email);
                    $("#comment_field").val(sel_comment);
                    $("#role_" + sel_role).trigger("click");


                    if(sel_status == 1)     $("#status_active").trigger("click");
                    else                    $("#status_banned").trigger("click");

                });
            });

            $('#filter_by_role').change(function() {
                ajax_datatable.api().ajax.reload();
            });

            $('#flag_change_password').change(function() {
                // this will contain a reference to the checkbox
                if (this.checked) {
                    $('#password_fields').slideDown();
                    // the checkbox is now checked
                } else {
                    $('#password_fields').slideUp();
                    // the checkbox is now no longer checked
                }
            });

            //first time
            $('#password_fields').slideUp();

            $('#btn_create_new').click(() => {
                makeAddModal();
                showModal();
            });
        });
    })(window, document, window.jQuery);

    function changeStatus(id) {
        var sendParams = {};
        sendParams[csrf_token_name] = csrf_token_value;
        $.post("<?= base_url() ?>admin/user/changeStatus/" + id,
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
