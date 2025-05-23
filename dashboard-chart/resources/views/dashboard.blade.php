<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Chart</title>
    <script src="{{ asset('js/chart.min.js') }}"></script>
</head>

<body>
    <h2>User Registrations Per Month</h2>
    <canvas id="usersChart" width="600" height="250"></canvas>
    <script>
        const ctx = document.getElementById('usersChart').getContext('2d');
	const gradient = ctx.createLinearGradient(0, 0, 0, 400);
   	gradient.addColorStop(0, '#5B247A');
	gradient.addColorStop(0.3, '#5B247A');  
    	gradient.addColorStop(1, '#1BCEDF');

        const chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode(array_map(fn($m) => date("F", mktime(0, 0, 0, $m, 10)), array_keys($usersPerMonth->toArray()))) !!},
                datasets: [{
                    label: 'Users',
                    data: {{ json_encode(array_values($usersPerMonth->toArray())) }},
                    backgroundColor: gradient,
                    borderColor: '#3A0CA3',
                    borderWidth: 1,
		    borderRadius: 5,
                }]
            },
            options: {
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    </script>
</body>

</html>