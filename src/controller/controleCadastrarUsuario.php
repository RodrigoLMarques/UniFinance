<?php 
    if (!isset($_POST["txtUsername"], $_POST["txtEmail"], $_POST["txtSenha"], $_POST["txtConfirmarSenha"])) {
        $msg = "Ocorreu um erro no cadastro, tente novamente.";
        header("location: ../view/cadastrarUsuario.php?msg=$msg");
    }

    require_once "../model/Usuario.php";
    $Usuario = new Usuario();

    $Usuario->setUsername($_POST["txtUsername"]);
    $Usuario->setEmail($_POST["txtEmail"]);
    $Usuario->setSenha($_POST["txtSenha"]);
    $confirmarSenha = $_POST["txtConfirmarSenha"];

    $formValido = true;
    if (!preg_match("/^\w{5,15}$/", $Usuario->getUsername())) {
        $msg = "Username Inválido!";
        $formValido= false;
    } else if (!filter_var($Usuario->getEmail(), FILTER_VALIDATE_EMAIL)) {
        $msg = "Email Inválido!";
        $formValido = false;
    } else if ($Usuario->getSenha() != $confirmarSenha) {
        $msg = "Confirmação de Senha Inválido!";
        $formValido = false;
    } else if ($Usuario->validarUsername()) {
        $msg = "Username já existente.";
        $formValido = false;
    } else if ($Usuario->validarEmail()) {
        $msg = "Email já cadastrado.";
        $formValido = false;
    }

    if ($formValido == false) {
        $url = "../view/cadastrarUsuario.php?msg=$msg&username=".$Usuario->getUsername()."&email=".$Usuario->getEmail();
        header("location: $url");
    } else {
        $resultado = $Usuario->cadastrar();
        if ($resultado == true) {
            session_start();
            $_SESSION["usuario"] = $Usuario->getIdUsuario();

            header("location: ../view/home.php");
        } else {
            $msg = "Erro ao cadastrar.";
            header("location: ../view/cadastrarUsuario.php?msg=$msg");
        } 
    }