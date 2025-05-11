<?php
$mysqli = new mysqli('localhost', 'DB_GEBRUIKER', 'DB_WACHTWOORD', 'DB_NAAM');
if ($mysqli->connect_errno) {
    die("Connectie mislukt: " . $mysqli->connect_error);
}

$email = 'admin@invoicedesk.online';
$wachtwoord = 'Welkom123!';
$hash = password_hash($wachtwoord, PASSWORD_BCRYPT);

$stmt = $mysqli->prepare("INSERT INTO tblstaff (firstname, lastname, email, password, admin, active, datecreated) VALUES (?, ?, ?, ?, 1, 1, NOW())");
$firstname = 'Super';
$lastname = 'Admin';
$stmt->bind_param("ssss", $firstname, $lastname, $email, $hash);

if ($stmt->execute()) {
    echo "Nieuwe admin aangemaakt.";
} else {
    echo "Fout bij invoegen: " . $stmt->error;
}

$stmt->close();
$mysqli->close();
?>
