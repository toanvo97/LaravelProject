@extends('master.master')

@section('title','Sửa User')

@section('main')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Sửa Users</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Sửa users</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jdata validation -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Sửa quyền quản trị</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        @if (count($errors) > 0)
                        <div class="error-message">
                            <ul style="list-style-type: none; color:red; font-weight:600;">
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <form id="quickForm" method="post" action="" method="post">
                            {{csrf_field()}}
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Quyền quản trị</label>
                                    <input required type="text" name="name" class="form-control" id="name" placeholder="Enter uername" value="{{$auth->name}}">
                                </div>
                                <div class="form-group">
                                    <label>Trạng thái</label>
                                    <select class="form-control" name="active">
                                        <option value="1" @if($auth->active == 1) selected @endif>Hiện</option>
                                        <option value="0" @if($auth->active == 0) selected @endif>Ẩn</option>
                                    </select>
                                </div>
                                <!-- <div class="form-group mb-0">
                                <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="terms" class="custom-control-input" id="exampleCheck1">
                                <label class="custom-control-label" for="exampleCheck1">I agree to the <a href="#">terms of service</a>.</label>
                                </div>
                            </div> -->
                            </div>

                            <!-- /.card-body -->
                            @if (\Session::has('success'))
                            <div class="alert alert-success">
                                <ul>
                                    <li>{!! \Session::get('success') !!}</li>
                                </ul>
                            </div>
                            @endif
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>

                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
                <!-- right column -->
                <div class="col-md-6">

                </div>
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<script>
    $(function() {
        $.validator.setDefaults({
            submitHandler: function() {
                alert("Form successful submitted!");
            }
        });
        $('#quickForm').validate({
            rules: {
                name: {
                    required: true,
                    email: true,
                },
                terms: {
                    required: true
                },
            },
            messages: {
                name: {
                    required: "Ô quyền quản trị không được bỏ trống",

                },

                terms: "Please accept our terms"
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>
@stop
