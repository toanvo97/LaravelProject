<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Model\RoleUser;
use Illuminate\Http\Request;

class UserRoleController extends Controller
{
    //
    public function list(){
        return view('modules.user_role');
    }

    public function create(){
        $userRole = RoleUser::all();
        return view('modules.create.create_user_role',compact('userRole'));
    }

    public function store(Request $request){
        $userRole = new RoleUser();
        $userRole->save($request->all());

        return redirect()->route('user_roles.list');
    }

    public function edit($id){
        $userRole = RoleUser::find($id);
        if($userRole == null){
            return back()->with('error','Không tìm thấy dữ liệu cần sửa');
        }
        return view('modules.edit.edit_user_roles',compact('userRole'));
    }

    public function update(Request $request,$id){
        $userRole = RoleUser::find($id);
        if($userRole == null){
            return back()->with('error','Không tìm thấy dữ liệu cần sửa');
        }
        $userRole->save($request->all());
        return redirect()->route('user_roles.list');
    }

    public function delete($id){
        $userRole = RoleUser::find($id);
        $userRole->delete();

        return back()->with('success','Xóa thành công dữ liệu');
    }
}
