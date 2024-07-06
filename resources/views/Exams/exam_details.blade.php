 
@extends('index')

@section('content')
@include('Exams.examdetailsheader') 
<div class="container">
    <div class="card">
        <div class="card-header">
            <span>
                <div class="container text-center">
                    <h4 style="margin-bottom: 10px; text-decoration: underline;">Exam Report</h4>
                    <h6 style="margin-bottom: 20px;"><strong style="font-size: 17px; color: #888;">Academic Year : {{ session('academic_year') }}</strong></h6>
                </div>
            </span>
            <div class="container">
                <table border="1" style="border-collapse: collapse;" class="top-content table table-bordered">
                    <tbody>
                        <tr>
                            <td><strong>Student ID: </strong>{{ $student_id }}</td>
                            <td><strong>Standard: </strong>{{ $std }}</td>
                            <td><strong>Division: </strong>{{ $dv }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-body">
            <div class="container mt-3">
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>Subject</th>
                            <th>Attendance</th>
                            <th>Internal Marks</th>
                            <th>Written Marks</th>
                            <th>Total Marks</th>
                            <th>Grade</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($examMarks) > 0)
                            @foreach ($examMarks as $mark)
                            <tr>
                                <td>{{ $mark->subject }}</td>
                                <td>{{ $mark->attendance }}</td>
                                <td>{{ $mark->i_marks }}</td>
                                <td>{{ $mark->w_marks }}</td>
                                <td>{{ $mark->t_marks }}</td>
                                <td>{{ $mark->grade }}</td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6">
                                    <div class="text-center">
                                        <strong>No Record Found.</strong>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="text-center mt-3">
                <button class="btn btn-primary" onclick="window.print()"><i class="fa fa-print"></i> Print</button>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
<<<<<<< HEAD
    <!-- You can add scripts here if needed -->
=======
>>>>>>> 9c0a83b00f7e3b50ee61b92977d3c24bc8033b5b
@endsection
