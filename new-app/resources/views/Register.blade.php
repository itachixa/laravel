<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Register Form</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css">
</head>
<body>
    <div class="bg-img">
        <div class="content">
            <header>Register Form</header>
            <form action="{{ route('register.post') }}" method="POST">
    @csrf
    <div class="field">
        <span class="fa fa-user"></span>
        <input type="text" name="name" value="{{ old('name') }}" required placeholder="Name">
        @error('name')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="field">
        <span class="fa fa-envelope"></span>
        <input type="email" name="email" value="{{ old('email') }}" required placeholder="Email">
        @error('email')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="field">
        <span class="fa fa-phone"></span>
        <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" required placeholder="Phone Number">
        @error('phone')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="field space">
        <span class="fa fa-lock"></span>
        <input type="password" class="pass-key" name="password" required placeholder="Password">
        <span class="show">SHOW</span>
        @error('password')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="field space">
        <span class="fa fa-lock"></span>
        <input type="password" class="pass-key" name="password_confirmation" required placeholder="Confirm Password">
        <span class="show">SHOW</span>
    </div>
    <div class="field">
        <input type="submit" value="REGISTER">
    </div>
</form>

            <div class="login">
                Already have an account?
                <a href="{{ route('login') }}">Login Now</a>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <script>
        const pass_fields = document.querySelectorAll('.pass-key');
        const showBtns = document.querySelectorAll('.show');
        
        showBtns.forEach((btn, index) => {
            btn.addEventListener('click', function(){
                if(pass_fields[index].type === "password"){
                    pass_fields[index].type = "text";
                    btn.textContent = "HIDE";
                    btn.style.color = "#3498db";
                }else{
                    pass_fields[index].type = "password";
                    btn.textContent = "SHOW";
                    btn.style.color = "#222";
                }
            });
        });

        // Initialize intl-tel-input plugin
        const input = document.querySelector("#phone");
        const iti = intlTelInput(input, {
            initialCountry: "auto",
            geoIpLookup: function(callback) {
                fetch("https://ipinfo.io/json")
                    .then(response => response.json())
                    .then(data => callback(data.country))
                    .catch(() => callback("us"));
            },
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
        });
    </script>
    @if(session('success'))
    <div>
        <br>
    <div class="alert alert-success" style="position: fixed; bottom: 0; width: 100%; text-align: center;">
        {{ session('success') }}
    </div>
    <br>
    </div>
@endif

@if ($errors->any())
<div><br>
    <div class="alert alert-danger" style="position: fixed; bottom: 0; width: 100%; text-align: center;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    <br>
    </div>
@endif

</body>
</html>
