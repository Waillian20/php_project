<?php
include 'dbconnect.php';

// Get data from your sales table
$stmt = $pdo->query("SELECT month, amount FROM sales");

$labels = [];
$data = [];

while ($row = $stmt->fetch()) {
    $labels[] = $row['month'];
    $data[] = $row['amount'];
}

// Convert to JS format
$js_labels = json_encode($labels);
$js_data = json_encode($data);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Sales Chart</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
  <h2>Monthly Sales Chart</h2>
  <canvas id="myChart" width="600" height="400"></canvas>

  <script>
    const labels = <?php echo $js_labels; ?>;
    const data = <?php echo $js_data; ?>;
  </script>

  <script src="map.js"></script>
</body>
</html>
