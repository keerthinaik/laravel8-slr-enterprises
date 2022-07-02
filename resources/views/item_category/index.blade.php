@extends('welcome')
@section('content')
    <div class="row">
        <div class="col-8">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody class="table-group-divider">
                @foreach($itemCategories as $itemCategory)
                    <tr>
                        <th scope="row">{{ $loop->index+1 }}</th>
                        <td>{{ $itemCategory->name }}</td>
                        <td>
                            <a href="{{ url('category/edit/'.$itemCategory->id) }}" class="btn btn-info">Edit</a>
                            <a href="{{ url('category/delete/'.$itemCategory->id) }}"
                               class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-4">
            {{--    Item Category form    --}}
            <div class="card">
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="card-title">
                        <h5>Add Category</h5>
                    </div>
                    <form action="{{ route('add.category') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="itemCategoryName" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" id="itemCategoryName"
                                   placeholder="name">
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>
            </div>
            {{--<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Launch demo modal
            </button>--}}
        <!-- Modal -->
            {{--<div class="modal fade" id="exampleModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            ...
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>--}}
        </div>
    </div>
@endsection

