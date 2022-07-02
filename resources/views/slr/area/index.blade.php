@extends('slr.layouts.base')
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
                @foreach($areas as $area)
                    <tr>
                        <th scope="row">{{ $loop->index+1 }}</th>
                        <td>{{ $area->name }}</td>
                        <td>
                            <a href="{{ url('category/edit/'.$area->id) }}" class="btn btn-info">Edit</a>
                            <a href="{{ url('category/delete/'.$area->id) }}"
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
                        <h5>Add Area</h5>
                    </div>
                    <form action="{{ route('add.area') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="area" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" id="area"
                                   placeholder="name">
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
