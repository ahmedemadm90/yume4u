<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Role;
use App\Models\Transaction;
use App\Models\User;

class AdminsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.admins.index', [
            'admins' => Admin::latest()->paginate(50)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::get();
        return view('admin.admins.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $admin = new Admin();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'],
            'password' => ['required', 'min:8'],
            'role_id' => 'required',
        ]);
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->role_id = $request->role_id;
        $admin->password = Hash::make($request['password']);
        $admin->save();
        return redirect('admin/admins')->with('success', 'Admin Added Success');


        /*return Admin::create([
            'name' => $request['name'],
            'role_id' => $request['role_id'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);*/
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admin = Admin::find($id);
        if (!$admin) {
            return redirect()->route('admin.dashboard')->with(['error' => 'هذا المشرف غير موجود']);
        }
        $roles = Role::get();

        return view('admin.admins.edit', compact('admin', 'roles'));
    }
    public function editInfo($id)
    {
        $admin = Admin::find($id);
        if (!$admin) {
            return redirect()->route('admin.dashboard')->with(['error' => 'هذا المشرف غير موجود']);
        }
        $roles = Role::get();

        return view('admin.edit', compact('admin', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateInfo(Request $request, $id)
    {
        try {
            $admin = Admin::find($id);
            if (!$admin) {
                return redirect()->route('admin.dashboard')->with(['error' => 'هذه المشرف غير موجود']);
            } elseif ($admin->id != auth()->user()->id) {
                return redirect()->route('admin.dashboard')->with(['error' => 'برجاء تعجيل بياناتكم الخاصة فقط']);
            }
            $request->validate([
                'name' => 'required|string|max:100',
                'email' => 'required|email|max:100',
                'role_id' => 'required|numeric',
            ]);
            if (!isset($request->password)) {
                $request->password = $admin->password;
                $admin->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'role_id' => $request->role_id,
                    'password' => $request->password,
                ]);
            } else {
                $admin->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'role_id' => $request->role_id,
                    'password' => Hash::make($request->password),
                ]);
            }
            return redirect()->route('admin.dashboard')->with(['success' => 'تم تحديث المشرف بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.dashboard')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
    /* public function transactionsLog(Request $request)
    {
        $transactions = Transaction::all();
        return view('admin.transactions.log', compact('transactions'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    } */
    public function changestate($id)
    {
        $transaction = Transaction::find($id);
        if (!$transaction) {
            return redirect()->route('admin.dashboard')->with(['error' => 'This Transaction Is Not Valid']);
        }
        if ($transaction->state != 'pindding') {
            return redirect()->route('admin.dashboard')->with(['error' => 'This Transaction Allready Settled']);
        }
        $transaction->update([
            'state' => 'settled',
        ]);
        $transaction->save();
        return back()->with(['success' => 'This Transaction Settled']);
    }

    public function charge(Request $request)
    {
        $title = 'ِشحن رصيد';
        return view('admin.transactions.charge', compact('title'));
    }
    public function pindding(Request $request)
    {
        $transactions  = Transaction::where('agent_id', auth()->user()->id)
            ->where('state', 'pindding')->paginate(PAGINATION_COUNT);
        return view('admin.transactions.pinnding', compact('transactions'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    public function confirm(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required|size:12',
            'points' => 'required|numeric',
        ]);
        $user = User::where('invitation_code', $request->user_id)->first();
        $points = $request->points;
        if (!$user) {
            return redirect()->route('admin.user.charge')->with('error', 'برجاء التأكد من كود دعوة العميل المراد شحن الرصيد الية');
        } else {
            $user->update([
                'wallet' => $user->wallet + $request->points,
            ]);
            Transaction::create([
                'agent_id' => auth()->user()->id,
                'user_id' => $user->id,
                'points' => $request->points,
                'details' => "User $user->id charges with $request->points from agent " . auth()->user()->id,
            ]);
            return redirect()->route('admin.user.charge')->with('success', 'تم التحويل بنجاح');
        }
    }

    public function log(Request $request)
    {
        $title = 'عملياتي';
        $transactions = Transaction::where('agent_id', auth()->user()->id)->paginate(PAGINATION_COUNT);
        return view('admin.transactions.log', compact('transactions', 'title'))->with('i', ($request->input('page', 1) - 1) * 5);
    }
    public function agentTransactions(Request $request)
    {
        $transactions = Transaction::where('state', 'pindding')->paginate(PAGINATION_COUNT);
        return view('admin.transactions.agentslog', compact('transactions'))->with('i', ($request->input('page', 1) - 1) * 5);
    }
}