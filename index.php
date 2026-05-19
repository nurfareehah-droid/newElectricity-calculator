<?php

function calculatePower($voltage, $current)
{
    return ($voltage * $current) / 1000;
}

  function calculateEnergy($powerKW, $hour)
{
    return $powerKW * $hour;
}

function calculateTotal($energy, $rateRM)
{
    return $energy * $rateRM;
}

function calculateDaily($powerKW)
{
    return $powerKW * 24;
}

$powerKW = 0;
$rateRM = 0;

if(isset($_POST['calculate']))
{
    $voltage = $_POST['voltage'];
    $current = $_POST['current'];
    $rate = $_POST['rate'];

    $powerKW = calculatePower($voltage, $current);

    $rateRM = $rate / 100;
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Electricity Calculator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
    <div class="container mt-5">

    <h1 class ="mb-4">Electricity Calculator</h1>

    <form method="post">
        <label>Voltage (V):</label><br>
        <input type="number" step="0.01" name="voltage" required><br><br>

        <label>Current (A):</label><br>
        <input type="number" step="0.01" name="current" required><br><br>

        <label>Current Rate (sen/kWh):</label><br>
        <input type="number" step="0.01" name="rate" required><br><br>

        <button type="submit" name="calculate">Calculate</button>
    </form>

    <?php
    if(isset($_POST['calculate']))
{
    echo "<h3>POWER : " . round($powerKW,5) . " kW</h3>";
    echo "<h3>RATE : RM " . round($rateRM,3) . "</h3>";
}
?>

<?php
if(isset($_POST['calculate']))
{
    echo "<table border='1' cellpadding='8'>";

    echo "<tr>
            <th>#</th>
            <th>Hour</th>
            <th>Energy (kWh)</th>
            <th>Total (RM)</th>
          </tr>";

  

for($hour = 1; $hour <= 24; $hour++)
{
    $energy = calculateEnergy($powerKW,$hour);

    $total = calculateTotal($energy,$rateRM);

    echo "<tr>";
    echo "<td>$hour</td>";
    echo "<td>$hour</td>";
    echo "<td>" . round($energy,5) . "</td>";
    echo "<td>" . round($total,2) . "</td>";
    echo "</tr>";
}
    echo "</table>";
    $dailyEnergy = calculateDaily($powerKW);
    $dailyTotal = calculateTotal($dailyEnergy, $rateRM);

    echo "<h3>Daily Summary</h3>";
    echo "<p>Total Daily Energy : " . round($dailyEnergy,5) . " kWh</p>";
    echo "<p>Total Daily Charge : RM " . round($dailyTotal,2) . "</p>";
}
?>
    </div>
</body>
</html>