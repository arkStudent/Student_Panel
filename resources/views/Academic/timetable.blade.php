@extends('index')

@section('content')

    <style>
        .subjects {
            font-size: 13px;
        }

        .no-subjects {
            font-weight: bold;
            text-align: center;
        }
    </style>

    <div class="container mt-3">
        {{-- <h3 class="text-center">Time Table</h3> --}}
        <div class="card">
            <div class="card-header">
                <h4 class="card-title text-center">Time Table <br>
                    <span class="text-muted text-center" style="font-size:17px;">Academic year {{ session('academic_year') }}</span>
                </h4>
                {{-- File to show student details on top --}}
                @include('student_header')
            </div>

            <!-- /.card-header -->
            <div class="card-body ">
                @php
                    $hasSubjects = false;
                @endphp
                @foreach ($timetableData as $day => $dayData)
                    @foreach ($dayData as $periodData)
                        @if (isset($periodData['subjects']) && count($periodData['subjects']) > 0)
                            @php
                                $hasSubjects = true;
                                break 2;
                            @endphp
                        @endif
                    @endforeach
                @endforeach

                @if ($hasSubjects)
                    <div>
                        <table class="table table-bordered text-center" style="border-collapse: collapse; width: 100%;">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Day/<br>Period(Time)</th>
                                    @foreach ($periodList as $pl)
                                        <th>{{ $pl->period }} <br> ({{ $pl->stime }} - <br> {{ $pl->etime }})</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody class="" style="width: 100%;">
                                @foreach ($timetableData as $day => $dayData)
                                    @php
                                        $dayHasSubjects = false;
                                    @endphp
                                    @foreach ($dayData as $periodData)
                                        @if (isset($periodData['subjects']) && count($periodData['subjects']) > 0)
                                            @php
                                                $dayHasSubjects = true;
                                                break;
                                            @endphp
                                        @endif
                                    @endforeach
                                    @if ($dayHasSubjects)
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
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="no-subjects">No subjects scheduled for any day.</p>
                @endif
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix text-center">
                <button class="btn btn-primary" onclick="window.print()"><i class="fa fa-print"></i> Print</button>
            </div>
        </div>
    </div>

@endsection
