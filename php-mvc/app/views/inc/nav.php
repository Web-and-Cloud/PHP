<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container">
    <a class="navbar-brand" href="<?= URLROOT; ?>"><?= SITENAME; ?></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" 
            href="<?= URLROOT;?>/posts/">Viestit</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= URLROOT;?>/pages/about">Tietoa meistä</a>
        </li>
      </ul>
      <ul class="navbar-nav">
        <?php if(isLoggedIn()): ?>
          <li class="nav-item">
            <a class="nav-link" href="<?= URLROOT;?>/users/logout">Ulos</a>
          </li>
        <?php else: ?>
          <li class="nav-item">
            <a class="nav-link" href="<?= URLROOT;?>/users/login">Kirjaudu</a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>