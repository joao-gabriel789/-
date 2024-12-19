<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Solicitação</title>
    <link rel="stylesheet" href="../css/functions.css"> <!-- Link para o CSS -->
    <link rel="icon" type="image/png" href="../img/favicon.png">
</head>
<body>
    <div class="container">
        <!-- Logo -->
        <div class="logo">
            <img src="../img/logoGrupo.png" alt="Logo Grupo Sengés">
        </div>

        <!-- Formulário -->
        <div class="form-container">
            <h1>Registrar Solicitação</h1>
            <form action="../funcionalidades/create.php" method="POST">
                <div class="form-group">
                    <label for="data-criacao">Data Criação:</label>
                    <input type="date" id="data_criacao" name="data_criacao" required>
                </div>
                <div class="form-group">
                    <label for="data-previsao">Data de Previsão:</label>
                    <input type="date" id="data_previsao" name="data_previsao" required>
                </div>
                <div class="form-group">
                    <label for="descricao">Descrição:</label>
                    <textarea id="descricao" name="descricao" rows="5" cols="50" required></textarea>
                </div>
                <!-- Botões -->
                <div class="form-buttons">
                    <button type="submit">Salvar</button>
                    <button type="button" onclick="window.history.back()">Voltar</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
