@extends('slr.layouts.base')
@section('content')
    <div class="row">
        <div class="col-7">

        </div>
        <div class="col-5">
            <div class="card">
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="card-title">
                        <h5>Create Invoice</h5>
                    </div>
                    <form action="{{ route('create.invoice') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <select class="form-select" id="customer-selector"
                                            data-placeholder="Select Customer" name="customer_id">
                                        <option></option>
                                        @foreach($customers as $customer)
                                            <option value="{{ $customer->id }}">
                                                <div class="row">
                                                    <div class="col-12">
                                                        {{ $customer->name }}
                                                    </div>
                                                    <div class="col-12">
                                                        ({{ $customer->area->name }})
                                                    </div>
                                                </div>

                                            </option>
                                        @endforeach
                                    </select>
                                    @error('customer_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <script>
                                        $('#customer-selector').select2({
                                            theme: "bootstrap-5",
                                            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                                            placeholder: $(this).data('placeholder'),
                                        });
                                    </script>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
