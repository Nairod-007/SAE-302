<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "utilisateurs_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

// Récupérer les données du formulaire
$username = $_POST['username'];
$mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_BCRYPT);
$admin = isset($_POST['admin']) ? 1 : 0;
$write = isset($_POST['write']) ? 1 : 0;

// Préparer et exécuter la requête SQL
$sql = "INSERT INTO utilisateurs (username, mot_de_passe, admin, write) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssii", $username, $mot_de_passe, $admin, $write);

if ($stmt->execute()) {
    echo "Utilisateur créé avec succès !";
} else {
    echo "Erreur : " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
