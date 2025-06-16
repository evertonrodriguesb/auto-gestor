<?php
session_start();
require_once '../../database/conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE usuario = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        if (password_verify($senha, $row['senha'])) {
            $_SESSION['usuario'] = $usuario;

            echo "<script>
                window.location.href = '../../interface/produto/produtos.php';
            </script>";
        } else {
            echo "<script>
                alert('Senha incorreta!');
                window.location.href = '../../index.html';
            </script>";
        }
    } else {
        echo "<script>
            alert('Usuário não encontrado!');
            window.location.href = '../../index.html';
        </script>";
    }

    $stmt->close();
    $conn->close();
}
?>
