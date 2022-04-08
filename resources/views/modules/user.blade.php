@extends('master.master')

@section('title','Trang quản trị tài khoản')

@section('main')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>DataTables</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">DataTables</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">

                            <!-- <h3 class="card-title">DataTable with minimal features & hover style</h3> -->
                            <a class="btn btn-info btn-lg" href="{{route('users.get_create')}}">Add User</a>
                           
                            @if (session('notice'))
                            <div class="">
                                <ul style="list-style-type: none;font-weight:600">
                                    <li class="text-danger"> {{ session('notice') }}</li>
                                </ul>
                            </div>

                            @endif
                            @if (session('success'))
                            <div class="" style="background-color: #9aef9a;">
                                <ul style="list-style-type: none;font-weight:600">
                                    <li class="text-danger"> {{ session('success') }}</li>
                                </ul>
                            </div>

                            @endif
                            <!-- <div class="select-box " >
                                <div class="form-group row" style="width: 50px;">
                                    <label>Lọc quyền</label>
                                    <select class="form-control" name="idAuth">
                                        @foreach($auth as $au)
                                        <option value="{{$au->id}}">{{$au->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> -->
                            <div class="card-tools">
                                <form role="search" method="get" action="{{route('users.search')}}">
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                        <input type="text" name="key" class="form-control float-right" placeholder="Tìm kiếm tài khoản">

                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>

                                    <tr>
                                        <th>STT</th>
                                        <th>Tên user</th>
                                        <th>Email</th>
                                        <th>Trạng thái</th>
                                        @foreach($auth as $au)
                                        <th>{{$au->name}}</th>
                                        @endforeach
                                        <th>Sửa/Xóa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $key => $item)
                                    <form action="{{route('users.assigned_role')}}" method="post">
                                        {{csrf_field()}}

                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$item->name}}</td>
                                            <td>{{$item->email}}
                                                <input hidden name="email" value="{{$item->email}}">
                                            </td>
                                            @if($item->active==1)
                                            <td>Hiện</td>
                                            @else
                                            <td>Ẩn</td>
                                            @endif
                                            @foreach($auth as $au)
                                            <td><input type="checkbox" name="{{$au->name}}" onchange="this.form.submit()" {{$item->hasRole($au->name)?'checked':''}}></td>
                                            @endforeach
                                            <!-- <td><input type="checkbox" name="superadmin_role" onchange="this.form.submit()" {{$item->hasRole('SuperAdmin')?'checked':''}}></td>
                                            <td><input type="checkbox" name="admin_role" onchange="this.form.submit()" {{$item->hasRole('Admin')?'checked':''}}></td>
                                            <td><input type="checkbox" name="client_role" onchange="this.form.submit()" {{$item->hasRole('Client')?'checked':''}}></td> -->

                                            <!-- @if($item->role_id == null)
                                        <td>Chưa cấp quyền</td>
                                        @else
                                        @foreach($auth as $au)
                                        @if($au->id == $item->role_id)
                                        <td>{{$au->name}}</td>
                                        @endif
                                        @endforeach
                                        @endif -->

                                            <td>
                                                <a href="/admin/users/edit/{{$item->id}}" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt">
                                                    </i>Sửa</a>
                                                <a href="/admin/users/delete/{{$item->id}}" class="btn btn-danger btn-sm"><i class="fas fa-trash">
                                                    </i>Xóa</a>
                                                <!-- <input class="btn-primary" type="submit" value="Sửa">
                        <input class="btn-danger" type="submit" value="Xóa"> -->
                                            </td>
                                        </tr>
                                    </form>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Rendering engine</th>
                                        <th>Browser</th>
                                        <th>Platform(s)</th>
                                        <th>Engine version</th>
                                        <th>CSS grade</th>
                                    </tr>
                                    <div class="col-sm-7 text-right text-center-xs">
                                        <ul class="pagination pagination-sm m-t-none m-b-none">
                                            {!!$data->links()!!}
                                        </ul>
                                    </div>
                                </tfoot>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@stop
