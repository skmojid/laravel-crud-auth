<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex align-items-center" style="height:100vh;">

<form action="{{ route('login') }}" method="post" class="w-100">
@csrf

  <div class="container mt-5 col-md-4 bg-white p-4 rounded shadow text-center">
    <h1 class="mb-3">Login</h1>
    <p class="text-muted">Please fill in this form to login.</p>
  </div>

  <div class="container col-md-4 bg-white p-4 shadow-sm">
    <label class="form-label"><b>Email</b></label>
    <input type="text" class="form-control mb-3" placeholder="Enter email" name="email" required>

    <label class="form-label"><b>Password</b></label>
    <input type="password" class="form-control mb-5" placeholder="Enter Password" name="password" required>

    <button type="submit" class="btn btn-primary w-100 mb-3">Login</button>

    <div class="">
      <label class="text-dark"><b>Need to create an account?</b></label>
      <a href="{{route('register')}}" class="float-end text-dark"><b>Sign Up</b></a>
    </div>
  </div>

 

</form>

</body>
</html>