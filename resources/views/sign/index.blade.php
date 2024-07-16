<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>elelu</title>
    <link rel="stylesheet" href="{{ asset('css/sign.css') }}">
</head>
<body>
<div class="container" id="container">
    <div class="form-container sign-up-container">
        <form action="/" method="POST">
            @csrf
            <h1>Create Account</h1>
            <input type="text" placeholder="Name" />
            <input type="email" placeholder="Email" />
            <input type="password" placeholder="Password" />
            <button type="submit">Sign Up</button>
        </form>
    </div>
    <div class="form-container sign-in-container">
        <form action="/login" method="POST">
            @csrf
            <h1>Sign in</h1>
            <input type="email" placeholder="Email" />
            <input type="password" placeholder="Password" />
            <button type="submit">Sign In</button>
        </form>
    </div>
    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-left">
                <h1>Holla Holla!</h1>
                <p>To keep connected with us please login with your personal info</p>
                <button class="ghost" id="signIn">Sign In</button>
            </div>
            <div class="overlay-panel overlay-right">
                <h1>Hello, MY Friends!</h1>
                <p></p>
                <button class="ghost" id="signUp">Sign Up</button>
            </div>
        </div>
        <a href="/" class="signIn">Back</a>
    </div>
</div>
<a href="/" class="">Back</a>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('form').on('submit', function(e) {
        e.preventDefault();
        const formData = $(this).serializeArray();
        const actionUrl = $(this).attr('action');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: actionUrl,
            method: 'POST',
            data: formData,
            success: function(response) {
                console.log(response.message);
                window.location.href = "/";
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });

    const signUpButton = document.getElementById('signUp');
    const signInButton = document.getElementById('signIn');
    const container = document.getElementById('container');

    signUpButton.addEventListener('click', () => {
        container.classList.add("right-panel-active");
    });

    signInButton.addEventListener('click', () => {
        container.classList.remove("right-panel-active");
    });
});
</script>
</body>
</html>
