@extends('layouts/user/usermain')
@section('content')
<div class="App">
    <div class="all_category_div">

        <div class="popular_articals">

            <div class="heading_ul_button_div">
                <div class="heading title">
                    <h2 class="search-result">Results for <span>{{ $title }}</span></h2>
                </div>
                
                @if ($message)
                    <div class="message-box">
                        <p class="message">{{ $message }}</p>
                    </div>
                @else
                    <div class="card_main">
                        @foreach ($posts as $post) 
                            <a href="{{ url('api/blog/'. $post->categoryname . '/' . $post->post_slug) }}">
                                <div class="card">
                                    <div class="img_div">
                                        <img src="{{ asset($post->postImage) }}" alt="">
                                    </div>
                                            
                                    <div class="button_text_user_div">
                                        <div class="btn_div">
                                            <button>{{ $post->categoryname }}</button>
                                        </div>
                                    <h3>{{ $post->title }}</h3>
                                    </div>
                                            
                                    <div class="users">
                                        <div class="user_img_name_div">
                                            <div class="user_img_div">
                                                @if($post->user)
                                                    <img src=" {{ asset($post->user->profile) }}" alt="">                                                
                                                @else
                                                    <img src="{{ url('image/user.png') }}" alt="">                                                                                               
                                                @endif
                                            
                                            </div>
                                            <span>
                                                @if ($post->user)
                                                    {{ $post->user->name }}
                                                @else
                                                    Unkonw User
                                                @endif
                                            </span>
                                        </div>
                                        <div class="date_div">
                                            {{ date('F j, Y',strtotime($post->created_at)) }}
                                        </div>
                                    </div>  
                                </div>
                            </a>
                        @endforeach
                    </div>
                @endif
        </div>
    </div>
@endsection