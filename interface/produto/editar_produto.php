<?php
require_once '../../database/conexao.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    echo "ID inválido!";
    exit;
}

$stmt = $conn->prepare("SELECT * FROM produtos WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Produto não encontrado!";
    exit;
}

$produto = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <title>Auto Gestor 1.0</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background-color: #f8f9fa;
    }
    .form-container {
      max-width: 100%;
      margin: auto;
      margin-top: 10vh;
      padding: 30px;
      background-color: white;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
  </style>
</head>
<body>

<nav class="navbar navbar-dark bg-primary">
  <div class="container-fluid">
    <span class="navbar-brand mb-0 h1">Editar Produto</span>
  </div>
</nav>

<div class="container">
  <div class="form-container mt-5">
    <form action="../../database/produto/atualizar_produto.php" method="POST">
      <input type="hidden" name="id" value="<?= $produto['id'] ?>">
      
      <div class="mb-3">
        <label for="nome" class="form-label">Nome do Produto</label>
        <input type="text" class="form-control" id="nome" name="nome" value="<?= $produto['nome'] ?>" required />
      </div>
      <div class="mb-3">
        <label for="modelo" class="form-label">Modelo</label>
        <input type="text" class="form-control" id="modelo" name="modelo" value="<?= $produto['modelo'] ?>" required />
      </div>
      <div class="mb-3">
        <label for="numero_serie" class="form-label">Número de Série</label>
        <input type="text" class="form-control" id="numero_serie" name="numero_serie" value="<?= $produto['numero_serie'] ?>" required />
      </div>
      <div class="mb-3">
        <label for="cnpj" class="form-label">CNPJ</label>
            <input type="text"
                class="form-control"
                id="cnpj"
                name="cnpj"
                value="<?= $produto['cnpj'] ?>"
                required
                pattern="\d{2}\.\d{3}\.\d{3}/\d{4}-\d{2}"
                title="Digite um CNPJ no formato 00.000.000/0000-00" />
      </div>
      <div class="mb-3">
        <label for="nome_empresa" class="form-label">Nome da empresa</label>
        <input type="text" class="form-control" id="nome_empresa" name="nome_empresa" value="<?= $produto['nome_empresa'] ?>" required />
      </div>
      <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <select class="form-select" id="status" name="status" required>
          <option value="ativo" <?= $produto['status'] == 'ativo' ? 'selected' : '' ?>>Ativo</option>
          <option value="manutencao" <?= $produto['status'] == 'manutencao' ? 'selected' : '' ?>>Manutenção</option>
        </select>
      </div>
      <div class="d-grid">
        <button type="submit" class="btn bg-primary text-white">Salvar Alterações</button>
      </div>
    </form>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  document.getElementById('cnpj').addEventListener('input', function (e) {
    let value = e.target.value.replace(/\D/g, '');
    value = value.replace(/^(\d{2})(\d)/, '$1.$2');
    value = value.replace(/^(\d{2})\.(\d{3})(\d)/, '$1.$2.$3');
    value = value.replace(/\.(\d{3})(\d)/, '.$1/$2');
    value = value.replace(/(\d{4})(\d)/, '$1-$2');
    e.target.value = value.slice(0, 18);
  });
</script>

</body>
</html>
