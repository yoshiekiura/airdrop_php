<?php $this->load->view('client/layout/header'); ?>


<!-- Page content-->
<div class="content-wrapper">
    <div class="content-heading">
        <div>Form Elements
            <small>Standard and custom elements for any form</small>
        </div>
    </div>
    <!-- START card-->
    <div class="card card-default">
        <div class="card-header">Inline form</div>
        <div class="card-body">
            <form class="form-inline">
                <label class="sr-only" for="inlineFormInputName2">Name</label>
                <input class="form-control mb-2" id="inlineFormInputName2" type="text" placeholder="Jane Doe">
                <label class="sr-only" for="inlineFormInputGroupUsername2">Username</label>
                <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text">@</div>
                </div>
                <input class="form-control" id="inlineFormInputGroupUsername2" type="text" placeholder="Username">
                </div>
                <div class="checkbox c-checkbox">
                <label>
                    <input type="checkbox">
                    <span class="fa fa-check"></span>Remember</label>
                </div>
                <button class="btn btn-primary mb-2" type="submit">Submit</button>
            </form>
        </div>
    </div>
    <!-- END card-->
    <!-- START row-->
    <div class="row">
        <div class="col-md-6">
            <!-- START card-->
            <div class="card card-default">
                <div class="card-header">Stacked form</div>
                <div class="card-body">
                <form>
                    <div class="form-group">
                        <label>Email address</label>
                        <input class="form-control" type="email" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input class="form-control" type="password" placeholder="Password">
                    </div>
                    <div class="checkbox c-checkbox">
                        <label>
                            <input type="checkbox" checked="">
                            <span class="fa fa-times"></span>Check me out</label>
                    </div>
                    <button class="btn btn-sm btn-secondary" type="submit">Submit</button>
                </form>
                </div>
            </div>
            <!-- END card-->
        </div>
        <div class="col-md-6">
            <!-- START card-->
            <div class="card card-default">
                <div class="card-header">Horizontal form</div>
                <div class="card-body">
                <form class="form-horizontal">
                    <div class="form-group row">
                        <label class="col-xl-2 col-form-label">Email</label>
                        <div class="col-xl-10">
                            <input class="form-control" type="email" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-2 col-form-label">Password</label>
                        <div class="col-xl-10">
                            <input class="form-control" type="password" placeholder="Password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-xl-10">
                            <div class="checkbox c-checkbox">
                            <label>
                                <input type="checkbox" checked="">
                                <span class="fa fa-check"></span>Remember me</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-xl-10">
                            <button class="btn btn-sm btn-secondary" type="submit">Sign in</button>
                        </div>
                    </div>
                </form>
                </div>
            </div>
            <!-- END card-->
        </div>
    </div>
    <!-- END row-->
</div>


<?php $this->load->view('client/layout/footer'); ?>