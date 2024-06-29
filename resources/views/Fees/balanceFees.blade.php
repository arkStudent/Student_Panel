@extends('index')

@section('content')
    <div class="container">
        <h4 class="text-center mb-4">Fees Balance</h4>

        {{-- file to show student details on top --}}
        @include('fee_header')

        <table class="table table-striped table-bordered text-center mt-4">
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
                @forelse ($feeBal as $index => $record)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $record->head }}</td>
                        <td>{{ $record->total_amount }}</td>
                        <td>{{ $record->paid_amount }}</td>
                        <td>{{ $record->balance_amount }}</td>
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
