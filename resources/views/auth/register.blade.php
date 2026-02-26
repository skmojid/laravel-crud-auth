<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex align-items-center" style="height:100vh;">

<main class="w-100">
<form action="{{ route('register') }}" method="post">
@csrf

<div class="container justify-content-center mt-5 col-md-4 bg-white p-4 rounded shadow">

    <h1 class="text-center mb-4">Sign Up</h1>

    <div class="mb-3">
        <label for="name" class="form-label">Name:</label>
        <input type="text" name="name" id="name" class="form-control">
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email:</label>
        <input type="email" name="email" id="email" class="form-control">
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Password:</label>
        <input type="password" name="password" id="password" class="form-control">
    </div>


    <div class="d-grid mb-3">
        <button type="submit" class="btn btn-success">Register</button>
    </div>

    <footer class="text-center">
        Already a member? 
        <a href="{{ route('login') }}" class="text-decoration-none">Login here</a>
    </footer>

</div>

</form>
</main>

</body>
</html>