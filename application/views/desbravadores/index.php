<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body { padding: 30px; background-color: #f8f9fa; }
        .table th { background-color: #007bff; color: white; }
    </style>
</head>
<body>

<div class="container">
     <?php $this->load->view('templates/header'); ?>
    <h1 class="mb-4"><?= $title ?></h1>

    <?php if ($this->session->flashdata('sucesso')): ?>
        <div class="alert alert-success"><?= $this->session->flashdata('sucesso') ?></div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('erro')): ?>
        <div class="alert alert-danger"><?= $this->session->flashdata('erro') ?></div>
    <?php endif; ?>

    <div class="mb-3">
        <a href="<?= site_url('desbravadores/adicionar') ?>" class="btn btn-success">
            Adicionar Desbravador
        </a>
        <a href="<?= site_url('pontuacao/lancar') ?>" class="btn btn-primary float-right">
            Ir para Cantinho da Unidade
        </a>
    </div>

    <?php if (empty($desbravadores)): ?>
        <div class="alert alert-info">Nenhum desbravador cadastrado ainda.</div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Nome Completo</th>
                        <th>Unidade</th>
                        <th>Classe Base</th>
                        <th>Cargo</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($desbravadores as $d): ?>
                        <tr>
                            <td><strong><?= $d->nome_completo ?></strong></td>
                            <td><?= $d->nome_unidade ?: '<em>Sem unidade</em>' ?></td>
                            <td><?= $d->classe_base ?: '-' ?></td>
                            <td><?= $d->cargo ?></td>
                            <td>
                                <a href="<?= site_url('desbravadores/editar/'.$d->id_desbravador) ?>" 
                                   class="btn btn-sm btn-warning">Editar</a>
                                <a href="<?= site_url('desbravadores/deletar/'.$d->id_desbravador) ?>" 
                                   class="btn btn-sm btn-danger"
                                   onclick="return confirm('Tem certeza? Isso excluirá o desbravador (se não tiver pontos lançados).')">
                                    Excluir
                                </a>
                                <a href="<?= site_url('pontuacao/historico/'.$d->id_desbravador) ?>" 
                                   class="btn btn-sm btn-info">Histórico</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
     <?php $this->load->view('templates/footer'); ?>
</div>

</body>
</html>