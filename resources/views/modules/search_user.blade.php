@extends('master.master')

@section('title','Trang quản trị tài khoản')

@section('main')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tìm kiếm</h1>
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
                       
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>

                                    <tr>
                                        <th>STT</th>
                                        <th>Tên user</th>
                                        <th>Email</th>
                                        <th>Trạng thái</th>
                                        <th>Quyền</th>
                                        <th>Sửa/Xóa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $key => $item)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->email}}</td>
                                        @if($item->active==1)
                                        <td>Hiện</td>
                                        @else
                                        <td>Ẩn</td>
                                        @endif
                                        @foreach($auth as $au)
                                        @if($au->id == $item->idAuth)
                                        <td>{{$au->name}}</td>
                                        @endif
                                        @endforeach
                                        <td>
                                            <a href="/admin/users/edit/{{$item->id}}" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt">
                                                </i>Sửa</a>
                                            <a href="/admin/users/delete/{{$item->id}}" class="btn btn-danger btn-sm"><i class="fas fa-trash">
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
                                        <th>CSS grade</th>
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
