<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Lottery;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AgentController extends Controller
{
    public function index(Request $request)
    {
        $agents = User::where('role_id', 4)->where('active', 1)->paginate(50);
        return view('admin.agents.index', compact('agents'))->with('i', ($request->input('page', 1) - 1) * 5);
    }
    public function active(Request $request)
    {
        $lotteries = Lottery::where('user_id', Auth::user()->id)->where('active', 1)->paginate(50);
        return view('front.agents.lotteries.active', compact('lotteries'))->with('i', ($request->input('page', 1) - 1) * 5);
    }
    public function expire(Request $request)
    {
        $lotteries = Lottery::where('user_id', Auth::user()->id)->where('active', 2)->paginate(50);
        return view('front.agents.lotteries.expired', compact('lotteries'))->with('i', ($request->input('page', 1) - 1) * 5);
    }
    public function agentCreate()
    {
        return view('admin.agents.create');
    }
    public function show($id)
    {
        $user = User::find($id);
        $lotteries = Lottery::where('user_id', $id)->where('active', 1)->get();
        return view('admin.agents.show', compact('user', 'lotteries'));
    }
    public function agentEdit($id)
    {
        $user = User::find($id);
        return view('admin.agents.edit', compact('user'));
    }
    public function agentUpdate(Request $request, $id)
    {
        $user = User::find($id);
        $request->validate([
            'name' => 'required|string|max:100',
            'password' => 'same:confirm_password',
            'email' => 'email',
            'image' => 'file|mimes:jpg,bmp,png',
            'mobile' => 'required',
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
        return redirect()->route('admin.agents');
    }
    public function changeStatus($id)
    {
        try {
            $agent = User::find($id);
            if (!$agent)
                return redirect()->route('admin.agents')->with(['error' => 'هذا القسم غير موجود ']);
            $status =  $agent->active  == 0 ? 1 : 0;
            $agent->update(['active' => $status]);
            return redirect()->route('admin.agents')->with(['success' => ' تم تغيير الحالة بنجاح ']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.agents')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }
    public function requests(Request $request)
    {
        $agents = User::where('role_id', 4)->where('active', 0)->paginate(50);
        return view('admin.agents.waitting', compact('agents'))->with('i', ($request->input('page', 1) - 1) * 5);
    }
    public function agentStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'password' => 'required|same:confirm_password',
            'email' => 'required|email|unique:users,email',
            'image' => 'file|mimes:jpg,bmp,png',
            'mobile' => 'required',
        ]);
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $input['role_id'] = 4;
        if (!empty($request->image)) {
            $img = $input['image'];
            $ext = $img->extension();
            $imgname = uniqid() . date('His') . ".$ext";
            $input['image'] = $imgname;
            $img->move(public_path("media/users"), $imgname);
        }
        $input['invitation_code'] = date('his') . Str::random(6);
        $user = User::create($input);
        return redirect()->route('admin.agents');
    }

    public function create()
    {
        return view('front.agents.register');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'password' => 'required|same:confirm-password',
            'email' => 'required|email|unique:users,email',
            'mobile' => 'required',
        ]);
        $input = $request->all();
        $input['invitation_code'] = date('his') . Str::random(6);
        $input['role_id'] = 4;
        $input['password'] = Hash::make($input['password']);
        $input['active'] = 0;
        $user = User::create($input);
        return redirect()->route('agent.login');
    }
    public function login()
    {
        return view('front.agents.login');
    }
    public function dologin(Request $request)
    {
        $att = Auth::attempt(['mobile' => $request->mobile, 'password' => $request->password, 'active' => 1]);
        if ($att) {
            return redirect(route('agent.dashboard'))->with('success', 'تم الدخول بنجاح');
        } else {
            return back()->with('error', 'برجاء التأكد من بيانات الدخول والمحاولة مرة اخرى');
        }
    }
    public function dashboard()
    {
        return view('front.agents.dashboard');
    }
    public function profile($id)
    {
        $agent = User::where('role_id', 4)->where('id', $id)->first();
        if (!$agent) {
            return redirect(route('site'));
        }
        return view('front.agents.profile', compact('agent'));
    }
    public function agents()
    {
        $agents = User::where('role_id', 4)->paginate(25);
        return view('front.agents.agents', compact('agents'));
    }
    public function edit($id)
    {
        try {
            $agent = User::where('id', $id)->where('role_id', 4)->first();
            $title = trans('تعديل بياناتي');
            if (!$agent) {
                return redirect()->route('agent.edit.myinfo')->with(['error' => 'هذا الوكيل غير موجود']);
            } elseif (auth()->user()->id != $id) {
                return redirect()->route('agent.edit.myinfo')->with(['error' => 'يرجى محاولة تعديل بياناتك فقط']);
            }
            return view('front.agents.edit', compact('agent', 'title'));
        } catch (\Exception $ex) {
            return redirect()->route('agent.dashboard')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }
    public function update(Request $request, $id)
    {
        /* $agent = User::find($id);
        if ($agent->id != auth()->user()->id) {
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
            $agent->update([
                'name' => $request->name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'password' => Hash::make($request->password),
            ]);
        } else {
            $agent->update([
                'name' => $request->name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'password' => $agent->password,
            ]);
        }
        return redirect()->route('agent.dashboard')->with(['success' => 'تم تعديل ابيانات بنجاح']); */
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
}