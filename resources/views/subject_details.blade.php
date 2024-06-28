 @extends('index')

 @section('content')
     <div class="container text-center">
         <h3>Subject Details</h3>
         <h6><strong>Academic Year {{ session('academic_year') }}</strong></h6>
     </div>

     <style>
        .top-content{
            background-color: #d9d9d9;
        }
    </style>
     <div class="container mt-3">
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
             <tbody>
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

     <script>
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
                     document.getElementById('academicYear').textContent = data.academic_year;
                     document.getElementById('standard').textContent = data.std;
                     document.getElementById('division').textContent = data.dv;

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
