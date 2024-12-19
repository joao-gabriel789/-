<?php
require 'db.php';

try {
    $sql = "SELECT * FROM cadastro_solicitacoes";
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
    <title>Lista de Solicitações</title>
</head>
<body>
    <h1>Solicitações</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Descrição</th>
                <th>Data de Criação</th>
                <th>Data de Previsão</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($solicitacoes as $solicitacao): ?>
                <tr>
                    <td><?php echo $solicitacao['id']; ?></td>
                    <td><?php echo $solicitacao['descricao']; ?></td>
                    <td><?php echo $solicitacao['data_criacao']; ?></td>
                    <td><?php echo $solicitacao['data_previsao']; ?></td>
                    <td>
                        <a href="update.php?id=<?php echo $solicitacao['id']; ?>">Editar</a>
                        <a href="delete.php?id=<?php echo $solicitacao['id']; ?>">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
