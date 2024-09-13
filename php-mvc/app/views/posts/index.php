<?php 
  flash('post_message'); 
?>
<div class="row mt-3">
  <div class="col-md-6">
    <h1>Viestit</h1>
  </div>
  <div class="col-md-6">
    <a class="btn btn-primary float-end" href="<?= URLROOT;?>/posts/add">Lisää viesti</a>
  </div>
</div>

<div class="row mt-3">
  <?php foreach($data['posts'] as $post): ?>
    <div class="col-md-6">
      <div class="card card-body mb-3">
        <h4 class="card-title"><?= $post['title']; ?></h4>
        <div class="bg-light p-2 mb-3">
          Kirjoittanut <?= $post['name']; ?>, <?= $post['created_at']; ?>
        </div>
        <p class="card-text">
        <?= $post['body']; ?>
        </p>
        <a href="<?= URLROOT;?>/posts/show/<?= $post['postID'];?>" 
          class="btn btn-dark">Lisää</a>
      </div>
    </div>
  <?php endforeach; ?>
</div>