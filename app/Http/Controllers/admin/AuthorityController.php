<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthorityRequest;
use Illuminate\Http\Request;
use App\Model\Authority;

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

    public function list()
    {
        $auth = Authority::all();
        return view('modules.authority', compact('auth'));
    }

    public function create()
    {
        $auth = Authority::where('active', true)->get();
        return view('modules.create.create_authorities', compact('auth'));
    }

    public function store(AuthorityRequest $request)
    {
        $auth = new Authority();
        $auth->name = $request->name;
        $auth->active = $request->active;
        $auth->save();

        return redirect()->route('authorities.list')->with('success', 'Tạo quyền thành công');
    }

    public function edit($id)
    {
        $auth = Authority::find($id);
        return view('modules.edit.edit_authorities', compact('auth'));
    }

    public function update(AuthorityRequest $request, $id)
    {

        $auth = Authority::find($id);
        $auth->name = $request->name;
        $auth->active = $request->active;
        $auth->save();
        return redirect()->route('authorities.list');
    }

    public function delete($id)
    {
        Authority::destroy($id);
        return back()->with('success', 'Xóa quyền thành công');
    }

}
