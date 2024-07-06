{{-- tasmiya code --}}
@extends('index')

@section('content')
    <div class="container m-5">
        <h5 class="text-center">CHANGE PASSWORD</h5>
        <form id="changePass">
            @csrf
            <div class="mb-3">
                <label for="old_pass" class="form-label">Old Password</label>
                <input type="text" class="form-control" id="old_pass" name="old_pass" placeholder="Enter Old Password"
                    required>
            </div>
            <div class="mb-3">
                <label for="new_pass" class="form-label">New Password</label>
                <input type="text" class="form-control" id="new_pass" name="new_pass" placeholder="Enter New Password"
                    required>
            </div>
            <div class="mb-3">
                <center><button type="submit" class="btn btn-primary mt-3">Change Password</button></center>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('changePass').addEventListener('submit', function(e) {
            e.preventDefault();
            var form = e.target;
            var formData = new FormData(form);
            var csrfToken = document.querySelector('meta[name="csrf-token"]').content;

            fetch('{{ route('changePass') }}', {
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
                    alert('Password changed successfully');
                })
                .catch((error) => {
                    const msg = Object.values(error).flat().join('\n');
                    alert(msg);
                });
            location.reload();
        });
    </script>
@endsection
