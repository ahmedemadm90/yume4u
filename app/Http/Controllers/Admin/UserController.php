<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $users = User::orderBy('id')->paginate(50);
        $roles = Role::select('id', 'name')->get();
        return view('admin.users.index', compact('users', 'roles'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::select('id', 'name')->get();
        return view('admin.users.create', compact('roles'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'password' => 'required|same:confirm_password',
            'email' => 'required|email|unique:users,email',
            'image' => 'required|file|mimes:jpg,bmp,png',
            'mobile' => 'required',
            'role_id' => 'numeric|exists:roles,id',
        ]);
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $img = $input['image'];
        $ext = $img->extension();
        $imgname = uniqid() . date('His') . ".$ext";
        $input['image'] = $imgname;
        $input['invitation_code'] = date('his') . Str::random(6);
        $user = User::create($input);
        $img->move(public_path("media/users"), $imgname);
        return redirect()->route('admin.users');
    }


    public function show($id)
    {
        $user = User::find($id);
    }

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::select('id', 'name')->get();
        return view('admin.users.edit', compact('user', 'roles'));
    }


    public function update(Request $request, $id)
    {
        $user = User::find($id);
        /* Update Request Validation */
        $request->validate([
            'name' => 'required|string|max:100',
            'password' => 'same:confirm_password',
            'email' => 'required|email',
            'image' => 'file|mimes:jpg,bmp,png',
            'mobile' => 'required|numeric',
        ]);
        $input = $request->all();
        /* If Password Updated */
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }
        /* User Image Update */
        if ($request->hasFile('image')) {
            unlink(public_path("media/users/$user->image"));
            $img = $input['image'];
            $ext = $img->extension();
            $imgname = uniqid() . date('His') . ".$ext";
            $img->move(public_path("media/users"), $imgname);
            $input['image'] = $imgname;
        }
        /* Saving Changes */
        $user->update($input);
        return redirect()->route('admin.users');
    }


    public function destroy($id)
    {
        $user = User::find($id);
        try {
            unlink(public_path("media/users/$user->image"));
        } catch (\Throwable $th) {
            return redirect()->route('admin.users')->with(with(['error' => 'يرجي المحاولة فيما بعد']));
        }
        $user->delete();
        return redirect()->route('admin.users')->with(with(['success' => 'تم الحذف بنجاح']));
    }
}