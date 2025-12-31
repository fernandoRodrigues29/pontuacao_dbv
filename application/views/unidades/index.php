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
        <a href="<?= site_url('unidades/adicionar') ?>" class="btn btn-success">
            <i class="fas fa-plus"></i> Adicionar Nova Unidade
        </a>
        <a href="<?= site_url('pontuacao/lancar') ?>" class="btn btn-primary float-right">
            Voltar para Cantinho da Unidade
        </a>
    </div>

    <?php if (empty($unidades)): ?>
        <div class="alert alert-info">Nenhuma unidade cadastrada ainda.</div>
    <?php else: ?>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome da Unidade</th>
                    <th>Classe Base</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($unidades as $unidade): ?>
                    <tr>
                        <td><?= $unidade->id_unidade ?></td>
                        <td><strong><?= $unidade->nome_unidade ?></strong></td>
                        <td><?= $unidade->classe_base ?></td>
                        <td>
                            <a href="<?= site_url('unidades/editar/'.$unidade->id_unidade) ?>" class="btn btn-sm btn-warning">Editar</a>
                            <a href="<?= site_url('unidades/deletar/'.$unidade->id_unidade) ?>" 
                               class="btn btn-sm btn-danger" 
                               onclick="return confirm('Tem certeza? Isso não pode ser desfeito!')">
                                Excluir
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
    <?php $this->load->view('templates/footer'); ?>
</div>

</body>
</html>