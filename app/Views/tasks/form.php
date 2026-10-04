<?= view('templates/header', ['pageTitle' => $pageTitle]) ?>
<div class="row justify-content-center"><div class="col-lg-8"><div class="card border-0 shadow-sm"><div class="card-body p-4 p-md-5">
    <h1 class="h2 mb-4"><?= esc($heading) ?></h1>
    <?php if (! empty($errors)): ?><div class="alert alert-danger"><ul class="mb-0"><?php foreach ($errors as $message): ?><li><?= esc($message) ?></li><?php endforeach; ?></ul></div><?php endif; ?>
    <form method="post" action="<?= esc($action) ?>">
        <?= csrf_field() ?>
        <div class="mb-3"><label class="form-label" for="title">Title</label><input class="form-control" id="title" name="title" value="<?= esc($task['title']) ?>" required maxlength="150"></div>
        <div class="mb-3"><label class="form-label" for="status">Status</label><select class="form-select" id="status" name="status"><option value="pending" <?= $task['status'] === 'pending' ? 'selected' : '' ?>>Pending</option><option value="in_progress" <?= $task['status'] === 'in_progress' ? 'selected' : '' ?>>In Progress</option><option value="completed" <?= $task['status'] === 'completed' ? 'selected' : '' ?>>Completed</option></select></div>
        <div class="mb-4"><label class="form-label" for="task_date">Task date</label><input class="form-control" id="task_date" name="task_date" type="date" value="<?= esc($task['task_date']) ?>" required></div>
        <div class="d-flex gap-2"><button class="btn btn-primary" type="submit">Save Task</button><a class="btn btn-outline-secondary" href="<?= site_url('tasks') ?>">Cancel</a></div>
    </form>
</div></div></div></div>
<?= view('templates/footer') ?>
