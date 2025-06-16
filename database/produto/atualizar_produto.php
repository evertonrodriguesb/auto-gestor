<?php
require_once '../../database/conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $modelo = $_POST['modelo'];
    $numero_serie = $_POST['numero_serie'];
    $cnpj = $_POST['cnpj'];
    $nome_empresa = $_POST['nome_empresa'];
    $status = $_POST['status'];

    $verificaSql = "SELECT id FROM produtos WHERE numero_serie = ? AND id != ?";
    $verificaStmt = $conn->prepare($verificaSql);
    if ($verificaStmt) {
        $verificaStmt->bind_param("si", $numero_serie, $id);
        $verificaStmt->execute();
        $verificaStmt->store_result();

        if ($verificaStmt->num_rows > 0) {
                echo "<script>
                        alert('Produto com este número de série já está cadastrado!');
                        window.location.href = '../../interface/produto/produtos.php';
                    </script>";
            $verificaStmt->close();
            $conn->close();
            exit;
        }
        $verificaStmt->close();
    } else {
        echo "Erro ao preparar verificação: " . $conn->error;
        $conn->close();
        exit;
    }

    $sql = "UPDATE produtos 
            SET nome = ?, modelo = ?, numero_serie = ?, cnpj = ?, nome_empresa = ?, status = ?
            WHERE id = ?";

    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("ssssssi", $nome, $modelo, $numero_serie, $cnpj, $nome_empresa, $status, $id);
        if ($stmt->execute()) {
                echo "<script>
                        alert('Produto atualizado com sucesso!');
                        window.location.href = '../../interface/produto/produtos.php';
                    </script>";
            exit;
        } else {
            echo "Erro ao atualizar o produto: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Erro na preparação da query: " . $conn->error;
    }
} else {
    echo "Requisição inválida.";
}

$conn->close();
?>
