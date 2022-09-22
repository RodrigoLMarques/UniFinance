<?php 
    session_start();
    if (isset($_SESSION["usuario"])) {
        header("location: ../view/home.php");
    }

    $msg      = "";
    $username = "";
    $email    = "";

    if (isset($_GET["msg"])) {
        $msg = $_GET["msg"];
    }
    if (isset($_GET["username"])) {
        $username = isset($_GET["username"]);
    }
    if (isset($_GET["email"])) {
        $email = isset($_GET["email"]);
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registre-se</title>

    <link rel="stylesheet" href="css/formulario.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body style="background-color: #2b303a">
<div id="login">
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="registrar-box" class="col-md-12">
                        <form id="login-form" class="form" action="../controller/controleCadastrarUsuario.php" method="post">
                            <h3 class="text-center" style="color:white">Registre-se</h3>
                            <div class="form-group">
                                <label for="username">Usuário:</label><br>
                                <input type="text" name="txtUsername" class="form-control" value="<?php echo $username ?>" autocomplete="off" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label><br>
                                <input type="email" name="txtEmail" class="form-control" value="<?php echo $email ?>" autocomplete="off" required>
                            </div>
                            <div class="form-group">
                                <label for="senha">Senha:</label><br>
                                <input type="password" name="txtSenha" class="form-control" autocomplete="off" required>
                            </div>
                            <div class="form-group">
                                <label for="confirmarSenha">Confirmar Senha:</label><br>
                                <input type="password" name="txtConfirmarSenha" class="form-control" autocomplete="off" required>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-md btn-dark" value="Registrar">
                                <a id="register-link" href="loginUsuario.php">Já tem uma conta?</a>
                                <?php echo $msg ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>