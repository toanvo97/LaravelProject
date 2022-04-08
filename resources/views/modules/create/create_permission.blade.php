@extends('master.master')

@section('title','Thêm quyền quản trị')

@section('main')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Thêm quyền quản trị</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Thêm quyền</li>
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
                    <!-- jquery validation -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Thêm quyền quản trị</h3>
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
                        <form id="quickForm" method="post" action="{{route('permissions.get_create')}}">
                            {{csrf_field()}}
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên chức năng phân quyền</label>
                                    <input required type="text" name="name" class="form-control" id="username" placeholder="Enter name">
                                </div>

                                <div class="">
                                    <label for="exampleInputEmail1">Chức năng của quyền này:</label>
                                    <div class="form-group">
                                    <label for="">Quản lý danh sách</label>
                                    <input type="checkbox" name='parent' value="0">
                                    <label for="">Thêm</label>
                                    <input type="checkbox" name='create' value="1">
                                    <label for="">Sửa</label>
                                    <input type="checkbox" name='update' value="1">
                                    <label for="">Xóa</label>
                                    <input type="checkbox" name='delete' value="1">
                                    <label for="">Xem danh sách</label>
                                    <input type="checkbox" name='list' value="1">
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label>Chức năng này thuộc quyền quản lý: </label>

                                    <select class="form-control" name="parent_id">
                                        <option value="0">Chọn quyền quản lý</option>
                                        @foreach($permission as $permissions)
                                        <option value="{{$permissions->id}}">{{$permissions->name}}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <input hidden type="text" name="order">
                                <div class="form-group">
                                    <label>Trạng thái</label>
                                    <select class="form-control" name="active">
                                        <option value="1">Hiện</option>
                                        <option value="0">Ẩn</option>
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
                email: {
                    required: true,
                    email: true,
                },
                password: {
                    required: true,
                    minlength: 5
                },
                terms: {
                    required: true
                },
            },
            messages: {
                email: {
                    required: "Please enter a email address",
                    email: "Please enter a valid email address"
                },
                password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 5 characters long"
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
