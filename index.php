<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <style>
    body {
      background-color: #f5f5f5;
    }

    .card {
      margin-top: 50px;
      box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
      transition: 0.3s;
    }

    .card:hover {
      box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
    }

    .card-header {
      background-color: #007bff;
      color: #fff;
      text-align: center;
      font-weight: bold;
      font-size: 24px;
    }

    .form-control:focus {
      border-color: #007bff;
      box-shadow: none;
    }

    .btn-primary {
      background-color: #007bff;
      border-color: #007bff;
    }

    .btn-primary:hover {
      background-color: #b7d5e5;
      border-color: #b7d5e5;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">Login</div>
          <div class="card-body">
            <form method="POST" action="auth.php">
              <div class="form-group">
                <label for="login">Usuário:</label>
                <input type="text" class="form-control" id="login" placeholder="Entre com o usuário" name="login" required>
              </div>
              <div class="form-group">
                <label for="senha">Senha:</label>
                <input type="password" class="form-control" id="senha" placeholder="Entre com a senha" name="senha" required>
              </div>
              <input type="submit" class="btn btn-primary btn-block" value="Login"></button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>