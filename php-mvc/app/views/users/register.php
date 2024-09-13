
 <div class="row">
  <div class="col-md-8 mx-auto">
    <div class="card card-body bg-light mt-5">
      <h2 class="mb-3">Luo uusi käyttäjä</h2>

      <form action="" method="post">

        <div class="row mb-3">
          <label for="name" class="col-sm-3 col-form-label">Nimi</label>
          <div class="col-sm-9">
            <input value="<?= $data['name'] ?? '';?>"
            name="name" type="text" 
            class="form-control <?= (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>">
            <?php if(!empty($data['name_err'])): ?>
              <div class="invalid-feedback">
                <small><?= $data['name_err']; ?></small>
              </div>
            <?php endif; ?>
          </div>
        </div>

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

        <div class="row mb-3">
          <label for="confirm_password" class="col-sm-3 col-form-label">Salasana uudestaan</label>
          <div class="col-sm-9">
            <input name="confirm_password" type="password" class="form-control">
          </div>
        </div>

        <button class="btn btn-primary" type="submit" >Tallenna</button>

      </form>
    </div>
  </div>
 </div>