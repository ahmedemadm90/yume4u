<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\mainCategory;
use App\Models\Category;
use App\Models\User;
use Exception;
use Image;
use File;
use Symfony\Component\Console\Input\Input;

use function GuzzleHttp\Psr7\_parse_message;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::Paginate(PAGINATION_COUNT);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.products.create', [
            'title' => trans('Add New Product'),
            'categories' => Category::with('children')->where('parent_id', null)->latest()->get(),
            'users' => User::get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {
            $request->validate([
                'name' => 'required|string|max:150',
                'price' => 'required|numeric',
                'category_id' => 'required|exists:categories,id',
                'details' => 'required',
                'image' => 'required|mimes:jpeg,jpg,png,gif|max:2000',
                'gallery' => 'required',
                'gallery.*' => 'mimes:jpeg,jpg,png,gif|max:2000',
                'user_id' => 'required',
            ]);
            $input = $request->all();
            $gallery = [];
            foreach ($input['gallery'] as $image) {
                $ext = $image->extension();
                $imageName = uniqid() . "." . $ext;
                array_push($gallery, $imageName);
                $image->move(public_path("media/products"), $imageName);
            }
            $main_img = $request->image;
            $main_ext = $main_img->extension();
            $MainimageName = uniqid() . "." . $main_ext;
            $main_img->move(public_path("media/products"), $MainimageName);

            $product = new Product();
            $product->addedby = auth()->guard('admin')->user()->name;
            $product->category_id = $request->category_id;
            $product->user_id = $request->user_id;
            $product->name = $request->name;
            $product->price = $request->price;
            $product->details = $request->details;
            $product->active = 1;
            $product->image = $MainimageName;
            $product->gallery = $gallery;
            $product->save();
            return redirect(url('admin/product'))->with('success', 'تم اضافة المنتج بنجاح');
        } catch (\Throwable $th) {
            return redirect(url('admin/product'))->with('error', 'حدث خطأ ما يرجي المحاولة في وقت لاحق');
        }
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
        $product = Product::select()->find($id);
        if (!$product) {
            return redirect()->route('admin.products')->with(['error' => 'هذا المنتج غير موجود']);
        }
        $categories = Category::with('children')->where('parent_id', null)->latest()->get();
        $users = User::get();

        return view('admin.products.edit', compact('product', 'categories', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update($id, Request $request)
    {
        $input = $request->all();
        $product = Product::find($id);
        if (!$product) {
            return redirect()->route('admin.products')->with(['error' => 'هذا المنتج غير موجود ']);
        }
        $product->category_id = $request->category_id;
        //$product->user_id = $request->user_id;


        if (!$request->has('user_id'))
            $product->user_id = $product->user_id;
        else
            $product->user_id = $request->user_id;
        //$product->image = $product->image;
        if ($request->hasFile('image')) {
            unlink(public_path("media/products/$product->image"));
            $img = $request->file('image');
            $ext = $img->extension();
            $mainimageName = uniqid() . "." . $ext;
            $product->image = $mainimageName;
            $img->move(public_path("media/products"), $mainimageName);
        }
        if ($request->hasFile('gallery')) {
            foreach ($product->gallery as $oldGimage) {
                unlink(public_path("media/products/$oldGimage"));
            }
            $gallery = [];
            foreach ($input['gallery'] as $image) {
                $ext = $image->extension();
                $imageName = uniqid() . "." . $ext;
                array_push($gallery, $imageName);
                $image->move(public_path("media/products"), $imageName);
            }
            $product->gallery = $gallery;
        }
        $product->name = $request->name;
        $product->price     = $request->price;
        $product->details     = $request->details;
        $product->category_id     = $request->category_id;
        $product->update();
        return redirect()->route('admin.products')->with(['success' => 'تم التحديث بنجاح']);
    }

    public function updateddd($id, Request $request)
    {
        $product = Product::find($id);
        try {
            if (!$product) {
                return redirect()->route('admin.products')->with(['error' => 'هذا المنتج غير موجود ']);
            }
            if (!$request->has('category_id'))
                $request->request->add(['category_id' => $product->category_id]);
            else
                $request->request->add(['category_id' =>  $request->category_id]);
            $product->save();

            return redirect()->route('admin.products')->with(['success' => 'تم التحديث بنجاح']);
        } catch (\Exception $ex) {

            return redirect()->route('admin.products')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
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
        $product = Product::find($id);
        if (!$product) {
            return redirect()->route('admin.products');
        } else {
            foreach ($product->images as $img) {
                unlink(public_path("media/products/$img"));
            }
            unlink(public_path("media/products/$product->main_img"));
            $product->delete();
            return redirect()->route('admin.products');
        }
    }
    public function agentIndex()
    {
        $products = Product::where('user_id', auth()->user()->id)->paginate(PAGINATION_COUNT);
        return view('front.agents.products.index', compact('products'));
    }
    public function agentProductCreate()
    {
        return view('front.agents.products.create', [
            'title' => trans('Add New Product'),
            'categories' => Category::with('children')->where('parent_id', null)->latest()->get(),
        ]);
    }
    public function agentProductStore(Request $request)
    {
        //dd($request->all());

        /* try {
            $request->validate([
                'name' => 'required|string|max:150',
                'price' => 'required|numeric',
                'category_id' => 'required|exists:categories,id',
                'details' => 'required',
                'image' => 'required|mimes:jpeg,jpg,png,gif|max:2000',
                'gallery' => 'required',
                'gallery.*' => 'mimes:jpeg,jpg,png,gif|max:2000',
            ]);
            $gallery = [];
            //main image upload
            $image = $request->image;
            $mainimgext = $image->extension();
            $MainimageName = uniqid() . "." . $mainimgext;
            $image->move(public_path("media/products"), $MainimageName);

            //Gallery upload
            foreach ($request->gallery as $image) {
                $ext = $image->extension();
                $imageName = uniqid() . "." . $ext;
                array_push($gallery, $imageName);
                $image->move(public_path("media/products"), $imageName);
            }
            $user_id = auth()->user()->id;
            $addedby = auth()->user()->name;
            $product = new Product();
            $product->category_id = $request->category_id;
            $product->user_id = $request->user_id;
            $product->name = $request->name;
            $product->price = $request->price;
            $product->details = $request->details;
            $product->image = $MainimageName;
            $product->gallery = $gallery;
            $product->active = 1;
            $product->user_id = $user_id;
            $product->addedby = $addedby;
            $product->save();
            return redirect(url('agent/products'))->with('Success', 'Product Was Added');
        } catch (Exception $ex) {
            return redirect(url('agent/products'))->with('Error', 'Something Went Wrong Try Again Later');
        } */
        $request->validate([
            'name' => 'required|string|max:150',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'details' => 'required',
            'image' => 'required|mimes:jpeg,jpg,png,gif|max:2000',
            'gallery.*' => 'mimes:jpeg,jpg,png,gif|max:2000',
        ]);
        $gallery = [];
        //main image upload
        $image = $request->image;
        $mainimgext = $image->extension();
        $MainimageName = uniqid() . "." . $mainimgext;
        $image->move(public_path("media/products"), $MainimageName);

        //Gallery upload
        if (isset($request->gallery)) {
            foreach ($request->gallery as $image) {
                $ext = $image->extension();
                $imageName = uniqid() . "." . $ext;
                array_push($gallery, $imageName);
                $image->move(public_path("media/products"), $imageName);
            }
        }

        $user_id = auth()->user()->id;
        $addedby = auth()->user()->name;
        $product = new Product();
        $product->category_id = $request->category_id;
        $product->user_id = $request->user_id;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->details = $request->details;
        $product->image = $MainimageName;
        $product->gallery = $gallery;
        $product->active = 1;
        $product->user_id = $user_id;
        $product->addedby = $addedby;
        $product->save();
    }
}