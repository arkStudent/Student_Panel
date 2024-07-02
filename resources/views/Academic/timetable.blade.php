@extends('index')

@section('content')

<style>
    .subjects{
        font-size: 13px;
    }
</style>

<div class="container mt-3">
    {{-- <h3 class="text-center">Time Table</h3> --}}
    <div class="card">
        <div class="card-header text-center">
            <h4 class="card-title">Time Table <br>
                <span class="text-muted" style="font-size:17px;">Academic year {{ $academic_year }}</span></h4>
            
            {{-- File to show student details on top --}}
            @include('student_header')
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            @if (count($timetableData) > 0)
                <div>
                    <table class="table table-bordered" style="border-collapse: collapse; width: 100%;">
                        <thead class="text-center thead-dark">
                            <tr>
                                <th>Day/<br>Period(Time)</th>
                                @foreach ($periodList as $pl)
                                    <th>{{ $pl->period }} <br> ({{ $pl->stime }} - <br> {{ $pl->etime }})</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody class="text-center" style="width: 100%;">
                            @foreach ($timetableData as $day => $dayData)
                                <tr>
                                    <th>{{ $day }}</th>
                                    @foreach ($dayData as $periodData)
                                        <td class="subjects">
                                            @if (isset($periodData['subjects']) && count($periodData['subjects']) > 0)
                                                @foreach ($periodData['subjects'] as $subject)
                                                    {{ $subject }}<br>
                                                @endforeach
                                            @else
                                                No subjects scheduled
                                            @endif
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-center">No timetable data available.</p>
            @endif
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
