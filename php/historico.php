<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Historico de reservas</title>
    <link rel="stylesheet" href="../css/style_historico.css">
</head>

<body>
    <div class="statistics-container">
        <div class="responsive-flex">
            <button class="return-button" onclick="window.location = './home.php'">
                <img src="../images/LOGOUT.PNG" width='27px'>
            </button>
            <img id="logo" src="../images/logo.png" alt="">
        </div>
        <div class="statistics-list-container">
            <div id="statisticsBodyContainer"></div>
        </div>

        <script>
            var statistics = new EventSource('../php/historicoU.php');
            statistics.onmessage = function (event) {
                var data = JSON.parse(event.data);
                document.getElementById('statisticsBodyContainer').innerHTML = data.table;
            };
            statistics.onerror = function (event) {
                console.error('Error en la conexión SSE para estadísticas:', event);
            };
        </script>

    </div>
</body>
</html>
