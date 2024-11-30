<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>nPEE - Laboratório de nanorredes</title>

    <link rel="stylesheet" href="/normalize.css">
    <link rel="stylesheet" href="/style.css">
    <link rel="stylesheet" href="/gridstack/gridstack.min.css">
    <link rel="stylesheet" href="/gridstack/gridstack-extra.min.css"> <!-- Necessário para número de colunas diferente de 12 -->

    <link rel="manifest" href="/manifest.json">

    <script src="/chart.js"></script>
    <script src="/gridstack/gridstack-all.js"></script>
    <script src="/gridstack/scripts.js" defer></script>
</head>
<body>
    <header>
        <h1>nPEE - Laboratório de nanorredes</h1>
        <button id="setup">Configurar</button>
    </header>
    <main>
        <div id="setupContainer"><!-- Container para o formulário de configuração -->
            <button id="saveState">Salvar Estado</button>
            <button id="loadState">Carregar Estado</button>
            <button id="resetState">Redefinir Estado</button>
            <div id="chartSelectionContainer"></div>
        </div>
        <div id="detailedChartsContainer"></div>
    </main>
    <footer>
        <h1>nPEE - Laboratório de nanorredes</h1>
    </footer>
</body>
</html>