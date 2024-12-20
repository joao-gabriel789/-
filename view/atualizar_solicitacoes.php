<?php
require '../database/db.php'; // Arquivo de conexão com o banco de dados

try {
    $sql = "SELECT * FROM cadastro_solicitacoes WHERE status_solicitacao = TRUE ORDER BY id DESC"; // Ordena pelo ID mais recente
    $stmt = $pdo->query($sql);
    $solicitacoes = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($solicitacoes) > 0) {
        echo '<table>';
        echo '<thead>
                <tr>
                    <th>Número da Solicitação</th>
                    <th>Descrição</th>
                    <th>Data de Criação</th>
                    <th>Data de Previsão</th>
                    <th>Ações</th>
                </tr>
              </thead>
              <tbody>';

        foreach ($solicitacoes as $solicitacao) {
            $numero_solicitacao = htmlspecialchars($solicitacao['numero_solicitacao'], ENT_QUOTES, 'UTF-8');
            $descricao = nl2br(htmlspecialchars($solicitacao['descricao'], ENT_QUOTES, 'UTF-8'));
            $data_criacao = $solicitacao['data_criacao'];
            $data_previsao = $solicitacao['data_previsao'];
            $id = $solicitacao['id'];

            echo "<tr>
                    <td>$numero_solicitacao</td>
                    <td class='descricao'>$descricao</td>
                    <td>$data_criacao</td>
                    <td>$data_previsao</td>
                    <td>
                        <a href='../sistema_solicitacao/funcionalidades/update.php?id=$id' class='btn-action'>Editar</a>
                        <a href='../sistema_solicitacao/funcionalidades/finalizacao.php?id=$id&numero_solicitacao=$numero_solicitacao' 
                           class='btn-action' 
                           onclick=\"return confirm('Tem certeza que deseja finalizar a solicitação $numero_solicitacao?')\">Finalizar</a>
                    </td>
                </tr>";
        }

        echo '</tbody></table>';
    } else {
        echo '<p>Nenhuma solicitação encontrada.</p>';
    }
} catch (PDOException $e) {
    echo "Erro ao buscar solicitações: " . $e->getMessage();
}
?>
