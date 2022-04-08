<?php

namespace App\Http\Controllers\admin;

use App\Model\Permission;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Model\Menu;

class PermissionController extends Controller
{
    //
    public function list()
    {
        // if(!Auth::user()->hasRole('SuperAdmin')){
        //     return back();
        // }
        $menus = Menu::all();
        $parent = Permission::where('parent_id', 0)->get();
        $permission = Permission::all();
        return view('modules.permission', compact(['parent', 'permission','menus']));
    }

    public function create()
    {
        // if(!Auth::user()->hasRole('SuperAdmin')){
        //     return back();
        // }
        $menus = Menu::all();
        $permission = Permission::where('parent_id', 0)->get();
        return view('modules.create.create_permission', compact('permission','menus'));
    }

    public function store(Request $request)
    {
        // if(!Auth::user()->hasRole('SuperAdmin')){
        //     return back();
        // }
        $permission = new Permission();
        $parent = Permission::find($request->parent_id);
        $permission->name = $request->name;
        if ($parent == null) {
            $permission->parent_id = 0;
        } else {
            $permission->parent_id = $request->parent_id;
        }
        $permission->active = $request->active;
        $permission->save();

        return redirect()->route('permissions.list')->with('success', 'Thêm dữ liệu thành công');
    }

    public function edit($id)
    {
        $menus = Menu::all();
        $permission = Permission::find($id);
        $permissions = Permission::where('parent_id', 0)->get();
        foreach ($permissions as $item) {
            if ($item->id == $permission->parent_id) {
                $name[] = $item->name;
            }
        }
        if ($permission == null) {
            return back()->with('notice', 'Không tìm thấy dữ liệu cần sửa');
        } else {
            return view('modules.edit.edit_permissions', compact('permissions', 'permission', 'menus'));
        }
    }

    public function update(Request $request, $id)
    {
        $permission = Permission::find($id);

        try {
            DB::beginTransaction();
            $permission         = Permission::find($id);
            $parent             = Permission::find($request->parent_id);
            $permission->name   = $request->name;
            if ($parent == null) {
                $permission->parent_id = 0;
            } else {
                $permission->parent_id = $request->parent_id;
            }
            $permission->keycode = $permission->keycode;
            $permission->save();
            DB::commit();
            return redirect()->route('permissions.list');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message :' . $exception->getMessage() . '--- Line: ' . $exception->getLine());
        }
    }

    public function delete($id)
    {
        if (!Auth::user()->hasRole('SuperAdmin')) {
            return back();
        }
        $permission = Permission::find($id);
        if ($permission == null) {
            return back()->with('error', 'Không tìm thấy dữ liệu cần xóa');
        }
        $permission->delete();
        return back()->with('success', 'Xóa dữ liệu thành công');
    }
}
