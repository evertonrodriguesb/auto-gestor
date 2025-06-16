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
          <a class="btn btn-outline-primary w-100" href="../../interface/produto/produtos.php">Cadastro de produto</a>
        </li>
        <li class="nav-item">
          <a class="btn btn-outline-danger w-100" href="../../database/usuario/logout.php">Sair do Sistema</a>
        </li>
      </ul>
    </div>
  </div>

  <div class="container content">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h3>Usuários</h3>
      <a href="cadastro-usuario.html" class="btn bg-primary text-white">Cadastrar Novo Usuário</a>
    </div>

    <div class="bg-white p-3 rounded-3 shadow-sm">
      <table class="table table-bordered table-hover mb-0">
        <thead class="table-light">
          <tr>
            <th>ID</th>
            <th>Usuário</th>
          </tr>
        </thead>
        <tbody>
          <?php include '../../database/usuario/listar_usuarios.php'; ?>
        </tbody>
      </table>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
