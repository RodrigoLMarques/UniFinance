<?php 
    require_once "../model/Moeda.php";
    $Moeda = new Moeda();

    $json = file_get_contents('https://economia.awesomeapi.com.br/last/USD-BRL,EUR-BRL,GBP-BRL,ARS-BRL,CLP-BRL,COP-BRL,UYU-BRL,CAD-BRL,AUD-BRL,JPY-BRL');
    $dados = json_decode($json, true);

    foreach ($dados as $moeda) {
        $Moeda->setNome($moeda["name"]);
        $Moeda->setSymbol($moeda["code"]);
        $Moeda->setBuy($moeda["bid"]);
        $Moeda->setSell($moeda["ask"]);
        $Moeda->setVariation($moeda["varBid"]);
        $Moeda->setPctVariation($moeda["pctChange"]);
        $Moeda->cadastrar();
    }


    $json = file_get_contents('https://economia.awesomeapi.com.br/last/TRY-BRL,CNY-BRL,CHF-BRL,MXN-BRL,NZD-BRL,SEK-BRL,DKK-BRL,NOK-BRL,HKD-BRL,RUB-BRL');
    $dados = json_decode($json, true);

    foreach ($dados as $moeda) {
        $Moeda->setNome($moeda["name"]);
        $Moeda->setSymbol($moeda["code"]);
        $Moeda->setBuy($moeda["bid"]);
        $Moeda->setSell($moeda["ask"]);
        $Moeda->setVariation($moeda["varBid"]);
        $Moeda->setPctVariation($moeda["pctChange"]);
        $Moeda->cadastrar();
    }

    $json = file_get_contents('https://economia.awesomeapi.com.br/last/AED-BRL,BOB-BRL,INR-BRL,PEN-BRL,PLN-BRL,SAR-BRL,TWD-BRL,ILS-BRL,PYG-BRL,THB-BRL');
    $dados = json_decode($json, true); 
    
    // cripto DOGE-BRL BTC-BRL ETH-BRL LTC-BRL 

    foreach ($dados as $moeda) {
        $Moeda->setNome($moeda["name"]);
        $Moeda->setSymbol($moeda["code"]);
        $Moeda->setBuy($moeda["bid"]);
        $Moeda->setSell($moeda["ask"]);
        $Moeda->setVariation($moeda["varBid"]);
        $Moeda->setPctVariation($moeda["pctChange"]);
        $Moeda->cadastrar();
    }


    // echo "<pre>" . json_encode($dados, JSON_PRETTY_PRINT) . "</pre><br>";  
?>