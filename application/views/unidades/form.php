<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style> body { padding: 40px; background-color: #f8f9fa; } </style>
</head>
<body>

<div class="container">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4><?= $title ?></h4>
        </div>
        <div class="card-body">

            <?= form_open('unidades/salvar') ?>

            <?php if (isset($unidade)): ?>
                <input type="hidden" name="id_unidade" value="<?= $unidade->id_unidade ?>">
            <?php endif; ?>

            <div class="form-group">
                <label>Nome da Unidade *</label>
                <input type="text" name="nome_unidade" class="form-control" 
                       value="<?= set_value('nome_unidade', isset($unidade) ? $unidade->nome_unidade : '') ?>" 
                       required>
                <?= form_error('nome_unidade') ?>
            </div>

            <div class="form-group">
                <label>Classe Base</label>
                <input type="text" name="classe_base" class="form-control" 
                       value="<?= set_value('classe_base', isset($unidade) ? $unidade->classe_base : 'Amigo/Companheiro') ?>" 
                       placeholder="Ex: Amigo/Companheiro">
            </div>

            <div class="text-right">
                <a href="<?= site_url('unidades') ?>" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-success">Salvar Unidade</button>
            </div>

            <?= form_close() ?>
        </div>
    </div>
</div>

</body>
</html>