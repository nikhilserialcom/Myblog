<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Posts";
        $posts = Post::orderBY('id','desc')->paginate(7);
        $categorys = Category::all();
        $data = compact('title','posts','categorys');

        Session::put('post_url',request()->fullUrl());
        // echo Session::get('post_url');

        return view('admin.post')->with($data);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $btn = 'Add post';
        $url = route('admin.post.store');
        $post = new Post();
        $title = "add Post";
        $categorys = Category::orderBY('categoryName','asc')->get();
        $data = compact('post','title','categorys','btn','url');
        return view('admin.addpost')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'title' => 'required|string',
            'categoryname' => 'required|string',
            'body' => 'required|string',
            'thumbnail' => 'image|mimes:jpeg,jpg,png|max:2048',
        ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        if($request->hasFile('thumbnail'))
        {
            $thumbnail = $request->file('thumbnail');
            $thumbnailName = time(). '.' .$thumbnail->getClientOriginalExtension();
            $thumbnailPath = $thumbnail->storeAs('Post',$thumbnailName,'public');

            // $postThumbnailsPath ='Post/thumbnails/';
            // if(!Storage::disk('public')->exists($postThumbnailsPath))
            // {
            //     Storage::disk('public')->makeDirectory($postThumbnailsPath,0755,true,true);
            // }

            // /// Full path to the uploaded image
            //     $fullImagePath = storage_path('app/public/' . $thumbnailPath);

            //     // Full path for square thumbnail
            //     $squareThumbnailPath = 'Post/thumbnails/square_' . $thumbnailName;
            //     $fullSquareThumbnailPath = storage_path('app/public/' . $squareThumbnailPath);

            //     // Full path for resized thumbnail
            //     $resizedThumbnailPath = 'Post/thumbnails/resized_' . $thumbnailName;
            //     $fullResizedThumbnailPath = storage_path('app/public/' . $resizedThumbnailPath);

            //     // Create square thumbnail
            //     Image::make($fullImagePath)
            //         ->fit(200, 200)
            //         ->save($fullSquareThumbnailPath);

            //     // Resizing thumbnail
            //     Image::make($fullImagePath)
            //         ->fit(500, 350)
            //         ->save($fullResizedThumbnailPath);
        }
        $url = '/storage/';

        Post::create([
            'authorId' =>auth()->user()->id,
            'title' => $request->title,
            'body' => $request->body,
            'categoryname' => $request->categoryname == 'Choose category...' ? " " : $request->categoryname,
            'postImage' =>$url.$thumbnailPath ?? null,
        ]);

        return redirect()->back()->with('success','post add successfully!');
    }
    /**
     * Search data resource.
     */
    public function search(Request $request)
    {
        $title = "search Result";
        $postquery = $request->get('search');

        if($postquery == '')
        {
            return redirect()->back();
        }
       
        $posts = Post::where('title', 'like', "%$postquery%")
                ->orWhere('categoryname', 'like',"%$postquery%")
                ->paginate(7);
        if($posts->isEmpty())
        {
            return redirect()->back()->with('false','No Data Found');
        }
        $data = compact('title','posts');
        return view('admin.search')->with($data);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $post =Post::find($id);
        if(!$post)
        {
            return redirect()->route('admin.post');
        }
        else
        {
            $title = "show Post";
            $data = compact('title','post');
            return view('admin.view')->with($data);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
       $post = Post::find($id);
       if(is_null($post))
       {
            return redirect()->route('admin.post');
       }
       else
       {
            $btn = 'update';
            $url = route('admin.post.update',['id'=> $post->id]);
            $categorys = Category::all();
            $title = 'update Post';
            $data = compact('btn','url','title','post','categorys');

            return view('admin.addpost')->with($data);;
       }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(),[
            'title' => 'required|string',
            'categoryname' => 'required|string',
            'body' => 'required|string',
            'thumbnail' => 'image|mimes:jpeg,jpg,png|max:2048'
        ]);
        
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $posts = Post::find($id);
        
        if($request->hasFile('thumbnail'))
        {
            $url ='/storage/';
            $thumbnail = $request->file('thumbnail');
            $thumbnailName = time(). '.' .$thumbnail->getClientOriginalExtension();
            $thumbnailPath = $thumbnail->storeAs('Post',$thumbnailName,'public');

            // if($posts->postImage)
            // {
            //     Storage::disk('public')->delete($posts->postImage);
            // }
            $posts->postimage =$url.$thumbnailPath;
            // $postThumbnailsPath ='Post/thumbnails/';
            // if(!Storage::disk('public')->exists($postThumbnailsPath))
            // {
            //     Storage::disk('public')->makeDirectory($postThumbnailsPath,0755,true,true);
            // }

            // /// Full path to the uploaded image
            //     $fullImagePath = storage_path('app/public/' . $thumbnailPath);

            //     // Full path for square thumbnail
            //     $squareThumbnailPath = 'Post/thumbnails/square_' . $thumbnailName;
            //     $fullSquareThumbnailPath = storage_path('app/public/' . $squareThumbnailPath);

            //     // Full path for resized thumbnail
            //     $resizedThumbnailPath = 'Post/thumbnails/resized_' . $thumbnailName;
            //     $fullResizedThumbnailPath = storage_path('app/public/' . $resizedThumbnailPath);

            //     // Create square thumbnail
            //     Image::make($fullImagePath)
            //         ->fit(200, 200)
            //         ->save($fullSquareThumbnailPath);

            //     // Resizing thumbnail
            //     Image::make($fullImagePath)
            //         ->fit(500, 350)
            //         ->save($fullResizedThumbnailPath);
        }

        $posts->title = $request->title;
        $posts->post_slug = null;
        $posts->body = $request->body;
        $posts->categoryName  = $request->categoryname;

        $posts->update();
        if(session('post_url'))
        {
            return redirect(session(('post_url')))->with('success','post update successfully!');
        }

        return redirect()->back()->with('success','post update successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::find($id);
        $post->delete();

        return redirect()->back()->with('success','post deleted!');
    }

    public function upload(Request $request)
    {
        $CKEditorFuncNum = $request->input('CKEditorFuncNum');
        if ($request->hasFile('upload')) {
            $originname = $request->file('upload')->getClientOriginalName();
                $filename = pathinfo($originname,PATHINFO_FILENAME);

                $extenstion = $request->file('upload')->getClientOriginalExtension();

                $filename = $filename . '_' . time() . '.' . $extenstion;

                $request->file('upload')->move(public_path('uploadImages'),$filename);

                $url ='/uploadImages/'.$filename;
                // dd($CKEditorFuncNum);
                $msg  = 'Image Upload Successfully.';

                $responce = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum,'$url','$msg')</script>";

                @header('Content-type: text/html; charset=utf-8');

                return response($responce);
        }
        return 'No file uploaded';
    }
}
