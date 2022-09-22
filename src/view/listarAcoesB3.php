<?php 
    session_start();
    if (!isset($_SESSION["usuario"])) {
        header("location: loginUsuario.php");
    }

    if (isset($_GET['reset'])) {
        $_POST = array();
    }

    require_once "../model/Usuario.php";
    require_once "../model/Acao.php";

    $Usuario = new Usuario($_SESSION["usuario"]);

    $sql = "";
    if (isset($_GET["ordenar"])) {
        if ($_GET["ordenar"] == "crescente") {
            $sql = "order by change_percent desc";
        } else if ($_GET["ordenar"] == "decrescente") {
            $sql = "order by change_percent asc";
        }
    } else if (isset($_POST["busca"])) {
        $sql = "where locate('".$_POST["busca"]."', nome) > 0 or symbol = '".$_POST["busca"]."'";
    }

    $Acao = new Acao();
    $Acoes = $Acao->listar($sql);

    $header = "";
    $header .= "<th scope='col'>Ação</th>";
    $header .= "<th scope='col'>Símbolo</th>";
    if (isset($_POST["open"])) {
        $header .= "<th scope='col'>Open</th>";
    }
    if (isset($_POST["high"])) {
        $header .= "<th scope='col'>High</th>";
    }
    if (isset($_POST["low"])) {
        $header .= "<th scope='col'>Low</th>";
    }
    $header .= "<th scope='col'>Preço</th>";
    if (isset($_POST["volume"])) {
        $header .= "<th scope='col'>Volume</th>";
    }
    if (isset($_POST["fechamento"])) {
        $header .= "<th scope='col'>Prev. Fech.</th>";
    }
    if (isset($_POST["variation"])) {
        $header .= "<th scope='col'>Variação</th>";
    }
    $header .= "<th scope='col'>Variação (%)</th>";
    $header .= "<th scope='col' colspan='2'>Opções</th>";

    $linhas = "";
    foreach ($Acoes as $acao) {
        $linhas .= "<tr>";
        $linhas .= "<td>".$acao->getNome()."</td>";
        $linhas .= "<td>".$acao->getSymbol()."</td>";

        if (isset($_POST["open"])) {
            $linhas .= "<td>".$acao->getOpen()."</td>";
        } 
        if (isset($_POST["high"])) {
            $linhas .= "<td>".$acao->getHigh()."</td>";
        }
        if (isset($_POST["low"])) {
            $linhas .= "<td>".$acao->getLow()."</td>";
        }

        $linhas .= "<td>".$acao->getPrice()."</td>";

        if (isset($_POST["volume"])) {
            $linhas .= "<td>".$acao->getVolume()."</td>";
        }
        if (isset($_POST["fechamento"])) {
            $linhas .= "<td>".$acao->getPreviousClose()."</td>";
        }
        if (isset($_POST["variation"])) {
            $linhas .= "<td>".$acao->getChange()."</td>";
        }

        if ($acao->getChangePercent() > 0) {
            $linhas .= "<td style='color:green'>";
        } else if ($acao->getChangePercent() < 0) {
            $linhas .= "<td style='color:red'>";
        } else {
            $linhas .= "<td>";
        }
        $linhas .= $acao->getChangePercent()."%</td>";

        $linhas .= "<td><form action='graficoAcao.php' method='post'><input class='btn' type='submit' value='Grafico' style='background-color:#d64933; color:white'></form></td>";
        $linhas .= "<td><form action='favoritar.php' method='post'><input class='btn' type='submit' value='Favoritar' style='background-color:#d64933; color:white'></form></td>"; 
        $linhas .= "</tr>";
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ibovespa</title>

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
                            <a class="nav-link" href="servicos.php"></i>Serviços</a>
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
        <div class="container pt-3">
            
            <form action="listarAcoesB3.php" method="post">
                <div class="form-group">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="busca" placeholder="Buscar por nome ou símbolo" aria-label="Buscar por nome ou símbolo">
                        <div class="input-group-append">
                            <input type="submit" class="btn btn-outline-secondary" style="background-color:#d64933; color:white;" value="Buscar">
                            <input type="submit" class="btn btn-outline-secondary" style="background-color:#d64933; color:white;" formaction="listarAcoesB3.php?ordenar=crescente" value="Ordenar &uarr;">
                            <input type="submit" class="btn btn-outline-secondary" style="background-color:#d64933; color:white;" formaction="listarAcoesB3.php?ordenar=decrescente" value="Ordenar &darr;">
                        </div>
                    </div>
                </div>
            </form>

            <form class="my-3" action="listarAcoesB3.php" method="post" style="color:white">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="open" value="1" <?php if (isset($_POST["open"])) { echo "checked"; } ?>>
                    <label class="form-check-label" for="open">Open</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="high" value="2" <?php if (isset($_POST["high"])) { echo "checked"; } ?>>
                    <label class="form-check-label" for="high">High</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="low" value="2" <?php if (isset($_POST["low"])) { echo "checked"; } ?>>
                    <label class="form-check-label" for="low">low</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="volume" value="2" <?php if (isset($_POST["volume"])) { echo "checked"; } ?>>
                    <label class="form-check-label" for="volume">volume</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="fechamento" value="2" <?php if (isset($_POST["fechamento"])) { echo "checked"; } ?>>
                    <label class="form-check-label" for="fechamento">Prev. Fech.</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="variation" value="2" <?php if (isset($_POST["variation"])) { echo "checked"; } ?>>
                    <label class="form-check-label" for="variation">Variação</label>
                    <input class="btn ml-3" type="submit" value="Confirmar" style="background-color:#d64933; color:white">
                    <input class="btn ml-3" type="submit" formaction="listarAcoesB3.php?reset=true" value="Resetar" style="background-color:#d64933; color:white">
                </div>
            </form>
   
            <table class="table table-striped text-center" style="background-color: white;">
                <thead class="thead-dark">
                    <tr>
                        <?php echo $header ?>
                    </tr>
                </thead>
                <tbody>
                    <?php echo $linhas ?>
                </tbody> 
            </table>
        </div>
    </section>

    <footer></footer>
</body>
</html>