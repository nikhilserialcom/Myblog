@extends('admin/adminlayout/main')
@section('content')
    <div class="home-section">
        <div class="text">Dashboard | {{ $title }}</div>
        <div class="container mb-5">
            <div class="card">
                <div class="card-header">
                    @if (session('post_url'))
                        <a href="{{ session('post_url')}}"><h4 class="text-danger"><i class='bx bx-left-arrow-alt pt-2'></i>Back</h4></a>
                    @endif
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form action="{{ $url }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="form-label">Title:</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="" placeholder="Enter the Post Title" value="{{ $post->title }}">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Category:</label>
                            <select class="form-select mb-2 @error('categoryname') is-invalid @enderror" name="categoryname" aria-label="Default select example">
                                <option>Choose category...</option>
                                    @foreach ($categorys as $category)
                                        @if ($category->status === 'Active')      
                                            <option value="{{ $category->categoryName }}" 
                                                @if ($category->categoryName === $post->categoryname)
                                                    selected
                                                @endif>
                                                    {{ $category->categoryName }}
                                            </option>
                                        @endif
                                    @endforeach
                            </select>
                            @error('categoryname')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Body:</label>
                            <textarea class=" form-control mb-2 @error('body') is-invalid @enderror" name="body" id="editor" data-upload-url="{{ route('ckeditor.upload') }}" data-csrf-token="{{ csrf_token() }}" rows="8" placeholder="Enter the Post Body">{{ $post->body }}</textarea>
                            @error('body')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">thumbnail :</label>
                            <input type="file" class="form-control @error('thumbnail') is-invalid @enderror" name="thumbnail"  id="" onchange="previewImage(event)" accept="image/jpg, image/png, image/jpeg">
                            @if ($post->postImage)
                                <img src="{{ asset($post->postImage) }}" class="updateImg"alt="" id="imagePreview"> 
                            @else
                                <img id="imagePreview" src="#" class="insertImg" alt="Image Preview">
                            @endif
                            @error('thumbnail')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button class="btn btn-primary mt-4" type="submit">{{ $btn }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


