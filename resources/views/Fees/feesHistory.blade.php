@extends('index')

@section('content')
    <div class="container">
        <h4 class="text-center mb-4">Fee Details</h4>

        {{-- file to show student details on top --}}
        @include('fee_header')

        <table class="table table-striped table-bordered text-center mt-4">
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
                        <td colspan="5">No records found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
