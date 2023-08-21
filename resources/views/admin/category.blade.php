@extends('admin/adminlayout/main')
@section('content')
    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.category.delete') }}" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Category with its post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="delete_category_id" id="category_id">
                    Are you sure you want to delete this category with all its post?
                </div>
                <div class="modal-footer  border-top-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-danger">Yes</button>
                </div>
            </form>
        </div>
        </div>
    </div>
    <div class="home-section">
        <div class="text">dashboard | {{ $title }}</div>
            <div class="container mb-5">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('admin.category.create') }}" class="btn btn-primary"><i class='bx bx-plus-medical' ></i> ADD CATEGORY</a>
                    </div>
                    <div class="card-body">
                         @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <table class="table  table-responsive">
                            <thead>
                                <tr>
                                    <th scope="col">Category Name</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($category as $categorys)
                                    <tr>
                                        <td>{{ $categorys->categoryName }}</td>
                                        <td>
                                            @if($categorys->status == 'Active')
                                                <span class="badge bg-success">{{ $categorys->status }}</span>
                                            @else
                                                <span class="badge bg-danger">{{ $categorys->status }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.category.edit',['id' => $categorys->id]) }}"><button class="btn btn-primary"><i class='bx bxs-edit'></i></button></a>
                                            {{-- <a href="{{ route('admin.category.delete',['id' => $categorys->id]) }}" class="btn btn-danger delete-category"><i class='bx bxs-trash'></i></a> --}}
                                            <button type="button" class="btn btn-danger delete_category_btn" value="{{ $categorys->id }}"><i class='bx bxs-trash'></i></button>
                                        </td>
                                    </tr> 
                                @endforeach
                            </tbody>
                        </table>
                        {{ $category->links() }}
                        {{-- <div class="row">
                            <div class="col">
                                {{ $category->links() }}
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
    </div>
@endsection
