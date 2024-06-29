{{-- this library is used for date format  --}}
@php
use Carbon\Carbon;
@endphp

@extends('index')

@section('content')

<style>
    .subjects{
        font-size: 15px;
    }
</style>

<div class="container mt-3">
    {{-- <h3 class="text-center">Time Table</h3> --}}
    <div class="card">
        <div class="card-header text-center">
            <h4 class="card-title">Exam Time Table <br>
                <span class="text-muted" style="font-size:17px;">Academic year {{ session('academic_year') }}</span></h4>
        </div>

        <!-- /.card-header -->
        <div class="card-body">
                <div>
                    <table class="table table-bordered" style="border-collapse: collapse;">
                        <thead class="text-center thead-dark">
                            <tr>
                                <th rowspan="2">Sl.no</th>
                                <th rowspan="2">Date</th>
                                <th rowspan="2">Day</th>
                                <th colspan="2">Time</th>
                                <th rowspan="2">Subject</th>
                                <th rowspan="2">I Marks</th>
                                <th rowspan="2">W Marks</th>
                            </tr>

                            <tr>
                                <th>From</th>
                                <th>To</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @forelse ($examTimeDetails as $timeDetails)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ Carbon::parse($timeDetails->date)->format('d-m-Y') }}</td>
                                {{-- <td>{{ $timeDetails->date }}</td> --}}
                                <td>{{ $timeDetails->day }}</td>
                                <td>{{ $timeDetails->from_time }}</td>
                                <td>{{ $timeDetails->to_time }}</td>
                                <td>{{ $timeDetails->subject }}</td>
                                <td>{{ $timeDetails->i_marks }}</td>
                                <td>{{ $timeDetails->w_marks }}</td>
                            </tr>                               
                            @empty
                                <tr class="text-center text-muted">
                                    <td colspan="8">No Time Table</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{-- <p class="text-center">No timetable data available.</p> --}}
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
