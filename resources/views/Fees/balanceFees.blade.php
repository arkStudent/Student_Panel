{{-- tasmiya code --}}
@extends('index')

@section('content')

<div class="container mt-3">
    {{-- <h3 class="text-center">Time Table</h3> --}}
    <div class="card">
        <div class="card-header">
            <h4 class="card-title text-center">Fees Balance</h4>
            
            {{-- File to show student details on top --}}
            @include('fees.fee_header')
        </div>
        <!-- /.card-header -->

        <div class="card-body">
            <div>
                <table class="table table-bordered text-center" style="border-collapse: collapse;">
                    <thead class="thead-dark">
                        <tr>
                            <th>Sl.no</th>
                            <th>Head</th>
                            <th>Total Fee</th>
                            <th>Paid Fee</th>
                            <th>Balance Fee</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $totalFee = 0;
                            $totalPaid = 0;
                        @endphp
                        @forelse ($feeBal as $index => $record)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $record->head }}</td>
                                <td>{{ $record->total_amount }}</td>
                                <td>{{ $record->paid_amount ?: '0' }}</td>
                                <td>{{ $record->total_amount - $record->paid_amount }}</td>
                            </tr>
                            @php
                                $totalFee += $record->total_amount;
                                $totalPaid += $record->paid_amount ?: 0;
                            @endphp
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No records found.</td>
                            </tr>
                        @endforelse

                        {{-- Total row --}}
                        <tr>
                            <td colspan="2"><strong>Total</strong></td>
                            <td><strong>{{ $totalFee }}</strong></td>
                            <td><strong>{{ $totalPaid }}</strong></td>
                            <td><strong>{{ $totalFee - $totalPaid }}</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix text-center">
            <button class="btn btn-primary" onclick="window.print()"><i class="fa fa-print"></i> Print</button>
        </div>
    </div>
</div>
@endsection
