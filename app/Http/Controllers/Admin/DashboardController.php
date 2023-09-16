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
        $categoryPostCounts  = $this->getPostCountsByCategory();
        $post = Post::count();
        $data = compact('category', 'post', 'user', 'categoryPostCounts');
        return view('dashboard')->with($data);
    }

    public function getPostCountsByCategory()
    {
        $posts = Post::all();

        $categoryPostCount = [];

        foreach ($posts as $post) {
            $categoryName = $post->categoryname;

            if (!array_key_exists($categoryName, $categoryPostCount)) {
                $categoryPostCount[$categoryName] = 0;
            }

            $categoryPostCount[$categoryName]++;
        }

        return $categoryPostCount;
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
