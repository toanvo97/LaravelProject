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
                            <a class="btn btn-info btn-lg" href="{{('/admin/permissions/create')}}">Thêm quyền hạn</a>

                            @if (session('notice'))
                            <div class="">
                                <ul>
                                    <li class="text-danger"> {{ session('notice') }}</li>
                                </ul>
                            </div>

                            @endif

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
                                        <th>Chức năng</th>
                                        <th>Trạng thái</th>
                                        <th>Sửa/Xóa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($permission as $key => $item)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$item->name}}</td>
                                        @if($item->active==1)
                                        <td>Hiện</td>
                                        @else
                                        <td>Ẩn</td>
                                        @endif
                                        <td>
                                            <a href="/admin/permissions/edit/{{$item->id}}" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt">
                                                </i>Sửa</a>
                                            <a href="/admin/permissions/delete/{{$item->id}}" class="btn btn-danger btn-sm"><i class="fas fa-trash">
                                                </i>Xóa</a>
                                            <!-- <input class="btn-primary" type="submit" value="Sửa">
                        <input class="btn-danger" type="submit" value="Xóa"> -->
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Rendering engine</th>
                                        <th>Browser</th>
                                        <th>Platform(s)</th>
                                        <th>Engine version</th>

                                    </tr>
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
