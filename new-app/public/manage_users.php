<?php

// Informations de connexion à la base de données
$host = '127.0.0.1';
$dbname = 'accont';
$username = 'root';
$password = '';

header('Content-Type: application/json');
include 'db.php'; // Incluez votre connexion à la base de données

$action = $_GET['action'] ?? '';

switch ($action) {
    case 'add':
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $sql = "INSERT INTO users (name, email, phone, password) VALUES ('$name', '$email', '$phone', '$password')";
        if (mysqli_query($conn, $sql)) {
            echo json_encode(['message' => 'Utilisateur ajouté avec succès']);
        } else {
            echo json_encode(['message' => 'Erreur lors de l\'ajout de l\'utilisateur']);
        }
        break;

    case 'update':
        $id = $_GET['id'];
        $name = $_php;
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_BCRYPT) : null;

        $sql = "UPDATE users SET name='$name', phone='$phone'". ($password ? ", password='$password'" : "") . " WHERE id='$id'";
        if (mysqli_query($conn, $sql)) {
            echo json_encode(['message' => 'Utilisateur modifié avec succès']);
        } else {
            echo json_encode(['message' => 'Erreur lors de la modification de l\'utilisateur']);
        }
        break;

    case 'delete':
        $id = $_GET['id'];
        $sql = "DELETE FROM users WHERE id='$id'";
        if (mysqli_query($conn, $sql)) {
            echo json_encode(['message' => 'Utilisateur supprimé avec succès']);
        } else {
            echo json_encode(['message' => 'Erreur lors de la suppression de l\'utilisateur']);
        }
        break;

    case 'list':
        $result = mysqli_query($conn, "SELECT id, name, email FROM users");
        $users = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $users[] = $row;
        }
        echo json_encode($users);
        break;

    default:
        echo json_encode(['message' => 'Action non reconnue']);
        break;
}

mysqli_close($conn);
?>
