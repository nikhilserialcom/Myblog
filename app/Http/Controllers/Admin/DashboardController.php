<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = User::count();
        $category = Category::count();
        $post = Post::count();
        $data = compact('category','post','user');
        return view('dashboard')->with($data);
    }

    public function welcome()
    {
        return view('welcome');
    }
    public function redirecate()
    {
        return redirect()->back();
    }
}
