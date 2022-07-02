@extends('slr.layouts.base')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="mt-4">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Customer</th>
                            <th scope="col">Area</th>
                            <th scope="col">Total</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            @foreach($invoices as $invoice)
                                <tr>
                                    <th scope="row">{{ $invoice->id }}</th>
                                    <td>{{ $invoice->customer->name }}</td>
                                    <td>{{ $invoice->customer->area->name }}</td>
                                    <td>{{ \App\Utils\Invoice\InvoiceUtils::calculateTotal($invoice) }}</td>
                                    <td>
                                        <a href="{{ route('invoice', [ 'id' =>$invoice->id]) }}"
                                           class="btn btn-info">View</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
