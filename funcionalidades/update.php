<?php
require '../database/db.php';

$feedback = ''; // Variável para armazenar o feedback
$form_exibido = true; // Variável para controlar a exibição do formulário

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Busca a solicitação no banco de dados
    $sql = "SELECT * FROM cadastro_solicitacoes WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $solicitacao = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verifica se a solicitação foi encontrada
    if (!$solicitacao) {
        die("Solicitação não encontrada.");
    }

    // Lógica de atualização da data de previsão
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data_previsao = $_POST['data_previsao'];

        // Verifica se a data foi alterada
        if ($solicitacao['data_previsao'] != $data_previsao) {
            try {
                $sql = "UPDATE cadastro_solicitacoes SET data_previsao = :data_previsao WHERE id = :id";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':data_previsao', $data_previsao);
                $stmt->bindParam(':id', $id);
                $stmt->execute();

                // Feedback positivo e oculta o formulário
                $feedback = '<p class="success-message">Data de previsão atualizada com sucesso!</p>';
                $form_exibido = false;
            } catch (PDOException $e) {
                $feedback = '<p class="error-message">Erro ao atualizar solicitação: ' . $e->getMessage() . '</p>';
            }
        } else {
            // Se a data não foi alterada, redireciona
            header('Location: ../index.php');
            exit();
        }
    }
} else {
    die("ID inválido.");
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/functions.css">
    <title>Editar Solicitação</title>
    <link rel="icon" type="image/png" href="../img/favicon.png">
    <style>
        input[type="date"], input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }


    </style>
</head>
<body>
    <div class="container">
        <!-- Logo -->
        <div class="logo">
            <img src="../img/logoGrupo.png" alt="Logo Grupo Sengés">
        </div>

        <div class="form-container">
            <!-- Conteúdo -->
        <?php if ($form_exibido): ?>
            <!-- Formulário de edição -->
            <h1>Editar Solicitação</h1>
            <form method="POST">
                <div class="form-group">
                    <label for="data_previsao">Nova Data de Previsão:</label>
                    <input type="date" name="data_previsao" value="<?php echo htmlspecialchars($solicitacao['data_previsao'], ENT_QUOTES, 'UTF-8'); ?>" required>
                </div>

                <div class="form-buttons">
                    <input type="submit" value="Salvar" class="submit-button">
                </div>
            </form>            
        </div>
        <?php else: ?>
            <!-- Feedback e botão "Voltar" -->
            <div class="feedback">
                <?php echo $feedback; ?>
                <a href="../index.php"><button type="button" class="back-button">Voltar</button></a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>

