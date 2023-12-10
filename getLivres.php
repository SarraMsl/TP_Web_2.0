<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "db_aj";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Échec de la connexion: " . $conn->connect_error);
}

if (isset($_GET['id_auteur'])) {
    $idAuteur = $_GET['id_auteur'];
    $query = "SELECT * FROM livre WHERE id_auteur = $idAuteur";
    $result = $conn->query($query);

    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    // Convert the data to XML
    $xml = new SimpleXMLElement('<livres></livres>');
    foreach ($data as $row) {
        $livre = $xml->addChild('livre');
        foreach ($row as $key => $value) {
            $livre->addChild($key, $value);
        }
    }

    // Send XML header
    header('Content-Type: application/xml');

    // Output the XML
    echo $xml->asXML();
}

$conn->close();
?>
