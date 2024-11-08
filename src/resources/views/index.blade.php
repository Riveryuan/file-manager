@extends('filemanager::layout.single-column')
@section('pageTitle','用户登录')
@section('content')
    <div class="row justify-content-center align-items-center" style="margin-top:200px;">
        <div style="width:600px;">
            <div class="card card-info card-outline">
                <div class="card-header">
                    <h2 class="card-title">Login</h2>
                </div>
                <form class="form-horizontal" method="post" action="{{url('fm/index-action')}}" enctype="multipart/form-data" target="_self" id="login-form">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputName" name="inputName" placeholder="Please input your name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="inputPassword" name="inputPassword" placeholder="Please input your password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="offset-sm-2 col-sm-10">
                                <div class="icheck-info d-inline">
                                    <input type="checkbox" id="checkboxRememberMe" name="checkboxRememberMe">
                                    <label for="checkboxRememberMe">Remember me</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">Sign in</button>
                        <button type="button" class="btn btn-default float-right">Cancel</button>
                    </div>
                    {{csrf_field()}}
                </form>
            </div>
            {!! $tpl_info !!}
        </div>
    </div>

@endsection
