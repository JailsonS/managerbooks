<!doctype html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Techlead</title>

    <!-- Bootstrap core CSS -->
    <link href="<?=$base?>/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=$base?>/assets/css/style.css" rel="stylesheet">

</head>

<body>
    
    <!-- content section -->
    <main class="form-signin">
        <div class="form-box-title">Book Manager</div>
        <div class="form-box">
            <form method="POST">
                <div class="form-group">
                    <label for="emailInput">E-mail</label>
                    <input name="email" type="email" class="form-control" id="emailInput" aria-describedby="emailHelp">
                </div>
                <div class="form-group">
                    <label for="passwordInput">Senha</label>
                    <input name="password" type="password" class="form-control" id="passwordInput">
                </div>

                <button type="submit" class="btn btn-primary">Login</button>
                <hr>
                <small><a href="#">Cadastre-se aqui!</a></small>
            </form>
        </div>
    </main>

    <!-- JS here! -->
    <script src="<?=$base?>/assets/js/jquery-3.5.1.min.js"></script>
    <script src="<?=$base?>/assets/js/bootstrap.min.js"></script>
</body>
</html>