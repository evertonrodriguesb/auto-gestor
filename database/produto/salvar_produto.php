<?php
require_once '../../database/conexao.php';

$nome = $_POST['nome'];
$modelo = $_POST['modelo'];
$numero_serie = $_POST['numero_serie'];
$status = $_POST['status'];
$cnpj = $_POST['cnpj'];
$nome_empresa = $_POST['nome_empresa'];

$stmt = $conn->prepare("SELECT id FROM produtos WHERE numero_serie = ?");
$stmt->bind_param("s", $numero_serie);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    echo "<script>
        alert('Produto com este número de série já está cadastrado!');
        window.location.href = '../../interface/produto/produtos.php';
    </script>";
    $stmt->close();
    $conn->close();
    exit;
}

$stmt->close();

$stmt = $conn->prepare("INSERT INTO produtos (nome, modelo, numero_serie, cnpj, nome_empresa, status) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $nome, $modelo, $numero_serie, $cnpj, $nome_empresa, $status);

if ($stmt->execute()) {
    echo "<script>
        alert('Produto cadastrado com sucesso!');
        window.location.href = '../../interface/produto/produtos.php';
    </script>";
} else {
    echo "<script>
        alert('Erro ao cadastrar produto: " . $stmt->error . "');
        window.location.href = '../../interface/produto/produtos.php';
    </script>";
}

$stmt->close();
$conn->close();
?>
