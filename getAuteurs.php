<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "db_aj";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Échec de la connexion: " . $conn->connect_error);
}

$query = "SELECT * FROM auteur";
$result = $conn->query($query);

$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

// Convert the data to XML
$xml = new SimpleXMLElement('<auteurs></auteurs>');
foreach ($data as $row) {
    $auteur = $xml->addChild('auteur');
    foreach ($row as $key => $value) {
        $auteur->addChild($key, $value);
    }
}

// Send XML header
header('Content-Type: application/xml');

// Output the XML
echo $xml->asXML();

$conn->close();
?>
