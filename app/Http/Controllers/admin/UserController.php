<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Model\Authority;
use App\Model\Menu;
use App\Model\Role;
use Illuminate\Http\Request;
use App\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Brian2694\Toastr\Facades\Toastr;

class UserController extends Controller
{
    //User Controller method
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function assignedRole(Request $request)
    {
        $role           = Role::all();
        $user           = User::where('email', $request->email)->first();
        $user->roles()->detach();

        foreach ($role as $roles) {
            if ($request[$roles->name]) {
                $user->roles()->attach(Role::where('name', $roles->name)->first());
            }
        }
        Toastr::success('Sửa quyền thành công', 'Title', ["positionClass" => "toast-top-right", "closeButton" => "true"]);
        return back();
    }

    public function view()
    {
        $menus          = Menu::all();
        $data           = User::with('roles')->orderBy('name')->paginate(10);
        $user           = User::all();
        $auth           = Role::where('active', true)->get();
        return view('modules.user', compact('data', 'auth', 'menus'));
    }

    public function create()
    {
        $user = Auth::user();
        $menus = Menu::all();

        $auth = Role::where('active', true)->get();
        return view('modules.create.create_users', compact('auth', 'menus'));
    }

    public function store(UserRequest $request)
    {
        try {
            DB::beginTransaction();
            $user           = new User();
            $user->idAuth   = 1;
            $user->name     = $request->name;
            $user->email    = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();
            $user->roles()->attach($request->idAuth);
            DB::commit();
            Toastr::success('Thêm User thành công', 'Title', ["positionClass" => "toast-top-right"]);
            return redirect()->route('users.list');
        } catch (\Exception $exception) {
            DB::rollBack();
            Toastr::warning('Lỗi phát sinh, vui lòng liên hệ Admin hệ thống');
            return back();
        }
    }

    public function edit($id)
    {

        $menus = Menu::all();
        $data = User::find($id);
        $auth = Role::where('active', true)->get();
        $roleUser = $data->roles;
        return view('modules.edit.edit_users', compact('data', 'auth', 'roleUser', 'menus'));
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $user               = User::find($id);
            $user->idAuth       = 1;
            $user->name         = $request->name;
            if ($user->email) {
                $user->email    = $request->email;
            }
            if ($user->password == $request->password) {
                $user->password = $request->password;
            } else {
                $user->password = Hash::make($request->password);
            }
            $user->save();
            $user->roles()->sync($request->idAuth);
            DB::commit();
            Toastr::success('Sửa User thành công', 'Title', ["positionClass" => "toast-top-right"]);
            return redirect()->route('users.list');
        } catch (\Exception $ex) {
            DB::rollBack();
            Toastr::warning('Lỗi phát sinh, vui lòng liên hệ Admin hệ thống');
            return back();
        }
    }

    public function delete($id)
    {

        try {
            $user = User::find($id);
            if (!isset($user)) {
                Toastr::error('Không tìm thấy dữ liệu cần xóa', 'Title', ["positionClass" => "toast-top-right"]);
                return back();
            } else {
                $user->delete();
                Toastr::success('Xóa dữ liệu thành công', 'Title', ["positionClass" => "toast-top-right"]);
                return back();
            }
        } catch (Exception $e) {
            Toastr::warning('Lỗi phát sinh, liên hệ Admin hệ thống', 'Title', ["positionClass" => "toast-top-right"]);
            return back();
        }
    }

    public function search(Request $request)
    {

        $data = User::where('name', 'like', '%' . $request->key . '%')->get();
        $auth = Role::all();
        return view('modules.search_user', compact('data', 'auth'));
    }
}
