<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
        <!-- Conteúdo da tabela será atualizado dinamicamente -->
        <div id="tabela-solicitacoes">
            <!-- Tabela será carregada aqui -->
        </div>
    </main>

    <footer></footer>

    <!-- Script AJAX -->
    <script>
        function carregarSolicitacoes() {
            $.ajax({
                url: 'view/atualizar_solicitacoes.php', // Script PHP que retorna as solicitações
                method: 'GET',
                success: function(data) {
                    $('#tabela-solicitacoes').html(data); // Atualiza o conteúdo da tabela
                },
                error: function() {
                    console.error('Erro ao carregar as solicitações.');
                }
            });
        }

        // Atualizar tabela a cada 5 segundos
        setInterval(carregarSolicitacoes, 5000);
        carregarSolicitacoes(); // Carrega imediatamente ao abrir a página
    </script>
</body>
</html>
