@extends('index')

@section('content')
    <div class="container m-5">
        <h5 class="text-center">FORGOT PASSWORD</h5>
        <form id="forgotPass">
            @csrf
            <div class="mb-3">
                <label for="password" class="form-label">New Password</label>
                <input type="text" class="form-control" id="pass" name="pass" placeholder="Enter New Password"
                    required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Confirm Password</label>
                <input type="text" class="form-control" id="cpass" name="cpass" placeholder="Confirm New Password"
                    required>
            </div>
            <div class="mb-3">
                <center><button type="submit" class="btn btn-primary mt-3">Submit</button></center>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('forgotPass').addEventListener('submit', function(e) {
            e.preventDefault();
            var form = e.target;
            var formData = new FormData(form);
            var csrfToken = document.querySelector('meta[name="csrf-token"]').content;

            fetch('{{ route('forgotPass') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: formData
                })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(errorData => {
                            throw errorData
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    alert('Password set successfully');
                })
                .catch((error) => {
                    const msg = Object.values(error).flat().join('\n');
                    alert(msg);
                });
                location.reload();
        });
    </script>
@endsection
