<!doctype html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Techlead</title>

    <!-- Bootstrap core CSS -->
    <link href="<?=$base?>/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=$base?>/assets/css/style-login.css" rel="stylesheet">
</head>

<body>
    <!-- check flahs messages -->
    <?php if($flash):?>
        <div class="alert alert-primary" role="alert">
            <?php echo $flash; ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>
    
    <!-- content section -->
    <main class="form-signin">
        <div class="form-box-title"><a href="<?=$base?>/">Book Manager</a></div>
        <div class="form-box">
            <form method="POST">
                <div class="form-group">
                    <label for="nameInput">Nome</label>
                    <input name="name" type="text" class="form-control" id="nameInput" aria-describedby="emailHelp">
                </div>
                <div class="form-group">
                    <label for="emailInput">E-mail</label>
                    <input name="email" type="email" class="form-control" id="emailInput">
                </div>
                <div class="form-group">
                    <label for="passwordInput">Senha</label>
                    <input name="password" type="password" class="form-control" id="passwordInput">
                </div>

                <div class="form-group">
                    <label for="passwordInput">Confirmar senha</label>
                    <input name="passwordConfirm" type="password" class="form-control" id="passwordInput">
                </div>

                <button type="submit" class="btn btn-primary">Cadastrar</button>
            </form>
        </div>
    </main>

    <!-- JS here! -->
    <script src="<?=$base?>/assets/js/jquery-3.5.1.min.js"></script>
    <script src="<?=$base?>/assets/js/bootstrap.min.js"></script>
</body>
</html>