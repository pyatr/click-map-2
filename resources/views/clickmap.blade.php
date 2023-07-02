<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

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
<script src="https://unpkg.com/chart.js@2.7.1/dist/Chart.js"></script>
<script>
    axios.get("http://" + window.location.host + "/get-clicks-for-domain").then((clicks) => {
        let points = [];

        clicks.data.forEach((click) => {
            points.push({
                x: click.x,
                y: click.y
            });
        });

        const data = {
            datasets: [{
                label: window.location.hostname,
                data: points,
                backgroundColor: 'rgb(255, 99, 132)'
            }],
        };

        const ctx = document.getElementById('clickMap').getContext('2d');

        let scatterChart = new Chart(ctx, {
            type: 'scatter',
            data: data,
            options: {
                scales: {
                    x: {
                        type: 'linear',
                        position: 'left'
                    },
                    y: {
                        type: 'linear',
                        position: 'top'
                    },
                    xAxes: [{
                        ticks: {
                            max: Math.max(
                                document.body.scrollWidth,
                                document.documentElement.scrollWidth,
                                document.body.offsetWidth,
                                document.documentElement.offsetWidth,
                                document.documentElement.clientWidth)
                        },
                        scaleLabel: {
                            display: true,
                            labelString: 'X'
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            reverse: true,
                            max: Math.max(
                                document.body.scrollHeight,
                                document.documentElement.scrollHeight,
                                document.body.offsetHeight,
                                document.documentElement.offsetHeight,
                                document.documentElement.clientHeight)
                        },
                        scaleLabel: {
                            display: true,
                            labelString: 'Y'
                        }
                    }]
                },
                responsive: true
            }
        });
    });
</script>
<div class="chart-wrapper">
    <canvas id="clickMap"></canvas>
</div>
</body>
</html>
