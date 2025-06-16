<?php
require_once '../../database/conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = (int) $_POST['id'];

    $stmt = $conn->prepare("DELETE FROM produtos WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header('Location: ../../interface/produto/produtos.php');
        exit;
    } else {
        echo "Erro ao excluir produto.";
    }

    $stmt->close();
}

$conn->close();
?>
