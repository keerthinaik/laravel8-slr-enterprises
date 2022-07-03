@extends('slr.layouts.base')
@section('content')
    <div class="row">
        <div class="col-7">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Area</th>
                        <th scope="col">Address</th>
                        <th scope="col">GST #</th>
                        <th scope="col">PHONE #</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody class="table-group-divider">
                    @foreach($customers as $customer)
                        <tr>
                            <th scope="row">{{ $loop->index+1 }}</th>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->area->name }}</td>
                            <td>{{ $customer->address }}</td>
                            <td>{{ $customer->gst_no }}</td>
                            <td>{{ $customer->phone_no }}</td>
                            <td>
                                <a href="{{ url('item/edit/'.$customer->id) }}" class="btn btn-info">Edit</a>
                                <a href="{{ url('item/delete/'.$customer->id) }}"
                                   class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-5">
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
                        <h5>Add Customer</h5>
                    </div>
                    <form action="{{ route('add.customer') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control" id="name"
                                           placeholder="name">
                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" name="address" class="form-control" id="address"
                                           placeholder="address"/>
                                    @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="area-selector" class="form-label">Area</label>
                                    <select class="form-select" id="area-selector"
                                            data-placeholder="Select Area" name="area_id">
                                        <option></option>
                                        @foreach($areas as $area)
                                            <option value="{{ $area->id }}">{{ $area->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('area_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <script>
                                        $('#area-selector').select2({
                                            theme: "bootstrap-5",
                                            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                                            placeholder: $(this).data('placeholder'),
                                        });
                                    </script>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="gst_no" class="form-label">GST #</label>
                                    <input type="text" name="gst_no" class="form-control" id="gst_no"
                                           placeholder="GST NUMBER">
                                    @error('gst_no')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="gst_no" class="form-label">PHONE #</label>
                                    <input type="text" name="phone_no" class="form-control" id="phone_no"
                                           placeholder="PHONE NUMBER">
                                    @error('phone_no')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
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
