<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Lottery;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index($id)
    {
        try {
            $category = Category::find($id);
            $products = Product::where('category_id', $category->id)->get();
            $arr = [];
            foreach ($products as $product) {
                array_push($arr, $product->id);
            }
            $lotteries = Lottery::whereIn('product_id', $arr)->get();
            return view('front.categories.view', compact('category', 'lotteries'));
        } catch (\Exception $ex) {
            return redirect()->route('front.categories')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }
}