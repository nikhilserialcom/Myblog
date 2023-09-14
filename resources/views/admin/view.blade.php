@extends('admin/adminlayout/main')
@section('content')
    <div class="home-section">
        <div class="text">Dashboard | {{ $title }}</div>
        <div class="container mb-5">
          <div class="card">
            <div class="blog-head d-flex justify-content-between border">
                <div class="blog-header">
                    @if (session('post_url'))
                        <a href="{{ session('post_url')}}"><h4 class="text-danger"><i class='bx bx-left-arrow-alt pt-2'></i>Back</h4></a>
                    @endif
                </div>
                <div class="blog-header-menu d-flex justify-content-end align-items-center">
                        <a href="{{ route('admin.post.edit',['id' => $post->id]) }}"><h4 class="btn btn-success me-2">Edit</h4></a>
                        <a href="{{ route('admin.post.delete',['id' => $post->id]) }}"><h4 class="btn btn-danger">Delete</h4></a>
                </div>  
            </div>
            <div class="card-body">
                <div class="post-header">
                    <span class="badge bg-dark mb-3 ms-2">{{ $post->categoryname }}</span>
                    <h4 class="post-text">{{ $post->title }}</h4>
                    <span class="view"><i class="bi bi-eye-fill"></i> view :</span> {{ $post->count }}
                    <div class="user_detail_blog">
                        <div class="user_name_logo">
                            <div class="image">
                                @if ($post->user)
                                    <img src="{{ asset($post->user->profile) }}" alt="">   
                                @else
                                    <img src=" {{ url('image/Image (2).svg') }}" alt="">     
                                @endif
                            </div>
                            <div class="name_user">
                                <p>{{ $post->user->name }}</p>
                            </div>
                        </div>
                        <div class="date_time">
                            <p>{{ date('F j, Y', strtotime($post->created_at)) }}</p>
                        </div>
                    </div>
                </div>
                <div class="postimage ">
                    <img src="{{ asset($post->postImage) }}" alt="">
                </div>
                <div class="blog-contain mt-5">
                    {!! $post->body !!}
                </div>
            </div>
          </div>
        </div>
    </div>
  
@endsection
