<?php
require '../database/db.php';
require '../view/criar_solicitacao.php';

function gerarNumeroSolicitacao($pdo, $prefixo = "SOL-", $tamanho = 7) {
    try {
        // Obter o último número gerado no formato completo
        $query = "SELECT MAX(numero_solicitacao) AS ultimo_numero FROM cadastro_solicitacoes";
        $stmt = $pdo->query($query);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        // Recupera o último número, removendo o prefixo, e incrementa
        $ultimoNumero = isset($resultado['ultimo_numero']) && $resultado['ultimo_numero'] 
                        ? intval(substr($resultado['ultimo_numero'], strlen($prefixo))) 
                        : 0;
        $novoNumero = $ultimoNumero + 1;

        // Formatar o número com o prefixo e o tamanho definido
        return $prefixo . str_pad($novoNumero, $tamanho, "0", STR_PAD_LEFT);
    } catch (PDOException $e) {
        die("Erro ao obter o último número de solicitação: " . $e->getMessage());
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $descricao = $_POST['descricao'];
    $data_previsao = $_POST['data_previsao'];
    $data_criacao = $_POST['data_criacao'];
    // $numero_solicitacao = 'SOL-' . time();
    $status_solicitacao = 1;

    try {
        // Gerar o número de solicitação
        $numero_solicitacao = gerarNumeroSolicitacao($pdo);

        $sql = "INSERT INTO cadastro_solicitacoes (numero_solicitacao, descricao, data_criacao, data_previsao, status_solicitacao) 
                VALUES (:numero_solicitacao, :descricao, :data_criacao, :data_previsao, :status_solicitacao)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':numero_solicitacao', $numero_solicitacao);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':data_criacao', $data_criacao);
        $stmt->bindParam(':data_previsao', $data_previsao);
        $stmt->bindParam(':status_solicitacao', $status_solicitacao);

        if ($stmt->execute()) {
            header('Location: ../view/confirmacao_solicitacao.php');
            exit();
        } else {
            echo "Erro ao registrar a solicitação.";

        }
    } catch (PDOException $e) {
        echo "Erro na conexão com o banco de dados: " . $e->getMessage();
    }
}
