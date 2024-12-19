<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/functions.css">
    <title>Confirmação de Finalização</title>
    <link rel="icon" type="image/png" href="../img/favicon.png">
</head>
<body>
    <main>
        <?php
            require '../database/db.php';

            if (isset($_GET['id'], $_GET['numero_solicitacao'])) {
                $id = $_GET['id'];
                $numero_solicitacao = $_GET['numero_solicitacao'];
                $status_solicitacao = 0;

                    try {
                        $sql = "UPDATE cadastro_solicitacoes SET status_solicitacao = :status_solicitacao WHERE id = :id";
                        $stmt = $pdo->prepare($sql);
                        $stmt->bindParam(':status_solicitacao', $status_solicitacao);
                        $stmt->bindParam(':id', $id);
                        $stmt->execute();

                        echo "<p class=pfinalizacao>Solicitação Finalizada com sucesso: <strong>$numero_solicitacao</strong></p>";
                        echo '<br><a href="../index.php"><button>Voltar</button></a>';
                    } catch (PDOException $e) {
                        echo "Erro ao finalizar solicitação: " . $e->getMessage();
                    }

                $sql = "SELECT * FROM cadastro_solicitacoes WHERE id = :id";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                $solicitacao = $stmt->fetch(PDO::FETCH_ASSOC);
            }
        
        ?>
    </main>
</body>
</html>