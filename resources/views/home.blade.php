@extends('layouts/user/usermain')
@section('content')
<div class="App">

    <div class="top_section">
        <div class="content">
            <div class="images">
                <div class="slider_image">
                    @foreach ($sliders as $slider)
                    <div class="img_and_details_div">
                        <img src="{{ $slider->postImage }}">
                        <div class="first-txt">
                            <div class="button">
                                <button>{{ $slider->categoryname }}</button>
                            </div>
                            <div class="title">
                                <h3>{{ $slider->title }}</h3>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="left_right_arrows">

                <div class="sliders left" onclick="side_slide(-1)">
                    <span class="fas fa-angle-left"></span>
                </div>
                <div class="sliders right" onclick="side_slide(1)">
                    <span class="fas fa-angle-right"></span>
                </div>

            </div>

        </div>

        <div class="btn_slides">
            <span onclick="btn_slide(1)"></span>
            <span onclick="btn_slide(2)"></span>
            <span onclick="btn_slide(3)"></span>
            <span onclick="btn_slide(4)"></span>
            <span onclick="btn_slide(5)"></span>
        </div>

    </div>


    <div class="all_category_div">
        <div class="popular_articals">

            <div class="heading_ul_button_div">
                <div class="heading">
                    <h2>Recent Articals</h2>
                </div>
                <div class="categories_btn">
                    <div class="heading_ul_div recent_artical">
                        <ul>
                            <li>all</li>
                            @foreach ($categorys as $category)
                            <li>{{ $category->categoryName }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="View_all_btn recent_btn">
                        <a href="{{ url('api/viewAllpost/recentPost') }}">
                            <button>
                                View All
                                <i class="fa-solid fa-arrow-right"></i>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card_main recent_data all_recent">
                {{-- @foreach ($recentArticals as $recentArtical)
                <div class="card">
                    <div class="img_div">
                        <img src="{{ asset($recentArtical->postImage) }}" alt="">
                    </div>

                    <div class="button_text_user_div">
                        <div class="btn_div">
                            <button>{{ $recentArtical->categoryname }}</button>
                        </div>
                        <h3>{{ $recentArtical->title }}</h3>
                    </div>

                    <div class="users">
                        <div class="user_img_name_div">
                            <div class="user_img_div">
                                <img src="{{ url('image/user.png') }}" alt="">
                            </div>
                            <span>
                                Tracey Wilson
                            </span>
                        </div>
                        <div class="date_div">
                            August 20, 2022
                        </div>
                    </div>
                </div>
                @endforeach --}}
            </div>

        </div>

        <div class="popular_articals">

            <div class="heading_ul_button_div">
                <div class="heading">
                    <h2>Popular Articals</h2>
                </div>
                <div class="categories_btn">
                    <div class="heading_ul_div popular_artical ">
                        <ul>
                            <li>all</li>
                            @foreach ($categorys as $category)
                            <li>{{ $category->categoryName }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="View_all_btn">
                        <a href="{{ url('api/viewAllpost/popularPost')}}">
                            <button>
                                View All
                                <i class="fa-solid fa-arrow-right"></i>
                            </button>
                        </a>
                    </div>
                </div>
            </div>

            <div class="card_main post_data all_popular">
                {{-- @foreach ($posts as $post)
                <div class="card ">
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
                                <img src="{{ url('image/user.png') }}" alt="">
                            </div>
                            <span>
                                Tracey Wilson
                            </span>
                        </div>
                        <div class="date_div">
                            August 20, 2022
                        </div>
                    </div>
                </div>
                @endforeach --}}
            </div>

        </div>

        <div class="popular_articals ">

            <div class="heading_ul_button_div">
                <div class="heading">
                    <h2>All Articals</h2>
                </div>
                <div class="categories_btn">
                    <div class="heading_ul_div all_artical">
                        <ul>
                            <li>all</li>
                            @foreach ($categorys as $category)
                            <li>{{ $category->categoryName }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="View_all_btn">
                        <a href="{{ url('api/viewAllpost/allPost') }}">
                            <button>
                                View All
                                <i class="fa-solid fa-arrow-right"></i>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card_main artical_data all_post ">
                {{-- @foreach($allarticals as $allartical)
                <div class="card">
                    <div class="img_div">
                        <img src="{{ asset($allartical->postImage) }}" alt="">
                    </div>

                    <div class="button_text_user_div">
                        <div class="btn_div">
                            <button>{{ $allartical->categoryname }}</button>
                        </div>
                        <a href="{{ route('user.blog') }}">
                            <h3>{{ $allartical->title }}</h3>
                        </a>
                    </div>

                    <div class="users">
                        <div class="user_img_name_div">
                            <div class="user_img_div">
                                <img src="{{ url('image/user.png') }}" alt="">
                            </div>
                            <span>
                                Tracey Wilson
                            </span>
                        </div>
                        <div class="date_div">
                            August 20, 2022
                        </div>
                    </div>
                </div>
                @endforeach --}}
            </div>

        </div>

    </div>
</div>


@endsection
<script src="{{ asset('js/user/script.js') }}" defer></script>