@extends('index')

@section('content')
    <div class="container">
        <h4 class="text-center mb-4">Attendance from {{ $request->fdate }} to {{ $request->tdate }}</h4>

        {{-- file to show student details on top --}}
        @include('student_header')

        <table class="table table-striped table-bordered text-center mt-4">
            <thead class="thead-dark">
                <tr>
                    <th>Sl.no</th>
                    <th>Date</th>
                    <th>Day</th>
                    <th>Attendance</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($attendance as $index => $record)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $record->date }}</td>
                        <td>{{ $record->std }}</td>
                        <td>{{ $record->atn === 1 ? 'Present' : 'Absent' }}</td>
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
