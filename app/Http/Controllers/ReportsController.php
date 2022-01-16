<?php

namespace App\Http\Controllers;

use App\Models\Lottery;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    function ActiveProducts(Request $request)
    {
        $title = trans('المنتجات المفعلة');
        $products = Product::where('active', 1)->paginate(15);
        return view('admin.reports.products', compact('products', 'title'))->with('i', ($request->input('page', 1) - 1) * 5);
    }
    function ActiveLotteries(Request $request)
    {
        $title = trans('السحوبات المفعلة');
        $lotteries = Lottery::where('active', 1)->paginate(15);
        return view('admin.reports.lotteries', compact('lotteries', 'title'))->with('i', ($request->input('page', 1) - 1) * 5);
    }
    function ActiveUsers(Request $request)
    {
        $title = trans('المستخدمين المفعلين');
        $users = User::where('active', 1)->where('role_id', 5)->paginate(15);
        return view('admin.reports.users', compact('users', 'title'))->with('i', ($request->input('page', 1) - 1) * 5);
    }
    function ActiveAgents(Request $request)
    {
        $title = trans('الوكلاء المفعلين');
        $users = User::where('active', 1)->where('role_id', 4)->paginate(15);
        return view('admin.reports.users', compact('users', 'title'))->with('i', ($request->input('page', 1) - 1) * 5);
    }
    function DisabledProducts(Request $request)
    {
        $title = trans('المنتجات المعطلة');
        $products = Product::where('active', 1)->paginate(15);
        return view('admin.reports.products', compact('products', 'title'))->with('i', ($request->input('page', 1) - 1) * 5);
    }
    function DisabledLotteries(Request $request)
    {
        $title = trans('السحوبات الغير مفعلة');
        $lotteries = Lottery::where('active', 0)->paginate(15);
        return view('admin.reports.lotteries', compact('lotteries', 'title'))->with('i', ($request->input('page', 1) - 1) * 5);
    }
    function DisabledUsers(Request $request)
    {
        $title = trans('العملاء المتوقفين');
        $users = User::where('active', 0)->where('role_id', 5)->paginate(15);
        return view('admin.reports.users', compact('users', 'title'))->with('i', ($request->input('page', 1) - 1) * 5);
    }
    function DisabledAgents(Request $request)
    {
        $title = trans('الوكلاء المتوقفين');
        $users = User::where('active', 0)->where('role_id', 4)->paginate(15);
        return view('admin.reports.users', compact('users', 'title'))->with('i', ($request->input('page', 1) - 1) * 5);
    }
}