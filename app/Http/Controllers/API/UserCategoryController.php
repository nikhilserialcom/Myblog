<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class UserCategoryController extends Controller
{
    public function Allcategory()
    {
        $category = Category::orderBy('categoryName')->get();
        
        if(!$category)
        {
            return response()->json(['message' => "No Data Found"]);
        }
        return response($category);
    }

    public function footerCategory()
    {
        $category = Category::limit(5)->get();

        if (!$category) 
        {
            return response([]);
        }
        return response($category);
    }

    public function categoryPost($category)
    {
        $post = Post::where('categoryname',$category)->with('user')->get();

        if($post->isEmpty())
        {
            $data = [
                'message' => 'No Data Found',
                'title' => $category,
            ];
            return response(view('categorypost')->with('user')->with($data));
        }
        $data = ['posts'=>$post, 'title' => $category, 'message' => '',];

        return response(view('categorypost')->with($data))->header('Content-Type', 'text/html');
    }
}
