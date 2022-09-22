<?php
    session_start();
    if (!isset($_SESSION["usuario"])) {
        header("location: loginUsuario.php");
    }

    require_once "../model/Usuario.php";
    $Usuario = new Usuario($_SESSION["usuario"]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bolsa de Valores</title>

    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/postboot.min.css"/>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/postboot.min.js"></script>

    <link rel="stylesheet" href="css/home.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
</head>
<body style="background-color: #2B303A;">

    <header class="sticky-top">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand text-white" href="home.php"></i>UniFinance</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nvbCollapse" aria-controls="nvbCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item pl-1">
                            <a class="nav-link" href="home.php"></i>Quem Somos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="#"></i>Serviços</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"></i>Blog</a>
                        </li>
                        <div class="dropdown pl-1">
                            <div class="nav-link pl-5 dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php echo $Usuario->getUsername() ?>
                            </div>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <center><span><?php echo $Usuario->getUsername() ?></span></center>
                                <center><span class="mx-auto"><?php echo $Usuario->getEmail();?></span></center>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="gerenciarConta.php">Gerenciar Conta</a>
                                <a class="dropdown-item" href="../controller/logout.php">Sair da Conta</a>
                            </div>
                        </div>
                    </ul>
                </div>
            </div>
        </nav>
	</header>


    <section>
    
        <div class="container-fluid mx-auto">
            <div class="row">
                <div class="col">
                    <div class="card mx-auto mt-5" style="width: 18rem; ">
                        <h2 class="text-center" style="font-size: 6rem">[B]³</h2>
                        <div class="card-body" style="background-color: #3a86ff; color:white">
                            <h5 class="card-title">B3</h5>
                            <p class="card-text">B3 é a bolsa de valores oficial do Brasil, sediada na cidade de São Paulo.</p>
                            <a href="listarAcoesB3.php" class="btn btn-light" style="background-color: #d64933; color:white">Visualizar</a>
                        </div>
                    </div>
                </div>
            
                <div class="col">
                    <div class="card mx-auto mt-5" style="width: 18rem; ">
                        <h2 class="text-center" style="font-size: 3rem">Standard & <br>Poor's</h2>
                        <div class="card-body" style="background-color: #3a86ff; color:white">
                            <h5 class="card-title">S&P 500 Top 10</h5>
                            <p class="card-text">S&P é um índice composto por quinhentos ativos cotados nas bolsas de NYSE ou NASDAQ</p>
                            <a href="#" class="btn btn-light" style="background-color: #d64933; color:white">Visualizar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer></footer>
</body>
</html>