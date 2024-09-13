<h1><?= $data['post']['title'];?></h1>
<div class="bg-secondary text-white p-2 mb-3">
  Kirjoittanut <?= $data['user']['name'];?>, <?= $data['post']['created_at'];?>
</div>
<p><?= $data['post']['body'];?></p>

<?php if($data['post']['userID'] === $_SESSION['userID']): ?>
  <hr>
  <a href="<?= URLROOT;?>/posts/edit/<?= $data['post']['postID'];?>" class="btn btn-dark">Muokkaa</a>
  <form class="float-end" method="post"
    action="<?= URLROOT;?>/posts/delete/<?= $data['post']['postID'];?>">
      <input type="submit" value="Poista" class="btn btn-danger">
  </form>
<?php endif;