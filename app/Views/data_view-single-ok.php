<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>nPEE - Laboratório de nanorredes</title>
    <link rel="stylesheet" href="/normalize.css">
    <link rel="stylesheet" href="/style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="/scripts.js" defer></script>
</head>
<body>
    <header>
        <h1>nPEE - Laboratório de nanorredes</h1>
    </header>
    <main>
        <section>
            <label for="collections">Selecione a coleção:</label>
            <select id="collections">
                <option value="">Selecione...</option>
            </select>
            <label for="dataPoints">Número de pontos de dados:</label>
            <input type="number" id="dataPoints" value="10" min="1">
            <button id="fetchData">Buscar Dados</button>
        </section>
        <section id="chartContainer">
            <canvas id="dataChart"></canvas>
        </section>
        <section id="detailedChartsContainer">
            <!-- Detailed charts will be added here -->
        </section>
    </main>
</body>
</html>