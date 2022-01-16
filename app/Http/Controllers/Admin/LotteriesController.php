<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Lottery;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;

class LotteriesController extends Controller
{
    public function index()
    {
        $lotteries = Lottery::orderby('end_at')->get();
        return view('admin.lotteries.index')->with(compact('lotteries'));
    }

    public function create()
    {
        $products = Lottery::select('product_id')->get()->toArray();
        return view('admin.lotteries.create', [
            'products' => Product::whereNotIn('id', $products)->get(),
            'users' => User::where('role_id', 4)->get(),
        ]);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'product_id' => 'required|exists:products,id',
                'ticket_price' => 'required',
                'start_at' => 'required',
                'end_at' => 'required',
                'user_id' => 'required',
            ]);
            if (!$request->has('active')) {
                $request->request->add(['active' => 0]);
            }

            $lottery = new Lottery();
            $lottery->product_id    = $request->product_id;
            $lottery->ticket_price  = $request->ticket_price;
            $lottery->start_at      = $request->start_at;
            $lottery->end_at        = $request->end_at;
            $lottery->user_id        = $request->user_id;
            $lottery->active        = $request->active;
            $lottery->save();
            return redirect('admin/lotteries')->with('success', 'تم اضافة السحب بنجاح');
        } catch (\Throwable $th) {
            return redirect('admin/lotteries')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
        /* $request->validate([
            'product_id' => 'required|exists:products,id',
            'ticket_price' => 'required',
            'start_at' => 'required',
            'end_at' => 'required',
        ]);
        if (!$request->has('active')) {
            $request->request->add(['active' => 0]);
        }

        $lottery = new Lottery();
        $lottery->product_id    = $request->product_id;
        $lottery->ticket_price  = $request->ticket_price;
        $lottery->start_at      = $request->start_at;
        $lottery->end_at        = $request->end_at;
        $lottery->active        = $request->active;
        $lottery->save();
        return redirect('admin/lotteries')->with('success', 'Lottery Added Success'); */
    }


    public function show(Lottery $lottery)
    {
    }

    public function edit($id)
    {
        $lotteries  = Lottery::select()->find($id);
        if (!$lotteries) {
            return redirect()->route('admin.lotteries')->with(['error' => 'هذا السحب غير موجوده']);
        }
        $products = Product::all();
        return view('admin.lotteries.edit', compact('lotteries', 'products'));
    }

    public function update($id, Request $request)
    {
        try {
            $lottery = Lottery::find($id);
            if (!$lottery) {
                return redirect()->route('admin.lotteries.edit', $id)->with(['error' => 'هذا السحب غير موجوده']);
            }
            if (!$request->has('active')) {
                $request->request->add(['active' => 0]);
            }
            $request->validate([
                'product_id' => 'required|exists:products,id',
                'ticket_price' => 'required',
                'start_at' => 'required',
                'end_at' => 'required',
            ]);
            $lottery->product_id    = $request->product_id;
            $lottery->ticket_price  = $request->ticket_price;
            $lottery->start_at      = $request->start_at;
            $lottery->end_at        = $request->end_at;
            $lottery->active        = $request->active;
            $lottery->save();

            return redirect()->route('admin.lotteries')->with(['success' => 'تم تحديث السحب بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.lotteries')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }
    public function destroy($id)
    {
        try {
            $lottery = Lottery::find($id);
            if (!$lottery)
                return redirect()->route('admin.lotteries')->with(['error' => 'هذا السحب غير موجود ']);

            $lottery->delete();
            return redirect()->route('admin.lotteries')->with(['success' => 'تم حذف السحب بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.lotteries')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }
}