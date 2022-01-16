<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Role;
use Illuminate\Http\Request;
use DB;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.roles.index',[
            'roles'=>Role::latest()->paginate(50)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Role = new Role();
        $Role->name    = $request->name;
        $Role->save();

        return redirect('admin/roles')->with('success','Role Added Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roles = Role::select()->find($id);
        if (!$roles) {
            return redirect()->route('admin.roles')->with(['error' => 'هذا الدور غير موجود']);
        }

        return view('admin.roles.edit', compact('roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        try {
            $role = Role::find($id);
            if (!$role) {
                return redirect()->route('admin.roles.edit', $id)->with(['error' => 'هذه اللغة غير موجوده']);
            }

            $role->update($request->except('_token'));

            return redirect()->route('admin.roles')->with(['success' => 'تم تحديث الدور بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.users')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        try {
            $role = Role::find($id);
            if (!$role) {
                return redirect()->route('admin.roles', $id)->with(['error' => 'هذا الدور غير موجود']);
            }
            $role->delete();

            return redirect()->route('admin.roles')->with(['success' => 'تم حذف الدور بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.roles')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }


}
