<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Meter Data</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src=<?= esc(base_url('/scripts.js'))?> defer></script>
    <link rel="stylesheet" href="<?= esc(base_url('/normalize.css'))?>">
    <link rel="stylesheet" href="<?= esc(base_url('/style.css'))?>">
</head>
<body>
    <header>nPEE - Laboratório de nanorredes</header>
    <main>
        <div id="im_disp">
            <div id="im_W_disp">
                <span id="active-power">...</span> kW PF <span id="power-factor">...</span>
            </div>
            <div id="im_data_disp">
                <span id="voltage">...</span> V / <span id="current">...</span> A / <span id="frequency">...</span> Hz
            </div>
            <div id="status_message">
                <span id="status">...</span>
            </div>
        </div>
        <div id="usage_display">
            Total em consumo:
            <span id="total-consumption-active-power">...</span> kW PF <span id="total-consumption-power-factor">...</span>
            <span id="total-consumption-voltage">...</span> V / <span id="total-consumption-current">...</span> A
        </div>
        <div id="gen_display">
            Total em fornecimento:
            <span id="total-generation-active-power">...</span> kW PF <span id="total-generation-power-factor">...</span>
            <span id="total-generation-voltage">...</span> V / <span id="total-generation-current">...</span> A
        </div>
        <canvas id="combined-chart" width="800" height="800"></canvas>
    </main>
</body>
</html>
