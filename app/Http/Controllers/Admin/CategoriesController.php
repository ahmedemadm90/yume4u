<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('parent_id', 'ASC')->get();
        return view('admin.maincategories.index', compact('categories'));
    }

    public function create()
    {
        $categories = Category::whereNull('parent_id')->select('id', 'category_name')->get();
        $subs = Category::whereNotNull('parent_id')->select('id', 'category_name')->get();
        return view('admin.maincategories.create', compact('categories', 'subs'));
    }


    public function store(Request $request)
    {
        if (!isset($request->parent_id)) {
            $request->validate([
                'category_name' => 'required|string|max:25',
                'category_img' => 'required|file|mimes:png,jpg,'
            ]);
            $request->parent_id = null;
            $category_img = $request->category_img;
            $ext = $category_img->extension();
            $imgname = time() . ".$ext";
            $request->category_img = $imgname;
            Category::create([
                'category_name' => $request->category_name,
                'category_img' => $imgname,
            ]);
            $category_img->move(public_path("media/categories"), $imgname);
        } else {
            $request->validate([
                'category_name' => 'required|string|max:25',
                'parent_id' => 'numeric|exists:categories,id',
                'category_img' => 'required|file|mimes:png,jpg,'
            ]);
            $category_img = $request->category_img;
            $ext = $category_img->extension();
            $imgname = time() . ".$ext";
            $request->category_img = $imgname;
            Category::create([
                'category_name' => $request->category_name,
                'category_img' => $imgname,
                'parent_id' => $request->parent_id,
            ]);
            $category_img->move(public_path("media/categories"), $imgname);
        }


        return redirect()->route('admin.categories')->with(['success' => 'تم إضافة القسم بنجاح']);
    }


    public function edit($id)
    {
        //get specific categories and its translations
        $Category = Category::find($id);

        $categories = Category::whereNull('parent_id')->select('id', 'category_name')->get();
        $subs = Category::whereNotNull('parent_id')->select('id', 'category_name')->get();

        if (!$Category)
            return redirect()->route('admin.categories')->with(['error' => 'هذا القسم غير موجود ']);

        return view('admin.maincategories.edit', compact('Category', 'categories', 'subs'));
    }


    public function update($id, Request $request)
    {
        $category = Category::find($id);
        try {
            if (!$category) {
                return redirect()->route('admin.maincategories')->with(['error' => 'هذا القسم غير موجود ']);
            }
            if (!$request->has('active'))
                $request->request->add(['active' => 0]);
            else
                $request->request->add(['active' => 1]);

            if (!$request->has('parent_id'))
                $request->request->add(['parent_id' => null]);
            else
                $request->request->add(['parent_id' =>  $request->parent_id]);

            Category::where('id', $id)
                ->update([
                    'category_name' => $request->category_name,
                    'active' => $request->active,
                    'parent_id' => $request->parent_id,
                ]);
            if ($request->hasFile('category_img')) {
                unlink(public_path("media/categories/" . $category->category_img));
                $img = $request->category_img;
                $ext = $img->extension();
                $imgName = "$request->category_name" . ".$ext";
                $img->move(public_path("media/categories"), $imgName);
                Category::where('id', $id)
                    ->update([
                        'category_img' => $imgName,
                    ]);
            };
            return redirect()->route('admin.categories')->with(['success' => 'تم التحديث بنجاح']);
        } catch (\Exception $ex) {

            return redirect()->route('admin.categories')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }


    public function destroy($id)
    {

        try {
            $category = Category::find($id);
            if (!$category) {
                return redirect()->route('admin.roles', $id)->with(['error' => 'هذا القسم غير موجود']);
            }
            //unlink(public_path("media/categories/".$category->category_img)); //delete from folder
            $category->delete();
            return redirect()->route('admin.categories')->with(['success' => 'تم حذف القسم بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.categories')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function changeStatus($id)
    {
        try {
            $category = Category::find($id);
            if (!$category)
                return redirect()->route('admin.categories')->with(['error' => 'هذا القسم غير موجود ']);

            $status =  $category->category_state  == 0 ? 1 : 0;

            $category->update(['category_state' => $status]);

            return redirect()->route('admin.categories')->with(['success' => ' تم تغيير الحالة بنجاح ']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.categories')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }
}