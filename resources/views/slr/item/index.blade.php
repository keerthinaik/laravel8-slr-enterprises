@extends('welcome')
@section('content')
    <div class="row">
        <div class="col">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Category</th>
                        <th scope="col">Hsn Code</th>
                        <th scope="col">Mrp</th>
                        <th scope="col">SGST</th>
                        <th scope="col">CGST</th>
                        <th scope="col">IGST</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody class="table-group-divider">
                    @foreach($items as $item)
                        <tr>
                            <th scope="row">{{ $loop->index+1 }}</th>
                            <td>{{ $item->name }}</td>
                            <td scope="col">{{ $item->item_category_id }}</td>
                            <td scope="col">{{ $item->hsn_code }}</td>
                            <td scope="col">{{ $item->mrp }}</td>
                            <td scope="col">{{ $item->sgst }}</td>
                            <td scope="col">{{ $item->cgst }}</td>
                            <td scope="col">{{ $item->igst }}</td>
                            <td>
                                <a href="{{ url('item/edit/'.$item->id) }}" class="btn btn-info">Edit</a>
                                <a href="{{ url('item/delete/'.$item->id) }}"
                                   class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col">
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
                        <h5>Add Item</h5>
                    </div>
                    <form action="{{ route('add.item') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-8">
                                <div class="mb-3">
                                    <label for="itemName" class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control" id="itemName"
                                           placeholder="name">
                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <label for="hsnCode" class="form-label">HSN CODE</label>
                                    <input type="text" name="hsn_code" class="form-control" id="hsnCode"
                                           placeholder="hsn code">
                                    @error('hsn_code')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="itemCategoryId" class="form-label">Item Category</label>
                                    <select class="form-select" aria-label="category" id="itemCategoryId"
                                            name="item_category_id">
                                        <option value="" selected>-----------------------</option>
                                        @foreach($itemCategories as $itemCategory)
                                            <option value="{{ $itemCategory->id }}">{{ $itemCategory->name }}</option>
                                        @endforeach
                                        <option value="100">ttete</option>
                                    </select>
                                    @error('item_category_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="itemMrp" class="form-label">MRP</label>
                                    <input type="number" name="mrp" class="form-control" id="itemMrp"
                                           placeholder="mrp">
                                    @error('mrp')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <label for="itemSgst" class="form-label">SGST</label>
                                    <input type="number" name="sgst" class="form-control" id="itemSgst"
                                           placeholder="sgst">
                                    @error('sgst')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <label for="itemCgst" class="form-label">CGST</label>
                                    <input type="number" name="cgst" class="form-control" id="itemCgst"
                                           placeholder="cgst">
                                    @error('cgst')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <label for="itemIgst" class="form-label">IGST</label>
                                    <input type="number" name="igst" class="form-control" id="itemIgst"
                                           placeholder="igst" value="0">
                                    @error('igst')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
