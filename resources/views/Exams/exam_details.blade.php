{{-- sana code --}}
@extends('index')

@section('content')

    <style>
        .top-content {
            background-color: #d9d9d9;
        }
    </style>

    <div class="container mt-3">
        <div class="card">
            <div class="card-header">
                <span>
                    <div class="container text-center">
                        <h4 style="margin-bottom: 10px; text-decoration: underline;">Exam Details</h4>
                        <h6 style="margin-bottom: 20px;"><strong style="font-size: 17px; color: #888;">Academic Year :
                                {{ session('academic_year') }}</strong></h6>
                        <!-- Adding margin-bottom to create more space -->

                    </div>
                </span>
            </div>
            <div class="card-body">
                <div class="container">
                    <div class="mb-3">
                        <div class="container mt-3">
                            <table border="1" style="border-collapse: collapse;"
                                class="top-content table table-bordered">
                                <tbody>
                                    <tr>
                                        <td><strong>Student ID: </strong>{{ $student_id }}</td>
                                        {{-- <td><strong>Branch ID: </strong>{{ session('branch_id') }}</td> --}}
                                        <td><strong>Standard: </strong>{{ $std }}</td>
                                        <td><strong>Division: </strong>{{ $dv }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
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
                    </div>
                </div>
                <div class="text-center mt-3">
                    <button class="btn btn-primary" onclick="window.print()"><i class="fa fa-print"></i> Print</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
@endsection
