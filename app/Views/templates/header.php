<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= esc($pageTitle ?? 'Tasks for Today') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm"><div class="container">
    <a class="navbar-brand fw-semibold" href="<?= site_url('/') ?>">Tasks for Today</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavigation" aria-controls="mainNavigation" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
    <div class="collapse navbar-collapse" id="mainNavigation"><div class="navbar-nav ms-auto align-items-lg-center">
        <a class="nav-link" href="<?= site_url('/') ?>">Welcome</a><a class="nav-link" href="<?= site_url('tasks') ?>">Task List</a><a class="nav-link" href="<?= site_url('profile') ?>">Profile</a><a class="nav-link" href="<?= site_url('about') ?>">About</a>
        <?php if (session()->get('isLoggedIn')): ?><a class="nav-link" href="<?= site_url('tasks/new') ?>">New Task</a><a class="nav-link" href="<?= site_url('logout') ?>">Logout</a><?php else: ?><a class="nav-link" href="<?= site_url('login') ?>">Login</a><?php endif; ?>
    </div></div>
</div></nav>
<main class="container py-5">
<?php if ($message = session()->getFlashdata('success')): ?><div class="alert alert-success"><?= esc($message) ?></div><?php endif; ?>
