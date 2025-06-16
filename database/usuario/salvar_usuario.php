<?php
require_once '../../database/conexao.php';

$usuario = $_POST['usuario'];
$senha = $_POST['senha'];

$stmt = $conn->prepare("SELECT id FROM usuarios WHERE usuario = ?");
$stmt->bind_param("s", $usuario);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    echo "<script>
        alert('Usuário já cadastrado!');
        window.location.href = '../../interface/usuario/usuarios.php';
    </script>";
    $stmt->close();
    $conn->close();
    exit;
}

$stmt->close();

$senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO usuarios (usuario, senha) VALUES (?, ?)");
$stmt->bind_param("ss", $usuario, $senhaCriptografada);

if ($stmt->execute()) {
    echo "<script>
        alert('Usuário cadastrado com sucesso!');
        window.location.href = '../../interface/usuario/usuarios.php';
    </script>";
} else {
    echo "<script>
        alert('Erro ao cadastrar: " . $stmt->error . "');
        window.location.href = '../../index.html';
    </script>";
}

$stmt->close();
$conn->close();
?>
