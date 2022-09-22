<?php 
    session_start();
    if (isset($_SESSION["usuario"])) {
        header("location: ../view/home.php");
    }

    $msg     = "";
    $username = "";
    
    if (isset($_GET["msg"])) {
        $msg = $_GET["msg"];
    }
    if (isset($_GET["username"])) {
        $username = $_GET["username"];
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

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
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="../controller/controleLoginUsuario.php" method="post">
                            <h3 class="text-center" style="color:white">Login</h3>
                            <div class="form-group">
                                <label for="username">Usuário:</label><br>
                                <input type="text" name="txtUsername" id="username" class="form-control" value="<?php echo $username ?>" autocomplete="off" required>
                            </div>
                            <div class="form-group">
                                <label for="senha">Senha:</label><br>
                                <input type="password" name="txtSenha" id="password" class="form-control" autocomplete="off" required>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-md btn-dark" value="Entrar">
                                <a id="register-link" href="cadastrarUsuario.php">Registre aqui</a>
                                <?php echo $msg ?>
                            </div>
                            <!-- <div class="form-group">
                                <center><label for="senha">Não tem uma conta?</label><br>
                                <input type="submit" class="btn btn-md btn-dark btn-block" value="Criar uma conta"></center>
                            </div>
                             -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>