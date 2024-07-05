{{--   
 @extends('index')

@section('content')

<style>
    .card {
        margin-top: 20px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    .card-header {
        background-color: #f0f0f0;
        padding: 10px;
    }

    .card-body {
        padding: 20px;
    }

    .top-content {
        background-color: #d9d9d9;
    }
    .table th,
    .table td {
        white-space: normal;  
        max-width: 400px;  
    }
    
</style>

<div class="container">
    <div class="card">
        <div class="card-header">
            <span>
                <div class="container text-center">
                    <h4 style="margin-bottom: 10px; text-decoration: underline;">Subject Details</h4> <!-- Adding margin-bottom to create space -->
                    <h6 style="margin-bottom: 20px;"><strong style="font-size: 17px; color: #888;">Academic Year : {{ session('academic_year') }}</strong></h6> <!-- Adding margin-bottom to create more space -->
                </div>
            </span>
            <div class="container">
                <table border="1" style="border-collapse: collapse;" class="top-content table table-bordered">
                    <tbody>
                        <tr>
                            <td><strong>Faculty Name:</strong> <span id="facultyName">{{ $fname }}</span></td>
                            <th><strong>Standard:</strong> <span>{{ session('std') }}</span></th>
                            <th><strong>Division:</strong> <span>{{ session('dv') }}</span></th>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
        
        <div class="card-body">
            
            <div class="container mt-3">
                <table class="table table-striped table-bordered text-center mt-3">
                    <thead class="thead-dark">
                        <tr>
                            <th>Sl No.</th>
                            <th>Topic</th>
                            <th>Subtopic</th>
                            <th>Class ID</th>
                        </tr>
                    </thead>
                    <tbody id="lessonsTableBody">
                        @foreach ($lessons as $index => $lesson)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $lesson->topic }}</td>
                            <td>{{ $lesson->sub_topic }}</td>
                            <td>{{ $lesson->class_id }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="text-center mt-3">
                <button class="btn btn-primary" onclick="window.print()"><i class="fa fa-print"></i> Print</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
     

        // AJAX form submission code remains unchanged as per your existing script
        document.getElementById('subjectForm').addEventListener('submit', function(event) {
            event.preventDefault();

            var formData = new FormData(this);

            fetch('{{ route('get-subject-details') }}', {
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
                document.getElementById('facultyName').textContent = data.fname;
                // Update other elements as needed based on your response data

                var lessonsTableBody = document.getElementById('lessonsTableBody');
                lessonsTableBody.innerHTML = '';
                data.lessons.forEach((lesson, index) => {
                    var row = `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${lesson.topic}</td>
                            <td>${lesson.sub_topic}</td>
                            <td>${lesson.class_id}</td>
                        </tr>`;
                    lessonsTableBody.insertAdjacentHTML('beforeend', row);
                });
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
            });
        });
    });
</script>
@endsection --}}
  
 @extends('index')

@section('content')

<style>
    .card {
        margin-top: 20px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    .card-header {
        background-color: #f0f0f0;
        padding: 10px;
    }

    .card-body {
        padding: 20px;
    }

    .top-content {
        background-color: #d9d9d9;
    }
    .table th,
    .table td {
        white-space: normal;  
        max-width: 400px;  
    }
    
</style>

<div class="container">
    <div class="card">
        <div class="card-header">
            <span>
                <div class="container text-center">
                    <h4 style="margin-bottom: 10px; text-decoration: underline;">Lesson Plan Report</h4> <!-- Adding margin-bottom to create space -->
                    <h6 style="margin-bottom: 20px;"><strong style="font-size: 17px; color: #888;">Academic Year : {{ session('academic_year') }}</strong></h6> <!-- Adding margin-bottom to create more space -->
                </div>
            </span>
            <div class="container">
                <table border="1" style="border-collapse: collapse;" class="top-content table table-bordered">
                    <tbody>
                        <tr>
                            <td><strong>Faculty Name:</strong> <span id="facultyName">{{ $fname }}</span></td>
                            <td><strong>Standerd:</strong> <span id="std">{{ $std }}</span></td>
                            <td><strong>Division:</strong> <span id="dv">{{ $dv }}</span></td>
                           </tr>
                    </tbody>
                </table>
            </div>

        </div>
        
        <div class="card-body">
            
            <div class="container mt-3">
                <table class="table table-striped table-bordered text-center mt-3">
                    <thead class="thead-dark">
                        <tr>
                            <th>Sl No.</th>
                            <th>Topic</th>
                            <th>Subtopic</th>
                            {{-- <th>Class ID</th> --}}
                        </tr>
                    </thead>
                    <tbody id="lessonsTableBody">
                        @foreach ($lessons as $index => $lesson)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $lesson->topic }}</td>
                            <td>{{ $lesson->sub_topic }}</td>
                            {{-- <td>{{ $lesson->class_id }}</td> --}}
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="text-center mt-3">
                <button class="btn btn-primary" onclick="window.print()"><i class="fa fa-print"></i> Print</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
     

        // AJAX form submission code remains unchanged as per your existing script
        document.getElementById('subjectForm').addEventListener('submit', function(event) {
            event.preventDefault();

            var formData = new FormData(this);

            fetch('{{ route('get-subject-details') }}', {
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
                document.getElementById('facultyName').textContent = data.fname;
                // Update other elements as needed based on your response data

                var lessonsTableBody = document.getElementById('lessonsTableBody');
                lessonsTableBody.innerHTML = '';
                data.lessons.forEach((lesson, index) => {
                    var row = `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${lesson.topic}</td>
                            <td>${lesson.sub_topic}</td>
                            <td>${lesson.class_id}</td>
                        </tr>`;
                    lessonsTableBody.insertAdjacentHTML('beforeend', row);
                });
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
            });
        });
   
</script>
@endsection
