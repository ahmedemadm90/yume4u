<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Lottery;
use App\Models\Product;
use App\Models\User;
use App\Models\User_Lotteries;
use App\Models\WinnerImage;
use Illuminate\Support\Facades\Auth;

class LotteriesController extends Controller
{
    public function index()
    {
        $lotteries = Lottery::where('active', 1)->get();
        return view('front.lotteries.index')->with(compact('lotteries'));
    }
    public function show($id)
    {
        $lottery = Lottery::find($id);

        if (!$lottery) {
            return redirect(route('site'));
        }
        $product = Product::find($lottery->product_id);
        if (Auth::check()) {
            $arr = [];
            $lotteries_arr = User_Lotteries::where('user_id', auth()->user()->id)->get();
            foreach ($lotteries_arr as $lot) {
                array_push($arr, $lot->lottery_id);
            }
            return view('front.lotteries.view', compact('lottery', 'product', 'arr'));
        }
        return view('front.lotteries.view', compact('lottery', 'product'));
    }


    public function part($id, Request $request)
    {
        $lottery = Lottery::find($id);
        $user = User::find(auth()->user()->id);
        $user->update(["wallet" => $user->wallet - $lottery->ticket_price]);
        User_Lotteries::create([
            'user_id' => auth()->user()->id,
            'lottery_id' => $id,
        ]);
        return back();
    }
    public function expire()
    {
        $lotteries = Lottery::where('active', 2)->get();
        return view('front.lotteries.expired', compact('lotteries'));
    }
    public function winnerImageForm()
    {
        $lotteries = Lottery::where('active', 2)->get();
        return view('admin.lotteries.winnerImage', compact('lotteries'));
    }
    public function winnerImageUpload(Request $request)
    {
        $request->validate([
            'lottery_id' => 'required|numeric|exists:lotteries,id',
            'gallery' => 'required',
            'gallery.*' => 'mimes:png,jpg,gif,jpeg',
            'video' => 'url',
        ]);
        $input = $request->all();
        $gallery = [];
        foreach ($input['gallery'] as $galleryImg) {
            $ext = $galleryImg->extension();
            $imageName = uniqid() . "." . $ext;
            array_push($gallery, $imageName);
            $galleryImg->move(public_path("media/winners"), $imageName);
        }
        $input['gallery'] = $gallery;
        WinnerImage::create($input);
        return back()->with([
            'success' => 'تم اضافة صورة الفائز بنجاح',
        ]);
        /* $request->validate([
            'lottery_id' => 'required|numeric|exists:lotteries,id',
            'image' => 'required',
            'image*' => 'required|file|mimes:png,jpg,gif,jpeg'
        ]);
        $lottery = Lottery::find($request->lottery_id);
        if (!$lottery) {
            return back()->with(['error' => 'السحب المطلوب غير صحيح']);
        }

        if (WinnerImage::where('lottery_id', $request->lottery_id)->get()) {
            $updatelottery = WinnerImage::where('lottery_id', $request->lottery_id)->first();
            $updateimgname = $updatelottery->image;
            $img = $request->image;
            $ext = $img->extension();
            $img->move(public_path("media/winners"), $updateimgname);
            $updatelottery->update([
                'image' => $updateimgname,
            ]);
            return back()->with([
                'success' => 'تم تعديل صورة الفائز بنجاح',
            ]);
        } else {
            $images = [];
            foreach ($request->image as $img) {
                $ext = $img->extension();
                $imgname = uniqid() . date('His') . ".$ext";
                $img->move(public_path("media/winners"), $imgname);
                array_push($images, $imgname);
            }
            dd($request->all());
            WinnerImage::create([
                'lottery_id' => $request->lottery_id,
                'image' => $images,
            ]);
            return back()->with([
                'success' => 'تم اضافة صورة الفائز بنجاح',
            ]);
        } */
    }
}