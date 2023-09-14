@extends('layouts/user/usermain')
@section('content')
    <div class="App">
        <div class="all_category_div">

            <div class="popular_articals">

                <div class="heading_ul_button_div">
                    <div class="heading title">
                        <h2>{{ $title }}</h2>
                    </div>
                    <div class="categories_btn">
                        <div class="heading_ul_div ul_categaries demo_post">
                            <ul>
                                <li>all</li>
                                @foreach ($categories as $category)
                                    <li>{{ $category->categoryName }}</li>
                                @endforeach
                                {{-- <li>Movie</li>
                                <li>Healthcare</li>
                                <li>Technology</li> 
                                <li>branding</li> --}}
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="card_main view_all_data">
                    @foreach ($posts as $post)
                        <div class="card">
                            <div class="img_div">
                                <img src="{{ asset($post->postImage) }}" alt="">
                            </div>

                            <div class="button_text_user_div">
                                <div class="btn_div">
                                    <button>{{ $post->categoryname }}</button>
                                </div>
                                <a href="{{ url('api/blog/'. $post->categoryname . '/' . $post->post_slug) }}"><h3>{{ $post->title }}</h3></a>
                            </div>
                            <div class="users">
                                <div class="user_img_name_div">
                                    <div class="user_img_div">
                                        @if ($post->user)
                                            <img src="{{ asset($post->user->profile) }}" alt="">
                                        @else
                                            <img src="{{ url('image/user.png') }}" alt="">
                                        @endif
                                    </div>
                                    <span>
                                      {{$post->user->name}}
                                    </span>
                                </div>
                                <div class="date_div">
                                    {{ date('F j, Y',strtotime($post->created_at)) }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="{{ asset('js/user/viewAll.js') }}" defer></script>
