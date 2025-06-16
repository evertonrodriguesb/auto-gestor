<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Gestor Impacto 1.0</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background-color: #f8f9fa;
    }
    .offcanvas-start {
      width: 250px;
    }
    .content {
      padding: 30px;
    }
  </style>
</head>
<body>

  <nav class="navbar navbar-dark bg-primary">
    <div class="container-fluid">
      <button class="btn btn-outline-light me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#menuLateral">
        ☰
      </button>
      <span class="navbar-brand mb-0 h1">Gestor Impacto 1.0</span>
    </div>
  </nav>

  <div class="offcanvas offcanvas-start bg-light" tabindex="-1" id="menuLateral">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title">Menu</h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">
      <ul class="nav flex-column">
        <li class="nav-item mb-2">
          <a class="btn btn-outline-primary w-100" href="../usuario/usuarios.php">Cadastro de usuário</a>
        </li>
        <li class="nav-item">
          <a class="btn btn-outline-danger w-100" href="../../database/usuario/logout.php">Sair do Sistema</a>
        </li>
      </ul>
    </div>
  </div>

  <div class="container content">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h3>Produtos</h3>
      <a href="cadastro-produto.html" class="btn bg-primary text-white">Cadastrar Novo Produto</a>
    </div>

    <div class="bg-white p-3 rounded-3 shadow-sm">
      <form method="GET" class="mb-3 d-flex" action="">
        <input type="text" name="busca_serie" class="form-control me-2" placeholder="Buscar por número de série" value="<?php echo isset($_GET['busca_serie']) ? htmlspecialchars($_GET['busca_serie']) : ''; ?>">
        <button type="submit" class="btn btn-primary">Buscar</button>
      </form>

      <table class="table table-bordered table-hover mb-0">
        <thead class="table-light">
          <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Modelo</th>
            <th>N° de série</th>
            <th>Status</th>
            <th>CNPJ</th>
            <th>Nome da empresa</th>
          </tr>
        </thead>
        <tbody>
          <?php include '../../database/produto/listar_produtos.php'; ?>
        </tbody>
      </table>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
