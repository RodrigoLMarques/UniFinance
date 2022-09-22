
<?php
    $apiKey = 'SRTVIMDWNAPL9QW2';
    $moedas = ['USD', 'EUR', 'GBP', 'ARS', 'CAD', 'AUD', 'JPY', 'CNY', 'CHF', 'MXN', 'NZD', 'SEK', 'DKK', 'NOK', 'HKD', 'RUB'];
    $acoes = ['IBOV', 'RRRP3', 'ALPA4', 'ABEV3', 'AMER3', 'ASAI3', 'AZUL4', 'B3SA3', 'BIDI11', 'BPAN4', 'BBSE3', 'BRML3', 'BBDC3', 'BBDC4', 'BRAP4', 'BBAS3', 'BRKM5', 'BRFS3', 'BPAC11', 'CRFB3', 'CCRO3', 'CMIG4', 'CIEL3', 'COGN3', 'CPLE6', 'CSAN3', 'CPFE3', 'CMIN3', 'CVCB3', 'CYRE3', 'DXCO3', 'ECOR3', 'ELET3', 'ELET6', 'EMBR3', 'ENBR3', 'ENGI11', 'ENEV3', 'EGIE3', 'EQTL3', 'EZTC3', 'FLRY3', 'GGBR4', 'GOAU4', 'GOLL4', 'NTCO3', 'SOMA3', 'HAPV3', 'HYPE3', 'IGTI11', 'GNDI3', 'IRBR3', 'ITSA4', 'ITUB4', 'JBSS3', 'JHSF3', 'KLBN11', 'RENT3', 'LCAM3', 'LWSA3', 'LAME4', 'LREN3', 'MGLU3', 'MRFG3', 'CASH3', 'BEEF3', 'MRVE3', 'MULT3', 'PCAR3', 'PETR3', 'PETR4', 'PRIO3', 'PETZ3', 'POSI3', 'QUAL3', 'RADL3', 'RDOR3', 'RAIL3', 'SBSP3', 'SANB11', 'CSNA3', 'SULA11', 'SUZB3', 'TAEE11', 'VIVT3', 'TIMS3', 'TOTS3', 'UGPA3', 'USIM5', 'VALE3', 'VIIA3', 'VBBR3', 'WEGE3', 'YDUQ3'];
    $multinacionais = ['MSFT34', 'AAPL34', 'AMZO34', 'TSLA34', 'DISB34'];


    set_time_limit(1000);
    foreach ($acoes as $i => $acao) {
        echo ($i+1)." - ".$acao.'<br>';
        $json = file_get_contents('https://www.alphavantage.co/query?function=GLOBAL_QUOTE&symbol='.$acao.'.SA&apikey='.$apiKey);
        $dados = json_decode($json, true);
        $dados = $dados["Global Quote"];
        echo "<pre>" . json_encode($dados, JSON_PRETTY_PRINT) . "</pre><br>";
        sleep(12);
    }

    // foreach ($moedas as $i => $moeda) {
    //     echo ($i+1)." - ".$moeda.'<br>';
    //     $json = file_get_contents('https://www.alphavantage.co/query?function=FX_DAILY&from_symbol='.$moeda.'&to_symbol=BRL&apikey='.$apiKey);
    //     $dados = json_decode($json, true);
    //     echo "<pre>" . json_encode($dados, JSON_PRETTY_PRINT) . "</pre><br>";
    //     sleep(12);
    // }
?>
