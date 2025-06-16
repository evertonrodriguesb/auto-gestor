<?php
require_once '../../database/conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = (int) $_POST['id'];

    $stmt = $conn->prepare("DELETE FROM usuarios WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header('Location: ../../interface/usuario/usuarios.php');
        exit;
    } else {
        echo "Erro ao excluir usuário.";
    }

    $stmt->close();
}

$conn->close();
?>
