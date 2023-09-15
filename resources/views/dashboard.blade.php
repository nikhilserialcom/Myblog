@extends('admin/adminlayout/main')
@section('content')
    <div class="home-section">
       <div class="text">dashboard</div>
       <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <a href="{{ route('admin.category') }}">
                        <div class="card bg-dark mb-3 box">
                            <div class="card-body text-center">
                                <h2 style="color: #ff8acc " class="counter">{{ $category }}</h2>
                                <h5 class="text-count">category</h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <a href="{{ route('admin.post') }}">
                        <div class="card bg-dark mb-3 box">
                            <div class="card-body text-center">
                                <h2 class="text-warning counter">{{ $post }}</h2>
                                <h5 class="text-count">Post</h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 ">
                    <a href="#">
                        <div class="card bg-dark mb-3 box">
                            <div class="card-body text-center">
                                <h2 style="color: #5b69bc " class="counter">{{ $user }}</h2>
                                <h5 class="text-count">user</h5>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
       </div>
       <div class="container category-counter">
        <div class="row">
            @foreach ($categoryPostCounts as $categoryname => $postcount)    
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="card bg-dark mb-3 box">
                        <div class="card-body text-center">
                            <h2 style="color: #ff8acc " class="counter">{{ $postcount }}</h2>
                            <h5 class="text-count">{{ $categoryname }}</h5>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
       </div>
    </div>
@endsection
