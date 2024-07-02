{{-- this library is used for date format  --}}
@php
use Carbon\Carbon;
@endphp


@extends('index')

@section('content')
    <style>
        .subjects {
            font-size: 15px;
        }
    </style>

    <div class="container mt-3">
        {{-- <h3 class="text-center">Time Table</h3> --}}
        <div class="card">
            <div class="card-header text-center">
                <h4 class="card-title">Attendance <br>
                    <span class="text-muted" style="font-size:17px;"> {{ Carbon::parse($request->from_date)->format('d-m-Y') }} 
                        to {{ Carbon::parse($request->to_date)->format('d-m-Y') }}</span></h4>
            </div>

            <!-- /.card-header -->
            <div class="card-body">
                <div>
                    <table class="table " style="border-collapse: collapse;">
                        <thead class="text-center thead-dark">
                            <tr>
                                <th>Sl.no</th>
                                <th>Date</th>
                                <th>Day</th>
                                <th>Attendance</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @forelse ($attendance as $record)
                                <tr style="background-color: {{ $record->day === 'Sunday' ? 'red' : 'white' }}; color:black;">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ isset($record->date) ? $record->date : $record->odate }}</td>
                                    <td>
                                        @if (isset($record->date))
                                            {{ \Carbon\Carbon::parse($record->date)->format('l') }}
                                        @else
                                            {{ $record->day }}
                                        @endif
                                    </td>
                                    <td>
                                        @if (isset($record->atn))
                                            {{ $record->atn === 1 ? 'Present' : 'Absent' }}
                                        @else
                                            @if($record->day === 'Sunday')
                                                <span>Day Off</span>
                                            @else
                                                {{ $record->remarks }}
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                {{-- If no records found, display a message --}}
                                <tr>
                                    <td colspan="4">No records found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix text-center">
                <button onclick="printDiv('printDiv')" class="btn btn-primary">Print</button>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>
@endpush
