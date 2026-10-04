<?= view('templates/header', ['pageTitle' => 'Login']) ?>
<div class="row justify-content-center"><div class="col-md-6 col-lg-5"><div class="card border-0 shadow-sm"><div class="card-body p-4 p-md-5">
    <h1 class="h2 mb-2">Login</h1><p class="text-muted mb-4">Sign in to manage tasks.</p>
    <?php if (! empty($error)): ?><div class="alert alert-danger"><?= esc($error) ?></div><?php endif; ?>
    <?php if (! empty($errors)): ?><div class="alert alert-danger"><ul class="mb-0"><?php foreach ($errors as $message): ?><li><?= esc($message) ?></li><?php endforeach; ?></ul></div><?php endif; ?>
    <form method="post" action="<?= site_url('login') ?>">
        <?= csrf_field() ?>
        <div class="mb-3"><label class="form-label" for="username">Username</label><input class="form-control" id="username" name="username" value="<?= esc(old('username')) ?>" required></div>
        <div class="mb-4"><label class="form-label" for="password">Password</label><input class="form-control" id="password" name="password" type="password" required></div>
        <button class="btn btn-primary w-100" type="submit">Login</button>
    </form>
</div></div></div></div>
<?= view('templates/footer') ?>
