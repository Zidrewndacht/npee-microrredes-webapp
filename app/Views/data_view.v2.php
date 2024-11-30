<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>nPEE - Laboratório de nanorredes</title>

    <link rel="stylesheet" href="/normalize.css">
    <link rel="stylesheet" href="/style.css">
    <link rel="stylesheet" href="/gridstack.min.css">

    <script src="/chart.js"></script>
    <script src="/gridstack-all.js"></script>
    <script src="/scripts.js" defer></script>
</head>
<body>
    <header>
        <h1>nPEE - Laboratório de nanorredes</h1>
    </header>
    <main>  <!-- This will be changed to use Gridstack instead: -->
        <section id="chartSelection">
            <!-- Checkboxes for chart selection dynamically added here -->
        </section>
        <section>
            <label for="dataPoints">Número de pontos de dados:</label>
            <input type="number" id="dataPoints" value="10" min="1">
            <button id="fetchData">Buscar Dados</button>
        </section>
        <section id="detailedChartsContainer">
            <!-- Detailed charts dynamically added here -->
        </section>
    </main>
</body>
</html>