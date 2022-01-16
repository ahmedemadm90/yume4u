<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pindding(Request $request)
    {
        $title = 'العمليات المعلقة';
        $transactions = Transaction::where('agent_id', auth()->user()->id)->where('state', 'pindding')->paginate(PAGINATION_COUNT);
        $pindding = Transaction::where('agent_id', auth()->user()->id)->where('state', 'pindding')->count();
        return view('front.agents.transactions.log', compact('transactions', 'title', 'pindding'))->with('i', ($request->input('page', 1) - 1) * 5);
    }


    public function charge(Request $request)
    {
        $title = 'ِشحن رصيد';
        $pindding = Transaction::where('agent_id', auth()->user()->id)->where('state', 'pindding')->count();
        return view('front.agents.transactions.charge', compact('title', 'pindding'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function confirm(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required|size:12',
            'points' => 'required|numeric',
        ]);
        $user = User::where('invitation_code', $request->user_id)->first();
        $points = $request->points;
        if (!$user) {
            return redirect()->route('agent.user.charge')->with('error', 'برجاء التأكد من كود دعوة العميل المراد شحن الرصيد الية');
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
            return redirect()->route('agent.user.charge')->with('success', 'تم التحويل بنجاح');
        }
    }


    public function log(Request $request)
    {
        $title = 'عملياتي';
        $transactions = Transaction::where('agent_id', auth()->user()->id)->paginate(PAGINATION_COUNT);
        return view('front.agents.transactions.log', compact('transactions', 'title'))->with('i', ($request->input('page', 1) - 1) * 5);
    }
    public function userlog(Request $request, $id)
    {
        $title = 'عملياتي';
        $transactions = Transaction::where('user_id', auth()->user()->id)->paginate(PAGINATION_COUNT);
        return view('front.agents.transactions.log', compact('transactions', 'title'))->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function edit($id)
    {
    }


    public function update(Request $request, $id)
    {
    }


    public function destroy($id)
    {
    }
}