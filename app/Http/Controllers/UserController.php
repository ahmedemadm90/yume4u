<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use App\Models\User_Lotteries;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

class UserController extends Controller
{
    public function register()
    {
        /* If The User Was Invited */
        /* if (!empty($code)) {
            $user = User::where('invitation_code', $code)->first();
            return view('auth.register', compact('user'));
        } else {
            return view('auth.register');
        } */
        return view('auth.register');
    }
    /* public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'password' => 'required|same:confirm-password',
            'email' => 'required|email|unique:users,email',
            'mobile' => 'required',
            'code' => 'string|max:12'
        ]);
        // Check If The User Was Invited Or Not
        if (isset($request->code)) {
            $user = User::select('id', 'name', 'wallet')->where('invitation_code', $request->code)->first();
            $wallet = $user->wallet + 3;
            $user->update([
                'wallet' => $wallet,
            ]);
        }
        $input = $request->all();
        $input['invitation_code'] = date('his') . Str::random(6);
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);
        return redirect()->route('member.login');
    } */
    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'name' => 'required|string|max:100',
            'password' => 'string|same:confirm_password',
            'email' => 'required|email',
            //'code' => 'string|exists:users,invitation_code',
            'mobile' => 'required|required|regex:/(01)[0-9]{9}/',
        ]);

        $input = $request->all();
        if (isset($request->code)) {
            $request->validate([
                'code' => 'string|exists:users,invitation_code',
            ]);
            $input['code'] = $request->code;
            $inviteMan = User::find($request->code, 'invitation_code');
            $inviteMan->update([
                'wallet' => $inviteMan->wallet + 3,
            ]);
            $input['wallet'] = 3 + 1;
        } else {
            $input['wallet'] = 3;
        }
        $input['password'] = Hash::make($request->password);
        $input['invitation_code'] = date('his') . Str::random(6);
        User::create($input);
        return redirect()->route('site');
    }
    public function login()
    {
        if (Auth::check()) {
            Auth::logout();
        }
        return view('auth.login');
    }


    public function logout()
    {
        Auth::logout();

        return view('auth.login');
    }


    public function dologin(Request $request)
    {
        $att = Auth::attempt(['email' => $request->email, 'password' => $request->password]);
        if ($att) {
            return redirect(route('user.dashboard'))->with('success', 'تم الدخول بنجاح');
        } else {
            return redirect(route('member.login'))->with('error', 'برجاء التأكد من بيانات الدخول والمحاولة مرة اخرى');
        }
    }
    public function dashboard()
    {
        return view('front.members.dashboard');
    }
    public function editUser($id)
    {
        $title = trans('تعديل بياناتي');
        $user = User::find($id);
        if (!$user) {
            return redirect()->route('user.dashboard')->with(['error' => 'هذا المستخدم غير موجود']);
        } elseif ($user->id != auth()->user()->id) {
            return redirect()->route('user.dashboard')->with(['error' => 'حدث خطأ ما يرجي المحاولة لاحقا']);
        }
        return view('front.members.edit', compact('user', 'title'));
    }
    public function updateUser(Request $request, $id)
    {
        /* try {
            $user = User::find($id);
            if ($user->id != auth()->user()->id) {
                return redirect()->route('agent.dashboard')->with(['error' => 'برجاء تعديل بياناتك الخاصة فقط']);
            }
            $request->validate([
                'name' => 'required|string|max:100',
                'email' => 'required|email|max:100',
                'mobile' => 'required|numeric',
            ]);
            if (isset($request->password)) {
                $request->validate([
                    'password' => 'string|same:confirm-password',
                ]);
                $password = Hash::make($request->password);
                $user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'mobile' => $request->mobile,
                    'password' => Hash::make($request->password),
                ]);
            } else {
                $user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'mobile' => $request->mobile,
                    'password' => $user->password,
                ]);
            }
            return redirect()->route('user.dashboard')->with(['success' => 'تم تعديل ابيانات بنجاح']);
        } catch (\Throwable $th) {
            return redirect()->route('user.dashboard')->with(['error' => 'برجاء المحاولة فيما بعد']);
        } */
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
        return redirect()->back()->with(['success' => 'تم تحديث البيانات بنجاح']);
    }
    public function userlog(Request $request, $id)
    {
        $title = trans('عمليات الشحن');
        if ($id != auth()->user()->id) {
            return redirect()->route('user.dashboard')->with(['error' => 'برجاء المحاولة فيما بعد']);
        }
        $transactions = Transaction::where('user_id', $id)->paginate(PAGINATION_COUNT);
        return view('front.members.transactions.log', compact('transactions', 'title'))->with('i', ($request->input('page', 1) - 1) * 5);
    }
    public function userActiveLotteries(Request $request, $id)
    {
        if ($id != auth()->user()->id) {
            return redirect()->route('user.dashboard')->with(['error' => 'برجاء المحاولة فيما بعد']);
        };
        $lotteries = User_Lotteries::orderby('created_at')->where('user_id', $id)->paginate(PAGINATION_COUNT);
        $title = trans('سحوباتي');
        return view('front.members.lotteries.active', compact('lotteries', 'title'))->with('i', ($request->input('page', 1) - 1) * 5);
    }
    public function userExpiredLotteries(Request $request, $id)
    {
        if ($id != auth()->user()->id) {
            return redirect()->route('user.dashboard')->with(['error' => 'برجاء المحاولة فيما بعد']);
        };
        $lotteries = User_Lotteries::orderby('created_at')->where('user_id', $id)->paginate(PAGINATION_COUNT);
        $title = trans('سحوباتي المفعلة');
        return view('front.members.lotteries.active', compact('lotteries', 'title'))->with('i', ($request->input('page', 1) - 1) * 5);
    }
}