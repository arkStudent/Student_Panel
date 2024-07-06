@extends('index')

@section('content')
<style>
    .top-content{
        background-color: #d9d9d9;
    }
     
</style>
<div class="container text-center">
    <h4 style="margin-bottom: 10px; text-decoration: underline;">Exam Wise Result</h4>
    <h6><strong>Academic Year {{ session('academic_year') }}</strong></h6>
</div>
<div class="container">
    <form id="examForm" method="POST">
        @csrf
        <div class="mb-3">
            <div class="container">
                <table border="1" style="border-collapse: collapse;" class="top-content table table-bordered">
                    <tbody>
                        <tr>
                            <td><strong>Branch Name: </strong>{{ $branch->name }}</td> 
                            <td><strong>Standard: </strong>{{ session('std') }}</td>
                            <td><strong>Division: </strong>{{ session('dv') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <label for="exam" class="form-label">Select Exam Type</label>
            <select id="exam" name="exam" class="form-control" required>
                <option value="" selected disabled>Select Exam</option>
                @foreach ($exam as $e)
                <option value="{{ $e->branch_id }}">{{ $e->ename }}</option>
                @endforeach
            </select>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
            <button class="btn btn-danger reset-btn">Reset</button>  
          
        </div>
    </form>
</div>

<script>
    document.getElementById('examForm').addEventListener('submit', function(event) {
        event.preventDefault();

        var formData = new FormData(this);

        fetch('{{ route('get-exam-details') }}', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            console.log(data); 
            window.location.href = '{{ route('exam.show', ':branch_id') }}'.replace(':branch_id', data.branch_id);
        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
        });
    });
    document.querySelector('.reset-btn').addEventListener('click', function() { 
            location.reload();
        });
    
</script>
@endsection

 
