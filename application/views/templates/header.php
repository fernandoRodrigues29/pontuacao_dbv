<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title . ' - Sistema Desbravadores' : 'Sistema Desbravadores' ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body { padding-top: 70px; background-color: #f8f9fa; }
        .navbar-brand { font-weight: bold; }
        .nav-link i { margin-right: 8px; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
    <div class="container">
        <a class="navbar-brand" href="<?= site_url('pontuacao/lancar') ?>">
            <i class="fas fa-campground"></i> Sistema Cantinho da Unidade
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('pontuacao/lancar') ?>">
                        <i class="fas fa-clipboard-check"></i> Cantinho da Unidade
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('unidades') ?>">
                        <i class="fas fa-flag"></i> Unidades
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('desbravadores') ?>">
                        <i class="fas fa-users"></i> Desbravadores
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('pontuacao/ranking') ?>">
                        <i class="fas fa-trophy"></i> Ranking Geral
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <!-- Mensagens flash -->
    <?php if ($this->session->flashdata('sucesso')): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <?= $this->session->flashdata('sucesso') ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('erro')): ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <?= $this->session->flashdata('erro') ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    <?php endif; ?>