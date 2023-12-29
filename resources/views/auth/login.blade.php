<!DOCTYPE html>
<html>

<head>
    <title>Slide Navbar</title>
    <link rel="stylesheet" type="text/css" href="slide navbar style.css">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
    <link href="{{ asset('backend') }}/css/login.css" rel="stylesheet" type="text/css">
</head>

<body>
    <div class="main">
        <input type="checkbox" id="chk" aria-hidden="true">

        <div class="signup">

        </div>

        <div class="login">
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <label for="chk" aria-hidden="true">Login</label>
                <input type="email" name="email" placeholder="Email" required="" value="admin@gmail.com">
                <input type="password" name="password" placeholder="Password" required="" value="12345678">
                <button type="submit">Login</button>
            </form>
        </div>
    </div>
</body>

</html>
