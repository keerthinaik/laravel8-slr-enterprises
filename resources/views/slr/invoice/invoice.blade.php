@extends('slr.layouts.base')
@section('content')
    <div class="row">
        <div class="col-12">
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
                    <form action="{{ route('addItem.invoice', ['id' => request()->id]) }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-5">
                                <div class="mb-3">
                                    <label for="item-selector" class="form-label">Item</label>
                                    <select class="form-select" id="item-selector"
                                            data-placeholder="Select Item" name="item_id">
                                        <option itemRate="{{ 0 }}"></option>
                                        @foreach($items as $item)
                                            <option value="{{ $item->id }}" item_rate="{{ $item->rate }}">
                                                {{ $item->name.' ( '.$item->item_category->name.' ) '.' ( '.$item->mrp.' ) ' }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('item_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <script>
                                        $('#item-selector').select2({
                                            theme: "bootstrap-5",
                                            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                                            placeholder: $(this).data('placeholder'),
                                        });
                                        $("#item-selector").change(function(){
                                            var selectedItemRate = $( "#item-selector option:selected" )
                                                .attr('item_rate');
                                            $('#rate').val(selectedItemRate);
                                        });

                                    </script>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="mb-3">
                                    <label for="rate" class="form-label">RATE</label>
                                    <input type="number" name="rate" class="form-control" id="rate"
                                           placeholder="Rate">
                                    @error('rate')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="mb-3">
                                    <label for="quantity" class="form-label">Qunatity</label>
                                    <input type="number" name="quantity" class="form-control" id="quantity"
                                           placeholder="Quantity">
                                    @error('quantity')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-1">
                                <div class="bb-3">
                                    <label for="submit-btn" class="form-label"><b>Action</b></label>
                                    <button type="submit" class="btn btn-primary" id="submit-btn">Add</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="mt-4">
                <div class="row">
                    <div class="col-8">
                        <h3>
                            <b>Billing To : </b> {{ $invoice->customer->name }}
                            <span class="badge rounded-pill text-bg-info">{{ $invoice->customer->area->name }}</span>
                        </h3>
                        <h4>Address : {{ $invoice->customer->address }}</h4>
                    </div>
                    <div class="col-4">
                        <div class="float-end">
                            <a href="{{ route('print.invoice', ['id' => $invoice->id]) }}" class="btn btn-secondary">Print</a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Particulars</th>
                            <th scope="col">Hsn Code</th>
                            <th scope="col">Mrp</th>
                            <th scope="col">Rate</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">SGST</th>
                            <th scope="col">CGST</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody class="table-group-divider">
                        @php
                            $total = 0
                        @endphp
                        @foreach($invoice->invoiceItems as $invoiceItem)
                            @php
                                $amount = $invoiceItem->rate * $invoiceItem->quantity;
                                $total = $total + $amount;
                            @endphp
                            <tr>
                                <th scope="row">{{ $loop->index+1 }}</th>
                                <td>{{ $invoiceItem->item->name }}</td>
                                <td scope="col">{{ $invoiceItem->item->hsn_code }}</td>
                                <td scope="col">{{ $invoiceItem->item->mrp }}</td>
                                <td scope="col">{{ $invoiceItem->rate }}</td>
                                <td scope="col">{{ $invoiceItem->quantity }}</td>
                                <td scope="col">{{ $invoiceItem->item->sgst.'%' }}</td>
                                <td scope="col">{{ $invoiceItem->item->cgst.'%' }}</td>
                                <td scope="col">{{ $amount }}</td>
                                <td>
                                    <a href="{{ route('deleteItem.invoice', [ 'id' =>request()->id, 'invoiceItemId' =>$invoiceItem->id]) }}"
                                       class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <th scope="row"></th>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><b>TOTAL : </b></td>
                            <td>{{ number_format(round(\App\Utils\Invoice\InvoiceUtils::calculateTotal($invoice))).' ₹' }}</td>
                            <td>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
