@extends('index')

@section('content')

<div class="container mt-3">
    {{-- <h3 class="text-center">Time Table</h3> --}}
    <div class="card">
        <div class="card-header text-center">
            <h4 class="card-title">Fees Details</h4>
            
            {{-- File to show student details on top --}}
            @include('fee_header')
        </div>
        <!-- /.card-header -->

        <div class="card-body">
                <div>
                    <table class="table table-bordered" style="border-collapse: collapse;">
                        <thead class="thead-dark">
                            <tr>
                                <th>Sl.no</th>
                                <th>Head</th>
                                <th>Paid Fee</th>
                                <th>Balance Fee</th>
                                <th>Paid Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($feeHistory as $index => $record)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $record->head }}</td>
                                    <td>{{ $record->paid_amount }}</td>
                                    <td>{{ $record->balance_amount }}</td>
                                    <td>{{ $record->pdate}}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No records found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
        </div>
        <!-- /.card-body -->
    </div>
</div>
@endsection
