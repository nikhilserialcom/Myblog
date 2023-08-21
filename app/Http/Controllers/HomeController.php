<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders = Post::orderByDesc('id')->limit(5)->get();
        $data = compact('sliders');
        return view('home')->with($data);
    }

    public function category()
    {
      return view('category');
    }

    public function showpost()
    {
        return view('blog');
    }

    public function viewAll()
    {
        $title = 'Artical';
        $data = compact('title');
        return view('viewAll')->with($data);
    }

    // public function showAllPost()
    // {
    //     $posts = Post::orderBY('id','desc')->get();
    //     $data = compact('posts');
    //     return redirect()->back()->with($data);
    // }
}
