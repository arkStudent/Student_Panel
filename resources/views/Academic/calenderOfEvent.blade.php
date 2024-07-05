@extends('index')

@section('content')
<style>
    .table th,
    .table td {
        white-space: normal;  
        max-width: 400px;  
    }
</style>
<div class="card">
    <div class="card-body">
<span>
    <div class="container text-center">
        <h4 style="margin-bottom: 10px; text-decoration: underline;">Calender of events</h4> <!-- Adding margin-bottom to create space -->
        <h6 style="margin-bottom: 20px;"><strong style="font-size: 17px; color: #888;">Academic Year : {{ session('academic_year') }}</strong></h6> <!-- Adding margin-bottom to create more space -->
    </div>

    @include('academic.eventheader')

    <div class="container mt-3">

        <table class="table table-striped table-bordered text-center mt-3">
            <thead class="thead-dark">
                <tr>
                    <th>Sl No</th>
                    <th>Activity</th>
                    <th>Description</th>
                    <th>Date</th>
                    <th>Files</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($activities as $index => $activity)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $activity->activity }}</td>
                        <td>{{ $activity->description }}</td>
                        <td>{{ $activity->date }}</td>
                        <td> 
                            @if ($activity->files)
                                <a href="{{ asset($activity->files) }}" download>
                                        <i class="fa fa-download"></i> 
                                    </a>
                                @else
                                    No file
                                @endif
                            </td> 
                        </tr>
                    
                @endforeach
            </tbody>
        </table>
        <div class="text-center mt-3">
            <button class="btn btn-primary" onclick="window.print()"><i class="fa fa-print"></i> Print</button>
        </div>
    </div>
@endsection
