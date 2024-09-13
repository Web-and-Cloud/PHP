<nav class="navbar navbar-expand-lg bg-body-tertiary mb-3">
  <div class="container">
    <a class="navbar-brand" href="index.php">Vuokraamo</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <?php if(onKirjautunut()): ?>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="asiakas.php">Asiakas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="tuote.php">Tuote</a>
        </li>
        <li class="nav-item">
          <a href="vuokraus.php" class="nav-link">Vuokraus</a>
        </li>
        <li class="nav-item">
          <a href="vuokralla.php" class="nav-link">Vuokralla</a>
        </li>
        <?php endif; ?>
      </ul>
      <?php if(onKirjautunut()): ?>
        <a href="ulos.php" class="nav-link">Ulos <i class="bi bi-box-arrow-right"></i></a>
      <?php else: ?>
        <a href="kirjaudu.php" class="nav-link">Kirjaudu <i class="bi bi-box-arrow-in-right"></i></a>
      <?php endif; ?>
    </div>
  </div>
</nav>