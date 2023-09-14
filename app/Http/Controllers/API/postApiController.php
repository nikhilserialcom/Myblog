<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class postApiController extends Controller
{
    public function showpost($category,$slug)
    {
        $post = Post::Where('post_slug',$slug)->first();
        if($post)
        {
            $update = ['count' => $post->count + 1];
            Post::where('id',$post->id)->update($update);
        }
        $recentPosts = Post::Where('categoryname',$category)
                            ->with('user')
                            ->orderBy('id','desc')
                            ->get();
        $data = [
            'post' => $post,
            'recentPosts' => $recentPosts,
        ];
        return response(view('blog')->with($data))->header('Content-Type', 'text/html');
    }
    
    public function showAllPost(Request $request)
    {

        $json = $request->json()->all();
        $category = $json['category'];
        $posts = Post::with('user')->get();
        if($category !== "all")
        {
            $posts = Post::Where('categoryname',$category)->with('user')->get();
        }
        $postdata = $posts;
        return response($postdata);
    }

    public function showpopularPost(Request $request)
    {
        $json = $request->json()->all();
        $category = $json['categoryname'];
        $query = Post::orderBy('count','desc')->with('user')->limit(3)->get();
 
        if ($category !== "all") {
            $query=Post::where('categoryname', $category)->orderBy('count','desc')->with('user')->get(); // Corrected the method name to 'where'
        }

        $popuplarPost = $query;
        return response($popuplarPost);
    }

  

    public function recentArtical(Request $request)
    {
        $category = $request->input('category');

        $query = Post::orderBy('id', 'desc')->limit(3);

        if ($category !== "all") {
            $query->where('categoryname', $category);
        }

        $recentArtical = $query->with('user')->get();

        return response($recentArtical);
    }

    public function allpopularArtical()
    {
        $popularArtical = Post::orderBy('count','desc')->with('user')->limit(3)->get();

        return response($popularArtical);
    }

    public function allrecentArtical()
    {
        $recentPost = Post::orderBy('id','desc')->with('user')->limit(3)->get();

        return response($recentPost);
    }

    public function allArtical()
    {
        $allPost = Post::with('user')->get();
        if ($allPost) {
            return response($allPost);
        }
        $data = "No Data Found";
        return response($data);
    }

    public function slider()
    {
        $slider = Post::orderByDesc('id')->limit(5)->get();

        return response($slider);       
    }

    public function search(Request $request)
    {
        $json = $request->json()->all();
        $post = $json['search'];
        if($post != '')
        {
            $data = Post::where('title', 'like', '%' . $post . '%')
                ->orWhere('categoryname', 'like', '%' . $post . '%')
                ->get();

            return response($data);
        }
        return response([]);
    }

    public function search_page($search)
    {
        $searchResult = Post::where('title', 'like', '%' . $search . '%')
                              ->orwhere('categoryname','like','%' . $search . '%')
                              ->with('user')
                              ->get();
        if ($searchResult->isEmpty()) {
            $data = [
                'title' => $search,
                'message' => 'No Data Found'
            ];

            return view('search')->with($data);
        }
        $data = [
            'title' => $search,
            'posts' => $searchResult,
            'message' => '',
        ];
        return view('search')->with($data);
    }
    
}
