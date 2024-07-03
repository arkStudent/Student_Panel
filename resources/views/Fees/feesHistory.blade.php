@extends('index')

@section('content')

<div class="container mt-3">
    <div class="card">
        <div class="card-header text-center">
            <h4 class="card-title">Fees Details</h4>
            @include('fees.fee_header')
        </div>
        <div class="card-body">
            <div>
                <table class="table table-bordered text-center" style="border-collapse: collapse;">
                    <thead class="thead-dark">
                        <tr>
                            <th>Sl.no</th>
                            <th>Head</th>
                            <th>Month</th>
                            <th>Total Fee</th>
                            <th>Paid Fee</th>
                            <th>Balance Fee</th>
                            <th>Paid Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $TotalAmount = 0;
                            $PaidAmount = 0;
                        @endphp
                        @forelse ($feeHistory as $index => $record)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $record->head }}</td>
                                <td>{{ $record->month ?: '-' }}</td>
                                <td>{{ $record->total_amount }}</td>
                                <td>{{ $record->paid_amount ?: '0' }}</td>
                                <td>{{ $record->total_amount - $record->paid_amount }}</td>
                                <td>{{ $record->pdate ?: '-' }}</td>
                            </tr>
                            @php
                                $TotalAmount += $record->total_amount;
                                $PaidAmount += $record->paid_amount ?: 0;
                            @endphp
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No records found.</td>
                            </tr>
                        @endforelse

                        {{-- Total count row --}}
                        <tr>
                            <td colspan="3"><strong>Total</strong></td>
                            <td><strong>{{ $TotalAmount }}</strong></td>
                            <td><strong>{{ $PaidAmount }}</strong></td>
                            <td><strong>{{ $TotalAmount - $PaidAmount }}</strong></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
