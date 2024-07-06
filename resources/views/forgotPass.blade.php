{{-- tasmiya code  --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Forgot Password</title>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <meta name="keywords" content="">
    <meta name="author" content="Phoenixcoded" />

    <!-- CSRF Token Meta Tag -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- vendor css -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .card {
            width: 27rem;
            margin-right: 100px;
        }
    </style>
</head>

<body>

    <form id="forgotPass" method="post">
        @csrf
        <div class="auth-wrapper">
            <div class="auth-content">
                <div class="card borderless">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="card-body">
                                <h4 class="mb-3 f-w-400 text-center">Forgot Password</h4>
                                <hr>
                                <div class="form-group mb-3">
                                    <label for="dob" class="form-label">Date of Birth</label>
                                    <input type="date" class="form-control" id="dob" name="dob"
                                        placeholder="Enter Date-of-birth" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="s_id" class="form-label">Student ID</label>
                                    <input type="text" class="form-control" id="s_id" name="s_id"
                                        placeholder="Enter Student Id" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="pass" class="form-label">New Password</label>
                                    <input type="text" class="form-control" id="pass" name="pass"
                                        placeholder="Enter New Password" required>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="old_pass" class="form-label">Old Password</label>
                                    <input type="password" class="form-control" id="cpass" name="cpass"
                                        placeholder="Confirm New Password" required>
                                </div>
                                <button type="submit" class="btn btn-block btn-primary mb-4">Submit</button>
                                <hr>
                                <div class="text-center">
                                    <a href="{{ route('login') }}" style="text-decoration:underline;">Login</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Required Js -->
    <script src="{{ asset('js/vendor-all.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/pcoded.min.js') }}"></script>

</body>

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
                window.location.href = '{{ route('login') }}';
            })
            .catch((error) => {
                const msg = Object.values(error).flat().join('\n');
                alert(msg);
                // location.reload();
            });
    });
</script>

</html>
