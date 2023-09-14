@extends('admin/adminlayout/main')
@section('content')
    <div class="home-section">
        <div class="text">dashboard | {{ $title }}</div>
        <div class="container mt-5">
            <div class="card">
                <div class="card-header bg-light">
                    @if (session('category_url'))
                        <a href="{{ session('category_url') }}"><h4 class="text-danger"><i class='bx bx-left-arrow-alt pt-2'></i>Back</h4></a>    
                    @endif
                    {{-- <a href="{{ route('admin.category') }}"><h4 class="text-danger"><i class='bx bx-left-arrow-alt pt-2'></i>Back</h4></a> --}}
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ $url }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Category:</label>
                            <input type="text" class="form-control" id="name" name="categoryname" value="{{ $category->categoryName }}" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Icon Class:</label>
                            <input type="text" class="form-control" id="name" name="iconclass" value="{{ $category->iconclass }}" required>
                        </div>
                        <div class="form-group">
                            <label>Status:</label>
                            <select class="form-select mb-4" aria-label="Default select example" name="status">
                                <option selected value="Active" {{ $category->status == 'Active' ? 'selected' : '' }}>Active</option>
                                <option value="Inactive" {{ $category->status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                        <button type="submit" name="submit" class="btn btn-danger">ADD</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection