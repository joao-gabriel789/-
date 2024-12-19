<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/functions.css">
        <title>Confirmação de Solicitação</title>
        <link rel="icon" type="image/png" href="../img/favicon.png">
    </head>
    <body>
        <main>
            <?php
                require '../database/db.php';

                try {   
                    // Obter o último número gerado no formato completo
                    $query = "SELECT MAX(numero_solicitacao) AS ultimo_numero FROM cadastro_solicitacoes";
                    $stmt = $pdo->query($query);
                    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

                    // Recupera o último número, removendo o prefixo, e incrementa
                    $numero_solicitacao = $resultado['ultimo_numero'];

                } catch (PDOException $e) {
                    die("Erro ao obter o último número de solicitação: " . $e->getMessage());
                }

                
                echo "<br>Solicitação registrada com sucesso! Número da solicitação: " . $numero_solicitacao . "<br>";
                echo '<br><a href="../index.php"><button>Ver Lista de Solicitações</button></a>';
            
            ?>
        </main>
    </body>
</html>
