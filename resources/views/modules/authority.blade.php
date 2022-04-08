@extends('master.master')

@section('title','Trang quản trị phân quyền')

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
                            <a class="btn btn-info btn-lg" href="{{route('authorities.get_create')}}">Thêm quyền quản trị</a>
                        </div>
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>

                                    <tr>
                                        <th>STT</th>
                                        <th>Quyền</th>
                                        <th>Trạng thái</th>
                                        <th>Quản lý</th>
                                        <!-- <th>Thêm</th>
                                        <th>Sửa</th>
                                        <th>Xóa</th>
                                        <th>Khác</th> -->
                                        <th>Sửa/Xóa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($auth as $key => $item)
                                    <form action="{{route('authorities.assigned_permission')}}" method="post">
                                        {{csrf_field()}}
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$item->name}}
                                                <input hidden name="name" value="{{$item->name}}">
                                            </td>

                                            @if($item->active==true)
                                            <td>Hiện</td>
                                            @else
                                            <td>Ẩn</td>
                                            @endif

                                            <td>
                                                @foreach($parent as $parentPermission)
                                                {{$parentPermission->name}}
                                                <input type="checkbox" name="{{$parentPermission->name}}" onchange="this.form.submit()" {{$item->hasPermission($parentPermission->name)?'checked':''}}>
                                                 @endforeach
                                            </td>

                                            <!-- <td><input type="checkbox" name="read_permission" onchange="this.form.submit()" {{$item->hasPermission('read')?'checked':''}}></td>
                                            <td><input type="checkbox" name="create_permission" onchange="this.form.submit()" {{$item->hasPermission('create')?'checked':''}}></td>
                                            <td><input type="checkbox" name="update_permission" onchange="this.form.submit()" {{$item->hasPermission('update')?'checked':''}}></td>
                                            <td><input type="checkbox" name="delete_permission" onchange="this.form.submit()" {{$item->hasPermission('delete')?'checked':''}}></td>
                                            <td><input type="checkbox" name="full_permission" onchange="this.form.submit()" {{$item->hasPermission('full')?'checked':''}}></td> -->
                                            <td>
                                                <a href="/admin/authorities/edit/{{$item->id}}" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt">
                                                    </i>Sửa</a>
                                                <a href="/admin/authorities/delete/{{$item->id}}" class="btn btn-sm btn-danger"><i class="fas fa-trash">
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
                                        <!-- <th>CSS grade</th> -->
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
