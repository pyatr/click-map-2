<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Clicks by hours</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">

    <style>
        html, body {
            width: 100%;
            height: 100%;
            margin: 0;
        }

        body {
            display: grid;
            justify-content: center;
            align-content: center;
        }

        .chart-wrapper {
            display: inline-block;
            position: relative;
            width: 40rem;
        }
    </style>
</head>
<body>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://unpkg.com/chart.js@2.7.1/dist/Chart.bundle.js"></script>
<script>
    axios.get("http://" + window.location.host + "/get-clicks-for-domain").then((clicks) => {
        let clicksByTime = [];
        let hourLabels = [];

        for (let i = 0; i < 24; i++) {
            clicksByTime[i] = 0;
            hourLabels[i] = i + ":00";
        }

        clicks.data.forEach((click) => {
            let newDate = new Date(Date.parse(click.date));
            let hours = newDate.getHours();
            clicksByTime[hours]++;
        });
        const ctx = document.getElementById('clickMap').getContext('2d');

        new Chart(ctx, {
            type: 'line',
            data:  {
                labels: hourLabels,
                datasets: [{
                    label: 'Clicks by hours',
                    data: clicksByTime,
                    fill: true,
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1
                }]
            }
        });
    });
</script>
<div class="chart-wrapper">
    <canvas id="clickMap"></canvas>
</div>
</body>
</html>
