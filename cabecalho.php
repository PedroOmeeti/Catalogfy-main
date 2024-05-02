
  <nav class="navbar navbar-expand-sm navbar-dark" style="background-color: #00a;">
      <a class="navbar-brand" href="#">Página Inicial</a>
      <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId"
          aria-expanded="false" aria-label="Toggle navigation"></button>
      <div class="collapse navbar-collapse" id="collapsibleNavId">
          <div class="col-11">
              <ul class="navbar-nav me-auto mt-2 mt-lg-0 d-flex">
                  <li class="nav-item">
                      <a class="nav-link active" href="index.php" aria-current="page">Início <span class="visually-hidden">(current)</span></a>
                  </li>
                  <?php if(isset($_SESSION['usuario'])) { ?>
                      <li class="nav-item">
                          <a class="nav-link active" href="./admin/painel.php" aria-current="page">Seu Paínel   <span class="visually-hidden">(current)</span></a>
                      </li>
                  <?php } ?>
              </ul>
          </div>
          <div class="col">
              <ul class="navbar-nav me-auto mt-2 mt-lg-0 d-flex">
                  <?php if(!isset($_SESSION['usuario'])) { ?>
                      <li class="nav-item">
                          <a class="btn btn-success px-3 nav-link active" href="./admin/index.php" aria-current="page">Login<span class="visually-hidden">(current)</span></a>
                      </li>
                  <?php } else { ?>
                      <li class="nav-item">
                          <a class="btn btn-danger px-3 nav-link active" href="./admin/sair.php" aria-current="page">Sair<span class="visually-hidden">(current)</span></a>
                      </li>
                  <?php } ?>
              </ul>
          </div>
      </div>
  </nav>
