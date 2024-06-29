@extends('index')

@section('content')
<style>
    .top-content{
        background-color: #d9d9d9;
    }
</style>
<div class="container">
    <h4 class="text-center">EXAM TIME TABLE </h4>
    <h6 class="text-center mb-4">Academic_Year {{ session('academic_year') }} </h6>
    <table border=1 style="border-collapse:collapse;" class="top-content table table-bordered">
        <tbody>
            <tr>
                <td><strong>Standard: </strong>{{ session('std') }}</td>
                <td><strong>Division: </strong>{{ session('dv') }}</td>
                <td><strong>Branch ID: </strong>{{ session('branch_id') }}</td>
                {{-- <td><strong>Academic Year: </strong>{{ session('academic_year') }}</td> --}}
            </tr>
        </tbody>
    </table>
</div>
<div class="container mt-3">
    <form id="attendForm" method="post" action="{{ route('examTimeTable') }}">
        @csrf <!-- This will generate the CSRF token field -->
        <div class="mb-3">
            <select type="text" class="form-control" id="exam_type" name="exam_type" required>
                <option value="">Select Exam Type</option>
                @foreach ($examTypes as $exam)
                    <option value="{{ $exam->id }}">{{ $exam->ename }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <center><button type="submit" class="btn btn-primary">Submit</button></center>
        </div>
    </form>
</div>



@endsection