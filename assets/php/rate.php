<?php
// Povezava z bazo
$host = "localhost:3306";
$user = "root";
$password = "";
$database = "rateSt";

$conn = new mysqli($host, $user, $password, $database);

// Preveri povezavo
if ($conn->connect_error) {
    die("Povezava ni uspela: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ime = $_POST["ime"];
    $priimek = $_POST["priimek"];
    $palica = $_POST["palica"];
    $feeling = $_POST["feeling"];
    $durability = $_POST["durability"];
    $dni = $_POST["dni"];

    $stmt = $conn->prepare("INSERT INTO ocene (ime, priimek, palica, feeling, durability, dni) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssiii", $ime, $priimek, $palica, $feeling, $durability, $dni);
    $stmt->execute();
    $stmt->close();

    echo "<p>Podatki so bili uspešno vnešeni!</p></br>";
    // Izračun povprečij iz vseh podatkov v bazi
    $sql = "SELECT AVG(feeling) AS avg_feeling, AVG(durability) AS avg_durability, AVG(dni) AS avg_dni FROM ocene";
    $result = $conn->query($sql);

    if ($result && $row = $result->fetch_assoc()) {
        echo "<div style='border:1px solid #ccc; padding:10px; margin-top:15px; width:350px; font-family:sans-serif; background-color:#eef;'>";
        echo "<h3>Averages of stick </h3>" . $palica . ":";
        echo "<p><strong>Povprečen feeling:</strong> " . number_format($row["avg_feeling"], 2) . "</p>";
        echo "<p><strong>Povprečen durability:</strong> " . number_format($row["avg_durability"], 2) . "</p>";
        echo "<p><strong>Povprečno število dni:</strong> " . number_format($row["avg_dni"], 2) . "</p>";
        echo "</div>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Rate Your Stick</title>
</head>

<body>
    <h1>Rate Your Stick</h1>
    <form method="post">
        Name: <input type="text" name="ime" required><br><br>
        Lastname: <input type="text" name="priimek" required><br><br>

        Choose your stick:
        <select name="palica">
            <option value="palica1">CCM JetSpeed FT7 Pro</option>
            <option value="palica2">Bauer Vapor HyperLite 2</option>
            <option value="palica3">Bauer Nexus Tracer </option>
            <option value="palica4">Warrior Covert QR6 Pro</option>
            <option value="palica5">CCM Ribcor Trigger 9 Pro</option>
            <option value="palica6">Bauer Proto R</option>
            <option value="palica7">Warrior Alpha LX2 Pro</option>
            <option value="palica8">Bauer Twitch</option>
            <option value="palica9">CCM Tacks XF Pro</option>
            <option value="palica10">CCM JetSpeed FT6 Pro</option>
        </select><br><br>

        Feeling of the stick (1-10):
        <input type="number" name="feeling" min="1" max="10" required><br><br>

        Durability (1-10):
        <input type="number" name="durability" min="1" max="10" required><br><br>

        How many days did it last:
        <input type="number" name="dni" min="1" required><br><br>

        <input type="submit" value="Submit">
    </form>
</body>

</html>