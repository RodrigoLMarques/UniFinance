<?php
    $apiKeyAlpha = 'JV8R943NOAWODP48';
    $apiKeyHg = '9d062d9c';
    $acoes = ['RRRP3', 'ALPA4', 'ABEV3', 'AMER3', 'ASAI3', 'AZUL4', 'B3SA3', 'BPAN4', 'BBSE3', 'BRML3', 'BBDC3', 'BBDC4', 'BRAP4', 'BBAS3', 'BRKM5', 'BRFS3', 'BPAC11', 'CRFB3', 'CCRO3', 'CMIG4', 'CIEL3', 'COGN3', 'CPLE6', 'CSAN3', 'CPFE3', 'CMIN3', 'CVCB3', 'CYRE3', 'ECOR3', 'ELET3', 'ELET6', 'EMBR3', 'ENBR3', 'ENGI11', 'ENEV3', 'EGIE3', 'EQTL3', 'EZTC3', 'FLRY3', 'GGBR4', 'GOAU4', 'GOLL4', 'NTCO3', 'SOMA3', 'HAPV3', 'HYPE3', 'GNDI3', 'IRBR3', 'ITSA4', 'ITUB4', 'JHSF3', 'KLBN11', 'RENT3', 'LCAM3', 'LWSA3', 'LAME4', 'LREN3', 'MGLU3', 'MRFG3', 'CASH3', 'BEEF3', 'MRVE3', 'MULT3', 'PCAR3', 'PETR3', 'PETR4', 'PRIO3', 'PETZ3', 'POSI3', 'QUAL3', 'RADL3', 'RDOR3', 'RAIL3', 'SBSP3', 'SANB11', 'CSNA3', 'SULA11', 'SUZB3', 'TAEE11', 'TIMS3', 'TOTS3', 'UGPA3', 'USIM5', 'VALE3', 'VIIA3', 'VBBR3', 'WEGE3', 'MLAS3', 'YDUQ3'];
    $sp500 = ['AAPL', 'MSFT', 'AMZN', 'TSLA', 'GOOGL', 'GOOG', 'BRK.B', 'UNH', 'JNJ', 'XOM'];

    include "../model/Acao.php";
    $Acao = new Acao();

    set_time_limit(3000);
    foreach ($acoes as $i => $symbol) {

        $jsonAlpha = file_get_contents('https://www.alphavantage.co/query?function=GLOBAL_QUOTE&symbol='.$symbol.'.SA&apikey='.$apiKeyAlpha);
        $jsonHg = file_get_contents('https://api.hgbrasil.com/finance/stock_price?key='.$apiKeyHg.'&symbol='.$symbol);

        $dadosAlpha = json_decode($jsonAlpha, true);
        $dadosHg = json_decode($jsonHg, true);

        $dadosAlpha = $dadosAlpha["Global Quote"];
        $dadosHg = $dadosHg["results"][$symbol];

        $Acao->setNome($dadosHg["name"]);
        if ($Acao->getNome() == null) {
            $Acao->setNome($dadosHg[$symbol]);
        }

        $Acao->setSymbol($dadosHg["symbol"]);
        $Acao->setOpen($dadosAlpha["02. open"]);
        $Acao->setHigh($dadosAlpha["03. high"]);
        $Acao->setLow($dadosAlpha["04. low"]);
        $Acao->setPrice($dadosAlpha["05. price"]);
        $Acao->setVolume($dadosAlpha["06. volume"]);
        $Acao->setPreviousClose($dadosAlpha["08. previous close"]);
        $Acao->setChange($dadosAlpha["09. change"]);
        $Acao->setChangePercent($dadosAlpha["10. change percent"]);
        $Acao->setCompanyName($dadosHg["company_name"]);
        $Acao->setDocument($dadosHg["document"]);
        $Acao->setDescricao($dadosHg["description"]);
        $Acao->setWebsite($dadosHg["website"]);

        $Acao->cadastrar();
        sleep(13);
    }
?>