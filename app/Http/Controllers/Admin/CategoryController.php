<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'category';
        $category = Category::orderBY('id','desc')->paginate(7);
        $data = compact('title','category');

        Session::put('category_url',request()->fullUrl());

        return view('admin.category')->with($data);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $btn = "ADD";
        $url = route('admin.category.store');
        $title = 'add category';
        $category = new Category();
        $data = compact('title','btn','url','category');
       return view('admin.addcategory')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'categoryname' => 'required|unique:categories',
            'iconclass' => 'required',
            'status' => 'required',
        ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Category::create([
            'categoryName' => $request->categoryname,
            'iconclass' => $request->iconclass,
            'status' => $request->status
        ]);

        return redirect()-> back()->with('success','Category successfully add');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
       $category = Category::find($id);
       if(is_null($category))
       {
            return redirect()->route('admin.category');
       }
       else
       {
            $btn = "Update";
            $url = route('admin.category.update',['id' => $category->id]);
            $title = "Update Category";
            $data = compact('category','btn','url','title');
            return view('admin.addcategory')->with($data);
       }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(),[
            'categoryname' => 'required',
            'iconclass' => 'required',
            'status' => 'required'
        ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $category = Category::find($id);
        $category->update($validator->validated());
        if(session('category_url'))
        {
            return redirect(session(('category_url')));
        }

        return redirect()->back()->with('success','categoryupdate successfully' );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $category = Category::find($request->delete_category_id);
        $category->delete();

        $post = Post::Where('categoryname',$category->categoryName)->first();
        if($post)
        {
            $post->delete();
        }

        return redirect()->back()->with('success', 'Category and related post deleted');
    }   
}
