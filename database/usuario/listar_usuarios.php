<?php
require_once '../../database/conexao.php';

$sql = "SELECT * FROM usuarios";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
        echo "<td>" . htmlspecialchars($row['usuario']) . "</td>";
        echo "<td>";
        echo "<form method='POST' action='../../database/usuario/excluir_usuario.php' onsubmit='return confirm(\"Confirma a exclusão do usuário " . htmlspecialchars($row['usuario']) . "?\");'>";
        echo "<input type='hidden' name='id' value='" . htmlspecialchars($row['id']) . "'>";
        echo "<button type='submit' class='btn btn-danger btn-sm'>Excluir</button>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='3'>Nenhum usuário encontrado</td></tr>";
}

$conn->close();
?>
