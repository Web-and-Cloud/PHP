
<div class="row">
  <div class="col-md-8 mx-auto">
    <div class="card card-body bg-light mt-5">
      <h2 class="mb-3">Kirjautuminen</h2>

      <form action="<?= URLROOT; ?>/users/login" method="post">

        <div class="row mb-3">
          <label for="email" class="col-sm-3 col-form-label">Sähköposti</label>
          <div class="col-sm-9">
            <input value="<?= $data['email'] ?? '';?>"
            name="email" type="text" 
            class="form-control <?= (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>">
            <?php if(!empty($data['email_err'])): ?>
              <div class="invalid-feedback">
                <small><?= $data['email_err']; ?></small>
              </div>
            <?php endif; ?>
          </div>
        </div>

        <div class="row mb-3">
          <label for="password" class="col-sm-3 col-form-label">Salasana</label>
          <div class="col-sm-9">
            <input name="password" type="password" class="form-control">
          </div>
        </div>

        <div class="row">
          <div class="col">
            <button class="btn btn-primary" type="submit" >Kirjaudu</button>
          </div>
          <div class="col">
            <a class="btn btn-light btn-block"
            href="<?= URLROOT;?>/users/register">Ei tunnusta? Rekisteröidy.</a>
          </div>
        </div>

      </form>
    </div>
  </div>
 </div>