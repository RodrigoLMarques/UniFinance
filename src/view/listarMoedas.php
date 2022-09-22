<?php 
    session_start();
    if (!isset($_SESSION["usuario"])) {
        header("location: loginUsuario.php");
    }

    require_once "../model/Usuario.php";
    require_once "../model/Moeda.php";

    $Usuario = new Usuario($_SESSION["usuario"]);

    $sql = "";
    if (isset($_GET["ordenar"])) {
        if ($_GET["ordenar"] == "crescente") {
            $sql = "order by variation asc";
        } else if ($_GET["ordenar"] == "decrescente") {
            $sql = "order by variation desc";
        }
    } else if (isset($_POST["busca"])) {
        $sql = "where locate('".$_POST["busca"]."', nome) > 0 or symbol = '".$_POST["busca"]."'";
    }

    $Moeda = new Moeda();
    $Moedas = $Moeda->listar($sql);

    $linhas = "";
    foreach ($Moedas as $moeda) {
        $linhas .= "<tr>";
        $linhas .= "<td>".$moeda->getNome()."</td>";
        $linhas .= "<td>".$moeda->getSymbol()."</td>";
        $linhas .= "<td>".$moeda->getBuy()."</td>";

        if ($moeda->getSell() == "") {
            $linhas .= "<td>".$moeda->getBuy()."</td>";
        } else {
            $linhas .= "<td>".$moeda->getSell()."</td>";
        }

        $linhas .= "<td>".$moeda->getVariation()."</td>";

        if ($moeda->getPctVariation() > 0) {
            $linhas .= "<td style='color:green'>";
        } else if ($moeda->getPctVariation() < 0) {
            $linhas .= "<td style='color:red'>";
        } else {
            $linhas .= "<td>";
        }
        $linhas .= $moeda->getPctVariation()."%</td>";

        $linhas .= "</tr>";
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Câmbio</title>

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
                            <a class="nav-link" href="home.php"></i>Quem Somos?</a>
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
            
            <form action="listarMoedas.php" method="post">
                <div class="form-group">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="busca" placeholder="Buscar por nome ou símbolo" aria-label="Buscar por nome ou símbolo">
                        <div class="input-group-append">
                            <input type="submit" class="btn btn-outline-secondary" style="background-color:#d64933; color:white;" value="Buscar">
                            <input type="submit" class="btn btn-outline-secondary" style="background-color:#d64933; color:white;" formaction="listarMoedas.php?ordenar=crescente" value="Ordenar &uarr;">
                            <input type="submit" class="btn btn-outline-secondary" style="background-color:#d64933; color:white;" formaction="listarMoedas.php?ordenar=decrescente" value="Ordenar &darr;">
                        </div>
                    </div>
                </div>
            </form>
            
            <table class="table table-striped" style="background-color: white;">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Moeda</th>
                        <th scope="col">Símbolo</th>
                        <th scope="col">Compra</th>
                        <th scope="col">Venda</th>
                        <th scope="col">Variação</th>
                        <th scope="col">Variação em %</th>
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