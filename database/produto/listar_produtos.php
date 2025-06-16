<?php
require_once '../../database/conexao.php';

$busca = isset($_GET['busca_serie']) ? trim($_GET['busca_serie']) : '';

if ($busca !== '') {
    $sql = "SELECT * FROM produtos WHERE numero_serie LIKE ?";
    $stmt = $conn->prepare($sql);
    $like = '%' . $busca . '%';
    $stmt->bind_param("s", $like);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $sql = "SELECT * FROM produtos";
    $result = $conn->query($sql);
}

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
        echo "<td>" . htmlspecialchars($row['nome']) . "</td>";
        echo "<td>" . htmlspecialchars($row['modelo']) . "</td>";   
        echo "<td>" . htmlspecialchars($row['numero_serie']) . "</td>";
        echo "<td>" . htmlspecialchars($row['status']) . "</td>";
        echo "<td>" . htmlspecialchars($row['cnpj']) . "</td>";
        echo "<td>" . htmlspecialchars($row['nome_empresa']) . "</td>";
        echo "<td class='text-nowrap'>";
        echo "<a href='../../interface/produto/editar_produto.php?id=" . urlencode($row['id']) . "' class='btn bg-primary text-white btn-sm me-1'>Editar</a>";
        echo "<form method='POST' action='../../database/produto/excluir_produto.php' class='d-inline' onsubmit='return confirm(\"Confirma a exclusão do produto " . htmlspecialchars($row['nome']) . "?\");'>";
        echo "<input type='hidden' name='id' value='" . htmlspecialchars($row['id']) . "'>";
        echo "<button type='submit' class='btn btn-danger btn-sm'>Excluir</button>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='8' class='text-center'>Nenhum produto encontrado</td></tr>";
}

$conn->close();
?>
