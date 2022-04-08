<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthorityRequest;
use Illuminate\Http\Request;
use App\Model\Authority;
use App\Model\Menu;
use App\Model\Role;
use App\Model\Permission;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AuthorityController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function assignedPermission(Request $request)
    {
        // if (!Auth::user()->hasRole('SuperAdmin')) {
        //     return back();
        // }


        $auth = Role::where('name', $request->name)->first();
        $auth->permissions()->detach();
        if ($request->read_permission) {
            $auth->permissions()->attach(Permission::where('name', 'read')->first());
        }
        if ($request->create_permission) {
            $auth->permissions()->attach(Permission::where('name', 'create')->first());
        }
        if ($request->update_permission) {
            $auth->permissions()->attach(Permission::where('name', 'update')->first());
        }
        if ($request->delete_permission) {
            $auth->permissions()->attach(Permission::where('name', 'delete')->first());
        }
        if ($request->full_permission) {
            $auth->permissions()->attach(Permission::where('name', 'full')->first());
        }

        return back()->with('message', 'Phân chức năng theo quyền thành công');
    }

    public function list()
    {
        // if (!Auth::user()->hasRole('SuperAdmin')) {
        //     return back();
        // }
        $parent = Permission::where('parent_id',0)->get();
        $menus = Menu::all();
        // $child = Role::with('permissions')->get();
        // dd($child);
        $auth = Role::with('permissions')->orderBy('name')->paginate(20);
        return view('modules.authority', compact('parent','auth','menus'));
    }

    public function create()
    {
        // if (!Auth::user()->hasRole('SuperAdmin')) {
        //     return back();
        // }
        $menus = Menu::all();
        $auth = Role::where('active', true)->get();
        $permissionsParent = Permission::where('parent_id',0)->get();
        return view('modules.create.create_authorities', compact('auth', 'permissionsParent','menus'));
    }

    public function store(AuthorityRequest $request)
    {
        // if (!Auth::user()->hasRole('SuperAdmin')) {
        //     return back();
        // }

        try {
            DB::beginTransaction();
            $auth           = new Role();
            $auth->name     = $request->name;
            $auth->active   = $request->active;
            $auth->save();
            // dd($auth);
            // dd($request->permission_id);
            $auth->permissions()->attach($request->permission_id);

            DB::commit();
            return redirect()->route('authorities.list')->with('success', 'Tạo quyền thành công');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message :' . $exception->getMessage() . '--- Line: ' . $exception->getLine());
        }

    }

    public function edit($id)
    {
        // if (!Auth::user()->hasRole('SuperAdmin')) {
        //     return back();
        // }
        $permissionsParent = Permission::where('parent_id', 0)->get();
        $auth = Role::find($id);
        $pemissionsChecked = $auth->permissions;
        $menus = Menu::all();
        return view('modules.edit.edit_authorities', compact('auth','permissionsParent','pemissionsChecked','menus'));
    }

    public function update(AuthorityRequest $request, $id)
    {
        // if (!Auth::user()->hasRole('SuperAdmin')) {
        //     return back();
        // }
        try {
            DB::beginTransaction();
            $auth           = Role::find($id);
            $auth->name     = $request->name;
            $auth->active   = $request->active;
            $auth->save();

            $auth->permissions()->sync($request->permission_id);
            DB::commit();
            return redirect()->route('authorities.list');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message :' . $exception->getMessage() . '--- Line: ' . $exception->getLine());
        }
    }

    public function delete($id)
    {
        // if (!Auth::user()->hasRole('SuperAdmin')) {
        //     return back();
        // }
        try {
            $role       = Role::find($id);
            if ($role ==  null) {
                return back()->with('notice', 'Không tìm thấy dữ liệu cần xóa');
            } else {
                $role->delete();
                return back()->with('success', 'Xóa quyền thành công');
            }
        } catch (Exception $e) {
            return back()->with('notice', 'Lỗi phát sinh, liên hệ admin hệ thống');
        }
    }
}
