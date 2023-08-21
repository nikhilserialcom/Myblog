@extends('admin/adminlayout/main')
@section('content')
    <div class="home-section">
        <div class="text">Dashboard | {{ $title }}</div>
        <div class="container mt-5 mb-5">
            <div class="row">
                <div class="col-lg-6">
                    <a href="{{ route('admin.post.create') }}" class="btn btn-primary mb-3"><i class='bx bx-plus-medical'></i> ADD POST</a>
                </div>
                <div class="col-lg-6">
                    <form action="{{ route('admin.search') }}" method="GET" class="search-form ms-auto">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="search post..." aria-label="Recipient's username" aria-describedby="button-addon2">
                            <button class="btn btn-primary" type="submit" id="button-addon2"><i class='bx bx-search'></i></button>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
            <div class="container table-responsive mb-5">
                @if (session('false'))
                        <div class="alert alert-danger border border-danger">
                            {{ session('false') }}
                        </div>
                    @endif
                <table class="table mt-2">
                    <thead>
                        <tr>
                            <th scope="col">Title</th>
                            <th scope="col">Category</th>
                            <th scope="col">Post image</th>
                            <th scope="col">Action</th>
                            <th scope="col">View Post</th>
                        </tr>
                    </thead>
                    <tbody class="data_in_tr">
                        @foreach ($posts as $post)                                
                        <tr>
                            <th>{{ $post->title }}</th>
                            <td>{{ $post->categoryname }}</td>
                            <td>
                                <img src="{{ asset($post->postImage) }}" width="150px" height="100px" alt="">
                            </td>
                            <td>
                                <a href="{{ route('admin.post.edit',['id' => $post->id]) }}"><button class="btn btn-primary mt-3 ms-2"><i class='bx bxs-edit'></i></button></a>
                                <a href="{{ route('admin.post.delete',['id' => $post->id]) }}"><button class="btn btn-danger mt-3 ms-2"><i class='bx bxs-trash'></i></button></a>
                            </td>
                            <td>
                                <a href="{{ route('admin.post.view',['id' => $post->id]) }}"><button class="btn btn-primary ms-2 mt-3">View</button></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="row">
                    <div class="col">
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
  
@endsection
