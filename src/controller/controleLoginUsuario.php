<?php 
    if (!isset($_POST["txtUsername"], $_POST["txtSenha"])) {
        $msg = "Ocorreu um erro no login, tente novamente.";
        header("location: ../view/loginUsuario.php?msg=$msg");
    }

    require_once "../model/Usuario.php";
    $Usuario = new Usuario();

    $Usuario->setUsername($_POST["txtUsername"]);
    $Usuario->setSenha($_POST["txtSenha"]);

    $formValido = true;
    if (!$Usuario->validarLogin()) {
        $msg = "Usuário não encontrado";
        $formValido = false;
    }

    if ($formValido == false) {
        $url = "../view/loginUsuario.php?msg=$msg&username=".$Usuario->getUsername();
        header("location: $url");
    } else {
        session_start();
        $Usuario = $Usuario->buscarPorUsername($Usuario->getUsername());
        $_SESSION["usuario"] = $Usuario->getIdUsuario();
        header("location: ../view/home.php"); 
    }
?>