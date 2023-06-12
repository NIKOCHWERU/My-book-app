<?= $this->extend('home') ?>

<?= $this->section('content') ?>

<h2>Profile</h2>
<?php if ($isLoggedIn) : ?>
  <?php $user = service('authentication')->user(); ?>

  <div class="d-flex justify-content-center">
    <div class="card" style="width: 300px;">
      <div class="card-header text-center">
        <h3><?= esc($user->username) ?></h3>
      </div>
      <div class="card-body text-center d-flex align-items-center" style="flex-direction:column;">
        <div style="width: 200px;height:200px;clip-path:circle();background:url(<?= base_url('../../uploads/profiles/' . $user->img) ?>);background-size:cover;" src="" alt="Profile Photo" id="profile-photo"></div>
        <p class="card-text mt-2"><a class="text-primary" href="#" id="change-photo">Edit Profile</a></p>
        <form action="<?= route_to('update-profile') ?>" method="POST" enctype="multipart/form-data" id="profile-form" style="display: none;">
          <?= csrf_field() ?>
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" value="<?= esc($user->username) ?>">
          </div>

          <div class="form-group">
            <label for="profile-img">Profile Image</label>
            <input type="file" class="form-control-file" id="profile-img" name="img">
          </div>

          <button type="submit" class="btn btn-primary">Update</button>
        </form>
      </div>
    </div>
  </div>
<?php endif; ?>

<script>
  document.getElementById('change-photo').addEventListener('click', function(e) {
    e.preventDefault();
    document.getElementById('profile-photo').style.display = 'none';
    document.getElementById('change-photo').style.display = 'none';
    document.getElementById('profile-form').style.display = 'block';
  });
</script>


<?= $this->endSection() ?>