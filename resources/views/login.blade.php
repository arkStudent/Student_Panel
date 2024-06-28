<!DOCTYPE html>
<html lang="en">

<head>
    <title>login</title>
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
</head>

<body>
    <!-- [ auth-login ] start -->
    <form id="loginFormElement" method="post">
        @csrf
        <div class="auth-wrapper">
            <div class="auth-content text-center">
                <div class="card borderless">
                    <div class="row align-items-center ">
                        <div class="col-md-12">
                            <div class="card-body">
                                <h4 class="mb-3 f-w-400">login</h4>
                                <hr>
                                <div class="form-group mb-3">
                                    <input type="text" class="form-control" id="student_id" name="student_id"
                                        placeholder="Student Id">
                                </div>
                                <div class="form-group mb-4">
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="Password">
                                </div>
                                <button type="submit" class="btn btn-block btn-primary mb-4">login</button>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- [ auth-login ] end -->

    <!-- Required Js -->
    <script src="{{ asset('js/vendor-all.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/pcoded.min.js') }}"></script>

</body>

<script>
    document.addEventListener('submit', function(e) {
        e.preventDefault();

        var student_id = document.getElementById('student_id').value;
        var password = document.getElementById('password').value;

        // console.log('Payload:', {
        //     student_id: student_id,
        //     password: password
        // });

        fetch('/api/login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                        'content')
                },
                body: JSON.stringify({
                    student_id: student_id,
                    password: password
                })
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(errorData => {
                        throw errorData;
                    });
                }
                return response.json();
            })
            .then(data => {
                window.location.href = "{{ route('index') }}";
            })
            .catch(error => {
                const errorMessage = Object.values(error).flat().join('\n');
                alert(errorMessage);
            });
    });
</script>

{{-- 16STUD1041 --}}
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"></script> --}}

</html>
