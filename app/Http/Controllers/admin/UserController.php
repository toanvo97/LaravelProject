<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Model\Authority;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

use function PHPUnit\Framework\isEmpty;

class UserController extends Controller
{
    use filterTable;
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

    public function list()
    {
        $data = User::all();
        $auth = Authority::where('active', true)->get();
        return view('modules.user', compact('data', 'auth'));
    }

    public function create()
    {
        $auth = Authority::where('active', true)->get();
        return view('modules.create.create_users', compact('auth'));
    }// ORm

    public function store(UserRequest $request)
    {
        $user           = new User();
        $user->idAuth   = $request->idAuth;
        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('users.list')->with('success', 'Tạo user thành công');
    }

    public function edit($id)
    {
        $data = User::find($id);

        // $data = User::where('id',$id)->first();
        // dd($data);
        $auth = Authority::where('active', true)->get();
        return view('modules.edit.edit_users', compact('data', 'auth'));
    }

    public function update(UserRequest $request, $id)
    {

        $user               = User::find($id);
        $user->idAuth       = $request->idAuth;
        $user->name         = $request->name;
        if ($user->email)
            $user->email    = $request->email;
        if ($user->password == $request->password) {
            $user->password = $request->password;
        } else {
            $user->password = Hash::make($request->password);
        }
        $user->save();
        return redirect()->route('users.list');
    }

    public function delete($id)
    {
        User::destroy($id);
        return back()->with('success', 'Xóa User thành công');
    }

    public function search(Request $request)
    {
        $auth = Authority::all();
        $data = User::where('name', 'like', '%' . $request->key . '%')->get();
        //dd($data);
        if(isEmpty($data)){
            $request->session()->flash('notice', 'Không tìm thấy tài khoản'.$request->key);
            return back();
        }
        return view('modules.search_user', compact('data', 'auth'));
    }
}

trait filterTable
{
    public function filter($request, $data)
    {
    }
}
