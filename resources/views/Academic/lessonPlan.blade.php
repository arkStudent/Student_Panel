@extends('index')

@section('content')
    <div class="container">
        <div class="text-center mb-4">
            <h3>Lesson Plan</h3>
        </div>
        <form id="subjectForm" method="POST">
            @csrf
            <div class="mb-3">
                <label for="subject" class="form-label">Select Subject:</label>
                <select id="subject" name="subject" class="form-control">
                    <option value="" selected disabled>Select Subject</option>
                    @foreach ($subjects as $subject)
                        <option value="{{ $subject->sub_id }}">{{ $subject->sname }}</option>
                    @endforeach
                </select>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
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
                    // Redirect to subject details page with sub_id
                    window.location.href = '{{ route('subjects.show', ':sub_id') }}'.replace(':sub_id', data
                        .sub_id);
                })
                .catch(error => {
                    console.error('There was a problem with the fetch operation:', error);
                });
        });
    </script>
@endsection
