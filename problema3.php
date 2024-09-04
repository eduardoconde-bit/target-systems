<?php 
    require_once(__DIR__."/php/Invoicing.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./php/style.css">
    <title>Document</title>
</head>
<body>
    <main>
        <h1>Distribuidora</h1>
        
        <form action="problema3.php" method="post" enctype="multipart/form-data">
            <label for="file">Entre com o arquivo de faturamento</label>
            <input id="file" type="file" name="invoicing_file">
            <button>Processar</button>
        </form>

        <?php

            function formatToBRL($value, $isInteger = false) {
                if ($isInteger) {
                    return number_format($value, 0, ',', '.'); // Inteiro: sem casas decimais
                } else {
                    return number_format($value, 2, ',', '.'); // Decimal: duas casas decimais
                }
            }

            if($_SERVER["REQUEST_METHOD"] === "POST") {
                if(isset($_FILES["invoicing_file"]) && !$_FILES["invoicing_file"]["error"]) {
                    $file = $_FILES['invoicing_file']['tmp_name'];

                    $fileLoader = new FileLoader($file);
                    $invoicingProcess = new Invoicing($fileLoader);

                    if(!$invoicingProcess->invoicingProcess()) {
                        echo '<p class="error">Erro ao processar arquivo ou Não Suportado!</p>';
                    } else {
                        echo '<p>Média: R$ ' . formatToBRL($invoicingProcess->average) . '</p>';
                        echo '<p>Faturamento Mínimo: R$ ' . formatToBRL($invoicingProcess->minInv) . '</p>';
                        echo '<p>Faturamento Máximo: R$ ' . formatToBRL($invoicingProcess->maxInv) . '</p>';
                        echo '<p>Dias acima da receita média: ' . $invoicingProcess->DAAverageRevenue . '</p>';
                    }
                }
            }   
        ?>
    </main>
</body>
</html>
