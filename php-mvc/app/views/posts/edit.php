<div class="row">
  <div class="col-md-8 mx-auto">
    <div class="card card-body bg-light mt-3">
      <h2 class="mb-3">Muokkaa viestiä</h2>

      <form action="" method="post">

        <div class="row mb-3">
          <label for="title" class="col-sm-3 col-form-label">Otsikko</label>
          <div class="col-sm-9">
            <input value="<?= $data['title'] ?? ''; ?>"
              name="title" type="text"
              class="form-control <?= (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>">
            <?php if (!empty($data['title_err'])): ?>
              <div class="invalid-feedback">
                <small><?= $data['title_err']; ?></small>
              </div>
            <?php endif; ?>
          </div>
        </div>

        <div class="row mb-3">
          <label for="body" class="col-sm-3 col-form-label">Viesti</label>
          <div class="col-sm-9">
            <textarea name="body" rows="3" cols="30"
              class="form-control <?= (!empty($data['body_err'])) ? 'is-invalid' : ''; ?>"><?= $data['body'] ?? ''; ?></textarea>
            <?php if (!empty($data['body_err'])): ?>
              <div class="invalid-feedback">
                <small><?= $data['body_err']; ?></small>
              </div>
            <?php endif; ?>
          </div>
        </div>

        <button class="btn btn-primary" type="submit">Tallenna</button>

      </form>
    </div>
  </div>
</div>