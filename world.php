<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

$country = $_GET['country'] ?? "";
$lookup  = $_GET['lookup'] ?? "";

$country = trim($country);
$country = filter_var($country, FILTER_SANITIZE_STRING);

if ($lookup === "cities" && $country !== "") {

    $stmt = $conn->prepare("
        SELECT cities.name AS city_name, cities.district, cities.population
        FROM cities
        JOIN countries ON cities.country_code = countries.code
        WHERE countries.name LIKE :country
    ");

    $stmt->execute(["country" => "%$country%"]);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<table border='1' cellpadding='5'>
            <thead>
                <tr>
                    <th>City</th>
                    <th>District</th>
                    <th>Population</th>
                </tr>
            </thead>
            <tbody>";

    foreach ($results as $row) {
        echo "<tr>
                <td>" . htmlspecialchars($row['city_name']) . "</td>
                <td>" . htmlspecialchars($row['district']) . "</td>
                <td>" . htmlspecialchars($row['population']) . "</td>
              </tr>";
    }

    echo "</tbody></table>";
    exit;
}


if ($country !== "") {
    $stmt = $conn->prepare("
        SELECT name, continent, independence_year, head_of_state 
        FROM countries 
        WHERE name LIKE :country
    ");
    $stmt->execute(['country' => "%$country%"]);
} else {
    $stmt = $conn->query("SELECT name, continent, independence_year, head_of_state FROM countries");
}

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "<table border='1' cellpadding='5'>
        <thead>
            <tr>
                <th>Name</th>
                <th>Continent</th>
                <th>Independence Year</th>
                <th>Head of State</th>
            </tr>
        </thead>
        <tbody>";

foreach ($results as $row) {
    echo "<tr>
            <td>" . htmlspecialchars($row['name']) . "</td>
            <td>" . htmlspecialchars($row['continent']) . "</td>
            <td>" . htmlspecialchars($row['independence_year']) . "</td>
            <td>" . htmlspecialchars($row['head_of_state']) . "</td>
          </tr>";
}

echo "</tbody></table>";
?>