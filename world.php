<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$country = $_GET['country'] ?? '';
$lookup = $_GET['lookup'] ?? '';

if ($lookup === 'cities'){
  $sql = 'SELECT c.name, c.district, c.population
          FROM cities c JOIN countries cs ON c.country_code = cs.code
          WHERE cs.name LIKE :country';
  $headers = ['Name', 'District', 'Population'];
}else {
    $sql = "SELECT name, continent, independence_year, head_of_state
            FROM countries WHERE name LIKE :country";
    $headers = ['Name', 'Continent', 'Independence', 'Head of State'];
}
$stmt = $conn->prepare($sql);
$stmt->execute([':country' => "%$country%"]);
$rows = $stmt->fetchAll(PDO::FETCH_NUM);
?>
<table>
  <thead><tr>
    <?php foreach ($headers as $h): ?><th><?= $h ?></th><?php endforeach; ?>
  </tr></thead>
  <tbody>
    <?php foreach ($rows as $row): ?>
      <tr><?php foreach ($row as $cell): ?><td><?= htmlspecialchars((string)$cell) ?></td><?php endforeach; ?></tr>
    <?php endforeach; ?>
  </tbody>
</table>
