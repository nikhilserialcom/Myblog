<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class UserViewAllController extends Controller
{
    public function viewAll($status)
    {
        if($status == "recentPost")
        {
            $title = "Recent Articals";
            $posts = Post::orderBy('id','desc')->with('user')->get();
            $category = Category::limit(5)->get();
            $data = [
                'title' => $title,
                'posts' => $posts,
                'categories' => $category, 
            ];
            return response(view('viewAll')->with($data));
        }
        elseif($status == "popularPost")
        {
            $title = "Popular Articals";
            $posts = Post::orderBy('count','desc')->with('user')->get();
            $category = Category::limit(5)->get();
            $data = [
                'title' => $title,
                'posts' => $posts,
                'categories' => $category, 
            ];
            return response(view('viewAll')->with($data));
        }
        elseif($status == "allPost")
        {
            $title = "All Articals";
            $posts = Post::with('user')->get();
            $category = Category::limit(5)->get();
            $data = [
                'title' => $title,
                'posts' => $posts,
                'categories' => $category, 
            ];
            return response(view('viewAll')->with($data));
        }
    }

    public function filterData(Request $request)
    {
        $json = $request->json()->all();
        $status = $json['status'];
        $category = $json['categoryname'];
        if($status == "Recent Articals")
        {
            $query = Post::orderBy('id','desc')->with('user')->get();

            if($category !== "all")
            {
                $query = Post::where('categoryname',$category)->with('user')->orderBy('id','desc')->get();
            }
            $recentPost = $query;
            return response($recentPost);
        }
        if($status == "Popular Articals")
        {
            $query = Post::orderBy('count','desc')->with('user')->get();
 
            if ($category !== "all") {
                $query=Post::where('categoryname', $category)->with('user')->orderBy('count','desc')->get(); // Corrected the method name to 'where'
            }
            $popuplarPost = $query;
            return response($popuplarPost);
        }
        if ($status == "All Articals") {
            $query = Post::with('user')->get();

            if($category !== "all")
            {
                $query = Post::where('categoryname',$category)->with('user')->get();
            }

            $allPost = $query;
            return response($allPost);
        }
    }
}
