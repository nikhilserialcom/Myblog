@extends('admin/adminlayout/main')
@section('content')
    <div class="home-section">
        <div class="text">Dashboard | {{ $title }}</div>
        <div class="container mb-5">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            @if (session('post_url'))
                                <a href="{{ session('post_url')}}" style="width:50px"><h4 class="text-danger"><i class='bx bx-left-arrow-alt pt-2'></i>Back</h4></a>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <form action="{{ route('admin.search') }}" method="GET" class="search-form ">
                                <div class="input-group mt-3">
                                    <input type="text" class="form-control" name="search" value="{{ Request::get('search') }}" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2">
                                    <button class="btn btn-primary" type="submit" id="button-addon2">search</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-responsive mt-2">
                        <thead>
                            <tr>
                                <th scope="col">Title</th>
                                <th scope="col">Category</th>
                                <th scope="col">Post image</th>
                                <th scope="col">Action</th>
                                <th>view</th>
                            </tr>
                        </thead>
                        <tbody>
                                @foreach ($posts as $post)                                
                                    <tr>
                                        <th>{{ $post->title }}</th>
                                        <td>{{ $post->categoryname }}</td>
                                        <td>
                                            <img src="{{ asset($post->postImage) }}" width="150px" height="100px" alt="">
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.post.edit',['id' => $post->id]) }}" class="ms-2"><button class="btn btn-primary mt-3"><i class='bx bxs-edit'></i></button></a>
                                            <a href="{{ route('admin.post.delete',['id' => $post->id]) }}" class="ms-2"><button class="btn btn-danger mt-3"><i class='bx bxs-trash'></i></button></a>
                                        </td>
                                        <td><a href="{{ route('admin.post.view',['id' => $post->id]) }}" class="btn btn-primary mt-3">view</a></td>
                                    </tr>
                                @endforeach
                                <div class="row">
                                    <div class="col">
                                        {{ $posts->links() }}
                                    </div>
                                </div>  
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
  
@endsection
