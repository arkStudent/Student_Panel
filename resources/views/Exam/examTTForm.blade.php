@extends('index')

@section('content')
<div class="container mt-3">
    <h4 class="text-center mb-4" style="text-decoration:underline">EXAM TIME TABLE </h4>
    <form id="attendForm" method="post" action="{{ route('examTimeTable') }}">
        @csrf
        <div class="mb-3">
            <select type="text" class="form-control" id="exam_type" name="exam_type" required>
                <option value="">Select Exam Type</option>
                @foreach ($examTypes as $exam)
                    <option value="{{ $exam->id }}">{{ $exam->ename }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <center>
                <button type="submit" class="btn btn-primary m-3">Submit</button>
                <button type="reset" class="btn btn-danger m-0">Reset</button>
            </center>
        </div>
    </form>
</div>

@endsection