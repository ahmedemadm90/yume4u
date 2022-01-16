<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\mainCategory;
use App\Models\Category;
use App\Models\User;
use Image;
use File;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Console\Input\Input;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::select()->paginate(PAGINATION_COUNT);
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
                'main_img' => 'required',
                'gallery' => 'required',
                'gallery.*' => 'mimes:jpeg,jpg,png,gif|max:2000',
                'user_id' => 'required',
            ]);
            $input = $request->all();
            $gallery = [];
            //Start Upload Main Image
            $image = $request->main_img;
            $ext = $image->extension();
            $imageName = uniqid() . "." . $ext;
            $image->move(public_path("media/products"), $imageName);
            //End Upload Main Image

            //Start Upload Gallery Images
            foreach ($input['gallery'] as $galleryImg) {
                $ext = $galleryImg->extension();
                $imageName = uniqid() . "." . $ext;
                array_push($gallery, $imageName);
                $galleryImg->move(public_path("media/products"), $imageName);
            }
            //End Upload Gallery Images
            $product = new Product();
            $product->addedby = auth()->guard('admin')->user()->name;
            $product->category_id = $request->category_id;
            $product->user_id = $request->user_id;
            $product->name = $request->name;
            $product->price = $request->price;
            $product->details = $request->details;
            $product->main_img = $image;
            $product->gallery = $gallery;
            $product->active = 1;
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

        $product = Product::find($id);


        if (!$product) {
            return redirect()->route('admin.products')->with(['error' => 'هذا المنتج غير موجود ']);
        }

        if (!$request->has('category_id'))
            $request->request->add(['category_id' => $product->category_id]);
        else
            $request->request->add(['category_id' =>  $request->category_id]);

        if (!$request->has('user_id'))
            $request->request->add(['user_id' => $product->user_id]);
        else
            $request->request->add(['user_id' =>  $request->user_id]);

        $product->images = $product->images;
        if ($request->hasFile('images')) {

            $img = $request->file('images');
            $ext = $img->extension();
            $imageName = time() . "." . $ext;
            $product->images = $imageName;
            $img->move(public_path("media/products"), $imageName);
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
            //foreach ($product->images as $img) {
            unlink(public_path("media/products/$product->images"));
            //}
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
        dd($request->all());
        $request->validate([
            'name' => 'required|string|max:150',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'details' => 'required',
            'main_img' => 'required',
            'gallery' => 'required',
            'gallery*' => 'required',
            'details' => 'required',
            'gallery' => 'required',
            'gallery.*' => 'mimes:jpeg,jpg,png,gif|max:2000',
        ]);


        $input = $request->all();
        $gallery = [];
        //Start Upload Main Image
        $image = $request->main_img;
        $ext = $image->extension();
        $imageName = uniqid() . "." . $ext;
        array_push($images, $imageName);
        $image->move(public_path("media/products"), $imageName);
        //End Upload Main Image

        //Start Upload Gallery Images
        foreach ($input['gallery'] as $galleryImg) {
            $ext = $galleryImg->extension();
            $imageName = uniqid() . "." . $ext;
            array_push($gallery, $imageName);
            $galleryImg->move(public_path("media/products"), $imageName);
        }
        $product = new Product();
        $product->user_id = auth()->user()->id;
        $product->addedby = auth()->user()->name;
        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->details = $request->details;
        $product->main_img = $imageName;
        $product->gallery = $gallery;
        $product->active = 1;
        //End Upload Gallery Images
        /* $img = $request->file('images');
        $ext = $img->extension();
        $imageName = time() . "." . $ext;
        $product->images = $imageName;
        $product->save();
        $img->move(public_path("media/products"), $imageName); */
        return redirect(url('agent/products'))->with('success', 'Product Added Success');
    }
}