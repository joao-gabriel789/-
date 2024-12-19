<?php
require 'database/db.php'; // Arquivo de conexão com o banco de dados

// Busca todas as solicitações no banco de dados
try {
    $sql = "SELECT * FROM cadastro_solicitacoes WHERE status_solicitacao = TRUE ORDER BY id DESC"; // Ordena pelo ID mais recente
    $stmt = $pdo->query($sql);
    $solicitacoes = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erro ao buscar solicitações: " . $e->getMessage());
}
?>

<!DOCTYPE html>
    <html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/style.css">
        <title>Sistema de Solicitações</title>
        <link rel="icon" type="image/png" href="img/favicon.png">
    </head>


    <body class="dark-theme">
        <header>
            <img src="img/logoGrupo.png" alt="Logo do Grupo" class="logoGrupo">
            <h1>Sistema de Solicitações</h1>

            <p>TI - Grupo Sengés - versão 1.0 © 2024.</p>   
            
        </header>
        
        <main>
            <div class="conteiner-lista">
                <h2>Lista de Solicitações</h2>
            </div>
            <a href="../sistema_solicitacao/funcionalidades/create.php" class="btn">Nova Solicitação</a>
            <table>
                <thead>
                    <tr>
                        <!-- <th>ID</th> -->
                        <th>Número da Solicitação</th>
                        <th>Descrição</th>
                        <th>Data de Criação</th>
                        <th>Data de Previsão</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($solicitacoes) > 0): ?>
                        <?php foreach ($solicitacoes as $solicitacao): 
                            $status_solicitacao = $solicitacao['status_solicitacao'];
                            if($status_solicitacao == 1) {
                                $status_solicitacao = "Ativo";
                            }else {
                                echo "Solicitação não está ativa.";
                            }
                            ?>
                            <tr>
                                <!-- <td><?php echo $solicitacao['id']; ?></td> -->
                                <td><?php echo $solicitacao['numero_solicitacao']; ?></td>
                                <td class="descricao"><?php echo nl2br(htmlspecialchars($solicitacao['descricao'], ENT_QUOTES, 'UTF-8')); ?></td>
                                <td><?php echo $solicitacao['data_criacao']; ?></td>
                                <td><?php echo $solicitacao['data_previsao']; ?></td>
                                <td>
                                    <a href="../sistema_solicitacao/funcionalidades/update.php?id=<?php echo $solicitacao['id']; ?>" class="btn-action">Editar</a>
                                    <!-- <a href="../sistema_solicitacao/funcionalidades/delete.php?id=" class="btn" onclick="return confirm('Tem certeza que deseja excluir esta solicitação?')">Excluir</a> -->
                                    <a href="../sistema_solicitacao/funcionalidades/finalizacao.php?id=<?php echo $solicitacao['id'];?>&numero_solicitacao=<?php echo $solicitacao['numero_solicitacao']; ?>" class="btn-action" onclick="return confirm('Tem certeza que deseja finalizar a solicitação <?php echo $solicitacao['numero_solicitacao']?>?')">Finalizar</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6">Nenhuma solicitação encontrada.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </main>

        <footer>

        </footer>
    </body>
</html>
