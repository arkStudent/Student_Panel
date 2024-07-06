{{-- lubna code --}}
@extends('index')

@section('content')
    <div class="container ">
        <h4 class="text-center" style="text-decoration:underline">ATTENDANCE</h4>
        <form id="attendForm" method="post" action="{{ route('attend.table') }}">
            @csrf <!-- This will generate the CSRF token field -->
            <div class="mb-3">
                <label for="fdate" class="form-label">From Date</label>
                <input type="date" class="form-control" id="fdate" name="fdate" required>
            </div>
            <div class="mb-3">
                <label for="tdate" class="form-label">To Date</label>
                <input type="date" class="form-control" id="tdate" name="tdate" required>
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


    {{-- <script>
        $(document).ready(function() {
            $('#attendForm').on('submit', function(e) {
                e.preventDefault(); // Prevent the default form submission
                var fdate = $('#fdate').val(); // From Date
                var tdate = $('#tdate').val(); // To Date
                $.ajax({
                    url: '{{ route('attend.table') }}', // URL to send the request to
                    type: 'POST', // HTTP method
                    data: {
                        _token: '{{ csrf_token() }}', // CSRF token for security
                        fdate: fdate,
                        tdate: tdate
                    },
                    success: function(response) {
                        // Handle the response from the server
                        console.log(response); // Check the response in the browser console
                        $('#content').html(response); // Assuming 'main-content' is the container where you want to replace the view content
                    },
                    error: function(xhr, status, error) {
                        // Handle errors
                        console.error(error);
                        alert('An error occurred while submitting the form');
                    }
                });
            });
        });
    </script> --}}
