<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class postApiController extends Controller
{
    public function showpost($category,$id)
    {
        $post = Post::find($id);
        // dd($post);
        $update = ['count' => $post->count + 1];
        Post::where('id',$post->id)->update($update);
        $recentPosts = Post::Where('categoryname',$category)
                            ->with('user')
                            ->orderBy('id','desc')
                            ->get();
        // $user = User::all();
        $data = [
            'post' => $post,
            'recentPosts' => $recentPosts,
            // 'users' => $user,
        ];
        return response(view('blog')->with($data))->header('Content-Type', 'text/html');
    }
    
    public function showAllPost(Request $request)
    {
        // $category = $request->input('category');
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

    public function Allcategory()
    {
        $category = Category::orderBy('categoryName')->get();
        
        if(!$category)
        {
            return response()->json(['message' => "No Data Found"]);
        }
        return response($category);
    }

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
