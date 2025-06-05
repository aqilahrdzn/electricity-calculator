<!DOCTYPE html>
<html>
<head>
    <title>Electricity Calculator</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="text-center mb-4">Electricity Consumption Calculator</h2>
    <div class="card p-4">
        <form method="post">
            <div class="form-group">
                <label for="voltage">Voltage (V):</label>
                <input type="number" step="0.01" class="form-control" name="voltage" required>
            </div>
            <div class="form-group">
                <label for="current">Current (A):</label>
                <input type="number" step="0.01" class="form-control" name="current" required>
            </div>
            <div class="form-group">
                <label for="hours">Hours:</label>
                <input type="number" step="0.01" class="form-control" name="hours" required>
            </div>
            <div class="form-group">
                <label for="rate">Current Rate (in cents):</label>
                <input type="number" step="0.01" class="form-control" name="rate" required>
            </div>
            <button type="submit" class="btn btn-primary">Calculate</button>
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            function calculateElectricity($voltage, $current, $hours, $rate) {
                $powerWh = $voltage * $current; // in Wh
                $energyKWh = ($powerWh * $hours) / 1000; // in kWh
                $totalCharge = $energyKWh * ($rate / 100); // rate in cents

                return [
                    'powerWh' => $powerWh,
                    'energyKWh' => $energyKWh,
                    'totalCharge' => $totalCharge
                ];
            }

            $voltage = (float)$_POST['voltage'];
            $current = (float)$_POST['current'];
            $hours = (float)$_POST['hours'];
            $rate = (float)$_POST['rate'];

            $result = calculateElectricity($voltage, $current, $hours, $rate);
            ?>

            <hr>
            <h4>Results:</h4>
            <ul>
                <li><strong>Power:</strong> <?= number_format($result['powerWh'], 2) ?> Wh</li>
                <li><strong>Energy:</strong> <?= number_format($result['energyKWh'], 4) ?> kWh</li>
                <li><strong>Total Charge:</strong> $<?= number_format($result['totalCharge'], 2) ?></li>
            </ul>

            <?php
        }
        ?>
    </div>
</div>
</body>
</html>
