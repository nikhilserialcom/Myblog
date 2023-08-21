@extends('layouts/user/usermain')
@section('content')
    <div class="outer_all_blog">
        <div class="sub_all_blog">
            <div class="upload_blog">
                <div class="sub_blog">
                    <div class="technology_btn">
                        <button>{{ $post->categoryname }}</button>
                    </div>
                    <div class="heading">
                        <h3>{{ $post->title }}</h3>
                    </div>
                    <div class="user_detail_blog">
                        <div class="user_name_logo">
                            <div class="image">
                                @if ($post->user)
                                    <img src="{{ $post->user->profile }}" alt="">   
                                @else
                                    <img src=" {{ url('image/Image (2).svg') }}" alt="">     
                                @endif
                            </div>
                            <div class="name_user">
                                @if ($post->user)
                                    <p>{{ $post->user->name }}</p>
                                @else
                                    <p>Unkonw User</p>
                                @endif
                            </div>
                        </div>
                        <div class="date_time">
                            <p>{{ date('F j, Y',strtotime($post->created_at)) }}</p>
                        </div>
                    </div>

                    <div class="outer_blog">
                        <div class="child_blog">
                            <div class="blog_image">
                                <img src="{{ asset($post->postImage) }}" alt="">
                            </div>
                            <div class="blog_contain">
                                    {!! $post->body !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="recent_articles">
                <div class="heading">
                    <h3>Recent Articles</h3>
                </div>
                @foreach ($recentPosts as $recentPost)
                    <a href="{{ url('api/blog/'. $recentPost->categoryname . '/' . $recentPost->id) }}">
                        <div class="sub_articles">
                                <div class="article_img">
                                    <img src="{{ asset($recentPost->postImage) }}" alt="">
                                </div>
                                <div class="text">
                                    <p>{{ $recentPost->categoryname }}</p>
                                </div>
                                <div class="title">
                                   <h3>{{ $recentPost->title }}</h3>
                                </div>
                                <div class="user_detail">
                                    <div class="user_name_pic">
                                        <div class="img">
                                            @if ($post->user)
                                                <img src=" {{ $post->user->profile }}" alt="">                                                
                                            @else
                                                <img src=" {{ url('image/Image (2).svg') }}" alt="">                                                                                                
                                            @endif
                                        </div>
                                        <div class="name">
                                            @if ($post->user)
                                                <p>{{ $post->user->name }}</p>
                                            @else
                                                <p>Unkonw user</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="date_time">
                                        <p>{{ date('F j, Y',strtotime($recentPost->created_at)) }}</p>
                                    </div>
                                </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection


